<?php
function gaga_corp_dynamic_styles(){ 

    $skin_color = get_theme_mod('gaga-lite-skin_color');
 ?>
<style>
<?php if($skin_color){ ?>
.gaga_twite, .pricing_widget .widget_gaga_lite_pricing:hover .gaga-pricing-head{
    background: <?php echo esc_attr($skin_color).'!important'; ?>
}
.simpleFAQ_list .question, .slider_content span, section#plx_news_letter_section, .news_letter_left, #plx_news_letter_section .wpcf7 form span input, .news_letter_feature_contact_class form p input[type="submit"]:hover{
    background-color: <?php echo esc_attr($skin_color).'!important'; ?>
}
.pricing_section .pricing_widget .sign_up_price:hover{
       background-color: <?php echo esc_attr($skin_color).'!important'; ?>
}
.inner #respond .form-submit input:hover, .inner .arcive_read_more a:hover{
    border-color:<?php echo esc_attr($skin_color).'!important'; ?>
}
h1.widget-title, .inner .arcive_title a, .faq_section_title h2 span{
    color:<?php echo esc_attr($skin_color).'!important'; ?>
}
.news_letter_feature_contact_class form p input[type="submit"]{
     color:<?php echo esc_attr($skin_color).'!important'; ?>
}
<?php 
    //$rgb = gaga_lite_hex2rgba($skin_color);
    $rgba1 = gaga_lite_hex2rgba($skin_color, 0.9);
?>
.portfolio-positing:hover .portfolio_main{
    background: <?php echo $rgba1 ?>;
}
.pricing_section .pricing_widget .sign_up_price:hover {
    background-color: transparent !important;
}
<?php } ?>
.woocommerce-page .woocommerce-info{
     border-top-color: #3ec5e4;
    
}
</style>

<?php }
 add_action('wp_head', 'gaga_corp_dynamic_styles', 100); ?>