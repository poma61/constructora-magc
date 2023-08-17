
$(document).ready(function () {
	"use strict";
	// sidebar menu icon
	$('.menu-icon, [data-toggle="left-sidebar-close"]').on("click", function () {
		//$(this).toggleClass('open');
		$("body").toggleClass("sidebar-shrink");
		$(".left-side-bar").toggleClass("open");
		$(".mobile-menu-overlay").toggleClass("show");
		// Obtener la referencia a la tabla mediante el identificador
	

	});
	$('[data-toggle="header_search"]').on("click", function () {
		$(".header-search").slideToggle();
	});

	var w = $(window).width();
	$(document).on("touchstart click", function (e) {
		if (
			$(e.target).parents(".left-side-bar").length == 0 &&
			!$(e.target).is(".menu-icon, .menu-icon img")
		) {
			$(".left-side-bar").removeClass("open");
			$(".menu-icon").removeClass("open");
			$(".mobile-menu-overlay").removeClass("show");
		}
	});


	$(window).on("resize", function () {
		var w = $(window).width();
		if ($(window).width() > 1200) {
			$(".left-side-bar").removeClass("open");
			$(".menu-icon").removeClass("open");
			$(".mobile-menu-overlay").removeClass("show");
		}
	});

	// sidebar menu Active Class
	$("#accordion-menu").each(function () {
		var vars = window.location.href;
		$(this)
			.find('a[href="' + vars + '"]')
			.addClass("active");
	});

	$("#accordion-menu").vmenuModule({
		Speed: 400,
		autostart: false,
		autohide: true,
	});
});

// sidebar menu accordion
(function ($) {
	$.fn.vmenuModule = function (option) {
		var obj, item;
		var options = $.extend(
			{
				Speed: 220,
				autostart: true,
				autohide: 1,
			},
			option
		);
		obj = $(this);

		item = obj.find("ul").parent("li").children("a");
		item.attr("data-option", "off");

		item.unbind("click").on("click", function () {
			var a = $(this);
			if (options.autohide) {
				a.parent()
					.parent()
					.find("a[data-option='on']")
					.parent("li")
					.children("ul")
					.slideUp(options.Speed / 1.2, function () {
						$(this).parent("li").children("a").attr("data-option", "off");
						$(this).parent("li").removeClass("show");
					});
			}
			if (a.attr("data-option") == "off") {
				a.parent("li")
					.children("ul")
					.slideDown(options.Speed, function () {
						a.attr("data-option", "on");
						a.parent("li").addClass("show");
					});
			}
			if (a.attr("data-option") == "on") {
				a.attr("data-option", "off");
				a.parent("li").children("ul").slideUp(options.Speed);
				a.parent("li").removeClass("show");
			}
		});
		if (options.autostart) {
			obj.find("a").each(function () {
				$(this)
					.parent("li")
					.parent("ul")
					.slideDown(options.Speed, function () {
						$(this).parent("li").children("a").attr("data-option", "on");
					});
			});
		} else {
			obj.find("a.active").each(function () {
				$(this)
					.parent("li")
					.parent("ul")
					.slideDown(options.Speed, function () {
						$(this).parent("li").children("a").attr("data-option", "on");
						$(this).parent("li").addClass("show");
					});
			});
		}
	};
})(window.$ || window.Zepto);

