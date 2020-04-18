<?php if (!defined('ABSPATH')) die('Direct access forbidden.');

$options = array(
    'exhibz_speaker_count'=>array(
        'type'  => 'text',
        'value' => '10',
        'label' => esc_html__('Speaker count', 'exhibz'),
        'desc'  => esc_html__('Speaker category page pagination settings', 'exhibz'),
    ),
);