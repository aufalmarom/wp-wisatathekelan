<?php
add_action( 'wp_enqueue_scripts', 'gaga_corp_enqueue_styles');
function gaga_corp_enqueue_styles() {
    wp_enqueue_style( 'corp-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'corp_faq_style', get_stylesheet_directory_uri() . '/js/faq/jquery.simpleFAQ.css' );
    wp_enqueue_script( 'corp_faq_simple',get_stylesheet_directory_uri() .'/js/faq/jquery.simpleFAQ.js',array('jquery') );
    wp_enqueue_script( 'gaga_corp__custom_js',get_stylesheet_directory_uri() .'/js/child_custom.js',array('jquery','corp_faq_simple') );   
}

function gaga_corp_admin_enqueue() {
    $currentScreen = get_current_screen();
    if( $currentScreen->id == "widgets" ) {
    wp_enqueue_media();
    wp_enqueue_script( 'corp_my_custom_script',get_stylesheet_directory_uri() .'/inc/widget/js/gaga_corp_media_uploader.js' );
    }    
}

add_action( 'admin_enqueue_scripts', 'gaga_corp_admin_enqueue' );
     require get_stylesheet_directory() . '/inc/customizer.php';
     require get_stylesheet_directory().'/css/gaga-corp-custom-css.php';
     
     
/** Gaga COrp Sections **/  
function gaga_lite_get_menu_sections(){
    $sections = array('about','feature','team','skill','shop','service','progress_faq','testimonial','portfolio','news_letter','client','pricing','blog','map');
    $enabled_section = array();
    foreach($sections as $section) :
        if(get_theme_mod('gaga-lite-'.$section.'_enable_disable') == 1) :
            $enabled_section[] = array(
                'id' => 'plx_'.$section.'_section',
                'menu_text' => get_theme_mod('gaga-lite-'.$section.'_menu_title'),
                'section' => $section,
            ); 
        endif;
    endforeach;
    return $enabled_section;
}

/** Gaga Corp Option Replace **/
function gaga_corp_import_parent_options(){
        $par_mods = get_option('theme_mods_gaga-lite');
        $chi_mods = get_option('theme_mods_gaga-corp');
        if( count($chi_mods) == 1 ) {
            update_option('theme_mods_gaga-corp', $par_mods);
        }
    }
    
add_action("after_switch_theme", "gaga_corp_import_parent_options");    
/** Gaga corp image size **/
function gaga_corp_setup_child(){
add_image_size('gaga_corp_footer_widget_work_image',165,105,true);
}
add_action( 'after_setup_theme', 'gaga_corp_setup_child' );
/** Widget **/
function gaga_corp_widgets_init_corp() {
register_sidebar(array(
    'name'=>esc_html__('Footer 4','gaga-corp'),
    'id'=>'gaga_corp_footer4',
    'description'=>'',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h1 class="widget-title">',
	'after_title'   => '</h1>',
    
));
register_sidebar(array(
    'name'=>esc_html__('News Letter','gaga-corp'),
    'id'=>'gaga_corp_news_letter',
    'description'=>'',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h1 class="widget-title">',
	'after_title'   => '</h1>',
    
));
register_sidebar(array(
    'name'=>esc_html__('Fearure Widget','gaga-corp'),
    'id'=>'gaga_corp_feature_widget',
    'description'=>'',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h1 class="widget-title">',
	'after_title'   => '</h1>',
    
));
register_sidebar(array(
    'name'=>esc_html__('Footer Twitter Slider','gaga-corp'),
    'id'=>'gaga_corp_footer_tweet_slider',
    'description'=>'',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h1 class="widget-title">',
	'after_title'   => '</h1>',
    
));
}
add_action( 'widgets_init', 'gaga_corp_widgets_init_corp', 11 );
require get_stylesheet_directory(). '/inc/widget/gaga-corp-news_letter.php';
require get_stylesheet_directory().'/inc/widget/gaga-corp-feature_widget.php';
require get_stylesheet_directory().'/inc/widget/gaga-corp-pricing-table.php';
require get_stylesheet_directory().'/inc/widget/gaga-corp-recent-work.php';
/** ===================================================================================**/
    /** Recent Post footer Widget Code Start **/
   

function gaga_lite_bg_color()
{
    $enabled_sections = gaga_lite_get_menu_sections();
    ?>
        <style>
            <?php foreach($enabled_sections as $enabled_section) : ?>
                <?php
                    $section = $enabled_section['section'];
                    $section_bg_color =      get_theme_mod('gaga-lite-'.$section.'_bg_color');
                    $section_bg_image =    get_theme_mod('gaga-lite-'.$section.'_bg_image');
                    $section_bg_repeat = get_theme_mod('gaga-lite-'.$section.'_bg_repeat', 'no-repeat');
                    $section_bg_position = get_theme_mod('gaga-lite-'.$section.'_bg_position', 'left');
                    $section_bg_attachment = get_theme_mod('gaga-lite-'.$section.'_bg_attachment', 'fixed');
                ?>
                #plx_<?php echo wp_kses_post($section).'_section'; ?>{
                    background: <?php echo esc_attr($section_bg_color).' url('.esc_url_raw($section_bg_image).') '.$section_bg_repeat.' '.$section_bg_attachment.' '.$section_bg_position; ?>
                }
            <?php endforeach; ?>
        </style>
    <?php
}
add_filter( 'widget_text', 'do_shortcode', 11);