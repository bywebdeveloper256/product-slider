<?php
namespace productSlider;

if(!class_exists('RBEnqueues')){
    class RBEnqueues {
       
        public function enqueue_scripts_in_front(){
            wp_enqueue_style( 'CSSproductSlider', MAIN_FOLDER_URL.'front/css/productSlider.css', array(), '1.0.0' );
            wp_enqueue_script( 'JSproductSlider', MAIN_FOLDER_URL.'front/js/productSlider.js', array(), '1.0.0', true );
            wp_localize_script( 'JSproductSlider', 'ajax', 
                array( 
                    'url'       => admin_url( 'admin-ajax.php' ), 
                    'action'    => 'RBProductSliderAction',
                    'nonce'     => wp_create_nonce( 'RBProductSliderNonce' ) 
                )
            );
        }
    }
}