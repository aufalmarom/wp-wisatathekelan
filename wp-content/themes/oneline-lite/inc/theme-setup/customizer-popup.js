function oneline_lite_install(newLocation) {
    jQuery('.loader,.flactvate-activating').css('display','block');
    jQuery('.button-large').css('display','none');
    jQuery.post(newLocation, { url: '' }, function(data) {
// home page settings
    jQuery('.loader,.flactvate-activating').css('display','none');
    jQuery('.button-large.flactvate').css('display','block');
        var data = {
            'action': 'oneline_lite_default_home',
            'home': 'saved'
        };

        jQuery.post(ajaxurl, data, function(response) {
            if(response){
            jQuery.post(response, { url: '' }, function(data) { 
            //jQuery('.button-large.flactvate').css('display','none');
            setTimeout(function() {
           location.reload(true);

            }, 1000);

            });

            }else{
                   setTimeout(function() {
                     location.reload(true);

            }, 1000);

            }

        });
    });
return false;
}

jQuery(document).ready(function () {

    tb_show('Themehunk Customizer', '#TB_inline?width=400&height=430&inlineId=popup_homepage');
    jQuery('#TB_closeWindowButton').hide();
    jQuery('#TB_window').css({
        'z-index': '5000001',
        'height': '480px',
        'width': '780px'
    })
    jQuery('#TB_overlay').css({
        'z-index': '5000000'
    });

    jQuery('#TB_window').addClass('container-popup');
    jQuery('#disable-popup-cb').click(function () {
        jQuery.post( ajaxurl, {
                value: this.checked ? 1 : 0,
                action: "customizer_disable_popup",
            },
            function(result){
            tb_remove();                       
        });
    });
});