<?php
/**
 * The template part for displaying the 4 featured columns on the front page (static)
 *
 * @package vega
 */
?>

<?php 

$vega_wp_frontpage_4cols = vega_wp_get_option('vega_wp_frontpage_4cols'); 
if($vega_wp_frontpage_4cols == 'Y') { 

?>

<?php
for($i=1;$i<=4;$i++) { 
    $pages[] = vega_wp_get_option('vega_wp_frontpage_4_cols_' . $i);
} 
for($i=1;$i<=4;$i++) { 
    $icons[] = vega_wp_get_option('vega_wp_frontpage_4_cols_'.$i.'_icon'); 
}

$vega_wp_frontpage_4_cols_heading = vega_wp_get_option('vega_wp_frontpage_4_cols_heading'); 
$vega_wp_frontpage_4_cols_text = vega_wp_get_option('vega_wp_frontpage_4_cols_text'); 
$vega_wp_frontpage_4_cols_read_more = vega_wp_get_option('vega_wp_frontpage_4_cols_read_more');

$vega_wp_frontpage_4cols_n = vega_wp_get_option('vega_wp_frontpage_4cols_n'); 
if($vega_wp_frontpage_4cols_n == '') $vega_wp_frontpage_4cols_n = 4;
if($vega_wp_frontpage_4cols_n <= 0 || $vega_wp_frontpage_4cols_n > 4) $vega_wp_frontpage_4cols_n = 4;

$vega_wp_frontpage_4_cols_section_id = vega_wp_get_option('vega_wp_frontpage_4_cols_section_id'); 

$class = vega_wp_get_col_class($vega_wp_frontpage_4cols_n);
$classes = explode('|', $class);
?>
<!-- ========== Four Columns ========== -->
<div class="section frontpage-4cols" id="<?php echo esc_attr($vega_wp_frontpage_4_cols_section_id) ?>" <?php vega_wp_section_bg_color('vega_wp_frontpage_4_cols_bg_color'); ?>>
    <div class="container">
        <?php if($vega_wp_frontpage_4_cols_heading) { ?><h2 class="wow zoomIn block-title"><?php echo esc_html($vega_wp_frontpage_4_cols_heading); ?></h2><?php } ?>
        <?php if($vega_wp_frontpage_4_cols_text) { ?><div class="wow zoomIn text-center description"><?php echo wp_kses_post($vega_wp_frontpage_4_cols_text) ?></div><?php } ?>
        <div class="row cols">
            <?php for($i=0;$i<$vega_wp_frontpage_4cols_n;$i++) { ?>
            <?php $col_page = get_post($pages[$i]); 
            $temp = $post; $post = get_post( $col_page->ID ); setup_postdata( $post ); ?>
            <div class="<?php echo esc_attr($classes[$i]) ?>">
                <div class="content-icon wow fadeInUp">
                    <a class="icon" href="<?php the_permalink(); ?>">
                        <i class="fa <?php echo esc_attr($icons[$i]) ?>"></i>
                    </a>
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <div class="body">
                        <p><?php the_excerpt(); ?></p>
                    </div>
                    <?php if($vega_wp_frontpage_4_cols_read_more != '') { ?>
                    <div class="foot">
                        <a href="<?php the_permalink(); ?>" class="btn btn-inverse"><?php echo esc_html($vega_wp_frontpage_4_cols_read_more); ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php } wp_reset_postdata(); $post = $temp; ?>
        </div>
    </div>
</div> 
<!-- ========== /Four Columns ========== -->
<?php } ?>
