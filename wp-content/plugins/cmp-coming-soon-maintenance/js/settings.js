jQuery(document).ready(function($){

	var formChanged = false;
	var tab = document.location.hash.substring(1);
	var action = jQuery('#csoptions').attr('action');

	// ini custom css textarea to codeEditor

	if ( wp.codeEditor ) {
		wp.codeEditor.initialize('niteoCS_custom_css');
	}
    

    // function to tab navigation
	navtab = function(tab) {
		jQuery('.nav-tab-wrapper .nav-tab').removeClass('nav-tab-active');
		jQuery('.nav-tab-wrapper .' + tab).addClass('nav-tab-active');

		jQuery('.table-wrapper.' + tab).css('display', 'block');
		jQuery('.table-wrapper-css.' + tab).css('display', 'block');
		jQuery('.comingsoon.' + tab).css('display', 'block');			

		jQuery('.table-wrapper:not(.' + tab + ')').css('display', 'none');
		jQuery('.table-wrapper-css:not(.' + tab).css('display', 'none');
		jQuery('.comingsoon:not(.' + tab + ')').css('display', 'none');

		if ( tab == 'install' ) {
			jQuery('.submit').css('display', 'none');
			jQuery('#csoptions').attr('action', action);
		} else {
			jQuery('.submit').css('display', 'block');
			// change form action to display current tab after save
			jQuery('#csoptions').attr('action', action + '#' + tab);
		}
	}

	if ( tab != '' ) {
		navtab(tab);
	} else {
		jQuery('.table-wrapper-css').css('display', 'none');
	}

	window.onhashchange = function(){
	    tab = document.location.hash.substring(1);    
	    navtab(tab);
	}

	$('.nav-tab:not(.theme-preview)').click(function(e) {
		e.preventDefault();
		tab = $(this).data('tab');
		document.location.hash = tab;
	});

	// update range inputs on change
	update_range('.blur-range');
	update_range('.overlay-opacity');

	// create media upload buttons
	media_upload_button('logo', false, 'image');
	media_upload_button('favicon', false, 'image');
	media_upload_button('images', true, 'image');
	media_upload_button('pattern', false, 'image');
	media_upload_button('video-thumb', false, 'image');
	media_upload_button('video', false, 'video');

	// show / hide settings 
	toggle_settings( 'analytics' );
	toggle_settings( 'contact-form' );
	toggle_settings( 'subscribe' );
	toggle_settings( 'background-effect' );
	toggle_settings( 'special-effect' );
	toggle_settings( 'cmp-logo' );

	toggle_select('subscribe-method');


	// change all selects to select2
	jQuery('select:not(.headings-google-font):not(.content-google-font )').select2({
		width: '100%',
		minimumResultsForSearch: -1,

	});


	jQuery('#cmp-status').click(function(){
		jQuery('.cmp-status input[type=radio]').prop('disabled', function (_, val) { return ! val; });
		jQuery('#cmp-status-menubar').prop('checked', function (_, val) { return ! val; });
	});


	cmp_status_inputs();

	function cmp_status_inputs() {

		// Make clickable status radio buttons
		jQuery('.cmp-status legend:not(.disabled)').click(function(){
			if ( jQuery('#cmp-status').prop('checked') == false ) {
				return;
			}
			var $children = jQuery(this).children('input');
			$children.prop("checked", true);
			jQuery('.cmp-status legend').removeClass('active');
			jQuery(this).addClass('active');

			$children.trigger('change');

			if ( $children.val() == '3' ) {
				jQuery('.redirect-inputs').fadeIn('fast');
			} else {
				jQuery('.redirect-inputs').fadeOut('fast');
			}
		});
	}


	// expandable tabs
	jQuery('.table-wrapper h3').click(function(){
		jQuery(this).parent().toggleClass('closed');
	});


	// test unsplash image
	jQuery('#test-unsplash').click(function(e){
		e.preventDefault();

		var media_wrapper 	= jQuery('#unsplash-media'),
			unsplash_feed 	= jQuery('#unsplash_banner select[name^="unsplash_feed"] option:selected').val(),
			unsp_url	  	= '',
			feat 		  	= '',
			custom_str 		= '',
			security		= jQuery(this).data('security');

		switch( unsplash_feed ) {
			// specific photo
		    case '0':
		    	unsp_url  	= jQuery('#niteoCS-unsplash-0').val();
		        break;

			// random from user
		    case '1':
		        custom_str	= jQuery('#niteoCS-unsplash-1').val();
		        break;

		    // random from collection
		    case '2':
		        unsp_url	= jQuery('#niteoCS-unsplash-2').val();
		        break;

		    // random photo
		    case '3':
		        unsp_url	= jQuery('#niteoCS-unsplash-3').val();
		        if ( jQuery('#niteoCS_unsplash_feat' ).is( ':checked' ) ) {
		        	feat = '1';
		        } else {
		        	feat = '0';
		        }
		        break;

		    default:
		        break;
		}


		if ( unsplash_feed == 3 || unsp_url != '' || custom_str != '' ) {

			var params = {feed: unsplash_feed, url: unsp_url, feat: feat, custom_str: custom_str};

			jQuery(this).prop('disabled', true);
			jQuery(this).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span> loading..</span>');
			media_wrapper.html('');

			var data = {
				action: 'niteo_unsplash',
				security: security,
				params: params
			};

			$.post(ajaxurl, data, function(response) {
				
				var unsplash = JSON.parse(response);

				jQuery('#unsplash_img').remove();

				var loadingTimeout = setTimeout(function(){
					jQuery('#test-unsplash').prop('disabled', false);
					jQuery('#test-unsplash').text('Display Unsplash Photo');
					jQuery('#unsplash-media').html('<p>It seems <a href="https://status.unsplash.com/" target="_blank">Unsplash API</a> is not responding. Please try again later.</p>');
				}, 5000);

				if ( unsplash.response == '200' ) {
					var unsplash = jQuery.parseJSON(unsplash.body);

					if ( unsplash[0]) {
						var img = unsplash[0]['urls']['raw']+'?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&fit=max&w=588';
						var author = unsplash[0]['user']['name'];
						var author_url = unsplash[0]['user']['links']['html'];
						var img_url = unsplash[0]['links']['html'];
						var img_id = unsplash[0]['id'];
					} else {
						var img = unsplash['urls']['raw']+'?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&fit=max&w=588';
						var author = unsplash['user']['name'];
						var author_url = unsplash['user']['links']['html'];
						var img_url = unsplash['links']['html'];
						var img_id = unsplash['id'];
					}
					
				  	jQuery('<img />', {src: img, id: 'unsplash_img'}).
				  		one('load', function() { //Set something to run when it finishes loading
		      				jQuery(this).appendTo(media_wrapper);
		      				jQuery(this).fadeIn();
							jQuery('#test-unsplash').prop('disabled', false);
							jQuery('#test-unsplash').text('Display Unsplash Photo');
							jQuery('#unsplash-media').append('<span><a href="'+img_url+'" target="_blank">Photo</a> (ID: '+img_id+') by <a href="'+author_url+'" target="_blank">' +author+ '</a> / <a href="https://unsplash.com/" target="_blank">Unsplash</a></span>')
							clearTimeout(loadingTimeout);
					});

				} else {
					jQuery('#test-unsplash').prop('disabled', false);
					jQuery('#test-unsplash').text('Display Unsplash Photo');
					jQuery('#unsplash-media').html('<p>Error '+unsplash.response+': <span style="text-transform:lowercase;">'+unsplash.body+'</span></p>');
					clearTimeout(loadingTimeout);
				}

			});
		} else {
			jQuery('#unsplash_img').remove();
		}

	});


	videoPreview = function() {
		var source = $('.banner-video-source').val();
		$('.video-wrapper').css('padding-top', '0');
		if ( source == 'YouTube' ) {
			var youtubeLink = $('#niteoCS-youtube-url').val();
			if( youtubeLink.match(/(youtube.com)/) ){
			    var split_c = 'v=';
			    var split_n = 1;
			}

			if( youtubeLink.match(/(youtu.be)/) || youtubeLink.match(/(vimeo.com\/)+[0-9]/) ){
			    var split_c = '/';
			    var split_n = 3;
			}

			if ( source == 'vimeo' ) {
				var youtubeLink = $('#niteoCS-vimeo-url').val();

				if( youtubeLink.match(/(vimeo.com\/)+[a-zA-Z]/) ){
				    var split_c = '/';
				    var split_n = 5;
				}
			}

			if ( youtubeLink ) {
				var getYouTubeVideoID = youtubeLink.split(split_c)[split_n];
				if ( getYouTubeVideoID != undefined ) {
					var cleanVideoID = getYouTubeVideoID.replace(/(&)+(.*)/, '');

					if( source == 'banner_youtube' && youtubeLink.match(/(youtu.be)/) || youtubeLink.match(/(youtube.com)/) ){
					    var videoEmbedLink = 'https://www.youtube.com/embed/'+cleanVideoID+'?autoplay=0';
					}

					if( source == 'banner_vimeo' && youtubeLink.match(/(vimeo.com\/)+[0-9]/) || youtubeLink.match(/(vimeo.com\/)+[a-zA-Z]/) ){
					    var videoEmbedLink = 'https://player.vimeo.com/video/'+cleanVideoID+'?autoplay=0';
					}

					var $iframe = $('<iframe src="'+videoEmbedLink+'" allowfullscreen></iframe>');
					$('.video-wrapper').html($iframe);
					var videoRatio = ( $iframe.height() / $iframe.width() ) * 100;

				    $iframe.css('position', 'absolute');
				    $iframe.css('top', '0');
				    $iframe.css('left', '0');
				    $iframe.css('width', '100%');
				    $iframe.css('height', '100%');
				   
				    $('.video-wrapper').css('padding-top', videoRatio+'%');
					$('#niteoCS-vimeo-url').css('border', '1px solid #ddd');
					$('#niteoCS-youtube-url').css('border', '1px solid #ddd');
				} else {
					$('.video-wrapper').text('Please enter correct ' + source + ' URL.').css('padding-top', '0');
					$('#niteoCS-vimeo-url').css('border', '1px solid #d60000');
					$('#niteoCS-youtube-url').css('border', '1px solid #d60000');
				}

			} else {
				$('.video-wrapper').text('Please enter ' + source + ' URL.').css('padding-top', '0');
				$('#niteoCS-vimeo-url').css('border', '1px solid #d60000');
				$('#niteoCS-youtube-url').css('border', '1px solid #d60000');
			}
		} 

		if ( source == 'video/mp4' ) {
			var videoURL = jQuery('#niteoCS-video-id').data('url');
			if ( videoURL != '' ) {
				$('.video-wrapper').html('<video width="600" height="400" controls><source src="'+videoURL+'" type="video/mp4">Your browser does not support the video tag.</video>');
			}
			
		}
	};

	jQuery('#niteoCS-youtube-url').keyup(function() {
		videoPreview();
	});

	// hiding video source inputs
	jQuery('#csoptions .banner-video-source').change(function() {
		switch(jQuery('#csoptions .banner-video-source' ).val() ) {
		    case 'YouTube':
		        jQuery('.youtube-source-input').css('display','block');
		        jQuery('.vimeo-source-input').css('display','none');
		        jQuery('.file-source-input').css('display','none');
		        break;
		    case 'vimeo':
		        jQuery('.youtube-source-input').css('display','none');
		        jQuery('.vimeo-source-input').css('display','block');
		        jQuery('.file-source-input').css('display','none');
		        break;
		    case 'video/mp4':
		        jQuery('.youtube-source-input').css('display','none');
		        jQuery('.vimeo-source-input').css('display','none');
		        jQuery('.file-source-input').css('display','block');
		        videoPreview();
		        break;
		    default:
		    	jQuery('.file-source-input').css('display','block');
		        jQuery('.youtube-source-input').css('display','none');
		        jQuery('.vimeo-source-input').css('display','none');
		}
		
	});
	jQuery('#csoptions .banner-video-source').trigger('change');

	// hiding banner on change
	jQuery('#csoptions .niteoCS_banner').change(function() {

		switch(jQuery('#csoptions .niteoCS_banner:checked' ).val() ) {
		    case '0':
		        jQuery('#custom_banner').css('display','block');
		        jQuery('.theme_background fieldset:not(#custom_banner)').css('display','none');
		        break;
		    case '1':
		        jQuery('#unsplash_banner').css('display','block');
		        jQuery('.theme_background fieldset:not(#unsplash_banner)').css('display','none');
		        break;
		    case '2':
		        jQuery('#default_banner').css('display','block');
		        jQuery('.theme_background fieldset:not(#default_banner)').css('display','none');
		        break;
		    case '3':
		        jQuery('#graphic_pattern').css('display','block');
		        jQuery('.theme_background fieldset:not(#graphic_pattern)').css('display','none');
		        break;
		    case '4':
		        jQuery('#solid_color').css('display','block');
		        jQuery('.theme_background fieldset:not(#solid_color)').css('display','none');
		        break;
		    case '5':
		        jQuery('#video_banner').css('display','block');
		        jQuery('.theme_background fieldset:not(#video_banner)').css('display','none');
		        videoPreview();
		        break;
		    case '6':
		        jQuery('#gradient_background').css('display','block');
		        jQuery('.theme_background fieldset:not(#gradient_background)').css('display','none');
		        break;
		    default:
		        jQuery('#custom_banner').css('display','block');
		        jQuery('.theme_background fieldset:not(#custom_banner)').css('display','none');
		        break;
		}
	});

	jQuery('#csoptions .niteoCS_banner:first').trigger('change');

	// display selected unsplash feed
	var unsplasfeed = jQuery('#unsplash_banner select[name^="unsplash_feed"] option:selected').val();
	jQuery('#unsplash-feed-' + unsplasfeed).css('display', 'block');

	jQuery('#unsplash_banner select[name^="unsplash_feed"]').on('change', function() {
		unsplasfeed = jQuery('#unsplash_banner select[name^="unsplash_feed"] option:selected').val();
		jQuery('.unsplash-feed').css('display', 'none');
	 	jQuery('#unsplash-feed-' + unsplasfeed).css('display', 'block');
		jQuery('#test-unsplash').trigger('click');
	});

	// load unsplash upon load if unsplash is selected
	if ( jQuery('#csoptions .niteoCS_banner:checked').val() == 1 ) {
		jQuery('#test-unsplash').trigger('click');
	}


	// preview gradient on select change
	jQuery('select.background-gradient').on('change', function() {
		var gradient = jQuery('select.background-gradient option:selected').val();

		if ( gradient == 'custom' ) {
			jQuery('.custom-gradient').css('display', 'block');
			jQuery('.gradient-preview').css({'background':'-moz-linear-gradient(-45deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)',
				'background':'-webkit-linear-gradient(-45deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)',
				'background':'linear-gradient(135deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)'});
		} else {
			colors = gradient.split(':');
			jQuery('.custom-gradient').css('display', 'none');
			jQuery('.gradient-preview').css({'background':'-moz-linear-gradient(-45deg, '+colors[0]+' 0%, '+colors[1]+' 100%)',
				'background':'-webkit-linear-gradient(-45deg, '+colors[0]+' 0%, '+colors[1]+' 100%)',
				'background':'linear-gradient(135deg, '+colors[0]+' 0%, '+colors[1]+' 100%)'});
		}
	}).trigger('change');

	// banner background colorpicker
	jQuery('#niteoCS_banner_color').wpColorPicker({
		change: function(event, ui){
			jQuery('.color-preview').css('background-color',  ui.color.toString());
			// jQuery(this).trigger('change');
	  }
	});

	// banner gradient background colorpicker
	jQuery('#niteoCS_gradient_one').wpColorPicker({
		change: function(event, ui){
			jQuery('.gradient-preview').css({'background':'-moz-linear-gradient(-45deg, '+ui.color.toString()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)',
				'background':'-webkit-linear-gradient(-45deg, '+ui.color.toString()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)',
				'background':'linear-gradient(135deg, '+ui.color.toString()+' 0%, '+jQuery('#niteoCS_gradient_two').val()+' 100%)'});
	  }
	});

	// banner gradient background colorpicker
	jQuery('#niteoCS_gradient_two').wpColorPicker({
		change: function(event, ui){
			jQuery('.gradient-preview').css({'background':'-moz-linear-gradient(-45deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+ui.color.toString()+' 100%)',
				'background':'-webkit-linear-gradient(-45deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+ui.color.toString()+' 100%)',
				'background':'linear-gradient(135deg, '+jQuery('#niteoCS_gradient_one').val()+' 0%, '+ui.color.toString()+' 100%)'});
	  }
	});

	// banner pattern on change image preview
	jQuery('select[name^="niteoCS_banner_pattern"]').on('change', function() {
		var pattern = jQuery('select[name^="niteoCS_banner_pattern"] option:selected').val();

		if (pattern != 'custom') {
			var pattern_url = jQuery(this).data('url');
			jQuery('#add-pattern').css('display', 'none');
			jQuery('.pattern-wrapper').css('background-image', 'url(\''+pattern_url+pattern+'.png\')');

		} else {
			var pattern_url = jQuery('#niteoCS_banner_pattern_custom').val();
			jQuery('#add-pattern').css('display', 'block');
			jQuery('.pattern-wrapper').css('background-image', 'url(\''+pattern_url+'\')');

		}
	});

	// preview animation 
	jQuery('.heading-animation').on('change', function() {
		heading_anim = jQuery('.heading-animation option:selected').val();
		jQuery('#heading-example').removeClass().addClass('animated ' + heading_anim);
	});

	jQuery('.content-animation').on('change', function() {
		heading_anim = jQuery('.content-animation option:selected').val();
		jQuery('#content-example').removeClass().addClass('animated ' + heading_anim);
	});
	

	// ----------------------- sortable social list -----------------------
	// function to update social list
	var update_social = function(name, key, val){
		var socialmedia = $('#niteoCS_socialmedia').attr('value');
		socialmedia = $.parseJSON(socialmedia);

		$.each(socialmedia, function(i, ele){
		    if (ele['name'] == name) {
		    	ele[key] = val;
		    }
		});

		$('#niteoCS_socialmedia').attr('value', JSON.stringify(socialmedia));
	};

	// sortable UI
	var $sortableList = $('.social-inputs');

	var sortEventHandler = function(event, ui){
		
		var inputs = $sortableList.find('input[type="text"]');

		var order = ui.item.index();

		inputs.each(function(i, ele){
		    var name = $(ele).data('name');
		    update_social(name, 'order', i);
		});
	};

	$sortableList.sortable({
	    stop: sortEventHandler
	});

	$sortableList.on('sortchange', sortEventHandler);

	// social checkbox to enable/disable input
	(function($) {
	    $.fn.toggleDisabled = function() {
	        return this.each(function() {
	            var $this = $(this);
	            var active;
	            var name = $this.data('name');
	            if ($this.attr('disabled')) { 
	            	$this.prop('disabled', false);
	            	active = '1';
	            } else  {
	            	$this.prop('disabled', true);
	            	active = '0';
	            }
	            update_social(name, 'active', active);
	        });
	    };
	})(jQuery);

	jQuery('.social-inputs input[type="text"]').focusout(function(){
		var name = jQuery(this).data('name');
		var socialurl = jQuery(this).attr('value');
		update_social(name, 'url', socialurl);
	});

	jQuery('.social-inputs input[type="checkbox"]').click(function(e){
		var $this = $(this).siblings('input[type="text"]');
		$this.toggleDisabled();
	});

	// social icons active/inactive
	jQuery('.social-media i').click(function() {
		var name = jQuery(this).data('name');
		jQuery(this).toggleClass('active');
		jQuery('.social-inputs li.' + name).toggleClass('active');
		jQuery('.social-inputs li.' + name + ' input').trigger('change');
		
		if (jQuery(this).hasClass('active')) {
			update_social(name, 'hidden', '0');
		} else {
			update_social(name, 'hidden', '1');
		}
		// hide/show input labels
		if (jQuery('.social-media i.active').length) {
			jQuery('.social-inputs .label').css('display', 'block');
		} else {
			jQuery('.social-inputs .label').css('display', 'none');
		}
	});
	// hide/show input labels
	if (jQuery('.social-media i.active').length) {
		jQuery('.social-inputs .label').css('display', 'block');
	}

	

	// theme update admin notice view release notes
	jQuery('.view-release').click(function(e) {
		e.preventDefault();
		$this = jQuery(this);
		var release_url = $this.attr('href');
		jQuery.get(release_url, function( release ) {
			$this.closest('.notice').find('.release-note .notes').remove();
		    $this.closest('.notice').find('.release-note').append('<div class="notes">'+release+'</div>');
		}).fail(function() {
			$this.closest('.notice').find('.release-note p').remove();
		    $this.closest('.notice').find('.release-note').append('<p>There was an error loading release notes. Please try again later.</p>');
		});
	});

	// theme update via admin notice
	jQuery('.update-theme').click(function(e) {
		e.preventDefault();
		var $this 		= $(this),
			$parent 	= $this.parents('.notice'),
			security 	= $this.data('security'),
			slug 		= $this.data('slug'),
			themeName 	= $this.data('name'),
			remoteUrl 	= jQuery(this).data('remote_url');
		var update  = {
			'name': slug,
			'tmp_name': '',
			'url': remoteUrl+'?action=download&slug='+slug,
		}

		var data = {
			action: 'cmp_theme_update_install',
			security: security,
			file: update
		};

		$parent.find('.message').html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span class="sr-only">Updating heme...</span><span> working hard on updating Theme...</span>');

		$.post(ajaxurl, data, function(response) {	
			response = response.trim();
			if (response == 'success') {
				setTimeout(function(){

					$parent.removeClass('notice-warning').addClass('notice-success');
					$parent.find('.message').html('<span> '+themeName+' CMP theme was updated sucessfully! </span><i class="fa fa-smile-o" aria-hidden="true"></i>');
				}, 1500);

			} else {

				response = response.slice(0,-1);
				var error = $('p', $(response)).text();
				$parent.removeClass('notice-warning').addClass('notice-error');
				$parent.find('.message').html('<i class="fa fa-frown-o" aria-hidden="true"></i><span> '+error+'</span>');
			}
		});
	});

	// theme-selector scripts
	// select theme by click on thumbnail or select button
	jQuery('.theme-select').click(function(){
		jQuery(this).parent().find('input[name="select_theme"]').prop("checked", true).trigger('change');
		jQuery('.theme-select').removeClass('selected');
		jQuery(this).parent().find('.theme-select').addClass('selected');
	});


	// theme update via theme button
	jQuery('.theme-update.button').one('click',function(e) {
		e.preventDefault();
		var $this 		= $(this),
			$wrapper    = $this.closest('.theme-wrapper'),
			security 	= $wrapper.data('security'),
			slug 		= $wrapper.data('slug'),
			remoteUrl 	= $wrapper.data('remote_url');

		var update  = {
			'name': slug,
			'tmp_name': '',
			'url': remoteUrl+'?action=download&slug='+slug,
		}

		var data = {
			action: 'cmp_theme_update_install',
			security: security,
			file: update
		};

		$this.html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span>Updating..</span>');

		$.post(ajaxurl, data, function(response) {
			if (response == 'success') {
				setTimeout(function(){
					$this.html('<i class="fa fa-smile-o" aria-hidden="true"></i><span>Updated!</span>');
					setTimeout(function(){
						$this.fadeOut();
					}, 1500);
				}, 1500);

			} else {
				response = response.slice(0,-1);
				$this.html('<i class="fa fa-frown-o" aria-hidden="true"></i><span>Update Failed!</span>');
			}
		});
	});

	// display theme details overlay
	jQuery('.theme-details').click(function() {

		var $this 		= $(this),
			$wrapper    = $this.closest('.theme-wrapper'),
			slug 		= $wrapper.data('slug'),
			version 	= $wrapper.data('version'),
			remoteUrl 	= $wrapper.data('remote_url'),
			type 		= $wrapper.data('type'),
			purchased 	= $wrapper.data('purchased'),
			freebie 	= $wrapper.data('freebie'),
			noticeHtml 	= '',
			security 	= jQuery('.update-theme').data('security'),
			price 		= $wrapper.data('price'),
			i = 0;

		var data = {
			action: 'niteo_themeinfo',
			security: jQuery('.theme-wrapper').data('security'),
			theme_slug: jQuery(this).parents('.theme-wrapper').data('slug'),
		};

		$.post(ajaxurl, data, function(response) {
			var buttonDisabled 	= '';
			var buyButton 		= '';
			var versionInfo 	= '';
			var noticeHtml 		= '';
			// parse JSON data to array
			response = jQuery.parseJSON(response);


			if ( response.result == 'true' ) {
				// overflow body hidden
				jQuery('body').addClass('modal-open');

				// if installed display version info
				if ( purchased == '1') {

					versionInfo = '<span class="theme-version">Version: '+version+'</span>';
					noticeHtml = '<div class="notice notice-success notice-alt notice-large"><p>Theme is up to date.</p></div>';
					if ( jQuery('.update-theme').length ) {

						var updateSlug = jQuery('.update-theme').data('slug');

						if ( slug == updateSlug ) {
							var newVer = jQuery('.update-theme').data('new_ver');
							noticeHtml = '<div class="notice notice-warning notice-alt notice-large"><h3 class="notice-title">Update Available</h3><p class="message"><strong>There is a new version of '+response['name']+' theme available.  <a href="'+remoteUrl+'readme/'+slug+'-readme.php" class="view-release">View update '+newVer+' notes</a> or <a href="'+window.location.href+'&action=update-cmp-theme&theme='+slug+'" class="update-theme" data-security="'+security+'" data-slug="'+slug+'" data-remote_url="'+remoteUrl+'">Update now.</a></strong></p><div class="release-note"></div></div>';
						}
						
					
					} 
				}

				// if premium and not installed, display buy button
				if ( purchased != '1' && type == 'premium' ){
					var buttonDisabled = 'disabled ';
					var buyURL = $wrapper.find('a').attr('href');
					var buyButton = '<button type="button" class="theme-purchase button hide"><a href="'+buyURL+'" target="_blank"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>Get Theme</a></button>';
		
				}

				// get screenshots 
				var screenshots = response.screenshots;
				var arrows = '';
				// if we have more screenshots, generate navigation arrows
				if ( Object.keys(screenshots).length > 1 ) {
					arrows = '<div class="screenshots-nav"><div class="left"><i class="fa fa-chevron-left" aria-hidden="true"></i></div><div class="right"><i class="fa fa-chevron-right" aria-hidden="true"></i></div></div>';
				}

				// generate html to append to theme-overlay
				var html = $([
					'<div class="theme-backdrop">',
					'	<div class="theme-wrap">',
					'		<div class="theme-header">',
					'			<button class="close dashicons dashicons-no"><span class="screen-reader-text">Close details dialog</span></button>',
					'		</div>',
					'		<div class="theme-about">',
					'			<div class="theme-screenshots">',
					'				<div class="screenshot" style="background-image:url(\''+screenshots['0']+'\')">'+arrows+'</div>',
					'			</div>',
					'			<div class="theme-info">',
					'				<h2 class="theme-name">'+response['name'] + versionInfo + '</h2>',
					'				<p class="theme-author">By <a href="'+response['author_homepage']+'" target="_blank">'+response['author']+'</a></p>',
									noticeHtml,
									buyButton,
					'				<div class="theme-description">'+response['description']+'</div>',
					'			</div>',
					'		</div>',
					'		<div class="theme-actions">',
					'			<button type="submit" '+buttonDisabled+'class="button activate" name="Submit" aria-label="Select '+response['name']+'">Activate</button>',
					'			<a href="http://cmp.niteothemes.com/?cmp_preview=true&selector=true&theme='+slug+'&utm_source=cmp&utm_medium=referral&utm_campaign='+slug+'" class="button cmp-preview" target="_blank" aria-label="Preview '+response['name']+'">Live Preview</a>',
					'		</div>',
					'	</div>',
					'</div>',
					].join("\n"));  

				// append html to overlay
				jQuery('.theme-overlay.cmp').append(html);

				// attach view-release handler
				jQuery('.theme-overlay.cmp .view-release').click(function(e) {
					e.preventDefault();
					$this = jQuery(this);
					var release_url = $this.attr('href');
					jQuery.get(release_url, function( release ) {
						$this.closest('.notice').find('.release-note .notes').remove();
					    $this.closest('.notice').find('.release-note').append('<div class="notes">'+release+'</div>');
					}).fail(function() {
						$this.closest('.notice').find('.release-note p').remove();
					    $this.closest('.notice').find('.release-note').append('<p>There was an error loading release notes. Please try again later.</p>');
					});
				});

				// attach close button handler
				jQuery('.theme-overlay.cmp .close').click(function(e) {
					e.preventDefault();
					// overflow body hidden
					jQuery('body').removeClass('modal-open');
					jQuery('.theme-overlay.cmp .theme-backdrop').fadeOut('fast');
				});

				// attach select theme handler
				jQuery('.theme-overlay.cmp .activate').click(function(e) {
					e.preventDefault();
					// select theme
					jQuery('input[name="select_theme"]').each(function() {
					    if ( jQuery(this).val() == slug ) {
					    	jQuery(this).prop('checked', true);
							jQuery('.theme-select').removeClass('selected');
							jQuery(this).parent().addClass('selected');	
					    }
					});

					jQuery( this ).submit();
				});

				// attach arrows navigation handler
				jQuery('.screenshots-nav .right').click(function() {
					i++;

					if (i == Object.keys(screenshots).length) {
						i = 0;
					}

					if ((i in screenshots)) {
						jQuery('.screenshot').css('background-image', 'url(\''+screenshots[i]+'\')');
					}
				});

				// attach arrows navigation handler
				jQuery('.screenshots-nav .left').click(function() {
					i--;

					if (i < 0) {
						i = Object.keys(screenshots).length - 1;
					}

					if ((i in screenshots)) {
						jQuery('.screenshot').css('background-image', 'url(\''+screenshots[i]+'\')');
					}
				});
			}
		});
	
	});

	// jQuery('#csoptions input[name="niteoCS_subscribe_type"]').trigger('change');


	// define functions //
	function ucwords (str) {
	    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
	        return $1.toUpperCase();
	    });
	}

	function strtolower (str) {
	    return (str+'').toLowerCase();
	}

	function media_upload_button (name, multiple, type) {
		// define var
		var $container 		= jQuery('.'+name+'-wrapper');
		var $add_button 	= jQuery('#add-'+name);
		var $delete_button 	= jQuery('#delete-'+name);
		var image;
		var imgID = '';
		var title = name.replace('-', ' ');
		title = title[0].toUpperCase() + title.slice(1);

		if ( jQuery('#niteoCS-'+name+'-id').val() != '' ) {
			// Display Delete button
			$delete_button.css( 'display', 'block' );
		} 

		$add_button.click(function(e) {
		    e.preventDefault();
		 // If the media frame already exists, reopen it.
		    if ( media_uploader ) {
		      media_uploader.open();
		      return;
		    }

		   var media_uploader = wp.media({
		        title: 'Select '+ title,
		        button: {
		            text: 'Insert '+ title
		        },
		        multiple: multiple,  // Set this to true to allow multiple files to be selected
				library: {
            		type: [ type ]
				},
		    })
		    .on('select', function() {
				// Get media attachment details from the frame state
				var attachment = media_uploader.state().get('selection').toJSON();

				if (attachment.length > 0) {
					$container.empty();

					jQuery(attachment).each(function(i) {
				        if (attachment[i].sizes && attachment[i].sizes.large) {
				        	image = attachment[i].sizes.large.url;
				        } else {
				        	image = attachment[i].url;
				        }

						// add image ID and url to comma-separated variable
						var comma = i === 0 ? '' : ',';
						imgID += ( comma + attachment[i].id );
						// Send the attachment URL to our custom image input field.

						if ( name == 'pattern') {
							$container.css('background-image', 'url(\''+image+'\')');
						} else if ( name == 'video') {
							$container.append( '<video width="600" height="400" controls><source src="'+image+'" type="video/mp4">Your browser does not support the video tag.</video>' );
						} else {
							$container.append( '<img src="' + image + '" alt="" style="max-width:588px"/>' );
						}
						
					});

					// Display Delete  button
					$delete_button.css( 'display', 'block' );

				}
				// update hidden input with media id and trigger change
				jQuery('#niteoCS-'+name+'-id').val( imgID).trigger('change');
		        
		    })
		    .open();if ( name == 'pattern') {
							$container.css('background-image', 'url(\''+image+'\')');
						}
		});


		$delete_button.click(function(e) {
			jQuery(this).css('display', 'none');
			$container.empty();
			jQuery('#niteoCS-'+name+'-id').val('');
			jQuery('#niteoCS-'+name+'-id').trigger('change');

		});
	}


	// Retrieve Mailchimp lists 
	jQuery('#connect-mailchimp').click(function(e){
		e.preventDefault();

		var apikey 		= jQuery('input[name="niteoCS_mailchimp_apikey"]').val(),
			security	= jQuery(this).data('security'),
			button 		= jQuery(this);

		if ( apikey != '' ) {

			var params = {apikey: apikey, security: security};

			jQuery(this).prop('disabled', true);

			jQuery(this).html('<i class="fa fa-cog fa-spin fa-1x fa-fw"></i><span> retrieving lists..</span>');

			var data = {
				action: 'cmp_mailchimp_list_ajax',
				security: security,
				params: params,
			};

			$.post(ajaxurl, data, function(response) {	
				var lists = JSON.parse(response);

				if ( lists.response == 200 ) {

					$('#mailchimp-lists-select').empty().prop('disabled', false);
					$.each(lists.lists, function(i,val) {
					    $('#mailchimp-lists-select').append('<option value="'+val.id+'">'+val.name+'</option>');
					});

				} else {
					$('#mailchimp-lists-select').empty().prop('disabled', true).html('<option value="error">'+lists.message+'</option>').trigger('change');
				}

				button.html('Retrieve Lists');
				button.prop('disabled', false);

			}).fail(function() {

				button.html('Retrieve Lists');
				button.prop('disabled', false);
			});
		}
	});


	function toggle_settings ( classname ) {
		// Logo type inputs
		jQuery('.'+classname).change(function() {

			var value = jQuery('.'+classname+':checked' ).val();
			value = ( jQuery.isNumeric(value) ) ? 'x'+value : value;

			jQuery('.'+classname+'-switch.'+value).css('display','block');
			jQuery('.'+classname+'-switch:not(.'+value+')').css('display','none');

		});

		jQuery('.'+classname).first().trigger('change');

	}

	function toggle_select ( classname ) {
		// Logo type inputs
		jQuery('.'+classname).change(function() {
			var value = jQuery('.'+classname ).val();

			value = ( jQuery.isNumeric(value) ) ? 'x'+value : value;

			jQuery('.'+classname+ '.'+value).css('display','block');
			jQuery('.'+classname+':not(.'+value+')').css('display','none');

		});

		jQuery('.'+classname).first().trigger('change');

	}

	function update_range ( selector ) {
		jQuery( selector ).on('input', function () {
			var value = jQuery(this).val();
			// change label value
			jQuery(this).parent().find('span').html(value);

		});
	}

});




