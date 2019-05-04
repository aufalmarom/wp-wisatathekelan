<?php
/**
 * The template part for displaying an open content section for the frontpage (static)
 *
 * @package vega
 */
?>
<?php 
$vega_wp_frontpage_open1 = vega_wp_get_option('vega_wp_frontpage_open1'); 

if($vega_wp_frontpage_open1 == 'Y') { 

$vega_wp_frontpage_open1_heading = vega_wp_get_option('vega_wp_frontpage_open1_heading'); 

global $post; //SiteOrign Page Builder fix
$open_content_page = get_post(vega_wp_get_option('vega_wp_frontpage_open1_content')); 
$post = $open_content_page ;
$vega_wp_frontpage_open1_content = apply_filters( 'the_content', $open_content_page->post_content );

$vega_wp_frontpage_open1_section_id = vega_wp_get_option('vega_wp_frontpage_open1_section_id'); 
?>
<!-- ========== Featured Section ========== -->
<div class="section frontpage-open1" id="<?php echo esc_attr($vega_wp_frontpage_open1_section_id) ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_open1_bg_color'); ?>>
    <div class="container">
        <h2 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_open1_heading) ?></h2>
        <div class="wow fadeIn"><?php echo $vega_wp_frontpage_open1_content; ?></div>
    </div>
</div>
<!-- ========== /Featured Section ========== -->
<?php 
wp_reset_postdata();
} ?>
