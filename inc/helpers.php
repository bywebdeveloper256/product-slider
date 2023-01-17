<?php
if(!function_exists('rb_add_option_page_productSlider')){
    function rb_add_option_page_productSlider(){
        new productSlider\RBOptionsPage;
    }
}

if(!function_exists('rb_add_shortcodes')){
    function rb_add_shortcodes(){
        new productSlider\RBAddShortcodes;
    }
}

if(!function_exists('rb_enqueue_scripts_in_front')){
    function rb_enqueue_scripts_in_front(){
        $RBEnqueues = new productSlider\RBEnqueues;
        $RBEnqueues->enqueue_scripts_in_front();
    }
}

if(!function_exists('productSlideAjax')){
    function productSlideAjax(){
        $r      = array( "r" => false, "m" => "" );
        $nonce  = isset( $_POST['nonce'] ) ? $_POST['nonce'] : false;

        if ( wp_verify_nonce( $nonce, 'RBProductSliderNonce' ) )
        {
            $cats   = isset( $_POST['cats'] ) ? $_POST['cats'] : '';
            $limit  = isset( $_POST['limit'] ) ? $_POST['limit'] : '';

            $args = array(
                'orderby'	=> 'date',
                'order' 	=> 'DESC',
                'status'    => 'publish',
                'limit'		=> $limit
            );
        
            if( !empty( $cats ) ){
                $args['category'] = explode( ",", $cats );
            }
            
            $query      = new WC_Product_Query( $args );
            $products   = $query->get_products();

            ob_start();
            if( $products ){
                foreach( $products as $product){
                    require MAIN_FOLDER_PATH . 'front/templates/itemProduct.php';
                }
            }
            $html = ob_get_clean();

            $r['html'] = $html;
            $r['r'] = true;
        }
        echo json_encode( $r );
        wp_die();
    }
}