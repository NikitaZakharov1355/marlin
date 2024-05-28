$(function () {
	
	//функция прилипания хедера при скролле
    function e() {
        ($(window).width() < 768 && $(window).scrollTop() > 0) || ($(window).width() > 768 && $(window).scrollTop() > 0) ? $(".header").addClass("sticky") : $(".header").removeClass("sticky");
    }

	//Форма
	//поведение кнопок Трансфера
    $("#pick_up_transfer-radio_field input").change(function () {
        //$(this).val() == 0 ? $("#pick_up_transfer_field input").val("Yes") : $("#pick_up_transfer_field input").val("No");
		if ($(this).val() == 0) {
			$("#pick_up_transfer_field input").val("Yes");
		} else {
			$("#pick_up_transfer_field input").val("No");
		}
    });

	//Форма
	//на все поля формы с классом .validate-required добавляется required
    $(".validate-required input").each(function () {
        $(this).attr("required", "true");
    });

	
	//Поведение картинок галереии при клике
    $(".wp-block-image, .gallery-item").click(function () {
        var e = $(this).find("img").attr("src");
        $(".gallery_popup .gallery_popup-image img").attr("src", e);
        $("body").addClass("popup_opened");
        $(".gallery_popup").fadeIn();
        return false;
    });

	//Поведение картинок галереии при закрытии
    $(".gallery_popup .close").click(function () {
        $("body").removeClass("popup_opened");
        $(".gallery_popup .gallery_popup-image img").attr("src", "");
        $(".gallery_popup").fadeOut(0);
    });

	//Слайдер
    if ($(".flexslider").length > 0) {
        $(".flexslider").flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    }

	//Еслим корзина непустая, включается ярлык на ее картинке в хедере
    if ($(".product-number").length > 0) {
        $(".cart_link a").append($(".product-number"));
    }

	//поведение некоторых ссылок открываться в новой вкладке
    $(".target_blank-links a").each(function () {
        $(this).attr("target", "_blank");
    });

    $(window).scroll(function () {
        e(); //функция прилипания хедера при скролле
    });
    e(); //функция прилипания хедера при скролле

	//Работа календаря
    setInterval(function () {
		
        $(".product-calendar-inner .simcal-event").each(function () {
            var a = $(this).children(".simcal-event-title");
		
            $(".product-calendar-boats a").each(function () {
                var e = $(this).attr("href");
				
				
                if ($(this).text().toLowerCase() == a.text().toLowerCase()) {
					
					var originalUrl = e;
					// Извлечение имени лодки из исходной ссылки
					var boatName = originalUrl.split('/').filter(Boolean).pop();
					
					// Получение компонентов текущего URL
					var protocol = window.location.protocol; // 'https:'
					var host = window.location.host; // 'stage3.bigmarlinpuntacana.com'
					var newPath = '/reservation_fishing_excursion_party/';
					var newQuery = '?boat=' + boatName;

					// Создание новой ссылки
					var newUrl = protocol + '//' + host + newPath + newQuery;					
					e = newUrl;
					
                    a.wrap('<a href="' + e + '"><a/>');
                }
            });
            if ($(this).find(".simcal-event-description").children("p").text().toLowerCase() == "free") {
                $(this).find(".simcal-event-title").addClass("free");
            }
        });
    }, 1000);

	//Работа календаря 
	//console.log( $('.product-calendar-tab') );
	
    $('.product-calendar-tab').click(function () {
        var e = '#' + $(this).data('calednar');
		// console.log( 'this=',$(this) );
		// console.log( 'calendar=',$(this).data('calednar') );
		// console.log( 'e=',e );
		
        $('.product-calendar-tab').removeClass('active');
        $(this).addClass('active');
        
		$('.product-calendar-inner').removeClass('active');
        $(e).addClass('active');
		
        $('.product-calendar-inner.active .simcal-event').click();
        
		$('.product-calendar-inner.active .simcal-event').each(function () {
            var e = '#' + $(this).attr('aria-describedby');
            if ($(e).find('.simcal-event-description').text() == 'Free') {
                $(this).addClass('free');
            }
        });
    });

	//Работа моб меню
    jQuery("body").on("click", ".toggle_menu, .toggled_menu-bg", function () {
        if ($(".mobile_menu").hasClass("active")) {
            $(".toggled_menu-bg").remove();
            $(".mobile_menu").removeClass("active");
            $(".toggle_menu").removeClass("toggled");
        } else {
            $("body").append('<div class="toggled_menu-bg"></div>');
            $(".mobile_menu").addClass("active");
            $(".toggle_menu").addClass("toggled");
        }
    });

    var o, a, t, i, s, l, 
	r = window.location.hostname, 
	n = window.location.protocol + "//" + r;

    
	//Форма
	//Селект кол-ва людей в форме
	if ($("#amount_people").length) {
        o = $("#amount_people option").length;
    }
	

	//Форма
	//Работа Формы при отправке
    $(".checkout-form").submit(function (e) {
		var hasActiveClass = $(".time_selection label.vari_show").hasClass("active");
		
		 if (!hasActiveClass) {
            // Если ни один элемент не имеет класс 'active', блокируем отправку формы
            event.preventDefault();
            alert("Select duration, please");
			$('.choice_fields').addClass('red-border');
        } else {
        var t = {};
			jQuery(".checkout-form input, .checkout-form select, .checkout-form textarea").each(function () {
				var e = jQuery(this).attr("name"), a = jQuery(this).val();
				t[e] = a; //формируется массив данных формы 
			});
			sessionStorage.setItem("user_data", JSON.stringify(t)); //массив вышесформированныз данных забрасывается в сессию как  user_data
			//console.log(JSON.parse(sessionStorage.getItem("user_data")));
		}
    });

	//Форма
	//в этом коде из сессии дергается user_data
	//разбирается по полям и записывается в вукомерс form.checkout.woocommerce-checkout
	//пока неясно зачем
    //console.log(JSON.parse(sessionStorage.getItem("user_data")));
    if (sessionStorage.getItem("user_data")) {
        var r = JSON.parse(sessionStorage.getItem("user_data")).billing_first_name,
            a = JSON.parse(sessionStorage.getItem("user_data")).billing_email,
            t = JSON.parse(sessionStorage.getItem("user_data")).amount_people,
            i = JSON.parse(sessionStorage.getItem("user_data")).booking_date,
            s = JSON.parse(sessionStorage.getItem("user_data")).message,
            l = JSON.parse(sessionStorage.getItem("user_data")).pick_up_transfer;

        if ($("form.checkout-form").length > 0 || $("form.checkout.woocommerce-checkout").length > 0) {
            $("#billing_first_name").val(r);
            $("#billing_email").val(a);
            $("#amount_people").val(t);
            $("#booking_date").val(i);
            $("#message").val(s);
            $("#pick_up_transfer").val(l);
        }
    }
	
	
	//не нашел такого блока, может забыли удалить
    $("#size").change(function () {
        var e = $(this).val();
        $('button[name="add-to-cart"]').val(e);
        //console.log(e);
    });

	//Форма
	//Чекаем вариации, подсвечиваем кнопки
    function c(e) {
        if (e.hasClass("active")) {
			if (e.hasClass("checkbox")) {
				e.removeClass("active");
			}
		} else {
			if (e.hasClass("radio")) {
				$(".choice_fields label.radio").removeClass("active");
			}
			e.addClass("active");
		}

    }

	//Форма
	//По клику на доп поле (Снорклинг)
    $(".additional_field label").click(function () {
        var e = $(this).data("id"), //берем id доп поля
            a = $(".checkout-form").data("post-id"), //берем id лодки из заголовка формы
            t = $(".choice_fields .radio.active").data("id"), //берем id активной вариации
            i = false; //какойто флажок

        if ($(this).hasClass("checked")) { //если Снорклинг чекунтый
            $(this).removeClass("checked"); //анчекаем его, удаляем класс checked
        } else { //если Снорклинг неЧекнутый
            i = true; //флажок помечаем как true
            $(this).addClass("checked"); //чекаем его, добавляем класс checked
        }

        $(".booking_form").addClass("loading"); //на форму добавляем класс loading

        $.ajax({
            url: ajaxurl,
            type: "POST",
            dataType: "html",
            data: {
                action: "update_time_selection_price_single",
                product_id: e, //отправляем id доп поля
                isChecked: i, //отправляем фалжок чекнутости
                post_id: a, //отправляем id лодки из заголовка формы
                product_boat_id: t //отправляем id активной вариации
            },
            success: function (e) {
                $(".booking_form").removeClass("loading"); //у формы удаляем класс loading
                $(".total span").html(e); //обновляем цену
            }
        });
    }); //клик на Снорклинг

	//Форма 
	//По клику на вариации
    $(".time_selection label").click(function () { //список вариаций лодки (4часа, 6 часов и т. д.)
		//убираем красній ободок вокруг кнопок
		$('.choice_fields').removeClass('red-border');
	
        var e = $(this).data("id"), //берем id текущей вариации
            a = $(".checkout-form").data("post-id"), //берем id текущей лодки в шапке формы
            t = [], //пустой массив
            i = false, //какойто флаг
			snorkling; //флажок снорклинга
			
		// if ($(".additional_field label").hasClass("checked")) {
			// snorkling = true;
		// } else {
			// snorkling = false;
		// }
	
		//console.log(snorkling);
		
        if ($(this).text() == "Party Boat") { //тут проверяют по описании вариации это Party Boat или нет
            i = true; //флаг Party Boat
        }

		//проверяем если текущая вариация чекнута 
        if (!$(this).hasClass("active")) { //если текущая вариация неЧекнута
            $(".booking_form").addClass("loading"); //на форму добавляем класс loading

            $(".time_selection label").each(function () { //для каждой вариации 
                if ($(this).data("id") !== e) { //если она не совпадает с номером текущей вариации ( e )
                    t.push($(this).data("id")); //то добавляем ее в массив t
                }
            });
			
			

            $.ajax({
                url: ajaxurl,
                type: "POST",
                dataType: "html",
                data: {
                    action: "update_time_selection_price",
                    product_id: e, //отправляем id текущаей вариации
                    remove_product_ids: t,//массив, который содержит нечекнутые вариации
                    isChecked: true, //флажок чекнуточти текщей вариации (не понял зачем это) , Не путать со снорклингом
                    post_id: a //отправляем id лодки из заголовка формы
                },
                success: function (e) {
                    $(".total span").html(e); //меняем цену
                    $(".booking_form").removeClass("loading"); //у формы удаляем класс loading
                    /*
					$("#amount_people").html(""); //удаляем хтмл код селектора кол-ва людей

					//тут перерисовываем хтмл код селектора кол-ва людей
                    if (i) {
                        for (var a = 1; a <= 10; a++) {
                            $("#amount_people").append('<option value="' + a + '">' + a + "</option>");
                        }
                    } else {
                        for (var a = 1; a <= o; a++) {
                            $("#amount_people").append('<option value="' + a + '">' + a + "</option>");
                        }
                    }
					*/
                },
                error: function (e, a, t) {
                    console.error("Error filtering boats:", t); 
                }
            });
        }
    });//Клик на вариации


	//Форма
	//кликаем куда - таких селекторов не нашел
    $(".choice_fields label.checkbox input").click(function () {
        var e = $(this).parent();
		
        c(e); //выделяем активную кнопку
    }); 

	//Форма
	//кликаем на вариации - результат непонятен
    $(".choice_fields label.radio").click(function () {
        var e = $(this);
        $(".boat_name-field").val(e.text());
        
		c(e); //выделяем активную кнопку
    });

	
	/* -  дальше про форму ничгео нет - */

    $('a[href="#more"]').click(function () {
        $(this).closest(".short_description").nextAll().fadeIn();
        return false;
    });

    $(".filter_content .btn").click(function () {
        var e = $(this).data("order"),
            a = $(this).parent().data("cat");

        $(".boats_wrapper").addClass("loading");

        $.ajax({
            url: n + "/wp-admin/admin-ajax.php",
            type: "POST",
            dataType: "html",
            data: {
                action: "filter_boats",
                order: e,
                category: a
            },
            success: function (e) {
                $(".boats_wrapper").removeClass("loading");
                $(".boats_wrapper").html(e);
                //console.log(e);
            },
            error: function (e, a, t) {
                console.error("Error filtering boats:", t);
            }
        });
    });

    $(".stars a").click(function () {
        var e = $(this);
        setTimeout(function () {
            this.prevAll().addClass("active");
            this.nextAll().removeClass("active");
        }.bind(e), 20);
    });

    function d(e) {
        var a = 0;
        $(".boats_slider .boats_slider-item").each(function () {
            var e = $(this).height();
            a = a < e ? e : a;
        });
        $(".boats .owl-carousel .boats_slider-item").css("height", a + "px");
    }

    if ($(".boats_slider").length > 0) {
        $(".boats_slider").owlCarousel({
            loop: true,
            margin: 58,
            nav: true,
            autoplay: true,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                1200: { items: 3 }
            },
            onInitialized: d
        });
    }

    $(window).resize(function () {
        if ($(".boats_slider").length > 0) {
            d();
        }
    });

    if ($(".related_slider").length > 0) {
        $(".related_slider").owlCarousel({
            loop: true,
            margin: 72,
            nav: true,
            autoplay: true,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                1200: { items: 2 }
            }
        });
    }

    if ($(".gallery_slider").length > 0) {
        $(".gallery_slider").owlCarousel({
            loop: true,
            nav: false,
            autoplay: true,
            responsive: {
                0: { items: 1, autoWidth: false, margin: 45 },
                768: { items: 3, autoWidth: true, margin: 30 },
                1200: { items: 5 }
            }
        });
    }

    $(".toggle_title").click(function () {
        $(this).parent().toggleClass("toggled");
    });
});
