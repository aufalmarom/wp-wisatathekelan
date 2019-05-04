<?php
/**
 * The template part for displaying the featured image as the top banner
 *
 * @package vega
 */
?>
<?php 
$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'banner-featured-image' );
if($src) { $url = $src[0]; ?>
<?php $vega_show_banner_title = vega_wp_show_banner_title(); ?>
<!-- ========== Banner - Featured Image ========== -->
<div class="jumbotron image-banner banner-featured-image" style="background:url('<?php echo esc_url($url) ?>') no-repeat 0 0 #ffffff;background-size:cover;background-position:center center">
    <div class="container">
        <?php if($vega_show_banner_title) { ?><h1 class="block-title wow zoomIn" ><?php echo esc_html(vega_wp_title()); ?><h1><?php } ?>
    </div>
</div>
<!-- ========== /Banner - Featured Image ========== -->
<?php } else { get_template_part('parts/banner','none'); } ?>