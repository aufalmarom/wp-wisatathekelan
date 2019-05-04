<?php
/**
 * The template part for displaying the logo
 *
 * @package vega
 */
?>
<?php global $vega_wp_defaults; ?>
<?php
$vega_wp_show_logo_image = vega_wp_get_option('vega_wp_show_logo_image'); 
$vega_wp_logo_text = vega_wp_get_option('vega_wp_logo_text'); 

$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$vega_wp_logo_image = $custom_logo_image[0];
?>
<?php if($vega_wp_show_logo_image == 'Y' && $vega_wp_logo_image != '') { ?>
<a class="navbar-brand image-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($vega_wp_logo_image) ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>

<?php }  else { ?>
<a class="navbar-brand text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html($vega_wp_logo_text) ?></a><?php } ?>

