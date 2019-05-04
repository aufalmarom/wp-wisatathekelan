<?php
/**
 * The main template file.
 * 
 * @package vega
 */
?>
<?php get_header(); ?>
<?php get_template_part('parts/banner'); ?>

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

<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>