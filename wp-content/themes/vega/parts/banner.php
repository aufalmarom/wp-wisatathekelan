<?php
/**
 * The template part for displaying the top banner across all pages
 *
 * @package vega
 */
?>
<?php global $vega_wp_defaults; ?>

<?php $custom_header = get_header_image(); ?>

<?php  

if ( is_front_page() ) {  
    get_template_part('parts/frontpage', 'banner');
} 

else if (is_home()) {
    $vega_wp_blog_feed_banner = vega_wp_get_option('vega_wp_blog_feed_banner'); 
    if($vega_wp_blog_feed_banner == 'None'){
        get_template_part('parts/banner', 'none');
    } else if($vega_wp_blog_feed_banner == 'Custom Header' && get_header_image() != ''){
        get_template_part('parts/banner', 'custom-header');
    } else {
        get_template_part('parts/banner', 'none');
    } 
} 

else if(is_page()){ 
    $vega_wp_page_banner = vega_wp_get_option('vega_wp_page_banner'); 
    if($vega_wp_page_banner == 'None'){
        get_template_part('parts/banner', 'none');
    } else if($vega_wp_page_banner == 'Custom Header' && get_header_image() != ''){ 
        get_template_part('parts/banner', 'custom-header');
    } else if($vega_wp_page_banner == 'Featured Image'){
        get_template_part('parts/banner', 'featured-image');
    } else {
        get_template_part('parts/banner', 'none');
    } 
} 

else if(is_single()){
    $vega_wp_post_banner = vega_wp_get_option('vega_wp_post_banner'); 
    if($vega_wp_post_banner == 'None'){
        get_template_part('parts/banner', 'none');
    } else if($vega_wp_post_banner == 'Custom Header' && get_header_image() != ''){
        get_template_part('parts/banner', 'custom-header');
    } else if($vega_wp_post_banner == 'Featured Image'){
        get_template_part('parts/banner', 'featured-image');
    } else {
        get_template_part('parts/banner', 'none');
    }
} 

else {
    $vega_wp_blog_feed_banner = vega_wp_get_option('vega_wp_blog_feed_banner'); 
    if($vega_wp_blog_feed_banner == 'None'){
        get_template_part('parts/banner', 'none');
    } else if($vega_wp_blog_feed_banner == 'Custom Header' && get_header_image() != ''){
        get_template_part('parts/banner', 'custom-header');
    } else {
        get_template_part('parts/banner', 'none');
    } 
} 

?>