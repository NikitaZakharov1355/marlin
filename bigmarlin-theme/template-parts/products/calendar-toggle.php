<?php 
	if (get_field('calendars_toggle', get_the_ID()) != 'hide') { //if calendars ON
		if (get_field('calendar_morning_shortcode')) { 

		 get_template_part('template-parts/products/calendar');

		} //if (get_field('calendar_morning_shortcode'))
	}
?>