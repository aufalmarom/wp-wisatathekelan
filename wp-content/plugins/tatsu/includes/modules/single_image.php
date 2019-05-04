<?php
/**************************************
	        SINGLE IMAGE
**************************************/
if (!function_exists('tatsu_image')) {
	function tatsu_image( $atts, $content ) {
        extract( shortcode_atts( array (
            'enable_margin'     => 0,
            'margin'            => '0 0 0 0',
            'alignment'         => '',
            'border_width'      => 0,
            'border_color'      => 'transparent',
            'image'             => '',
            'id'                => '',
            'size'              => '',
            'adaptive_image'    => 0,
            'rebel'             => 0,
            'lazy_load'         => '',
            'placeholder_bg'    => '',
            'shadow'            => 'none',
            'width'             => '100%',
            'lightbox'          => 0,
            'link'              => '',
            'new_tab'           => 0,
            'animate'           => 0,
			'animation_type'    =>'fadeIn',
			'animation_delay'   => 0,
        ), $atts ) );

        $id = ( isset( $id ) ) ? $id : '';
        $border_width = ( isset( $border_width ) && !empty( $border_width ) ) ? $border_width : '0';
        $border_color = ( isset( $border_color ) && !empty( $border_color ) ) ? $border_color : 'transparent';
        $alignment = ( isset( $alignment ) && !empty( $alignment ) ) ? $alignment : 'none';
        $size = ( isset( $size ) && !empty( $size ) ) ? $size : 'full';
        $rebel = ( isset( $rebel ) && !empty( $rebel ) && 'full' == $size ) ? 1 : 0;
        $width = ( isset( $width ) && !empty( $width ) && 1 == $rebel ) ? (int)$width : 0;
        if( !empty( $border_width ) ) {
            $image_style = ' style = "border:'. $border_width . 'px solid ' . $border_color . ';"'; 
        }else{
            $image_style = '';
        }
        if( !empty( $margin ) && !empty( $enable_margin ) ){
            $margin_style = 'margin : '. $margin . ';';
        }else{
            $margin_style = '';
        }
        if( isset( $animate ) && 1 == $animate ) {
            $animate_class = ' tatsu-animate';
            $data_animations = ' data-animation="'.$animation_type.'" data-animation-delay="'.$animation_delay.'"';
        } else {
            $animate_class = '';
            $data_animations = '';
        }
        $lazy_load = ( isset($lazy_load)  && !empty($lazy_load) ) ? $lazy_load : 0 ;
        if( 1 == $lazy_load ) {
            $lazy_load_class = ' tatsu-image-lazyload';
        }else{
            $lazy_load_class = '';
        }        
        if( 1 == $lazy_load && !empty( $placeholder_bg ) ){
            $placeholder_bg = 'background-color : '. $placeholder_bg .';';
        }else{
            $placeholder_bg = '';
        }   

        if( 'none' != $alignment ) {
            $alignment_class = ' align-' . $alignment;
        }else{
            $alignment_class = '';
        } 

        $id = (int)$id;
        $img_srcset = '';
        $image_src = '';
        $is_external_image = true;
        $image_width = 0;
        $image_height = 0;
        $padding = '';
        $overflow_image_class = '';
        $external_image_class = '';
        $maxWidth = '';
        $alt_text = '';        
        //$image = wp_get_attachment_image_src( $id, $size );
		$upload_dir_paths = wp_upload_dir();
		if ( false !== strpos( $image, $upload_dir_paths['baseurl'] ) ) {
            $image_details = wp_get_attachment_image_src( $id, $size );
            if( $image_details ) {
                if( 0 === $image_details[2] ) {
                    $image_src = $image_details[0];
                    $lazy_load_class = '';
                    $lazy_load = 0;
                    $maxWidth = 'width : 100%;';
                }else {
                    $image_src = $image_details[0];
                    $image_width = $image_details[1];
                    $image_height = $image_details[2];
                    $alt_text = get_post_meta( $id, '_wp_attachment_image_alt', true);
                    $padding = 'padding-bottom : '.( ( $image_height / $image_width ) * 100 ).'%;';
                    if( isset( $adaptive_image ) && $adaptive_image == 1 ) {
                        $img_srcset = wp_get_attachment_image_srcset( $id, $size );
                        $sizes = wp_calculate_image_sizes( $size, null, null, $id );
                        if( isset( $img_srcset ) && !empty( $img_srcset ) ) {
                            // if( 1 == $lazy_load ){
                            //     $img_srcset = ' data-srcset = "'.$img_srcset.'" sizes = "'. $sizes .'"';
                            // } else {
                                $img_srcset = ' srcset = "'.$img_srcset.'" sizes = "'. $sizes .'"';
                            //}
                        }
                    }
                    $is_external_image = false;  
                }               
            }           
        } else {
            $image_src = $image;
        }

        if( $is_external_image ) {
            $external_image_class = ' tatsu-external-image';
        }

        // if( !empty( $id ) ) {
        //     $image_id = tatsu_get_image_id_from_url( $image ); 
        //     if( $image_id ) {
        //         $image_details = wp_get_attachment_image_src( $image_id, $size );
        //         if( $image_details ) {
        //             $image_src = $image_details[0];
        //             $image_width = $image_details[1];
        //             $image_height = $image_details[2];
        //             $alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
        //             $padding = 'padding-bottom : '.( ( $image_height / $image_width ) * 100 ).'%;';
        //             if( isset( $adaptive_image ) && $adaptive_image == 1 ){
        //                 $img_srcset = wp_get_attachment_image_srcset( $image_id, $size );
        //                 $sizes = wp_calculate_image_sizes( $size, null, null, $image_id );
        //                 if( isset( $img_srcset ) && !empty( $img_srcset ) ) {
        //                     // if( 1 == $lazy_load ){
        //                     //     $img_srcset = ' data-srcset = "'.$img_srcset.'" sizes = "'. $sizes .'"';
        //                     // } else {
        //                         $img_srcset = ' srcset = "'.$img_srcset.'" sizes = "'. $sizes .'"';
        //                     //}
        //                 }
        //             }                
        //         }
        //         $is_external_image = false;
        //     }
        //     if( $is_external_image ) {
        //         $image_src = $image;
        //     }            
        // }


        if( 'none' != $shadow ) {
            if( 'light' == $shadow ) {
                $box_shadow_class = ' be-shadow-light';
            }else if( 'regular' == $shadow ) {
                $box_shadow_class = ' be-shadow-medium';
            }else{
                $box_shadow_class = ' be-shadow-dark';
            }
        }else{
            $box_shadow_class = '';
        }


        $lightbox = isset( $lightbox ) && !empty( $lightbox ) ? 1 : 0;
        $new_tab = isset( $new_tab ) && !empty( $new_tab ) ? 1 : 0;
        $new_tab_attribute = '';
        if( 1 == $lightbox ) {
            $link = ' href = "' . $image_src . '"';
            $new_tab_attribute = '';
        }else {
            if( isset( $link ) && !empty( $link ) ) {
                $link = ' href = "' . $link . '"';
                if( isset( $new_tab ) && !empty( $new_tab ) ) {
                    $new_tab_attribute = ' target = "_blank"';
                }
            }
        }

        if( 1 == $rebel ) {
            $maxWidth = 'width:'.$width.'%;';
            $overflow_image_class = ' tatsu-image-overflow ';
        } else{
            if( !$is_external_image ) {
                $maxWidth = 'width : '.$image_width. 'px;';
            } 
        }
        if( 100 < $width && 'right' == $alignment  ) {
            $transform = 'transform : translateX(-' . ( ( ( $width - 100 )/$width ) * 100 ) . '%);'; 
        }else{
            $transform = '';
        }     

        $output = '';
        if( !empty( $image_src ) ) {
            $output .= '<div class="tatsu-single-image tatsu-module'. $alignment_class . $box_shadow_class . $animate_class . $lazy_load_class . $overflow_image_class . $external_image_class . '" style = "'. $margin_style .'"'. $data_animations . '>'; 
            $output .= '<div class="tatsu-single-image-inner" style="'. $transform . $placeholder_bg . $maxWidth . '" >';
            $output .= '<div class = "tatsu-single-image-padding-wrap" style = "' . $padding . '" ></div>';
            if( '' != $link ) {
                $output .= '<a' . ( 1 == $lightbox ? ' class = "mfp-image"' : '' )  . $link . $new_tab_attribute . ' >';
            }
            if( empty( $lazy_load ) || 0 == $lazy_load ){
                $output .= '<img src = "'. $image_src .'"' . $img_srcset . $image_style . ' alt="'.$alt_text.'" />';
            } else if( 1 == $lazy_load ) {
                $output .= '<img data-src = "'. $image_src .'"' . $img_srcset . $image_style . ' alt="'.$alt_text.'" />';
            }
            if( '' != $link ) {
                $output .= '</a>';
            }
            $output .= '</div>';
            $output .= '</div>';
        }
        return $output;
	}
	add_shortcode( 'tatsu_image', 'tatsu_image' );
}
?>