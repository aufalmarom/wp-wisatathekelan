<?php
/**
 * Template Name: Full Width Page
 *
 * The template for displaying a full width page
 *
 * @package vega
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section page-content bg-white">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                
                <div id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                
                    <?php $vega_show_content_title = vega_wp_show_content_title(); if($vega_show_content_title) { ?>
                    <!-- Post Title -->
                    <?php $title = get_the_title(); ?>
                    <?php if($title == '') { ?>
                    <h3 class="page-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h3>
                    <?php } else { ?>
                    <h3 class="page-title"><?php the_title() ?></h3>
                    <?php } ?>
                    <!-- /Post Title -->
                    <?php } ?>
                    
                    <div class="page-content">
                    <?php the_content(); ?>
                    </div>
                    
                </div>
                <?php if ( comments_open() ) : ?>
                <?php comments_template(); ?>
                <?php endif; ?>
                
            </div>
            
        </div>
    </div>
</div>
<!-- ========== /Page Content ========== -->

<?php endwhile; ?>

<?php get_footer(); ?>