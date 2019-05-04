<?php 
### DEFAULTS ###

global $vega_wp_defaults;

$vega_wp_defaults['vega_wp_upgrade_to_pro'] = '';
$vega_wp_defaults['vega_wp_info'] = '';

#vega_wp_general_settings_section
$vega_wp_defaults['vega_wp_enable_demo'] = 'N';
$vega_wp_defaults['vega_wp_animations'] = 'Y';
$vega_wp_defaults['vega_hide_footer_widgets'] = 'N';

#vega_wp_logo_section
$vega_wp_defaults['vega_wp_show_logo_image'] = 'N';
$vega_wp_defaults['vega_wp_logo_image'] = '';
$vega_wp_defaults['vega_wp_logo_text'] = get_bloginfo('name'); ;

#vega_wp_colors_section
$vega_wp_defaults['vega_wp_color_stylesheet'] = 'Orange';

#vega_wp_frontpage_section
$vega_wp_defaults['vega_wp_frontpage_banner'] = 'Image Banner';
$vega_wp_defaults['vega_wp_frontpage_content'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_cta_dark'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_cta_dark2'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_4cols'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_open1'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_latest_posts'] = 'Y';

#vega_wp_frontpage_positions_section
$vega_wp_defaults['vega_wp_frontpage_position_content'] = 10;
$vega_wp_defaults['vega_wp_frontpage_position_cta_dark'] = 20;
$vega_wp_defaults['vega_wp_frontpage_position_4cols'] = 30;
$vega_wp_defaults['vega_wp_frontpage_position_latest_posts'] = 40;
$vega_wp_defaults['vega_wp_frontpage_position_cta_dark2'] = 45;
$vega_wp_defaults['vega_wp_frontpage_position_open1'] = 50;

#vega_wp_frontpage_banner_section
$vega_wp_defaults['vega_wp_frontpage_banner_image'] = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';
$vega_wp_defaults['vega_wp_frontpage_banner_heading'] = get_bloginfo('name'); 
$vega_wp_defaults['vega_wp_frontpage_banner_text'] = get_bloginfo('description'); 
$vega_wp_defaults['vega_wp_frontpage_banner_bg_color'] = '#000000';

#vega_wp_frontpage_4_cols_section
$vega_wp_defaults['vega_wp_frontpage_4cols_n'] = 4;
$vega_wp_defaults['vega_wp_frontpage_4_cols_heading'] = __('Featured Pages', 'vega');
$vega_wp_defaults['vega_wp_frontpage_4_cols_read_more'] = __('READ MORE', 'vega');
$vega_wp_defaults['vega_wp_frontpage_4_cols_text'] = __('You can select each of these pages from the Appearance > Customize section. The page excerpt is displayed here on the front page and you can select which icons to display for each.', 'vega');
$vega_wp_defaults['vega_wp_frontpage_4_cols_1_icon'] = 'fa-desktop';
$vega_wp_defaults['vega_wp_frontpage_4_cols_1'] = 1;
$vega_wp_defaults['vega_wp_frontpage_4_cols_2_icon'] = 'fa-comments';
$vega_wp_defaults['vega_wp_frontpage_4_cols_2'] = 1;
$vega_wp_defaults['vega_wp_frontpage_4_cols_3_icon'] = 'fa-cogs';
$vega_wp_defaults['vega_wp_frontpage_4_cols_3'] = 1;
$vega_wp_defaults['vega_wp_frontpage_4_cols_4_icon'] = 'fa-camera';
$vega_wp_defaults['vega_wp_frontpage_4_cols_4'] = 1;
$vega_wp_defaults['vega_wp_frontpage_4_cols_section_id'] = '4cols';
$vega_wp_defaults['vega_wp_frontpage_4_cols_bg_color'] = '#F4F4F4';

#vega_wp_frontpage_open1_section
$vega_wp_defaults['vega_wp_frontpage_open1_heading'] = __('Content Heading', 'vega');
$vega_wp_defaults['vega_wp_frontpage_open1_content'] = 1;
$vega_wp_defaults['vega_wp_frontpage_open1_section_id'] = 'open';
$vega_wp_defaults['vega_wp_frontpage_open1_bg_color'] = '#fafafa';

#vega_wp_frontpage_cta_dark_section
$vega_wp_defaults['vega_wp_frontpage_cta_dark_content'] = 1;
$vega_wp_defaults['vega_wp_frontpage_cta_dark_parallax'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_color'] = '#000000';
#parallax background
$vega_wp_defaults['vega_wp_parallax_bg'] = esc_url( get_template_directory_uri() ) . '/sample/images/cta-parallax-bg.jpg';
$vega_wp_defaults['vega_wp_frontpage_cta_dark_bg_image'] = $vega_wp_defaults['vega_wp_parallax_bg'];
$vega_wp_defaults['vega_wp_frontpage_cta_dark_section_id'] = 'cta';

#vega_wp_frontpage_cta_dark2_section
$vega_wp_defaults['vega_wp_frontpage_cta_dark2_content'] = 1;
$vega_wp_defaults['vega_wp_frontpage_cta_dark2_parallax'] = 'Y';
$vega_wp_defaults['vega_wp_frontpage_cta_dark2_bg_color'] = '#000000';
#parallax background
$vega_wp_defaults['vega_wp_parallax_bg2'] = esc_url( get_template_directory_uri() ) . '/sample/images/cta-parallax-bg2.jpg';
$vega_wp_defaults['vega_wp_frontpage_cta_dark2_bg_image'] = $vega_wp_defaults['vega_wp_parallax_bg2'];
$vega_wp_defaults['vega_wp_frontpage_cta_dark2_section_id'] = 'cta2';


#vega_wp_frontpage_latest_posts_section
$vega_wp_defaults['vega_wp_frontpage_latest_posts_n'] = 3;
$vega_wp_defaults['vega_wp_frontpage_latest_posts_heading'] = __('Latest Posts', 'vega');
$vega_wp_defaults['vega_wp_frontpage_latest_posts_section_id'] = 'latest';
$vega_wp_defaults['vega_wp_frontpage_latest_posts_bg_color'] = '#ffffff';

#vega_wp_blog_feed_section
$vega_wp_defaults['vega_wp_blog_feed_meta'] = 'Y';
$vega_wp_defaults['vega_wp_blog_feed_meta_date'] = 'Y';
$vega_wp_defaults['vega_wp_blog_feed_meta_category'] = 'Y';
$vega_wp_defaults['vega_wp_blog_feed_meta_author'] = 'N';
$vega_wp_defaults['vega_wp_blog_feed_display'] = 'Small Image Left, Excerpt Right'; //'Large Image Top, Full Content Below'; //'Small Image Left, Excerpt Right';
$vega_wp_defaults['vega_wp_blog_feed_buttons'] = 'Y';
$vega_wp_defaults['vega_wp_blog_feed_banner'] = 'Custom Header';
$vega_wp_defaults['vega_wp_blog_feed_animations'] = 'Y';
$vega_wp_defaults['vega_wp_blog_feed_readmore_text'] = 'Read Me';
$vega_wp_defaults['vega_wp_blog_feed_comment_text'] = 'Comment';
$vega_wp_defaults['vega_wp_blog_feed_comments_text'] = 'Comments';
$vega_wp_defaults['vega_wp_blog_feed_nocomments_text'] = 'Leave comment';

#vega_wp_post_section
$vega_wp_defaults['vega_wp_post_meta'] = 'Y';
$vega_wp_defaults['vega_wp_post_meta_date'] = 'Y';
$vega_wp_defaults['vega_wp_post_meta_category'] = 'Y';
$vega_wp_defaults['vega_wp_post_meta_author'] = 'Y';
$vega_wp_defaults['vega_wp_post_tags'] = 'Y';
$vega_wp_defaults['vega_wp_post_banner'] = 'Custom Header';
$vega_wp_defaults['vega_wp_post_sidebar'] = 'Y';
$vega_wp_defaults['vega_wp_post_featured_image'] = 'Y';
$vega_wp_defaults['vega_wp_post_title'] = 'Both';

#vega_wp_page_section
$vega_wp_defaults['vega_wp_page_banner'] = 'Custom Header';
$vega_wp_defaults['vega_wp_page_sidebar'] = 'Y';
$vega_wp_defaults['vega_wp_page_title'] = 'Both';

#vega_advanced_section
$vega_wp_defaults['vega_wp_google_analytics'] = '';
$vega_wp_defaults['vega_wp_custom_css'] = '';

#vega_wp_footer_section
$vega_wp_defaults['vega_wp_footer_credit_message'] = __('Vega Wordpress Theme by <a target="_blank" href="https://www.lyrathemes.com">LyraThemes</a>', 'vega');
$vega_wp_defaults['vega_wp_footer_copyright_message'] = get_bloginfo('name') . ' ' .date("Y");



/*** default/example images ***/
#header
$vega_wp_defaults['vega_wp_custom_header'] = esc_url( get_template_directory_uri() ) . '/sample/images/header.jpg';
#featured images
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-1.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-2.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-3.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-4.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-5.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-6.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-7.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-8.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-9.jpg';
$vega_wp_defaults['vega_wp_featured_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/featured-image-10.jpg';
#vega-post-thumbnail-recent
$vega_wp_defaults['vega_wp_recent_post_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/recent-news-1.jpg';
$vega_wp_defaults['vega_wp_recent_post_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/recent-news-2.jpg';
$vega_wp_defaults['vega_wp_recent_post_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/recent-news-3.jpg';
#vega_wp_full_image
$vega_wp_defaults['vega_wp_full_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/full-1.jpg';
$vega_wp_defaults['vega_wp_full_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/full-2.jpg';
$vega_wp_defaults['vega_wp_full_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/full-3.jpg';
$vega_wp_defaults['vega_wp_full_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/full-4.jpg';
$vega_wp_defaults['vega_wp_full_image'][] = esc_url( get_template_directory_uri() ) . '/sample/images/full-5.jpg';

?>