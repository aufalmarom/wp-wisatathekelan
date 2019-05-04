<?php
add_action('customize_register','gaga_corp_add_customizer_child');
function gaga_corp_add_customizer_child($wp_customize){
$gaga_corp_page_lists =gaga_lite_page_lists();
$gaga_corp_category_lists = gaga_lite_category_lists();
$bg_repeat = array(
    'no-repeat'  => __('No Repeat', 'gaga-corp'),
    'repeat'     => __('Tile', 'gaga-corp'),
    'repeat-x'   => __('Tile Horizontally', 'gaga-corp'),
    'repeat-y'   => __('Tile Vertically', 'gaga-corp'),
);
    
$bg_position = array(
    'left'       => __('Left', 'gaga-corp'),
    'center'     => __('Center', 'gaga-corp'),
    'right'      => __('Right', 'gaga-corp'),
);

$bg_attachment = array(
    'fixed'      => __('Fixed', 'gaga-corp'),
    'scroll'     => __('Scroll', 'gaga-corp'),
);
/** gaga-corp Section **/

$wp_customize->add_section(
    'map_section',
    array(
        'title' => __('Map Section', 'gaga-corp'),
        'description' => __('Map section setting', 'gaga-corp'),
        'panel' => 'gaga-lite-home_page_panel'
    )
);
$wp_customize->add_section(
    'news_letter_section',
    array(
        'title' => __('News Letter Section', 'gaga-corp'),
        'description' => __('Newss Letter section setting', 'gaga-corp'),
        'panel' => 'gaga-lite-home_page_panel'
    )
);
$wp_customize->add_section(
    'progress_faq_section',
    array(
        'title'=>__('Progress Bar and FAQ Section','gaga-corp'),
        'description'=>__('Progerss Bar and FAQ Setting', 'gaga-corp'),
        'panel'=>'gaga-lite-home_page_panel'
    )
);
$wp_customize->add_section(
    'gaga-corp-feature_section',
    array(
        'title'=>__('Feature Section','gaga-corp'),
        'description'=>__('Setting for Feature Section', 'gaga-corp'),
        'panel'=>'gaga-lite-home_page_panel'
    )
);
/** gaga-corp Setting **/
$wp_customize->add_setting(
    'gaga-corp-map_page_select',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_page_select'                
    )
);
$wp_customize->add_setting(
    'gaga-lite-map_enable_disable',
    array(
        'default'=>0,
        'sanitize_callback'=>'gaga_lite_sanitize_checkbox'
    )
);
$wp_customize->add_setting(
    'gaga-lite-feature_enable_disable',
    array(
        'default'=>0,
        'sanitize_callback'=>'gaga_lite_sanitize_checkbox'
    )
);
$wp_customize->add_setting(
    'gaga-lite-news_letter_enable_disable',
    array(
        'default'=>0,
        'sanitize_callback'=>'gaga_lite_sanitize_checkbox'
    )
);
$wp_customize->add_setting(
    'gaga-corp-map_menu_title',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);

$wp_customize->add_setting(
    'gaga-lite-progress_faq_enable_disable',
    array(
        'default'=>0,
        'sanitize_callback'=>'gaga_lite_sanitize_checkbox'
    )
);
$wp_customize->add_setting(
    'gaga-corp-faq_cat',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_cat_select'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_faq_title',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);

$wp_customize->add_setting(
    'gaga-corp-progress_title1',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_percentage1',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_textarea'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_title2',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_percentage2',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_textarea'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_title3',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_percentage3',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_textarea'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_title4',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);
$wp_customize->add_setting(
    'gaga-corp-progress_percentage4',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_textarea'
    )
);
/** gaga-corp Control **/
$wp_customize->add_control(
        'gaga-corp-map_page_select',
        array(
            'label'=>__('Select page','gaga-corp'),
            'section'=>'map_section',
            'type'=>'select',
            'choices'=>$gaga_corp_page_lists,
            'priority'=>4,
        )
);

$wp_customize->add_control(
    'gaga-lite-news_letter_enable_disable',
    array(
        'label'=>__('Check to enable','gaga-corp'),
        'section'=>'news_letter_section',
        'type'=>'checkbox',
        'priority'=>1,
    )
);
$wp_customize->add_control(
    'gaga-corp-map_menu_title',
    array(
        'label'=>__('Menu Title','gaga-corp'),
        'section'=>'map_section',
        'type'=>'text',
        'priority'=>2,
    )
);

$wp_customize->add_control(
    'gaga-lite-progress_faq_enable_disable',
    array(
        'label'=>__('Check To Enable','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'checkbox',
        'priority'=>1,
    )
);
$wp_customize->add_control(
    'gaga-lite-feature_enable_disable',
    array(
        'label'=>__('Check To Enable','gaga-corp'),
        'section'=>'gaga-corp-feature_section',
        'type'=>'checkbox',
        'priority'=>1,
    )
);
$wp_customize->add_control(
    'gaga-lite-map_enable_disable',
    array(
        'label'=>__('Check To Enable','gaga-corp'),
        'section'=>'map_section',
        'type'=>'checkbox',
        'priority'=>1,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_faq_title',
    array(
        'label'=>__('Title','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'text',
        'priority'=>2,
    )
);

$wp_customize->add_control(
    'gaga-corp-faq_cat',
    array(
        'label'=>__('Select Category for FAQ','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'select',
        'choices'=>$gaga_corp_category_lists,
        'priority'=>15,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_title1',
    array(
        'label'=>__('Progress Title 1','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'text',
        'priority'=>5,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_percentage1',
    array(
        'label'=>__('Progress Percentage 1','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'number',
        'priority'=>6,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_title2',
    array(
        'label'=>__('Progress Title 2','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'text',
        'priority'=>7,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_percentage2',
    array(
        'label'=>__('Progress Percentage 2','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'number',
        'priority'=>8,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_title3',
    array(
        'label'=>__('Progress Title 3','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'text',
        'priority'=>9,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_percentage3',
    array(
        'label'=>__('Progress Percentage 3','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'number',
        'priority'=>10,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_title4',
    array(
        'label'=>__('Progress Title 4','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'text',
        'priority'=>11,
    )
);
$wp_customize->add_control(
    'gaga-corp-progress_percentage4',
    array(
        'label'=>__('Progress Percentage 4','gaga-corp'),
        'section'=>'progress_faq_section',
        'type'=>'number',
        'priority'=>12,
    )
);


   $wp_customize->add_setting(
    'gaga-corp-about_image',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_lite_sanitize_text'
    )
);

$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'gaga-corp-about_image',
           array(
               'label'      => __( 'About Section Image', 'gaga-corp' ),
               'section'    => 'gaga-lite-about_section',
               'settings'   => 'gaga-corp-about_image',
               'priority'   =>10
        )
       )
   );
   
   $wp_customize->add_setting(
    'gaga-corp-feature_bg_image',
    array(
        'default' => '',
        'sanitize_callback'=>'gaga_lite_sanitize_url',
    )
);

$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'gaga-corp-feature_bg_image',
           array(
               'label'      => __( 'Feature Background Image', 'gaga-corp' ),
               'section'    => 'gaga-corp-feature_section',
               'settings'   => 'gaga-corp-feature_bg_image',
               'priority'   =>11
        )
       )
   );
$wp_customize->add_setting(
    'gaga-corp-feature_bg_color',
    array(
        'default'=>'',
        'sanitize_callback'=>'gaga_corp_sanitize_text'
    )
);


$wp_customize->add_control(
       new WP_Customize_Color_Control(
           $wp_customize,
           'gaga-corp-feature_bg_color',
           array(
               'label'      => __( 'Feature Background color', 'gaga-corp' ),
               'section'    => 'gaga-corp-feature_section',
               'settings'   => 'gaga-corp-feature_bg_color',
               'priority'   =>10
        )
       )
   );
   
   
   $wp_customize->add_setting(
    'gaga-corp-feature_bg_position',
    array(
        'default' => 'right',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_position',
    )
);
$wp_customize->add_control(
    'gaga-corp-feature_bg_position',
            array(
                    'label'=>__('Background Position','gaga-corp'),
                    'section'=> 'gaga-corp-feature_section',
                    'type'=>'select',
                    'choices'=>$bg_position,
                    'priority'=>22,
                    'active_callback'=>'gaga_corp_bg_image_option_feature'
                )
);
$wp_customize->add_setting(
    'gaga-corp-feature_bg_attachment',
    array(
        'default' => 'fixed',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_attachment',
    )
);
$wp_customize->add_control(
    'gaga-corp-feature_bg_attachment',
            array(
                    'label'=>__('Background Attachment','gaga-corp'),
                    'section'=> 'gaga-corp-feature_section',
                    'type'=>'select',
                    'choices'=>$bg_attachment,
                    'priority'=>22,
                    'active_callback'=>'gaga_corp_bg_image_option_feature'
                )
);
$wp_customize->add_setting(
    'gaga-corp-feature_bg_repeat',
    array(
        'default' => 'no-repeat',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_repeat',
    )
);
$wp_customize->add_control(
    'gaga-corp-feature_bg_repeat',
            array(
                    'label'=>__('Background Repeat','gaga-corp'),
                    'section'=> 'gaga-corp-feature_section',
                    'type'=>'select',
                    'choices'=>$bg_repeat,
                    'priority'=>22,
                    'active_callback'=>'gaga_corp_bg_image_option_feature'
                )
);

 function gaga_corp_bg_image_option_feature( $control ) {
            if($control->manager->get_setting('gaga-corp-feature_bg_image')->value() != ''){
                return true;
                
            }else{
                return false;
            }
        }
 /** Pricing **/
    $wp_customize->add_setting(
    'gaga-lite-pricing_bg_image',
    array(
        'default' => '',
        'sanitize_callback'=>'gaga_lite_sanitize_url',
    )
);

$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'gaga-lite-pricing_bg_image',
           array(
               'label'      => __( 'Pricing Background Image', 'gaga-corp' ),
               'section'    => 'gaga-lite-pricing_section',
               'settings'   => 'gaga-lite-pricing_bg_image',
               'priority'   =>20
        )
       )
   );
   
   
   $wp_customize->add_setting(
    'gaga-corp-pricing_bg_position',
    array(
        'default' => 'right',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_position',
    )
);
$wp_customize->add_control(
    'gaga-corp-pricing_bg_position',
            array(
                    'label'=>__('Background Position','gaga-corp'),
                    'section'=> 'gaga-lite-pricing_section',
                    'type'=>'select',
                    'choices'=>$bg_position,
                    'priority'=>22,
                    'active_callback'=>'bg_image_option_pricing'
                )
);




$wp_customize->add_setting(
    'gaga-corp-pricing_bg_attachment',
    array(
        'default' => 'fixed',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_attachment',
    )
);
$wp_customize->add_control(
    'gaga-corp-pricing_bg_attachment',
            array(
                    'label'=>__('Background Attachment','gaga-corp'),
                    'section'=> 'gaga-lite-pricing_section',
                    'type'=>'select',
                    'choices'=>$bg_attachment,
                    'priority'=>22,
                    'active_callback'=>'bg_image_option_pricing'
                )
);
$wp_customize->add_setting(
    'gaga-corp-pricing_bg_repeat',
    array(
        'default' => 'no-repeat',
        'sanitize_callback'=>'gaga_lite_sanitize_bg_repeat',
    )
);
$wp_customize->add_control(
    'gaga-corp-pricing_bg_repeat',
            array(
                    'label'=>__('Background Repeat','gaga-corp'),
                    'section'=> 'gaga-lite-pricing_section',
                    'type'=>'select',
                    'choices'=>$bg_repeat,
                    'priority'=>22,
                    'active_callback'=>'bg_image_option_pricing'
                )
);


}