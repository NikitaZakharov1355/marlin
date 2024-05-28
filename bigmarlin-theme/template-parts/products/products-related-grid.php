<?php

enqueue_owl_scripts();

$title = get_field('fishing_apparel_and_local_products_title', 'option');
$image = get_field('product_reviews_image', 'option');
$category = get_field('exclude_category','option');

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat', // Specify the product category taxonomy
            'field'    => 'term_id',     // Specify the field to use (term_id, slug, or name)
            'terms'    => $category,     // Specify the category IDs
            'operator' => 'NOT IN',          // Use the 'IN' operator to include products from the specified categories
        ),
    ),
);

$query = new WP_Query($args);

?>
<section class="related">
    <div class="container text_c">
        <h2 class="related_title"><?php echo $title; ?></h2>
    </div>
    <div class="container">
    <div class="related_grid">
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $post_id = get_the_ID();
                $product = wc_get_product($post_id);
                $title = get_the_title();
                $thumbnail = get_the_post_thumbnail_url(null, 'medium');
                $price = $product->get_price();
                $product_link = get_permalink();
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
                // Get the gallery attachment IDs
                $attachment_ids = $product->get_gallery_image_ids();
                $counter = 0;
                $category_id = 83;
                if(!has_term($category_id, 'product_cat', $post_id)):
        ?>
                <a href="<?php echo $product_link; ?>" class="related_grid-item item-<?php echo $post_id; ?>" title="product">
                    <div class="related_grid-item-top flex">
                        <?php if($product->is_on_sale()): ?>
                            <div class="related_grid-item-sale">
                                <?php echo __('Sale', 'bigmarlin'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($attachment_ids): ?>
                        <?php foreach ($attachment_ids as $attachment_id):
                            if($counter < 3) {
                                $counter++;
                                $image_url = wp_get_attachment_url($attachment_id);?>
                                <picture>
                                    <img src="<?php echo $image_url; ?>" alt="related-product">
                                </picture>   
                           <?php } ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <picture>
                            <img src="<?php echo $thumbnail; ?>" alt="product">
                        </picture>
                        <?php endif; ?>
                    </div>
                    <div class="related_grid-item-bottom text_c">
                        <h3 class="related_grid-item-title"><?php echo $title; ?></h3>
                        <div class="related_grid-item-price">
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
                    </div>
                </a>
        <?php
            endif;
            endwhile;
        endif;
        wp_reset_query();
        ?>
    </div>
    </div>
</section>