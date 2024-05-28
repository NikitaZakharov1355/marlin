<?php
    $thumbnail_default = get_field('default_post_image','option');
?>
<header class="entry_header">
    <?php if (get_the_post_thumbnail_url()) : ?>
        <picture class="image_bg">
            <source srcset="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" media="(max-width: 768px)">
            <img src="<?php echo get_the_post_thumbnail_url(null, 'full') ?>" alt="post">
        </picture>
    <?php else : ?>
        <picture class="image_bg">
            <source srcset="<?php echo $thumbnail_default['sizes']['large']; ?>" media="(max-width: 768px)">
            <img src="<?php echo $thumbnail_default['url']; ?>" alt="post">
        </picture>
    <?php endif; ?>
    <div class="container">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry_title">', '</h1>');
        else :
            the_title('<h2 class="entry_title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;
        ?>
    </div>
</header>