<?php if (!defined('ABSPATH')) die('Direct access forbidden.');
/**
 * customizer option: blog
 */

$options =[
    'blog_settings' => [
        'title'		 => esc_html__( 'Blog settings', 'exhibz' ),

        'options'	 => [
            'blog_sidebar' =>[
                'type'  => 'select',
                              
                'label' => esc_html__('Sidebar', 'exhibz'),
                'desc'  => esc_html__('Description', 'exhibz'),
                'help'  => esc_html__('Help tip', 'exhibz'),
                'choices' => array(
                    '1' => esc_html__('No sidebar','exhibz'),
                    '2' => esc_html__('Left Sidebar', 'exhibz'),
                    '3' => esc_html__('Right Sidebar', 'exhibz'),
                 
                 ),
              
                'no-validate' => false,
            ],
             
            'blog_title' => [
                'label'	 => esc_html__( 'Global blog title', 'exhibz' ),
                'type'	 => 'text',
            ],
            'blog_header_image' => [
                'label'	 => esc_html__( 'Global header background image', 'exhibz' ),
                'type'	 => 'upload',
             ],
            'blog_breadcrumb' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Breadcrumb', 'exhibz' ),
                'desc'			 => esc_html__( 'Do you want to show breadcrumb?', 'exhibz' ),
                'value'          => 'yes',
                'left-choice'	 => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'exhibz' ),
                ],
                'right-choice'	 => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'exhibz' ),
                ],
            ],
            'blog_author' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Blog author', 'exhibz' ),
                'desc'			 => esc_html__( 'Do you want to show blog author?', 'exhibz' ),
                'value'          => 'yes',
                'left-choice' => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'exhibz' ),
                ],
                'right-choice' => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'exhibz' ),
                ],
           ],
            'blog_social_share' => [
                'type'			 => 'switch',
                'label'			 => esc_html__( 'Social share', 'exhibz' ),
                'desc'			 => esc_html__( 'Do you want to show social share buttons?', 'exhibz' ),
                'value'          => 'yes',
                'left-choice' => [
                    'value'	 => 'yes',
                    'label'	 => esc_html__( 'Yes', 'exhibz' ),
                ],
                'right-choice' => [
                    'value'	 => 'no',
                    'label'	 => esc_html__( 'No', 'exhibz' ),
                ],
           ],
        ],
            
        ]
    ];