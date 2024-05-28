<?php /* Template Name: Boats Template */
get_header();
?>

<?php
while (have_posts()) :
    the_post(); ?>

    <main id="primary" class="site-main">

        <?php
        get_template_part('template-parts/content', 'page'); ?>

        <section class="boats_split">
            <div class="container flex justify_sb">
                <!-- <div class="boats_split-aside">
                    <h3><?php echo __('Sort by: ', 'bigmarlin'); ?></h3>
                    <div class="filter_content flex dir_col" data-cat="<?php echo get_field('category')[0]; ?>">
                        <button class="btn" data-order="price"><?php echo __('Price Low to High','bigmarlin')?></button>
                        <button class="btn" data-order="price-desc"><?php echo __('Price High to Low','bigmarlin')?></button>
                        <button class="btn" data-order="duration"><?php echo __('Duration Low to High','bigmarlin')?></button>
                        <button class="btn" data-order="duration-desc"><?php echo __('Duration Low to High','bigmarlin')?></button>
                    </div>
                </div> -->
                <?php if (get_field('show_section', get_the_ID())) :
                    get_template_part('template-parts/reservation/boats');
                endif;
                ?>
            </div>
        </section>

        <?php
        get_template_part('template-parts/products/products-related');

        ?>
    </main><!-- #main -->

<?php endwhile; // End of the loop. 
?>

<?php
get_footer();
