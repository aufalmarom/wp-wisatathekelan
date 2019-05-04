<?php
/**
 * The template part for displaying the top banner without an image
 *
 * @package vega
 */
?>
<?php $vega_show_banner_title = vega_wp_show_banner_title(); ?>
<!-- ========== Banner - None ========== -->
<div class="jumbotron banner-none">
    <div class="container">
        <?php if($vega_show_banner_title) { ?><h1 class="block-title wow zoomIn" ><?php echo esc_html(vega_wp_title()); ?></h1><?php } ?>
    </div>
</div>
<!-- ========== /Banner - None ========== -->