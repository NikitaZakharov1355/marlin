<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bigmarlin
 */

get_header();
?>

	<?php
		while ( have_posts() ) :
			the_post(); ?>

		<?php // Check value exists.
		if( have_rows('flexible_content') ):
		    // Loop through rows.
		    while ( have_rows('flexible_content') ) : the_row();
		
		        // Case: Paragraph layout.
		        if( get_row_layout() == 'hero' ):
					get_template_part('template-parts/home/hero');
		        endif;
		        if( get_row_layout() == 'hero_page' ):
					get_template_part('template-parts/home/hero_page');
		        endif;				
								
		        if( get_row_layout() == 'page_content' ):
					get_template_part( 'template-parts/content-page-no-title');
		        endif;			

				if( get_row_layout() == 'page_content_default' ):
					get_template_part( 'template-parts/content');
		        endif;		

		        if( get_row_layout() == 'boats' ):
					get_template_part('template-parts/home/boats');
		        endif;		
				
		        if( get_row_layout() == 'banners' ):
					get_template_part('template-parts/home/banners');
		        endif;	
				
		        if( get_row_layout() == 'faq' ):
					get_template_part('template-parts/home/faq');
		        endif;				
				
		        if( get_row_layout() == 'text_and_video' ):
					get_template_part('template-parts/home/text-video');
		        endif;		
				
		        if( get_row_layout() == 'news' ):
					get_template_part('template-parts/home/news');
		        endif;		
				
		        if( get_row_layout() == 'large_banner' ):
					get_template_part('template-parts/home/large_banner');
		        endif;	

				if( get_row_layout() == 'reviews' ):
					get_template_part('template-parts/home/reviews');
		        endif;		

				if( get_row_layout() == 'gallery' ):
					get_template_part('template-parts/home/gallery');
		        endif;					
				

		    endwhile;

			if ( comments_open() || get_comments_number() ) :
				get_template_part('template-parts/products/reviews');
			endif;

		else: ?>

			<main id="primary" class="site-main">

			<?php 
			get_template_part( 'template-parts/content', 'page' );

			if(get_field('show_section',get_the_ID())):
				get_template_part('template-parts/reservation/boats');
			endif;

			// get_sidebar();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;?>
			</main><!-- #main -->
			
		<?php endif;

		endwhile; // End of the loop.
		?>

<?php
get_footer();
