<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$post_id = get_the_ID();
// $product = wc_get_product($post_id);
$attributes = $product->get_attributes();
$price = $product->get_price();

global $post;

$checkBoatCategory = has_term( '77', 'product_cat', $post->ID);

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<div class="product-head text_c">
		<div class="container">
			<h1><?php echo get_the_title(); ?></h1>
		</div>
	</div>


	<?php if($checkBoatCategory): ?>
		<div class="product-gallery">
		<div class="container">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action('woocommerce_before_single_product_summary');
			?>
		</div>
	</div>
	<div class="product-attribute">
		<div class="container">
			<div class="boats_wrapper-item-right-bottom flex justify_sb align_c">
				<div class="boats_wrapper-item-attr">
					<?php foreach ($attributes as $key => $attribute) :
						// Get attribute name and options
						$name = $attribute->get_name();
						$options = $attribute->get_options();
						// Output attribute key and value
						$str = implode(', ', $options);
					?>
						<?php if ($name == 'Length') : ?>
							<div class="boats_wrapper-item-attr-length">
								<div class="title"><?php echo $name; ?></div>
								<div class="value">
									<img src="<?php echo get_template_directory_uri(); ?>/app/img/length-icon.svg" alt="icon" />
									<?php echo $str; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					<div class="boats_wrapper-item-attr-middle dir_col">
						<?php foreach ($attributes as $key => $attribute) :
							// Get attribute name and options
							$name = $attribute->get_name();
							$options = $attribute->get_options();
							// Output attribute key and value
							$str = implode(', ', $options);
						?>
							<?php if ($name == 'Cancel Type') : ?>
								<div>
									<img src="<?php echo get_template_directory_uri(); ?>/app/img/calendar-icon.svg" alt="icon" />
									<?php echo $str; ?>
								</div>
							<?php elseif ($name == 'Capacity') : ?>
								<div>
									<img src="<?php echo get_template_directory_uri(); ?>/app/img/people-icon.svg" alt="icon" />
									<?php echo $str; ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
					<?php foreach ($attributes as $key => $attribute) :
						// Get attribute name and options
						$name = $attribute->get_name();
						$options = $attribute->get_options();
						// Output attribute key and value
						// $str = implode(', ', $options);
					?>
						<?php if ($name == 'Time') : ?>
							<div>
								<img src="<?php echo get_template_directory_uri(); ?>/app/img/time-icon.svg" alt="icon" />
								<?php echo "min. " . $options[0]; ?>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="boats_wrapper-item-price">
					<span><?php echo __('From', 'bigmarlin'); ?></span>
					<?php echo '$' . $price; ?>
					<span><?php echo __('per group', 'bigmarlin'); ?></span>
				</div>
			</div>
		</div>
	</div>
	<?php else: ?>
		<div class="product_simple">
			<?php
			    if ($product->is_type('variable')) {
					// Get all variations
					$variations = $product->get_available_variations();
					
					// Initialize an array to store prices
					$prices = array();
					
					// Loop through variations to collect prices
					foreach ($variations as $variation) {
						// Get the variation object
						$variation_obj = wc_get_product($variation['variation_id']);
						
						// Check if the variation is on sale
						if ($variation_obj->is_on_sale()) {
							$onSale = true;
							$salePrice = $variation_obj->get_sale_price();
							$price = $variation_obj->get_regular_price();
							break;
						} else {
							$onSale = false;
						}
						
						// Get the variation price
						$price = $variation_obj->get_regular_price();
						
						// Add the price to the prices array
						// $prices[] = $price;
					}
					
					// Get the minimum price from the prices array
					// $min_price = min($prices);
				}
			?>
			<div class="container flex justify_sb">
			<div class="product-gallery">
		<div class="container">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action('woocommerce_before_single_product_summary');
			?>
		</div>
		</div>
		<div class="product-attribute">
		<div class="container">
			<div class="boats_wrapper-item-right-bottom simple-product-bottom flex justify_c align_c">
				<div class="boats_wrapper-item-price">
				<span class="<?php if ($onSale) : echo 'dashed';
                                                        endif; ?>">
                                            <?php echo $price . '$'; ?>
                                        </span>
                                        <?php if ($onSale) : ?>
                                            <span class="sale">
                                                <?php echo $salePrice . '$'; ?>
                                            </span>
                                        <?php endif; ?>
				</div>
				<form class="cart" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" method="post">
				<div class="col_50">
				<?php 
 					global $product;

 					// Check if the product belongs to category 77
 					$product_in_category = false;
 					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
 					    $product_id = $cart_item['product_id'];
 					    $product_in_category = has_term('77', 'product_cat', $product_id);
 					    if ($product_in_category) {
 					        break;
 					    }
 					}

 					// Add a class to the add-to-cart button if the product is in category 77
 					$class = $product_in_category ? '' : 'disable';

                     $attr_name = '';
                     $attr_options = '';
                     foreach ($attributes as $key => $attribute) :
                                     // Get attribute name and options
                                     $attr_name = $attribute->get_name();
                                     $options = $attribute->get_options();
                                     // Output attribute key and value
                                     // $str = implode(', ', $options);
                                    // $attr_options = array(); // Initialize an empty array to store attribute options

                                     woocommerce_form_field($attr_name, array(
                                        'type'        => 'select',
                                        'class'       => array('form-row-wide'),
                                        'label'       => __($attr_name, 'woocommerce'),
                                        'options'     => $options,
                                        'required'    => true,
                                    ), '');
                                     
                                    //  foreach ($variations as $variation) {
                                    //      // Get the variation object
             
                                    //      $variation_obj = wc_get_product($variation['variation_id']);
                                    //      $size = $variation_obj->get_attribute('size');
                                         
                                    //      $attr_options[$variation['variation_id']] = $size;
                                         
                                    //      // Add the price to the prices array
                                    //      // $prices[] = $price;
                                    //  }
             
                         endforeach; ?>
				</div>
				<div class="col_50">
					<label for="quantity">Quantity:</label>
			<?php 
			woocommerce_quantity_input(array(
				'label'       => __('Quantity', 'woocommerce'),
				'input_name'  => "quantity",
				'input_value' => '1', // Default value
				'max_value'   => $product->get_max_purchase_quantity(),
				'min_value'   => '1',
			));
			?>
				</div>
                <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

                <button class="btn btn_simple <?php echo $class; ?>" type="submit" name="add-to-cart" value="<?php echo esc_attr( $variations[0]['variation_id'] ); ?>" class="single_add_to_cart_button button alt">
                    <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                </button>
				<?php if($class == 'disable'): ?>
					<div class="simple_notice"><?php echo __('First, select a boat to purchase merch');?>
					<a class="btn" href="/reservation_fishing_excursion_party/"><?php echo __('Reservation'); ?></a>
				</div>
				<?php endif; ?>
                <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
            </form>
			</div>
		</div>
	</div>	
			</div>
		</div>
	<?php endif; ?>

	<div class="product-content">
		<div class="container">
			<?php if (get_the_content()) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php echo $product->get_short_description(); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php if($checkBoatCategory): ?>
		<?php get_template_part('template-parts/products/calendar-toggle'); ?>

		<?php get_template_part('template-parts/products/booking'); ?>
	<?php endif; ?>

	<?php get_template_part('template-parts/products/book-now-button'); ?>
	
	<?php get_template_part('template-parts/products/boats-related'); ?>

	<?php if($checkBoatCategory): ?>
		<?php get_template_part('template-parts/products/reviews'); ?>
	<?php endif; ?>

	<?php get_template_part('template-parts/products/products-related'); ?>

</div>

<?php do_action('woocommerce_after_single_product'); ?>