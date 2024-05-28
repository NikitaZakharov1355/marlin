<?php
//enable owl scripts
enqueue_owl_scripts();

$title = get_sub_field('title');
$category = get_sub_field('category');

// Query products based on IDs
$args = array(
    'post_type'      => 'post',
    'category__in'   => $category,
    'posts_per_page' => 3,
);
$query = new WP_Query($args);
?>

<section class="news">
    <div class="container">
        <h2 class="news_title text_c"><?php echo $title; ?></h2>
    </div>
    <div class="news_wrapper">
        <div class="container grid">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    $post_id = get_the_ID();
                    $post_title = get_the_title($post_id);
                    $post_title = strip_tags($post_title);
                    $text = get_the_excerpt($post_id);
                    $thumbnail = get_the_post_thumbnail_url(null, 'large');
                    $post_link = get_permalink($post_id);
            ?>
                    <div class="news_wrapper-item bordered_overlay">
                        <picture class="news_wrapper-item-image">
                            <?php if($thumbnail): ?>
                                <img src="<?php echo $thumbnail; ?>" alt="product">
                            <?php endif; ?>
                        </picture>
                        <div class="news_wrapper-item-descr">
                            <h3 class="news_wrapper-item-title"><?php echo $post_title; ?></h3>
                            <p><?php echo $text; ?></p>
                            <a href="<?php echo $post_link; ?>" class="btn"><?php _e('Read More', 'bigmarlin'); ?></a>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
</section>