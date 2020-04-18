<?php

namespace Elementor;

class ElementsKit_Extend_Section_Parallax{
    public function __construct()
    {
        add_action('elementor/element/section/section_effects/after_section_end', array( $this, 'after_section_end' ), 10, 2);
        add_action('elementor/frontend/section/after_render', array($this, 'after_section_render'), 10, 2);
    }

    

    public function after_section_end($control, $args)
    {
        $control->start_controls_section(
            'ekit_section_parallax',
            array(
                'label' => esc_html__('Parallax Effects', 'exhibz'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            )
        );
        $control->add_control(
            'ekit_section_parallax_bg',
            [
                'label' => esc_html__('Background Image Parallax', 'exhibz'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'exhibz'),
                'label_off' => __('Hide', 'exhibz'),
            ]
        );
        $control->add_control(
            'ekit_section_parallax_bg_speed', [
                'label' => __('Speed', 'exhibz'),
                'type' => Controls_Manager::NUMBER,
                'max' => .9,
                'min' => .1,
                'step' => .1,
                'default' => 0.5,
                'condition' => [
                    'ekit_section_parallax_bg' => 'yes',
                ]
            ]
        );

        $control->add_control(
            'ekit_section_parallax_multi',
            array(
                'label' => esc_html__('Multi Item Parallax', 'exhibz'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'exhibz'),
                'label_off' => __('Hide', 'exhibz'),
            )
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'parallax_style',  [
            'label' => __('Effect Type', 'exhibz'),
            'type' => Controls_Manager::SELECT,
            'default' => 'animation',
            'options' => [
                'animation' => __('Css Animation', 'exhibz'),
                'mousemove' => __('Mouse Move', 'exhibz'),
                'onscroll' => __('On Scroll', 'exhibz'),
                'tilt' => __('Parallax Tilt', 'exhibz'),
            ],
        ]
        );
        $repeater->add_control(
            'item_source',
            [
                'label' => __( 'Item source', 'exhibz' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'toggle' => false,
                'default' => 'image',
                'options' => [
                    'image' => [
                        'title' => 'Image',
                        'icon' => 'eicon-image',
                    ],
                    'shape' => [
                        'title' => 'Shape',
                        'icon' => 'eicon-divider-shape',
                    ],
                ],
                'classes' => 'elementor-control-start-end',
                'render_type' => 'ui',

            ]
        );
        $repeater->add_control(
            'image',[
                'label' => __('Choose Image', 'exhibz'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'item_source' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'shape',  [
                'label' => __('Choose Shape', 'exhibz'),
                'type' => Controls_Manager::SELECT,
                'default' => 'angle',
                'options' => [
                    'angle' => __('Shape 1', 'exhibz'),
                    'double_stroke' => __('Shape 2', 'exhibz'),
                    'fat_stroke' => __('Shape 3', 'exhibz'),
                    'fill_circle' => __('Shape 4', 'exhibz'),
                    'round_triangle' => __('Shape 5', 'exhibz'),
                    'single_stroke' => __('Shape 6', 'exhibz'),
                    'stroke_circle' => __('Shape 7', 'exhibz'),
                    'triangle' => __('Shape 8', 'exhibz'),
                    'zigzag' => __('Shape 9', 'exhibz'),
                    'zigzag_2' => __('Shape 10', 'exhibz'),
                    'shape_1' => __('Shape 11', 'exhibz'),
                    'shape_2' => __('Shape 12', 'exhibz'),
                    'shape_3' => __('Shape 13', 'exhibz'),
                    'shape_4' => __('Shape 14', 'exhibz'),
                ],
                'condition' => [
                    'item_source' => 'shape',
                ]
            ]
        );

        $repeater->add_control(
             'shape_color',
            [
                'label' => __( 'Color', 'exhibz' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'item_source' => 'shape',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'width_type',
            [
                'label' => __( 'Width', 'exhibz' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Auto', 'exhibz' ),
                    'custom' => __( 'Custom', 'exhibz' ),
                ],

            ]
        );

        $repeater->add_responsive_control(
            'custom_width',
            [
                'label' => __( 'Custom Width', 'exhibz' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'condition' => [
                    'width_type' => 'custom',
                ],
                'device_args' => [
                    Controls_Stack::RESPONSIVE_TABLET => [
                        'condition' => [
                            'ekit_prlx_width_tablet' => [ 'custom' ],
                        ],
                    ],
                    Controls_Stack::RESPONSIVE_MOBILE => [
                        'condition' => [
                            'ekit_prlx_width_mobile' => [ 'custom' ],
                        ],
                    ],
                ],
                'size_units' => [ 'px', '%', 'vw' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'source_rotate', [
                'label' => __('Rotate', 'exhibz'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-parallax-graphic" => 'transform: rotate({{SIZE}}{{UNIT}})',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_x', [
                'label' => __('Position X (%)', 'exhibz'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'left: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $repeater->add_responsive_control(
            'pos_y',[
                'label' => __('Position Y (%)', 'exhibz'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 10,
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}.ekit-section-parallax-layer" => 'top: {{SIZE}}{{UNIT}}',

                ],

            ]
        );
        $repeater->add_responsive_control(
            'animation',
            [
                'label' => __( 'Animation', 'exhibz' ),
                'type' => Controls_Manager::SELECT2,
                'frontend_available' => true,
                'default' => 'ekit-fade',
                'options' => [
                    'ekit-fade'=> 'Fade',
                    'ekit-rotate'=> 'Rotate',
                    'ekit-bounce'=> 'Bounce',
                    'ekit-zoom'=> 'Zoom',
                    'ekit-rotate-box'=> 'RotateBox',
                    'ekit-left-right'=> 'Left Right',
                    'bounce'=> 'Bounce 2',
                    'flash'=> 'Flash',
                    'pulse'=> 'Pulse',
                    'shake'=> 'Shake',
                    'headShake'=> 'HeadShake',
                    'swing'=> 'Swing',
                    'tada'=> 'Tada',
                    'wobble'=> 'Wobble',
                    'jello'=> 'Jello',
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-name:{{UNIT}}',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-name:{{UNIT}}',
                ],
            ]
        );
        $repeater->add_control(
            'item_opacity',
            [
                'label' => __( 'Opacity', 'exhibz' ),
                'description' => esc_html__( 'Opacity will be (0-1), default value 1', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'min' => 0,
                'step' => 1,
                'render_type' => 'none',
                'frontend_available' => true,
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'opacity:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation speed', 'exhibz' ) . ' (s)',
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
                'min' => 1,
                'step' => 100,
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => '-webkit-animation-duration:{{UNIT}}s',
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-duration:{{UNIT}}s'
                ],
            ]
        );
        $repeater->add_control(
            'animation_iteration_count',
            [
                'label' => __( 'Animation Iteration Count', 'exhibz' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'unset',
                'options' => [
                    'infinite' => __( 'Infinite', 'exhibz' ),
                    'unset' => __( 'Unset', 'exhibz' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-iteration-count:{{UNIT}}'
                ],
            ]
        );
        $repeater->add_control(
            'animation_direction',
            [
                'label' => __( 'Animation Direction', 'exhibz' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'normal' => __( 'Normal', 'exhibz' ),
                    'reverse' => __( 'Reverse', 'exhibz' ),
                    'alternate' => __( 'Alternate', 'exhibz' ),
                ],
                'condition' => [
                    'parallax_style' => 'animation',
                ],
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'animation-direction:{{UNIT}}'
                ],
            ]
        );

        $repeater->add_control(
            'parallax_speed', [
                'label' => __('Speed', 'exhibz'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('100', 'exhibz'),
                'condition' => [
                    'parallax_style' => 'mousemove',
                ]
            ]
        );

        $repeater->add_control(
            'parallax_transform', [
                'label' => esc_html__( 'Parallax style', 'exhibz' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translateY',
                'options' => [
                    'translateX' => esc_html__( 'X axis', 'exhibz' ),
                    'translateY' => esc_html__( 'Y axis', 'exhibz' ),
                    'rotate' => esc_html__( 'rotate', 'exhibz' ),
                    'rotateX' => esc_html__( 'rotateX', 'exhibz' ),
                    'rotateY' => esc_html__( 'rotateY', 'exhibz' ),
                    'scale' => esc_html__( 'scale', 'exhibz' ),
                    'scaleX' => esc_html__( 'scaleX', 'exhibz' ),
                    'scaleY' => esc_html__( 'scaleY', 'exhibz' ),
                ],
                'condition' => [
                    'parallax_style' => 'onscroll'
                ],
            ]
        );
        $repeater->add_control(
            'parallax_transform_value', [
                'label' => esc_html__( 'Parallax Transition ', 'exhibz' ),
                'description' => esc_html__( 'X, Y and Z Axis will be pixels, Rotate will be degrees (0-180), scale will be ratio', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '250',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'smoothness', [
                'label' => esc_html__( 'Smoothness', 'exhibz' ),
                'description' => esc_html__( 'factor that slowdown the animation, the more the smoothier (default: 700)', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '700',
                'min' => 0,
                'max' => 1000,
                'step' => 100,
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsettop',[
                'label' => esc_html__( 'Offset Top', 'exhibz' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'offsetbottom', [
                'label' => esc_html__( 'Offset Bottom', 'exhibz' ),
                'description' => esc_html__( 'default: 0; when the element is visible', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'condition' => [
                    'parallax_style' => 'onscroll'
                ]
            ]
        );
        $repeater->add_control(
            'maxtilt',[
                'label' => esc_html__( 'MaxTilt', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '20',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'scale',[
                'label' => esc_html__( 'Image Scale', 'exhibz' ),
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc.. Default 1', 'exhibz' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '1',
                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'disableaxis', [
                'label' => esc_html__( 'Disable Axis', 'exhibz' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'exhibz' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'exhibz' ),
                    'x' => esc_html__( 'X axis', 'exhibz' ),
                    'y' => esc_html__( 'Y axis', 'exhibz' ),
                ],

                'condition' => [
                    'parallax_style' => 'tilt',
                ]
            ]
        );
        $repeater->add_control(
            'zindex',   [
                'label' => __('Z-index', 'exhibz'),
                'type' => Controls_Manager::NUMBER,
                'default' => esc_html__('2', 'exhibz'),
                'selectors' => [
                    "{{WRAPPER}} {{CURRENT_ITEM}}" => 'z-index: {{UNIT}}',
                ],
            ]
        );
        $control->add_control(
            'ekit_section_parallax_multi_items',
            [
                'label' => __( 'exhibz', 'exhibz' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ parallax_style }}}',
                'condition' => [
                    'ekit_section_parallax_multi' => 'yes'
                ],

            ]
        );

        $control->end_controls_section();
    }

    public function after_section_render(Element_Base $element)
    {
        $data     = $element->get_data();
        $settings = $data['settings'];
        // d($settings);
        
        if  (
                (isset($settings['ekit_section_parallax_multi']) && $settings['ekit_section_parallax_multi'] == 'yes') || 
                (isset($settings['ekit_section_parallax_bg']) && $settings['ekit_section_parallax_bg'] == 'yes')
            ){

            echo "
            <script>
                window.elementskit_section_parallax_data.section".$data['id']." = JSON.parse('".json_encode($settings)."');
            </script>
            ";
        }
    }

}