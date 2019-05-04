<?php
/**
 * The template part for displaying the recent posts on the front page (static)
 *
 * @package vega
 */
?>
<?php 

$vega_wp_frontpage_latest_posts = vega_wp_get_option('vega_wp_frontpage_latest_posts');

if($vega_wp_frontpage_latest_posts == 'Y') { 

$vega_wp_frontpage_latest_posts_n = vega_wp_get_option('vega_wp_frontpage_latest_posts_n'); 
$vega_wp_frontpage_latest_posts_heading = vega_wp_get_option('vega_wp_frontpage_latest_posts_heading'); 
$vega_wp_frontpage_latest_posts_section_id = vega_wp_get_option('vega_wp_frontpage_latest_posts_section_id'); 

$class = vega_wp_get_col_class($vega_wp_frontpage_latest_posts_n);
$classes = explode('|', $class);
?>
<!-- ========== Latest Posts ========== -->
<div class="section frontpage-recent-posts" id="<?php echo esc_attr($vega_wp_frontpage_latest_posts_section_id) ?>" <?php  vega_wp_section_bg_color('vega_wp_frontpage_latest_posts_bg_color'); ?>>
    <div class="container">
    
        <?php if($vega_wp_frontpage_latest_posts_heading != '') { ?>
        <h2 class="block-title wow bounceIn"><?php echo esc_html($vega_wp_frontpage_latest_posts_heading) ?></h2>
        <?php } ?>
    
        <div class="row">
            <?php 
            global $post; $i = 0;
            $args = array( 'numberposts' => $vega_wp_frontpage_latest_posts_n, 'suppress_filters'=>0  );
            $recent_posts = get_posts( $args ); 
            foreach( $recent_posts as $post ){
            setup_postdata( $post ); 
            ?>
            <div class="<?php echo $classes[$i]; $i++; ?> wow zoomIn">
                <?php get_template_part('parts/content','recent'); ?>
            </div>
            <?php } ?>
            <?php wp_reset_postdata();?>
        </div>
        
    </div>
</div>
<!-- ========== /Latest Posts ========== --> 
<?php } ?>