<?php 

if ( ! function_exists( 'pt_theme_addon_clients_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function pt_theme_addon_clients_widget() {

        register_widget( 'PT_Theme_Addon_Clients_Widget' );

    }

endif;

add_action( 'widgets_init', 'pt_theme_addon_clients_widget' );

if ( ! class_exists( 'PT_Theme_Addon_Clients_Widget' ) ) :

    /**
     * Clients widget class.
     *
     * @since 1.0.0
     */
    class PT_Theme_Addon_Clients_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'pt_theme_addon_widget_clients',
                'description' => __( 'Clients Widget', 'pt-theme-addon' ),
            );

            parent::__construct( 'pt-theme-addon-clients', esc_html__( 'PT: Clients', 'pt-theme-addon' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $section_icon      = !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';
            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'full';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;

            echo $args['before_widget']; ?>

                <div class="pt-clients-main">

                    <?php
                    if ( !empty( $title ) || !empty( $sub_title ) ){ ?>

                        <div class="section-title">

                            <?php 

                            if ( $title ) {

                                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

                            }

                            if ( $section_icon ) { ?>

                                <div class="seperator">
                                    <span><i class="fa <?php echo esc_html( $section_icon ); ?>"></i></span>
                                </div>
                                <?php
                                
                            }

                            if ( $sub_title ) { ?>

                                <p><?php echo esc_html( $sub_title ); ?></p>

                                <?php 
                                
                            } ?>

                        </div>
                        <?php 
                    }

                    pt_theme_addon_clients_widget_call( $post_number, $featured_image ); ?>
                
                </div>

                <?php

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['section_icon']   = sanitize_text_field( $new_instance['section_icon'] );
            $instance['sub_title']      = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_number']    = absint( $new_instance['post_number'] );
            $instance['featured_image'] = sanitize_text_field( $new_instance['featured_image'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'          => '',
                'section_icon'   => 'fa fa-users',
                'sub_title'      => '',
                'featured_image' => 'full',
                'post_number'    => 12,
            ) ); 
            ?>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php _e( 'Title:', 'pt-theme-addon' ); ?></strong></label>
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'section_icon' ) ); ?>"><strong><?php esc_html_e( 'Icon:', 'pt-theme-addon' ); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'section_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'section_icon' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['section_icon'] ); ?>" />
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'pt-theme-addon' ); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
            </p>
            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php _e( 'Number of Posts:', 'pt-theme-addon' ); ?></strong></label>
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['post_number'] ); ?>" min="1" />
            </p>
            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'featured_image' ) ); ?>"><strong><?php _e( 'Select Image Size:', 'pt-theme-addon' ); ?></strong></label>
                <?php
                $this->dropdown_image_sizes( array(
                    'id'       => $this->get_field_id( 'featured_image' ),
                    'name'     => $this->get_field_name( 'featured_image' ),
                    'selected' => esc_attr( $instance['featured_image'] ),
                    )
                );
                ?>
            </p>
            <?php
        }

        function dropdown_image_sizes( $args ) {

            $defaults = array(
                'id'       => '',
                'class'    => 'widefat',
                'name'     => '',
                'selected' => 'full',
            );

            $r = wp_parse_args( $args, $defaults );
            
            $output = '';

            global $_wp_additional_image_sizes;

            $get_intermediate_image_sizes = get_intermediate_image_sizes();
            
            $choices = array();

            $choices['thumbnail'] = esc_html__( 'Thumbnail', 'pt-theme-addon' );
            $choices['medium']    = esc_html__( 'Medium', 'pt-theme-addon' );
            $choices['large']     = esc_html__( 'Large', 'pt-theme-addon' );
            $choices['full']      = esc_html__( 'Full (Original)', 'pt-theme-addon' );

            $show_dimension = true;

            if ( true === $show_dimension ) {
                foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
                    $choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
                }
            }

            if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
                foreach ( $_wp_additional_image_sizes as $key => $size ) {
                    $choices[ $key ] = $key;
                    if ( true === $show_dimension ) {
                        $choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
                    }
                }
            }

            if ( ! empty( $allowed ) ) {
                foreach ( $choices as $key => $value ) {
                    if ( ! in_array( $key, $allowed ) ) {
                        unset( $choices[ $key ] );
                    }
                }
            }

            if ( ! empty( $choices ) ) {

                $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
                foreach ( $choices as $key => $choices ) {
                    $output .= '<option value="' . esc_attr( $key ) . '" ';
                    $output .= selected( $r['selected'], $key, false );
                    $output .= '>' . esc_html( $choices ) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
        }
    }

endif;

function pt_theme_addon_clients_widget_call( $post_number, $featured_image ){

    $clients_args = array(
        'post_type'      => 'ptta-clients',
        'posts_per_page' => esc_attr( $post_number ),
        'no_found_rows'  => true,
        'meta_query'     => array(
                            array( 'key' => '_thumbnail_id' ),
                        ),
        );
  
    $clients_query = new WP_Query( $clients_args );

    if ( $clients_query->have_posts() ) : ?>

      <div class="pt-clients">

        <div class="inner-wrapper">

            <div class="pt-clients-wrap">

                <?php 
                while ( $clients_query->have_posts() ) :

                    $clients_query->the_post(); ?>

                    <div class="pt-clients-item">
                    
                        <div class="pt-clients-thumb">
                            <?php 

                            $post_id    = get_the_ID();

                            $link       = get_post_meta( absint( $post_id ), 'link', true );

                            if( !empty( $link ) ){ ?>

                                <a href="<?php echo esc_url( $link ); ?>" target="_blank">

                                    <?php 

                                    if ( has_post_thumbnail() ){ 

                                        the_post_thumbnail( esc_attr( $featured_image ) );

                                    } ?>
                                </a>
                                <?php
                            }else{

                                if ( has_post_thumbnail() ){ 

                                    the_post_thumbnail( esc_attr( $featured_image ) );

                                } 

                            } ?>
                        </div>
                        
                    </div>

                    <?php 
                endwhile; 

                wp_reset_postdata(); ?>

            </div>

        </div><!-- .inner-wrapper -->

      </div><!-- .pt-clients-widget -->

    <?php endif; 

}

function pt_theme_addon_show_clients( $atts ) {

    extract( shortcode_atts( 
        array( 
            'post_number'  => 40,
            'image_size'   => 'full',
        ), 
        $atts 
    ));

    ob_start();

    pt_theme_addon_clients_widget_call( $post_number, $image_size );

    return ob_get_clean();
}

add_shortcode( 'ptta-clients', 'pt_theme_addon_show_clients' );