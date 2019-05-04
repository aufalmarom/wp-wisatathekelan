<?php
/**
 * The template for displaying search results pages.
 *
 * @package gaga lite
 */

get_header(); 
$bg_image = get_theme_mod('gaga-lite-title_bg'); 
if($bg_image){?>
<div class="inner_header" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
    <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'gaga-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </header><!-- .page-header -->
</div>
<?php } ?>
<div class="ak-container">
    <div class="inner clearfix">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
                 ?>
                 <div class="inner_content_background clearfix">
                 <div>
                    <?php
                        $img = wp_get_attachment_image_src(get_post_thumbnail_id(), '');
                        $img_src = $img[0];
                        if($img_src){
                     ?>
                     <img src="<?php echo esc_url($img_src); ?>" />
                     <?php } ?>
                 </div>
                 
                 <?php
				get_template_part( 'template-parts/content', 'search' );
				?>
                </div>
			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>
            
			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
    <?php
        $widget_area = 'widget-area-right';
        ?> <div id="secondary" class="widget-area <?php echo esc_attr($widget_area); ?>" role="complementary"> <?php
        get_sidebar('right');
        ?> </div> <?php
    ?>
    </div>
    </div>


<?php get_footer(); ?>