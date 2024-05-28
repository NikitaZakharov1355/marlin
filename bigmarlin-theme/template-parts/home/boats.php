<?php 
//enable owl scripts
enqueue_owl_scripts();

$title = get_sub_field('title');
$image = get_sub_field('image');
$category = get_sub_field('category');

// Query products based on IDs
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat', // Specify the product category taxonomy
            'field'    => 'term_id',     // Specify the field to use (term_id, slug, or name)
            'terms'    => $category,     // Specify the category IDs
            'operator' => 'IN',          // Use the 'IN' operator to include products from the specified categories
        ),
    ),
);
$query = new WP_Query($args);
?>

<section class="boats">
    <picture class="image_bg">
        <source srcset="<?php echo $image['sizes']['medium']; ?>" media="(max-width: 768px)">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
    </picture>
    <div class="container">
        <h2 class="boats_title text_c"><?php echo $title; ?></h2>
        <div class="boats_slider owl-carousel">
            <?php
            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    $post_id = get_the_ID();
                    $product = wc_get_product( $post_id );
                    $title = get_the_title();
                    $thumbnail = get_the_post_thumbnail_url(null, 'medium');
                    $price = $product->get_price();
                    $attributes = $product->get_attributes();
                    $product_link = get_permalink();

                    $product_categories = wp_get_post_terms($post->ID, 'product_cat');

                    $party_board = false;
                    foreach ($product_categories as $category) {
                        $category_id = $category->term_id;
                        if($category_id == 78){
                            $party_board = true;
                        }
                    }

                    $args = array(
                        'status' => 'approve',
                        'post_type' => 'product',
                        'post_id' => $post_id,
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
            <div class="boats_slider-item">
                <div class="boats_slider-item-top">
                    <?php if($party_board): ?>
                        <div class="boats_slider-item-special"><?php echo __('+ PARTY BOAT', 'bigmarlin');?></div>
                    <?php endif; ?>
                    <picture>
                        <img src="<?php echo $thumbnail; ?>" alt="product">
                    </picture>
                    <h3 class="boats_slider-item-title"><?php echo $title; ?></h3>
                </div>
                <div class="boats_slider-item-bottom">
                    <div>
                <div class="boats_slider-item-attr">
                    <?php foreach ($attributes as $key => $attribute):
                            // Get attribute name and options
                            $name = $attribute->get_name();
                            $options = $attribute->get_options();
                        
                            // Output attribute key and value
                            if($name == 'Engine Value'){
                                $str = implode(', ', $options);
                            } else {
                                $str = $name . ': ' . implode(', ', $options);
                            }
                        ?>
                         <?php if($name == 'Lenght' || $name == 'Engine' || $name == 'Capacity' || $name == 'Engine Value'):?>
                        <div>
                            <?php echo $str; ?>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="commnet_avarage">
	            	<div class="commnet_avarage-rating">
	            		<span style="width: <?php echo $average_rating_percent; ?>%"></span>
	            	</div>
	            </div>

                <?php 
                    $variations = $product->get_children();
                    foreach($variations as $variation):
                        $vproduct = wc_get_product($variation);
                        echo '<div class="boats_slider-item-price flex justify_sb align_c">';
                            echo '<div>';
                                echo $vproduct->description;
                            echo '</div>';
                            echo '<div>';
                                echo $vproduct->price . '$';
                            echo '</div>';                                        
                        echo '</div>';
                    endforeach;
                ?>
                </div>
                <a href="<?php echo $product_link; ?>" class="btn"><?php _e('Reserve', 'bigmarlin'); ?></a>
                </div>
            </div>

            <?php 
                endwhile;
            endif;
            wp_reset_query();
            ?>
            <?php if(get_field('enable_comming_soon','option')): ?>
                <div class="boats_slider-item comming_soon">
                    <div class="comming_soon-title">
                        <?php echo __('Coming soon','bigmarlin'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>