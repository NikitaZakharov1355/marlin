$(function() {


	// 
	 $('#pick_up_transfer-radio_field input').change(function(){
	 	if($(this).val() == 0){
	 		$('#pick_up_transfer_field input').val('Yes');
	 	} else{
			$('#pick_up_transfer_field input').val('No');
	 	}
	 })

	$('.validate-required input').each(function(){
		$(this).attr('required','true');
	})

	// $('.gallery-item a').click(function(){
	// 	var img_src = $(this).attr('href')
	// 	$('.gallery_popup .gallery_popup-image img').attr('src', img_src);
	// 	$('body').addClass('popup_opened');
	// 	$('.gallery_popup').fadeIn();
	// 	return false;
	// })

	$('.wp-block-image, .gallery-item').click(function(){
		var img_src = $(this).find('img').attr('src')
		var link = $(this).find('a').attr('href');
		var link_l = $(this).find('a').length
		if(link_l > 0){
			if (link.indexOf('jpg') !== -1 || link.indexOf('png') !== -1) {
				$('.gallery_popup .gallery_popup-image img').attr('src', img_src);
				$('body').addClass('popup_opened');
				$('.gallery_popup').fadeIn();
				return false;
			}
		} else {
			// if (link.indexOf('jpg') !== -1 || link.indexOf('png') !== -1) {
				$('.gallery_popup .gallery_popup-image img').attr('src', img_src);
				$('body').addClass('popup_opened');
				$('.gallery_popup').fadeIn();
				return false;
			// }
		}
	})

	$('.gallery_popup .close').click(function(){
		$('body').removeClass('popup_opened');
		$('.gallery_popup .gallery_popup-image img').attr('src', '');
		$('.gallery_popup').fadeOut(0);
	})

	if($('.flexslider').length > 0){
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		  });	
	}

	if($('.product-number').length > 0){
		$('.cart_link a').append($('.product-number'))
	}

	$('.target_blank-links a').each(function(){
		$(this).attr('target','_blank');
	})

	$(window).scroll(function(){
		scrollHeader();
	})

	function scrollHeader(){
		if($(window).width() < 768 && $(window).scrollTop() > 0){
			$('.header').addClass('sticky')
		} else if($(window).width() > 768 && $(window).scrollTop() > 350) {
			$('.header').addClass('sticky')
		}
		 else{
			$('.header').removeClass('sticky')
		}
	}

	scrollHeader()


	setInterval(eventUpdate, 1000) 
 
	function eventUpdate(){

		$('.product-calendar-inner .simcal-event').each(function(){
			var boat = $(this).children('.simcal-event-title');
			$('.product-calendar-boats a').each(function(){
				var wrapper = $(this).attr('href');
				if($(this).text().toLowerCase() == boat.text().toLowerCase()){
					boat.wrap('<a href="' + wrapper + '"><a/>');
				}
			})

			var event = $(this).find('.simcal-event-description').children('p').text().toLowerCase();
			if(event == 'free'){
				$(this).find('.simcal-event-title').addClass('free')
			}
		})	
	}

	// $(document).on('simcal_default_calendar_draw_grid', function() {
	// 	console.log('Event update function called');
	// 	eventUpdate();
	// });

	// eventUpdate()



	$('.product-calendar-tab').click(function(){
		var calendar = '#' + $(this).data('calednar')
		$('.product-calendar-tab').removeClass('active')
		$(this).addClass('active')
		$('.product-calendar-inner').removeClass('active');
		$(calendar).addClass('active');
		$('.product-calendar-inner.active .simcal-event').click();

		$('.product-calendar-inner.active .simcal-event').each(function(){
			var eventId = '#' + $(this).attr('aria-describedby');
			if($(eventId).find('.simcal-event-description').text() == 'Free') {
				$(this).addClass('free')
			}
		})		
	});

		jQuery("body").on("click", ".toggle_menu, .toggled_menu-bg", function () {
		if($('.mobile_menu').hasClass('active')){
			$('.toggled_menu-bg').remove();
			$('.mobile_menu').removeClass('active');
			$('.toggle_menu').removeClass('toggled');
		} else {
			$('body').append('<div class="toggled_menu-bg"></div>');
			$('.mobile_menu').addClass('active');
			$('.toggle_menu').addClass('toggled');
		}
	})
	

	if($('#amount_people')){
		var amount_length = $('#amount_people option').length
	}

	
	$('.checkout-form').submit(function (){
		var user_obj = {};
		jQuery('.checkout-form input, .checkout-form select, .checkout-form textarea').each(function () {
			var key = jQuery(this).attr('name');
			var value = jQuery(this).val();
			user_obj[key] = value; // Assigning key-value pair to user_obj
		});
		sessionStorage.setItem('user_data', JSON.stringify(user_obj)); // Store user_obj as JSON string
		console.log(JSON.parse(sessionStorage.getItem('user_data'))); // Parse JSON string back to object when retrieving
		// return false;
	});

	console.log(JSON.parse(sessionStorage.getItem('user_data')))

	
	if(sessionStorage.getItem('user_data')){
		var billing_first_name = JSON.parse(sessionStorage.getItem('user_data')).billing_first_name;
		var billing_email = JSON.parse(sessionStorage.getItem('user_data')).billing_email;
		var billing_phone = JSON.parse(sessionStorage.getItem('user_data')).billing_phone;
		var amount_people = JSON.parse(sessionStorage.getItem('user_data')).amount_people;
		var booking_date = JSON.parse(sessionStorage.getItem('user_data')).booking_date;
		var message = JSON.parse(sessionStorage.getItem('user_data')).message;
		var pick_up_transfer = JSON.parse(sessionStorage.getItem('user_data')).pick_up_transfer;
		if($('form.checkout-form').length != 0 || $('form.checkout.woocommerce-checkout').length != 0){
			$('#billing_first_name').val(billing_first_name);
			$('#billing_email').val(billing_email);
			$('#billing_phone').val(billing_phone);
			$('#amount_people').val(amount_people);
			$('#booking_date').val(booking_date);
			$('#message').val(message);
			$('#pick_up_transfer').val(pick_up_transfer);
		}
	}
	

	$('#size').change(function(){
		var current_val = $(this).val();
		$('button[name="add-to-cart"]').val(current_val);
		console.log(current_val)
	})

	var domainName = window.location.hostname;
	var protocol = window.location.protocol;
	var domainWithProtocol = protocol + "//" + domainName;

	

	$('.additional_field label').click(function(){
		var product_id = $(this).data('id');
		var post_id = $('.checkout-form').data('post-id');
		var product_boat_id = $('.choice_fields .radio.active').data('id');
		var isChecked = false;
		if($(this).hasClass('checked')){
			$(this).removeClass('checked');
		} else {
			isChecked = true;
			$(this).addClass('checked')
		}
		$('.booking_form').addClass('loading');

		$.ajax({
			url: domainWithProtocol + '/wp-admin/admin-ajax.php',
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'update_time_selection_price_single',
				product_id: product_id,
				isChecked: isChecked,
				post_id: post_id,
				product_boat_id: product_boat_id,
			},
			success: function(response) {
				$('.booking_form').removeClass('loading');
				$('.total span').html(response);
			}
		})
	})  



	$('.time_selection label').click(function(){
		
		var product_id = $(this).data('id');
		var post_id = $('.checkout-form').data('post-id');
		var remove_product_ids = [];
		var isChecked = false;
		var isParty = false;
		
		if($(this).text() == 'Party Boat'){
			isParty = true;
		} 
		if(!$(this).hasClass('active')){
			$('.booking_form').addClass('loading');
			// if($(this).hasClass('checkbox')){
			// 	remove_product_ids.push(product_id);
			// 	if($(this).hasClass('checked')){
			// 		$(this).removeClass('checked')
			// 	} else{
			// 		isChecked = true;
			// 		$(this).addClass('checked')
			// 	}
			// } else {
				$('.time_selection label').each(function(){
					if( $(this).data('id') !== product_id){
						remove_product_ids.push($(this).data('id'));
					}
				})
				isChecked = true;
			// }

			$.ajax({
				url: domainWithProtocol + '/wp-admin/admin-ajax.php',
				type: 'POST',
				dataType: 'html',
				data: {
					action: 'update_time_selection_price',
					product_id: product_id,
					remove_product_ids: remove_product_ids,
					isChecked: isChecked,
					post_id: post_id,
				},
				success: function(response) {
					$('.total span').html(response);
					$('.booking_form').removeClass('loading');
					$('#amount_people').html('');
					if(isParty){
						for(var i = 1; i <=10; i++){
							$('#amount_people').append('<option value="' + i + '">' + i + '</option>');
						}
					} else{
						for(var i = 1; i <= amount_length; i++){
							$('#amount_people').append('<option value="' + i + '">' + i + '</option>');
						}
					}
				},
				error: function(xhr, status, error) {
					console.error('Error filtering boats:', error);
				}
			});		
		}
	})

	$('.choice_fields label.checkbox input').click(function(){
		var field = $(this).parent();
		setInterval(setActive(field),100);
	})

	function setActive(field){
		if(field.hasClass('active')){
			if(field.hasClass('checkbox')){
				field.removeClass('active')
			}			
		} else{
			if(field.hasClass('radio')){
				$('.choice_fields label.radio').removeClass('active')
			}
			field.addClass('active')
		}
	}

	$('.choice_fields label.radio').click(function(){
		var field = $(this);
		$('.boat_name-field').val(field.text());
		setInterval(setActive(field),100);
	})


	$('a[href="#more"]').click(function(){
		$(this).closest('.short_description').nextAll().fadeIn();
		return false;
	})

	$('.filter_content .btn').click(function(){
		var order = $(this).data('order');
		var category = $(this).parent().data('cat');
		$('.boats_wrapper').addClass('loading');
		$.ajax({
            url: domainWithProtocol + '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'html',
            data: {
                action: 'filter_boats',
                order: order,
				category: category,
            },
            success: function(response) {
				$('.boats_wrapper').removeClass('loading');
                $('.boats_wrapper').html(response);
				console.log(response)
            },
            error: function(xhr, status, error) {
                console.error('Error filtering boats:', error);
            }
        });
	})

	$('.stars a').click(function(){
		var clickedItem = $(this);
		setTimeout(setStars.bind(clickedItem), 20);
	});
	
	function setStars(){
		this.prevAll().addClass('active');
		this.nextAll().removeClass('active');
	}


	if($('.boats_slider').length > 0) {
		var boat_owl = $('.boats_slider');
		boat_owl.owlCarousel({
			loop:true,
			margin:58,
			nav:true,
			autoplay: true,
			responsive:{
				0:{
					items:1
				},
				768:{
					items:2
				},
				1200:{
					items:3
				}
			},
			onInitialized: setMaxHeight, // Set max height when initialized
			// onChanged: setMaxHeight // Set max height when slide changes
		  });
	  
		   function setMaxHeight(event) {
		 	var maxHeight = 0;
		 	$('.boats_slider .boats_slider-item').each(function(){
		 	  var itemHeight = $(this).height();
		 	  maxHeight = (itemHeight > maxHeight) ? itemHeight : maxHeight;
		 	});
		 	$('.boats .owl-carousel .boats_slider-item').css('height', maxHeight + 'px');
		   }
	}

	$(window).resize(function(){
		if($('.boats_slider').length > 0) {
			setMaxHeight();
		}
	})

	if($('.related_slider').length > 0) {
		$('.related_slider').owlCarousel({
			loop:true,
			margin:72,
			nav:true,
			autoplay: true,
			responsive:{
				0:{
					items:1
				},
				768:{
					items:2
				},
				1200:{
					items:2
				}
			}
		})
	}

	if($('.gallery_slider').length > 0) {
		$('.gallery_slider').owlCarousel({
			loop:true,
			nav:false,
			autoplay: true,
			responsive:{
				0:{
					items:1,
					autoWidth: false,
					margin:45,
				},
				768:{
					items:3,
					autoWidth: true,
					margin:30,
				},
				1200:{
					items:5
				}
			}
		})	
	}
	

	$('.toggle_title').click(function(){
		if($(this).parent().hasClass('toggled')){
			$(this).parent().removeClass('toggled');
		} else{
			$(this).parent().addClass('toggled')
		}
	})

})
