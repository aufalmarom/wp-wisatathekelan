<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package gaga lite
 */
?>

</div><!-- #content -->
<div class="gaga_twite">
    <div class="ak-container">
        <?php if(is_active_sidebar('gaga_corp_footer_tweet_slider')):
        ?>  <span><i class="fa fa-twitter"></i></span> <?php
            dynamic_sidebar('gaga_corp_footer_tweet_slider');
            endif; ?>
    </div>
 </div>
<div class="footer-bg">
<div class="ak-container">
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer_widget_view clearfix">
        
            <div class="footer_1 clearfix wow fadeInLeft"><?php
                if (is_active_sidebar('gaga_lite_footer1')):
                    dynamic_sidebar('gaga_lite_footer1');
                endif;?>
            </div>
            
            <div class="footer_2 clearfix wow fadeInRight"><?php
                if (is_active_sidebar('gaga_lite_footer2')):
                    dynamic_sidebar('gaga_lite_footer2');
                endif;?>
            </div>
            
            <div class="footer_3 clearfix wow fadeInRight"><?php
                if (is_active_sidebar('gaga_lite_footer3')):
                    dynamic_sidebar('gaga_lite_footer3');
                endif;?>
            </div>
            <div class="footer_4 clearfix wow fadeInRight"><?php
                if (is_active_sidebar('gaga_corp_footer4')):
                    dynamic_sidebar('gaga_corp_footer4');
                endif;?>
            </div>
        </div>
    </footer>
</div></div>
<div class="clearfix"></div>
<footer class="main_footer">
    <div class="ak-container">
        <div class="social_link_footer">
            <?php if (is_active_sidebar('gaga_lite_footer_social_links')) : ?>
                <ul id="sidebar">
                    <?php dynamic_sidebar('gaga_lite_footer_social_links'); ?>
                </ul>
            <?php endif; ?> 
        </div>
        <div class="site-info">
            <span><?php _e('Copyright','gaga-corp'); ?> &copy; <?php esc_html(bloginfo('name'),'gaga-corp'); ?></span>
            <span class="sep"> | </span>
			<span><?php printf( esc_html__( 'WordPress Theme: %1$s', 'gaga-lite' ), '<a target="_blank" href="http://www.accesspressthemes.com/" rel="designer">Gaga Lite</a>' ); ?></span>
  		</div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>