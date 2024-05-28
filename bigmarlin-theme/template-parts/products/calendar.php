
    <div class="product-calendar-boats">
        <?php
        $category = get_field('related_category', 'option');
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat', // Specify the product category taxonomy
                    'field'    => 'term_id',     // Specify the field to use (term_id, slug, or name)
                    'terms'    => $category,     // Specify the category IDs
                    'operator' => 'IN',          // Use the 'IN' operator to include products from the specified categories
                ),
            ),
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post(); ?>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php endwhile;
            wp_reset_postdata();
        endif;
        ?>

    </div>
    <div class="product-calendar">
        <div class="product-calendar">
            <div class="container">
                <div id="calendar">
                    <div class="product-calendar_tabs">
                        <button class="product-calendar-tab active" data-calednar="morning">
                            <div>
                                <span><?php echo get_field('calendar_morning_label', 'option'); ?></span>
                                <span><?php echo get_field('calendar_morning_time', 'option'); ?></span>
                            </div>
                        </button>
                        <button class="product-calendar-tab" data-calednar="evening">
                            <div>
                                <span><?php echo get_field('calendar_evening_label', 'option'); ?></span>
                                <span><?php echo get_field('calendar_evening_time', 'option'); ?></span>
                            </div>
                        </button>
                    </div>
                    <div id="morning" class="product-calendar-inner active">
                        <?php echo do_shortcode(get_field('calendar_morning_shortcode')); ?>
                    </div>
                    <div id="evening" class="product-calendar-inner">
                        <?php echo do_shortcode(get_field('calendar_evening_shortcode')); ?>
                    </div>
                    <?php if(is_product()): ?>
                    <div class="product-calendar_status busy">
                        <span class="status"><?php echo __('', 'bigmarlin'); ?></span>
                    <div class="description"><?php echo __('The boat is busy', 'bigmarlin'); ?></div>
                    </div>
                    <div class="product-calendar_status">
                        <span class="status free"><?php echo __('Free', 'bigmarlin'); ?></span>
                        <div class="description"><?php echo __('The boat is available for booking', 'bigmarlin'); ?></div>
                    </div>
                    <?php else: ?>
                    <div class="product-calendar_status busy">
                        <span class="status"><?php echo __('Boat Name', 'bigmarlin'); ?></span>
                        <div class="description"><?php echo __('The boat is busy', 'bigmarlin'); ?></div>
                    </div>
                    <div class="product-calendar_status">
                        <span class="status free"><?php echo __('Boat Name', 'bigmarlin'); ?></span>
                        <div class="description"><?php echo __('The boat is available for booking', 'bigmarlin'); ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
