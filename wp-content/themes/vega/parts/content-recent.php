<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*
* @package vega
*/
?>
<?php
$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta'); 
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author'); 
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category'); 
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date'); 
}
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons'); 
global $key;
?>
<div class="post-grid recent-entry" id="recent-post-<?php the_ID(); ?>">
    <div class="recent-entry-image image">
        <?php if(has_post_thumbnail()) { ?>
        <a class="post-thumbnail post-thumbnail-recent" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'vega-post-thumbnail-recent', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></a>
        <?php } else { ?>
        <a class="post-thumbnail post-thumbnail-recent" href="<?php the_permalink(); ?>"><img src="<?php vega_wp_random_thumbnail('vega-post-thumbnail-recent'); ?>" class="img-responsive" /></a><?php } ?>       
        <div class="caption">
            <div class="caption-inner">
                <a href="<?php the_permalink(); ?>" class="icon-link white"><i class="fa fa-link"></i></a>
            </div>
            <div class="helper"></div>
        </div>
    </div>
    <!-- Post Title -->
    <?php #if no title is defined for the post...
    if(get_the_title() == '') { $id = get_the_ID(); ?>
    <h4 class="recent-entry-title"><a href="<?php the_permalink(); ?>"><?php _e('ID: ', 'vega'); echo $id; ?></a></h4>
    <?php } else { ?>
    <h4 class="recent-entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <?php } ?>
    <!-- /Post Title -->
    
    <div class="recent-entry-content">
        <?php the_excerpt(); ?>
    </div>
    
    <?php if($vega_wp_blog_feed_meta == 'Y') { $temp = array(); $str = ''; ?>
    <!-- Post Meta -->
    <div class="recent-entry-meta">
        <?php if($vega_wp_blog_feed_meta_date == 'Y') { $date_format = get_option('date_format'); $temp[] = __('Posted: ', 'vega') . get_the_date($date_format); } ?>
        <?php if($vega_wp_blog_feed_meta_category == 'Y') { $temp[] = __('Under: ', 'vega'). get_the_category_list(', '); } ?>
        <?php if($vega_wp_blog_feed_meta_author == 'Y') { $temp[] = __('By: ', 'vega')  . get_the_author();  } ?>
        <?php if($temp) $str = implode('<br />', $temp) ?>
        <?php echo $str; $temp = array(); ?>
    </div>
    <!-- /Post Meta -->
    <?php } ?>

    <?php if($vega_wp_blog_feed_buttons == 'Y') { ?>
    <!-- Post Buttons -->
    <div class="recent-entry-buttons">
        <?php $readmore = esc_html(vega_wp_get_option('vega_wp_blog_feed_readmore_text')) ?>
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
