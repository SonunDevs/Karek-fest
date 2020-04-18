<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: Header
 */

$options =[
    'header_settings' => [
        'title'		 => esc_html__( 'Header settings', 'exhibz' ),

        'options'	 => [

            'header_layout_style' => [
                'label'	        => esc_html__( 'Header style', 'exhibz' ),
                'desc'	        => esc_html__( 'This is the site\'s main header style.', 'exhibz' ),
                'type'	        => 'image-picker',
                'choices'       => [
                    'transparent'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style1.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style1.png',
                    ],
                   'standard'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style2.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style2.png',
                    ],
                    'transparent2'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style3.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style3.png',
                    ],
                    'transparent3'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style4.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style4.png',
                    ],
                    'classic'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style5.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style5.png',
                    ],
                    'center'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style6.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style6.png',
                    ],
                    'fullwidth'    => [
                        'small'     => EXHIBZ_IMG . '/admin/header-style/style7.png',
                        'large'     => EXHIBZ_IMG . '/admin/header-style/style7.png',
                    ],
                ],
                'value'         => 'standard',
             ], //Header style

             'header_nav_sticky_section' => [
               'type'			 => 'switch',
               'label'		 => esc_html__( 'Sticky header show', 'exhibz' ),
               'desc'			 => esc_html__( 'Do you want to show sticky in header ?', 'exhibz' ),
               'value'       => 'no',
               'left-choice'	 => [
                  'value'   	     => 'yes',
                  'label'	        => esc_html__( 'Yes', 'exhibz' ),
               ],
               'right-choice'	 => [
                  'value'	 => 'no',
                  'label'	 => esc_html__( 'No', 'exhibz' ),
               ],
             ],
             'header_nav_search' => [
                'type'			 => 'switch',
                'label'		    => esc_html__( 'Search button show', 'exhibz' ),
                'desc'			 => esc_html__( 'only for header style 5', 'exhibz' ),
                'value'         => 'no',
                'left-choice'	 => [
                   'value'     => 'yes',
                   'label'	   => esc_html__( 'Yes', 'exhibz' ),
                ],
                'right-choice'	 => [
                   'value'	 => 'no',
                   'label'	 => esc_html__( 'No', 'exhibz' ),
                ],
              ],

             'header_cta_button_settings' => [
                'type'        => 'popup',
                'label'       => esc_html__('Header CTA button settings', 'exhibz'),
                'popup-title' => esc_html__('Header CTA button settings', 'exhibz'),
                'button'      => esc_html__('Edit header CTA button', 'exhibz'),
                'size'        => 'small', // small, medium, large
                'popup-options' => [
                    'header_btn_show' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show button?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the header button', 'exhibz'),
                        'value'         => 'no',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                   
                    'header_btn_title'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Button title', 'exhibz' ),
                        'value'   => esc_html__( 'Buy Ticket', 'exhibz' ),
                    ],
                    
                     'header_btn_bg_color'	 => [
                        'type'	 => 'color-picker',
                        'label'	 => esc_html__( 'Button Backgound', 'exhibz' ),
                        'value'   => '#00c1c1'
                     
                  ],
                    'header_btn_url'	 => [
                        'type'	 => 'text',
                        'label'	 => esc_html__( 'Button Url', 'exhibz' ),
                        'desc'	 => esc_html__( 'Put the url of the button', 'exhibz' ),
                        'value'   => '#',
                    ],

                ],
            ],
             'header_top_settings' => [
                'type'        => 'popup',
                'label'       => esc_html__('Header Top Area settings', 'exhibz'),
                'popup-title' => esc_html__('Header Top Area settings', 'exhibz'),
                'button'      => esc_html__('Edit header Top Info', 'exhibz'),
                'size'        => 'small', // small, medium, large
                'popup-options' => [
                    'header_contact_show' => [
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Show Contact info?', 'exhibz' ),
                        'desc'          => esc_html__('Show or hide the header Contact info', 'exhibz'),
                        'value'         => 'no',
                        'left-choice'	 => [
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' ),
                        ],
                        'right-choice'	 => [
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' ),
                        ],
                    ],
                
                    'header_contact_icon' => [
                        'type'			    => 'new-icon',
                        'label'			    => esc_html__( 'Contact Icon', 'exhibz' ),
                        'desc'			    => esc_html__( 'Give Contact Icon (only for header style 5).', 'exhibz' ),
                     ],
                    'header_contact_number' => [
                        'type'			    => 'text',
                        'label'			    => esc_html__( 'Contact Number', 'exhibz' ),
                        'desc'			    => esc_html__( 'Give Contact number (only for header style 5).', 'exhibz' ),
                        
                    ],

                    'header_contact_mail_icon' => [
                        'type'			    => 'new-icon',
                        'label'			    => esc_html__( 'Contact Mail Icon', 'exhibz' ),
                        'desc'			    => esc_html__( 'Give Contact Mail Icon (only for header style 5).', 'exhibz' ),
                     ],
                    'header_contact_mail' => [
                        'type'			    => 'text',
                        'label'			    => esc_html__( 'Contact Mail', 'exhibz' ),
                        'desc'			    => esc_html__( 'Give Contact Mail (only for header style 5).', 'exhibz' ),
                     ],

                ],
            ],
        ], //Options end
    ]
];