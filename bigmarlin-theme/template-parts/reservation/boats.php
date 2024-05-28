<?php

$title = get_field('title');
$category = get_field('category');
$bottom_info_text = get_field('bottom_info_text');
$blue_info_text = get_field('blue_info_text');
$payment_image = get_field('payment_image');

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
    <div class="container">
        <?php if($title): ?>
            <h2 class="boats_title text_c"><?php echo $title; ?></h2>
        <?php endif; ?>
        <div class="boats_wrapper">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
            ?>
                <?php get_template_part('template-parts/reservation/boats_single'); ?>
            <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
    <div class="container">
        <div class="boats_text">
            <?php echo $bottom_info_text; ?>
        </div>
        <div class="boats_blue text_c">
            <?php echo $blue_info_text; ?>
            <img src="<?php echo $payment_image['url']; ?>" alt="<?php echo $payment_image['alt']; ?>" />
        </div>
    </div>
</section>