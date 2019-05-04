<?php
/**
 * The template for displaying pages
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
            
            <?php 
            $vega_wp_page_sidebar = vega_wp_get_option('vega_wp_page_sidebar'); 
            if($vega_wp_page_sidebar == 'Y') { $col1_class = 'col-md-9'; $col2_class='col-md-3'; }
            else { $col1_class = 'col-md-12'; $col2_class=''; }
            ?>
            
            <div class="<?php echo $col1_class ?>">
                
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
            
            <?php if($vega_wp_page_sidebar == 'Y') { ?>
            <!-- Sidebar -->
            <div class="<?php echo $col2_class ?> sidebar">
                <?php get_sidebar(); ?>
            </div> 
            <!-- /Sidebar -->
            <?php } ?>
            
        </div>
    </div>
</div>
<!-- ========== /Page Content ========== -->

<?php endwhile; ?>

<?php get_footer(); ?>