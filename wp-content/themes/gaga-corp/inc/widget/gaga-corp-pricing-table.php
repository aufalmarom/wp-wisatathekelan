<?php 
/**
 * Pricint post/page widget
 *
 * @package gaga lite
 */
/**
 * Adds gaga_lite_Pricint widget.
 */
add_action('widgets_init', 'gaga_lite_register_pricing_widget');

function gaga_lite_register_pricing_widget() {
    register_widget('gaga_lite_pricing');
}

class gaga_lite_Pricing extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'gaga_lite_pricing', 'Gaga : Pricing Table', array(
            'description' => __('A widget that shows Pricing Table', 'gaga-corp')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            // This widget has no title
            // Other fields
            'pricing_plan' => array(
                'gaga_lite_widgets_name' => 'pricing_plan',
                'gaga_lite_widgets_title' => __('Price', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_plan_sub_text' => array(
                'gaga_lite_widgets_name' => 'pricing_plan_sub_text',
                'gaga_lite_widgets_title' => __('Status', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature1' => array(
                'gaga_lite_widgets_name' => 'pricing_feature1',
                'gaga_lite_widgets_title' => __('Feature 1', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature2' => array(
                'gaga_lite_widgets_name' => 'pricing_feature2',
                'gaga_lite_widgets_title' => __('Feature 2', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature3' => array(
                'gaga_lite_widgets_name' => 'pricing_feature3',
                'gaga_lite_widgets_title' => __('Feature 3', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature4' => array(
                'gaga_lite_widgets_name' => 'pricing_feature4',
                'gaga_lite_widgets_title' => __('Feature 4', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature5' => array(
                'gaga_lite_widgets_name' => 'pricing_feature5',
                'gaga_lite_widgets_title' => __('Feature 5', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature6' => array(
                'gaga_lite_widgets_name' => 'pricing_feature6',
                'gaga_lite_widgets_title' => __('Feature 6', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature7' => array(
                'gaga_lite_widgets_name' => 'pricing_feature7',
                'gaga_lite_widgets_title' => __('Feature 7', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'pricing_feature8' => array(
                'gaga_lite_widgets_name' => 'pricing_feature8',
                'gaga_lite_widgets_title' => __('Feature 8', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'button_text' => array(
                'gaga_lite_widgets_name' => 'button_text',
                'gaga_lite_widgets_title' => __('Button Text', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
            'button_link' => array(
                'gaga_lite_widgets_name' => 'button_link',
                'gaga_lite_widgets_title' => __('Button Link', 'gaga-corp'),
                'gaga_lite_widgets_field_type' => 'text',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $pricing_plan = $instance['pricing_plan'];
        $pricing_plan_sub_text = $instance['pricing_plan_sub_text'];
        $pricing_feature1 = $instance['pricing_feature1'];
        $pricing_feature2 = $instance['pricing_feature2'];
        $pricing_feature3 = $instance['pricing_feature3'];
        $pricing_feature4 = $instance['pricing_feature4'];
        $pricing_feature5 = $instance['pricing_feature5'];
        $pricing_feature6 = $instance['pricing_feature6'];
        $pricing_feature7 = $instance['pricing_feature7'];
        $pricing_feature8 = $instance['pricing_feature8'];
        $button_text = $instance['button_text'];
        $button_link = $instance['button_link'];


        echo $before_widget;
        ?>

        <div class="wow fadeInUp gaga-pricing-table">
            <div class="gaga-pricing-head">
                <?php if (!empty($pricing_plan)): ?>
                    <div class="gaga-pricing-plan">
                        <div class="per_tex">
                            
                            <div class="clearfix"></div>
                            <?php if (!empty($pricing_plan_sub_text)): ?>
                                <span class="gaga-pricing-plan-sub-text"><?php echo esc_html($pricing_plan_sub_text); ?></span>
                            <?php endif; ?>
                            <div class="percent"><span>
                                    <?php echo esc_html($pricing_plan); ?></span>/Year
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


            </div>

            <div class="gaga-pricing-features">
                <ul class="gaga-pricing-features-inner">
                    <?php if (!empty($pricing_feature1)): ?>
                        <li><?php echo esc_attr($pricing_feature1); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature2)): ?>
                        <li><?php echo esc_attr($pricing_feature2); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature3)): ?>
                        <li><?php echo esc_attr($pricing_feature3); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature4)): ?>
                        <li><?php echo esc_attr($pricing_feature4); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature5)): ?>
                        <li><?php echo esc_attr($pricing_feature5); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature6)): ?>
                        <li><?php echo esc_attr($pricing_feature6); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature7)): ?>
                        <li><?php echo esc_attr($pricing_feature7); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($pricing_feature8)): ?>
                        <li><?php echo esc_attr($pricing_feature8); ?></li>
                    <?php endif; ?>

                    <?php if (!empty($button_link)): ?>                       

                        <li class="pricing-read">
                            <a class="sign_up_price" href="<?php echo esc_url($button_link); ?>"><?php
                                if ($button_text == '') {
                                    echo _e('Sign Up','gaga-corp');
                                } else {
                                    echo esc_attr($button_text);
                                }
                                ?>
                                <div class="pricing-position-outer">
                                </div>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!--
            <?php if (!empty($pricing_button_text)): ?>
              <div class="gaga-pricing-readmore"><a class="bttn" href="<?php echo esc_url($pricing_button_link); ?>"><?php echo esc_attr($pricing_button_text); ?></a></div>
            <?php endif; ?>
            -->           
        </div>

        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	gaga_lite_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
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
