<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }


$options = array(
  
    
    'exhibs_speaker_id' => array(
        'type' => 'tab',
        'options' => array(
            array(
                'type'    => 'tab',
                'options' => array(
                    'exhibs_designation' => array(
                    'label' => esc_html__('Designation', 'exhibz'),
                    'type' => 'text',
                    'value' => '',
                   
                ),
                    'exhibs_photo' => array(
                        'label' => esc_html__('Profile Photo', 'exhibz'),
                        'type' => 'upload',
                        'value' => array(),
                        'images_only' => true,
                        'files_ext' => array( 'jpg', 'jpeg', 'png'),
                    
                    ),
                    'exhibs_logo' => array(
                    'label' => esc_html__('Logo', 'exhibz'),
                    'type' => 'upload',
                    'value' => array(),
                    'images_only' => true,
                    'files_ext' => array( 'jpg', 'jpeg', 'png'),
                   
                ),
             
                    'exhibs_summery' => array(
                    'label' => esc_html__('Summary', 'exhibz'),
                    'type' => 'wp-editor',
                    'value' => '',
                   
                ),
               

            ),
                  
            )
        ),
        'title' => esc_html__('Speaker Details', 'exhibz'),
 
    
        
    ),
    "social" =>array(
        'type' => 'addable-popup',
        'label' => esc_html__('Social Link', 'exhibz'),
        'template' => '{{- option_site_name }}',
        'popup-title' => 'Social Media Link',
        'size' => 'small', // small, medium, large
        'limit' => 0, // limit the number of popup`s that can be added
        'add-button-text' => esc_html__('Add ', 'exhibz'),
        'sortable' => true,
        'popup-options' => array(
            'option_site_name' => array(
                'label' => esc_html__('Website Name', 'exhibz'),
                'type' => 'text',
                'value' => ''
   
            ),
            'option_site_link' => array(
                'label' => esc_html__('Website Link', 'exhibz'),
                'type' => 'text',
                'value' => ''
   
            ),
            'option_site_icon' => array(
                'label' => esc_html__('Icon', 'exhibz'),
                'type' => 'new-icon',
                'value' => ''
   
            ),
            
        ),
    ),
    
);