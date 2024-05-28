<?php
$title = get_field('product_reviews_title', 'option');
$image = get_field('product_reviews_image', 'option');
?>
<section class="reviews">
    <div class="container text_c">
        <h2 class="reviews_title"><?php echo $title; ?></h2>
    </div>
    <div class="reviews_wrapper">
        <picture class="image_bg">
            <source srcset="<?php echo $image['sizes']['medium']; ?>" media="(max-width: 768px)">
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
        </picture>
        <div class="container">
            <?php comments_template(); ?>
        </div>
    </div>
</section>