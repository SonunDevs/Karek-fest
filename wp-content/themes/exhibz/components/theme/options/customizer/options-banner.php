<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: banner
 */

 
$options = [
    'banner_setting' => [
        'title' => esc_html__('Banner Settings', 'exhibz'),

        'options' => [
            'banner_title_color' => [
                'label'	        => esc_html__( 'Banner Title color', 'exhibz' ),
                'desc'	           => esc_html__( 'Banner title color.', 'exhibz' ),
                'type'	           => 'color-picker',
             ],

            'page_banner_setting' => [
                'type'        => 'popup',
                'label'       => esc_html__('Page Banner settings', 'exhibz'),
                'popup-title' => esc_html__('Page banner settings', 'exhibz'),
                'button'      => esc_html__('Edit page Banner Button', 'exhibz'),
                'size'        => 'medium', // small, medium, large
                'popup-options' => [
                    'page_show_banner' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show banner?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the banner', 'exhibz'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                    'page_show_breadcrumb' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show Breadcrumb?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the Breadcrumb', 'exhibz'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                    'banner_page_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Banner title', 'exhibz' ),
                        'value'  => esc_html__( 'Welcome Exhibz', 'exhibz' ),
                    ],

                    'banner_page_image'	 =>array(
                        'label'			 => esc_html__( 'Banner image', 'exhibz' ),
                        'type'			 => 'upload',
                        'images_only'	 => true,
                        'files_ext'		 => array( 'jpg', 'png', 'jpeg', 'gif', 'svg' ),
                              
                        )

                ],
            ], 
        
            'blog_banner_setting' => [
                'type'         => 'popup',
                'label'        => esc_html__('Blog Banner settings', 'exhibz'),
                'popup-title'  => esc_html__('Blog banner settings', 'exhibz'),
                'button'       => esc_html__('Edit Blog Banner Button', 'exhibz'),
                'size'         => 'medium', // small, medium, large
                'popup-options' => [
                    'blog_show_banner' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show banner?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the banner', 'exhibz'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                    'blog_show_breadcrumb' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show Breadcrumb?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the Breadcrumb', 'exhibz'),
                        'value'         => 'yes',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                    'banner_blog_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Banner title', 'exhibz' ),
                    ],
                   
                    'banner_blog_image'	 =>array(
                        'type'  => 'upload',
                        'label' => esc_html__('Image', 'exhibz'),
                        'desc'  => esc_html__('Banner blog image', 'exhibz'),
                        'images_only' => true,
                        'files_ext' => array( 'PNG', 'JPEG', 'JPG','GIF'),
                              
                     
                    )

                ],
            ],
            'shop_banner_settings' => [
               'type' => 'popup',
               'label' => esc_html__('Shop banner settings', 'exhibz'),
               'popup-title' => esc_html__('Shop banner settings', 'exhibz'),
               'button' => esc_html__('Edit shop banner settings', 'exhibz'),
               'size' => 'small', // small, medium, large
               'popup-options' => array(
                   'show' => array(
                       'type'			 => 'switch',
                       'label'			 => esc_html__( 'Show banner?', 'exhibz' ),
                       'value' => 'yes',
                       'left-choice'	 => array(
                           'value'	 => 'yes',
                           'label'	 => esc_html__( 'Yes', 'exhibz' ),
                       ),
                       'right-choice'	 => array(
                           'value'	 => 'no',
                           'label'	 => esc_html__( 'No', 'exhibz' ),
                       ),
                   ),
                   'show_breadcrumb' => array(
                       'type'			 => 'switch',
                       'label'			 => esc_html__( 'Show breadcrumb?', 'exhibz' ),
                       'value' => 'yes',
                       'left-choice'	 => array(
                           'value'	 => 'yes',
                           'label'	 => esc_html__( 'Yes', 'exhibz' ),
                       ),
                       'right-choice'	 => array(
                           'value'	 => 'no',
                           'label'	 => esc_html__( 'No', 'exhibz' ),
                       ),
                   ),
                   'title'		 => array(
                       'label'	 => esc_html__( 'Shop Banner title', 'exhibz' ),
                       'type'	 => 'text',
                   ),
                   'single_title'		 => array(
                       'label'	 => esc_html__( 'Single Shop Banner title', 'exhibz' ),
                       'type'	 => 'text',
                   ),
                   'image'			 => array(
                       'label'			 => esc_html__( 'Banner image', 'exhibz' ),
                       'type'			 => 'upload',
                       'images_only'	 => true,
                       'files_ext'		 => array( 'jpg', 'png', 'jpeg', 'gif', 'svg' ),
                   ),
               ),
            ],
        ],
    ],
];