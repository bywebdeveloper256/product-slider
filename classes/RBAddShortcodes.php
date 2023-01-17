<?php
namespace productSlider;

if(!class_exists('RBAddShortcodes')){
    class RBAddShortcodes {
        public function __construct(){
            add_shortcode('RBProductSlider', array( $this, 'productSlider_shortcode_content' ) );
        }

        public function productSlider_shortcode_content($atts){
            global $product;
            $parameters = shortcode_atts( array (
                'category' => '',
                'limit' => 10,
            ), $atts );

            ob_start();
            require MAIN_FOLDER_PATH . 'front/templates/productSlider.php';
            $html = ob_get_clean();
        
            return $html;
        }
    }
}