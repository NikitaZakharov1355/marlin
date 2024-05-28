<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bigmarlin
 */

get_header();
$thumbnail_default = get_field('default_post_image','option');
$archive_title = get_the_archive_title();
$clean_title = str_replace('Category: ', '', $archive_title);
?>

<main id="primary" class="site-main">

        <section class="news">
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
            echo '<h1 class="entry_title text_c">' . $clean_title . '</h1>'; 
        ?>
    </div>
</header>            
            <div class="news_wrapper">
                <div class="container grid">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            $post_id = get_the_ID();
                            $post_title = get_the_title($post_id);
                            $post_title = strip_tags($post_title);
                            $text = get_the_excerpt($post_id);
                            $thumbnail = get_the_post_thumbnail_url(null, 'large');
                            $thumbnail_default = get_field('default_post_image','option');
                            $post_link = get_permalink($post_id);
                    ?>
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
                    <?php
                        endwhile;
                    endif;
                    wp_reset_query();
                    ?>
                </div>
            </div>
        </section>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
