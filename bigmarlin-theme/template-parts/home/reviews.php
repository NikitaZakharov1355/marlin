<?php 
    $title = get_sub_field('title');
    $shortcode = get_sub_field('shortcode');
    $image = get_sub_field('image');
?>

<section class="reviews">
    <picture class="image_bg">
        <source srcset="<?php echo $image['url']; ?>" media="(max-width: 768px)">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
    </picture>
    <div class="container text_c">
        <h2 class="reviews_title">
            <?php echo $title; ?>
        </h2>
        <?php echo do_shortcode($shortcode); ?>
    </div>
</section>