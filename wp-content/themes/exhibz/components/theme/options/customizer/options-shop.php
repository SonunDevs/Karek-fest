<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: shop
 */
$options = [
    'shop_settings' => [
            'title'		 => esc_html__( 'Shop settings', 'exhibz' ),
            'options'	 => [
                
                'shop_sidebar' => [
                    'type'        => 'select',
                    'label'       => esc_html__( 'Blog sidebar position', 'exhibz' ),
                    'section'     => 'shop_section',
                    'default'     => '3',
                    'choices'     => [
                        '1'      => esc_html__('Full width','exhibz'),
                        '2'      => esc_html__('Left sidebar','exhibz'),
                        '3'      => esc_html__('Right sidebar','exhibz'),
                    ],
                ],
            ],
        ],
    ];