<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */
$options =[
    'style_settings' => [
            'title'		 => esc_html__( 'Style settings', 'exhibz' ),
            'options'	 => [
                'body_bg_img' => [
                    'label'	        => esc_html__( 'Body Background Image', 'exhibz' ),
                    'desc'	           => esc_html__( 'It\'s the main body background image', 'exhibz' ),
                    'type'	           => 'upload',
                    'image_only'      => true,
                 ],

                'style_body_bg' => [
                    'label'	        => esc_html__( 'Body background', 'exhibz' ),
                    'desc'	           => esc_html__( 'Site\'s main background color.', 'exhibz' ),
                    'type'	           => 'color-picker',
                 ],
                 'style_body_text_color' => [
                  'label'	        => esc_html__( 'Body text color', 'exhibz' ),
                  'desc'	           => esc_html__( 'Site\'s main body text color.', 'exhibz' ),
                  'type'	           => 'color-picker',
               ],


                'style_primary' => [
                    'label'	        => esc_html__( 'Primary color', 'exhibz' ),
                    'desc'	           => esc_html__( 'Site\'s main color.', 'exhibz' ),
                    'type'	           => 'color-picker',
                ],

                'secondary_color' => [
                    'label'	        => esc_html__( 'Hover color', 'exhibz' ),
                    'desc'	           => esc_html__( 'Hover color.', 'exhibz' ),
                    'type'	           => 'color-picker',
                ],
                
                'title_color' => [
                'label'	        => esc_html__( 'Title color', 'exhibz' ),
                'desc'	        => esc_html__( 'Blog title color.', 'exhibz' ),
                'type'	        => 'color-picker',
                ],

                'body_font'    => array(
                    'type' => 'typography-v2',
                    'label' => esc_html__('Body Font', 'exhibz'),
                    'desc'  => esc_html__('Choose the typography for the title', 'exhibz'),
                    'value' => array(
                        'family' => 'Roboto',
                        'size'  => '16',
                    ),
                    'components' => array(
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ),
                ),
                
                'heading_font_one'	 => [
                    'type'		 => 'typography-v2',
                    'value'		 => [
                        'family'		 => 'Raleway',
                        'size'  => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H1 and H2 Fonts', 'exhibz' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'exhibz' ),
                ],

                'heading_font_two'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Raleway',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H3 Fonts', 'exhibz' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'exhibz' ),
                ],

                'heading_font_three'	 => [
                    'type'		    => 'typography-v2',
                    'value'		 => [
                        'family'		  => 'Roboto',
                        'size'        => '',
                        'font-weight' => '700',
                    ],
                    'components' => [
                        'family'         => true,
                        'size'           => true,
                        'line-height'    => false,
                        'letter-spacing' => false,
                        'color'          => false,
                        'font-weight'    => true,
                    ],
                    'label'		 => esc_html__( 'Heading H4 Fonts', 'exhibz' ),
                    'desc'		    => esc_html__( 'This is for heading google fonts', 'exhibz' ),
                ],

            
            
            ],
        ],
    ];