<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }
require_once( EXHIBZ_COMPONENTS . '/theme/options/inc/speaker-custom-quary.php');



$options = array(
    array(
        'type'    => 'box',
        'title'   => esc_html__('Day Title', 'exhibz'),
        
        'options' => array(
            'schedule_day'  => array( 'type' => 'text' )
          )
        ),
    'exhibz_schedule_pop_up' => 
    array(
        'type' => 'addable-popup',
        'value' => array(
            array(
                'schedule_title' => '',
                'schedule_time' => '',
            ),
        ),
        'label' => esc_html__('All Schedule', 'exhibz'),
        'desc'  => esc_html__('Add your schedule', 'exhibz'),
        'template' => '{{- schedule_title }} {{- schedule_time }}',
        'popup-title' => 'Schedule',
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => esc_html__('Add', 'exhibz'),
        'sortable' => true,
        'popup-options' => array(
           
            'schedule_time' => array(
                'type'  => 'text',
                'value' => '8:00 - 9:00',
                'label' => esc_html__('Time', 'exhibz'),
              
            ),
            'speakers' => array(
                'type'  => 'select',
                'label' => esc_html__('Speakers', 'exhibz'),
                'choices' => $speaker_list,
                'attr'  => array( 'class' => 'single-speaker-sw', 'data-foo' => 'single' ),      
                'no-validate' => false,
              
            ),

            'multi_speaker_choose' => array(
               'type'         => 'multi-picker',
               'label'        => false,
               'desc'         => false,
               'attr'  => array( 'class' => 'multi-speaker-sw', 'data-foo' => 'multi' ),
               'picker'       => array(
                   'style' => array(
                       'type'			 => 'switch',
                       'label'		 => esc_html__( 'Multi speaker ', 'exhibz' ),
                       
                      
                       'value'       => 'no',
                       'left-choice'	 => [
                          'value'   	     => 'yes',
                          'label'	        => esc_html__( 'Yes', 'exhibz' ),
                       ],
                       'right-choice'	 => [
                          'value'	 => 'no',
                          'label'	 => esc_html__( 'No', 'exhibz' ),
                       ],
                     
                   )
               ),
               'choices'      => array(

                    'yes' => array(
                     'multi_speakers' => array(
                        'type'  => 'multi-select',
                        'label' => esc_html__('Multi Speakers', 'exhibz'),
                        'choices' => $multi_speaker_list,      
                        'desc'    => esc_html__('Use elementor style multi tab circle', 'exhibz'),
                        'no-validate' => false,
                        'limit' => 3,
                    ),
                  
                    ),
                 
                 
                
               ),
               'show_borders' => false,
           ), 

          
            'schedule_title' => array(
                'type'  => 'text',
                'value' => '',
                'label' => esc_html__('Schedule Title', 'exhibz'),
              
            ),
            'schedule_note' => array(
                'type'  => 'wp-editor',
                'value' => '',
                'label' => esc_html__('Short Note', 'exhibz'),
              
            ),
        ),
    )

);
