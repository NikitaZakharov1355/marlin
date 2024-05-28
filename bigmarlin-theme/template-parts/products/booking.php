<?php 
	if (get_field('old_booking_form_toggle') == 'show') { //if calendars ON
?>
	<div class="booking text_c">
		<div class="container">
			<h2 class="booking_title"><?php echo __('Instant Booking Form', 'bigmarlin'); ?></h2>
			<div class="booking_form">
				<?php echo do_shortcode('[checkout_form]'); ?>
			</div>
		</div>
	</div>
<?php } ?>	