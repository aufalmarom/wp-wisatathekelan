<?php
/**
 * The front page template file.
 * 
 * @package vega
 */
?>
<?php get_header(); ?>
<?php get_template_part('parts/banner'); ?>

<?php $vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo'); ?>

<?php if(get_option('show_on_front') == 'page' || $vega_wp_enable_demo == 'Y') { ?>

<?php 
$vega_wp_frontpage_position_content = vega_wp_get_option('vega_wp_frontpage_position_content'); 
$vega_wp_frontpage_position_4cols = vega_wp_get_option('vega_wp_frontpage_position_4cols'); 
$vega_wp_frontpage_position_cta_dark = vega_wp_get_option('vega_wp_frontpage_position_cta_dark'); 
$vega_wp_frontpage_position_cta_dark2 = vega_wp_get_option('vega_wp_frontpage_position_cta_dark2'); 
$vega_wp_frontpage_position_open1 = vega_wp_get_option('vega_wp_frontpage_position_open1'); 
$vega_wp_frontpage_position_latest_posts = vega_wp_get_option('vega_wp_frontpage_position_latest_posts'); 
$arr[$vega_wp_frontpage_position_content] = 'content';
$arr[$vega_wp_frontpage_position_4cols] = '4cols';
$arr[$vega_wp_frontpage_position_cta_dark] = 'cta_dark';
$arr[$vega_wp_frontpage_position_cta_dark2] = 'cta_dark2';
$arr[$vega_wp_frontpage_position_latest_posts] = 'latest_posts';
$arr[$vega_wp_frontpage_position_open1] = 'open1';
ksort($arr);

foreach($arr as $k=>$v){
    if($v == 'content') {   get_template_part('parts/frontpage', 'content'); }
    if($v == '4cols')   {   get_template_part('parts/frontpage', '4cols'); }
    if($v == 'cta_dark'){   get_template_part('parts/frontpage', 'cta-dark'); }
    if($v == 'cta_dark2'){  get_template_part('parts/frontpage', 'cta-dark2'); }
    if($v == 'latest_posts') {  get_template_part('parts/frontpage', 'latest-posts'); }
    if($v == 'open1')   {   get_template_part('parts/frontpage', 'open1'); }
}

?>

<?php } else { ?>

<!-- ========== Content Starts ========== -->
    <div class="section blog-feed bg-white">
        <div class="container">
            <div class="row">
            
                <div class="col-md-9 blog-feed-column">
                
                    <!-- Loop -->
                    <?php 
                    if ( have_posts() ) { 
                        while ( have_posts() ) : the_post();
                            get_template_part( 'parts/content', get_post_format() );
                        endwhile;
                    } 
                    else { ?>
                    <div class="no-results"><p><?php _e('No posts found.', 'vega'); ?></p></div>
                    <?php } ?>
                    <!-- /Loop -->
                    
                    <!-- Pagination -->
                    <div class="posts-pagination">
                        <div class="posts-pagination-block">
                            <?php if( get_next_posts_link() ) { next_posts_link('<span class="ic ic-angle-left"></span>'); }?>
                            <?php if( get_previous_posts_link() ) { previous_posts_link('<span class="ic ic-angle-right"></span>'); } ?>
                        </div>
                    </div>
                    <!-- /Pagination -->
                    
                </div> 
                
                <!-- Sidebar -->
                <div class="col-md-3 sidebar">
                    <?php get_sidebar(); ?>
                </div> 
                <!-- /Sidebar -->
                
            </div> 
        </div> 
    </div> 
    <!-- ========== /Content Ends ========== -->
    
<?php } ?>

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>