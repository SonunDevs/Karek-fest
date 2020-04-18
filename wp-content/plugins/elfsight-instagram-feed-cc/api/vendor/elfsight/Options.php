<?php

namespace ElfsightInstagramFeedApi\Core;

class Options {
    public $Helper;

    public $apiUrl;
    public $apiAction;

    public $editorConfig;

    public function __construct($Helper, $config) {
        $this->Helper = $Helper;

        $this->apiUrl = admin_url('admin-ajax.php');
        $this->apiAction = $this->Helper->getOptionName('api');

        $this->editorConfig = &$config['editor_config'];

        add_filter($this->Helper->getOptionName('shortcode_options'), array($this, 'shortcodeOptionsFilter'));
        add_filter($this->Helper->getOptionName('widget_options'), array($this, 'widgetOptionsFilter'));

        $this->addOptions();
        $this->modifyOptions();
        $this->deleteOptions();
    }

    public function addOptions() {
        $this->addOption(array(
            'id' => 'apiUrl',
            'name' => esc_html__('API URL'),
            'tab' => 'more',
            'type' => 'hidden',
            'defaultValue' => $this->apiUrl
        ));

        $this->addOption(array(
            'id' => 'apiAction',
            'name' => esc_html__('API Action'),
            'tab' => 'more',
            'type' => 'hidden',
            'defaultValue' => $this->apiAction
        ));
    }

    public function modifyOptions() {

    }

    public function deleteOptions() {

    }

    public function addOption($data) {
        if (!is_array($this->editorConfig['settings'])) {
            return;
        }

        array_push($this->editorConfig['settings']['properties'], $data);
    }

    public function modifyOption($id, $data, &$properties = null) {
        if (!isset($properties)) {
            $properties = &$this->editorConfig['settings']['properties'];
        }

        if (!is_array($properties)) {
            return;
        }

        foreach ($properties as &$property) {
            if (!empty($property['id']) && $property['id'] === $id) {
                $property = array_merge($property, $data);
            }

            if ($property['type'] === 'subgroup') {
                $this->modifyOption($id, $data, $property['subgroup']['properties']);
            }
        }
    }

    public function deleteOption($id, &$properties = null) {
        if (!isset($properties)) {
            $properties = &$this->editorConfig['settings']['properties'];
        }

        foreach ($properties as $i => &$property) {
            if ($property['type'] === 'subgroup') {
                $this->modifyOption($id, $property['subgroup']['properties']);
            }

            if (!empty($property['id']) && $property['id'] === $id) {
                array_splice($properties, $i, 1);
                return;
            }
        }
    }

    public function shortcodeOptionsFilter($options) {
        if (is_array($options)) {
            $options['apiUrl'] = $this->apiUrl;
            $options['apiAction'] = $this->apiAction;
        }

        return $options;
    }

    public function widgetOptionsFilter($options_json) {
        $options = json_decode($options_json, true);

        if (is_array($options)) {
            unset($options['apiUrl']);
            unset($options['apiAction']);
        }

        return json_encode($options);
    }
}
