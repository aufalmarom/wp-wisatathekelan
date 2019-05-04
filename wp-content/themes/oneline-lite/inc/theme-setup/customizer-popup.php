<div id="popup_homepage" style="display:none; ">
    <div class="container-popup">
        <div>
            <div class="popup_cp_column">
                <h3 class="popup_title"><?php esc_html_e('Please Install the ThemeHunk customizer WordPress Plugin.Plugin will enable below features in the theme. ', 'oneline-lite') ?></h3>
                <h4><?php esc_html_e('Salient Features -', 'oneline-lite'); ?></h4>
                <ul class="popup-features-list">
                    <li><?php esc_html_e('Beautiful SVG design homepage', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Advanced Live Customizer', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Unlimited Front Page Section (Services,Testimonial,Our Team)', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Custom templates  (Page builder template )
', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Typography,WooCommerce, Contact Us', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Powerful Animation and parallax effect', 'oneline-lite'); ?></li>
                    <li><?php esc_html_e('Theme color options', 'oneline-lite'); ?></li>
                </ul>
            </div>
        </div>
        <div class="footer">
            <label class="disable-popup-cb">
                <input type="checkbox" id="disable-popup-cb"/>
                <?php esc_html_e("Don't show this popup in refresh page", 'oneline-lite'); ?>
            </label>
             <a class="button-link-cb" onclick="tb_remove();"> <?php esc_html_e('Disable PoPuP', 'oneline-lite') ?> </a><a class="activate-now button-primary button-large flactvate"><?php _e('Activating homepage...','oneline-lite'); ?></a><div class='loader'></div><strong class="flactvate-activating"> <?php _e('It may take few seconds...','oneline-lite'); ?></strong>
            <?php 
                $obj = New Oneline_Lite_Popup();
            echo $obj->active_plugin(); ?>
        </div>
    </div>
</div>