<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package vega
 */
?>
<?php get_header(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section error-content bg-white">
    <div class="container">
        <h2>404</h2>
        <h3><?php _e('Page Not Found', 'vega'); ?></h3>
        <div style="height:200px"></div>
    </div>
</div>
<!-- ========== /Page Content ========== -->

<?php get_footer(); ?>