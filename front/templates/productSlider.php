<?php
	$args = array(
		'orderby'	=> 'date',
		'order' 	=> 'DESC',
		'status'    => 'publish',
		'limit'		=> $parameters['limit']
	);

	if( !empty($parameters['category'])){
		$args['category'] = explode(",", $parameters['category']);
	}

	$query 		= new WC_Product_Query( $args );
	$products 	= $query->get_products();
	
	require MAIN_FOLDER_PATH . 'front/dynamicCss.php'; 
?>
<div class="contentSlider" cats="<?php echo $parameters['category'] ?>" limit="<?php echo $parameters['limit'] ?>">
	<div class="slider">
		<div class="slides" id="slides">
			<?php
				if($products){
					foreach( $products as $product){
						require MAIN_FOLDER_PATH . 'front/templates/itemProduct.php';
					}
				}
			?>
		</div>

		<a href="#!" id="prev" class="prev">
			<span class="dashicons dashicons-arrow-left-alt2"></span>
		</a>
		<a href="#!" id="next" class="next">
			<span class="dashicons dashicons-arrow-right-alt2"></span>
		</a>
	</div>
	<button class="btnUpdate"><?php _e('Update') ?></button>
</div>
