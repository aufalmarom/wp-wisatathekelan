<?php 

if ( ! function_exists( 'pt_theme_addon_team_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function pt_theme_addon_team_widget() {

        register_widget( 'PT_Theme_Addon_Our_Team_Widget' );

    }

endif;

add_action( 'widgets_init', 'pt_theme_addon_team_widget' );

if ( ! class_exists( 'PT_Theme_Addon_Our_Team_Widget' ) ) :

    /**
     * Our Team widget class.
     *
     * @since 1.0.0
     */
    class PT_Theme_Addon_Our_Team_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'pt_theme_addon_widget_our_team',
                'description' => __( 'Our Team Widget', 'pt-theme-addon' ),
            );

            parent::__construct( 'pt-theme-addon-our-team', esc_html__( 'PT: Our Team', 'pt-theme-addon' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $section_icon      = !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';
            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $post_category     = ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;
            $post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
            $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'full';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;

            echo $args['before_widget']; ?>

                <div class="pt-team-main">

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

                    pt_theme_addon_team_widget_call( $post_category, $post_number, $post_column, $featured_image ); ?>
                
                </div>

                <?php

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['section_icon']   = sanitize_text_field( $new_instance['section_icon'] );
            $instance['sub_title']      = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_category']  = absint( $new_instance['post_category'] );
            $instance['post_number']    = absint( $new_instance['post_number'] );
            $instance['post_column']    = absint( $new_instance['post_column'] );
            $instance['featured_image'] = sanitize_text_field( $new_instance['featured_image'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'          => '',
                'section_icon'   => 'fa fa-user-o',
                'sub_title'      => '',
                'post_category'  => '',
                'post_column'    => 4,
                'featured_image' => 'full',
                'post_number'    => 4,
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
                    'taxonomy'        => 'ptta-team-categories',
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

function pt_theme_addon_team_widget_call( $post_category, $post_number, $post_column, $featured_image ){

    $team_args = array(
        'post_type'      => 'ptta-team',
        'posts_per_page' => esc_attr( $post_number ),
        'no_found_rows'  => true,
        );
    if ( absint( $post_category ) > 0 ) {

        $team_args['tax_query'] = array(
                                        array(
                                            'taxonomy' => 'ptta-team-categories',
                                            'field'    => 'term_id',
                                            'terms'    => absint( $post_category ),
                                        ),
                                    );
    }

    $team_query = new WP_Query( $team_args );

    if ( $team_query->have_posts() ) : ?>

      <div class="pt-team-members pt-team-col-<?php echo esc_attr( $post_column ); ?>">

        <div class="inner-wrapper">

            <div class="pt-team-items-wrap">

                <?php 
                while ( $team_query->have_posts() ) :

                    $team_query->the_post(); ?>

                    <div class="pt-team-item">

                        <div class="pt-team-inner">
                    
                            <div class="pt-team-thumb">
                                <?php 

                                if ( has_post_thumbnail() ){ 

                                    the_post_thumbnail( esc_attr( $featured_image ) );

                                }else{ ?>

                                    <img src="<?php echo esc_url( PT_URL . '/assets/images/no-image.jpg'  ); ?>" alt="<?php echo esc_html__( 'team-thumb', 'pt-theme-addon' ); ?>" />
                                    <?php 
                                }?>
                            </div>

                            <div class="pt-team-content-wrap">
                                
                                <h3 class="pt-team-title"><?php the_title(); ?></h3>
                                
                                <div class="pt-team-meta">
                                    <?php 
                                    $post_id    = get_the_ID();

                                    $position   = get_post_meta( absint( $post_id ), 'position', true );
                                    $email      = get_post_meta( absint( $post_id ), 'email', true );

                                    if( !empty( $position ) ){ ?>
                                        <span class="pt-team-position"><?php echo esc_html( $position ); ?></span>
                                        <?php 
                                    } 

                                    if( !empty( $email ) ){ ?>
                                        <span class="pt-team-email">
                                            <a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
                                        </span>
                                        <?php 
                                    } 

                                    $profilecount = 0;

                                    for( $i=0; $i<5; $i++ ){

                                        $social_profiles = get_post_meta( absint( $post_id ), 'social-'.$i, true );

                                        if( !empty( $social_profiles ) ){

                                            $profilecount++;

                                        }

                                    } 

                                   if( $profilecount !== 0){ ?>
                                    
                                        <ul class="pt-team-social">
                                            <?php 

                                            for( $j=0; $j<5; $j++ ){

                                                $social_profile = get_post_meta( absint( $post_id ), 'social-'.$j, true );

                                                if( !empty( $social_profile ) ){ ?>
                                                    <li class="social-link">
                                                        <a href="<?php echo esc_url( $social_profile ); ?>"></a>
                                                    </li>
                                                <?php }

                                            } ?>
                                            
                                        </ul>
                                        <?php
                                    } ?>
                                </div><!-- .pt-team-meta -->
                            </div><!-- .pt-team-content-wrap -->

                        </div>
                        
                    </div>

                    <?php 
                endwhile; 

                wp_reset_postdata(); ?>

            </div>

        </div><!-- .inner-wrapper -->

      </div><!-- .pt-team-widget -->

    <?php endif; 

}

function pt_theme_addon_show_team( $atts ) {

    extract( shortcode_atts( 
        array( 
            'category'     => '',
            'post_number'  => 10,
            'column'       => 4,
            'image_size'   => 'full',
        ), 
        $atts 
    ));

    ob_start();

    pt_theme_addon_team_widget_call( $category, $post_number, $column, $image_size );

    return ob_get_clean();
}

add_shortcode( 'ptta-team', 'pt_theme_addon_show_team' );