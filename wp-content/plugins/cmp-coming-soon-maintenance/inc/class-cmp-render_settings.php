<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



/**
 * Create custom Class for CMP render settings to avoid repeating fields
 *
 * @since 2.4
 */
if ( ! class_exists( 'cmp_render_settings' ) ) {
    class cmp_render_settings {

        /**
         * Settings Constructor.
         *
         * @since 2.4
         */
		function __construct() {

        }


        /**
         * Submit Settings Button.
         *
         * @since 2.4
         */
        public function submit() {

            ob_start(); ?>

            <tr><th>
                <p class="cmp-submit">
                    <?php wp_nonce_field('save_options','save_options_field'); ?>
                    <input type="submit" name="submit" class="button cmp-button submit" value="<?php _e('Save All Changes', 'cmp-coming-soon-maintenance'); ?>" id="submitChanges" />
                </p>
            </th></tr>

            <?php 

            return ob_get_clean();
        }

    }
}