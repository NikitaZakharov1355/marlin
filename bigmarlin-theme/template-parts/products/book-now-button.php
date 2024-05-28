<?php 
	// Check if the product is in stock
	global $product, $woocommerce;
	if ($product->is_in_stock()) {
?>
	<div class="booking text_c">
		<div class="container">
			<?php 
				$id = get_the_ID(); 
				$title = get_the_title( $id );
				$item_lowercase = strtolower( $title );		
				$item_slug = str_replace(' ', '-', $item_lowercase);				
			?>
			<a href="/reservation_fishing_excursion_party/?boat=<?php echo $item_slug; ?>" 
				class="btn-book">
				Book Now
			</a>
		</div>
	</div>

<?php 
	}
?>	

<style>
.btn-book {
	 background-color: #303f51;
	  border-radius: 5px;
	  color: #fff!important;
	  display: inline-block;
	  font-size: 2.4rem;
	  font-weight: 500;
	  line-height: 3.1rem;
	  margin-top: 1rem;
	  min-width: 26rem;
	  padding: 1.5rem;
	  text-align: center;
	  text-transform: uppercase;
	  text-decoration: none !important;
}	
</style>