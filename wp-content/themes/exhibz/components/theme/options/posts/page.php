<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * metabox options for pages
 */

$options = array(
	'settings-page' => array(
		'title'		 => esc_html__( 'Page settings', 'exhibz' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
         'page_sections' => array( 
            'type'			 => 'multi-picker',
            'label'			 => false,
            'desc'			 => false,
            'picker'		 => array(
                'xs_page_section' => array(
                    'label'			 => esc_html__( 'This page is a section:', 'exhibz' ),
                    'type'			 => 'switch',
                    'right-choice'	 => array(
                        'value'	 => 'on',
                        'label'	 => esc_html__( 'Yes', 'exhibz' )
                    ),
                    'left-choice'	 => array(
                        'value'	 => 'no',
                        'label'	 => esc_html__( 'No', 'exhibz' )
                    ),
                    'value'			 => 'no',
                    'desc'			 => exhibz_kses( 'If this a <b>One page Section</b>,  set this field to <b>yes</b>. And if this page is not section, set it to <b>no</b>', 'exhibz' ),
                    'help'			 => sprintf( "%s \n\n'\"<br/><br/>\n\n <b>%s</b>", esc_html__( 'If this page for one page section. set yes ', 'exhibz' ), esc_html__( 'For One page always will be <b>yes</b>', 'exhibz' )
                    ),
                )
            ),
            'choices'		 => array(
                'on' => array(
                    'hide_title_from_menu' => array(
                        'type'			 => 'switch',
                        'label'			 => esc_html__( 'Hide title from menu ?', 'exhibz' ),
                        'right-choice'	 => array(
                            'value'	 => 'yes',
                            'label'	 => esc_html__( 'Yes', 'exhibz' )
                        ),
                        'left-choice'	 => array(
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'exhibz' )
                        ),
                        'value'			 => 'no',
                        'desc'			 => esc_html__( 'If you dont want to add title(or this page) on menu. you can set yes. if you set yes. this menu will be hide in menu.', 'exhibz' ),
                    ),
                ),
            ),
            'show_borders'	 => false,
         ),

			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'exhibz' ),
				'desc'	 => esc_html__( 'Add your Page hero title', 'exhibz' ),
			),
			'header_image'	 => array(
				'label'	 => esc_html__( ' Banner image', 'exhibz' ),
				'desc'	 => esc_html__( 'Upload a page header image', 'exhibz' ),
				'help'	 => esc_html__( "This default header image will be used for all your service.", 'exhibz' ),
				'type'	 => 'upload'
         ),
        //  'page_header_override' => [
        //     'type'			 => 'switch',
        //     'label'			 => esc_html__( 'Override default header layout?', 'autrics' ),
        //     'desc'  => esc_html__('Override customizer header layout', 'autrics'),
        //     'value' => 'no',
        //     'left-choice'	 => [
        //         'value'	 => 'yes',
        //         'label'	 => esc_html__( 'Yes', 'exhibz' ),
        //     ],
        //     'right-choice'	 => [
        //         'value'	 => 'no',
        //         'label'	 => esc_html__( 'No', 'exhibz' ),
        //     ],
        //  ],
        //  'page_header_layout_style' => [
        //     'label'	        => esc_html__( 'Header style', 'exhibz' ),
        //     'desc'	        => esc_html__( 'This is the site\'s main header style.', 'exhibz' ),
        //     'type'	        => 'image-picker',
        //     'choices'       => [
        //        'transparent'    => [
        //           'small'     => EXHIBZ_IMG . '/admin/header-style/style1.png',
        //           'large'     => EXHIBZ_IMG . '/admin/header-style/style1.png',
        //       ],
        //       'standard'    => [
        //           'small'     => EXHIBZ_IMG . '/admin/header-style/style2.png',
        //           'large'     => EXHIBZ_IMG . '/admin/header-style/style2.png',
        //       ],
        //       'transparent2'    => [
        //           'small'     => EXHIBZ_IMG . '/admin/header-style/style3.png',
        //           'large'     => EXHIBZ_IMG . '/admin/header-style/style3.png',
        //       ],
        //       'transparent3'    => [
        //           'small'     => EXHIBZ_IMG . '/admin/header-style/style4.png',
        //           'large'     => EXHIBZ_IMG . '/admin/header-style/style4.png',
        //       ],
        //      'classic'    => [
        //           'small'     => EXHIBZ_IMG . '/admin/header-style/style5.png',
        //           'large'     => EXHIBZ_IMG . '/admin/header-style/style5.png',
        //       ],
        //       'center'    => [
        //         'small'     => EXHIBZ_IMG . '/admin/header-style/style6.png',
        //         'large'     => EXHIBZ_IMG . '/admin/header-style/style6.png',
        //     ],
        //     'fullwidth'    => [
        //         'small'     => EXHIBZ_IMG . '/admin/header-style/style7.png',
        //         'large'     => EXHIBZ_IMG . '/admin/header-style/style7.png',
        //     ],
        //     ],
        //     'value'         => 'standard',
        //  ], /*Header style*/
         
		),
	),
);
