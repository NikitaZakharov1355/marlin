<?php
    $title = get_sub_field('title');
    $image = get_sub_field('image');
    $button = get_sub_field('button');
?>

<section class="hero">
    <picture class="image_bg">
        <source srcset="<?php echo $image['sizes']['large']; ?>" media="(max-width: 768px)">
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
    </picture>
    <div class="container bordered text_c">
        <h1 class="hero_title"><?php echo $title; ?></h1>
        <a href="<?php echo $button['url']; ?>" class="btn bold"><?php echo $button['title']; ?></a>
    </div>
</section>