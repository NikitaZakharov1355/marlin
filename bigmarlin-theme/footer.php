<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bigmarlin
 */

$banner_left = get_field('banner_left', 'option');
$banner_left_link = get_field('banner_left_link', 'option');
$footer_logo = get_field('footer_logo', 'option');
$banner_right = get_field('banner_right', 'option');
$banner_right_link = get_field('banner_right_link', 'option');
$contact_info = get_field('contact_info', 'option');
$footer_socials = get_field('footer_socials', 'option');
$copyright = get_field('copyright', 'option');
$terms_links = get_field('terms_links', 'option');
$calendar_image = get_field('calendar_image', 'option');
$calendar_link = get_field('calendar_link', 'option');
$widget_shortcode = get_field('widget_shortcode', 'option');
$reviews_shortocde = get_field('reviews_shortocde', 'option');
$info_text = get_field('info_text', 'option');
$trustindex_widget = get_field('trustindex_widget', 'option');

?>

<div class="gallery_popup">
	<button class="close"><img src="<?php echo get_template_directory_uri() ?>/app/img/close_b.svg" alt="close"></button>
	<div class="gallery_popup-image">
		<img src="#" alt="gallery_popup-image">
	</div>
</div>

<footer class="footer">
	<div class="footer_top">
		<div class="container flex align_c justify_c bordered">
			<a class="footer_top-banner" href="<?php echo $banner_left_link['url']; ?>" title="<?php echo $banner_left_link['title']; ?>">
				<picture>
					<img src="<?php echo $banner_left['url']; ?>" alt="<?php echo $banner_left['alt']; ?>">
				</picture>
			</a>
			<picture class="footer_top-logo">
				<img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>">
			</picture>
			<a class="footer_top-banner" href="<?php echo $banner_right_link['url']; ?>" title="<?php echo $banner_right_link['title']; ?>">
				<picture>
					<img src="<?php echo $banner_right['url']; ?>" alt="<?php echo $banner_right['alt']; ?>">
				</picture>
			</a>
		</div>
	</div>
	<div class="footer_middle">
		<div class="container flex justify_sb align_e">
			<div class="footer_aside">
				<div class="footer_aside-contact">
					<?php foreach ($contact_info as $item) : ?>
						<a  href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>" target="_blank">
							<img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
							<span>
								<?php if ($item['title']) : ?>
									<span class="footer_aside-contact-title">
										<?php echo $item['title']; ?>
									</span>
								<?php endif; ?>
								<?php echo $item['link']['title']; ?>
							</span>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="footer_aside-socials flex justify_c align_c">
					<?php foreach ($footer_socials as $item) : ?>
						<a href="<?php echo $item['link']['url']; ?>" title="<?php echo $item['link']['title']; ?>" target="_blank">
							<img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
						</a>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="footer_main">
				<div class="footer_main-top flex align_c">
					<a href="<?php echo $calendar_link['url']; ?>" title="<?php echo $calendar_link['title']; ?>">
						<picture class="footer_main-img">
							<img src="<?php echo $calendar_image['url']; ?>" alt="<?php echo $calendar_image['alt']; ?>">
						</picture>
					</a>
					<div class="footer-widget">
						<?php echo do_shortcode($widget_shortcode); ?>
					</div>
				</div>
				<div class="footer_main-bottom flex align_st justify_c">
					<div>
						<?php echo do_shortcode($reviews_shortocde); ?>
					</div>
					<div class="footer_main-bottom-info text_c flex align_c">
						<?php echo $info_text; ?>
					</div>
					<div class="footer_main-bottom-trustindex">
						<?php echo $trustindex_widget; ?>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="container">
			<div>
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
			</div>
		</div>
	</div>
	<div class="footer_copyright text_c">
		<div class="container bordered">
			<div class="terms_links-links">
				<?php foreach($terms_links as $link): ?>
					<a href="<?php echo $link['link']['url']; ?>"><?php echo $link['link']['title']; ?></a>
				<?php endforeach;?>
			</div>
			<?php echo $copyright; ?>
		</div>
	</div>
</footer>

</div>

<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($) {
	
	/*---- Вкалендаре заказа лодки блокируем даты раньше чем текущая ----*/
	// Получаем текущую дату
	var today = new Date(); //текущая дата на календаре
	//today.setDate(today.getDate() + 1); //завтрашняя дата на календаре
	// Преобразуем дату в строку формата "YYYY-MM-DD"
	var minDate = today.toISOString().split('T')[0];
	// Устанавливаем минимально допустимую дату в поле ввода
	$('#booking_date').attr('min', minDate);
	/*---------------*/
	
	// Получаем текущую дату
	var today = new Date(); //текущая дата на календаре
	//today.setDate(today.getDate() + 1); //завтрашняя дата на календаре
	// Преобразуем дату в строку формата "YYYY-MM-DD"
	var minDate = today.toISOString().split('T')[0];
	// Устанавливаем минимально допустимую дату в пол
	
	//Отправляем заявку админку о выбраной лодке
	$(function() {
		var thisForm = $('.checkout-form');
		
		//При внесениее информации в эти поля, удаляем класс red-border
		thisForm.find('input[type="text"], input[type="tel"], input[type="email"], input[type="date"]').on('input', function() {
			if ($(this).val().trim() !== '') {
				$(this).removeClass('red-border');
			}
		});
		
		// Удаление класса red-border при изменении состояния радиокнопок
		$("input[name='pick_up_transfer-radio']").on('change', function() {
			if ($("input[name='pick_up_transfer-radio']:checked").length > 0) {
				$('.radio-buttons__wrap').removeClass('red-border');
			}
		});		
		

		//Отправляем форму 	
		$('.adv-booking__btn').click(function(e) {			
			e.preventDefault();

			// Проверка всех обязательных полей
			var allFieldsValid = true;
			$('.validate-required input').each(function() {
				if (!this.checkValidity()) {
					$(this).addClass('red-border'); // добавить класс red-border к невалидным полям
					this.focus();
					allFieldsValid = false;
				} else {
					$(this).removeClass('red-border'); // удалить класс red-border у валидных полей
				}
			});
			
			// Проверка радиокнопок
			var radioChecked = $("input[name='pick_up_transfer-radio']:checked").length > 0;
			if (!radioChecked) {
				$('.radio-buttons__wrap').addClass('red-border'); // добавить класс red-border к невалидным полям					
				return; // выйти из функции, если радиокнопки не выбраны
			} else {
				$('.radio-buttons__wrap').removeClass('red-border');
			}			

			// Проверить, есть ли невалидные элементы
			var hasActiveClass = $(".time_selection label.vari_show").hasClass("active");
			if (!hasActiveClass) {
				//alert("Select duration, please");
				$('.choice_fields').addClass('red-border');
				return; // выйти из функции, если есть невалидные элементы
			}



			// Извлекаем данные из текущей формы
			
			var name = thisForm.find('#billing_first_name').val();
			var email = thisForm.find('#billing_email').val();
			var people = thisForm.find('#amount_people').find('option:selected').val();
			var date = thisForm.find('#booking_date').val();
			var message = thisForm.find('#message').val();
			var boat_name = $('.vari_show.active').text();
			var transfer = $("#pick_up_transfer_field input").val();

			// Устанавливаем значение для snorkeling
			let snorkeling = "No";
			if ($('.additional_field .checkbox-title').hasClass('checked')) {
				snorkeling = "Yes";
			}

			var cf7form = $('.hidden_form');
			cf7form.find('#your-name').val(name);
			cf7form.find('#your-email').val(email);
			cf7form.find('#your-tel').val($('#billing_phone').val());
			cf7form.find('#your-boat').val($('.selected-boat').text());
			cf7form.find('#your-people').val(people);
			cf7form.find('#your-choice').val(boat_name);
			cf7form.find('#your-date').val(date);
			cf7form.find('#your-transfer').val(transfer);
			cf7form.find('#your-total').val($('.the-order-total').text());
			cf7form.find('#your-snorkeling').val(snorkeling);
			cf7form.find('#your-message').val(message);

			// Пример отправки формы
			cf7form.find('input.wpcf7-submit').click();
			
			$(".booking_form").addClass("loading");
			
			$.ajax({
                url: ajaxurl,
                type: "POST",
                dataType: "html",
                data: {
                    action: "update_cart_total", //очищаем корзину в ноль                   
                },
                success: function (e) {
                    thisForm.find('#billing_first_name').val('');
					thisForm.find('#billing_email').val('');
					thisForm.find('#billing_phone').val('');
					
					thisForm.find('#amount_people').val('1');
					thisForm.find('#booking_date').val('');
					thisForm.find('#message').val('');
					$('.checkbox-title').removeClass('checked');
					$('.the-order-total').text('$0');
					$('.vari_show').removeClass('active');
					$(".radio-buttons__wrap input[type='radio']").prop("checked", false);
					
					alert('Thank you, our manager will contact you as soon as possible');
					$(".booking_form").removeClass("loading");
					
                },
                error: function (e, a, t) {
                    console.error("Error sending Advanced booking form:", t); 
                }
            });
			
		});
	});

	
	//Работаем по выбору лодки
	$('#billing_boath_selector').change(function() {
		$(".booking_form").addClass("loading"); //на форму добавляем класс loading
		
		// Получаем выбранное значение (ID)
		var selectedOption = $(this).find('option:selected');
		var boat_id = selectedOption.val();
		var boat_name = selectedOption.text();
		var boat_capacity = selectedOption.data('boat-capacity');
		var snorklig_id = selectedOption.data('snorklig-id');
		var snorklig_price = selectedOption.data('snorklig-price');
		var snorklig_title = selectedOption.data('snorklig-title');
		$('.selected-boat').text(boat_name); //меняем имя лодки в синей кнопке
		$('.checkout-form').data('post-id', boat_id); //меняем id лодки в шапке формы
		console.log( $('.checkout-form').data('post-id') );
	
		$('.time_selection label.radio').removeClass('vari_show');
		$('.time_selection label.radio').removeClass('active');
		$('[data-boat-id="' + boat_id + '"]').addClass('vari_show');
		
		//Перерисовываем селект с кол-вом людей
		$("#amount_people").empty();
		
		// Создаем новые опции и добавляем их в <select>
		var selectOptions = '';
		for (var i = 1; i <= boat_capacity; i++) {
			selectOptions += '<option value="'+i+'">'+i+'</option>';			
		}
		$("#amount_people").html(selectOptions);
		
		//Переписываем параметры снорклинг-опции
		$('.checkbox-title').removeClass('checked');
		$('.checkbox-title').data('id',snorklig_id);
		$('.checkbox-title').data('price',snorklig_price);
		$('.checkbox-title').data('title',snorklig_title);
		
		//$('.chexbox-option-title').text(snorklig_title+ ' ('+snorklig_id+') ');
		$('.chexbox-option-title').text(snorklig_title);
		
		
		$.ajax({
                url: ajaxurl,
                type: "POST",
                dataType: "html",
                data: {
                    action: "update_cart_total", //очищаем корзину в ноль                   
                },
                success: function (e) {
                    //$(".total span").html(e); //меняем цену
                    $(".booking_form").removeClass("loading"); //у формы удаляем класс loading
					$(".total span").text('$0');
                },
                error: function (e, a, t) {
                    console.error("Error filtering boats:", t); 
                }
            });		
		
		
	});
	
});
</script>

<style>
/*
#message_field {
	width: 100%!important;
}
.woocommerce-checkout #pick_up_transfer_field, 
.woocommerce-checkout #amount_people_field, .woocommerce-checkout #booking_date_field, .woocommerce-checkout #message_field {
	display: block!important;
}
*/

.adv-booking__btn:hover {
	cursor: pointer;
}
.checkout-form  {
	position: relative;
}
.form__inner-wrap {	
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	opacity: 1;
	visibility: hidden;
	display: block;
}
.form__inner-wrap.show {
	opacity: 0.5;
	visibility: visible;
	position:absolute;
}

.selecting {    
	background-color: #303f51;
    border-radius: 5px;
    color: #fff;
    display: inline-block;
    font-size: 2.4rem;
    font-weight: 500;
    line-height: 3.1rem;
    margin-top: 1rem;
    min-width: 26rem;
    padding: 1.5rem;
    text-align: center;
    text-transform: uppercase;
}


.hidden_form {
	display: none!important;
}


.booking_form .reserve-btn {
	margin: 10px;
}

@media(max-width: 768px) {
	.adv-booking__btn {
		margin-left: 0!important;
		margin-right:0!important;
	}
}

.booking_form form .choice_fields p .woocommerce-input-wrapper {
	justify-content: flex-start;
}

 .booking_form form .choice_fields p {
	width: 100%; 
 }
.booking_form form .choice_fields p label {
	min-width: unset;
	max-width: 200px;
    width: 22%;
}
@media(max-width: 767px) {
	.booking_form form .choice_fields p label {
		width: 100%;	
		max-width: 100%;
	}
}

.time_selection label.radio {
	display: none;
}	
.vari_show {
	display: block!important;
}
.red-border {
	border: 2px solid red!important;
	padding: 5px;
}	
	
.reservation-form 	.party-book {
		display: none;
	} 
	
.reservation-form 	.party-book.show {
		display: block;
	} 
	
.reservation-form 	.party-book .selected {
		width: 100%;		
	}
.reservation-form 	.party-book .selected {
		background-color: darkred!important;
	}
	
.reservation-form 	.boat-options {
		width: 100%;
		display: block;
		opacity: 1 !important;
		transition: 0.3s;
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
	}
	
.reservation-form 	.hide-boat-options {
		opacity: 0 !important;
	} 	
	
.reservation-form  .choice_fields input[type="radio"] {
		display: none;
	}		
.reservation-form  .choice_fields p {		
		flex: 0 0 100%;	
		width: 100%;
	}
.reservation-form  .choice_fields p label {
		min-width: unset;
		width: 45%;
		max-width: 200px;
	}
.reservation-form  .choice_fields p .woocommerce-input-wrapper {
		justify-content: space-between;
	}
.reservation-form 	.choice_fields>label {
		margin-top: 2rem !important;
		margin-bottom: -2rem !important;
	}
.reservation-form 	.boat-inputs {
		order: 3;
	}
.reservation-form 	.boat-image {
		order: 4;
	}
	
@media only screen and (max-width: 768px) {
	.reservation-form .boat-image {
			order: 2;
			margin-bottom: 20px;
		}	
		 
		  .reservation-form .choice_fields p label {
			width: 100%;
			max-width: unset;
		  }		
	}
	
.reservation-form .time_selection input[type="radio"]:checked + span {
	background-color: #303f51;
	border-color: #303f51;
	color: #fff;
}
	
.reservation-form .choice_fields p label {
	padding: 0 !important;
	min-width: unset !important;
}
.reservation-form .choice_fields p label>span {
	display: block;
	padding: 1.5rem;
}

.reservation-form .additional_field input[type="checkbox"] {
	display: none;
}

.reservation-form .additional_field span.optional:before {
	top: 50%!important;
	left: 50%!important;
	transform: translateX(-50%) translateY(-50%);
}

.reservation-form .additional_field input[type="checkbox"]:checked + span.optional:before {
    opacity: 1;
}
	
.reservation-form .highlight {
	border: 1px solid red;
	color: red;
}
.reservation-form .order-total-sum {
    background: #09b2d4;
    border-radius: 4px;
    padding: 3px;
}	
	
</style>

</body>

</html>