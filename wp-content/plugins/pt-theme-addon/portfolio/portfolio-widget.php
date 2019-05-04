<?php 

if ( ! function_exists( 'pt_theme_addon_portfolio_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function pt_theme_addon_portfolio_widget() {

        register_widget( 'PT_Theme_Addon_Portfolio_Widget' );

    }

endif;

add_action( 'widgets_init', 'pt_theme_addon_portfolio_widget' );

if ( ! class_exists( 'PT_Theme_Addon_Portfolio_Widget' ) ) :

    /**
     * Portfolio widget class.
     *
     * @since 1.0.0
     */
    class PT_Theme_Addon_Portfolio_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'pt_theme_addon_widget_portfolio',
                'description' => __( 'Portfolio Widget', 'pt-theme-addon' ),
            );

            parent::__construct( 'pt-theme-addon-portfolio', esc_html__( 'PT: Portfolio', 'pt-theme-addon' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $section_icon      = !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';

            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
            $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'full';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 12;

            echo $args['before_widget']; ?>

                <div class="pt-portfolio-main">

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

                    pt_theme_addon_portfolio_widget_call( $post_number, $post_column, $featured_image ); ?>
                
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
            $instance['post_column']    = absint( $new_instance['post_column'] );
            $instance['featured_image'] = sanitize_text_field( $new_instance['featured_image'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'          => '',
                'section_icon'   => 'fa fa-desktop',
                'sub_title'      => '',
                'post_column'    => 4,
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
              <label for="<?php echo esc_attr( $this->get_field_id( 'post_column' ) ); ?>"><strong><?php _e( 'Number of Columns:', 'pt-theme-addon' ); ?></strong></label>
                <?php
                $this->dropdown_post_columns( array(
                    'id'       => $this->get_field_id( 'post_column' ),
                    'name'     => $this->get_field_name( 'post_column' ),
                    'selected' => absint( $instance['post_column'] ),
                    )
                );
                ?>
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

        function dropdown_post_columns( $args ) {
            $defaults = array(
                'id'       => '',
                'name'     => '',
                'selected' => 0,
            );

            $r = wp_parse_args( $args, $defaults );
            $output = '';

            $choices = array(
                '2' => 2,
                '3' => 3,
                '4' => 4,
            );

            if ( ! empty( $choices ) ) {

                $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
                foreach ( $choices as $key => $choice ) {
                    $output .= '<option value="' . esc_attr( $key ) . '" ';
                    $output .= selected( $r['selected'], $key, false );
                    $output .= '>' . esc_html( $choice ) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
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

function pt_theme_addon_portfolio_widget_call( $post_number, $post_column, $featured_image ){

    $portfolio_args = array(
                        'post_type'      => 'ptta-portfolio',
                        'posts_per_page' => esc_attr( $post_number ),
                        'no_found_rows'  => true,
                    );
    
    $portfolio_query = new WP_Query( $portfolio_args );
    
    if ( $portfolio_query->have_posts() ) : ?>

      <div class="pt-portfolio pt-portfolio-col-<?php echo esc_attr( $post_column ); ?>">

        <div class="inner-wrapper">
            
            <?php

            $taxonomy = 'ptta-portfolio-categories';
            $terms = get_terms($taxonomy); // Get all terms of a taxonomy

            if ( $terms && !is_wp_error( $terms ) ) :
            ?>
                <ul class="filter-list">
                     <li class="filter" data-filter="all"><?php echo esc_html__( 'All', 'pt-theme-addon' ); ?></li>
                    <?php foreach ( $terms as $term ) { ?>
                       <li class="filter" data-filter="<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
                    <?php } ?>
                </ul>
            <?php endif;?>
            <div class="pt-portfolio-item-wrap">
                <?php 
                while ( $portfolio_query->have_posts() ) :

                    $portfolio_query->the_post();

                    $post_id    = get_the_ID();

                    $terms      = wp_get_post_terms( absint($post_id), 'ptta-portfolio-categories');

                    $portfolio_terms = '';

                    foreach ($terms as $term) {

                        $portfolio_terms .= $term->slug.' ';
                       
                    } ?>
                    <div class="pt-portfolio-item <?php echo esc_html( $portfolio_terms ); ?>">
                        <div class="pt-portfolio-wrapper">
                            <?php 
                            $portfolio_type = get_post_meta( absint($post_id), 'portfolio_type', true );
                            $project_link   = get_post_meta( absint($post_id), 'project_link', true );

                            $portfolio_link_opening = '';
                            $portfolio_link_closing = '';

                            if( 'external' === $portfolio_type && !empty( $project_link ) ){

                                $portfolio_link_opening = '<a href="'.esc_url( $project_link ).'" target="_blank">';
                                $portfolio_link_closing = '</a>';


                            } elseif( 'new_window' === $portfolio_type ){
                                $portfolio_link_opening = '<a href="'.esc_url( get_permalink() ).'" target="_self">';
                                $portfolio_link_closing = '</a>';

                            } ?>

                            <div class="pt-portfolio-inner">

                                <div class="pt-portfolio-thumb">
                                    <?php 
                                    if ( has_post_thumbnail() ){ 
                                        echo $portfolio_link_opening;
                                        the_post_thumbnail( esc_attr( $featured_image ) );
                                        echo $portfolio_link_closing;
                                    }else{ 
                                        echo $portfolio_link_opening; ?>
                                        <img src="<?php echo esc_url( PT_URL . '/assets/images/camera-icon.jpg'  ); ?>" alt="<?php echo esc_html__( 'portfolio-thumb', 'pt-theme-addon' ); ?>" />
                                            <?php 
                                        echo $portfolio_link_closing;
                                    }?>
                                </div>

                                <div class="pt-portfolio-text-wrap">
                                      <h3 class="pt-portfolio-title">
                                        <?php 
                                        echo $portfolio_link_opening;
                                        the_title();
                                        echo $portfolio_link_closing;
                                        ?>
                                      </h3><!-- .pt-portfolio-title -->
                                </div><!-- .pt-portfolio-text-wrap -->

                            </div>
                        </div>
                    </div> 

                    <?php 
                endwhile; 

                wp_reset_postdata(); ?>

            </div><!-- #portfolio -->

        </div><!-- .row -->

      </div><!-- .portfolio-widget -->

    <?php endif;

}

function pt_theme_addon_show_portfolio( $atts ) {

    extract( shortcode_atts( 
        array( 
            'post_number'  => 36,
            'column'       => 4,
            'image_size'   => 'full',
        ), 
        $atts 
    ));

    ob_start();

    pt_theme_addon_portfolio_widget_call( $post_number, $column, $image_size );

    return ob_get_clean();
}

add_shortcode( 'ptta-portfolio', 'pt_theme_addon_show_portfolio' );