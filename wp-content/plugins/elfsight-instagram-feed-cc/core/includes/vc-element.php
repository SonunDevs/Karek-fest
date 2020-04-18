<?php

if (!defined('ABSPATH')) exit;


if (!class_exists('ElfsightInstagramFeedVCElement')) {
    class ElfsightInstagramFeedVCElement {
    	private $pluginName;
    	private $slug;
    	private $textDomain;

    	private $vcIcon;

    	private $widgetsApi;

    	public function __construct($config, $widgetsApi) {
    		$this->pluginName = $config['plugin_name'];
    		$this->slug = $config['slug'];
            $this->textDomain = $config['text_domain'];

            $this->vcIcon = $config['vc_icon'];

    		$this->widgetsApi = $widgetsApi;

    		add_action('vc_before_init', array($this, 'registerElement'));
    	}

    	public function registerElement() {
    		$widgets = array();
    		$widgetsList = array();

    		$this->widgetsApi->getList($widgets);

			if (!empty($widgets['data'])) {
				foreach ($widgets['data'] as $widget) {
					$widgetsList[$widget['name'] .' ' ] = $widget['id'];
				}
			}

			vc_map(array(
				'name' => $this->pluginName,
				'base' => str_replace('-', '_', $this->slug),
				'class' => '',
				'category' => 'Elfsight',
				'icon' => $this->vcIcon,
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Select a widget ', $this->textDomain),
						'param_name' => 'id',
						'value' => $widgetsList,
                        'save_always' => true,
						'description' => esc_html__(sprintf('You can manage the widgets on the <a href="%1$s" target="_blank">plugin\'s settings page</a>.', esc_url(admin_url('admin.php?page=' . $this->slug))), $this->textDomain)
					)
				)
			));
		}	
	}
}

?>