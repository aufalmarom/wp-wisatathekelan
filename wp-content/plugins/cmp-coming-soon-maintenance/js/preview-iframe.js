
$( document ).ready(function() {
	var timeout;
	var slug;
	var premium = $('#theme-preview').data('premium');

	$('iframe').one('load', function() {
	    $('body').addClass('loaded');
	});

	$('iframe').on('load', function() {
	    // resizeIframe(this);
	    $(this).addClass('loaded');
	});

	$('.panel.open').click(function(e){
		e.preventDefault();
		ga('send', 'event', 'Open Selector', 'Open Selector');
		$('body').toggleClass('open');
	});

	$('.background-wrap').click(function(e){
		ga('send', 'event', 'Close Selector', 'Close Selector');
		$('body').removeClass('open');
	});

	$('.theme-selector .thumbnail').click(function(e){
		e.preventDefault();
		new_url = $(this).attr('href');
		iframe_url = new_url.replace('&selector=true', '');
		orig_slug = $('#theme-preview').data('slug');
		slug 	= $(this).data('slug');
		name 	= $(this).data('name');
		$('body').removeClass('open');

		ga('send', 'event', 'Change Theme', 'Change Theme to: ' + name);
		
		$('#theme-preview').removeClass('loaded');
		// reload iframe
		$('#theme-preview').attr('src', iframe_url);
		ChangeUrl(new_url, new_url);
		// process premium / free themes
		$('.purchase').removeClass('premium').addClass('free');

		var price = $(this).data('price');

		for (var i = 0, len = premium.length; i < len; i++) {

		    if ( premium[i].name == slug ) {
		    	$('.purchase').removeClass('free').addClass('premium');
		    	$('.purchase a').attr('href', premium[i].url);
		    	break;
		    } 
		}
		// change href src to new theme
		$('#theme-preview').data('slug', slug);
		
		$('.background-selector a').each(function(){
			href = $(this).attr('href');
			href = href.replace('theme='+orig_slug, 'theme='+slug);
			$(this).attr('href', href).removeClass('selected');
		});

		$('.background-selector a').first().addClass('selected');

		// change browser url
		$(document).prop('title', name + ' Preview');
	});


	$('.background-selector a').click(function(e){
		e.preventDefault();
		new_url = $(this).attr('href');
		iframe_url = new_url.replace('&selector=true', '');
		orig_background = $('#theme-preview').data('background');
		new_background = $(this).data('background');
		$('#theme-preview').removeClass('loaded');
		$('body').removeClass('open');
		$('.background-selector a').removeClass('selected');
		$(this).addClass('selected');

		ga('send', 'event', 'Change background', 'Change background to: ' + new_background);

		// reload iframe
		$('#theme-preview').attr('src', iframe_url);
		ChangeUrl(new_url, new_url);

		// change href src to new background
		$('#theme-preview').data('background', new_background);
		$('.theme-selector a').each(function(){
			href = $(this).attr('href');
			if ( orig_background != '' ) {
				href = href.replace('background='+orig_background, 'background='+new_background);
			} else {
				href = href + '&background=' + new_background;
			}
			
			$(this).attr('href', href).removeClass('selected');
		});

	});


	$('.theme-selector .thumbnail').on( "mouseenter", function() {
		clearTimeout(timeout);
	    $('.theme-name').text(': ' + $(this).data('name'));
	  })
	  .on( "mouseleave", function() {
	    timeout = setTimeout(function(){
	        $('.theme-name').text('');
	    },100);
	    
	});

  function resizeIframe(obj) {
  	obj.style.height = 0;
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

function ChangeUrl(page, url) {
	if (typeof (window.parent.history.pushState) != "undefined") {
	    var obj = { Page: page, Url: url };
	    window.parent.history.pushState(obj, obj.Page, obj.Url);
	} else {
	    return;
	}
}

});


