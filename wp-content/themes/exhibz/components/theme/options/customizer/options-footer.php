<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: general
 */

$options =[
    'footer_settings' => [
        'title'		 => esc_html__( 'Footer settings', 'exhibz' ),

        'options'	 => [

            'footer_style' => array(
                'type'         => 'multi-picker',
                'label'        => false,
                'desc'         => false,
                'picker'       => array(
                    'style' => array(
                        'label'   => esc_html__( 'Select Style', 'exhibz' ),
                        'type'    => 'image-picker',
                        'choices'	 => [
                            'style-1' => [
                                'small'	 => [
                                    'height' => 30,
                                    'src'	 => EXHIBZ_IMG. '/style/footer/style-2.png'
                                ],
                                'large'	 => [
                                    'width'	 => 370,
                                    'src'	 => EXHIBZ_IMG. '/style/footer/style-2.png'
                                ],
                            ],
                            'style-2' => [
                                'small'	 => [
                                    'height' => 30,
                                    'src'	 => EXHIBZ_IMG. '/style/footer/style-1.png'
                                ],
                                'large'	 => [
                                    'width'	 => 370,
                                    'src'	 => EXHIBZ_IMG. '/style/footer/style-1.png'
                                ],
                            ],
                         
                        ],
                      
                    )
                ),
                'choices'      => array(
                   
                    'style-2' => array(
                        'footer_mailchimp' => [
                            'label'	 => esc_html__( 'Mailchimp Shortcode', 'exhibz'),
                            'type'	 => 'text',
                           
                        ],
                      
                    ),
                ),
                'show_borders' => false,
            ), 
     
            'footer_bg_img' => [
                'label'	        => esc_html__( 'Footer Background Image', 'exhibz' ),
                'desc'	           => esc_html__( 'It\'s the main Footer background image', 'exhibz' ),
                'type'	           => 'upload',
                'image_only'      => true,
             ],
            'footer_bg_color' => [
                'label'	 => esc_html__( 'Footer Background color', 'exhibz'),
                'type'	 => 'color-picker',
                'desc'	 => esc_html__( 'You can change the footer\'s background color with rgba color or solid color', 'exhibz'),
            ],
            'footer_copyright_color' => [
                'label'	 => esc_html__( 'Footer Copyright color', 'exhibz'),
                'type'	 => 'color-picker',
                'desc'	 => esc_html__( 'You can change the footer\'s background color with rgba color or solid color', 'exhibz'),
            ],
            'footer_social_links' => [
                'type'  => 'addable-popup',
                'template' => '{{- title }}',
                'popup-title' => null,
                'label' => esc_html__( 'Social links', 'exhibz' ),
                'desc'  => esc_html__( 'Add social links and it\'s icon class below. These are all fontaweseome-4.7 icons.', 'exhibz' ),
                'add-button-text' => esc_html__( 'Add new', 'exhibz' ),
                'popup-options' => [
                    'title' => [ 
                        'type' => 'text',
                        'label'=> esc_html__( 'Title', 'exhibz' ),
                    ],
                    'icon_class' => [ 
                        'type' => 'icon',
                        'label'=> esc_html__( 'Social icon', 'exhibz' ),
                    ],
                    'url' => [ 
                        'type' => 'text',
                        'label'=> esc_html__( 'Social link', 'exhibz' ),
                    ],
                ],
                'value' => [
                   
                ],
            ],
            'footer_copyright'	 => [
                'type'	 => 'textarea',
                'value'  => esc_html__('&copy; 2019, Exhibz. All rights reserved','exhibz'),
                'label'	 => esc_html__( 'Copyright text', 'exhibz' ),
                'desc'	 => esc_html__( 'This text will be shown at the footer of all pages.', 'exhibz' ),
            ],

            'footer_padding_top' => [
                'label'	        => esc_html__( 'Footer Padding Top', 'exhibz' ),
                'desc'	        => esc_html__( 'Use Footer Padding Top', 'exhibz' ),
                'type'	        => 'text',
                'value'         => '250px',
             ],
             'back_to_top'				 => [
                'type'			 => 'switch',
                'value'			 => 'no',
                'label'			 => esc_html__( 'Back to top', 'exhibz'),
                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'exhibz'),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'exhibz'),
                ],
            ],
            
        ],
            
        ]
    ];