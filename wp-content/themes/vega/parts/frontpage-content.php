<?php
/**
 * The template part for displaying the front page content 
 *
 * @package vega
 */
?>

<?php 
$vega_wp_frontpage_content = vega_wp_get_option('vega_wp_frontpage_content'); 
$vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo');
?>

<?php #EXAMPLE CONTENT: If a static front page has been defined, the content from that page will be shown. Otherwise IF demo is on, the content from a random page will be displayed. ?>
<?php if($vega_wp_frontpage_content == 'Y' && get_option('show_on_front') == 'page') {  ?>
<!-- ========== Page Content ========== -->
<div class="section frontpage-content bg-white" id="welcome">
    <div class="container">
        <?php while ( have_posts() ) : the_post(); ?>
        <h2 class="block-title wow zoomIn"><?php the_title(); ?></h2>
        <div class="wow fadeInUp description"><?php the_content(); ?></div>
        <?php endwhile; ?>
    </div>
</div> 
<!-- ========== /Page Content ========== -->
<?php } else if( $vega_wp_enable_demo == 'Y') { ?>
<!-- ========== Random Page Content ========== -->
<div class="section frontpage-content bg-white" id="welcome">
    <div class="container">
        <?php vega_wp_example_frontpage_content(); ?>
    </div>
</div> 
<!-- ========== /Random Page Content ========== -->
<?php } ?>