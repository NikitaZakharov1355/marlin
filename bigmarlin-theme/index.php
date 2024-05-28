<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bigmarlin
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif; ?>

<section class="news">
            <div class="container">
                <h2 class="news_title text_c"><?php echo get_the_title(); ?></h2>
            </div>
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
