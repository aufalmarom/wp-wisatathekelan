<?php add_action('widgets_init','gaga_news_news');
function gaga_news_news(){
    register_widget('gaga_corp_news_news');
}
class gaga_corp_news_news extends WP_Widget{
    public function __construct(){
        
        parent:: __construct(
            'gaga_corp_news_news','Gaga: News Letter',array(
                'description'=>__('Gaga news post widget','gaga-corp')
            )
        );
    }
    
    private function widget_fields(){
        $fields = array(
            'news_letter_feature_title'=>array(
                'gaga_lite_widgets_name'=>'news_letter_feature_title',
                'gaga_lite_widgets_title'=>__('Title','gaga-corp'),
                'gaga_lite_widgets_field_type'=>'text'
            ),
            'news_letter_feature_description'=>array(
                'gaga_lite_widgets_name'=>'news_letter_feature_description',
                'gaga_lite_widgets_title'=>__('Description','gaga-corp'),
                'gaga_lite_widgets_field_type'=>'textarea'
            ),
            'news_letter_feature_contact'=>array(
                'gaga_lite_widgets_name'=>'news_letter_feature_contact',
                'gaga_lite_widgets_title'=>__('Contact Shortcode','gaga-corp'),
                'gaga_lite_widgets_field_type'=>'textarea'
            ),
            'image'=>array(
                'gaga_lite_widgets_name'=>'image',
                'gaga_lite_widgets_title'=>__('Image','gaga-corp'),
                'gaga_lite_widgets_field_type'=>'upload'
            ),
        );
        return $fields;
    }
    public function widget($args, $instance) {
        extract($args);
        $title = $instance['news_letter_feature_title'];
        $description = $instance['news_letter_feature_description'];
        $contact = $instance['news_letter_feature_contact'];
        $image = $instance['image'];        
        $wp_allow = array(
            'i' =>array(
                'class'=>array()
            )            
        );?>
                
                <div class="news_letter_left">
                <div class="news_letter_feature_title_class wow fadeInLeft"><?php echo esc_attr($title);  ?></div>
                <div class="news_letter_feature_description_class wow fadeInLeft"><?php echo wp_kses_post($description);  ?></div>
                <div class="news_letter_feature_contact_class wow fadeInLeft" ><?php echo do_shortcode($contact);  ?></div>
                </div>
                <div class="news_letter_feature_image_class wow fadeInRight"><img src="<?php echo esc_url($image);  ?>"/></div>
              
            <?php
         echo $after_widget;
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
}?>