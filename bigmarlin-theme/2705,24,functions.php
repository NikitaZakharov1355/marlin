<?php

/**
 * Bigmarlin functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bigmarlin
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.8');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bigmarlin_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Bigmarlin, use a find and replace
		* to change 'bigmarlin' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('bigmarlin', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'bigmarlin'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'bigmarlin_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'bigmarlin_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bigmarlin_content_width()
{
    $GLOBALS['content_width'] = apply_filters('bigmarlin_content_width', 640);
}
add_action('after_setup_theme', 'bigmarlin_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bigmarlin_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'bigmarlin'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'bigmarlin'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'bigmarlin_widgets_init');

function mytheme_move_jquery_to_footer()
{
    wp_scripts()->add_data('jquery', 'group', 1);
    wp_scripts()->add_data('jquery-core', 'group', 1);
    wp_scripts()->add_data('jquery-migrate', 'group', 1);
}

add_action('wp_enqueue_scripts', 'mytheme_move_jquery_to_footer');

/**
 * Enqueue scripts and styles.
 */
function bigmarlin_scripts()
{
    wp_enqueue_style('bigmarlin-style', get_stylesheet_uri(), array(), _S_VERSION);
    // wp_style_add_data( 'bigmarlin-style', 'rtl', 'replace' );

    wp_enqueue_style('bigmarlin-custom-css', get_template_directory_uri() . '/app/css/main.min.css', array(), _S_VERSION);

    // wp_register_script( 'masonry-js', get_template_directory_uri() . '/app/libs/masonry/dist/masonry.pkgd.min.js', array('jquery'),  _S_VERSION, true );
    // wp_enqueue_script( 'masonry-js' );

	//if (is_page(1654)) {} else {
		//wp_enqueue_script('bigmarlin-custom-js', get_template_directory_uri() . '/app/js/scripts.min.js', array('jquery'),  _S_VERSION, ['strategy'  => 'async', 'in_footer' => true,]);
		wp_enqueue_script('bigmarlin-custom-js', get_template_directory_uri() . '/app/js/thenew-scripts-932.js', array('jquery'),  _S_VERSION, ['strategy'  => 'async', 'in_footer' => true,]);
	//}

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
	 
	
	/* my css */	
	wp_enqueue_style('bigmarlin-custom-css', get_template_directory_uri() . '/app/css/customz.css', array(), _S_VERSION);	
	/* my ajax */	
	//wp_enqueue_script('bigmarlin-customіzers', get_template_directory_uri() . '/app/js/custom-boats.js', array('jquery'),  _S_VERSION, ['strategy'  => 'async', 'in_footer' => true,]);
}

add_action('wp_enqueue_scripts', 'bigmarlin_scripts');

function enqueue_owl_scripts()
{
    wp_enqueue_style('owl-css', get_template_directory_uri() . '/app/libs/owl/dist/assets/owl.carousel.min.css', array(), _S_VERSION);
    wp_register_script('owl-js', get_template_directory_uri() . '/app/libs/owl/dist/owl.carousel.min.js', array('jquery'),  _S_VERSION, true);
    wp_enqueue_script('owl-js');
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}

function remove_woocommerce_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('init', 'remove_woocommerce_breadcrumbs');

// Remove WooCommerce product title from single product page
function remove_woocommerce_product_title()
{
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
}
add_action('woocommerce_single_product_summary', 'remove_woocommerce_product_title', 1);


//ajax filters

add_action('wp_ajax_filter_boats', 'filter_boats');
add_action('wp_ajax_nopriv_filter_boats', 'filter_boats');


function filter_boats()
{
    // Get order attribute from AJAX request
    $order = isset($_POST['order']) ? $_POST['order'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    if ($order == 'price') {
        $order = 'DESC';
    } elseif ($order == 'price-desc') {
        $order = 'ASC';
    }

    // Modify the query based on the order attribute
    $category_arr = [$category];
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value_num',
        'order'          => $order,
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat', // Specify the product category taxonomy
                'field'    => 'term_id',     // Specify the field to use (term_id, slug, or name)
                'terms'    => $category_arr, // Specify the category IDs
                'operator' => 'IN',          // Use the 'IN' operator to include products from the specified categories
            ),
        ),
    );

    $query = new WP_Query($args);

    // Output HTML for filtered products
    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            global $product;
            // If product is variable, get first variation and its price
            if ($product->is_type('variable')) {
                $variation_ids = $product->get_children();
                $first_variation_id = reset($variation_ids);
                $first_variation = wc_get_product($first_variation_id);
                $price = $first_variation->get_price();
                // Output the first variation's product HTML
                get_template_part('template-parts/reservation/boats_single');
            } else {
                // Output simple product
                get_template_part('template-parts/reservation/boats_single');
            }
        endwhile;
    endif;

    wp_reset_query();

    // Send the filtered products HTML back in the AJAX response
    echo ob_get_clean();
    wp_die();
}

function update_time_selection_price_single()
{
    if (!function_exists('WC')) {
        return;
    }
	
	// echo '<pre>';
		// print_r($_POST);
	// echo '</pre>';

    // Get WooCommerce global object
    global $woocommerce;
	//получаем id доп поля (снорклинг) 
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
	
	//получаем чекнутость доп поля (снорклинг) 
    $isChecked = $_POST['isChecked'];

	//получаем id активной вариации
    $product_boat_id = isset($_POST['product_boat_id']) ? intval($_POST['product_boat_id']) : 0;
    $total = 0;
	
    if ($isChecked == 'true') {
        $isChecked = true;
    } else {
        $isChecked = false;
    }

    $cart = $woocommerce->cart->get_cart();

    foreach ($cart as $cart_item_key => $cart_item) {
        if ($cart_item['variation_id'] == $product_boat_id) {
            $vproduct = wc_get_product($product_boat_id);
            $variation_price = $vproduct->get_price();
            $total = $total + $variation_price;
        }
    }

    $vproduct = wc_get_product($product_id);
    $variation_price = $vproduct->get_price();

    foreach ($cart as $cart_item_key => $cart_item) {
        if ($isChecked == false) {
            if ($cart_item['variation_id'] == $product_id) {
                $woocommerce->cart->remove_cart_item($cart_item_key);
            }
        }
    }

    if ($isChecked) {
        $woocommerce->cart->add_to_cart($product_id);
        $total = $total + $variation_price;
    }


    // Calculate the total price

    echo '$' . $total;

    // Always die after sending a response
    wp_die();
}


add_action('wp_ajax_update_cart_total', 'update_cart_total');
add_action('wp_ajax_nopriv_update_cart_total', 'update_cart_total');
function update_cart_total() 
{
    // Ensure WooCommerce is initialized
    if (!function_exists('WC')) {
        return;
    }

    // Get WooCommerce global object
    global $woocommerce;
	
	$total = 0;
	$woocommerce->cart->empty_cart();
	
	echo '$' . $total;
}


add_action('wp_ajax_update_time_selection_price_single', 'update_time_selection_price_single');
add_action('wp_ajax_nopriv_update_time_selection_price_single', 'update_time_selection_price_single');


function update_time_selection_price()
{
    // Ensure WooCommerce is initialized
    if (!function_exists('WC')) {
        return;
    }

    // Get WooCommerce global object
    global $woocommerce;

	// echo "<pre>";
		// print_r($_POST);
	// echo "</pre>";

	//получаем id текущаей вариации
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
	
	//получаем массив, который содержит нечекнутые вариации
    $remove_product_ids = isset($_POST['remove_product_ids']) ? $_POST['remove_product_ids'] : array();
	
	//получаем id лодки из заголовка формы
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
	
	//получаем флажок снорклиннка (чекнутый)
    $isChecked = $_POST['isChecked'];
    $total = 0;
    if ($isChecked == 'true') {
        $isChecked = true;
    } else {
        $isChecked = false;
    }

    // Remove products from the cart
    foreach ($remove_product_ids as $remove_product_id) {
        $cart = $woocommerce->cart->get_cart();
        foreach ($cart as $cart_item_key => $cart_item) {

            if ($cart_item['variation_id'] == $remove_product_id) {
                $woocommerce->cart->remove_cart_item($cart_item_key);
                break;
            }

            if ($isChecked == false && $cart_item['product_id'] == $remove_product_id) {
                $woocommerce->cart->remove_cart_item($cart_item_key);
                break;
            }
        }
    }

    $vproduct = wc_get_product(get_field('snorkling_product', $post_id)->ID);
    $variation_price = $vproduct->get_price();

	//проверяем    
	//Если один из товаров корзины - снорклинг
	//то и его цену сумируем
	foreach ($cart as $cart_item_key => $cart_item) {
        if ($cart_item['variation_id'] == get_field('snorkling_product', $post_id)->ID) {
            $total = $total + $variation_price;
        }
    }

    // Add the new product to the cart
	// Если чекбокс снорклинга чекнутый 
    if ($isChecked) {
        if ($product_id != 0) {
            $woocommerce->cart->add_to_cart($product_id);
            $vproduct = wc_get_product($product_id);
            $variation_price = $vproduct->get_price();
			
            $total = $total + $variation_price;
        }
    }

    echo '$' . $total;

    // Always die after sending a response
    wp_die();
}
// Register the AJAX action
add_action('wp_ajax_update_time_selection_price', 'update_time_selection_price');
add_action('wp_ajax_nopriv_update_time_selection_price', 'update_time_selection_price');

//checkout form

// Add checkout form shortcode
//Основная функция бронирования лодок через форму
function display_checkout_form_shortcode()
{
    // Start output buffering
    ob_start();

    // Check if the product is in stock	
	
    global $product, $woocommerce;
	
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
	$boats = []; //лодки (номера)	 
	$boatsSlugs = []; //лодки (номера и слаги) 
	$boatsList = []; //лодки (номера и много дата-опций)
	$boatsListSnorkling = [];
	for($i = 0; $i < count($items); $i++) {
		$item = $items[$i];
		$boats[] = $item->ID;
		
		$item_lowercase = strtolower($item->post_title);		
		$item_slug = str_replace(' ', '-', $item_lowercase);
		$boatsSlugs[$item->ID] = $item_slug;
		
		$boatsList[$item->ID] = $item->post_title;

		$snorkling_id = get_field('snorkling_product', $item->ID)->ID; //id снорклингово допа
		$product_id = get_field('snorkling_product', 'option');
		$product_snorkling = wc_get_product($product_id);
		$product_snorkling_description = $product_snorkling->get_short_description(); //описание снорклингово допа
		$product_snorkling_price = $product_snorkling->get_price();  //цена снорклингово допа


		//Определяем вместимость каждой лодки
		$product = wc_get_product($item->ID);
		if ($product) {
			$attributes = $product->get_attributes();

			foreach ($attributes as $key => $attribute) {
				$name = $attribute->get_name();
				$options = $attribute->get_options();
				
				if ($name == 'Capacity') {
					$amount_people_str = $options[0];
					//Получаем $amount_people_str в виде числа
					$boat_capacity = preg_replace('/\D/', '', $amount_people_str);
				}
			}
		} else {
			$boat_capacity = 0;
		}

		$boatsListSnorkling[$item->ID] = array(
			'boat_capacity' => $boat_capacity, 
			'snorklig_id' => get_field('snorkling_product', $item->ID)->ID, 
			'snorklig_title' => $product_snorkling_description,
			'snorklig_price' => $product_snorkling_price
		);
	}
	
	
	if (is_product()) {
		$boat_id = get_the_ID();
	} else {
		if (isset($_GET) && $_GET['boat']) {
			//Getting boat id from $_GET			
			$boat_slug = $_GET['boat'];		
			$found_key = array_search($boat_slug, $boatsSlugs);						
			$boat_id = $found_key;			
			
		} else  {
			//Getting boats id from website
			//and using firs boat
			$boat_id = $boats[0];
		}	
	}

	$product = wc_get_product($boat_id);
	
    //if (is_product() && is_single() && $product->is_in_stock()) {
    if ($product->is_in_stock()) {
        // Output the checkout form
		
        if ($product->is_type('variable')) {
            // If it's a variable product, get the variation ID
            $variations = $product->get_children();
            $total = 0;
            $var_arr = [];
            foreach ($variations as $variation) {
                $vproduct = wc_get_product($variation);
                $var_arr[$vproduct->get_description()] = __($vproduct->get_description(), 'your-text-domain');
            }

            $transfer_arr = [];

            foreach (get_field('pickup_transfer', 'option') as $item) :
                $transfer_arr[$item['value']] = $item['value'];
            endforeach;

            $product_id = get_field('snorkling_product', 'option');
            $product_snorkling = wc_get_product($product_id);

            $short_description = $product_snorkling->get_short_description();

            $attributes = $product->get_attributes();
            foreach ($attributes as $key => $attribute) :
                $name = $attribute->get_name();
                $options = $attribute->get_options();
                if ($name == 'Capacity') :
                    $amount_people_str = $options[0];
                endif;
            endforeach;

            $matches = [];
            preg_match('/\d+/', $amount_people_str, $matches);
            $amount_people_max = intval($matches[0]);
            $amount_people_arr = [];
            for ($i = 1; $i <= $amount_people_max; $i++) {
                $amount_people_arr[$i] = $i;
            }
        }

		
        echo '<form data-post-id="' . $boat_id . '" class="checkout-form" method="post" action="' . esc_url(wc_get_checkout_url()) . '">';
        // Add fields you want in the form
        echo '<div class="col_50">';
        echo '<label for="billing_first_name">' . __('Name:*', 'bigmarlin') . '</label>';
        woocommerce_form_field('billing_first_name', array(
            'type'        => 'text',
            'class'       => array('form-row-first'),
            'required'    => TRUE,
        ), '');
        echo '</div>';

        echo '<div class="col_50">';
        echo '<label for="billing_email">' . __('Email:*', 'your-text-domain') . '</label>';
        woocommerce_form_field('billing_email', array(
            'type'        => 'email',
            'class'       => array('form-row-first'),
            'required'    => true,
        ), '');
        echo '</div>';
	?>
		
		<div class="col_50">
			<label for="billing_phone"><?php _e('Phone:*', 'your-text-domain'); ?> </label>
			<?php 
				woocommerce_form_field('billing_phone', array(
					'type'        => 'tel',
					'class'       => array('form-row-first'),
					'required'    => true,
					'custom_attributes' => array('required' => 'required')
				), '');
			?>
		</div>			
		
	<?php
        echo '<div class="col_50 text_l">';
        echo '<label for="billing_boath">' . __('Boat Selected:', 'your-text-domain') . '</label>';
        echo '<div class="selected selected-boat">' . get_the_title( $boat_id ) . '</div>';
        echo '</div>';
        
	?>	
	
		<div class="col_50">
			<label for="billing_boath_selector"><?php _e('Boat Selected:', 'your-text-domain'); ?></label>
			<?php 
				
			
				woocommerce_form_field(
				'billing_boath_selector', 
					array(
						'type'        => 'select',
						'class'       => array('form-row-last'),
						'required'    => true,
						'options'     => $boatsList,
						'default' => $boat_id,
						'custom_attributes' => array('required' => 'required')
					), 
				);
			?>	
		</div>		

	<?php // Конвертируем PHP массив в JSON
		$boatsListSnorklingJson = json_encode($boatsListSnorkling); 
	?>	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Получаем JSON данные из PHP
			var boatsListSnorkling = <?php echo $boatsListSnorklingJson; ?>;

			// Проход по каждому <option> и добавление атрибутов
			var options = document.querySelectorAll('#billing_boath_selector option');
			options.forEach(function(option) {
				var value = option.value; // Получение значения <option>
				if (boatsListSnorkling[value]) {
					var boat_capacity = boatsListSnorkling[value].boat_capacity;
					var snorklig_id = boatsListSnorkling[value].snorklig_id;
					var snorklig_price = boatsListSnorkling[value].snorklig_price;
					var snorklig_title = boatsListSnorkling[value].snorklig_title;
					option.setAttribute('data-boat-capacity', boat_capacity);
					option.setAttribute('data-snorklig-id', snorklig_id);
					option.setAttribute('data-snorklig-price', snorklig_price);
					option.setAttribute('data-snorklig-title', snorklig_title);
				}
			});
		});
	</script>
	<?php	
		// Custom field for amount of people
        echo '<div class="col_50">';	
        echo '<label for="amount_people">' . __('Amount of People:*', 'your-text-domain') . '</label>';
        woocommerce_form_field('amount_people', array(
            'type'        => 'select',
            'class'       => array('form-row-last'),
            'required'    => true,
            'options'     => $amount_people_arr,			
        ), '');
        echo '</div>';
	?>	
	
	<div class="col_100 choice_fields">
		<label><?php _e('Select duration:*', 'your-text-domain'); ?></label>
		<p class="time_selection">
			<span class="woocommerce-input-wrapper">
				<input class="boat_name-field" type="text" name="boat_name" required />
		<?php 
			$show = "";

			foreach ($boats as $kater_id) {			
				$product = wc_get_product($kater_id);
				if($product->is_type('variable')) {
				// If it's a variable product, get the variation ID
				$variations = $product->get_children();
			
					if ($variations) { 
						$cart = $woocommerce->cart->get_cart();
						foreach ($variations as $variation) {
							$vproduct = wc_get_product($variation);
							$isActive = '';
							$variation_price = 0;  // Инициализация переменной
							foreach ($cart as $cart_item_key => $cart_item) {
								if ($cart_item['variation_id'] == $vproduct->get_id()) {
									$isActive = 'active';
									$variation_price = $vproduct->get_price();
									$total = $total + $variation_price;
								}
							}
						?>
							<label class="radio <?php echo $show.' '.$isActive; ?>" data-boat-id="<?php echo $kater_id; ?>" data-id="<?php echo $vproduct->get_id(); ?>"  data-price="<?php echo $vproduct->get_price(); ?>">
								<?php echo $vproduct->get_description(); ?>
							</label>
						<?php 
							}
						}
					}
				}
			?>
			</span>
		</p>
	
	</div>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Найти все элементы с атрибутом data-boat-id равным 25
			var elements = document.querySelectorAll('[data-boat-id="<?php echo $boat_id; ?>"]');

			// Добавить класс vari_show к найденным элементам
			elements.forEach(function(element) {
				element.classList.add("vari_show");
			});
		});
	</script>

	<?php
        echo '<div class="col_50 pickup_fields">';
        // Date field
        echo '<label for="booking_date">' . __('Preferred Date:*', 'your-text-domain') . '</label>';
        woocommerce_form_field('booking_date', array(
            'type'        => 'date',
            'class'       => array('form-row-wide'),
            'required'    => true,
            'placeholder' => 'DD-MM-YYYY',
        ), '');

        echo '<div class="radio-buttons__wrap"><label for="pick_up_transfer">' . __('I would like a transfer:*', 'your-text-domain') . '</label>';
        woocommerce_form_field('pick_up_transfer-radio', array(
            'type'        => 'radio',
            'class'       => array('form-row-wide', 'radio_buttons'),
            'required'    => true,
            'options'     =>  ['Yes', 'No']
            // 'options'     => $transfer_arr,
        ), '');

        woocommerce_form_field('pick_up_transfer', array(
            'type'        => 'text',
            'class'       => array('form-row-wide', 'radio_buttons-value'),
            'required'    => true,
            // 'options'     =>  ['Yes','No']
            // 'options'     => $transfer_arr,
        ), '');

        echo '</div></div>';
        echo '<div class="col_50">';
        // Message field
        echo '<label for="message">' . __('Message:', 'your-text-domain') . '</label>';
        woocommerce_form_field('message', array(
            'type'        => 'textarea',
            'class'       => array('form-row-wide'),
            'required'    => false,
        ), '');
        echo '</div>';
        echo '<div class="col_50">';

        echo '<p id="snorkling_field_product" class="additional_field">';
        $cart = $woocommerce->cart->get_cart();
        $vproduct = wc_get_product(get_field('snorkling_product', $boat_id)->ID);
        $variation_price = $vproduct->get_price();
        $isActive = '';
        foreach ($cart as $cart_item_key => $cart_item) {
            if ($cart_item['variation_id'] == get_field('snorkling_product', $boat_id)->ID) {
                $isActive = 'checked';
                $total = $total + $variation_price;
            }
        }
        echo '<span class="woocommerce-input-wrapper">';
        echo '<label class="checkbox checkbox-title ' . $isActive . '" data-id="' . get_field('snorkling_product', $boat_id)->ID . '"' .
			' data-title="' .$short_description . '" data-price="'. $variation_price .'"> <span class="optional"></span>'
            . '<span class="chexbox-option-title">'.$short_description .'</span>'.
            '</label>';
        echo '</span>';
        echo '</p>';

        echo '<div class="tooltip">
		<a target="_blank" href="' . get_field('snorkling_product_link', 'option')['url'] . '">' . get_field('snorkling_product_link', 'option')['title'] . '</a>';
        echo '</div>';

        echo '</div>';
        // Display Order Total
        echo '<div class="col_100 text_c total">';
        echo '<label>Order Total: <span class="the-order-total">$' . $total . '</span></label>';
        echo '</div>';
        // Output the submit button
		?>
        <div class="col_100 text_c">
			<button type="submit" class="selecting adv-booking__btn reserve-btn"><?php _e('Advanced booking', 'bigmarlin'); ?> </button>
			<button type="submit" class="btn  reserve-btn"><?php _e('Add to cart', 'bigmarlin'); ?> </button>
        </div>
		
		<div class="form__inner-wrap">
			<div class="form__inner-wrap__inner">
			</div>		
		</div><!-- form__inner-wrap -->
		
	</form>
		
<?php
		echo do_shortcode('[contact-form-7 id="c3962c6" html_class="hidden_form"]');


    } // if ($product->is_in_stock()) 

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('checkout_form', 'display_checkout_form_shortcode');


add_action('woocommerce_checkout_create_order', 'save_custom_checkout_fields');
function save_custom_checkout_fields($order)
{
    $post_data = filter_input_array(INPUT_POST);

    if (isset($post_data['pick_up_transfer'])) {
        $order->update_meta_data('_billing_pick_up_transfer', sanitize_text_field($post_data['pick_up_transfer']));
    }

    if (isset($post_data['amount_people'])) {
        $order->update_meta_data('_billing_amount_people', intval($post_data['amount_people']));
    }

    if (isset($post_data['booking_date'])) {
        $order->update_meta_data('_billing_booking_date', sanitize_text_field($post_data['booking_date']));
    }

    if (isset($post_data['message'])) {
        $order->update_meta_data('_billing_message', sanitize_text_field($post_data['message']));
    }

    // if (isset($post_data['size'])) {
    //     $order->update_meta_data('_billing_size', sanitize_text_field($post_data['size']));
    // }
}

// Display custom fields on order details page
add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_order_fields', 10, 1);
function display_custom_order_fields($order)
{
    $billing_pick_up_transfer = $order->get_meta('_billing_pick_up_transfer');
    $amount_people = $order->get_meta('_billing_amount_people');
    $booking_date = $order->get_meta('_billing_booking_date');
    $message = $order->get_meta('_billing_message');
    // $size = $order->get_meta('_billing_size');

    echo '<div class="order_data_column">';

    // Display Pick Up Transfer
    if (!empty($billing_pick_up_transfer)) {
        echo '<p><strong>' . __('I would like a transfer', 'woocommerce') . '</strong>: ' . esc_html($billing_pick_up_transfer) . '</p>';
    }

    // Display Amount of People
    if (!empty($amount_people)) {
        echo '<p><strong>' . __('Amount of People', 'woocommerce') . '</strong>: ' . esc_html($amount_people) . '</p>';
    }

    // Display Booking Date
    if (!empty($booking_date)) {
        echo '<p><strong>' . __('Booking Date', 'woocommerce') . '</strong>: ' . esc_html($booking_date) . '</p>';
    }

    // Display Message
    if (!empty($message)) {
        echo '<p><strong>' . __('Message', 'woocommerce') . '</strong>: ' . esc_html($message) . '</p>';
    }

    // Size
    // if (!empty($size)) {
    //     echo '<p><strong>' . __('Size', 'woocommerce') . '</strong>: ' . esc_html($size) . '</p>';
    // }

    echo '</div>';
}

add_filter('woocommerce_checkout_fields', 'add_custom_checkout_fields', 10);

// function add_custom_checkout_fields($fields) {

//     unset($fields['billing']['billing_last_name']); 
//     unset($fields['billing']['billing_company']); 
//     unset($fields['billing']['billing_state']);
//     unset($fields['billing']['billing_address_1']);
//     unset($fields['billing']['billing_address_2']);
//     unset($fields['billing']['billing_city']);
//     unset($fields['billing']['billing_postcode']);
//     unset($fields['billing']['billing_country']);


//     $fields['billing']['pick_up_transfer'] = array(
//         'type'        => 'text',
//         'class'       => array('form-row-wide'),
//         'label'       => __('I would like a transfer:', 'woocommerce'),
//         // 'required'    => true,
//         // 'options'     => $transfer_arr,
//         'value'       => sanitize_text_field( $_POST['pick_up_transfer'] )
//     );


//         if ( ! empty( $_POST['billing_first_name'] ) ) {
//             $fields['billing']['billing_first_name']['value'] = sanitize_text_field( $_POST['billing_first_name'] );
//         }


//         // Prefill billing email if available
//         if ( ! empty( $_POST['billing_email'] ) ) {
//             $email_value = sanitize_email( $_POST['billing_email'] );
//         } else{
//             $email_value = '';
//         }

//         $fields['billing']['billing_email'] = array(
//             'label' => __( 'Email', 'woocommerce' ), // Add label
//             'type' => 'email',
//             'required' => true,
//             'class' => array('form-row-wide'),
//             // 'autocomplete' => 'email username',
//             'priority' => 110,
//             'value' => $email_value,
//         );

//         // Prefill amount of people if available
//         if ( ! empty( $_POST['amount_people'] ) ) {
//             $fields['billing']['amount_people'] = intval( $_POST['amount_people'] );
//         }

//         // Prefill booking date if available
//         if ( ! empty( $_POST['booking_date'] ) ) {
//             $fields['billing']['booking_date'] = sanitize_text_field( $_POST['booking_date'] );
//         }

//         // Prefill message if available
//         if ( ! empty( $_POST['message'] ) ) {        
//             $fields['billing']['message'] = sanitize_text_field( $_POST['message'] );
//         }
//         // prefill size
//         if ( ! empty( $_POST['size'] ) ) {        
//             $fields['billing']['size'] = sanitize_text_field( $_POST['size'] );
//         }


//     return $fields;
// }

function add_custom_checkout_fields($fields)
{
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    // $transfer_arr = [];
    // foreach(get_field('pickup_transfer','option') as $item):
    //     $transfer_arr[$item['value']] = $item['value'];
    // endforeach;
    // $transfer = '';
    // Prefill pick up transfer if available
    if (!empty($_POST['pick_up_transfer'])) {
        WC()->session->set('pick_up_transfer', sanitize_text_field($_POST['pick_up_transfer']));
    }
    if (WC()->session->get('pick_up_transfer')) {
        $val = WC()->session->get('pick_up_transfer');
    } else {
        $val = '';
    }


    $fields['billing']['pick_up_transfer'] = array(
        'type'        => 'text',
        'class'       => array('form-row-wide'),
        'label'       => __('I would like a transfer:', 'woocommerce'),
        // 'required'    => true,
        // 'options'     => $transfer_arr,
        'value'       => $val
    );
    if (!empty($_POST['billing_first_name'])) {
        WC()->session->set('billing_first_name', sanitize_text_field($_POST['billing_first_name']));
    }
    if (WC()->session->get('billing_first_name')) {
        $val = WC()->session->get('billing_first_name');
    } else {
        $val = '';
    }
    $fields['billing']['billing_first_name']['value'] = $val;

    // Prefill billing email if available
    if (!empty($_POST['billing_email'])) {
        WC()->session->set('billing_email', sanitize_email($_POST['billing_email']));
    }
    if (WC()->session->get('billing_email')) {
        $val = WC()->session->get('billing_email');
    } else {
        $val = '';
    }
    $fields['billing']['billing_email'] = array(
        'label' => __('Email', 'woocommerce'), // Add label
        'type' => 'email',
        'required' => true,
        'class' => array('form-row-wide'),
        // 'autocomplete' => 'email username',
        'value' => $val,
    );

    // Prefill billing email if available
    if (!empty($_POST['billing_phone'])) {
        WC()->session->set('billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
    if (WC()->session->get('billing_phone')) {
        $val = WC()->session->get('billing_phone');
    } else {
        $val = '';
    }
    $fields['billing']['billing_phone'] = array(
        'label' => __('Phone', 'woocommerce'), // Add label
        'type' => 'tel',
        'required' => true,
        'class' => array('form-row-wide'),
        // 'autocomplete' => 'phone username',
        'value' => $val,
    );



    if (!empty($_POST['amount_people'])) {
        WC()->session->set('amount_people', intval($_POST['amount_people']));
    }
    if (WC()->session->get('amount_people')) {
        $val = WC()->session->get('amount_people');
    } else {
        $val = '';
    }
    // Prefill amount of people if available
    $fields['billing']['amount_people'] = $val;
    if (!empty($_POST['booking_date'])) {
        WC()->session->set('booking_date', sanitize_text_field($_POST['booking_date']));
    }
    if (WC()->session->get('booking_date')) {
        $val = WC()->session->get('booking_date');
    } else {
        $val = '';
    }
    // Prefill booking date if available
    $fields['billing']['booking_date'] = $val;
    if (!empty($_POST['message'])) {
        WC()->session->set('message', sanitize_text_field($_POST['message']));
    }
    if (WC()->session->get('message')) {
        $val = WC()->session->get('message');
    } else {
        $val = '';
    }
    // Prefill message if available        
    $fields['billing']['message'] = $val;
    // prefill size
    // if (!empty($_POST['size'])) {
    //     $fields['billing']['size'] = sanitize_text_field($_POST['size']);
    // }


    return $fields;
}

//redirects

function redirect_shop_to_reservation()
{
    if (is_shop()) {
        wp_redirect(site_url('/reservation_fishing_excursion_party/'));
        exit;
    }
}
add_action('template_redirect', 'redirect_shop_to_reservation');

add_filter('woocommerce_cart_item_name', 'remove_cart_item_link', 10, 3);

function remove_cart_item_link($product_name, $cart_item, $cart_item_key)
{
    // Remove the link from the product name
    $product_name = $cart_item['data']->get_name();
    return $product_name;
}

add_action('woocommerce_after_checkout_form', 'bbloomer_cart_on_checkout_page', 11);

function bbloomer_cart_on_checkout_page()
{
    echo do_shortcode('[woocommerce_cart]');
}

/*
add_filter('woocommerce_get_cart_url', 'bbloomer_redirect_empty_cart_checkout_to_shop');

function bbloomer_redirect_empty_cart_checkout_to_shop()
{
    return (isset(WC()->cart) && !WC()->cart->is_empty()) ? wc_get_checkout_url() : site_url();
}
*/

add_filter( 'woocommerce_calculated_total', 'bbloomer_woocommerce_deposit_filter', 9999, 2 );
 
function bbloomer_woocommerce_deposit_filter( $total, $cart ) {
   return 100;
}

// function custom_checkout_order_total($total)
// {
//     //  Set the total order value as 100 dollars
//     return '$100.00';
// }
// add_filter('woocommerce_cart_totals_order_total_html', 'custom_checkout_order_total');

// Function for transferring the full amount of the order to the payment system
// function custom_checkout_order_total_paypal($paypal_args, $order)
// {
//     // Receive the full amount of the order
//     $order_total = $order->get_total();

//     $paypal_args['amount'] = '100.00'; // Set amount to $100

//     return $paypal_args;
// }
// add_filter('woocommerce_paypal_args', 'custom_checkout_order_total_paypal', 10, 2);



// Function for saving the full amount of the order in the database
function save_full_order_total($order_id)
{
    $order = wc_get_order($order_id);
    $order_total = $order->get_total();

    // Save the total amount of the order in the order metadata
    update_post_meta($order_id, 'full_order_total', $order_total);
}
add_action('woocommerce_checkout_update_order_meta', 'save_full_order_total');

// add text to checkout page
add_action('woocommerce_after_checkout_form', 'add_custom_checkout_title', 5);

function add_custom_checkout_title() {
    echo '<h3 class="checkout-custom-text">Your cart</h3>'; 
}



//booking
//add_filter('woocommerce_cart_needs_payment', '__return_false');

//test
//


add_filter('woocommerce_get_cart_url', 'custom_redirect_empty_cart_to_booking');
function custom_redirect_empty_cart_to_booking() {
    // Проверяем, пуста ли корзина
    if (isset(WC()->cart) && WC()->cart->is_empty()) {
        // Если корзина пуста, возвращаем URL страницы бронирования
        return site_url().'/reservation_fishing_excursion_party/';
    } else {
        // Если в корзине есть товары, возвращаем URL страницы оформления заказа
        return wc_get_checkout_url();
    }
}



add_action('wp_footer', 'ajaxurl');
function ajaxurl() {
    ?>
    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}


// define the wpcf7_is_tel callback 
function custom_filter_wpcf7_is_tel( $result, $tel ) { 
  $result = preg_match( '/^\(?\+?([0-9]{1,4})?\)?[-\. ]?(\d{10})$/', $tel );
  return $result; 
}

add_filter( 'wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2 );
