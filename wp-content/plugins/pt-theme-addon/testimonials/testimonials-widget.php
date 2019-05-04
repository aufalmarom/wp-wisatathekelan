<?php 

if ( ! function_exists( 'pt_theme_addon_testimonials_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function pt_theme_addon_testimonials_widget() {

        register_widget( 'PT_Theme_Addon_Testimonials_Widget' );

    }

endif;

add_action( 'widgets_init', 'pt_theme_addon_testimonials_widget' );

if ( ! class_exists( 'PT_Theme_Addon_Testimonials_Widget' ) ) :

    /**
     * Our Team widget class.
     *
     * @since 1.0.0
     */
    class PT_Theme_Addon_Testimonials_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'pt_theme_addon_widget_testimonials',
                'description' => __( 'Testimonials Widget', 'pt-theme-addon' ),
            );

            parent::__construct( 'pt-theme-addon-testimonials', esc_html__( 'PT: Testimonials', 'pt-theme-addon' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $section_icon      = !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';
            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 5;

            echo $args['before_widget']; ?>

                <div class="pt-testimonials-main">

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

                    pt_theme_addon_testimonials_widget_call( $post_category, $post_number ); ?>
                
                </div>

                <?php
           
            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {
            
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );
            $instance['section_icon']       = sanitize_text_field( $new_instance['section_icon'] );
            $instance['sub_title']          = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_category']      = absint( $new_instance['post_category'] );
            $instance['post_number']        = absint( $new_instance['post_number'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'                 => '',
                'section_icon'          => 'fa fa-comment-o',
                'sub_title'             => '',
                'post_category'         => '',
                'post_number'           => 4,
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
              <label for="<?php echo  esc_attr( $this->get_field_id( 'post_category' ) ); ?>"><strong><?php _e( 'Select Category:', 'pt-theme-addon' ); ?></strong></label>
                <?php
                $cat_args = array(
                    'orderby'         => 'name',
                    'hide_empty'      => 0,
                    'taxonomy'        => 'ptta-testimonials-categories',
                    'name'            => $this->get_field_name( 'post_category' ),
                    'id'              => $this->get_field_id( 'post_category' ),
                    'class'           => 'widefat',
                    'selected'        => absint( $instance['post_category'] ),
                    'show_option_all' => __( 'All Categories','pt-theme-addon' ),
                  );
                wp_dropdown_categories( $cat_args );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php _e( 'Number of Posts:', 'pt-theme-addon' ); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['post_number'] ); ?>" min="1" />
            </p>

            <?php
        }

    }

endif;

function pt_theme_addon_testimonials_widget_call( $post_category, $post_number ){

    $testimonials_args = array(
                            'post_type'      => 'ptta-testimonials',
                            'posts_per_page' => esc_attr( $post_number ),
                            'no_found_rows'  => true,
                        );
    if ( absint( $post_category ) > 0 ) {
        $testimonials_args['tax_query'] = array(
                                            array(
                                                'taxonomy' => 'ptta-testimonials-categories',
                                                'field'    => 'term_id',
                                                'terms'    => absint( $post_category ),
                                            ),
                                        );
    }

    $testimonials_query = new WP_Query( $testimonials_args );
     
    if ( $testimonials_query->have_posts() ) : ?>

      <div class="pt-testimonials">

        <div class="inner-wrapper">

            <div class="pt-testimonial-item-wrap">
           
                <?php while ( $testimonials_query->have_posts() ) : 

                        $testimonials_query->the_post(); ?>

                        <div class="pt-testimonial-item">

                            <div class="pt-testimonial-inner">
                            
                                <div class="pt-testimonial-caption">
                                    <?php the_content(); ?>
                                </div> 

                                <?php

                                if( has_post_thumbnail() ){ ?>
                                    <figure>
                                      <?php the_post_thumbnail( 'thumbnail' ); ?>  
                                    </figure>
                                <?php } ?>
                                    
                                <div class="pt-testimonial-meta">
                                    <span class="pt-testimonial-title"><?php the_title(); ?></span>
                                    <?php
                                    $post_id    = get_the_ID();

                                    $position   = get_post_meta( absint($post_id), 'position', true );

                                    $company    = get_post_meta( absint($post_id), 'company', true );

                                    if( !empty( $position ) ){
                                        echo '<span class="position">'.esc_html( $position ).' @ </span>';

                                    }
                                    if( !empty( $company ) ){
                                        echo '<span class="company">'.esc_html( $company ).'</span>';

                                    } ?>
                                </div>

                            </div>
                            
                        </div>

                <?php endwhile; 

                wp_reset_postdata(); ?>

            </div>

        </div><!-- .inner-wrapper -->

      </div><!-- .testimonials-widget -->

    <?php endif; 
}


function pt_theme_addon_show_testimonials( $atts ) {

    extract( shortcode_atts( 
        array( 
            'category'      => '',
            'post_number'   => 5,
        ), 
        $atts 
    ));

    ob_start();

    pt_theme_addon_testimonials_widget_call( $category, $post_number );

    return ob_get_clean();
}

add_shortcode( 'ptta-testimonials', 'pt_theme_addon_show_testimonials' );