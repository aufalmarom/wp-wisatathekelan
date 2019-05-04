<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Create a new table class that will extend the WP_List_Table
 */
class cmp_render_html extends niteo_cmp {

    // Render Background
    public function cmp_background( $niteoCS_banner, $themeslug, $overlay = false ) {
    	$size = $this->isMobile() ? 'large' : 'full';
        $html = '';
        // change background to default image, if image preview background is set
        if ( isset( $_GET['background'] ) && is_numeric( $_GET['background'] ) ) {
            $niteoCS_banner = esc_attr($_GET['background']);
            $theme          = esc_attr($_GET['theme']);

            if ( $_GET['background'] == '1' ) {
                // override background=1 (unsplash) to theme specific
                switch ( $theme ) {
                    case 'orbit':
                    case 'frame':
                    case 'eclipse':
                    case 'element':
                        // default image
                        $niteoCS_banner = '2';
                        break;
                    
                    default:
                        break;
                }
            }

        }

        
        switch ( $niteoCS_banner ) {
            // custom media
            case '0':
                $banner_id = get_option('niteoCS_banner_id['.$themeslug.']');
                
                if ( $banner_id != '' ) {
                    $banner_ids = explode(',', $banner_id);
                    $banner_url = wp_get_attachment_image_src( $banner_ids[mt_rand(0, count( $banner_ids ) - 1)], $size);
                    if ( isset($banner_url[0]) ) {
                        $banner_url = $banner_url[0];
                    }

                } else {
                    // send default image
                    $banner_url = $this->cmp_themeURL($themeslug).$themeslug.'/img/'.$themeslug.'_banner_'.$size.'.jpg';
                }

                $html = '<div id="background-image" class="image" style="background-image:url(\''.esc_url( $banner_url ).'\')"></div>';
                break;

            case '1':
                // unsplash
                $background_class = 'image';
                $unplash_feed   = get_option('niteoCS_unsplash_feed['.$themeslug.']', '3');

                switch ( $unplash_feed ) {
                    // specific photo from id
                    case '0':
                        $params = array('feed' => '0', 'url' => get_option('niteoCS_unsplash_0['.$themeslug.']', '') );
                        $unsplash = $this->niteo_unsplash(  $params );
                        break;

                    // random from user
                    case '1':
                        $params = array('feed' => '1', 'custom_str' => get_option('niteoCS_unsplash_1['.$themeslug.']', '') );
                        $unsplash = $this->niteo_unsplash(  $params );
                        break;

                    // random from collection
                    case '2':
                        $params = array('feed' => '2', 'url' => get_option('niteoCS_unsplash_2['.$themeslug.']', '') );
                        $unsplash = $this->niteo_unsplash(  $params );
                        break;

                    // random photo
                    case '3':
                        $params = array('feed' => '3', 'url' => get_option('niteoCS_unsplash_3['.$themeslug.']', ''), 'feat' => get_option('niteoCS_unsplash_feat['.$themeslug.']', '0') );
                        $unsplash = $this->niteo_unsplash(  $params );
                        break;
                    default:
                        break;
                }


                // get raw url from response
                if ( isset( $unsplash['response'] ) && $unsplash['response'] == '200' ) {
                    $body = json_decode ($unsplash['body'], true );

                    if ( isset( $body[0] ) ) {
                        foreach ( $body as $item ) {
                            $unsplash_url           = $item['urls']['raw'];
                            $unsplash_download      = $item['links']['download_location'];
                        }
                    } else {
                        $unsplash_url           = $body['urls']['raw'];
                        $unsplash_download      = $body['links']['download_location'];
                    } 

                    switch ( $themeslug ) {
                        case 'element':
                            $width = 1;
                            $height = 0.6;
                            break;
                        
                        default:
                            $width = 1;
                            $height = 1;
                            break;
                    }

                    ob_start(); ?>

                    <script>
                        var unsplash_img = '<?php echo esc_url( $unsplash_url );?>';
                        var unsplash_download = '<?php echo esc_url( $unsplash_download );?>';

                        var width = document.documentElement.clientWidth * <?php echo $width;?>;
                        var height = document.documentElement.clientHeight * <?php echo $height;?>;
                        var dimension = 'w=' + width;
                        if ( width < height ) {
                            dimension = 'h=' + height;
                        }

                        unsplash_img = unsplash_img + '?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&fit=crop&' + dimension;
                        var banner      = '<div id="background-image" class="image" style="background-image:url('+unsplash_img+')"></div>'; 

                        var container = document.getElementById("background-wrapper");

                        if ( container == null ) {
                            container = document.getElementById("banner-wrapper");
                        } 

                        container.innerHTML = banner;

                        // define get function for external URL
                        function Get(yourUrl){
                            var Httpreq = new XMLHttpRequest(); // a new request
                            Httpreq.open("GET", yourUrl, false);
                            Httpreq.send(null);
                            return Httpreq.responseText;          
                        }

                        // trigger Unsplash download to meet API requirements
                        var json_obj = JSON.parse( Get( unsplash_download + '?client_id=41f043163758cf2e898e8a868bc142c20bc3f5966e7abac4779ee684088092ab' ) );                      

                    </script>
                    <?php 

                    $html = ob_get_clean();
                } 

                break;

             case '2':
                // default image
                $banner_url = $this->cmp_themeURL($themeslug).$themeslug.'/img/'.$themeslug.'_banner_'.$size.'.jpg';
                $html = '<div id="background-image" class="image" style="background-image:url(\''.esc_url( $banner_url ).'\')"></div>';
                break;

            case '3':
                // Pattern
                $niteoCS_banner_pattern = get_option('niteoCS_banner_pattern['.$themeslug.']', 'sakura');

                if ( $niteoCS_banner_pattern != 'custom' ) {
                    $banner_url =  plugin_dir_url( dirname( __FILE__ ) ).'img/patterns/'.esc_attr($niteoCS_banner_pattern).'.png';   

                } else {
                    $banner_url = get_option('niteoCS_banner_pattern_custom['.$themeslug.']');
                    $banner_url = wp_get_attachment_image_src( $banner_url, 'large' );
                    if ( isset($banner_url[0]) ){
                        $banner_url = $banner_url[0];
                    }
                }
                $html = '<div id="background-image" class="pattern" style="background-image:url(\''.esc_url( $banner_url ).'\')"></div>';
                break;

            case '4':
                // Color
                $color = get_option('niteoCS_banner_color['.$themeslug.']', '#e5e5e5');
                $html ='<div id="background-image" class="color loaded" style="background-color:'.esc_url( $color ).'"></div>';
                break;

            case '5':
                $html = '<div id="player" class="video-banner"></div>';
                break;

            case '6':
                // Gradient
                $background_class = 'gradient';
                $niteoCS_gradient = get_option('niteoCS_gradient['.$themeslug.']', '#ED5565:#D62739');
                if ( $niteoCS_gradient == 'custom' ) {
    				$niteoCS_gradient_one = get_option('niteoCS_banner_gradient_one['.$themeslug.']', '#e5e5e5');
    				$niteoCS_gradient_two = get_option('niteoCS_banner_gradient_two['.$themeslug.']', '#e5e5e5');
                } else {
    				$gradient = explode(":", $niteoCS_gradient);
    				$niteoCS_gradient_one 			= $gradient[0];
    				$niteoCS_gradient_two 			= $gradient[1];	
                }

                
                $html = '<div id="background-image" class="gradient loaded" style="background:-moz-linear-gradient(-45deg, '.esc_attr( $niteoCS_gradient_one ).' 0%, '.esc_attr( $niteoCS_gradient_two ).' 100%);background:-webkit-linear-gradient(-45deg, '.esc_attr( $niteoCS_gradient_one ).' 0%, '.esc_attr( $niteoCS_gradient_two ).' 100%);background:linear-gradient(135deg,'.esc_attr( $niteoCS_gradient_one ).' 0%, '.esc_attr( $niteoCS_gradient_two ).' 100%)"></div>';
                break;
            default:
                break;
        }

        if ( $overlay === true ) {
            $html .= '<div class="background-overlay"></div>';
        }

        return $html;
    }


    // render slider
    public function cmp_slider( $themeslug, $overlay = false ) {

        // change to background if preview background is set
        if ( isset($_GET['background']) && is_numeric($_GET['background']) ) {
            if ( $_GET['background'] != 1 ) {
                echo '<div id="background-wrapper">'.$this->cmp_background($_GET['background'], $themeslug).'</div>';
                return;
            }
        }

        $niteoCS_banner     = get_option('niteoCS_banner['.$themeslug.']', '1');
        $slider_count       = get_option('niteoCS_slider_count['.$themeslug.']', '3');
        $slider_effect      = get_option('niteoCS_slider_effect['.$themeslug.']', 'true');
        $slider_autoplay    = get_option('niteoCS_slider_auto['.$themeslug.']', '1');

        ?>

        <div id="slider-wrapper">

             <div id="slider" class="slides effect-<?php echo esc_attr( $slider_effect );?>" data-autoplay="<?php echo esc_attr( $slider_autoplay );?>">
                <?php
                switch ( $niteoCS_banner ) {

                   // custom media
                    case '0':
                        $banner_id = get_option('niteoCS_banner_id['.$themeslug.']');
                        $size = $this->isMobile() ? 'large' : 'full';

                        if ( $banner_id != '' ) {
                            $banner_ids = explode(',', $banner_id);
                        }

                        if ( isset( $banner_ids ) ) {
                            foreach ( $banner_ids as $id ) {
                                $slide_url = wp_get_attachment_image_src( $id, $size);
                                
                                if ( isset( $slide_url[0] ) ) {
                                    $slide_url = $slide_url[0];
                                } ?>
                                <div class="slide">
                                    <div class="slide-background" style="background-image:url('<?php echo esc_url( $slide_url ); ?>')"></div>
                                </div>
                                <?php 
                            }
                        }

                        break;

                    // unsplash
                    case '1':
                        $unplash_feed   = get_option('niteoCS_unsplash_feed['.$themeslug.']', '3');

                        switch ( $unplash_feed ) {
                            // specific photo from id
                            case '0':
                                $params = array( 'feed' => '0', 'url' => get_option('niteoCS_unsplash_0['.$themeslug.']', ''), 'count' => $slider_count );
                                $unsplash = $this->niteo_unsplash(  $params );
                                break;

                            // random from user
                            case '1':
                                $params = array( 'feed' => '1', 'custom_str' => get_option('niteoCS_unsplash_1['.$themeslug.']', ''), 'count' => $slider_count  );
                                $unsplash = $this->niteo_unsplash(  $params );
                                break;

                            // random from collection
                            case '2':
                                $params = array( 'feed' => '2', 'url' => get_option('niteoCS_unsplash_2['.$themeslug.']', ''), 'count' => $slider_count  );
                                $unsplash = $this->niteo_unsplash(  $params );
                                break;

                            // random photo
                            case '3':
                                $params = array( 'feed' => '3', 'url' => get_option('niteoCS_unsplash_3['.$themeslug.']', ''), 'feat' => get_option('niteoCS_unsplash_feat['.$themeslug.']', '0'), 'count' => $slider_count  );
                                $unsplash = $this->niteo_unsplash(  $params );
                                break;

                            default:
                                break;
                        }

                        // get raw url from response
                        if ( isset( $unsplash['response'] ) && $unsplash['response'] == '200' ) {
                            $unsplash_body = json_decode($unsplash['body'], true);

                            $imgs = array();

                            if ( isset( $unsplash_body[0] ) ) {
                                foreach ( $unsplash_body as $item ) {
                                    array_push( $imgs, $item['urls']['raw']);
                                }

                            } else {
                                $imgs[0] = $unsplash_body['urls']['raw'];
                            }

                            $imgs = json_encode( $imgs ); 

                            switch ( $themeslug ) {
                                case 'element':
                                    $width = 1;
                                    $height = 0.6;
                                    break;
                                
                                default:
                                    $width = 1;
                                    $height = 1;
                                    break;
                            }
                            ?>

                            <script>
                                var imgs = <?php echo $imgs;?>;

                                var width = document.documentElement.clientWidth * <?php echo $width;?>;
                                var height = document.documentElement.clientHeight * <?php echo $height;?>;
                                var dimension = 'w=' + width;
                                if ( width < height ) {
                                    dimension = 'h=' + height;
                                }
                                var query  = '?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&fit=max&' + dimension;
                                var img = '';

                                for ( i=0; i < imgs.length; i++ ) {
                                    var slide = document.createElement('div');

                                    slide.className = 'slide';
                                    img = imgs[i] + query;
                                    var slide_background = '<div class="slide-background" style="background-image:url(\''+img+'\')"></div>'; 

                                    slide.innerHTML = slide_background;
                                    document.getElementById('slider').appendChild(slide);
                                }
                            </script>

                            <?php
                        }

                    default:
                        break;
                } ?>
            </div>

        </div>

        <div class="prev"></div>
        <div class="next"></div>
        
        <?php
        // render overlay image if required 
        if ( $overlay === true ) {
            echo '<div class="background-overlay"></div>';
        } 

        return;
    }

    // render Social Icons
    public function cmp_social_icons( $mode = 'icon', $title = false, $themeslug = false ) {

        $html = '';

        if ( $title == true ) {
            $soc_title = stripslashes( get_option('niteoCS_soc_title', 'GET SOCIAL WITH US') );
            $html = ( $soc_title == '' ) ? '' : '<h2 class="soc-title">' . esc_html( $soc_title ) . '</h2>';
        }
        
        // migrate social media to new option after update 1.4.0
        if ( get_option('niteoCS_socialmedia') ) {

            $socialmedia = stripslashes( get_option('niteoCS_socialmedia') );
            $socialmedia = json_decode( $socialmedia, true );
            //sort social icons array by hidden, then order key
            uasort( $socialmedia  , array($this,'sort_social') );

            $html = $html.'<ul class="social-list">';

            $theme_html = ( $themeslug == 'stylo' ) ? '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="3em" height="3em" viewBox="0 0 80 80" xml:space="preserve"><circle transform="rotate(-90 40 40)" class="another-circle" cx="40" cy="40" r="36" /></svg>' : '';

            ob_start();

            foreach ( $socialmedia as $social ) {

                if ( $social['hidden'] == '0' && $social['active'] == '1') {
               
                    switch ($social['name']) {
                        case 'envelope-o':
                            echo ( $mode == 'text' ) ? '<li><a href="mailto:'.antispambot(esc_html($social['url'])).'" target="_blank">Email</a></li>' : '<li><a href="mailto:'.antispambot(esc_html($social['url'])).'" target="_blank">'.$theme_html.'<i class="fa fa-'.$social['name'].'" aria-hidden="true"></i></a></li>';
                            break;

                        case 'phone':
                            echo ( $mode == 'text' ) ? '<li><a href="tel:'.esc_attr($social['url']).'" target="_blank">'.__('Phone', 'cmp-coming-soon-maintenance').'</a></li>' : '<li><a href="tel:'.esc_html($social['url']).'" target="_blank">'.$theme_html.'<i class="fa fa-'.$social['name'].'" aria-hidden="true"></i></a></li>';
                            break;

                        case 'whatsapp':
                            echo ( $mode == 'text' ) ? '<li><a href="https://api.whatsapp.com/send?phone='.esc_html(str_replace('+', '', $social['url'])).'" target="_blank">'.ucfirst($social['name']).'</a></li>' : '<li><a href="https://api.whatsapp.com/send?phone='.esc_html(str_replace('+', '', $social['url'])).'" target="_blank">'.$theme_html.'<i class="fa fa-'.$social['name'].'" aria-hidden="true"></i></a></li>';
                            break;

                        default:
                            echo ( $mode == 'text' ) ? '<li><a href="'.esc_url($social['url']).'" target="top">'.ucfirst($social['name']).'</a></li>' : '<li><a href="'.esc_url($social['url']).'" target="top">'.$theme_html.'<i class="fa fa-'.$social['name'].'" aria-hidden="true"></i></a></li>';
                            break;
                    } 
                } 
            }

            $social_list = ob_get_clean();

            if ( $social_list != '' ) {
                return $html.$social_list.'</ul>';

            }
        }

        return;
        
    }

    // Render Logo
    public function cmp_logo( $themeslug ) {
        $logo_type = get_option('niteoCS_logo_type['.$themeslug.']', 'text');
        $size = $this->isMobile() ? 'large' : 'full';
        $html = '';

        switch ( $logo_type ) {
            case 'graphic':
                // get logo id
                $logo_id = get_option('niteoCS_logo_id['.$themeslug.']');
                // get logo
                if ( $logo_id != '' ) {
                    $logo_url = wp_get_attachment_image_src( $logo_id, $size );
                }
                if ( isset($logo_url[0]) ) {
                    $html = '<div class="logo-wrapper image"><img src="'.esc_url( $logo_url[0] ).'" class="graphic-logo" alt="logo"></div>';

                }
                break;

            case 'text':
                $text_logo = stripslashes(get_option('niteoCS_text_logo['.$themeslug.']', get_bloginfo( 'name', 'display' )));
                $html = '<div class="text-logo-wrapper"><h1 class="text-logo">'.esc_html( $text_logo ).'</h1></div>';
                break;
            case 'disabled':
            default:
                break;
        } 
        return $html;
    }


    // render subscribe form
    public function cmp_subscribe_form() {
        // process emails first
        $response = $this->niteo_subscribe( true );

        $subscribe = get_option('niteoCS_subscribe_type', '2');
        
        $html = '';
        // if subscribers is 3rd party plugin, render form by shortcode
        if ( $subscribe == '1' ) {
            $replace  = array('<p>', '</p>' );
            $html =  str_replace($replace, '', do_shortcode( stripslashes( get_option('niteoCS_subscribe_code') ))) ; 

        // CMP subscribe form
        } else if ( $subscribe == '2' ) {
            // get label
            $niteoCS_subscribe_label    = stripslashes(get_option('niteoCS_subscribe_label', 'Subscribe for awesome news!'));

            // override label if in Theme preview
            if ( isset( $_GET['theme'] ) ) {
                switch ( $_GET['theme'] ) {
                    case 'eclipse':
                    case 'element':
                        $niteoCS_subscribe_label = 'SUBSCRIBE US';
                        break;
                    default:
                        break;
                }
                
            }

            //  get translation if exists
            $translation            = json_decode( get_option('niteoCS_translation'), true );
            $placeholder            = isset($translation[4]['translation']) ? stripslashes( $translation[4]['translation'] ) : 'Insert your email address.';
            $placeholder_firstname  = isset($translation[10]['translation']) ? stripslashes( $translation[10]['translation'] ) : 'First Name';
            $placeholder_lastname   = isset($translation[11]['translation']) ? stripslashes( $translation[11]['translation'] ) : 'Last Name';
            $submit                 = isset($translation[8]['translation']) ? stripslashes( $translation[8]['translation'] ) : 'Submit';

            // overwrite it with theme specific requirements
            $placeholder = ( ( $this->cmp_selectedTheme() == 'stylo' && !isset( $_GET['theme'] ) ) || ( isset( $_GET['theme'] ) && $_GET['theme'] == 'stylo' ) ) ? '&#xf003;  '.$placeholder : $placeholder;
            $submit = ( ( $this->cmp_selectedTheme() == 'postery' && !isset( $_GET['theme'] ) ) || ( isset( $_GET['theme'] ) && $_GET['theme'] == 'postery' ) ) ? '&#xf1d9;' : $submit;

            ?>
            
            <form id="subscribe-form" method="post" class="cmp-subscribe">
                <?php wp_nonce_field('save_options','save_options_field'); ?>

                <?php if ( ( $this->cmp_selectedTheme() == 'stylo' && !isset( $_GET['theme'] ) ) || ( isset($_GET['theme']) && $_GET['theme'] == 'stylo' ) ) : ?>

                    <input type="text" id="firstname-subscribe" name="cmp_firstname" placeholder="&#xf2c0;  <?php echo esc_attr( $placeholder_firstname );?>"> 

                    <input type="text" id="lastname-subscribe" name="cmp_lastname" placeholder="&#xf2c0;  <?php echo esc_attr( $placeholder_lastname );?>"> 

                <?php endif;?>

                <?php if ( $niteoCS_subscribe_label != '' ) : ?>
                    <label for="email"><?php echo esc_html( $niteoCS_subscribe_label );?></label>
                <?php endif;?>

                <input type="email" id="email-subscribe" name="email" placeholder="<?php echo esc_attr( $placeholder );?>" required> 
                
                <input type="submit" id="submit-subscribe" value="<?php echo esc_attr( $submit );?>">

                <div style="display: none;">
                    <input type="text" name="form_honeypot" value="" tabindex="-1" autocomplete="off">
                </div>

                <div id="subscribe-response"><?php echo isset( $response ) ? $response : '';?></div>

                <div id="subscribe-overlay"></div>

            </form>

            <script>

                var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";

                function AJAXform( formID, buttonID, resultID, emailID, firstnameID, lastnameID, formMethod = 'POST' ){

                    var selectForm = document.getElementById(formID); // Select the form by ID.
                    var selectButton = document.getElementById(buttonID); // Select the button by ID.
                    var selectResult = document.getElementById(resultID); // Select result element by ID.
                    var emailInput =  document.getElementById(emailID); // Select email input by ID.
                    var firstnameInput =  document.getElementById(firstnameID); // Select firstname input by ID.
                    var lastnameInput =  document.getElementById(lastnameID); // Select lastname input by ID.

                    var firstname;
                    var lastname;

                    function XMLhttp(){
                        
                        var httpRequest = new XMLHttpRequest();

                        httpRequest.onreadystatechange = function(){
                            if ( this.readyState == 4 && this.status == 200 ) {
                                result = JSON.parse( this.responseText );
                                selectResult.innerHTML = result.message; // Display the result inside result element.
                                emailInput.value = '';
                                selectForm.classList.add('-subscribed');

                                if ( result.status == 1 ) {
                                    selectForm.classList.remove('-subscribe-failed');
                                    selectForm.classList.add('-subscribe-successful');
                                } else {
                                    selectForm.classList.add('-subscribe-failed');
                                }
                            }

                        };

                        firstname = ( firstnameInput == null ) ? '' : firstnameInput.value;
                        lastname = ( lastnameInput == null ) ? '' : lastnameInput.value;
                 
                        httpRequest.open(formMethod, ajaxurl, true);
                        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        httpRequest.send('action=niteo_subscribe&check=true&form_honeypot=&email=' + emailInput.value + '&firstname=' + firstname + '&lastname=' + lastname);
                    }

                    selectButton.onclick = function(){ // If clicked on the button.
                        if ( emailInput.value != '' ) {
                            XMLhttp();
                        }
                        
                    }

                    selectForm.onsubmit = function(){ // Prevent page refresh
                        return false;
                    }
                }

                /* Usage */
                window.addEventListener("load",function(event) {
                        AJAXform( 'subscribe-form', 'submit-subscribe', 'subscribe-response', 'email-subscribe', 'firstname-subscribe', 'lastname-subscribe', 'POST' );
                });

            </script>
            <?php 
        }

        return $html;

    }

    public function cmp_head_scripts() {
        switch ( get_option('niteoCS_analytics_status', 'disabled') ) {
            //disabled analytics
            case 'disabled':
                break;
            // google analytics
            case 'google':

                if ( get_option('niteoCS_analytics', '') !== '' ) { ?>
                    <!-- Google analytics code -->
                    <script>
                      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                      ga('create', '<?php echo esc_attr(get_option('niteoCS_analytics'));?>', 'auto');
                      ga('send', 'pageview');

                    </script>
                    <?php 
                } 

                break;
            // other js code
            case 'other':
                if ( get_option('niteoCS_analytics_other', '') !== '' ) {
                    $niteoCS_analytics_other = get_option('niteoCS_analytics_other', ''); ?>
                    <script>
                      <?php echo stripslashes( esc_js( $niteoCS_analytics_other ) );?>

                    </script>
                    <?php 
                } 

                break;
            default:
                break;
        }

        return;
    }

    /**
     * returns body content.
     *
     * @since 2.4
     * @return HTML 
     **/
    public function cmp_get_body() {
        if ( isset($_GET['theme']) && !empty($_GET['theme']) ) {
            $theme_preview  = esc_attr($_GET['theme']);
 
            switch ( $theme_preview ) {
                case 'hardwork':
                case 'hardwork_premium':
                    return '<p>Everti labores cu sea, ea eam choro semper, usu an quot vocibus euripidis. An vis porro insolens, ea graeci vulputate qui. Qui vidisse evertitur et, ea vis habemus fabellas. Everti labores cu sea, ea eam choro semper, usu an quot vocibus euripidis. An vis porro insolens, ea graeci vulputate qui. Qui vidisse evertitur et, ea vis habemus fabellas.</p>';
                    break;

                case 'countdown':
                    return '<h2>We are currently improving our site</h2>';
                    break;

                case 'frame':
                    return '<p>Stay tuned for new features!</p>';
                    break;

                case 'orbit':
                    return '<p>Orbit is a modern and fun theme for your short maintenance mode. You can set custom background, social icons, footer message and of course the main content. We recommend to keep it simple by setting up only a gradient background.</p>';
                    break;

                case 'fifty':
                case 'element':
                    return '<p>Everti labores cu sea, ea eam choro semper, usu an quot vocibus euripidis. An vis porro insolens, ea graeci vulputate qui. Qui vidisse evertitur et, ea vis habemus fabellas.</p>';
                    break;

                case 'stylo':
                    return '<p>You can use <a href="https://niteothemes.com/projects/cmp-stylo-theme/">Stylo</a> as a landing page, maintenance or coming soon page. It supports both subscriber and contact form, all CMP background options and big beautiful counter.</p>';
                    break;

                default:
                    return wpautop( stripslashes( get_option('niteoCS_body', '') ) );
                    break;
            }

        } else {

            $body = wpautop( do_shortcode( stripslashes( get_option('niteoCS_body', '') ) ) );

            return $body;
        }
    }

    /**
     * render body title.
     *
     * @since 2.4
     * @return HTML 
     **/
    public function cmp_get_title( $class = '' ) {
        global $allowedposttags;
        
        if ( isset($_GET['theme']) && !empty($_GET['theme']) ) {
            $theme_preview  = esc_attr($_GET['theme']);

            switch ( $theme_preview ) {
                case 'hardwork':
                case 'hardwork_premium':
                case 'fifty':
                    return '<h2>We will be back soon!</h2>';
                    break;

                case 'eclipse':
                    return '<h2>Free theme for our <a href="https://wordpress.org/plugins/cmp-coming-soon-maintenance/" target="_blank">Coming Soon WordPress plugin.</a></h2>';
                    break;

                case 'orbit':
                    return '<h2>WE ARE IN ORBIT ! STAY TUNED ...</h2>';
                    break;

                case 'stylo':
                    return '<h2 class="animated '. $class .'">Something Awesome is Coming!</h2>';
                    break;

                case 'element':
                    return '<h2>Coming Soon</h2>';
                    break;
                
                default:
                    return '<h2 class="animated '. $class .'">' . wp_kses( stripslashes( get_option('niteoCS_body_title', 'SOMETHING IS HAPPENING!') ), $allowedposttags ) . '</h2>';
                    break;
            }

        } else {
            return '<h2 class="animated '. $class .'">' . wp_kses( stripslashes( get_option('niteoCS_body_title', 'SOMETHING IS HAPPENING!') ), $allowedposttags ) . '</h2>';
        }
    }

    /**
     * render Google fonts link.
     *
     * @since 2.4
     * @param  array[font_family],[font_variant]
     * @return HTML 
     **/
    public function cmp_get_fonts( $heading_font = array(), $content_font = array() ) {

        return '<link href="https://fonts.googleapis.com/css?family='. esc_attr( str_replace(' ', '+', $heading_font['family']) ) .':'. esc_attr(str_replace('italic', 'i', $heading_font['variant'] )) .'|'. esc_attr( str_replace(' ', '+', $content_font['family']) ) .':'. esc_attr(str_replace('italic', '', $content_font['variant'] )) .','. esc_attr(str_replace('italic', '', $content_font['variant'] )) .'i" rel="stylesheet">';
    }

    /**
     * render theme head SEO.
     *
     * @since 2.4
     * @return HTML 
     **/
    public function cmp_get_seo() {
        ob_start();
        ?>
        <!-- SEO -->
        <meta name="description" content="<?php echo esc_html( stripslashes(get_option('niteoCS_descr', 'Just another Coming Soon Page')) ); ?>">
        <title><?php echo esc_html( stripslashes(get_option('niteoCS_title', get_bloginfo('name').' Coming soon!')) ); ?></title>
        <?php 
        // display favicon
        $favicon_id = get_option('niteoCS_favicon_id');

        if ( $favicon_id && $favicon_id != '' ) {
            $favicon_url = wp_get_attachment_image_src( $favicon_id, 'thumbnail' );
            if ( isset($favicon_url[0]) ){ ?>
                <link id="favicon" rel="shortcut icon" href="<?php echo $favicon_url[0];?>" type="image/x-icon"/>
                <?php 
            } 
        } else {
           wp_site_icon();
        }

        if ( get_option( 'blog_public' ) == 0 ) { ?>
            <meta name='robots' content='noindex,nofollow' />
            <?php 
        } 

        $html = ob_get_clean();

        return $html;
    }

    /**
     * render custom CSS.
     *
     * @since 2.4
     * @return HTML 
     **/
    public function cmp_get_custom_css() {

        $css = '';

        $themeslug = $this->cmp_selectedTheme();

        if ( isset($_GET['theme']) && !empty($_GET['theme']) ) {
            $themeslug  = esc_attr($_GET['theme']);
        }

        // add CMP CSS to all themes
        ob_start();

        // add blur effect if enabled
        if (  get_option('niteoCS_effect['. $themeslug .']', 'disabled') == 'blur' ) {
            $blur = get_option('niteoCS_effect_blur['. $themeslug .']', '0.5'); ?>

            <!-- blur effect -->
            <style>
                #background-image,.slide-background,.video-banner {filter:blur(<?php echo esc_attr($blur);?>px);transform:scale(1.1);}
                #background-wrapper, .slick-slider {overflow:hidden;}
                #background-image:not(.slide) {background-attachment: initial;}
            </style>

            <?php 
        } ?>
        
        <!-- wp video shortcode  -->
        <style>
            .wp-video {margin: 0 auto;}
            .wp-video-shortcode {max-width: 100%;}
        </style>
        
        <?php 
        $effect = get_option('niteoCS_special_effect['.$themeslug.']', 'disabled');

        if ( $effect == 'constellation' ) { ?>
            <!-- constellation effect -->
            <style>
                .particles-js-canvas-el {position: absolute; top:0; left:0;}
                <?php 
                switch ( $themeslug ) {
                    case 'frame': ?>
                         .particles-js-canvas-el {z-index: -1;}
                         #background-image, .video-banner {z-index: -3;}
                         .background-overlay {z-index: -2;}
                         <?php 
                        break;

                    case 'stylo' ?>
                        .particles-js-canvas-el {z-index: 1;}
                        <?php
                    default:
                        break;
                } ?>
            </style>
            <?php
        }

        $css = ob_get_clean();

        $custom_css = ( get_option('niteoCS_custom_css', '') != '' ) ? '<style>'.stripslashes( wp_filter_nohtml_kses( get_option('niteoCS_custom_css') ) ).'</style>' : '';

        $css .= $custom_css ;

        return $css;
    }

    /**
     * render copyright.
     *
     * @since 2.4
     * @return HTML 
     **/
    public function cmp_get_copyright() {
        if ( get_option('niteoCS_copyright', 'Copyright 2017 by NiteoThemes. All rights reserved.' ) !== '' ) { 
            $copyright = stripslashes(get_option('niteoCS_copyright', 'Copyright 2017 by NiteoThemes. All rights reserved.'));
            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            );

            return '<p class="copyright">'.wp_kses( $copyright, $allowed_html ).'</p>';
            
        }

        return false;
    }


    // Render Javascripts
    public function cmp_javascripts( $background, $themeslug ) {
        if ( isset($_GET['background']) && is_numeric($_GET['background']) ) {
            $background = esc_attr($_GET['background']);
        } ?>
        
        <!-- load background image script -->
        <script>
            window.addEventListener("load",function(event) {
                init();
            });

            function init(){
                var image = document.getElementById('background-image');
                var body = document.getElementById('body');
                if ( image === null ) {
                    image = document.getElementById('body');
                } 

                if ( image != null ) {
                    image.className += " loaded";
                    body.className += " loaded";

                }

                // theme specific function after init
                <?php
                switch ( $themeslug ) {
                    case 'fifty': ?>
                        var contentWrapper = document.getElementsByClassName('content-wrapper')[0];
                        setTimeout(function(){ contentWrapper.className += " overflow"; }, 1500);
                        
                        <?php 
                    break;

                    case 'hardwork_premium': ?>
                        var contentWrapper = document.getElementsByClassName('section-body')[0];
                        setTimeout(function(){ contentWrapper.className += " overflow"; }, 1500);
                        <?php 
                    break;

                    case 'construct' : 
                        if ( $background != 5 && $background != 4 ) { ?>
                            // run paraxify
                            myParaxify = paraxify('.image', {
                                speed: 1,
                                boost: 0.5
                            });
                            <?php 
                        } 
                    break;
                    
                    default:
                        break;
                } ?>

            }
        </script>

        <?php 
        // if video background ini vidim background player
        switch ( $background ) {
            // video
            case '5': ?>
                <script type='text/javascript' src='<?php echo plugins_url('cmp-coming-soon-maintenance/js/vidim.min.js');?>'></script>
                <script>
                    <?php 
                    $video_poster   = wp_get_attachment_image_src( get_option('niteoCS_video_thumb['.$themeslug.']'), 'large' );

                    if ( !empty( $video_poster ) ) {
                        $video_poster = $video_poster[0];       
                    }
                    // video
                    $source = get_option('niteoCS_banner_video['.$themeslug.']');

                    switch ( $source ) {
                        case 'YouTube':
                            $banner_url = get_option('niteoCS_youtube_url['.$themeslug.']'); ?>
                        
                            var myBackground = new vidim( '#player', {
                                src: '<?php echo esc_url( $banner_url ); ?>',
                                type: 'YouTube',
                                poster: '<?php echo esc_url( $video_poster ); ?>',
                                quality: 'hd1080'
                                }
                            );

                        <?php 
                            break;

                        case 'vimeo':
                            $banner_url = get_option('niteoCS_vimeo_url['.$themeslug.']'); ?>
                            var myBackground = new vidim( '#player', {
                                src: '<?php echo esc_url( $banner_url ); ?>',
                                type: 'vimeo',
                                poster: '<?php echo esc_url( $video_poster ); ?>',
                                }
                            );
                            <?php
                            break;

                        case 'video/mp4':
                            $banner_url = get_option('niteoCS_video_file_url['.$themeslug.']');
                            $banner_url = wp_get_attachment_url( $banner_url ); ?>
                            var myBackground = new vidim( '#player', {
                                src: [
                                    {
                                      type: 'video/mp4',
                                      src: '<?php echo esc_url( $banner_url ); ?>',
                                    },
                                ],
                                poster: '<?php echo esc_url( $video_poster ); ?>',
                            });
                            <?php 
                            break;
                        default:
                            break;
                    } ?>
                </script>
                <?php 
                break;
            // custom images or unplash
            case '0': 
            case '1': 

                if ( get_option('niteoCS_slider['.$themeslug.']', '0') == 1 ) {
                    $slider_effect      = get_option('niteoCS_slider_effect['.$themeslug.']', 'true');
                    $slider_autoplay    = get_option('niteoCS_slider_auto['.$themeslug.']', '1');
                    // render slice effect scripts
                    if ( $slider_effect == 'slice' ) {  ?>

                        <script type='text/javascript' src='<?php echo plugins_url('js/external/imagesloaded.pkgd.min.js', __DIR__);?>'></script>
                        <script type='text/javascript' src='<?php echo plugins_url('js/external/anime.min.js', __DIR__);?>'></script>
                        <script type='text/javascript' src='<?php echo plugins_url('js/external/uncover.js', __DIR__);?>'></script>
                        <script type='text/javascript' src='<?php echo $this->cmp_themeURL($themeslug).$themeslug.'/js/slice.js';?>'></script>
                        <?php 

                    // render slick carousel DOM and scripts
                    } else { ?>
                        <!-- slick carousel script -->
                        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" Crossorigin="anonymous"></script>
                        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js'></script>
                        <script>
                            $('#slider').slick({
                                slide: '.slide',
                                slidesToShow: 1,
                                arrows: false,
                                fade: <?php echo esc_attr($slider_effect);?>,
                                speed: 1000,
                                autoplay: <?php echo esc_attr($slider_autoplay);?>,
                                autoplaySpeed: 10000,
                            });

                            $('.prev').click(function() {
                                $('#slider').slick('slickPrev');
                            });

                            $('.next').click(function() {
                                $('#slider').slick('slickNext');
                            });
                        </script>
                        <?php
                    }
                }
                break;
            
            default:
                break;
        } 

        // render redirect script if CMP is in redirect mode
        if ( $this->cmp_status() == 3 ) {
            $url = get_option('niteoCS_URL_redirect');
            $time = get_option('niteoCS_redirect_time'); ?>
            <script>
                setTimeout(function() {
                  window.location.href = "<?php echo esc_url($url);?>";
                }, <?php echo esc_attr($time * 1000);?>);
            </script>
            <?php
        }


        // include jquery and CF7 scripts for stylo theme contact form 7
        if ( $themeslug == 'stylo' && get_option('niteoCS_contact_form_type', 'cf7') == 'cf7' ) {

            $site_url = str_replace( '/', '\/', site_url() );

            // load jquery if not already loaded by slider 
            if ( get_option('niteoCS_slider['.$themeslug.']', '1') == 1 && (get_option('niteoCS_banner['.$themeslug.']', '1') == 1 || get_option('niteoCS_banner['.$themeslug.']', '1') == 0 ) ) {              

            } else {
                ?>
                <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" Crossorigin="anonymous"></script>
                <?php 
            } ?>
            
            <!-- CF7 script -->
            <script type='text/javascript'>
                /* <![CDATA[ */
                var wpcf7 = {"apiSettings":{"root":"<?php echo $site_url;?>\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};
                /* ]]> */
            </script>
            
            <script type='text/javascript' src='<?php echo plugins_url('contact-form-7/includes/js/scripts.js?ver=5.0.1');?>'></script>

            <?php 
        }


        // special effects
        $effect = get_option('niteoCS_special_effect['.$themeslug.']', 'disabled');

        switch ( $effect ) {
            case 'constellation': ?>
                <!-- load external Particles script -->
                <script type='text/javascript' src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
                <!-- INI particles -->
                <script>
                    /* ---- particles.js config ---- */
                    var wrapper = document.getElementById('background-wrapper');
                    var background = ( wrapper === null ) ? 'slider-wrapper' : 'background-wrapper';
                    particlesJS(background, {
                      "particles": {
                        "number": {
                          "value": 100,
                          "density": {
                            "enable": true,
                            "value_area":1000
                          }
                        },
                        "color": {
                          "value": "<?php echo esc_attr( get_option('niteoCS_special_effect['.$themeslug.'][constellation][color]', '#ffffff') );?>",
                        },
                        
                        "shape": {
                          "type": "circle",
                          "stroke": {
                            "width": 0,
                            "color": "#fff"
                          },
                          "polygon": {
                            "nb_sides": 5
                          },
                        },
                        "opacity": {
                          "value": 0.6,
                          "random": false,
                          "anim": {
                            "enable": false,
                            "speed": 1,
                            "opacity_min": 0.1,
                            "sync": false
                          }
                        },
                        "size": {
                          "value": 2,
                          "random": true,
                          "anim": {
                            "enable": false,
                            "speed": 40,
                            "size_min": 0.1,
                            "sync": false
                          }
                        },
                        "line_linked": {
                          "enable": true,
                          "distance": 120,
                          "color": "<?php echo esc_attr( get_option('niteoCS_special_effect['.$themeslug.'][constellation][color]', '#ffffff') );?>",
                          "opacity": 0.4,
                          "width": 1
                        },
                      },
                      "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                          "onhover": {
                            "enable": true,
                            "mode": "grab"
                          },
                          "onclick": {
                            "enable": false
                          },
                          "resize": true
                        },
                        "modes": {
                          "grab": {
                            "distance": 140,
                            "line_linked": {
                              "opacity": 1
                            }
                          },
                          "bubble": {
                            "distance": 400,
                            "size": 40,
                            "duration": 2,
                            "opacity": 8,
                            "speed": 3
                          },
                          "repulse": {
                            "distance": 200,
                            "duration": 0.4
                          },
                          "push": {
                            "particles_nb": 4
                          },
                          "remove": {
                            "particles_nb": 2
                          }
                        }
                      },
                      "retina_detect": true
                    });
                </script>
                <?php 
                break;
            
            default:
                break;
        }

        return false;
    }


    /**
     * render Contact Form.
     *
     * @since 2.5
     * @return HTML 
     **/
    public function cmp_contact_form() {
        $form_type = get_option('niteoCS_contact_form_type', 'cf7');

        if ( $form_type == 'disabled' ) {
            return false;
        }

        $form_id = get_option('niteoCS_contact_form_id', '');

        switch ($form_type) {
            case 'cf7':

                $replace  = array('<p>', '</p>' );
                $html =  str_replace( $replace, '', do_shortcode('[contact-form-7 id='.$form_id.']') ) ; 
                break;
            
            default:
                $html = '';
                break;
        }

        return $html;
    }

}