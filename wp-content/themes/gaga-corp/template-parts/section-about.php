<?php
/**
 * About Parallax Section
 */
$about_section_title = get_theme_mod('gaga-lite-about_section_title');
$about_page_id = get_theme_mod('gaga-lite-about_page_select');
$about_page = get_page($about_page_id);
$button_link = get_theme_mod('gaga-lite-about_button_link');
$button_value = get_theme_mod('gaga-lite-about_button_text');
if ($about_page_id) {?>
<div class="ak-container clearfix">
     <div class="about_corp_image wow fadeInLeft">
        <?php $about_iamge = get_theme_mod('gaga-corp-about_image'); ?>
        <img src="<?php echo esc_url($about_iamge); ?>" />
     </div>
     
    <div class="combine">
        <?php if($about_section_title){ ?>
            <div class="wow fadeInRight"><h2 class="about_section_title"><?php echo wp_kses_post($about_section_title); ?></h2></div>
        <?php } ?>
    </div>
    
    <div class="combine_content wow fadeInRight">
        <div class="about-contents">
            <?php echo wp_kses_post($about_page->post_content); ?>
        </div>
        <?php if($button_value){ ?>
        <div class="buy">
            <a target="_blank" href="<?php echo esc_url($button_link) ?>"><?php echo esc_attr($button_value )?></a>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>