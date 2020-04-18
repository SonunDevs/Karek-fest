<?php

if (!defined('ABSPATH')) exit;


if (!class_exists('ElfsightInstagramFeedWidget')) {
	class ElfsightInstagramFeedWidget extends WP_Widget {
        private $configSlug;
        private $configPluginName;
        private $configDescription;
        private $configTextDomain;

        private $widgetsApi;

		public function __construct($config, $widgetsApi) {
            $this->configSlug = $config['slug'];
            $this->configPluginName = $config['plugin_name'];
            $this->configDescription = $config['description'];
            $this->configTextDomain = $config['text_domain'];

            $this->widgetsApi = $widgetsApi;

            parent::__construct(
                $this->configSlug,
                esc_html__($this->configPluginName, $this->configTextDomain),
                array('description' => esc_html__($this->configDescription, $this->configTextDomain))
            );
		}

		public function widget($args, $instance) {
			extract($instance, EXTR_SKIP);

			if (!empty($instance['id'])) {
				echo do_shortcode('[' . str_replace('-', '_', $this->configSlug) . ' id="' . $instance['id'] . '"]');
			}
		}

		public function form($instance) {
			$widgets = array();
    		$widgetsList = array();

    		$this->widgetsApi->getList($widgets);

			if (!empty($widgets['data'])) {?>
				<p>
					<label for="<?php echo esc_html($this->get_field_id('id')); ?>"><?php esc_html_e('Select a widget:', $this->configTextDomain); ?></label>
					<select class='widefat' id="<?php echo esc_html($this->get_field_id('id')); ?>" name="<?php echo esc_html($this->get_field_name('id')); ?>">
						<option value="0"><?php esc_html_e('— Select —', $this->configTextDomain); ?></option>
						<?php foreach ($widgets['data'] as $widget) { ?>
							<option value="<?php echo esc_html($widget['id']); ?>"<?php echo (!empty($instance['id']) && $instance['id'] == $widget['id']) ? ' selected' : ''; ?>><?php echo esc_html($widget['name']); ?></option>
						<?php } ?>
					</select>
				</p>
			<?php } else { ?>
				<p>
					<?php esc_html_e('No widgets yet.', $this->configTextDomain); ?>
                	<a href="<?php echo esc_url(admin_url('admin.php?page=' . $this->configSlug)); ?>#/add-widget/"><?php esc_html_e('Create the first one.', $this->configTextDomain); ?></a>
				</p>
			<?php }
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
		    $instance['id'] = !empty($new_instance['id']) ? $new_instance['id'] : '';

		    return $instance;
		}
	}
}

?>