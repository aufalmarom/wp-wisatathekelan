<?php
/**
 * Customizer functionality
 *
 * @package vega
 */
?>
<?php

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function vega_wp_customize_register( $wp_customize ) {

    global $vega_wp_defaults;
    
     
    $wp_customize->add_section( 'vega_wp_upgrade_section' , array( 'title' => __( 'UPGRADE TO PRO', 'vega' ), 'priority' => 1, 'description' => '<h3>Upgrade to PRO to get all these awesome benefits!</h3>
    <ul><li>&raquo; Top Navbar Color, Opacity Choices</li><li>&raquo; Top Navbar Positioning Choices</li><li>&raquo; Unlimited Color Choices</li><li>&raquo; Google Font Choices</li><li>&raquo; Front Page Image and Video Slideshow (Normal and Full Screen)</li><li>&raquo; Front Page Video Banner</li><li>&raquo; Front Page Featured Pages</li><li>&raquo; Front Page Testimonials</li><li>&raquo; Front Page Team</li><li>&raquo; Front Page Logos/Partners</li><li>&raquo; Full Width 2 Column Blog Layout</li><li>&raquo; <strong>Personalized support and theme updates</strong></li><li>... many many more!</li></ul><p><a href="https://www.lyrathemes.com/vega/#comparison" target="_blank">Click here to view a comparison between the free and upgraded versions.</a></p><p><a href="https://www.lyrathemes.com/vega-pro/" target="_blank" class="button button-primary">Click here to view pricing and upgrade.</a></p>', 'vega') );

    $wp_customize->add_setting( 'vega_wp_upgrade_to_pro', array( 'default' => $vega_wp_defaults['vega_wp_upgrade_to_pro'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_upgrade_to_pro', array( 
                                    //'label' => __( 'UPGRADE TO PRO', 'vega' ), 
                                    'section' => 'vega_wp_upgrade_section',
                                    'settings' => 'vega_wp_upgrade_to_pro', 
                                    'type' => 'hidden',
                                    'description' => __('&nbsp;', 'vega') ) );

    $wp_customize->add_section( 'vega_wp_info_section' , array( 'title' => __( 'THEME INFO', 'vega' ), 'priority' => 2, 'description' => '<h3>Documentation and Sample Data</h3>
    <ul><li>&raquo; Click <a href="https://www.lyrathemes.com/documentation/vega.pdf" target="_blank">here</a> to view the documentation.</li><li>&raquo; Click <a href="https://www.lyrathemes.com/sample-data/vega-sample-data.zip" target="_blank">here</a> to download some sample data.</li></ul>
    <p>Please consider leaving us a review on <a href="https://wordpress.org/themes/vega" target="_blank">WordPress.org</a>!</p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>', 'vega') );

    $wp_customize->add_setting( 'vega_wp_info', array( 'default' => $vega_wp_defaults['vega_wp_info'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_info', array( 
                                    //'label' => __( 'INFO', 'vega' ), 
                                    'section' => 'vega_wp_info_section',
                                    'settings' => 'vega_wp_info', 
                                    'type' => 'hidden',
                                    'description' => __('&nbsp;', 'vega') ) );
    
    
    /*** vega_wp_general_settings_section ***/
    
    $wp_customize->add_section( 'vega_wp_general_settings_section' , array( 'title' => __( 'General Setup', 'vega' ), 'priority' => 3, 'description' => 'Please note: In order to set up the home page as shown in the <a href="http://www.lyrathemes.com/preview/?theme=vega" target="_blank">official demo on our website</a> (one page front page with sections), you will need to set up your front page to use a static page instead of showing your latest blog posts. You can change this from `Settings > Reading` or `Appearance > Customize > Static Front Page`', ) );

    $wp_customize->add_setting( 'vega_wp_enable_demo', array( 'default' => $vega_wp_defaults['vega_wp_enable_demo'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_enable_demo', array( 
                                    'label' => __( 'Enable Demo?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_wp_enable_demo', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('When the theme is first installed, the demo mode would be turned OFF. Turn it on to view a demo one page home page. This demo home page will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turned this off.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_animations', array( 'default' => $vega_wp_defaults['vega_wp_animations'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_animations', array( 
                                    'label' => __( 'Enable Animations?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_wp_animations', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('By default, animations are enabled.', 'vega') ) );
    $wp_customize->add_setting( 'vega_hide_footer_widgets', array( 'default' => $vega_wp_defaults['vega_hide_footer_widgets'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_hide_footer_widgets', array( 
                                    'label' => __( 'Hide Footer Widgets?', 'vega' ), 
                                    'section' => 'vega_wp_general_settings_section',
                                    'settings' => 'vega_hide_footer_widgets', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Footer widgets (the section/columns right above the footer copyright area) can be removed by setting this option to `Yes`.', 'vega') ) );
    /*** vega_wp_logo_section ***/
    
    //$wp_customize->add_section( 'vega_wp_logo_section' , array( 'title' => __( 'Logo Options', 'vega' ), 'priority' => 35, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_show_logo_image', array( 'default' => $vega_wp_defaults['vega_wp_show_logo_image'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_show_logo_image', array( 
                                    'label' => __( 'Show Image Logo?', 'vega' ), 
                                    'section' => 'title_tagline',
                                    'settings' => 'vega_wp_show_logo_image', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether to display the logo image set up under `Site Identity`.', 'vega') ) );

    $wp_customize->add_setting( 'vega_wp_logo_text', array( 'default' => $vega_wp_defaults['vega_wp_logo_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_logo_text', array( 
                                    'label' => __('Text Logo', 'vega'), 
                                    'section' => 'title_tagline',
                                    'type' => 'text', 
                                    'description' => __('Displayed when `Show Image Logo?` is `No` or if there is no logo image uploaded.', 'vega') ));
    
    
    /*** vega_wp_colors_section ***/
    
    //$wp_customize->add_section( 'vega_wp_colors_section' , array( 'title' => __( 'Colors', 'vega' ), 'priority' => 40, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_color_stylesheet', array( 'default' => $vega_wp_defaults['vega_wp_color_stylesheet'], 'sanitize_callback' => 'vega_wp_sanitize_radio_colors' ) );
    $wp_customize->add_control( 'vega_wp_color_stylesheet', array( 
                                    'label' => __( 'Select Color Scheme', 'vega' ), 
                                    'section' => 'colors',
                                    'settings' => 'vega_wp_color_stylesheet', 'type' => 'radio', 
                                    'choices' => array('Orange'=>__('Orange (Default)', 'vega'), 'Blue'=>__('Blue', 'vega'), 'Green'=>__('Green', 'vega')),
                                    'description' => __('Choose a color scheme. Default color scheme is Orange.', 'vega') ) );
                                    
    /*** vega_wp_frontpage_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_section' , array( 'title' => __( 'Front Page', 'vega' ), 'priority' => 45, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner', array( 
                                    'label' => __( 'Front Page Header', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Image Banner'=>__('Image Banner (Parallax)', 'vega'), 'Full Screen Image'=>__('Full Screen Image (Parallax)', 'vega'), 'Simple Banner' => __('As-is Simple Responsive Image Banner (No Parallax)', 'vega') ),
                                    'description' => __('Image Banner is shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_content'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_content', array( 
                                    'label' => __( 'Show Main Content Area?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_content', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to display the page content area on front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark', array( 
                                    'label' => __( 'Show Call to Action Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to display the Call to Action section on the front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2', array( 
                                    'label' => __( 'Show Call to Action #2 Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark2', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to display the second Call to Action section on the front page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_4cols', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4cols'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4cols', array( 
                                    'label' => __( 'Show the 4 Columns Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_4cols', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether to display the section containing 4 columns, each linking to a page - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_open1', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1', array( 
                                    'label' => __( 'Show Open Content Area?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_open1', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether to display the open content section - applies when the front page is set to display a static page under Settings->Reading. You can enter HTML and/or shortcodes in this area. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts', array( 
                                    'label' => __( 'Show the Latest Posts Section?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_section',
                                    'settings' => 'vega_wp_frontpage_latest_posts', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether to display the latest blog posts - applies when the front page is set to display a static page under Settings->Reading. Shown by default.', 'vega') ) );
    
    /*** vega_wp_frontpage_positions_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_positions_section' , array( 'title' => __('&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Row Positions', 'vega' ), 'priority' => 46, 'description' => __('Enter numbers for each of these sections. The sections will be sorted from lowest number to highest.', 'vega'), ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_content'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_content', array( 
                                    'label' => __( 'Main Content', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_content', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_cta_dark', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_cta_dark'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_cta_dark', array( 
                                    'label' => __( 'Call to Action', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_cta_dark', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_cta_dark2', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_cta_dark2'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_cta_dark2', array( 
                                    'label' => __( 'Call to Action #2', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_cta_dark2', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_4cols', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_4cols'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_4cols', array( 
                                    'label' => __( 'Icon Columns', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_4cols', 
                                    'type' => 'number' ) );
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_latest_posts', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_latest_posts'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_latest_posts', array( 
                                    'label' => __( 'Latest Posts', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_latest_posts', 
                                    'type' => 'number' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_position_open1', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_position_open1'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_position_open1', array( 
                                    'label' => __( 'Open Content', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_positions_section',
                                    'settings' => 'vega_wp_frontpage_position_open1', 
                                    'type' => 'number' ) );
    
    /*** vega_wp_frontpage_banner_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_banner_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Banner', 'vega' ), 'priority' => 47, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_image', array( 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_banner_image', array( 
                                    'label' => __( 'Upload Frontpage Banner', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_banner_section', 
                                    'settings' => 'vega_wp_frontpage_banner_image',
                                    'description' => __('If not uploaded, the Header Image will be displayed (if available).', 'vega') ) ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner_heading', array( 
                                    'label' => __('Banner Heading', 'vega'), 
                                    'section' => 'vega_wp_frontpage_banner_section',
                                    'type' => 'text', 
                                    'description' => __('Displayed as a heading on the frontpage banner image.', 'vega') ));
                                    
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_banner_text', array( 
                                    'label' => __('Banner Text', 'vega'), 
                                    'section' => 'vega_wp_frontpage_banner_section',
                                    'type' => 'textarea', 
                                    'description' => __('Displayed under the main heading on the frontpage banner image. Accepts HTML. Note: If you would like to hide the banner heading and text complete, go to Site Identity and check off `Display Site Title and Tagline`.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_banner_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_banner_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_banner_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'This color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_banner_section' ) ) );
                                    
    /*** vega_wp_frontpage_cta_dark_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_cta_dark_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Frontpage - CTA Section', 'vega' ), 'priority' => 48, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_content', array( 
                                    'label' => __('CTA Section Content', 'vega'), 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage call to action section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_parallax', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_parallax'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_parallax', array( 
                                    'label' => __( 'Enable Parallax?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark_parallax', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Turn this on to show an image in the background of this section with the parallax effect. Requires an image to be uploaded in the next setting.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_bg_image', array( 'default'=>$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_image'], 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_cta_dark_bg_image', array( 
                                    'label' => __( 'Background Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_cta_dark_section', 
                                    'settings' => 'vega_wp_frontpage_cta_dark_bg_image',
                                    'description' => __('Background image for this section.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_cta_dark_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'If no background image is provided, this background color will be used for the CTA. If a background image is provided, then this color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_cta_dark_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark_section_id', array( 
                                    'label' => __('Section ID', 'vega'), 
                                    'section' => 'vega_wp_frontpage_cta_dark_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
    
    /*** vega_wp_frontpage_cta_dark2_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_cta_dark2_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Frontpage - CTA Section #2', 'vega' ), 'priority' => 48, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_content', array( 
                                    'label' => __('CTA Section Content', 'vega'), 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage call to action section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_parallax', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_parallax'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_parallax', array( 
                                    'label' => __( 'Enable Parallax?', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'settings' => 'vega_wp_frontpage_cta_dark2_parallax', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Turn this on to show an image in the background of this section with the parallax effect. Requires an image to be uploaded in the next setting.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_bg_image', array( 'default'=>$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_image'], 'sanitize_callback' => 'vega_wp_sanitize_url' ) ) ;
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vega_wp_frontpage_cta_dark2_bg_image', array( 
                                    'label' => __( 'Background Image', 'vega' ),
                                    'section'  => 'vega_wp_frontpage_cta_dark2_section', 
                                    'settings' => 'vega_wp_frontpage_cta_dark2_bg_image',
                                    'description' => __('Background image for this section.', 'vega') ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_cta_dark2_bg_color', array(
                                    'label' => __( 'Background / Filter Color', 'vega' ),
                                    'description' => __( 'If no background image is provided, this background color will be used for the CTA. If a background image is provided, then this color will be used as the overlay/filter. Leave this as blank to remove the filter.', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_cta_dark2_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_cta_dark2_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_cta_dark2_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_cta_dark2_section_id', array( 
                                    'label' => __('Section ID', 'vega'), 
                                    'section' => 'vega_wp_frontpage_cta_dark2_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
    
    
    
    /*** vega_wp_frontpage_4_cols_panel ***/

    $wp_customize->add_panel( 'vega_wp_frontpage_4_cols_panel', array( 'priority' => 49, 'capability' => 'edit_theme_options', 'theme_supports' => '', 'title' => __('&nbsp;&nbsp;&nbsp;&nbsp; Front Page - Icon Columns', 'vega'), 'description' => '' ) );
    
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_section' , array( 'title' => __( 'General', 'vega' ), 'priority' => 49, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_4cols_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4cols_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4cols_n', array( 
                                    'label' => __( 'Number of Columns', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'settings' => 'vega_wp_frontpage_4cols_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2','3'=>'3','4'=>'4'),
                                    'description' => __('Default = 4.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_heading', array( 
                                    'label' => __('Heading', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to be displayed for this section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_text', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_text'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_text', array( 
                                    'label' => __('Text/Description', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'textarea', 
                                    'description' => __('Text to be displayed under the heading. Accepts HTML.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_read_more', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_read_more'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_read_more', array( 
                                    'label' => __('`Read More` Label', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('The label for the `Read More` button. Leave blank to hide button.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_4_cols_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_4_cols_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_section_id', array( 
                                    'label' => __('Section ID', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_col_1_section' , array( 'title' => __( 'Icon Column 1', 'vega' ), 'priority' => 49, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_col_2_section' , array( 'title' => __( 'Icon Column 2', 'vega' ), 'priority' => 49, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_col_3_section' , array( 'title' => __( 'Icon Column 3', 'vega' ), 'priority' => 49, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    $wp_customize->add_section( 'vega_wp_frontpage_4_cols_col_4_section' , array( 'title' => __( 'Icon Column 4', 'vega' ), 'priority' => 49, 'description' => '', 'panel'=>'vega_wp_frontpage_4_cols_panel' ) );
    
    #start loop for icons
    for($i=1;$i<=4;$i++) { 
    
    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_'.$i.'_icon', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_'.$i.'_icon'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_'.$i.'_icon', array( 
                                    'label' => __('Column Icon', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_col_'.$i.'_section',
                                    'type' => 'text', 
                                    'description' => __('Select the icon for this column. See http://fontawesome.io/icons/ for full list of supported icons.', 'vega') ));

    $wp_customize->add_setting( 'vega_wp_frontpage_4_cols_'.$i, array( 'default' => $vega_wp_defaults['vega_wp_frontpage_4_cols_'.$i], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_4_cols_'.$i, array( 
                                    'label' => __('Column Page', 'vega'), 
                                    'section' => 'vega_wp_frontpage_4_cols_col_'.$i.'_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page for this column.', 'vega') ));
    } #end loop for columns
    
    
    /*** vega_wp_frontpage_open1_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_open1_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Frontpage - Open Content', 'vega' ), 'priority' => 50, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_heading', array( 
                                    'label' => __('Section Heading', 'vega'), 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to display for this section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_content', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_content'], 'sanitize_callback' => 'vega_wp_sanitize_page' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_content', array( 
                                    'label' => __('Section Content', 'vega'), 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'dropdown-pages', 
                                    'allow_addition' => true,
                                    'description' => __('Select the page where you have entered the text to display on the frontpage open content section. ', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_open1_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_open1_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_open1_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_open1_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_open1_section_id', array( 
                                    'label' => __('Section ID', 'vega'), 
                                    'section' => 'vega_wp_frontpage_open1_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    /*** vega_wp_frontpage_latest_posts_section ***/
    
    $wp_customize->add_section( 'vega_wp_frontpage_latest_posts_section' , array( 'title' => __( '&nbsp;&nbsp;&nbsp;&nbsp; Frontpage - Latest Posts Section', 'vega' ), 'priority' => 51, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_n', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_n'], 'sanitize_callback' => 'vega_wp_sanitize_number' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_n', array( 
                                    'label' => __( 'Number of Posts', 'vega' ), 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'settings' => 'vega_wp_frontpage_latest_posts_n', 
                                    'type' => 'select',
                                    'choices' => array('1'=>'1', '2'=>'2','3'=>'3'),
                                    'description' => __('Default = 3.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_heading', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_heading'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_heading', array( 
                                    'label' => __('Heading', 'vega'), 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'type' => 'text', 
                                    'description' => __('Heading to display for section.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_bg_color', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_bg_color'], 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vega_wp_frontpage_latest_posts_bg_color', array(
                                    'label' => __( 'Background Color', 'vega' ),
                                    'section'     => 'vega_wp_frontpage_latest_posts_section' ) ) );
    $wp_customize->add_setting( 'vega_wp_frontpage_latest_posts_section_id', array( 'default' => $vega_wp_defaults['vega_wp_frontpage_latest_posts_section_id'], 'sanitize_callback' => 'vega_wp_sanitize_html_class' ) );
    $wp_customize->add_control( 'vega_wp_frontpage_latest_posts_section_id', array( 
                                    'label' => __('Section ID', 'vega'), 
                                    'section' => 'vega_wp_frontpage_latest_posts_section',
                                    'type' => 'text', 
                                    'description' => __('ID for this section - if you want the user to be able to scroll down to this section.', 'vega') ));
                                    
    /*** vega_wp_blog_feed_section ***/
    
    $wp_customize->add_section( 'vega_wp_blog_feed_section' , array( 'title' => __( 'Blog Feed', 'vega' ), 'priority' => 60, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_blog_feed_meta', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta', array( 
                                    'label' => __( 'Show Meta Information?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the date, author, and category for each post in the blog feed. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_date', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_date'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_date', array( 
                                    'label' => __( 'Show Date?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_date', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the date for each post in the blog feed. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_category', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_category'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_category', array( 
                                    'label' => __( 'Show Category?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_category', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the category for each post in the blog feed. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_blog_feed_meta_author', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_meta_author'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_meta_author', array( 
                                    'label' => __( 'Show Author?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_meta_author', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the author for each post in the blog feed. Hidden by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_blog_feed_display', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_display'], 'sanitize_callback' => 'vega_wp_sanitize_radio_blog_feed_display' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_display', array( 
                                    'label' => __( 'Select Post Display Format', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_display', 
                                    'type' => 'radio', 
                                    'choices' => array(
                                        'Small Image Left, Excerpt Right'=>__('Small Image Left, Excerpt Right', 'vega'), 
                                        'Large Image Top, Full Content Below'=>__('Large Image Top, Full Content Below', 'vega'), 
                                        'No Image, Excerpt'=>__('No Image, Excerpt', 'vega')
                                        ),
                                    'description' => __('Choose how you want to display each post in the blog feed. `Small Image Left, Excerpt Right` by default.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_banner', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_banner', array( 
                                    'label' => __( 'Blog Feed Banner', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>__('Custom Header', 'vega'), 'None'=>__('None', 'vega')),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_animations', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_animations'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_animations', array( 
                                    'label' => __( 'Enable Animations?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_animations', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Whether or not to enable animations for the blog page. Requires that the animations be turned on in the `General Setup` section. By default, animations are enabled.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_buttons', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_buttons'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_buttons', array( 
                                    'label' => __( 'Show Post Buttons?', 'vega' ), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'settings' => 'vega_wp_blog_feed_buttons', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Select No to hide the `Read More`, `Comments` buttons for posts. Shown by default.', 'vega') ) );
    $wp_customize->add_setting( 'vega_wp_blog_feed_readmore_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_readmore_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_readmore_text', array( 
                                    'label' => __('`Read Me` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Read More` button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_comment_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_comment_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_comment_text', array( 
                                    'label' => __('`Comment` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Comment` (singular) button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_comments_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_comments_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_comments_text', array( 
                                    'label' => __('`Comments` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Comments` (plural) button for posts.', 'vega') ));
    $wp_customize->add_setting( 'vega_wp_blog_feed_nocomments_text', array( 'default' => $vega_wp_defaults['vega_wp_blog_feed_nocomments_text'], 'sanitize_callback' => 'vega_wp_sanitize_text' ) );
    $wp_customize->add_control( 'vega_wp_blog_feed_nocomments_text', array( 
                                    'label' => __('`Leave Comment` Button Label', 'vega'), 
                                    'section' => 'vega_wp_blog_feed_section',
                                    'type' => 'text', 
                                    'description' => __('The words to show on the `Leave Comment` (when there are no comments) button for posts.', 'vega') ));
                                    
    /*** vega_wp_post_section ***/
    
    $wp_customize->add_section( 'vega_wp_post_section' , array( 'title' => __( 'Blog Post', 'vega' ), 'priority' => 65, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_post_title', array( 'default' => $vega_wp_defaults['vega_wp_post_title'], 'sanitize_callback' => 'vega_wp_sanitize_radio_post_page_titles' ) );
    $wp_customize->add_control( 'vega_wp_post_title', array( 
                                    'label' => __( 'Heading/Title Location:', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_title', 
                                    'type' => 'radio', 
                                    'choices' => array('Both'=>__('Inside Banner + Above Content (Default)', 'vega'), 'Banner'=>__('Just Inside Banner', 'vega'), 'Content'=>__('Just Above Content', 'vega')),
                                    'description' => __('Choose where you want to show the post title.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta', array( 'default' => $vega_wp_defaults['vega_wp_post_meta'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta', array( 
                                    'label' => __( 'Show Meta Information?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the date, author, and category on the posts page. Shown by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_meta_date', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_date'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_date', array( 
                                    'label' => __( 'Show Date?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_date', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the date on the post page. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta_category', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_category'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_category', array( 
                                    'label' => __( 'Show Category?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_category', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the category on the post page. Shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_meta_author', array( 'default' => $vega_wp_defaults['vega_wp_post_meta_author'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_meta_author', array( 
                                    'label' => __( 'Show Author?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_meta_author', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the author on the post page. Hidden by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_tags', array( 'default' => $vega_wp_defaults['vega_wp_post_tags'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_tags', array( 
                                    'label' => __( 'Show Tags?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_tags', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Choose whether you want to show the tags on the post page. Hidden by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_banner', array( 'default' => $vega_wp_defaults['vega_wp_post_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_post_banner', array( 
                                    'label' => __( 'Post Page Banner', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>__('Custom Header', 'vega'), 'Featured Image'=>__('Featured Image', 'vega'), 'None'=>__('None', 'vega')),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_post_sidebar', array( 'default' => $vega_wp_defaults['vega_wp_post_sidebar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_sidebar', array( 
                                    'label' => __( 'Show Sidebar?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_sidebar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Sidebar is shown by default.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_post_featured_image', array( 'default' => $vega_wp_defaults['vega_wp_post_featured_image'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_post_featured_image', array( 
                                    'label' => __( 'Show Featured Image?', 'vega' ), 
                                    'section' => 'vega_wp_post_section',
                                    'settings' => 'vega_wp_post_featured_image', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Whether to show the featured image at the beginning of the post.', 'vega') ) );

    /*** vega_wp_page_section ***/
    
    $wp_customize->add_section( 'vega_wp_page_section' , array( 'title' => __( 'Pages', 'vega' ), 'priority' => 70, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_page_title', array( 'default' => $vega_wp_defaults['vega_wp_page_title'], 'sanitize_callback' => 'vega_wp_sanitize_radio_post_page_titles' ) );
    $wp_customize->add_control( 'vega_wp_page_title', array( 
                                    'label' => __( 'Heading/Title Location:', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_title', 
                                    'type' => 'radio', 
                                    'choices' => array('Both'=>__('Inside Banner + Above Content (Default)', 'vega'), 'Banner'=>__('Just Inside Banner', 'vega'), 'Content'=>__('Just Above Content', 'vega')),
                                    'description' => __('Choose where you want to show the page title.', 'vega') ) );
                                    
    $wp_customize->add_setting( 'vega_wp_page_banner', array( 'default' => $vega_wp_defaults['vega_wp_page_banner'], 'sanitize_callback' => 'vega_wp_sanitize_radio_banner' ) );
    $wp_customize->add_control( 'vega_wp_page_banner', array( 
                                    'label' => __( 'Post Page Banner', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_banner', 
                                    'type' => 'radio', 
                                    'choices' => array('Custom Header'=>__('Custom Header', 'vega'), 'Featured Image'=>__('Featured Image', 'vega'), 'None'=>__('None', 'vega')),
                                    'description' => __('The Custom Header can be set from the `Header Image` section. Custom Header is shown as the banner by default.', 'vega') ) );
    
    $wp_customize->add_setting( 'vega_wp_page_sidebar', array( 'default' => $vega_wp_defaults['vega_wp_page_sidebar'], 'sanitize_callback' => 'vega_wp_sanitize_radio_yn' ) );
    $wp_customize->add_control( 'vega_wp_page_sidebar', array( 
                                    'label' => __( 'Show Sidebar?', 'vega' ), 
                                    'section' => 'vega_wp_page_section',
                                    'settings' => 'vega_wp_page_sidebar', 
                                    'type' => 'radio', 
                                    'choices' => array('Y'=>__('Yes', 'vega'), 'N'=>__('No', 'vega')),
                                    'description' => __('Sidebar is shown by default.', 'vega') ) );
                                                                        
    /*** vega_advanced_section ***/
    if(vega_show_custom_css_field()) {
    $wp_customize->add_section( 'vega_wp_advanced_section' , array( 'title' => __( 'Advanced Settings', 'vega' ), 'priority' => 80, 'description' => '', ) );

    $wp_customize->add_setting( 'vega_wp_custom_css', array( 'default' => $vega_wp_defaults['vega_wp_custom_css'], 'sanitize_callback' => 'wp_filter_nohtml_kses' ) );
    $wp_customize->add_control( 'vega_wp_custom_css', array( 
                                    'label' => __( 'Custom CSS', 'vega' ), 
                                    'section' => 'vega_wp_advanced_section',
                                    'settings' => 'vega_wp_custom_css', 
                                    'type' => 'textarea', 
                                    'description' => __('Custom CSS code.', 'vega') ) );
    }
    
    /*** vega_wp_footer_section ***/
    
    $wp_customize->add_section( 'vega_wp_footer_section' , array( 'title' => __( 'Footer Settings', 'vega' ), 'priority' => 75, 'description' => '', ) );
    
    $wp_customize->add_setting( 'vega_wp_footer_copyright_message', array( 'default' => $vega_wp_defaults['vega_wp_footer_copyright_message'], 'sanitize_callback' => 'vega_wp_sanitize_html' ) );
    $wp_customize->add_control( 'vega_wp_footer_copyright_message', array( 
                                    'label' => __('Footer Copyright', 'vega'), 
                                    'section' => 'vega_wp_footer_section',
                                    'type' => 'textarea', 
                                    'description' => __('Displayed as the copyright notice at the bottom of the page. Accepts HTML.', 'vega') ));
    
    //$wp_customize->remove_section('colors');
    //$wp_customize->remove_section('background_image');
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->get_section('colors')->title = __( 'Custom Colors', 'vega' );
}
add_action( 'customize_register', 'vega_wp_customize_register' );



/*** Sanitize ***/

function vega_wp_sanitize_html( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function vega_wp_sanitize_text( $input ) {
    return sanitize_text_field( $input );
}

function vega_wp_sanitize_radio_yn( $input ) {
    $valid = array(
        'Y' => 'Yes',
        'N' => 'No'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Y';
    }
}

function vega_wp_sanitize_radio_frontpage_banner( $input ) {
    $valid = array(
        'Full Screen' => 'Full Screen',
        'Banner' => 'Banner'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Banner';
    }
}

function vega_wp_sanitize_radio_colors( $input ) {
    $valid = array(
        'Green' => 'Green',
        'Orange' => 'Orange',
        'Blue' => 'Blue'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Orange';
    }
}
function vega_wp_sanitize_radio_blog_feed_display( $input ) {
    $valid = array(
        'Small Image Left, Excerpt Right'=>'Small Image Left, Excerpt Right', 
        'Large Image Top, Full Content Below'=>'Large Image Top, Full Content Below', 
        'No Image, Excerpt'=>'No Image, Excerpt'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Small Image Left, Excerpt Right';
    }
}
function vega_wp_sanitize_radio_post_page_titles( $input ) {
    $valid = array(
        'Both'=>'Both', 
        'Banner'=>'Banner', 
        'Content'=>'Content'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'Both';
    }
}
function vega_wp_sanitize_radio_banner( $input ) {
    $valid = array(
        'Image Banner'=>'Image Banner', 
        'Full Screen Image'=>'Full Screen Image',
        'Custom Header' => 'Custom Header',
        'None' => 'None',
        'Featured Image' => 'Featured Image',
        'Simple Banner' => 'Simple Banner'
    );
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return 'None';
    }
    
}
function vega_wp_sanitize_number( $input ) {
    $input = (int)$input;
    $input = absint($input);
    if(is_int($input))
        return $input;
    else
        return '0';
} 
function vega_wp_sanitize_page($input) {
    $input = (int)$input;
    $input = absint($input);
    if(is_int($input))
        return $input;
    else
        return '0';
} 
function vega_wp_sanitize_url($input) {
    return esc_url_raw($input);
}    
function vega_wp_sanitize_html_class($input) {
    return sanitize_html_class($input);
}
?>