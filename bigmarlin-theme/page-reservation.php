<?php 
/* Template Name: Reservation Template */
    get_header();
?>

	<?php
		while ( have_posts() ) :
			the_post(); ?>

            <main id="primary" class="site-main reservation">

            <?php 
            get_template_part( 'template-parts/content', 'page' );


			if (isset($_GET) && $_GET['boat']) {
				//Getting boat id from $_GET
				$boat_id = $_GET['boat'];			
			} else  {
				$args = array(
					'post_type' => 'product', // Тип записи товар
					'numberposts' => -1, // Получить все товары в категории
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat', // Таксономия товарных меток
							'field' => 'term_id',
							'terms' => 77, // boats
							'operator' => 'IN'
						)
					)
				);
				
				$items = get_posts( $args );		 
				$boats = [];
				for($i = 0; $i < count($items); $i++) {
					$item = $items[$i];
					$boats[] = $item->ID;
				}
				
				//Getting boats id from website
				//and using firs boat
				$boat_id = $boats[0];
				
			}
			
			get_template_part('template-parts/products/calendar');
		?>
			<div class="booking text_c">
				<div class="container">
					<h2 class="booking_title"><?php echo __('Instant Booking Form', 'bigmarlin'); ?></h2>
					<div class="booking_form">
						<?php //display_checkout_form_shortcode_with_boat_id( $boat_id ); ?>
						<?php echo do_shortcode('[checkout_form]'); ?>
					</div>
				</div>
			</div>
		<? 			
			
            get_template_part('template-parts/reservation/boats');
 

            // get_sidebar();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;?>
            </main><!-- #main -->
			
		<?php endwhile; // End of the loop. ?>

<?php
get_footer();
