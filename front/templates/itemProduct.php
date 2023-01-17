<?php
$img    = wp_get_attachment_url( $product->get_image_id() );
$title  = $product->get_name();
$price  = $product->get_price() ? get_woocommerce_currency_symbol().$product->get_price() : '';
$type   = $product->get_type();
$slug   = $product->get_slug();
$offer  = $product->get_sale_price() ? '¡in offer!' : '';
?>
<span class="slide">
    <div class="card">
        <img src="<?php echo $img; ?>" alt="<?php echo $title; ?>" />
        <div class="contentCard">
            <a href="<?php echo $slug ?>">
                <h5><?php echo $title; ?></h5>
            </a>
            <h6><?php echo $price; ?><span class="offer"><?php echo $offer ?></span></h6>
            <?php if( $type === 'simple'){ ?>
                <a href="?add-to-cart=<?php echo $product->get_id(); ?>" class="btnProduct"><?php _e('Add to cart'); ?></a>
            <?php }else{ ?>
                <a href="<?php echo $slug ?>" class="btnProduct"><?php _e('Go to product'); ?></a>
            <?php } ?>
        </div>
    </div>
</span>