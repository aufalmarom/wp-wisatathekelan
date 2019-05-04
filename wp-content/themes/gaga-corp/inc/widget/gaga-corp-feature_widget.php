<?php add_action('widgets_init','feature_corp');
function feature_corp(){
    register_widget('gaga_corp_feature_corp');
}
class gaga_corp_feature_corp extends WP_Widget{
    public function __construct(){
        
        parent:: __construct(
            'gaga_corp_feature_corp','Gaga Corp:Feature',array(
                'description'=>__('Gaga Corp Feature','gaga-corp')
            )
        );
    }
    
    private function widget_fields(){
        
        $fields = array(
            'gaga_corp_image'=>array(
                    'gaga_lite_widgets_name'=>'gaga_corp_image',
                    'gaga_lite_widgets_title'=>__('Image','gaga-corp'),
                    'gaga_lite_widgets_field_type'=>'upload'
                ),
            'gaga_corp_feature_title'=>array(
                    'gaga_lite_widgets_name'=>'gaga_corp_feature_title',
                    'gaga_lite_widgets_title'=>__('Title','gaga-corp'),
                    'gaga_lite_widgets_field_type'=>'text'
                ),
            'gaga_corp_feature_description'=>array(
                    'gaga_lite_widgets_name'=>'gaga_corp_feature_description',
                    'gaga_lite_widgets_title'=>__('Description','gaga-corp'),
                    'gaga_lite_widgets_field_type'=>'textarea'
                ),
            'color_peacker_widget'=>array(
                'gaga_lite_widgets_name'=>'background_color',
                'gaga_lite_widgets_title'=>__('Color Hex Value','gaga-corp'),
                'gaga_lite_widgets_field_type'=>'text'
            )

        );
        return $fields;
    }
    public function widget($args, $instance) {
        extract($args);
        $feature_image = $instance['gaga_corp_image'];    
        $feature_title = $instance['gaga_corp_feature_title'];
        $feature_description = $instance['gaga_corp_feature_description'];  
        $feature_color = $instance['background_color'];           
        $wp_allow = array(
            'i' =>array(
                'class'=>array()
            )            
        );?>
            <?php 
                $dynamic_class = $args['widget_id'];
             ?>
             <div class="services-wrap">
                <div style="" id=" <?php echo $feature_color; ?>" class="news_letter_feature_image_class <?php echo $dynamic_class; ?>"><img src="<?php echo esc_url($feature_image);  ?>"/></div>
                <h1 style="color:<?php echo $feature_color; ?> !important;" class="feature_title_class"><?php echo esc_attr($feature_title);  ?></h1>
                <div class="feature_description_class"><?php echo wp_kses_post($feature_description);  ?></div>
            </div>
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