<?php
/**
* The template part for displaying the banner for the front page (static)
*
* @package vega
*/
?>

<!-- ========== Front Page - Image Banner ========== -->
<?php global $vega_wp_defaults; ?>
<?php 

$vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo');

$vega_wp_frontpage_banner = vega_wp_get_option('vega_wp_frontpage_banner'); 
$vega_wp_frontpage_banner_image = vega_wp_get_option('vega_wp_frontpage_banner_image');

$vega_wp_frontpage_banner_heading = vega_wp_get_option('vega_wp_frontpage_banner_heading');
$vega_wp_frontpage_banner_text = vega_wp_get_option('vega_wp_frontpage_banner_text');
if($vega_wp_frontpage_banner_heading == '') $vega_wp_frontpage_banner_heading = get_bloginfo ( 'name' );
if($vega_wp_frontpage_banner_text == '') $vega_wp_frontpage_banner_text = get_bloginfo ( 'description' );

$header_image = get_header_image(); 

if($vega_wp_frontpage_banner_image != '' || $header_image != '') {
    
    #header image uploaded, no frontpage banner uploaded
    if($vega_wp_frontpage_banner_image == $vega_wp_defaults['vega_wp_frontpage_banner_image'] && $header_image != '') 
        $frontpage_banner = $header_image;
    else #header image uploaded, frontpage banner uploaded then removed
    if($vega_wp_frontpage_banner_image == '' && $header_image != '') 
        $frontpage_banner = $header_image;
    #no header image uploaded, no frontpage banner uploaded
    else if($header_image == '' && $vega_wp_frontpage_banner_image == $vega_wp_defaults['vega_wp_frontpage_banner_image'])
        $frontpage_banner = $vega_wp_frontpage_banner_image;
    #frontpage banner uploaded
    else if ($vega_wp_frontpage_banner_image != '')
        $frontpage_banner = $vega_wp_frontpage_banner_image;
?>

<?php if($vega_wp_frontpage_banner != 'Simple Banner') { ?>

<div class="image-banner frontpage-banner frontpage-banner-parallax-bg <?php if($vega_wp_frontpage_banner == 'Full Screen Image') { ?>full-screen<?php } ?>" data-parallax="scroll" data-image-src="<?php echo esc_url($frontpage_banner) ?>">
    <div class="container">
        <?php if( display_header_text() ) { ?>
        <div class="inner">
            <h1 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_banner_heading) ?></h1>
            <div class="text-center hidden-xs wow zoomIn description"><?php echo wp_kses_post($vega_wp_frontpage_banner_text) ?></div>
        </div><div class="helper"></div>
        <?php } else { ?>
        
        <?php } ?>
    </div>
</div>

<?php } else { ?>

<div class="image-banner frontpage-banner frontpage-simple-banner">
    <img src="<?php echo esc_url($frontpage_banner) ?>" class="img-responsive" />
    <div class="caption">
        <div class="container">
            <?php if( display_header_text() ) { ?>
            <div class="inner">
                <h1 class="block-title wow zoomIn"><?php echo esc_html($vega_wp_frontpage_banner_heading) ?></h1>
                <div class="text-center hidden-xs wow zoomIn description"><?php echo wp_kses_post($vega_wp_frontpage_banner_text) ?></div>
            </div><div class="helper"></div>
            <?php } else { ?>
            
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>

<?php } ?>
<!-- ========== /Front Page - Image Banner ========== -->

