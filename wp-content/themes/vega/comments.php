<?php
/**
 * The template for displaying the comments
 *
 * @package vega
 */
?>
<div class="comments-area">

<?php if ( have_comments() ) : ?>
	<h3 id="comments">
		<?php
			if ( 1 == get_comments_number() ) {
				/* translators: %s: post title */
				printf( __( 'One response to %s', 'vega' ),  '&#8220;' . get_the_title() . '&#8221;' );
			} else {
				/* translators: 1: number of comments, 2: post title */
				printf( _n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number(), 'vega' ),
					number_format_i18n( get_comments_number() ),  '&#8220;' . get_the_title() . '&#8221;' );
			}
		?>
	</h3>

	
	<ol class="commentlist">
	<?php wp_list_comments();?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
    <div style="clear:both"></div>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'vega'); ?></p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>


<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'vega'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>

<?php comment_form(); ?>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>