<?php
/**
 * The template for displaying the sidebar
 *
 * @package vega
 */
?>

<?php if(is_single()) { 
    if ( is_active_sidebar( 'post-sidebar' ) ) { ?><div class="sidebar-widgets post-sidebar-widgets" ><?php dynamic_sidebar( 'post-sidebar' ); ?></div><?php } 
} ?>

<?php if(is_page()) { 
    if ( is_active_sidebar( 'page-sidebar' ) ) { ?><div class="sidebar-widgets page-sidebar-widgets" ><?php dynamic_sidebar( 'page-sidebar' ); ?></div><?php } 
} ?>

<?php if ( is_active_sidebar( 'sidebar' ) ) { ?><div class="sidebar-widgets" ><?php dynamic_sidebar( 'sidebar' ); ?></div>
<?php }  else  { vega_wp_example_sidebar(); } ?> 
