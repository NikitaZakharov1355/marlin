<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bigmarlin
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-86480079-1"></script>
	<script src="https://www.w3counter.com/tracker.js?id=129366"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-86480079-1');
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-953412824"></script>
	<!-- Event snippet for Begin checkout conversion page --> <script> gtag('event', 'conversion', {'send_to': 'AW-953412824/0R-iCMnr7boYENjZz8YD'}); </script> 
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-953412824');
</script>
<script type='application/ld+json'>
{
  "@context": "http://www.schema.org",
  "@type": "SportsActivityLocation",
  "name": "Big Marlin Charters Punta Cana",
  "url": "https://bigmarlinpuntacana.com",
  "sameAs": [
     "https://www.facebook.com/BigMarlinCharters",
     "https://twitter.com/bluebigmarlin",
     "https://www.youtube.com/channel/UCQu16xUSpePg0f27REymbEg",
	 "https://www.instagram.com/bigmarlincharters"
  ],
  "logo": "https://www.bigmarlinpuntacana.com/images/logo.png",
  "priceRange": "$$$",
  "image": "https://www.bigmarlinpuntacana.com/images/big-marlin-charter-fish.jpg",
  "description": "Private Fishing Charters in Punta Cana. Deep Sea Fishing Dominican Repiblic. Catch Blue Marlin and White Marlin, Mahi Mahi (Dorado), YellowFin Tuna, Barracuda, Wahoo, Sailfish",
  "address": {
     "@type": "PostalAddress",
     "streetAddress": "Calle 1",
     "addressLocality": "Punta Cana",
     "addressRegion": "La Altagracia",
     "postalCode": "23000",
     "addressCountry": "Dominican Republic"
  },
  "geo": {
     "@type": "GeoCoordinates",
     "latitude": "18.670545",
     "longitude": "68.401139"
  },
  "hasMap": "https://g.page/BigMarlinCharters?share",
   "openingHours": "Mo 07:00-18:00 Tu 07:00-18:00 We 07:00-18:00 Th 07:00-18:00 Fr 07:00-18:00 Sa 07:00-18:00 Su 07:30-16:30",
  "telephone": "+1(849)4099977"
}
</script>
<meta name="keywords" content="punta cana fishing charters, deep sea fishing, dominican republic, boats, marlin" />
<meta name="author" content="Big Marlin Charters S.R.L.">	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrapper">
		<button class="toggle_menu"></button>
		<header class="header">
			<div class="container flex justify_sb header_top">
				<a class="logo" href="<?php echo home_url(); ?>" title="Big Marlin Charters Punta Cana">
					<img src="<?php echo get_field('header_logo', 'option')['url']; ?>" alt="<?php echo get_field('header_logo', 'option')['alt']; ?>">
				</a>
				<a href="https://bigmarlinpuntacana.com/checkout/" class="btn visible_xs" title="Reservation">Reservation</a>
<div class="cart-indicator">
    <?php
    $current_user_cart = WC()->cart->get_cart();
    $product_count = 0;

    foreach ($current_user_cart as $cart_item_key => $cart_item) {
        $product_count += $cart_item['quantity'];
    }
    ?>

    <?php if ($product_count > 0) : ?>
        <span class="cart-indicator-dot">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 256 256" xml:space="preserve">
                <defs></defs>
                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                    <circle cx="45" cy="45" r="45" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(40,201,55); fill-rule: nonzero; opacity: 1;" transform="matrix(1 0 0 1 0 0)"/>
                    <path d="M 38.478 64.5 c -0.01 0 -0.02 0 -0.029 0 c -1.3 -0.009 -2.533 -0.579 -3.381 -1.563 L 21.59 47.284 c -1.622 -1.883 -1.41 -4.725 0.474 -6.347 c 1.884 -1.621 4.725 -1.409 6.347 0.474 l 10.112 11.744 L 61.629 27.02 c 1.645 -1.862 4.489 -2.037 6.352 -0.391 c 1.862 1.646 2.037 4.49 0.391 6.352 l -26.521 30 C 40.995 63.947 39.767 64.5 38.478 64.5 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1;" transform="matrix(1 0 0 1 0 0)" stroke-linecap="round"/>
                </g>
            </svg>
        </span>
    <?php endif; ?>
    
    <a href="https://bigmarlinpuntacana.com/checkout/" class="cart-icon-link">Cart</a>
</div>
				<div class="hidden_xs">
					<div class="flex align_c justify_sb header_top-wrapper">
						<div class="header_title bold align_c">
							<?php echo get_field('header_title', 'option'); ?>
						</div>
						<div class="header_socials flex">
							<?php foreach (get_field('socials', 'option') as $item) : ?>
								<a target="_blank" href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>">
									<div class="header_socials-icon">
										<img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
									</div>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="flex justify_sb header_bottom-wrapper">
						<div class="header_call flex">
							<img src="<?php echo get_field('call_info_image', 'option')['url']; ?>" alt="<?php echo get_field('call_info_image', 'option')['alt']; ?>">
							<div>
								<div class="bold"><?php echo get_field('call_info_title', 'option'); ?></div>
								<div class="semibold">
									<a href="<?php echo get_field('call_info_link', 'option')['url']; ?>" title="<?php echo get_field('call_info_link', 'option')['title']; ?>">
										<?php echo get_field('call_info_link', 'option')['title']; ?>
									</a>
								</div>
							</div>
						</div>
						<div class="header_info bold flex dir_col">
							<?php foreach (get_field('call_info_items', 'option') as $item) : ?>
								<a href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>">
									<div class="header_info-icon">
										<img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>">
									</div>
									<?php echo $item['link']['title']; ?>
								</a>
							<?php endforeach; ?>
						</div>
						<div class="header_info bold flex dir_col">
							<?php foreach (get_field('call_info_right_items', 'option') as $item) : ?>
								<a target="_blank" href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>">
									<div class="header_info-icon">
										<img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
									</div>
									<?php echo $item['link']['title']; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="container">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container' => 'nav',
						'container_class' => 'header_menu'
					)
				);
				?>
				<?php
				$current_user_cart = WC()->cart->get_cart();

				$product_count = 0;

				foreach ($current_user_cart as $cart_item_key => $cart_item) {
					$product_count += $cart_item['quantity'];
				}

				?>
				<?php if ($product_count > 0) : ?>
					<div class="product-number">
						<img src="<?php echo get_template_directory_uri(); ?>/app/img/check-icon.svg" alt="check-icon">
					</div>
				<?php endif; ?>
			</div>
		</header>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container' => 'nav',
					'container_class' => 'mobile_menu'
				)
			);
			?>