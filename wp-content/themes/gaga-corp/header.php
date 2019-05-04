<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package gaga lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">       
        <?php wp_head(); ?>
                
    </head>
    <body <?php body_class(); ?>>
        <div id="page" class="hfeed site">

            <?php
            /** gaga logo * */
            $header_menu = get_theme_mod('gaga-lite-header_menu_position');
           
            if ($header_menu == '1') {
                ?> 
                <header id="masthead" class="site-header onee corp_menu" role="banner">
                    <div class="top_inner_header">
                        <div class="ak-container">
                            <div class="header_logo">
                                <?php $image_logo = get_theme_mod('gaga-lite-header_logo'); 
                                if($image_logo){?> 
                                <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($image_logo); ?>" /></a>
                                <?php } ?>    
                            </div>
                            <div id="toggle" class="on">
                                <div class="one"></div>
                                <div class="two"></div>
                                <div class="three"></div>
                            </div>
                            <div class="social_link_header">
                                <?php if (is_active_sidebar('gaga_lite_footer_social_links')) : ?>
                                    <ul id="sidebar">
                                        <?php dynamic_sidebar('gaga_lite_footer_social_links'); ?>
                                    </ul>
                                <?php endif; ?> 
                            </div>
                            <div id="menu">
                                <nav id="site-navigation" class="main-navigation" role="navigation">
                                <?php $primery_menu_enable = get_theme_mod('gaga-lite-custom_menu_enable');
                                    if($primery_menu_enable != '1'){?>
                                    
                                        <ul class="nav plx-nav clearfix">
                                                                                                               
                                            <li><a class="current" href="<?php echo esc_url(home_url('/')); ?>#home_slider">Home</a></li>
                                            <?php
                                            $enabled_sections = gaga_lite_get_menu_sections('menu');

                                            foreach ($enabled_sections as $enabled_section) :
                                                $enabled_section['menu_text'];
                                                if ($enabled_section['menu_text'] != '') {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo esc_url(home_url()); ?>/#plx_<?php echo esc_attr($enabled_section['section']) ?>_section" >
                                                            <?php echo esc_attr($enabled_section['menu_text']); ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </ul>
                                    
                                    <?php } 
                                    else
                                    {
                                        
                                        ?>
                                         <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'gaga-lite'); ?></button>
                                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
                                    <?php }
                                    ?>
                                </nav><!-- #site-navigation -->
                            </div>
                        </div>
                    </div>
                </header>
                <?php
            }
            ?>
            <div id="page" class="hfeed site">
                <a class="skip-link screen-reader-text" href="#content"><?php echo esc_html__('Skip to content', 'gaga-corp'); ?></a>
            </div>
            <?php if (is_home() || is_front_page()) : ?>
                <section id="home_slider">
                    <div class="slider_area">
                        <?php
                        if (get_theme_mod('gaga-lite-slider_enable_disable') == 1) {
                            $slider_iamges = get_theme_mod('gaga-lite-slider_cat');

                            $slider_args = array('post_type' => 'post', 'cat' => $slider_iamges, 'order' => 'DESC');
                            $slider_query = new WP_Query($slider_args);
                            if ($slider_query->have_posts() && $slider_iamges) :
                                ?>

                                <div class="gaga_lite_slider">
                                    <ul class="bxslider clearfix">
                                        <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
                                            <?php
                                            $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'gaga_lite_slider_image');
                                            $img_src = $img[0];
                                            if($img_src){?>
                                            <li>
                                                <img src="<?php echo esc_url($img_src); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                                <div class="slider_capation">
                                                    <div class="ak-container wow fadeInUp">
                                                        <div class="slider_title"><?php the_title(); ?></div>
                                                        <div class="slider_content highlite"> <?php the_content(); ?> </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } endwhile; ?>
                                    </ul> 
                                    <?php
                                        if (get_theme_mod('gaga-lite-about_enable_disable') == '1') {
                                            $link = '#plx_about_section';
                                        } elseif (get_theme_mod('gaga-lite-team_enable_disable') == '1') {
                                            $link = '#plx_team_section';
                                        } elseif (get_theme_mod('gaga-lite-blog_enable_disable') == '1') {
                                            $link = '#plx_blog_section';
                                        } elseif (get_theme_mod('gaga-lite-service_enable_disable') == '1') {
                                            $link = '#plx_service_section';
                                        } elseif (get_theme_mod('gaga-lite-portfolio_enable_disable') == '1') {
                                            $link = '#plx_portfolio_section';
                                        } elseif (get_theme_mod('gaga-lite-client_enable_disable') == '1') {
                                            $link = '#plx_client_section';
                                        } elseif (get_theme_mod('gaga-lite-pricing_enable_disable') == '1') {
                                            $link = '#plx_pricing_section';
                                        } elseif (get_theme_mod('gaga-lite-testimonial_enable_disable') == '1') {
                                            $link = '#plx_testimonial_section';
                                        } else {
                                            $link = '';
                                        }

                                        if ($link == '') {
                                            
                                        } else {
                                            ?> 
                                            <span  class="next-page" ><a href="<?php echo esc_url(home_url()) . '/' . $link; ?>"><i class="fa fa-angle-double-down"></i></a></span>
                                            <?php
                                        }
                                    
                                    ?> 

                                </div>

                                <?php
                            endif;
                        }
                    
                    ?>
                </div>
                <?php endif; ?>
            </section>
            <?php if ($header_menu != '1') {
                
                if (is_home() || is_front_page()) {
                    $header_class = '';
                    // return the $classes array
                } else {
                    $header_class = 'main-nav-scrolled';
                }?>
                <header id="masthead" class="site-header" role="banner">
                    <div class="innerr_header <?php echo esc_attr($header_class); ?>">
                        <div class="ak-container">                        
                            <div class="header_logo">
                                <?php $image_logo = get_theme_mod('gaga-lite-header_logo'); 
                                if($image_logo){?> 
                                <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($image_logo); ?>" /></a>
                                <?php } ?>  
                            </div>
                            <div id="toggle" class="on">
                                <div class="one"></div>
                                <div class="two"></div>
                                <div class="three"></div>
                            </div>
                            <div id="menu">
                                <nav id="site-navigation" class="main-navigation" role="navigation">
                                    <?php $primery_menu_enable = get_theme_mod('gaga-lite-custom_menu_enable');
                                    if($primery_menu_enable != '1'){
                                        
                                 ?>
                                   
                                        <ul class="nav plx-nav clearfix">
                                            <?php
                                            $home = get_theme_mod('gaga-lite-home_menu_text');
                                            if ($home == '') {
                                                $home = esc_html__('Home','gaga-lite');
                                            }
                                            ?>                                                                     
                                            <li><a class="current" href="<?php echo esc_url(home_url('/')); ?>#home_slider"><?php echo esc_attr($home); ?></a></li>
                                            <?php
                                            $enabled_sections = gaga_lite_get_menu_sections('menu');

                                            foreach ($enabled_sections as $enabled_section) :
                                                $enabled_section['menu_text'];
                                                if ($enabled_section['menu_text'] != '') {
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo esc_url(home_url()); ?>/#plx_<?php echo esc_attr($enabled_section['section']) ?>_section" >
                                                            <?php echo esc_attr($enabled_section['menu_text']); ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </ul>
                                    
                                    <?php } 
                                    else
                                    {
                                        
                                        ?>
                                         <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'gaga-lite'); ?></button>
                                        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
                                <?php }
                                    ?>
                                </nav><!-- #site-navigation -->
                            </div>
                        </div>
                    </div>
                </header><!-- #masthead -->
            <?php } ?>
            <div id="content" class="site-content">