<?php
add_action('widgets_init','gaga_corp_latest_work');
function gaga_corp_latest_work(){
    register_widget('gaga_corp_latest_work_reg');
}
class gaga_corp_latest_work_reg extends WP_Widget{
    public function __construct(){
        
        parent:: __construct(
            'gaga_corp_latest_work_reg','Gaga: Latest work',array(
                'description'=>__('Gaga latest post widget','gaga-corp')
            )
        );
    }
    
    private function widget_fields(){
        $fields = array(
            'gaga_corp_recent_work_title' => array(
                'gaga_lite_widgets_name' => 'latest_work_title',
                'gaga_lite_widgets_title' => __('Title', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'gaga_corp_recent_work_display' => array(
                'gaga_lite_widgets_name' => 'latest_work_count',
                'gaga_lite_widgets_title' => __('Post to display', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'number',
            ),
        );
        return $fields;
    }
    public function widget($args, $instance) {
        extract($args);

        $latest_work_title = $instance['latest_work_title'];
        $latest_post_display = $instance['latest_work_count'];
        echo $before_widget; ?> 
            <div>
                <h1 class="widget-title"><?php echo esc_html($latest_work_title) ?></h1>
                <?php $portfolio_category = get_theme_mod('gaga-lite-portfolio_cat');
                    $portfolio_args = array('post_type' => 'post', 'cat' => $portfolio_category, 'order' => 'DESC','posts_per_page' => $latest_post_display);      
                 $work_query1 = new WP_Query($portfolio_args);
                 if($work_query1->have_posts()): ?>
                    <div class="work_latest_post">
                        <div class="work-posts-latest">
                        <?php while($work_query1->have_posts()): 
                            $work_query1->the_post();?>
                            <div class="work-posts-wrap-latest"><?php
                                $img1 = wp_get_attachment_image_src(get_post_thumbnail_id(), 'gaga_corp_footer_widget_work_image');
                                $img_src1 = $img1[0]; ?>
                                    <!--<figure> -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($img_src1); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" /></a>
                                        <?php endif; ?>
                                    <!-- </figure> -->
                                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                    <div class="work_date_sub"><?php
                                        $date1 = get_the_time('F-d-Y');
                                        echo  _e("Date : ",'gaga-corp') . $date1; ?>  
                                    </div>
                            </div>
                        <?php endwhile; ?>                    
                    </div>
                </div> 
                <?php  endif; ?>
            </div>   
        <?php echo $after_widget;
    }
    
     public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$gaga_lite_widgets_name] = gaga_lite_widgets_updated_field_value($widget_field, $new_instance[$gaga_lite_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	gaga_lite_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $gaga_lite_widgets_field_value = !empty($instance[$gaga_lite_widgets_name]) ? esc_attr($instance[$gaga_lite_widgets_name]) : '';
            gaga_lite_widgets_show_widget_field($this, $widget_field, $gaga_lite_widgets_field_value);
        }
    }
}