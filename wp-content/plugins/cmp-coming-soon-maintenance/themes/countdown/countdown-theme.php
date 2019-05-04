<!DOCTYPE html>

<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php 
        $themeslug = 'countdown';

        //include theme defaults
        if ( file_exists(dirname(__FILE__).'/'.$themeslug.'-defaults.php') ) {
            require ( dirname(__FILE__).'/'.$themeslug.'-defaults.php' );
        } 

        // render SEO
        if ( method_exists ( $html, 'cmp_get_seo' ) ) {
            echo $html->cmp_get_seo();
        }

        // render google fonts link
        if ( method_exists ( $html, 'cmp_get_fonts' ) ) {
            echo $html->cmp_get_fonts( $heading_font, $content_font );
        }

        $themeslug = 'countdown';
        
        // get theme related settings

        $font_color_light           = $this->hex2hsl($font_color, '20');
        $background_overlay         = $this->hex2rgba($overlay_color, $overlay_opacity);

        // get global settings
        $niteoCS_counter            = get_option('niteoCS_counter', '1');
        $niteoCS_counter_date       = get_option('niteoCS_counter_date', time()+86400);
        $countdown_action           = get_option('niteoCS_countdown_action', 'no-action');

        ?>
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . $themeslug.'/style.css?v='.$this->version;?>" type="text/css" media="all">
       
        <style>
            body,input, select, textarea, button {font-family:'<?php echo esc_attr( $content_font['family'] );?>', 'sans-serif';color:<?php echo esc_attr( $font_color ); ?>;}
            input {font-family: <?php echo esc_attr( $content_font['family'] );?>, 'fontAwesome';}
            
            body {font-size:<?php echo esc_attr( $content_font['size'] );?>px;}
            h1,h2,h3,h4,h5,h6 {font-family:'<?php echo esc_attr( $heading_font['family'] );?>', 'sans-serif';}
            a {color:<?php echo esc_attr( $font_color ); ?>;}
            input[type="submit"] {background-color: <?php echo esc_attr( $active_color );?>;}
            ::-webkit-input-placeholder {color: <?php echo esc_attr( $font_color_light );?>;}
            ::-moz-placeholder {color: <?php echo esc_attr( $font_color_light );?>;}
            :-ms-input-placeholder {color: <?php echo esc_attr( $font_color_light );?>;}
            ::-moz-placeholder {color: <?php echo esc_attr( $font_color_light );?>;}
            .input-icon:before,input[type="email"],input[type="text"]{color: <?php echo esc_attr( $font_color_light );?>;}
            /* input[type="email"],input[type="text"] {border:1px solid <?php echo esc_attr( $font_color_light );?>;} */
            .background-overlay{background-color:<?php echo esc_attr( $background_overlay );?>;}
            footer, footer a {color: <?php echo esc_attr( $font_color_light );?>;}
            .social-list.body a {background-color: <?php echo esc_attr( $font_color ); ?>;}
            .social-list.body a:hover {background-color: <?php echo esc_attr( $active_color ); ?>;}
            .social-list.footer a:hover {color: <?php echo esc_attr( $active_color ); ?>;}
            .social-list.footer li:not(:last-of-type)::after {background-color: <?php echo esc_attr( $font_color_light ); ?>;}
            
            .inner-content p {line-height: <?php echo esc_attr( $content_font['line-height'] );?>; letter-spacing: <?php echo esc_attr( $content_font['spacing'] );?>px;font-weight:<?php echo esc_attr($content_font_style['0']);?>;<?php echo isset( $content_font_style['1']) ? 'font-style: italic;' : '';?>; }
            h1:not(.text-logo),h2, h3,h4,h5,h6,.text-logo-wrapper {font-size:<?php echo esc_attr( $heading_font['size'] / $content_font['size'] );?>em;letter-spacing: <?php echo esc_attr( $heading_font['spacing']  );?>px;  font-weight:<?php echo esc_attr( $heading_font_style['0']);?>;<?php echo isset($heading_font_style['1'] ) ? 'font-style: italic;' : '';?>; }
            h1 { font-weight:<?php echo esc_attr( $heading_font_style['0'] );?>;<?php echo isset( $heading_font_style['1'] ) ? 'font-style: italic;' : '';?>;}
        </style>

        <?php 
        // render custom CSS 
        if ( method_exists ( $html, 'cmp_get_custom_css' ) ) {
            echo $html->cmp_get_custom_css();
        } 

        // render header javascripts
        if ( method_exists ( $html, 'cmp_head_scripts' ) ) {
            $html->cmp_head_scripts();
        } 
        
        // echo pattern copyright
        if ( $banner_type == 3 ) {
             echo '<!-- Background pattern from Subtle Patterns --!>';
        } 

        ?>

    </head>

    <body id="body">

        <div id="background-wrapper">
            <?php
            $overlay = ( $overlay_opacity == '0' ) ? false : true;

            if ( method_exists ( $html, 'cmp_background' ) ) {
                echo $html->cmp_background( $banner_type, $themeslug, $overlay );

            } ?>
        </div>

        <div class="inner-wrap">
            <div class="inner-content">
                <?php 
                // display logo
                if ( method_exists ( $html, 'cmp_logo' ) ) {
                    echo $html->cmp_logo( $themeslug );
                } 
                
                // display body title
                if ( method_exists ( $html, 'cmp_get_title' ) ) {
                    echo $html->cmp_get_title( );
                } 

                // display counter
                if ( $niteoCS_counter == '1') {
                    if ( get_option('niteoCS_translation') ) {
                        $translation    = json_decode( get_option('niteoCS_translation'), true );
                        $seconds        = $translation[0]['translation'];
                        $minutes        = $translation[1]['translation'];
                        $hours          = $translation[2]['translation'];
                        $days           = $translation[3]['translation'];
                    } else {
                        $seconds        = 'seconds';
                        $minutes        = 'minutes';
                        $hours          = 'hours';
                        $days           = 'days';
                    } ?>
                    <div id="counter" data-date="<?php echo esc_attr($niteoCS_counter_date);?>">
                        <div class="counter-wrap">
                            <div class="inner-counter">
                                <span id="counter-day">00</span>
                                <p><?php echo esc_html($days);?></p>
                            </div>
                        </div>

                        <div class="counter-wrap">
                            <div class="inner-counter">
                            <span id="counter-hour">00</span>
                            <p><?php echo esc_html($hours);?></p>
                            </div>
                        </div>

                        <div class="counter-wrap">
                            <div class="inner-counter">
                            <span id="counter-minute">00</span>
                            <p><?php echo esc_html($minutes);?></p>
                            </div>
                        </div>

                        <div class="counter-wrap">
                            <div class="inner-counter">
                            <span id="counter-second">00</span>
                            <p><?php echo esc_html($seconds);?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                // display body content
                if ( get_option('niteoCS_body') != '' ) { ?>
                    <div class="content">             
                        <?php
                        // display body title
                        if ( method_exists ( $html, 'cmp_get_body' ) ) {
                            echo $html->cmp_get_body();
                        } 
                        ?>   
                    </div>
                    <?php 
                }       

                // display social if in body
                if ( $social_location == 'body') {  ?>

                    <div class="social-wrapper <?php echo esc_attr($social_location );?>">
                        <?php 
                        // display social icons
                        if ( method_exists ( $html, 'cmp_social_icons' ) ) {
                            echo $html->cmp_social_icons( $mode = 'icon', $title = false );
                        } ?>
                    </div>
                    <?php 
                }

                // display subscribe form
                if ( method_exists ( $html, 'cmp_subscribe_form' ) ) {
                    echo $html->cmp_subscribe_form( );
                } ?>

             </div>

            <?php 
            if ( $social_location == 'footer' || get_option('niteoCS_copyright') !== '') {

                echo '<footer>';
                
                    if ( $social_location == 'footer') {  ?>

                        <div class="social-wrapper">
                            <?php 
                            // display social icons
                            if ( method_exists ( $html, 'cmp_social_icons' ) ) {
                                echo $html->cmp_social_icons( $mode = 'icon', $title = false );
                            } ?>
                        </div>
                        <?php 
                    }

                    if ( method_exists ( $html, 'cmp_get_copyright' ) ) {
                        echo $html->cmp_get_copyright();
                    } 


                echo '</footer>';
            } ?>
        </div>

        <?php 
        // render footer javascripts
        if ( method_exists ( $html, 'cmp_javascripts' ) ) {
            $html->cmp_javascripts( $banner_type, $themeslug );
        } 

        if ( $niteoCS_counter == '1') { ?>
            <script>
            // Set the date we're counting down to
            var counter = document.getElementById('counter');
            var unixtime = counter.getAttribute('data-date');
            var date = new Date(unixtime*1000);
            var countDownDate = new Date(date).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();
                
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (days < 10) {
                    days = '0' + days;
                }
                if (hours < 10) {
                    hours = '0' + hours;
                }
                if (minutes < 10) {
                    minutes = '0' + minutes;
                }
                if (seconds < 10) {
                    seconds = '0' + seconds;
                }
                if (distance >= 0) {
                    document.getElementById('counter-day').innerHTML = days;
                    document.getElementById('counter-hour').innerHTML = hours;
                    document.getElementById('counter-minute').innerHTML = minutes;
                    document.getElementById('counter-second').innerHTML = seconds;   
                }

                <?php 
                if ( $countdown_action != 'no-action' && $countdown_action != 'display-text') { ?>

                    // If the count down is over, write some text 
                    if (distance < 0) {
                        clearInterval(x);
                        window.location.reload();
                    }
                    <?php
                } ?>

            }, 1000);
            </script>
            <?php 
        } ?>
    </body>
</html>
