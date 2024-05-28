<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>


<?php global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ($attachment_ids && count($attachment_ids) > 0) { ?>

<div class="woocommerce-product-gallery flexslider">
  <div class="woocommerce-product-gallery__wrapper slides">

<?php	foreach ($attachment_ids as $attachment_id) {

		$image_title = esc_attr(get_the_title($attachment_id));

		$image_url = wp_get_attachment_image_url($attachment_id, 'full');

		$image_thumb_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');

?>
    <div class="woocommerce-product-gallery__image" data-thumb="<?php echo $image_thumb_url; ?>">
      <img src="<?php echo $image_url; ?>" />
	</div>
<?php
	}
	?>
	 </div>
</div>
<?php }