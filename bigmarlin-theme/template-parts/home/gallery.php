<?php
    $gallery = get_sub_field('gallery');
    $gallery_shortcode = get_sub_field('instagram_feed_shortcode');
?>

<section class="gallery">
    <?php if($gallery_shortcode): ?>
        <?php echo do_shortcode($gallery_shortcode);?>
    <?php else: ?>
    <div class="container-fluid flex gallery_slider owl-carousel">
        <?php foreach($gallery as $item): ?>
            <picture class="gallery_item">
                <img src="<?php echo $item['url']; ?>" alt="<?php echo $item['alt']; ?>">
            </picture>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</section>