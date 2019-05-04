<?php
if(is_active_sidebar('gaga_corp_feature_widget'))
{ ?>
<div class="clearfix"></div>
<div class="ak-container wow fadeInDown">
    <?php
        dynamic_sidebar('gaga_corp_feature_widget');  
    ?>
</div>
<?php }