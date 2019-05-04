<?php
/**
 * The template part for displaying the post entry in the blog feed
 *
 * @package vega
 */
?>
<?php
$vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo');
$vega_wp_blog_feed_animations = vega_wp_get_option('vega_wp_blog_feed_animations');
$vega_wp_animations = vega_wp_get_option('vega_wp_animations');

#show meta?
$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta'); 
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author'); 
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category'); 
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date'); 
}
#display type
$vega_wp_blog_feed_display = vega_wp_get_option('vega_wp_blog_feed_display'); 
#show buttons?
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons'); 
?>

<?php 
if($vega_wp_blog_feed_animations == 'Y' && $vega_wp_animations == 'Y')  $post_class = 'wow zoomIn';
else $post_class = '';
?>

<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('entry clearfix ' . $post_class); ?>>
    
    
    <?php #if no title is defined for the post...
    if(get_the_title() == '') { ?>
    
    <?php $id = get_the_ID(); ?>
    <?php if($vega_wp_blog_feed_display != 'Small Image Left, Excerpt Right') { ?>
    <!-- Post Title -->
    <h3 class="entry-title block-title block-title-left"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Post ID: ', 'vega'); echo $id; ?></a></h3>
    <?php } else { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('Post ID: ', 'vega'); echo $id; ?></a></h3>
    <?php } ?>
    <!-- /Post Title -->
    
    <?php } else { ?>
    
    <?php if($vega_wp_blog_feed_display != 'Small Image Left, Excerpt Right') { ?>
    <!-- Post Title -->
    <h3 class="entry-title block-title block-title-left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php } else { ?>
    <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <!-- /Post Title -->
    <?php } ?>
    
    <?php } ?>
    
    <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?>
    
    <!-- Small Image Left, Excerpt Right -->
    <div class="entry-image entry-image-left">
        <?php if(has_post_thumbnail()) { ?>
        <a class="post-thumbnail post-thumbnail-small" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
        <?php } else { ?>
        <a class="post-thumbnail post-thumbnail-small" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail(); ?>" class="img-responsive" /></a><?php } ?>        
    </div>

    <div class="entry-content-right">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- /Small Image Left, Excerpt Right -->
    
    <?php } else if($vega_wp_blog_feed_display == 'Large Image Top, Full Content Below') { ?>
    
    <!-- Large Image Top, Full Content Below -->
    <?php if(has_post_thumbnail()) { ?>
    <div class="entry-image entry-image-top">
        <a class="post-thumbnail post-thumbnail-large" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?></a>
    </div>
    <?php } else if($vega_wp_enable_demo == 'Y') { ?>
        <a class="post-thumbnail post-thumbnail-large" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail('full'); ?>" class="img-responsive" /></a><?php } ?>  
    <div class="entry-content">        
        <?php the_content(__('View full post...', 'vega')); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- /Large Image Top, Full Content Below -->
    
    <?php } else if($vega_wp_blog_feed_display == 'No Image, Excerpt') { ?>
    
    <!-- No Image, Excerpt -->
    <div class="entry-content">        
        <?php the_excerpt('...'); ?>
        <?php wp_link_pages(); ?>
    </div>
    <!-- No Image, Excerpt -->
    
    <?php } ?>
    
    <?php if($vega_wp_blog_feed_meta == 'Y') { $temp = array(); ?>
    <!-- Post Meta -->
    <div class="entry-meta <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?> entry-meta-right <?php } ?>">
        <?php if($vega_wp_blog_feed_meta_date == 'Y') { $date_format = get_option('date_format');$temp[] = __('Posted: ', 'vega') . get_the_date($date_format); } ?>
        <?php if($vega_wp_blog_feed_meta_category == 'Y') { $temp[] = __('Under: ', 'vega'). get_the_category_list(', '); } ?>
        <?php if($vega_wp_blog_feed_meta_author == 'Y') { $temp[] = __('By: ', 'vega')  . get_the_author();  } ?>
        <?php if($temp) $str = implode('<br />', $temp) ?>
        <?php echo $str; ?>
    </div>
    <!-- /Post Meta -->
    <?php } ?>
    
    <?php if($vega_wp_blog_feed_buttons == 'Y') { ?>
    <!-- Post Buttons -->
    <div class="entry-buttons <?php if($vega_wp_blog_feed_display == 'Small Image Left, Excerpt Right') { ?> entry-buttons-right <?php } ?>">
        <?php $readmore = esc_html(vega_wp_get_option('vega_wp_blog_feed_readmore_text')); ?>
        <?php if($readmore != '') { ?><a href="<?php the_permalink(); ?>" class="btn btn-primary-custom btn-readmore"><?php echo $readmore; ?></a><?php } ?>
        <?php if ( ! post_password_required() && comments_open() || '0' != get_comments_number() )  { ?> 
        <?php 
        $nocomments = esc_html(vega_wp_get_option('vega_wp_blog_feed_nocomments_text'));
        $comment = esc_html(vega_wp_get_option('vega_wp_blog_feed_comment_text'));
        $comments = esc_html(vega_wp_get_option('vega_wp_blog_feed_comments_text'));
        ?>
        <?php if($nocomments != '' && $comment != '' && $comments != '') 
                comments_popup_link( $nocomments, '1 ' . $comment, '% ' . $comments, 'btn btn-inverse btn-comments' ); ?>
        <?php } ?>
    </div>
    <!-- /Post Buttons -->
    <?php } ?>

</div>

<!-- /Post -->