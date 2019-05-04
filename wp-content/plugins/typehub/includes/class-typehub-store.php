<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Typehub_Store {

    private $store;
    private $data;
    
    public function __construct() {
        $this->store = array();
        $this->data = get_option( 'typehub_data', array(
            'font_schemes' => array(),
            'values' => array()
        ));	
    }

    public function get_store() {
         
        $this->store['fontSchemes'] = $this->get_fonts();
        $this->store['optionConfig'] = $this->get_options();
        $this->store['savedValues'] = $this->data['values'];

        return $this->store;

    }

    public function get_fonts() {
        return Typehub_Font_Schemes::getInstance()->get_schemes();
    }

    public function get_options() {
        $predefined_options = Typehub_Options::getInstance()->get_options();
        // CUSTOM OPTIONS feature moved to a later update.
        // if( empty( $this->data['options'] ) ) {
        //     $this->data['options'] = array();
        // }
        // return array_merge( $predefined_options, $this->data['options'] );
        return $predefined_options;
    }
    
    public function ajax_save() {
        check_ajax_referer( 'typehub-security', 'security' );

        if( !array_key_exists( 'store', $_POST ) ) {
            echo 'failure';
            wp_die();
        }

        $store = json_decode( stripslashes( $_POST['store'] ), true );
        $data['fontSchemes'] = ( array_key_exists( 'fontSchemes', $store ) ) ? $store['fontSchemes'] : array();
        $data['savedValues'] = ( is_array( $store['initConfig']['savedValues'] ) ) ? $store['initConfig']['savedValues'] : array();
        $save_store = $this->save_store( $data );
        if( $save_store ) {
            echo 'success';
        } else {
            echo 'failure';
        }
        wp_die();
    }
    
    public function save_store( $data ) {
        
        $this->data['font_schemes'] = $data['fontSchemes'];
        $this->data['values'] = $data['savedValues'];

        return update_option( 'typehub_data', $this->data );
    }

}