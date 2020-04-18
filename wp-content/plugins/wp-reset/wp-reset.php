<?php
/*
  Plugin Name: WP Reset
  Plugin URI: https://wpreset.com/
  Description: Reset the entire site or just selected parts while reserving the option to undo by using snapshots.
  Version: 1.77
  Author: WebFactory Ltd
  Author URI: https://www.webfactoryltd.com/
  Text Domain: wp-reset

  Copyright 2015 - 2019  Web factory Ltd  (email: wpreset@webfactoryltd.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// include only file
if (!defined('ABSPATH')) {
  die('Do not open this file directly.');
}


// load WP-CLI commands, if needed
if (defined('WP_CLI') && WP_CLI) {
  require_once dirname(__FILE__) . '/wp-reset-cli.php';
}


class WP_Reset
{
  protected static $instance = null;
  public $version = 0;
  public $plugin_url = '';
  public $plugin_dir = '';
  public $snapshots_folder = 'wp-reset-snapshots-export';
  protected $options = array();
  private $delete_count = 0;
  private $licensing_servers = array('https://license1.wpreset.com/', 'https://license2.wpreset.com/');
  private $core_tables = array('commentmeta', 'comments', 'links', 'options', 'postmeta', 'posts', 'term_relationships', 'term_taxonomy', 'termmeta', 'terms', 'usermeta', 'users');


  /**
   * Creates a new WP_Reset object and implements singleton
   *
   * @return WP_Reset
   */
  static function getInstance()
  {
    if (!is_a(self::$instance, 'WP_Reset')) {
      self::$instance = new WP_Reset();
    }

    return self::$instance;
  } // getInstance


  /**
   * Initialize properties, hook to filters and actions
   *
   * @return null
   */
  private function __construct()
  {
    $this->version = $this->get_plugin_version();
    $this->plugin_dir = plugin_dir_path(__FILE__);
    $this->plugin_url = plugin_dir_url(__FILE__);
    $this->load_options();

    add_action('admin_menu', array($this, 'admin_menu'));
    add_action('admin_init', array($this, 'do_all_actions'));
    add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    add_action('admin_action_wpr_dismiss_notice', array($this, 'action_dismiss_notice'));
    add_action('wp_ajax_wp_reset_dismiss_notice', array($this, 'ajax_dismiss_notice'));
    add_action('wp_ajax_wp_reset_run_tool', array($this, 'ajax_run_tool'));
    add_action('wp_ajax_wp_reset_submit_survey', array($this, 'ajax_submit_survey'));
    add_action('admin_action_install_webhooks', array($this, 'install_webhooks'));
    add_action('admin_print_scripts', array($this, 'remove_admin_notices'));

    add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'plugin_action_links'));
    add_filter('plugin_row_meta', array($this, 'plugin_meta_links'), 10, 2);
    add_filter('admin_footer_text', array($this, 'admin_footer_text'));
    add_filter('install_plugins_table_api_args_featured', array($this, 'featured_plugins_tab'));

    $this->core_tables = array_map(function ($tbl) {
      global $wpdb;
      return $wpdb->prefix . $tbl;
    }, $this->core_tables);
  } // __construct


  /**
   * Get plugin version from file header
   *
   * @return string
   */
  function get_plugin_version()
  {
    $plugin_data = get_file_data(__FILE__, array('version' => 'Version'), 'plugin');

    return $plugin_data['version'];
  } // get_plugin_version


  /**
   * Load and prepare the options array
   * If needed create a new DB entry
   *
   * @return array
   */
  private function load_options()
  {
    $options = get_option('wp-reset', array());
    $change = false;

    if (!isset($options['meta'])) {
      $options['meta'] = array('first_version' => $this->version, 'first_install' => current_time('timestamp', true), 'reset_count' => 0);
      $change = true;
    }
    if (!isset($options['dismissed_notices'])) {
      $options['dismissed_notices'] = array();
      $change = true;
    }
    if (!isset($options['last_run'])) {
      $options['last_run'] = array();
      $change = true;
    }
    if (!isset($options['options'])) {
      $options['options'] = array();
      $change = true;
    }
    if ($change) {
      update_option('wp-reset', $options, true);
    }

    $this->options = $options;
    return $options;
  } // load_options


  /**
   * Get meta part of plugin options
   *
   * @return array
   */
  function get_meta()
  {
    return $this->options['meta'];
  } // get_meta


  /**
   * Get all dismissed notices, or check for one specific notice
   *
   * @param string  $notice_name  Optional. Check if specified notice is dismissed.
   *
   * @return bool|array
   */
  function get_dismissed_notices($notice_name = '')
  {
    $notices = $this->options['dismissed_notices'];

    if (empty($notice_name)) {
      return $notices;
    } else {
      if (empty($notices[$notice_name])) {
        return false;
      } else {
        return true;
      }
    }
  } // get_dismissed_notices


  /**
   * Get options part of plugin options
   *
   * todo: not completed
   *
   * @param string  $key  Optional.
   *
   * @return array
   */
  function get_options($key = '')
  {
    return $this->options['options'];
  } // get_options


  /**
   * Update plugin options, currently entire array
   *
   * todo: this handles the entire options array although it should only do the options part - it's confusing
   *
   * @param string  $key   Data to save.
   * @param string  $data  Option key.
   *
   * @return bool
   */
  function update_options($key, $data)
  {
    $this->options[$key] = $data;
    $tmp = update_option('wp-reset', $this->options);

    return $tmp;
  } // set_options


  /**
   * Add plugin menu entry under Tools menu
   *
   * @return null
   */
  function admin_menu()
  {
    add_management_page(__('WP Reset', 'wp-reset'), __('WP Reset', 'wp-reset'), 'administrator', 'wp-reset', array($this, 'plugin_page'));
  } // admin_menu


  /**
   * Dismiss notice via AJAX call
   *
   * @return null
   */
  function ajax_dismiss_notice()
  {
    check_ajax_referer('wp-reset_dismiss_notice');

    if (!current_user_can('administrator')) {
      wp_send_json_error(__('You are not allowed to run this action.', 'wp-reset'));
    }

    $notice_name = trim(@$_GET['notice_name']);
    if (!$this->dismiss_notice($notice_name)) {
      wp_send_json_error(__('Notice is already dismissed.', 'wp-reset'));
    } else {
      wp_send_json_success();
    }
  } // ajax_dismiss_notice


  /**
   * Dismiss notice via admin action
   *
   * @return null
   */
  function action_dismiss_notice()
  {
    if (false == wp_verify_nonce(@$_GET['_wpnonce'], 'wpr_dismiss_notice')) {
      wp_die('Please reload the page and try again.');
    }

    if (empty($_GET['notice'])) {
      wp_safe_redirect(admin_url());
      exit;
    }

    $notice_name = trim(@$_GET['notice']);
    $this->dismiss_notice($notice_name);

    if (!empty($_GET['redirect'])) {
      wp_safe_redirect($_GET['redirect']);
    } else {
      wp_safe_redirect(admin_url());
    }

    exit;
  } // action_dismiss_notice


  /**
   * Dismiss notice by adding it to dismissed_notices options array
   *
   * @param string  $notice_name  Notice to dismiss.
   *
   * @return bool
   */
  function dismiss_notice($notice_name)
  {
    if ($this->get_dismissed_notices($notice_name)) {
      return false;
    } else {
      $notices = $this->get_dismissed_notices();
      $notices[$notice_name] = true;
      $this->update_options('dismissed_notices', $notices);
      return true;
    }
  } // dismiss_notice


  /**
   * Returns all WP pointers
   *
   * @return array
   */
  function get_pointers()
  {
    $pointers = array();

    $pointers['welcome'] = array('target' => '#menu-tools', 'edge' => 'left', 'align' => 'right', 'content' => 'Thank you for installing the <b style="font-weight: 800;">WP Reset</b> plugin!<br>Open <a href="' . admin_url('tools.php?page=wp-reset') . '">Tools - WP Reset</a> to access resetting tools and start developing &amp; debugging faster.');

    return $pointers;
  } // get_pointers


  /**
   * Enqueue CSS and JS files
   *
   * @return null
   */
  function admin_enqueue_scripts($hook)
  {
    // welcome pointer is shown on all pages except WPR to admins, until dismissed
    $pointers = $this->get_pointers();
    $dismissed_notices = $this->get_dismissed_notices();
    $meta = $this->get_meta();

    foreach ($dismissed_notices as $notice_name => $tmp) {
      if ($tmp) {
        unset($pointers[$notice_name]);
      }
    } // foreach

    if (!empty($pointers) && !$this->is_plugin_page() && current_user_can('administrator')) {
      $pointers['_nonce_dismiss_pointer'] = wp_create_nonce('wp-reset_dismiss_notice');

      wp_enqueue_style('wp-pointer');

      wp_enqueue_script('wp-reset-pointers', $this->plugin_url . 'js/wp-reset-pointers.js', array('jquery'), $this->version, true);
      wp_enqueue_script('wp-pointer');
      wp_localize_script('wp-pointer', 'wp_reset_pointers', $pointers);
    }

    // exit early if not on WP Reset page
    if (!$this->is_plugin_page()) {
      return;
    }

    // features survey is shown 5min after install or after first reset
    $survey = false;
    if ($this->is_survey_active('features')) {
      $survey = true;
    }

    $js_localize = array(
      'undocumented_error' => __('An undocumented error has occurred. Please refresh the page and try again.', 'wp-reset'),
      'documented_error' => __('An error has occurred.', 'wp-reset'),
      'plugin_name' => __('WP Reset', 'wp-reset'),
      'settings_url' => admin_url('tools.php?page=wp-reset'),
      'icon_url' => $this->plugin_url . 'img/wp-reset-icon.png',
      'invalid_confirmation' => __('Please type "reset" in the confirmation field.', 'wp-reset'),
      'invalid_confirmation_title' => __('Invalid confirmation', 'wp-reset'),
      'cancel_button' => __('Cancel', 'wp-reset'),
      'open_survey' => $survey,
      'ok_button' => __('OK', 'wp-reset'),
      'confirm_button' => __('Reset WordPress', 'wp-reset'),
      'confirm_title' => __('Are you sure you want to proceed?', 'wp-reset'),
      'confirm_title_reset' => __('Are you sure you want to reset the site?', 'wp-reset'),
      'confirm1' => __('Clicking "Reset WordPress" will reset your site to default values. All content will be lost. Always <a href="#" class="create-new-snapshot" data-description="Before resetting the site">create a snapshot</a> if you want to be able to undo.</b>', 'wp-reset'),
      'confirm2' => __('Click "Cancel" to abort.', 'wp-reset'),
      'doing_reset' => __('Resetting in progress. Please wait.', 'wp-reset'),
      'nonce_dismiss_notice' => wp_create_nonce('wp-reset_dismiss_notice'),
      'nonce_run_tool' => wp_create_nonce('wp-reset_run_tool'),
      'nonce_do_reset' => wp_create_nonce('wp-reset_do_reset'),
    );

    if ($survey) {
      $js_localize['nonce_submit_survey'] = wp_create_nonce('wp-reset_submit_survey');
    }
    if (!$this->is_webhooks_active()) {
      $js_localize['webhooks_install_url'] = add_query_arg(array('action' => 'install_webhooks'), admin_url('admin.php'));
    }

    wp_enqueue_style('plugin-install');
    wp_enqueue_style('wp-jquery-ui-dialog');
    wp_enqueue_style('wp-reset', $this->plugin_url . 'css/wp-reset.css', array(), $this->version);
    wp_enqueue_style('wp-reset-sweetalert2', $this->plugin_url . 'css/sweetalert2.min.css', array(), $this->version);

    wp_enqueue_script('plugin-install');
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('wp-reset-sweetalert2', $this->plugin_url . 'js/wp-reset-libs.min.js', array('jquery'), $this->version, true);
    wp_enqueue_script('wp-reset', $this->plugin_url . 'js/wp-reset.js', array('jquery'), $this->version, true);
    wp_localize_script('wp-reset', 'wp_reset', $js_localize);

    add_thickbox();

    // fix for aggressive plugins that include their CSS on all pages
    wp_dequeue_style('uiStyleSheet');
    wp_dequeue_style('wpcufpnAdmin');
    wp_dequeue_style('unifStyleSheet');
    wp_dequeue_style('wpcufpn_codemirror');
    wp_dequeue_style('wpcufpn_codemirrorTheme');
    wp_dequeue_style('collapse-admin-css');
    wp_dequeue_style('jquery-ui-css');
    wp_dequeue_style('tribe-common-admin');
    wp_dequeue_style('file-manager__jquery-ui-css');
    wp_dequeue_style('file-manager__jquery-ui-css-theme');
    wp_dequeue_style('wpmegmaps-jqueryui');
    wp_dequeue_style('wp-botwatch-css');
  } // admin_enqueue_scripts


  /**
   * Remove all WP notices on WPR page
   *
   * @return null
   */
  function remove_admin_notices()
  {
    if (!$this->is_plugin_page()) {
      return false;
    }

    global $wp_filter;
    unset($wp_filter['user_admin_notices'], $wp_filter['admin_notices']);
  } // remove_admin_notices


  /**
   * Submit user selected survey answers to WPR servers
   *
   * @return null
   */
  function ajax_submit_survey()
  {
    check_ajax_referer('wp-reset_submit_survey');

    $meta = $this->get_meta();

    $vars = wp_parse_args($_POST, array('survey' => '', 'answers' => '', 'custom_answer' => '', 'emailme' => ''));
    $vars['answers'] = trim($vars['answers'], ',');
    $vars['custom_answer'] = substr(trim(strip_tags($vars['custom_answer'])), 0, 256);

    if (empty($vars['survey']) || empty($vars['answers'])) {
      wp_send_json_error();
    }

    $request_params = array('sslverify' => false, 'timeout' => 15, 'redirection' => 2);
    $request_args = array(
      'action' => 'submit_survey',
      'survey' => $vars['survey'],
      'email' => $vars['emailme'],
      'answers' => $vars['answers'],
      'custom_answer' => $vars['custom_answer'],
      'first_version' => $meta['first_version'],
      'version' => $this->version,
      'codebase' => 'free',
      'site' => get_home_url()
    );

    $url = add_query_arg($request_args, $this->licensing_servers[0]);
    $response = wp_remote_get(esc_url_raw($url), $request_params);

    if (is_wp_error($response) || !wp_remote_retrieve_body($response)) {
      $url = add_query_arg($request_args, $this->licensing_servers[1]);
      $response = wp_remote_get(esc_url_raw($url), $request_params);
    }

    $this->dismiss_notice('survey-' . $vars['survey']);

    wp_send_json_success();
  } // ajax_submit_survey


  /**
   * Check if named survey should be shown or not
   *
   * @param [string] $survey_name Name of the survey to check
   * @return boolean
   */
  function is_survey_active($survey_name)
  {
    if (empty($survey_name)) {
      return false;
    }

    // all surveys are curently disabled
    return false;

    if ($this->get_dismissed_notices('survey-' . $survey_name)) {
      return false;
    }

    $meta = $this->get_meta();
    if (current_time('timestamp', true) - $meta['first_install'] > 300 || $meta['reset_count'] > 0) {
      return true;
    }

    return false;
  } // is_survey_active

  /**
   * Check if WP-CLI is available and running
   *
   * @return bool
   */
  static function is_cli_running()
  {
    if (!is_null($value = apply_filters('wp-reset-override-is-cli-running', null))) {
      return (bool) $value;
    }

    if (defined('WP_CLI') && WP_CLI) {
      return true;
    } else {
      return false;
    }
  } // is_cli_running


  /**
   * Check if core WP Webhooks and WPR addon plugins are installed and activated
   *
   * @return bool
   */
  function is_webhooks_active()
  {
    if (!function_exists('is_plugin_active') || !function_exists('get_plugin_data')) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if (false == is_plugin_active('wp-webhooks/wp-webhooks.php')) {
      return false;
    }

    if (false == is_plugin_active('wpwh-wp-reset-webhook-integration/wpwhpro-wp-reset-webhook-integration.php')) {
      return false;
    }

    return true;
  } // is_webhooks_active


  /**
   * Check if given plugin is installed
   *
   * @param [string] $slug Plugin slug
   * @return boolean
   */
  function is_plugin_installed($slug)
  {
    if (!function_exists('get_plugins')) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $all_plugins = get_plugins();

    if (!empty($all_plugins[$slug])) {
      return true;
    } else {
      return false;
    }
  } // is_plugin_installed


  /**
   * Auto download/install/upgrade/activate WP Webhooks plugin
   *
   * @return null
   */
  static function install_webhooks()
  {
    $plugin_slug = 'wp-webhooks/wp-webhooks.php';
    $plugin_zip = 'https://downloads.wordpress.org/plugin/wp-webhooks.latest-stable.zip';

    @include_once ABSPATH . 'wp-admin/includes/plugin.php';
    @include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    @include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
    @include_once ABSPATH . 'wp-admin/includes/file.php';
    @include_once ABSPATH . 'wp-admin/includes/misc.php';
    echo '<style>
		body{
			font-family: sans-serif;
			font-size: 14px;
			line-height: 1.5;
			color: #444;
		}
		</style>';

    echo '<div style="margin: 20px; color:#444;">';
    echo 'If things are not done in a minute <a target="_parent" href="' . admin_url('plugin-install.php?s=ironikus&tab=search&type=term') . '">install the plugin manually via Plugins page</a><br><br>';

    wp_cache_flush();
    $upgrader = new Plugin_Upgrader();
    echo 'Check if WP Webhooks plugin is already installed ... <br />';
    if (self::is_plugin_installed($plugin_slug)) {
      echo 'WP Webhooks is already installed!<br />Making sure it\'s the latest version.<br />';
      $upgrader->upgrade($plugin_slug);
      $installed = true;
    } else {
      echo 'Installing WP Webhooks.<br />';
      $installed = $upgrader->install($plugin_zip);
    }
    wp_cache_flush();

    if (!is_wp_error($installed) && $installed) {
      echo 'Activating WP Webhooks.<br />';
      $activate = activate_plugin($plugin_slug);

      if (is_null($activate)) {
        echo 'WP Webhooks activated.<br />';
      }
    } else {
      echo 'Could not install WP Webhooks. You\'ll have to <a target="_parent" href="' . admin_url('plugin-install.php?s=ironikus&tab=search&type=term') . '">download and install manually</a>.';
    }

    $plugin_slug = 'wpwh-wp-reset-webhook-integration/wpwhpro-wp-reset-webhook-integration.php';
    $plugin_zip = 'https://downloads.wordpress.org/plugin/wpwh-wp-reset-webhook-integration.latest-stable.zip';

    wp_cache_flush();
    $upgrader = new Plugin_Upgrader();
    echo '<br>Check if WP Webhooks WPR addon plugin is already installed ... <br />';
    if (self::is_plugin_installed($plugin_slug)) {
      echo 'WP Webhooks WPR addon is already installed!<br />Making sure it\'s the latest version.<br />';
      $upgrader->upgrade($plugin_slug);
      $installed = true;
    } else {
      echo 'Installing WP Webhooks WPR addon.<br />';
      $installed = $upgrader->install($plugin_zip);
    }
    wp_cache_flush();

    if (!is_wp_error($installed) && $installed) {
      echo 'Activating WP Webhooks WPR addon.<br />';
      $activate = activate_plugin($plugin_slug);

      if (is_null($activate)) {
        echo 'WP Webhooks WPR addon activated.<br />';

        echo '<script>setTimeout(function() { top.location = "tools.php?page=wp-reset"; }, 1000);</script>';
        echo '<br>If you are not redirected in a few seconds - <a href="tools.php?page=wp-reset" target="_parent">click here</a>.';
      }
    } else {
      echo 'Could not install WP Webhooks WPR addon. You\'ll have to <a target="_parent" href="' . admin_url('plugin-install.php?s=ironikus&tab=search&type=term') . '">download and install manually</a>.';
    }

    echo '</div>';
  } // install_webhooks


  /**
   * Deletes all transients.
   *
   * @return int  Number of deleted transient DB entries
   */
  function do_delete_transients()
  {
    global $wpdb;

    $count = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '\_transient\_%' OR option_name LIKE '\_site\_transient\_%'");

    wp_cache_flush();

    do_action('wp_reset_delete_transients', $count);

    return $count;
  } // do_delete_transients


  /**
   * Resets all theme options (mods).
   *
   * @param bool $all_themes Delete mods for all themes or just the current one
   *
   * @return int  Number of deleted mod DB entries
   */
  function do_reset_theme_options($all_themes = true)
  {
    global $wpdb;

    $count = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'theme_mods\_%' OR option_name LIKE 'mods\_%'");

    do_action('wp_reset_reset_theme_options', $count);

    return $count;
  } // do_reset_theme_options


  /**
   * Deletes all files in uploads folder.
   *
   * @return int  Number of deleted files and folders.
   */
  function do_delete_uploads()
  {
    $upload_dir = wp_get_upload_dir();
    $this->delete_count = 0;

    $this->delete_folder($upload_dir['basedir'], $upload_dir['basedir']);

    do_action('wp_reset_delete_uploads', $this->delete_count);

    return $this->delete_count;
  } // do_delete_uploads


  /**
   * Recursively deletes a folder
   *
   * @param string $folder  Recursive param.
   * @param string $base_folder  Base folder.
   *
   * @return bool
   */
  private function delete_folder($folder, $base_folder)
  {
    $files = array_diff(scandir($folder), array('.', '..'));

    foreach ($files as $file) {
      if (is_dir($folder . DIRECTORY_SEPARATOR . $file)) {
        $this->delete_folder($folder . DIRECTORY_SEPARATOR . $file, $base_folder);
      } else {
        $tmp = @unlink($folder . DIRECTORY_SEPARATOR . $file);
        $this->delete_count = $this->delete_count + (int) $tmp;
      }
    } // foreach

    if ($folder != $base_folder) {
      $tmp = @rmdir($folder);
      $this->delete_count = $this->delete_count + (int) $tmp;
      return $tmp;
    } else {
      return true;
    }
  } // delete_folder


  /**
   * Deactivate and delete all plugins
   *
   * @param bool  $keep_wp_reset  Keep WP Reset active and installed
   * @param bool  $silent_deactivate  Skip individual plugin deactivation functions when deactivating
   *
   * @return int  Number of deleted plugins.
   */
  function do_delete_plugins($keep_wp_reset = true, $silent_deactivate = false)
  {
    if (!function_exists('get_plugins')) {
      require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    if (!function_exists('request_filesystem_credentials')) {
      require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    $wp_reset_basename = plugin_basename(__FILE__);

    $all_plugins = get_plugins();
    $active_plugins = (array) get_option('active_plugins', array());
    if (true == $keep_wp_reset) {
      if (($key = array_search($wp_reset_basename, $active_plugins)) !== false) {
        unset($active_plugins[$key]);
      }
      unset($all_plugins[$wp_reset_basename]);
    }

    if (!empty($active_plugins)) {
      deactivate_plugins($active_plugins, $silent_deactivate, false);
    }

    if (!empty($all_plugins)) {
      delete_plugins(array_keys($all_plugins));
    }

    do_action('wp_reset_delete_plugins', $all_plugins, $all_plugins);

    return sizeof($all_plugins);
  } // do_delete_plugins


  /**
   * Delete all themes
   *
   * @param bool  $keep_default_theme  Keep default theme
   *
   * @return int  Number of deleted themes.
   */
  function do_delete_themes($keep_default_theme = true)
  {
    global $wp_version;

    if (!function_exists('delete_theme')) {
      require_once ABSPATH . 'wp-admin/includes/theme.php';
    }

    if (!function_exists('request_filesystem_credentials')) {
      require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    if (version_compare($wp_version, '5.0', '<') === true) {
      $default_theme = 'twentyseventeen';
    } else {
      $default_theme = 'twentynineteen';
    }

    $all_themes = wp_get_themes(array('errors' => null));

    if (true == $keep_default_theme) {
      unset($all_themes[$default_theme]);
    }

    foreach ($all_themes as $theme_slug => $theme_details) {
      $res = delete_theme($theme_slug);
    }

    if (false == $keep_default_theme) {
      update_option('template', '');
      update_option('stylesheet', '');
      update_option('current_theme', '');
    }

    do_action('wp_reset_delete_themes', $all_themes);

    return sizeof($all_themes);
  } // do_delete_themes


  /**
   * Truncate custom tables
   *
   * @return int  Number of truncated tables.
   */
  function do_truncate_custom_tables()
  {
    global $wpdb;
    $custom_tables = $this->get_custom_tables();

    foreach ($custom_tables as $tbl) {
      $wpdb->query('SET foreign_key_checks = 0');
      $wpdb->query('TRUNCATE TABLE ' . $tbl['name']);
    } // foreach

    do_action('wp_reset_truncate_custom_tables', $custom_tables);

    return sizeof($custom_tables);
  } // do_truncate_custom_tables


  /**
   * Drop custom tables
   *
   * @return int  Number of dropped tables.
   */
  function do_drop_custom_tables()
  {
    global $wpdb;
    $custom_tables = $this->get_custom_tables();

    foreach ($custom_tables as $tbl) {
      $wpdb->query('SET foreign_key_checks = 0');
      $wpdb->query('DROP TABLE IF EXISTS ' . $tbl['name']);
    } // foreach

    do_action('wp_reset_drop_custom_tables', $custom_tables);

    return sizeof($custom_tables);
  } // do_drop_custom_tables


  /**
   * Delete .htaccess file
   *
   * @return bool|WP_Error Action status.
   */
  function do_delete_htaccess()
  {
    global $wp_filesystem;

    if (empty($wp_filesystem)) {
      require_once ABSPATH . '/wp-admin/includes/file.php';
      WP_Filesystem();
    }

    $htaccess_path = $this->get_htaccess_path();
    clearstatcache();

    do_action('wp_reset_delete_htaccess', $htaccess_path);

    if (!$wp_filesystem->is_readable($htaccess_path)) {
      return new WP_Error(1, 'Htaccess file does not exist; there\'s nothing to delete.');
    }

    if (!$wp_filesystem->is_writable($htaccess_path)) {
      return new WP_Error(1, 'Htaccess file is not writable.');
    }

    if ($wp_filesystem->delete($htaccess_path, false, 'f')) {
      return true;
    } else {
      return new WP_Error(1, 'Unknown error. Unable to delete htaccess file.');
    }
  } // do_delete_htaccess


  /**
   * Get .htaccess file path.
   *
   * @return string
   */
  function get_htaccess_path()
  {
    if (!function_exists('get_home_path')) {
      require_once ABSPATH . 'wp-admin/includes/file.php';
    }

    if ($this->is_cli_running()) {
      $_SERVER['SCRIPT_FILENAME'] = ABSPATH;
    }

    $filepath = get_home_path() . '.htaccess';

    return $filepath;
  } // get_htaccess_path


  /**
   * Run one tool via AJAX call
   *
   * @return null
   */
  function ajax_run_tool()
  {
    check_ajax_referer('wp-reset_run_tool');

    if (!current_user_can('administrator')) {
      wp_send_json_error(__('You are not allowed to run this action.', 'wp-reset'));
    }

    $tool = trim(@$_GET['tool']);
    $extra_data = trim(@$_GET['extra_data']);

    if ($tool == 'delete_transients') {
      $cnt = $this->do_delete_transients();
      wp_send_json_success($cnt);
    } elseif ($tool == 'reset_theme_options') {
      $cnt = $this->do_reset_theme_options(true);
      wp_send_json_success($cnt);
    } elseif ($tool == 'delete_themes') {
      $cnt = $this->do_delete_themes(false);
      wp_send_json_success($cnt);
    } elseif ($tool == 'delete_plugins') {
      $cnt = $this->do_delete_plugins(true);
      wp_send_json_success($cnt);
    } elseif ($tool == 'delete_uploads') {
      $cnt = $this->do_delete_uploads();
      wp_send_json_success($cnt);
    } elseif ($tool == 'delete_htaccess') {
      $tmp = $this->do_delete_htaccess();
      if (is_wp_error($tmp)) {
        wp_send_json_error($tmp->get_error_message());
      } else {
        wp_send_json_success($tmp);
      }
    } elseif ($tool == 'drop_custom_tables') {
      $cnt = $this->do_drop_custom_tables();
      wp_send_json_success($cnt);
    } elseif ($tool == 'truncate_custom_tables') {
      $cnt = $this->do_truncate_custom_tables();
      wp_send_json_success($cnt);
    } elseif ($tool == 'delete_snapshot') {
      $res = $this->do_delete_snapshot($extra_data);
      if (is_wp_error($res)) {
        wp_send_json_error($res->get_error_message());
      } else {
        wp_send_json_success();
      }
    } elseif ($tool == 'download_snapshot') {
      $res = $this->do_export_snapshot($extra_data);
      if (is_wp_error($res)) {
        wp_send_json_error($res->get_error_message());
      } else {
        $url = content_url() . '/' . $this->snapshots_folder . '/' . $res;
        wp_send_json_success($url);
      }
    } elseif ($tool == 'restore_snapshot') {
      $res = $this->do_restore_snapshot($extra_data);
      if (is_wp_error($res)) {
        wp_send_json_error($res->get_error_message());
      } else {
        wp_send_json_success();
      }
    } elseif ($tool == 'compare_snapshots') {
      $res = $this->do_compare_snapshots($extra_data);
      if (is_wp_error($res)) {
        wp_send_json_error($res->get_error_message());
      } else {
        wp_send_json_success($res);
      }
    } elseif ($tool == 'create_snapshot') {
      $res = $this->do_create_snapshot($extra_data);
      if (is_wp_error($res)) {
        wp_send_json_error($res->get_error_message());
      } else {
        wp_send_json_success();
      }
    } else {
      wp_send_json_error(__('Unknown tool.', 'wp-reset'));
    }
  } // ajax_run_tool


  /**
   * Reinstall / reset the WP site
   * There are no failsafes in the function - it reinstalls when called
   * Redirects when done
   *
   * @param array  $params  Optional.
   *
   * @return null
   */
  function do_reinstall($params = array())
  {
    global $current_user, $wpdb;

    // only admins can reset; double-check
    if (!$this->is_cli_running() && !current_user_can('administrator')) {
      return false;
    }

    // make sure the function is available to us
    if (!function_exists('wp_install')) {
      require ABSPATH . '/wp-admin/includes/upgrade.php';
    }

    // save values that need to be restored after reset
    // todo: use params to determine what gets restored after reset
    $blogname = get_option('blogname');
    $blog_public = get_option('blog_public');
    $wplang = get_option('wplang');
    $siteurl = get_option('siteurl');
    $home = get_option('home');
    $snapshots = $this->get_snapshots();

    $active_plugins = get_option('active_plugins');
    $active_theme = wp_get_theme();

    if (!empty($params['reactivate_webhooks'])) {
      $wpwh1 = get_option('wpwhpro_active_webhooks');
      $wpwh2 = get_option('wpwhpro_activate_translations');
      $wpwh3 = get_option('ironikus_webhook_webhooks');
    }

    // for WP-CLI
    if (!$current_user->ID) {
      $tmp = get_users(array('role' => 'administrator', 'order' => 'ASC', 'order_by' => 'ID'));
      if (empty($tmp[0]->user_login)) {
        return new WP_Error(1, 'Reset failed. Unable to find any admin users in database.');
      }
      $current_user = $tmp[0];
    }

    // delete custom tables with WP's prefix
    $prefix = str_replace('_', '\_', $wpdb->prefix);
    $tables = $wpdb->get_col("SHOW TABLES LIKE '{$prefix}%'");
    foreach ($tables as $table) {
      $wpdb->query("DROP TABLE $table");
    }

    // supress errors for WP_CLI
    // todo: find a better way to supress errors and send/not send email on reset
    $result = @wp_install($blogname, $current_user->user_login, $current_user->user_email, $blog_public, '', md5(rand()), $wplang);
    $user_id = $result['user_id'];

    // restore user pass
    $query = $wpdb->prepare("UPDATE {$wpdb->users} SET user_pass = %s, user_activation_key = '' WHERE ID = %d LIMIT 1", array($current_user->user_pass, $user_id));
    $wpdb->query($query);

    // restore rest of the settings including WP Reset's
    update_option('siteurl', $siteurl);
    update_option('home', $home);
    update_option('wp-reset', $this->options);
    update_option('wp-reset-snapshots', $snapshots);

    // remove password nag
    if (get_user_meta($user_id, 'default_password_nag')) {
      update_user_meta($user_id, 'default_password_nag', false);
    }
    if (get_user_meta($user_id, $wpdb->prefix . 'default_password_nag')) {
      update_user_meta($user_id, $wpdb->prefix . 'default_password_nag', false);
    }

    $meta = $this->get_meta();
    $meta['reset_count']++;
    $this->update_options('meta', $meta);

    // reactivate theme
    if (!empty($params['reactivate_theme'])) {
      switch_theme($active_theme->get_stylesheet());
    }

    // reactivate WP Reset
    if (!empty($params['reactivate_wpreset'])) {
      activate_plugin(plugin_basename(__FILE__));
    }

    // reactivate WP Webhooks
    if (!empty($params['reactivate_webhooks'])) {
      activate_plugin('wp-webhooks/wp-webhooks.php');
      activate_plugin('wpwh-wp-reset-webhook-integration/wpwhpro-wp-reset-webhook-integration.php');

      update_option('wpwhpro_active_webhooks', $wpwh1);
      update_option('wpwhpro_activate_translations', $wpwh2);
      update_option('ironikus_webhook_webhooks', $wpwh3);
    }

    // reactivate all plugins
    if (!empty($params['reactivate_plugins'])) {
      foreach ($active_plugins as $plugin_file) {
        activate_plugin($plugin_file);
      }
    }

    if (!$this->is_cli_running()) {
      // log out and log in the old/new user
      // since the password doesn't change this is potentially unnecessary
      wp_clear_auth_cookie();
      wp_set_auth_cookie($user_id);

      wp_redirect(admin_url() . '?wp-reset=success');
      exit;
    }
  } // do_reinstall


  /**
   * Checks wp_reset post value and performs all actions
   * todo: handle messages for various actions
   *
   * @return null|bool
   */
  function do_all_actions()
  {
    // only admins can perform actions
    if (!current_user_can('administrator')) {
      return;
    }

    if (!empty($_GET['wp-reset']) && $_GET['wp-reset'] == 'success') {
      add_action('admin_notices', array($this, 'notice_successful_reset'));
    }

    // check nonce
    if (true === isset($_POST['wp_reset_confirm']) && false === wp_verify_nonce(@$_POST['_wpnonce'], 'wp-reset')) {
      add_settings_error('wp-reset', 'bad-nonce', __('Something went wrong. Please refresh the page and try again.', 'wp-reset'), 'error');
      return false;
    }

    // check confirmation code
    if (true === isset($_POST['wp_reset_confirm']) && 'reset' !== $_POST['wp_reset_confirm']) {
      add_settings_error('wp-reset', 'bad-confirm', __('<b>Invalid confirmation code.</b> Please type "reset" in the confirmation field.', 'wp-reset'), 'error');
      return false;
    }

    // only one action at the moment
    if (true === isset($_POST['wp_reset_confirm']) && 'reset' === $_POST['wp_reset_confirm']) {
      $defaults = array(
        'reactivate_theme' => '0',
        'reactivate_plugins' => '0',
        'reactivate_wpreset' => '0',
        'reactivate_webhooks' => '0'
      );
      $params = shortcode_atts($defaults, (array) @$_POST['wpr-post-reset']);

      $this->do_reinstall($params);
    }
  } // do_all_actions


  /**
   * Add "Open WP Reset Tools" action link to plugins table, left part
   *
   * @param array  $links  Initial list of links.
   *
   * @return array
   */
  function plugin_action_links($links)
  {
    $settings_link = '<a href="' . admin_url('tools.php?page=wp-reset') . '" title="' . __('Open WP Reset Tools', 'wp-reset') . '">' . __('Open WP Reset Tools', 'wp-reset') . '</a>';

    array_unshift($links, $settings_link);

    return $links;
  } // plugin_action_links


  /**
   * Add links to plugin's description in plugins table
   *
   * @param array  $links  Initial list of links.
   * @param string $file   Basename of current plugin.
   *
   * @return array
   */
  function plugin_meta_links($links, $file)
  {
    if ($file !== plugin_basename(__FILE__)) {
      return $links;
    }

    $support_link = '<a target="_blank" href="https://wordpress.org/support/plugin/wp-reset" title="' . __('Get help', 'wp-reset') . '">' . __('Support', 'wp-reset') . '</a>';
    $home_link = '<a target="_blank" href="' . $this->generate_web_link('plugins-table-right') . '" title="' . __('Plugin Homepage', 'wp-reset') . '">' . __('Plugin Homepage', 'wp-reset') . '</a>';
    $rate_link = '<a target="_blank" href="https://wordpress.org/support/plugin/wp-reset/reviews/#new-post" title="' . __('Rate the plugin', 'wp-reset') . '">' . __('Rate the plugin ★★★★★', 'wp-reset') . '</a>';

    $links[] = $support_link;
    $links[] = $home_link;
    $links[] = $rate_link;

    return $links;
  } // plugin_meta_links


  /**
   * Test if we're on WPR's admin page
   *
   * @return bool
   */
  function is_plugin_page()
  {
    $current_screen = get_current_screen();

    if ($current_screen->id == 'tools_page_wp-reset') {
      return true;
    } else {
      return false;
    }
  } // is_plugin_page


  /**
   * Add powered by text in admin footer
   *
   * @param string  $text  Default footer text.
   *
   * @return string
   */
  function admin_footer_text($text)
  {
    if (!$this->is_plugin_page()) {
      return $text;
    }

    $text = '<i><a href="' . $this->generate_web_link('admin_footer') . '" title="' . __('Visit WP Reset page for more info', 'wp-reset') . '" target="_blank">WP Reset</a> v' . $this->version . '. Please <a target="_blank" href="https://wordpress.org/support/plugin/wp-reset/reviews/#new-post" title="Rate the plugin">rate the plugin <span>★★★★★</span></a> to help us spread the word. Thank you from the WP Reset team!</i>';

    return $text;
  } // admin_footer_text


  /**
   * Loads plugin's translated strings
   *
   * @return null
   */
  function load_textdomain()
  {
    load_plugin_textdomain('wp-reset');
  } // load_textdomain


  /**
   * Inform the user that WordPress has been successfully reset
   *
   * @return null
   */
  function notice_successful_reset()
  {
    global $current_user;

    echo '<div style="padding: 15px; display: inline-block; font-size: 14px;" id="message" class="updated"><p style="font-size: 14px;">' . sprintf(__('<b>Site has been successfully reset to default settings.</b><br>User "%s" was restored with the password unchanged. Open <a href="%s">WP Reset</a> to do another reset.', 'wp-reset'), $current_user->user_login, admin_url('tools.php?page=wp-reset')) . '</p>';

    if (false == $this->get_dismissed_notices('rate')) {
      $dismiss_url = add_query_arg(array('action' => 'wpr_dismiss_notice', 'notice' => 'rate', 'redirect' => urlencode($_SERVER['REQUEST_URI'])), admin_url('admin.php'));
      $dismiss_url = wp_nonce_url($dismiss_url, 'wpr_dismiss_notice');

      echo '<p style="font-size: 14px;">';
      echo 'If WP Reset helped you please rate it so we can continue supporting it and helping others. Thank you!<br>';
      echo '<a style="margin-top: 5px;" class="button button-secondary" href="https://wordpress.org/support/plugin/wp-reset/reviews/?filter=5#new-post" target="_blank">You deserve it, I\'ll rate it!</a> &nbsp; &nbsp; <a href="' . $dismiss_url . '">I already rated it</a>';
      echo '</p>';
    }

    echo '</div>';
  } // notice_successful_reset


  /**
   * Generate a button that initiates snapshot creation
   *
   * @param string  $tool_id  Tool ID.
   * @param string  $description  Snapshot description.
   *
   * @return string
   */
  function get_snapshot_button($tool_id = '', $description = '')
  {
    $out = '';
    $out .= '<a data-tool-id="' . $tool_id . '" data-description="' . esc_attr($description) . '" class="button create-new-snapshot" href="#">Create snapshot</a>';

    return $out;
  } // get_snapshot_button


  /**
   * Generate card header including title and action buttons
   *
   * @param string  $title  Card title.
   * @param string  $card_id  Card ID.
   * @param bool  $collapse_button  Show collapse button.
   * @param bool  $iot_button  Show index of tools button.
   *
   * @return string
   */
  function get_card_header($title, $card_id, $collapse_button = false, $iot_button = false)
  {
    $out = '';
    $out .= '<h4 id="' . $card_id . '">' . $title;
    $out .= '<div class="card-header-right">';
    if ($iot_button) {
      $out .= '<a class="scrollto" href="#iot" title="Jump to Index of Tools"><span class="dashicons dashicons-screenoptions"></span></a>';
    }
    if ($collapse_button) {
      $out .= '<a class="toggle-card" href="#" title="' . __('Collapse / expand box', 'wp-reset') . '"><span class="dashicons dashicons-arrow-up-alt2"></span></a>';
    }
    $out .= '</div></h4>';

    return $out;
  } // get_card_header


  /**
   * Generate tool icons and description detailing what it modifies
   *
   * @param bool  $modify_files  Does the tool modify files?
   * @param bool  $modify_db  Does the tool modify the database?
   * @param bool  $plural  Is there more than one tool in the set?
   *
   * @return string
   */
  function get_tool_icons($modify_files = false, $modify_db = false, $plural = false)
  {
    $out = '';

    $out .= '<p class="tool-icons">';
    $out .= '<i class="icon-doc-text-inv' . ($modify_files ? ' red' : '') . '"></i> ';
    $out .= '<i class="icon-database' . ($modify_db ? ' red' : '') . '"></i> ';

    if ($plural) {
      if ($modify_files && $modify_db) {
        $out .= 'these tools <b>modify files &amp; the database</b>';
      } elseif (!$modify_files && $modify_db) {
        $out .= 'these tools <b>modify the database</b> but they don\'t modify any files</b>';
      } elseif ($modify_files && !$modify_db) {
        $out .= 'these tools <b>modify files</b> but they don\'t modify the database</b>';
      }
    } else {
      if ($modify_files && $modify_db) {
        $out .= 'this tool <b>modifies files &amp; the database</b>';
      } elseif (!$modify_files && $modify_db) {
        $out .= 'this tool <b>modifies the database</b> but it doesn\'t modify any files</b>';
      } elseif ($modify_files && !$modify_db) {
        $out .= 'this tool <b>modifies files</b> but it doesn\'t modify the database</b>';
      }
    }
    $out .= '</p>';

    return $out;
  } // get_tool_icons


  /**
   * Outputs complete plugin's admin page
   *
   * @return null
   */
  function plugin_page()
  {
    // double check for admin privileges
    if (!current_user_can('administrator')) {
      wp_die(__('Sorry, you are not allowed to access this page.', 'wp-reset'));
    }

    echo '<div class="wrap">';
    echo '<form id="wp_reset_form" action="' . admin_url('tools.php?page=wp-reset') . '" method="post" autocomplete="off">';

    echo '<header>';
    echo '<div class="wpr-container">';
    echo '<img id="logo-icon" src="' . $this->plugin_url . 'img/wp-reset-logo.png" title="' . __('WP Reset', 'wp-reset') . '" alt="' . __('WP Reset', 'wp-reset') . '">';
    echo '</div>';
    echo '</header>';

    echo '<div id="loading-tabs"><img class="rotating" src="' . $this->plugin_url . 'img/wp-reset-icon.png' . '" alt="Loading. Please wait." title="Loading. Please wait."></div>';

    echo '<div id="wp-reset-tabs" class="ui-tabs" style="display: none;">';

    echo '<nav>';
    echo '<div class="wpr-container">';
    echo '<ul class="wpr-main-tab">';
    echo '<li><a href="#tab-reset">' . __('Reset', 'wp-reset') . '</a></li>';
    echo '<li><a href="#tab-tools">' . __('Tools', 'wp-reset') . '</a></li>';
    echo '<li><a href="#tab-snapshots">' . __('Snapshots', 'wp-reset') . '</a></li>';
    echo '<li><a href="#tab-collections">' . __('Collections', 'wp-reset') . '</a></li>';
    echo '<li><a href="#tab-support">' . __('Support', 'wp-reset') . '</a></li>';
    echo '</ul>';
    echo '</div>'; // container
    echo '</nav>';

    echo '<div id="wpr-notifications">';
    echo '<div class="wpr-container">';
    $this->custom_notifications();
    echo '</div>';
    echo '</div>'; // wpr-notifications

    // tabs
    echo '<div class="wpr-container">';
    echo '<div id="wpr-content">';

    echo '<div style="display: none;" id="tab-reset">';
    $this->tab_reset();
    echo '</div>';

    echo '<div style="display: none;" id="tab-tools">';
    $this->tab_tools();
    echo '</div>';

    echo '<div style="display: none;" id="tab-snapshots">';
    $this->tab_snapshots();
    echo '</div>';

    echo '<div style="display: none;" id="tab-collections">';
    $this->tab_collections();
    echo '</div>';

    echo '<div style="display: none;" id="tab-support">';
    $this->tab_support();
    echo '</div>';

    echo '</div>'; // content
    echo '</div>'; // container
    echo '</div>'; // wp-reset-tabs

    echo '</form>';
    echo '</div>'; // wrap

    // survey
    if ($this->is_survey_active('features')) {
      echo '<div id="survey-dialog" style="display: none;" title="Help us make WP Reset better for you"><span class="ui-helper-hidden-accessible"><input type="text"/></span>';
      echo '<p class="subtitle"><b>What new features do you need the most?</b> Choose one or two;</p>';

      $questions = array();
      $questions[] = '<div class="question-wrapper" data-value="backup" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Off-site backups</b><br>' .
        '<i>Backup the site to Dropbox, FTP or Google Drive before using any tools</i></div>' .
        '</div>';

      $questions[] = '<div class="question-wrapper" data-value="wpmu" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>WordPress Network (WPMU) compatibility</b><br>' .
        '<i>Full support &amp; compatibility for all WP Reset tools for all sites in network</i></div>' .
        '</div>';

      $questions[] = '<div class="question-wrapper" data-value="nothing" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Don\'t add anything</b><br>' .
        '<i>WP Reset is perfect as is - I don\'t need any new features</i></div>' .
        '</div>';

      $questions[] = '<div class="question-wrapper" data-value="nuclear" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Nuclear reset - run all tools at once</b><br>' .
        '<i>Besides resetting, delete all files and all other customizations with one click</i></div>' .
        '</div>';

      $questions[] = '<div class="question-wrapper" data-value="plugin-collections" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Install a set of plugins/themes after reset</b><br>' .
        '<i>Save lists of plugins/themes and automatically install them after resetting</i></div>' .
        '</div>';

      $questions[] = '<div class="question-wrapper" data-value="change-wp-ver" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Change WordPress version - rollback or upgrade</b><br>' .
        '<i>Pick a version of WP you need (older or never) and switch to it with one click</i></div>' .
        '</div>';

      shuffle($questions);
      $questions[] = '<div class="question-wrapper" data-value="custom" title="Click to select/unselect answer">' .
        '<span class="dashicons dashicons-yes"></span>' .
        '<div class="question"><b>Something we missed?</b><br><i>Enter the feature you need below;</i>' .
        '<input type="text" class="custom-input"></div>' .
        '</div>';

      echo implode(' ', $questions);

      $current_user = wp_get_current_user();
      echo '<div class="footer">';
      echo '<input id="emailme" type="checkbox" value="' . $current_user->user_email . '"> <label for="emailme">Email me on ' . $current_user->user_email . ' when new features are added. We hate SPAM and never send it.</label><br>';
      echo '<a data-survey="features" class="submit-survey button-primary button button-large" href="#">Add those features ASAP!</a>';
      echo '<a href="#" class="dismiss-survey wpr-dismiss-notice" data-notice="survey-features" data-survey="features"><i>Close the survey and never show it again</i></a>';
      echo '</div>';

      echo '</div>';
    } // survey

    if (!$this->is_webhooks_active()) {
      echo '<div id="webhooks-dialog" style="display: none;" title="Webhooks"><span class="ui-helper-hidden-accessible"><input type="text"/></span>';
      echo '<div style="padding: 20px; font-size: 15px;">';
      echo '<ul class="plain-list">';
      echo '<li>Standard, platform-independant way of connecting WP to any 3rd party system</li>';
      echo '<li>Supports actions - WP receives data on 3rd party events</li>';
      echo '<li>And triggers - WP sends data on its events</li>';
      echo '<li>Works wonders with Zapier</li>';
      echo '<li>Compatible with any WordPress theme or plugin</li>';
      echo '<li>Available from the official <a href="https://wordpress.org/plugins/wp-webhooks/" target="_blank">WP plugins repository</a></li>';
      echo '</ul>';
      echo '<p class="webhooks-footer"><a class="button button-primary" id="install-webhooks">Install WP Webhooks &amp; connect WP to any 3rd party system</a></p>';
      echo '</div>';
      echo '</div>';
    }
  } // plugin_page


  /**
   * Echoes all custom plugin notitications
   *
   * @return null
   */
  private function custom_notifications()
  {
    $notice_shown = false;
    $meta = $this->get_meta();
    $snapshots = $this->get_snapshots();

    // warn that WPR is not WPMU compatible
    if (false === $notice_shown && is_multisite()) {
      echo '<div class="card notice-wrapper notice-error">';
      echo '<h2>' . __('WP Reset is not compatible with multisite!', 'wp-reset') . '</h2>';
      echo '<p>' . __('Please be careful when using WP Reset with multisite enabled. It\'s not recommended to reset the main site. Sub-sites should be OK. We\'re working on making it fully compatible with WP-MU. <b>Till then please be careful.</b> Thank you for understanding.', 'wp-reset') . '</p>';
      echo '</div>';
      $notice_shown = true;
    }

    // ask for review
    if ((!empty($meta['reset_count']) || !empty($snapshots) || current_time('timestamp', true) - $meta['first_install'] > DAY_IN_SECONDS)
      && false === $notice_shown
      && false == $this->get_dismissed_notices('rate')
    ) {
      echo '<div class="card notice-wrapper notice-info">';
      echo '<h2>' . __('Please help us spread the word &amp; keep the plugin up-to-date', 'wp-reset') . '</h2>';
      echo '<p>' . __('If you use &amp; enjoy WP Reset, <b>please rate it on WordPress.org</b>. It only takes a second and helps us keep the plugin maintained. Thank you!', 'wp-reset') . '</p>';
      echo '<p><a class="button-primary button" title="' . __('Rate WP Reset', 'wp-reset') . '" target="_blank" href="https://wordpress.org/support/plugin/wp-reset/reviews/?filter=5#new-post">' . __('Rate the plugin ★★★★★', 'wp-reset') . '</a>  <a href="#" class="wpr-dismiss-notice dismiss-notice-rate" data-notice="rate">' . __('I\'ve already rated it', 'wp-reset') . '</a></p>';
      echo '</div>';
      $notice_shown = true;
    }
  } // custom_notifications


  /**
   * Echoes content for reset tab
   *
   * @return null
   */
  private function tab_reset()
  {
    global $current_user, $wpdb;

    echo '<div class="card" id="card-description">';
    echo '<h4>';
    echo __('Please read carefully before proceeding', 'wp-reset');
    echo '<div class="card-header-right"><a class="toggle-card" href="#" title="' . __('Collapse / expand box', 'wp-reset') . '"><span class="dashicons dashicons-arrow-up-alt2"></span></a></div>';
    echo '</h4>';
    echo '<div class="card-body">';
    echo '<p><b class="red">' . __('Resetting will delete:', 'wp-reset') . '</b></p>';
    echo '<ul class="plain-list">';
    echo '<li>' . __('all posts, pages, custom post types, comments, media entries, users', 'wp-reset') . '</li>';
    echo '<li>' . __('all default WP database tables', 'wp-reset') . '</li>';
    echo '<li>' . sprintf(__('all custom database tables that have the same prefix "%s" as default tables in this installation', 'wp-reset'), $wpdb->prefix) . '</li>';
    echo '<li>' . __('always <a href="#" class="create-new-snapshot">create a snapshot</a> or a full backup, so you can restore it later', 'wp-reset') . '</li>';
    echo '</ul>';

    echo '<p><b class="green">' . __('Resetting will not delete:', 'wp-reset') . '</b></p>';
    echo '<ul class="plain-list">';
    echo '<li>' . __('media files - they\'ll remain in the <i>wp-uploads</i> folder but will no longer be listed under Media', 'wp-reset');
    echo __('; use the <a href="#tool-delete-uploads" data-tab="1" class="change-tab">Clean Uploads Folder</a> tool to remove media files', 'wp-reset') . '</li>';
    echo '<li>' . __('no files are touched; plugins, themes, uploads - everything stays', 'wp-reset');
    echo __('; if needed use the <a href="#tool-delete-themes" class="change-tab" data-tab="1">Delete Themes</a> &amp; <a href="#tool-delete-plugins" class="change-tab" data-tab="1">Delete Plugins</a> tools', 'wp-reset') . '</li>';
    echo '<li>' . __('site title, WordPress address, site address, site language and search engine visibility settings', 'wp-reset') . '</li>';
    echo '<li>' . sprintf(__('logged in user "%s" will be restored with the current password', 'wp-reset'), $current_user->user_login) . '</li>';
    echo '</ul>';

    echo '<p><b>' . __('What happens when I click the Reset button?', 'wp-reset') . '</b></p>';
    echo '<ul class="plain-list">';
    echo '<li>' . __('remember, always <a href="#" class="create-new-snapshot">make a snapshot</a> or a full backup first', 'wp-reset') . '</li>';
    echo '<li>' . __('you will have to confirm the action one more time', 'wp-reset') . '</li>';
    echo '<li>' . __('everything will be reset; see bullets above for details', 'wp-reset') . '</li>';
    echo '<li>' . __('site title, WordPress address, site address, site language, search engine visibility and current user will be restored', 'wp-reset') . '</li>';
    echo '<li>' . __('you will be logged out, automatically logged in and taken to the admin dashboard', 'wp-reset') . '</li>';
    echo '<li>' . __('WP Reset plugin will be reactivated if that option is chosen in the <a href="#card-reset">post-reset options</a>', 'wp-reset') . '</li>';
    echo '</ul>';

    echo '<p><b>' . __('WP-CLI Support', 'wp-reset') . '</b><br>';
    echo '' . sprintf(__('All tools available via GUI are available in WP-CLI as well. To get the list of commands run %s. Instead of the active user, the first user with admin privileges found in the database will be restored. ', 'wp-reset'), '<code>wp help reset</code>');
    echo sprintf(__('All actions have to be confirmed. If you want to skip confirmation use the standard %s option. Please be careful - there is NO UNDO.', 'wp-reset'), '<code>--yes</code>') . '</p>';

    echo '<p><b>' . __('WP Webhooks Support', 'wp-reset') . '</b><br>';
    echo 'All WP Reset tools are integrated with <a href="https://wordpress.org/plugins/wp-webhooks/" target="_blank">WP Webhooks</a> and available as (receive data) actions. Webhooks are a standard, platform-independent way of connecting WordPress to any 3rd party system. This <a href="https://underconstructionpage.com/wp-webhooks-connect-integrate-wordpress/" target="_blank">article</a> has more info, videos and use-cases so you can see just how powerful and easy to use webhooks are.<br>';
    if ($this->is_webhooks_active()) {
      echo 'WP Webhooks are active. Make sure you enable WP Reset actions in <a href="' . admin_url('options-general.php?page=wp-webhooks-pro&wpwhvrs=settings') . '">settings</a>.';
    } else {
      echo '<a href="#" class="open-webhooks-dialog">Install WP Webhooks &amp; WPR addon</a> to automate your workflow, develop faster and connect WordPress to any web app or 3rd party system.';
    }
    echo '</p></div></div>'; // card description

    $theme =  wp_get_theme();

    echo '<div class="card" id="card-reset">';
    echo '<h4>' . __('Site Reset', 'wp-reset');
    echo '<div class="card-header-right"><a class="toggle-card" href="#" title="' . __('Collapse / expand box', 'wp-reset') . '"><span class="dashicons dashicons-arrow-up-alt2"></span></a></div>';
    echo '</h4>';
    echo '<div class="card-body">';
    echo '<p><label for="reactivate-theme"><input name="wpr-post-reset[reactivate_theme]" type="checkbox" id="reactivate-theme" value="1"> ' . __('Reactivate current theme', 'wp-reset') . ' - ' . $theme->get('Name') . '</label></p>';
    echo '<p><label for="reactivate-wpreset"><input name="wpr-post-reset[reactivate_wpreset]" type="checkbox" id="reactivate-wpreset" value="1" checked> ' . __('Reactivate WP Reset plugin', 'wp-reset') . '</label></p>';
    if ($this->is_webhooks_active()) {
      echo '<p><label for="reactivate-webhooks"><input name="wpr-post-reset[reactivate_webhooks]" type="checkbox" id="reactivate-webhooks" value="1" checked> ' . __('Reactivate WP Webhooks plugin', 'wp-reset') . '</label></p>';
    }
    echo '<p><label for="reactivate-plugins"><input name="wpr-post-reset[reactivate_plugins]" type="checkbox" id="reactivate-plugins" value="1"> ' . __('Reactivate all currently active plugins', 'wp-reset') . '</label></p>';
    if ($this->is_webhooks_active()) {
      echo '<p><a href="' . admin_url('options-general.php?page=wp-webhooks-pro&wpwhvrs=settings') . '">Configure WP Webhooks</a> to run additional actions after reset, or connect to any 3rd party system.</p>';
    } else {
      echo '<p>To run additional actions after reset or automate a complex workflow <a href="#" class="open-webhooks-dialog">install WP Webhooks &amp; WPR addon</a>. It\'s a standard, platform-independent way of connecting WordPress to any web app. This <a href="https://www.youtube.com/watch?v=m8XDFXCNP9g" target="_blank">short video</a> explains it well.</p>';
    }
    echo '<p><br>' . __('Type <b>reset</b> in the confirmation field to confirm the reset and then click the "Reset WordPress" button.<br>Always <a href="#" class="create-new-snapshot" data-description="Before resetting the site">create a snapshot</a> before resetting if you want to be able to undo.', 'wp-reset') . '</p>';

    wp_nonce_field('wp-reset');
    echo '<p><input id="wp_reset_confirm" type="text" name="wp_reset_confirm" placeholder="' . esc_attr__('Type in "reset"', 'wp-reset') . '" value="" autocomplete="off"> &nbsp;';
    echo '<a id="wp_reset_submit" class="button button-delete">' . __('Reset Site', 'wp-reset') . '</a>' . $this->get_snapshot_button('reset-wordpress', 'Before resetting the site') . '</p>';
    echo '</div>';
    echo '</div>';
  } // tab_reset


  /**
   * Echoes content for tools tab
   *
   * @return null
   */
  private function tab_tools()
  {
    global $wpdb;

    $tools = array(
      'tool-delete-transients' => 'Delete Transients',
      'tool-delete-uploads' => 'Clean Uploads Folder',
      'tool-reset-theme-options' => 'Reset Theme Options',
      'tool-delete-themes' => 'Delete Themes',
      'tool-delete-plugins' => 'Delete Plugins',
      'tool-empty-delete-custom-tables' => 'Empty or Delete Custom Tables',
      'tool-delete-htaccess' => 'Delete .htaccess File'
    );

    echo '<div class="card">';
    echo $this->get_card_header(__('Index of Tools', 'wp-reset'), 'iot', true, false);
    echo '<div class="card-body">';
    $i = 0;
    $tools_nb = sizeof($tools);
    foreach ($tools as $tool_id => $tool_name) {
      if ($i == 0) {
        echo '<div class="half">';
        echo '<ul class="mb0 plain-list">';
      }
      if ($i == ceil($tools_nb / 2)) {
        echo '</div>';
        echo '<div class="half">';
        echo '<ul class="mb0 plain-list">';
      }

      echo '<li><a title="Jump to ' . $tool_name . ' tool" class="scrollto" href="#' . $tool_id . '">' . $tool_name . '</a></li>';

      if ($i == $tools_nb - 1) {
        echo '</ul>';
        echo '</div>'; // half
      }
      $i++;
    } // foreach tools
    echo '</div>';
    echo '</div>';

    echo '<div class="card">';
    echo $this->get_card_header(__('Delete Transients', 'wp-reset'), 'tool-delete-transients', true, true);
    echo '<div class="card-body">';
    echo '<p>All transient related database entries will be deleted. Including expired and non-expired transients, and orphaned transient timeout entries.<br>Always <a href="#" data-description="Before deleting transients" class="create-new-snapshot">create a snapshot</a> before using this tool if you want to be able to undo its actions.</p>';
    echo $this->get_tool_icons(false, true);
    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to delete all transients?" data-btn-confirm="Delete all transients" data-text-wait="Deleting transients. Please wait." data-text-confirm="All database entries related to transients will be deleted. Always ' . esc_attr('<a data-description="Before deleting transients" href="#" class="create-new-snapshot">create a snapshot</a> if you want to be able to undo') . '." data-text-done="%n transient database entries have been deleted." data-text-done-singular="One transient database entry has been deleted." class="button button-delete" href="#" id="delete-transients">Delete all transients</a>' . $this->get_snapshot_button('delete-transients', 'Before deleting transients') . '</p>';
    echo '</div>';
    echo '</div>';

    $upload_dir = wp_upload_dir(date('Y/m'), true);
    $upload_dir['basedir'] = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $upload_dir['basedir']);

    echo '<div class="card">';
    echo $this->get_card_header(__('Clean Uploads Folder', 'wp-reset'), 'tool-delete-uploads', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('All files in <code>' . $upload_dir['basedir'] . '</code> folder will be deleted. Including folders and subfolders, and files in subfolders. Files associated with <a href="' . admin_url('upload.php') . '">media</a> entries will be deleted too.<br><b>There is NO UNDO. WP Reset does not make any file backups.</b>', 'wp-reset') . '</p>';

    echo $this->get_tool_icons(true, false);

    if (false != $upload_dir['error']) {
      echo '<p class="mb0"><span style="color:#dd3036;"><b>Tool is not available.</b></span> Folder is not writeable by WordPress. Please check file and folder access rights.</p>';
    } else {
      echo '<p class="mb0"><a data-confirm-title="Are you sure you want to delete all files &amp; folders in uploads folder?" data-btn-confirm="Delete everything in uploads folder" data-text-wait="Deleting uploads. Please wait." data-text-confirm="All files and folders in uploads will be deleted. There is NO UNDO. WP Reset does not make any file backups." data-text-done="%n files &amp; folders have been deleted." data-text-done-singular="One file or folder has been deleted." class="button button-delete" href="#" id="delete-uploads">Delete all files &amp; folders in uploads folder</a></p>';
    }
    echo '</div>';
    echo '</div>';

    echo '<div class="card">';
    echo $this->get_card_header(__('Reset Theme Options', 'wp-reset'), 'tool-reset-theme-options', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('All options (mods) for all themes will be reset; not just for the active theme. The tool works only for themes that use the <a href="https://codex.wordpress.org/Theme_Modification_API" target="_blank">WordPress theme modification API</a>. If options are saved in some other, custom way they won\'t be reset.<br> Always <a href="#" class="create-new-snapshot" data-description="Before resetting theme options">create a snapshot</a> before using this tool if you want to be able to undo its actions.', 'wp-reset') . '</p>';
    echo $this->get_tool_icons(false, true);
    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to reset all theme options?" data-btn-confirm="Reset theme options" data-text-wait="Resetting theme options. Please wait." data-text-confirm="All options (mods) for all themes will be reset. Always ' . esc_attr('<a data-description="Before resetting theme options" href="#" class="create-new-snapshot">create a snapshot</a> if you want to be able to undo') . '." data-text-done="Options for %n themes have been reset." data-text-done-singular="Options for one theme have been reset." class="button button-delete" href="#" id="reset-theme-options">Reset theme options</a>' . $this->get_snapshot_button('reset-theme-options', 'Before resetting theme options') . '</p>';
    echo '</div>';
    echo '</div>';

    $theme =  wp_get_theme();

    echo '<div class="card">';
    echo $this->get_card_header(__('Delete Themes', 'wp-reset'), 'tool-delete-themes', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('All themes will be deleted. Including the currently active theme - ' . $theme->get('Name') . '.<br><b>There is NO UNDO. WP Reset does not make any file backups.</b>', 'wp-reset') . '</p>';

    echo $this->get_tool_icons(true, true);

    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to delete all themes?" data-btn-confirm="Delete all themes" data-text-wait="Deleting all themes. Please wait." data-text-confirm="All themes will be deleted. There is NO UNDO. WP Reset does not make any file backups." data-text-done="%n themes have been deleted." data-text-done-singular="One theme has been deleted." class="button button-delete" href="#" id="delete-themes">Delete all themes</a></p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="card">';
    echo $this->get_card_header(__('Delete Plugins', 'wp-reset'), 'tool-delete-plugins', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('All plugins will be deleted except for WP Reset which will remain active.<br><b>There is NO UNDO. WP Reset does not make any file backups.</b>', 'wp-reset') . '</p>';

    echo $this->get_tool_icons(true, true);

    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to delete all plugins?" data-btn-confirm="Delete plugins" data-text-wait="Deleting plugins. Please wait." data-text-confirm="All plugins except WP Reset will be deleted. There is NO UNDO. WP Reset does not make any file backups." data-text-done="%n plugins have been deleted." data-text-done-singular="One plugin has been deleted." class="button button-delete" href="#" id="delete-plugins">Delete plugins</a></p>';
    echo '</div>';
    echo '</div>';

    $custom_tables = $this->get_custom_tables();

    echo '<div class="card">';
    echo $this->get_card_header(__('Empty or Delete Custom Tables', 'wp-reset'), 'tool-empty-delete-custom-tables', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('This action affects only custom tables with <code>' . $wpdb->prefix . '</code> prefix. Core WP tables and other tables in the database that do not have that prefix will not be deleted/emptied. Deleting (dropping) tables completely removes them from the database. Emptying (truncating) removes all content from them, but keeps the structure intact.<br>Always <a href="#" class="create-new-snapshot" data-description="Before deleting custom tables">create a snapshot</a> before using this tool if you want to be able to undo its actions.</p>', 'wp-reset');
    if ($custom_tables) {
      echo '<p>' . __('The following ' . sizeof($custom_tables) . ' custom tables are affected by this tool: ');
      foreach ($custom_tables as $tbl) {
        echo '<code>' . $tbl['name'] . '</code>';
        if (next($custom_tables)) {
          echo ', ';
        }
      } // foreach
      echo '.</p>';
      $custom_tables_btns = '';
    } else {
      echo '<p>' . __('There are no custom tables. There\'s nothing for this tool to empty or delete.', 'wp-reset') . '</p>';
      $custom_tables_btns = ' disabled';
    }

    echo $this->get_tool_icons(false, true, true);

    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to empty all custom tables?" data-btn-confirm="Empty custom tables" data-text-wait="Emptying custom tables. Please wait." data-text-confirm="All custom tables with prefix <code>' . $wpdb->prefix . '</code> will be emptied. Always ' . esc_attr('<a href="#" class="create-new-snapshot" data-description="Before emptying custom tables">create a snapshot</a> if you want to be able to undo') . '." data-text-done="%n custom tables have been emptied." data-text-done-singular="One custom table has been emptied." class="button button-delete' . $custom_tables_btns . '" href="#" id="truncate-custom-tables">Empty (truncate) custom tables</a>';
    echo '<a data-confirm-title="Are you sure you want to delete all custom tables?" data-btn-confirm="Delete custom tables" data-text-wait="Deleting custom tables. Please wait." data-text-confirm="All custom tables with prefix <code>' . $wpdb->prefix . '</code> will be deleted. Always ' . esc_attr('<a href="#" class="create-new-snapshot" data-description="Before deleting custom tables">create a snapshot</a> if you want to be able to undo') . '." data-text-done="%n custom tables have been deleted." data-text-done-singular="One custom table has been deleted." class="button button-delete' . $custom_tables_btns . '" href="#" id="drop-custom-tables">Delete (drop) custom tables</a>' . $this->get_snapshot_button('drop-custom-tables', 'Before deleting custom tables') . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="card">';
    echo $this->get_card_header(__('Delete .htaccess File', 'wp-reset'), 'tool-delete-htaccess', true, true);
    echo '<div class="card-body">';
    echo '<p>' . __('This action deletes the .htaccess file located in <code>' . $this->get_htaccess_path() . '</code><br><b>There is NO UNDO. WP Reset does not make any file backups.</b></p>', 'wp-reset');

    echo '<p>If you need to edit .htaccess, install our free <a href="' . admin_url('plugin-install.php?tab=plugin-information&plugin=wp-htaccess-editor&TB_iframe=true&width=600&height=550') . '" class="thickbox open-plugin-details-modal">WP Htaccess Editor</a> plugin. It automatically creates backups when you edit .htaccess as well as checks for syntax errors. To create the default .htaccess file open <a href="' . admin_url('options-permalink.php') . '">Settings - Permalinks</a> and re-save settings. WordPress will recreate the file.</p>';

    echo $this->get_tool_icons(true, false);

    echo '<p class="mb0"><a data-confirm-title="Are you sure you want to delete the .htaccess file?" data-btn-confirm="Delete .htaccess file" data-text-wait="Deleting .htaccess file. Please wait." data-text-confirm="Htaccess file will be deleted. There is NO UNDO. WP Reset does not make any file backups." data-text-done="Htaccess file has been deleted." data-text-done-singular="Htaccess file has been deleted." class="button button-delete" href="#" id="delete-htaccess">Delete .htaccess file</a></p>';

    echo '</div>';
    echo '</div>';
  } // tab_tools


  /**
   * Echoes content for collections tab
   *
   * @return null
   */
  private function tab_collections()
  {
    echo '<div class="card">';
    echo '<h4>' . __('What are Plugin &amp; Theme Collections?', 'wp-reset') . '</h4>';
    echo '<p>' . __('A tool that\'s coming with WP Reset PRO that will <b>save hours &amp; hours of your precious time</b>! Have a set of plugins (and themes) that you install and activate after every reset? Or on every fresh WP installation? Well, no more clicking install &amp; active for ten minutes! Build the collection once and install it with one click as many times as needed.<br>WP Reset stores collections in the cloud so they\'re accessible on every site you build. You can use free plugins and themes from the official repo, and PRO ones by uploading a ZIP file. We\'ll safely store your license keys too, so you have everything in one place.', 'wp-reset') . '</p>';
    echo '<p class="textcenter"><a class="button button-primary" href="https://wpreset.com/ltd-sale-martech-wise/" target="_blank"><b>Reserve your copy of WP Reset PRO! It launches on January 13th!</b></a></p>';
    echo '</div>';
  } // tab_collections


  /**
   * Echoes content for support tab
   *
   * @return null
   */
  private function tab_support()
  {
    echo '<div class="card">';
    echo '<h4>' . __('Documentation', 'wp-reset') . '</h4>';
    echo '<p>' . __('All tools and functions are explained in detail in <a href="' . $this->generate_web_link('support-tab', '/documentation/') . '" target="_blank">the documentation</a>. We did our best to describe how things work on both the code level and an "average user" level.', 'wp-reset') . '</p>';
    echo '</div>';

    echo '<div class="card">';
    echo '<h4>' . __('Public support forum', 'wp-reset') . '</h4>';
    echo '<p>' . __('We are very active on the <a href="https://wordpress.org/support/plugin/wp-reset" target="_blank">official WP Reset support forum</a>. If you found a bug, have a feature idea or just want to say hi - please drop by. We love to hear back from our users.', 'wp-reset') . '</p>';
    echo '</div>';

    echo '<div class="card">';
    echo '<h4>' . __('Care to help out?', 'wp-reset') . '</h4>';
    echo '<p>' . __('No need for donations or anything like that :) If you can give us a <a href="https://wordpress.org/support/plugin/wp-reset/reviews/#new-post" target="_blank">five star rating</a> you\'ll help out more than you can imagine. A public mention <a href="https://twitter.com/webfactoryltd" target="_blank">@webfactoryltd</a> also does wonders. Thank you!', 'wp-reset') . '</p>';
    echo '</div>';
  } // tab_support


  /**
   * Echoes content for snapshots tab
   *
   * @return null
   */
  private function tab_snapshots()
  {
    global $wpdb;
    $tbl_core = $tbl_custom = $tbl_size = $tbl_rows = 0;

    echo '<div class="card" id="card-snapshots">';
    echo '<h4>';
    echo __('Snapshots', 'wp-reset');
    echo '<div class="card-header-right"><a class="toggle-card" href="#" title="' . __('Collapse / expand box', 'wp-reset') . '"><span class="dashicons dashicons-arrow-up-alt2"></span></a></div>';
    echo '</h4>';
    echo '<div class="card-body">';
    echo '<p>A snapshot is a copy of all WP database tables, standard and custom ones, saved in your database. Files are not saved or included in snapshots in any way. <a href="https://www.youtube.com/watch?v=xBfMmS12vMY" target="_blank">Watch a short video</a> overview and tutorial about Snapshots.</p>';
    echo '<p>Snapshots are primarily a development tool. When using various reset tools that alter the database be sure to create a snapshot. Shortcuts are available in the confirmation dialog. If you need a full backup that includes files, use a dedicated <a target="_blank" href="' . admin_url('plugin-install.php?s=backup&tab=search&type=term') . '">backup plugin</a>.</p>';
    echo '<p>Use snapshots to find out what changes a plugin made to your database or to quickly restore the dev environment after testing database related changes. Restoring a snapshot does not affect other snapshots, or WP Reset settings.</p>';

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    if (is_array($table_status)) {
      foreach ($table_status as $index => $table) {
        if (0 !== stripos($table->Name, $wpdb->prefix)) {
          continue;
        }
        if (empty($table->Engine)) {
          continue;
        }

        $tbl_rows += $table->Rows;
        $tbl_size += $table->Data_length + $table->Index_length;
        if (in_array($table->Name, $this->core_tables)) {
          $tbl_core++;
        } else {
          $tbl_custom++;
        }
      } // foreach

      echo '<p><b>Currently used WordPress tables</b>, prefixed with <i>' . $wpdb->prefix . '</i>, consist of ' . $tbl_core . ' standard and ';
      if ($tbl_custom) {
        echo $tbl_custom . ' custom table' . ($tbl_custom == 1 ? '' : 's');
      } else {
        echo 'no custom tables';
      }
      echo ' totaling ' . $this->format_size($tbl_size) . ' in ' . number_format($tbl_rows) . ' rows.</p>';
    }

    echo '';
    echo '</div>';
    echo '</div>';

    echo '<div class="card">';
    echo '<h4>';
    echo __('Snapshots', 'wp-reset');
    echo '<div class="card-header-right"><a id="create-new-snapshot-primary" data-msg-success="Snapshot created!" data-msg-wait="Creating snapshot. Please wait." data-btn-confirm="Create snapshot" data-placeholder="Snapshot name or brief description, ie: before plugin install" data-text="Enter snapshot name or brief description, up to 64 characters." data-title="Create a new snapshot" title="Create a new database snapshot" href="#" class="button button-primary create-new-snapshot">' . __('Create Snapshot', 'wp-reset') . '</a></div>';
    echo '</h4>';

    if ($snapshots = $this->get_snapshots()) {
      $snapshots = array_reverse($snapshots);
      echo '<table id="wpr-snapshots">';
      echo '<tr><th>Date</th><th>Description</th><th class="ss-actions">&nbsp;</th></tr>';
      foreach ($snapshots as $ss) {
        echo '<tr id="wpr-ss-' . $ss['uid'] . '">';
        if (!empty($ss['name'])) {
          $name = $ss['name'];
        } else {
          $name = 'created on ' . date(get_option('date_format'), strtotime($ss['timestamp'])) . ' @ ' . date(get_option('time_format'), strtotime($ss['timestamp']));
        }

        echo '<td>';
        if (current_time('timestamp') - strtotime($ss['timestamp']) > 12 * HOUR_IN_SECONDS) {
          echo date(get_option('date_format'), strtotime($ss['timestamp'])) . '<br>@ ' . date(get_option('time_format'), strtotime($ss['timestamp']));
        } else {
          echo human_time_diff(strtotime($ss['timestamp']), current_time('timestamp')) . ' ago';
        }
        echo '</td>';
        //echo '<td title="Created on ' . date(get_option('date_format'), strtotime($ss['timestamp'])) . ' @ ' . date(get_option('time_format'), strtotime($ss['timestamp'])) . '">' . '' . date(get_option('date_format'), strtotime($ss['timestamp'])) . '<br>@ ' . date(get_option('time_format'), strtotime($ss['timestamp'])) . '</td>';

        echo '<td>';
        if (!empty($ss['name'])) {
          echo '<b>' . $ss['name'] . '</b><br>';
        }
        echo $ss['tbl_core'] . ' standard &amp; ';
        if ($ss['tbl_custom']) {
          echo $ss['tbl_custom'] . ' custom table' . ($ss['tbl_custom'] == 1 ? '' : 's');
        } else {
          echo 'no custom tables';
        }
        echo ' totaling ' . $this->format_size($ss['tbl_size']) . ' in ' . number_format($ss['tbl_rows']) . ' rows</td>';
        echo '<td>';
        echo '<div class="dropdown">
        <a class="button dropdown-toggle" href="#">Actions</a>
        <div class="dropdown-menu">';
        echo '<a data-title="Current DB tables compared to snapshot %s" data-wait-msg="Comparing. Please wait." data-name="' . $name . '" title="Compare snapshot to current database tables" href="#" class="ss-action compare-snapshot dropdown-item" data-ss-uid="' . $ss['uid'] . '">Compare snapshot to current data</a>';
        echo '<a data-btn-confirm="Restore snapshot" data-text-wait="Restoring snapshot. Please wait." data-text-confirm="Are you sure you want to restore the selected snapshot? There is NO UNDO.<br>Restoring the snapshot will delete all current standard and custom tables and replace them with tables from the snapshot." data-text-done="Snapshot has been restored. Click OK to reload the page with new data." title="Restore snapshot by overwriting current database tables" href="#" class="ss-action restore-snapshot dropdown-item" data-ss-uid="' . $ss['uid'] . '">Restore snapshot</a>';
        echo '<a data-success-msg="Snapshot export created!<br><a href=\'%s\'>Download it</a>" data-wait-msg="Exporting snapshot. Please wait." title="Download snapshot as gzipped SQL dump" href="#" class="ss-action download-snapshot dropdown-item" data-ss-uid="' . $ss['uid'] . '">Download snapshot</a>';
        echo '<a data-btn-confirm="Delete snapshot" data-text-wait="Deleting snapshot. Please wait." data-text-confirm="Are you sure you want to delete the selected snapshot and all its data? There is NO UNDO.<br>Deleting the snapshot will not affect the active database tables in any way." data-text-done="Snapshot has been deleted." title="Permanently delete snapshot" href="#" class="ss-action delete-snapshot dropdown-item" data-ss-uid="' . $ss['uid'] . '">Delete snapshot</a></div></div></td>';
        echo '</tr>';
      } // foreach
      echo '</table>';
      echo '<p id="ss-no-snapshots" class="hidden">There are no saved snapshots. <a href="#" class="create-new-snapshot">Create a new snapshot.</a></p>';
    } else {
      echo '<p id="ss-no-snapshots">There are no saved snapshots. <a href="#" class="create-new-snapshot">Create a new snapshot.</a></p>';
    }

    echo '</div>';
  } // tab_snapshots


  /**
   * Helper function for generating UTM tagged links
   *
   * @param string  $placement  Optional. UTM content param.
   * @param string  $page       Optional. Page to link to.
   * @param array   $params     Optional. Extra URL params.
   * @param string  $anchor     Optional. URL anchor part.
   *
   * @return string
   */
  function generate_web_link($placement = '', $page = '/', $params = array(), $anchor = '')
  {
    $base_url = 'https://wpreset.com';

    if ('/' != $page) {
      $page = '/' . trim($page, '/') . '/';
    }
    if ($page == '//') {
      $page = '/';
    }

    $parts = array_merge(array('utm_source' => 'wp-reset-free', 'utm_medium' => 'plugin', 'utm_content' => $placement, 'utm_campaign' => 'wp-reset-free-v' . $this->version), $params);

    if (!empty($anchor)) {
      $anchor = '#' . trim($anchor, '#');
    }

    $out = $base_url . $page . '?' . http_build_query($parts, '', '&amp;') . $anchor;

    return $out;
  } // generate_web_link


  /**
   * Returns all saved snapshots from DB
   *
   * @return array
   */
  function get_snapshots()
  {
    $snapshots = get_option('wp-reset-snapshots', array());

    return $snapshots;
  } // get_snapshots


  /**
   * Returns all custom table names, with prefix
   *
   * @return array
   */
  function get_custom_tables()
  {
    global $wpdb;
    $custom_tables = array();

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    if (is_array($table_status)) {
      foreach ($table_status as $index => $table) {
        if (0 !== stripos($table->Name, $wpdb->prefix)) {
          continue;
        }
        if (empty($table->Engine)) {
          continue;
        }

        if (false === in_array($table->Name, $this->core_tables)) {
          $custom_tables[] = array('name' => $table->Name, 'rows' => $table->Rows, 'data_length' => $table->Data_length, 'index_length' => $table->Index_length);
        }
      } // foreach
    }

    return $custom_tables;
  } // get_custom tables


  /**
   * Format file size to human readable string
   *
   * @param int  $bytes  Size in bytes to format.
   *
   * @return string
   */
  function format_size($bytes)
  {
    if ($bytes > 1073741824) {
      return number_format_i18n($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes > 1048576) {
      return number_format_i18n($bytes / 1048576, 1) . ' MB';
    } elseif ($bytes > 1024) {
      return number_format_i18n($bytes / 1024, 1) . ' KB';
    } else {
      return number_format_i18n($bytes, 0) . ' bytes';
    }
  } // format_size


  /**
   * Creates snapshot of current tables by copying them in the DB and saving metadata.
   *
   * @param int  $name  Optional. Name for the new snapshot.
   *
   * @return array|WP_Error Snapshot details in array on success, or error object on fail.
   */
  function do_create_snapshot($name = '')
  {
    global $wpdb;
    $snapshots = $this->get_snapshots();
    $snapshot = array();
    $uid = $this->generate_snapshot_uid();
    $tbl_core = $tbl_custom = $tbl_size = $tbl_rows = 0;

    if (!$uid) {
      return new WP_Error(1, 'Unable to generate a valid snapshot UID.');
    }

    if ($name) {
      $snapshot['name'] = substr(trim($name), 0, 64);
    } else {
      $snapshot['name'] = '';
    }
    $snapshot['uid'] = $uid;
    $snapshot['timestamp'] = current_time('mysql');

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    if (is_array($table_status)) {
      foreach ($table_status as $index => $table) {
        if (0 !== stripos($table->Name, $wpdb->prefix)) {
          continue;
        }
        if (empty($table->Engine)) {
          continue;
        }

        $tbl_rows += $table->Rows;
        $tbl_size += $table->Data_length + $table->Index_length;
        if (in_array($table->Name, $this->core_tables)) {
          $tbl_core++;
        } else {
          $tbl_custom++;
        }

        $wpdb->query('OPTIMIZE TABLE ' . $table->Name);
        $wpdb->query('CREATE TABLE ' . $uid . '_' . $table->Name . ' LIKE ' . $table->Name);
        $wpdb->query('INSERT ' . $uid . '_' . $table->Name . ' SELECT * FROM ' . $table->Name);
      } // foreach
    } else {
      return new WP_Error(1, 'Can\'t get table status data.');
    }

    $snapshot['tbl_core']   = $tbl_core;
    $snapshot['tbl_custom'] = $tbl_custom;
    $snapshot['tbl_rows']   = $tbl_rows;
    $snapshot['tbl_size']   = $tbl_size;


    $snapshots[$uid] = $snapshot;
    update_option('wp-reset-snapshots', $snapshots);

    do_action('wp_reset_create_snapshot', $uid, $snapshot);

    return $snapshot;
  } // create_snapshot


  /**
   * Delete snapshot metadata and tables from DB
   *
   * @param string  $uid  Snapshot unique 6-char ID.
   *
   * @return bool|WP_Error True on success, or error object on fail.
   */
  function do_delete_snapshot($uid = '')
  {
    global $wpdb;
    $snapshots = $this->get_snapshots();

    if (strlen($uid) != 6) {
      return new WP_Error(1, 'Invalid UID format.');
    }

    if (!isset($snapshots[$uid])) {
      return new WP_Error(1, 'Unknown snapshot ID.');
    }

    $tables = $wpdb->get_col($wpdb->prepare('SHOW TABLES LIKE %s', array($uid . '\_%')));
    foreach ($tables as $table) {
      $wpdb->query('DROP TABLE IF EXISTS ' . $table);
    }

    $snapshot_copy = $snapshots[$uid];
    unset($snapshots[$uid]);
    update_option('wp-reset-snapshots', $snapshots);

    do_action('wp_reset_delete_snapshot', $uid, $snapshot_copy);

    return true;
  } // delete_snapshot


  /**
   * Exports snapshot as SQL dump; saved in gzipped file in WP_CONTENT folder.
   *
   * @param string  $uid  Snapshot unique 6-char ID.
   *
   * @return string|WP_Error Export base filename, or error object on fail.
   */
  function do_export_snapshot($uid = '')
  {
    $snapshots = $this->get_snapshots();

    if (strlen($uid) != 6) {
      return new WP_Error(1, 'Invalid snapshot ID format.');
    }

    if (!isset($snapshots[$uid])) {
      return new WP_Error(1, 'Unknown snapshot ID.');
    }

    require_once $this->plugin_dir . 'libs/dumper.php';

    try {
      $world_dumper = WPR_Shuttle_Dumper::create(array(
        'host' =>     DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASSWORD,
        'db_name' =>  DB_NAME,
      ));

      $folder = wp_mkdir_p(trailingslashit(WP_CONTENT_DIR) . $this->snapshots_folder);
      if (!$folder) {
        return new WP_Error(1, 'Unable to create wp-content/' . $this->snapshots_folder . '/ folder.');
      }

      $htaccess_content = 'AddType application/octet-stream .gz' . PHP_EOL;
      $htaccess_content .= 'Options -Indexes' . PHP_EOL;
      $htaccess_file = @fopen(trailingslashit(WP_CONTENT_DIR) . $this->snapshots_folder . '/.htaccess', 'w');
      if ($htaccess_file) {
        fputs($htaccess_file, $htaccess_content);
        fclose($htaccess_file);
      }

      $world_dumper->dump(trailingslashit(WP_CONTENT_DIR) . $this->snapshots_folder . '/wp-reset-snapshot-' . $uid . '.sql.gz', $uid . '_');
    } catch (Shuttle_Exception $e) {
      return new WP_Error(1, 'Couldn\'t create snapshot: ' . $e->getMessage());
    }

    do_action('wp_reset_export_snapshot', 'wp-reset-snapshot-' . $uid . '.sql.gz');

    return 'wp-reset-snapshot-' . $uid . '.sql.gz';
  } // export_snapshot


  /**
   * Replace current tables with ones in snapshot.
   *
   * @param string  $uid  Snapshot unique 6-char ID.
   *
   * @return bool|WP_Error True on success, or error object on fail.
   */
  function do_restore_snapshot($uid = '')
  {
    global $wpdb;
    $new_tables = array();
    $snapshots = $this->get_snapshots();

    if (($res = $this->verify_snapshot_integrity($uid)) !== true) {
      return $res;
    }

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    if (is_array($table_status)) {
      foreach ($table_status as $index => $table) {
        if (0 !== stripos($table->Name, $uid . '_')) {
          continue;
        }
        if (empty($table->Engine)) {
          continue;
        }

        $new_tables[] = $table->Name;
      } // foreach
    } else {
      return new WP_Error(1, 'Can\'t get table status data.');
    }

    foreach ($table_status as $index => $table) {
      if (0 !== stripos($table->Name, $wpdb->prefix)) {
        continue;
      }
      if (empty($table->Engine)) {
        continue;
      }

      $wpdb->query('DROP TABLE ' . $table->Name);
    } // foreach

    // copy snapshot tables to original name
    foreach ($new_tables as $table) {
      $new_name = str_replace($uid . '_', '', $table);

      $wpdb->query('CREATE TABLE ' . $new_name . ' LIKE ' . $table);
      $wpdb->query('INSERT ' . $new_name . ' SELECT * FROM ' . $table);
    }

    wp_cache_flush();
    update_option('wp-reset', $this->options);
    update_option('wp-reset-snapshots', $snapshots);

    do_action('wp_reset_restore_snapshot', $uid);

    return true;
  } // restore_snapshot


  /**
   * Verifies snapshot integrity by comparing metadata and data in DB
   *
   * @param string  $uid  Snapshot unique 6-char ID.
   *
   * @return bool|WP_Error True on success, or error object on fail.
   */
  function verify_snapshot_integrity($uid)
  {
    global $wpdb;
    $tbl_core = $tbl_custom = 0;
    $snapshots = $this->get_snapshots();

    if (strlen($uid) != 6) {
      return new WP_Error(1, 'Invalid snapshot ID format.');
    }

    if (!isset($snapshots[$uid])) {
      return new WP_Error(1, 'Unknown snapshot ID.');
    }

    $snapshot = $snapshots[$uid];

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    if (is_array($table_status)) {
      foreach ($table_status as $index => $table) {
        if (0 !== stripos($table->Name, $uid . '_')) {
          continue;
        }
        if (empty($table->Engine)) {
          continue;
        }

        if (in_array(str_replace($uid . '_', '', $table->Name), $this->core_tables)) {
          $tbl_core++;
        } else {
          $tbl_custom++;
        }
      } // foreach

      if ($tbl_core != $snapshot['tbl_core'] || $tbl_custom != $snapshot['tbl_custom']) {
        return new WP_Error(1, 'Snapshot data has been compromised. Saved metadata does not match data in the DB. Contact WP Reset support if data is critical, or restore it via a MySQL GUI.');
      }
    } else {
      return new WP_Error(1, 'Can\'t get table status data.');
    }

    return true;
  } // verify_snapshot_integrity


  /**
   * Compares a selected snapshot with the current table set in DB
   *
   * @param string  $uid  Snapshot unique 6-char ID.
   *
   * @return string|WP_Error Formatted table with details on success, or error object on fail.
   */
  function do_compare_snapshots($uid)
  {
    global $wpdb;
    $current = $snapshot = array();
    $out = $out2 = $out3 = '';

    if (($res = $this->verify_snapshot_integrity($uid)) !== true) {
      return $res;
    }

    $table_status = $wpdb->get_results('SHOW TABLE STATUS');
    foreach ($table_status as $index => $table) {
      if (empty($table->Engine)) {
        continue;
      }

      if (0 !== stripos($table->Name, $uid . '_') && 0 !== stripos($table->Name, $wpdb->prefix)) {
        continue;
      }

      $info = array();
      $info['rows'] = $table->Rows;
      $info['size_data'] = $table->Data_length;
      $info['size_index'] = $table->Index_length;
      $schema = $wpdb->get_row('SHOW CREATE TABLE ' . $table->Name, ARRAY_N);
      $info['schema'] = $schema[1];
      $info['engine'] = $table->Engine;
      $info['fullname'] = $table->Name;
      $basename = str_replace(array($uid . '_'), array(''), $table->Name);
      $info['basename'] = $basename;
      $info['corename'] = str_replace(array($wpdb->prefix), array(''), $basename);
      $info['uid'] = $uid;

      if (0 === stripos($table->Name, $uid . '_')) {
        $snapshot[$basename] = $info;
      }

      if (0 === stripos($table->Name, $wpdb->prefix)) {
        $info['uid'] = '';
        $current[$basename] = $info;
      }
    } // foreach

    $in_both = array_keys(array_intersect_key($current, $snapshot));
    $in_current_only = array_diff_key($current, $snapshot);
    $in_snapshot_only = array_diff_key($snapshot, $current);

    $out .= '<br><br>';
    foreach ($in_current_only as $table) {
      $out .= '<div class="wpr-table-container in-current-only" data-table="' . $table['basename'] . '">';
      $out .= '<table>';
      $out .= '<tr title="Click to show/hide more info" class="wpr-table-missing header-row">';
      $out .= '<td><b>' . $table['fullname'] . '</b></td>';
      $out .= '<td>table is not present in snapshot<span class="dashicons dashicons-arrow-down-alt2"></span></td>';
      $out .= '</tr>';
      $out .= '<tr class="hidden">';
      $out .= '<td>';
      $out .= '<p>' . number_format($table['rows']) . ' row' . ($table['rows'] == 1 ? '' : 's') . ' totaling ' . $this->format_size($table['size_data']) . ' in data and ' . $this->format_size($table['size_index']) . ' in index.</p>';
      $out .= '<pre>' . $table['schema'] . '</pre>';
      $out .= '</td>';
      $out .= '<td>&nbsp;</td>';
      $out .= '</tr>';
      $out .= '</table>';
      $out .= '</div>';
    } // foreach in current only

    foreach ($in_snapshot_only as $table) {
      $out .= '<div class="wpr-table-container in-snapshot-only" data-table="' . $table['basename'] . '">';
      $out .= '<table>';
      $out .= '<tr title="Click to show/hide more info" class="wpr-table-missing header-row">';
      $out .= '<td>table is not present in current tables</td>';
      $out .= '<td><b>' . $table['fullname'] . '</b><span class="dashicons dashicons-arrow-down-alt2"></span></td>';
      $out .= '</tr>';
      $out .= '<tr class="hidden">';
      $out .= '<td>&nbsp;</td>';
      $out .= '<td>';
      $out .= '<p>' . number_format($table['rows']) . ' row' . ($table['rows'] == 1 ? '' : 's') . ' totaling ' . $this->format_size($table['size_data']) . ' in data and ' . $this->format_size($table['size_index']) . ' in index.</p>';
      $out .= '<pre>' . $table['schema'] . '</pre>';
      $out .= '</td>';
      $out .= '</tr>';
      $out .= '</table>';
      $out .= '</div>';
    } // foreach in snapshot only

    foreach ($in_both as $tablename) {
      $tbl_current = $current[$tablename];
      $tbl_snapshot = $snapshot[$tablename];

      $schema1 = preg_replace('/(auto_increment=)([0-9]*) /i', '${1}1 ', $tbl_current['schema'], 1);
      $schema2 = preg_replace('/(auto_increment=)([0-9]*) /i', '${1}1 ', $tbl_snapshot['schema'], 1);
      $tbl_snapshot['tmp_schema'] = str_replace($tbl_snapshot['uid'] . '_' . $tablename, $tablename, $tbl_snapshot['schema']);
      $schema2 = str_replace($tbl_snapshot['uid'] . '_' . $tablename, $tablename, $schema2);

      if ($tbl_current['rows'] == $tbl_snapshot['rows'] && $tbl_current['schema'] == $tbl_snapshot['tmp_schema']) {
        $out3 .= '<div class="wpr-table-container identical" data-table="' . $tablename . '">';
        $out3 .= '<table>';
        $out3 .= '<tr title="Click to show/hide more info" class="wpr-table-match header-row">';
        $out3 .= '<td><b>' . $tbl_current['fullname'] . '</b></td>';
        $out3 .= '<td><b>' . $tbl_snapshot['fullname'] . '</b><span class="dashicons dashicons-arrow-down-alt2"></span></td>';
        $out3 .= '</tr>';
        $out3 .= '<tr class="hidden">';
        $out3 .= '<td>';
        $out3 .= '<p>' . number_format($tbl_current['rows']) . ' rows totaling ' . $this->format_size($tbl_current['size_data']) . ' in data and ' . $this->format_size($tbl_current['size_index']) . ' in index.</p>';
        $out3 .= '<pre>' . $tbl_current['schema'] . '</pre>';
        $out3 .= '</td>';
        $out3 .= '<td>';
        $out3 .= '<p>' . number_format($tbl_snapshot['rows']) . ' rows totaling ' . $this->format_size($tbl_snapshot['size_data']) . ' in data and ' . $this->format_size($tbl_snapshot['size_index']) . ' in index.</p>';
        $out3 .= '<pre>' . $tbl_snapshot['schema'] . '</pre>';
        $out3 .= '</td>';
        $out3 .= '</tr>';
        $out3 .= '</table>';
        $out3 .= '</div>';
      } elseif ($schema1 != $schema2) {
        require_once $this->plugin_dir . 'libs/diff.php';
        require_once $this->plugin_dir . 'libs/diff/Renderer/Html/SideBySide.php';
        $diff = new WPR_Diff(explode("\n", $tbl_current['schema']), explode("\n", $tbl_snapshot['schema']), array('ignoreWhitespace' => false));
        $renderer = new WPR_Diff_Renderer_Html_SideBySide;

        $out2 .= '<div class="wpr-table-container" data-table="' . $tbl_current['basename'] . '">';
        $out2 .= '<table>';
        $out2 .= '<tr title="Click to show/hide more info" class="wpr-table-difference header-row">';
        $out2 .= '<td><b>' . $tbl_current['fullname'] . '</b> table schemas do not match</td>';
        $out2 .= '<td><b>' . $tbl_snapshot['fullname'] . '</b> table schemas do not match<span class="dashicons dashicons-arrow-down-alt2"></span></td>';
        $out2 .= '</tr>';
        $out2 .= '<tr class="hidden">';
        $out2 .= '<td>';
        $out2 .= '<p>' . number_format($tbl_current['rows']) . ' rows totaling ' . $this->format_size($tbl_current['size_data']) . ' in data and ' . $this->format_size($tbl_current['size_index']) . ' in index.</p>';
        $out2 .= '</td>';
        $out2 .= '<td>';
        $out2 .= '<p>' . number_format($tbl_snapshot['rows']) . ' rows totaling ' . $this->format_size($tbl_snapshot['size_data']) . ' in data and ' . $this->format_size($tbl_snapshot['size_index']) . ' in index.</p>';
        $out2 .= '</td>';
        $out2 .= '</tr>';
        $out2 .= '<tr class="hidden">';
        $out2 .= '<td colspan="2" class="no-padding">';
        $out2 .= $diff->Render($renderer);
        $out2 .= '</td>';
        $out2 .= '</tr>';
        $out2 .= '</table>';
        $out2 .= '</div>';
      } else {
        $out2 .= '<div class="wpr-table-container" data-table="' . $tbl_current['basename'] . '">';
        $out2 .= '<table>';
        $out2 .= '<tr title="Click to show/hide more info" class="wpr-table-difference header-row">';
        $out2 .= '<td><b>' . $tbl_current['fullname'] . '</b> data in tables does not match</td>';
        $out2 .= '<td><b>' . $tbl_snapshot['fullname'] . '</b> data in tables does not match<span class="dashicons dashicons-arrow-down-alt2"></span></td>';
        $out2 .= '</tr>';
        $out2 .= '<tr class="hidden">';
        $out2 .= '<td>';
        $out2 .= '<p>' . number_format($tbl_current['rows']) . ' rows totaling ' . $this->format_size($tbl_current['size_data']) . ' in data and ' . $this->format_size($tbl_current['size_index']) . ' in index.</p>';
        $out2 .= '</td>';
        $out2 .= '<td>';
        $out2 .= '<p>' . number_format($tbl_snapshot['rows']) . ' rows totaling ' . $this->format_size($tbl_snapshot['size_data']) . ' in data and ' . $this->format_size($tbl_snapshot['size_index']) . ' in index.</p>';
        $out2 .= '</td>';
        $out2 .= '</tr>';

        $out2 .= '<tr class="hidden">';
        $out2 .= '<td colspan="2">';
        if ($tbl_current['corename'] == 'options') {
          $ss_prefix = $tbl_snapshot['uid'] . '_' . $wpdb->prefix;
          $diff_rows = $wpdb->get_results("SELECT {$wpdb->prefix}options.option_name, {$wpdb->prefix}options.option_value AS current_value, {$ss_prefix}options.option_value AS snapshot_value FROM {$wpdb->prefix}options LEFT JOIN {$ss_prefix}options ON {$ss_prefix}options.option_name = {$wpdb->prefix}options.option_name WHERE {$wpdb->prefix}options.option_value != {$ss_prefix}options.option_value LIMIT 100;");
          $only_current = $wpdb->get_results("SELECT {$wpdb->prefix}options.option_name, {$wpdb->prefix}options.option_value AS current_value, {$ss_prefix}options.option_value AS snapshot_value FROM {$wpdb->prefix}options LEFT JOIN {$ss_prefix}options ON {$ss_prefix}options.option_name = {$wpdb->prefix}options.option_name WHERE {$ss_prefix}options.option_value IS NULL LIMIT 100;");
          $only_snapshot = $wpdb->get_results("SELECT {$wpdb->prefix}options.option_name, {$wpdb->prefix}options.option_value AS current_value, {$ss_prefix}options.option_value AS snapshot_value FROM {$wpdb->prefix}options LEFT JOIN {$ss_prefix}options ON {$ss_prefix}options.option_name = {$wpdb->prefix}options.option_name WHERE {$wpdb->prefix}options.option_value IS NULL LIMIT 100;");
          $out2 .= '<table class="table_diff">';
          $out2 .= '<tr><td style="width: 100px;"><b>Option Name</b></td><td><b>Current Value</b></td><td><b>Snapshot Value</b></td></tr>';
          foreach ($diff_rows as $row) {
            $out2 .= '<tr>';
            $out2 .= '<td style="width: 100px;">' . $row->option_name . '</td>';
            $out2 .= '<td>' . (empty($row->current_value) ? '<i>empty</i>' : $row->current_value) . '</td>';
            $out2 .= '<td>' . (empty($row->snapshot_value) ? '<i>empty</i>' : $row->snapshot_value) . '</td>';
            $out2 .= '</tr>';
          } // foreach
          foreach ($only_current as $row) {
            $out2 .= '<tr>';
            $out2 .= '<td style="width: 100px;">' . $row->option_name . '</td>';
            $out2 .= '<td>' . (empty($row->current_value) ? '<i>empty</i>' : $row->current_value) . '</td>';
            $out2 .= '<td><i>not found in snapshot</i></td>';
            $out2 .= '</tr>';
          } // foreach
          foreach ($only_current as $row) {
            $out2 .= '<tr>';
            $out2 .= '<td style="width: 100px;">' . $row->option_name . '</td>';
            $out2 .= '<td><i>not found in current tables</i></td>';
            $out2 .= '<td>' . (empty($row->snapshot_value) ? '<i>empty</i>' : $row->snapshot_value) . '</td>';
            $out2 .= '</tr>';
          } // foreach
          $out2 .= '</table>';
        } else {
          $out2 .= '<p class="textcenter">Detailed data diff is not available for this table.</p>';
        }
        $out2 .= '</td>';
        $out2 .= '</tr>';

        $out2 .= '</table>';
        $out2 .= '</div>';
      }
    } // foreach in both

    return $out . $out2 . $out3;
  } // do_compare_snapshots


  /**
   * Generates a unique 6-char snapshot ID; verified non-existing
   *
   * @return string
   */
  function generate_snapshot_uid()
  {
    global $wpdb;
    $snapshots = $this->get_snapshots();
    $cnt = 0;
    $uid = false;

    do {
      $cnt++;
      $uid = sprintf('%06x', mt_rand(0, 0xFFFFFF));

      $verify_db = $wpdb->get_col($wpdb->prepare('SHOW TABLES LIKE %s', array('%' . $uid . '%')));
    } while (!empty($verify_db) && isset($snapshots[$uid]) && $cnt < 30);

    if ($cnt == 30) {
      $uid = false;
    }

    return $uid;
  } // generate_snapshot_uid


  /**
   * Helper function for adding plugins to featured list
   *
   * @return array
   */
  function featured_plugins_tab($args)
  {
    add_filter('plugins_api_result', array($this, 'plugins_api_result'), 10, 3);

    return $args;
  } // featured_plugins_tab


  /**
   * Add single plugin to featured list
   *
   * @return object
   */
  function add_plugin_featured($plugin_slug, $res)
  {
    // check if plugin is already on the list
    if (!empty($res->plugins) && is_array($res->plugins)) {
      foreach ($res->plugins as $plugin) {
        if (is_object($plugin) && !empty($plugin->slug) && $plugin->slug == $plugin_slug) {
          return $res;
        }
      } // foreach
    }

    $plugin_info = get_transient('wf-plugin-info-' . $plugin_slug);

    if (!$plugin_info) {
      $plugin_info = plugins_api('plugin_information', array(
        'slug'   => $plugin_slug,
        'is_ssl' => is_ssl(),
        'fields' => array(
          'banners'           => true,
          'reviews'           => true,
          'downloaded'        => true,
          'active_installs'   => true,
          'icons'             => true,
          'short_description' => true,
        )
      ));
      if (!is_wp_error($plugin_info)) {
        set_transient('wf-plugin-info-' . $plugin_slug, $plugin_info, DAY_IN_SECONDS * 7);
      }
    }

    if ($plugin_info && is_array($plugin_info)) {
      array_unshift($res->plugins, $plugin_info);
    }

    return $res;
  } // add_plugin_featured


  /**
   * Add plugins to featured plugins list
   *
   * @return object
   */
  function plugins_api_result($res, $action, $args)
  {
    remove_filter('plugins_api_result', array($this, 'plugins_api_result'), 10, 3);

    $res = $this->add_plugin_featured('under-construction-page', $res);
    $res = $this->add_plugin_featured('wp-force-ssl', $res);
    $res = $this->add_plugin_featured('eps-301-redirects', $res);

    return $res;
  } // plugins_api_result


  /**
   * Clean up on uninstall; no action on deactive at the moment
   *
   * @return null
   */
  static function uninstall()
  {
    delete_option('wp-reset');
    delete_option('wp-reset-snapshots');
  } // uninstall


  /**
   * Disabled; we use singleton pattern so magic functions need to be disabled
   *
   * @return null
   */
  function __clone()
  {
  }


  /**
   * Disabled; we use singleton pattern so magic functions need to be disabled
   *
   * @return null
   */
  function __sleep()
  {
  }


  /**
   * Disabled; we use singleton pattern so magic functions need to be disabled
   *
   * @return null
   */
  function __wakeup()
  {
  }
} // WP_Reset class


// Create plugin instance and hook things up
// Only if in admin - plugin has no frontend functionality
if (is_admin() || WP_Reset::is_cli_running()) {
  global $wp_reset;
  $wp_reset = WP_Reset::getInstance();
  add_action('plugins_loaded', array($wp_reset, 'load_textdomain'));
  register_uninstall_hook(__FILE__, array('WP_Reset', 'uninstall'));
}
