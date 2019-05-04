<?php
/**
 * The template for displaying pages
 *
 * @package vega
 */
?>
<?php get_header(); ?>

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
                
                <div id="page-woocommerce" <?php post_class('clearfix'); ?>>
                
                    <?php woocommerce_content(); ?>
                    
                </div>
                
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


<?php get_footer(); ?>