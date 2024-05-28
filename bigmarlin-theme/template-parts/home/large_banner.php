<?php
    $image = get_sub_field('image');
    $link = get_sub_field('link');
?>

<section class="large_banner">
    <div class="container text_c">
        <a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>">
            <picture>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            </picture>
        </a>
    </div>
</section>