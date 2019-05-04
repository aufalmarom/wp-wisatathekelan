<?php 
$faq_section_title = get_theme_mod('gaga-corp-progress_faq_title');
$faq_section_desc = get_theme_mod('gaga-corp-progress_faq_description');
$progress_title1 = get_theme_mod('gaga-corp-progress_title1');
$progress_title2 = get_theme_mod('gaga-corp-progress_title2');
$progress_title3 = get_theme_mod('gaga-corp-progress_title3');
$progress_title4 = get_theme_mod('gaga-corp-progress_title4'); 
$progress_percent1 = get_theme_mod('gaga-corp-progress_percentage1');
$progress_percent2 = get_theme_mod('gaga-corp-progress_percentage2');
$progress_percent3 = get_theme_mod('gaga-corp-progress_percentage3');
$progress_percent4 = get_theme_mod('gaga-corp-progress_percentage4');?>

<div class="ak-container">
<div class="faq_section_title"><h2 class="wow fadeInDown"><?php echo wp_kses_post($faq_section_title); ?></h2></div>
<div class="faq-descr wow fadeInDown">
    <?php echo wp_kses_post($faq_section_desc); ?>
</div>
<div class="progress_bar wow fadeInUp">

    <?php if($progress_percent1) { ?>
    <div class="Progress_title"><?php echo $progress_title1; ?></div>
    <div class="progressBar bar1" id="max<?php echo $progress_percent1 ?>"><div></div></div>
    <?php } ?>
    
    <?php if($progress_percent2) { ?>
    <div class="Progress_title"><?php echo $progress_title2; ?></div>	
    <div class="progressBar bar2" id="max<?php echo $progress_percent2 ?>"><div></div></div>
    <?php } ?>
    
    <?php if($progress_percent3) { ?>
    <div class="Progress_title"><?php echo $progress_title3; ?></div>
    <div class="progressBar bar3" id="max<?php echo $progress_percent3 ?>"><div></div></div>
    <?php } ?>
    
    <?php if($progress_percent4) { ?>
    <div class="Progress_title"><?php echo $progress_title4; ?></div>
    <div class="progressBar bar4" id="max<?php echo $progress_percent4 ?>"><div></div></div>
    <?php } ?>
    
</div>
<div class="faq_div wow fadeInUp">

<?php ?>

<?php
/**
 * FAQ Section
 */

$category = get_theme_mod('gaga-corp-faq_cat');
$faq_args = array(
            'post_type' => 'post',
            'cat' => $category, 
            'order' => 'DESC'
        );
$faq_query = new WP_Query($faq_args);?>
<?php if ($faq_query->have_posts()) :?>
   <ul id='faqList'> <?php
        while ($faq_query->have_posts()) : $faq_query->the_post();
        $question = get_the_title();
        $answer = get_the_content();?>
        <li class="question_border_bottom">
          <span class="question"></span><span class="question_title"><?php echo wp_kses_post($question) ?></span>
            <div class='answer'>
                <?php echo wp_kses_post($answer); ?>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
<?php endif;  ?>
</div>
</div>
