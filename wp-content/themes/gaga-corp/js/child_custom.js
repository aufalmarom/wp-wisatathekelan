jQuery(document).ready(function ($) {
       
     $('.news_letter_feature_image_class').hover(function(){
        var color_hover = (this.id);
        if(!color_hover == ''){
        $(this).css("color",color_hover)
        }        
    }); 
    //progress bar
$('.progressBar').each(function() { 
var bar = $(this);
var max = $(this).attr('id');
max = max.substring(3);
       bar.waypoint({
           handler: function(){
               var progressBarWidth = max * bar.width() / 100;
               bar.find('div').animate({ width: progressBarWidth }, 3000);
           },
           offset: '95%'
       });
});   
    //FAQ
        $('#faqList').simpleFAQ();
  
  $(window).load(function () {
    $('#plx_skill_section').parallax('50%', 0.4, true);
    });
    
    //map
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {lat: -33, lng: 151},
    disableDefaultUI: true
  });
}


});

