<?php
$post_id = get_the_ID();
$product = wc_get_product($post_id);
$title = get_the_title();
$thumbnail = get_the_post_thumbnail_url(null, 'large');
$variation_ids = $product->get_children();
$first_variation_id = reset($variation_ids);
$variation = wc_get_product($first_variation_id);
$price = $variation->get_price();
$attributes = $product->get_attributes();
$product_link = get_permalink();
$short_description = $product->get_short_description();
$product_categories = wp_get_post_terms($post->ID, 'product_cat');

if ( $product->is_type( 'variable' ) ) {
    // Get all variations
    $variations = $product->get_available_variations();

    // Initialize an array to store prices
    $prices = array();

    // Loop through variations to collect prices
    foreach ( $variations as $variation ) {
        // Get the variation object
        $variation_obj = wc_get_product( $variation['variation_id'] );

        // Get the variation price
        $price = $variation_obj->get_price();

        // Add the price to the prices array
        $prices[] = $price;
    }

    // Get the minimum price from the prices array
    $min_price = min( $prices );

}

$party_board = false;
foreach ($product_categories as $category) {
    $category_id = $category->term_id;
    if ($category_id == 78) {
        $party_board = true;
    }
}

$product_id = $product->get_id();

// Get all reviews for the product
$args = array(
    'status' => 'approve',
    'post_type' => 'product',
    'post_id' => $product_id,
);
$reviews = get_comments($args);

$total_rating = 0;
$total_reviews = count($reviews);

// Calculate total rating
foreach ($reviews as $review) {
    $total_rating += intval(get_comment_meta($review->comment_ID, 'rating', true));
}

// Calculate average rating
$average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;

// Convert average rating to percentage
$average_rating_percent = $average_rating / 5 * 100;


?>
<a href="<?php echo $product_link; ?>" class="boats_wrapper-item">
    <div class="boats_wrapper-item-left">
        <?php if ($party_board) : ?>
            <div class="boats_wrapper-item-special"><?php echo __('+ PARTY BOAT', 'bigmarlin'); ?></div>
        <?php endif; ?>
        <picture>
            <img src="<?php echo $thumbnail; ?>" alt="product">
        </picture>
    </div>
    <div class="boats_wrapper-item-right">

        <div class="flex justify_sb boats_wrapper-item-right-top">
            <h3 class="boats_wrapper-item-title"><?php echo $title; ?></h3>
            <div class="commnet_avarage">
			<div class="commnet_avarage-rating">
				<span style="width: <?php echo $average_rating_percent; ?>%"></span>
			</div>
			<div class="commnet_avarage-total">
				<?php echo 'Based on ' . $total_reviews . ' votes'; ?>
			</div>
		    </div>
        </div>

        <div class="boats_wrapper-item-right-middle">
            <?php echo $short_description; ?>
        </div>

        <div class="boats_wrapper-item-right-bottom flex justify_sb align_c">
            <div class="boats_wrapper-item-attr">
                <?php foreach ($attributes as $key => $attribute) :
                    // Get attribute name and options
                    $name = $attribute->get_name();
                    $options = $attribute->get_options();
                    // Output attribute key and value
                    // $str = implode(', ', $options);
                ?>
                    <?php if ($name == 'Time') : ?>
                        <div class="attr_time">
                            <img src="<?php echo get_template_directory_uri(); ?>/app/img/time-icon.svg" alt="icon" />
							<?php echo "min. " . $options[0]; ?>
                        </div>
                    <?php elseif ($name == 'Capacity') : ?>
                        <div>
                            <img src="<?php echo get_template_directory_uri(); ?>/app/img/calendar-icon.svg" alt="icon" />
                            <?php echo $options[0]; ?>
                        </div>
                    <?php elseif ($name == 'Cancel Type') : ?>
                        <div>
                            <img src="<?php echo get_template_directory_uri(); ?>/app/img/people-icon.svg" alt="icon" />
                            <?php echo $options[0]; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="boats_wrapper-item-price">
                <span><?php echo __('From', 'bigmarlin'); ?></span>
                <?php echo '$' . $min_price; ?>
                <span><?php echo __('per group', 'bigmarlin'); ?></span>
            </div>
        </div>
    </div>
</a>