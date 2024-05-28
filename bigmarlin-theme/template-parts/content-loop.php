<?php 
    $post_id = get_the_ID();
    $post_title = get_the_title($post_id);
    $post_title = strip_tags($post_title);
    $text = get_the_excerpt($post_id);
    $thumbnail = get_the_post_thumbnail_url(null, 'large');
    $thumbnail_default = get_field('default_post_image','option');
    $post_link = get_permalink($post_id); ?>
    <div class="news_wrapper-item bordered_overlay">
        <picture class="news_wrapper-item-image">
            <?php if($thumbnail): ?>
                <img src="<?php echo $thumbnail; ?>" alt="product">
            <?php else: ?>
                <img src="<?php echo $thumbnail_default['url']; ?>" alt="<?php echo $thumbnail_default['alt']; ?>">
            <?php endif; ?>
        </picture>
        <div class="news_wrapper-item-descr">
            <h3 class="news_wrapper-item-title"><?php echo $post_title; ?></h3>
            <p><?php echo $text; ?></p>
            <a href="<?php echo $post_link; ?>" class="btn"><?php _e('Read More', 'bigmarlin'); ?></a>
        </div>
    </div>