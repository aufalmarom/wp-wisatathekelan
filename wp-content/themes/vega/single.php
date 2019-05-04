<?php
/**
 * The Template for displaying single posts
 *
 * @package vega
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section post-content bg-white">
    <div class="container">
        <div class="row">
            
            <?php 
            $vega_wp_post_sidebar = vega_wp_get_option('vega_wp_post_sidebar'); 
            if($vega_wp_post_sidebar == 'Y') { $col1_class = 'col-md-9'; $col2_class='col-md-3'; }
            else { $col1_class = 'col-md-12'; $col2_class=''; }
            ?>
            
            <div class="<?php echo $col1_class ?>">
                
                <div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                    
                    <?php $vega_show_content_title = vega_wp_show_content_title(); if($vega_show_content_title) { ?>
                    <!-- Post Title -->
                    <?php $title = get_the_title(); ?>
                    <?php if($title == '') { ?>
                    <h3 class="entry-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h3>
                    <?php } else { ?>
                    <h3 class="entry-title"><?php the_title(); ?></h3>
                    <?php } ?>
                    <!-- /Post Title -->
                    <?php } ?>
                    
                    <?php
                    $vega_wp_post_meta = vega_wp_get_option('vega_wp_post_meta'); 
                    if($vega_wp_post_meta == 'Y') {
                        $vega_wp_post_meta_author = vega_wp_get_option('vega_wp_post_meta_author'); 
                        $vega_wp_post_meta_category = vega_wp_get_option('vega_wp_post_meta_category'); 
                        $vega_wp_post_meta_date = vega_wp_get_option('vega_wp_post_meta_date'); 
                    }
                    ?>
                    <?php if($vega_wp_post_meta == 'Y') { ?>
                    <!-- Post Meta -->
                    <div class="entry-meta">
                        <?php if($vega_wp_post_meta_date == 'Y') { 
							$date_format = get_option('date_format'); 
							$temp[] = __('Posted: ', 'vega') . '<span class="date updated">' .  get_the_date($date_format) . '</span>'; 
						} ?>
                        <?php if($vega_wp_post_meta_category == 'Y') { 
							$temp[] = __('Under: ', 'vega'). get_the_category_list(', '); 
						} ?>
                        <?php if($vega_wp_post_meta_author == 'Y') { 
							$temp[] = __('By: ', 'vega')  . '<span class="vcard author author_name"><span class="fn">' . get_the_author() . '</span></span>';  
						} ?>
                        <?php if($temp) $str = implode('<span class="sep">/</span>', $temp) ?>
                        <?php echo $str; ?>
                    </div>
                    <!-- /Post Meta -->
                    <?php } ?>
                    
                    <?php
                    $vega_wp_post_tags = vega_wp_get_option('vega_wp_post_tags'); 
                    if($vega_wp_post_tags == 'Y') {
                    ?>
                    <!-- Post Tags -->
                    <div class="entry-tags">
                        <p><?php the_tags('',''); ?></p>
                    </div>
                    <!-- /Post Tags -->
                    <?php } ?>
                    
                    <?php
                    $vega_wp_post_featured_image = vega_wp_get_option('vega_wp_post_featured_image'); 
                    if($vega_wp_post_featured_image == 'Y') {
                    ?>
                    
                    <?php if(has_post_thumbnail()) { ?>
                    <!-- Post Image -->
                    <div class="entry-image"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?></div>
                    <!-- /Post Image -->
                    <?php } ?>
                    
                    <?php } ?>
                    
                    <!-- Post Content -->
                    <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                    </div>
                    <!-- /Post Content -->
                    
                </div>
                
                <?php if ( comments_open() ) : ?>
                <?php comments_template(); ?>
                <?php endif; ?>
                
            </div>
            
            <?php if($vega_wp_post_sidebar == 'Y') { ?>
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