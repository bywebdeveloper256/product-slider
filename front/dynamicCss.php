<?php
    $customColors   = get_option('product_slider_settings');
    $backgroundCard = $customColors['background_card_field'];
    $backgroundBtn  = $customColors['background_btn_field'];
?>
<style>
    a.btnProduct:hover, .btnUpdate:hover{
        background-color: transparent;
        color: <?php echo $backgroundBtn ?>;
        border: 1px solid <?php echo $backgroundBtn ?>;
    }

    .btnUpdate, a.btnProduct{
        background-color: <?php echo $backgroundBtn ?>;
        color: #fff;
        border: solid 1px <?php echo $backgroundBtn ?>;
    }

    .slide{
        background-color: <?php echo $backgroundCard ?>
    }
</style>