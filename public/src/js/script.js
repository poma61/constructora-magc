

$(document).ready(function () {
	"use strict";

	//click to scroll
	$('.collapse-box').on('shown.bs.collapse', function () {
		$(".customscroll").mCustomScrollbar("scrollTo",$(this));
	});


	// form-control on focus add class
	$(".form-control").on("focus", function () {
		$(this).parent().addClass("focus");
	});
	$(".form-control").on("focusout", function () {
		$(this).parent().removeClass("focus");
	});

	// sidebar menu icon
	$('.menu-icon, [data-toggle="left-sidebar-close"]').on("click", function () {
		//$(this).toggleClass('open');
		$("body").toggleClass("sidebar-shrink");
		$(".left-side-bar").toggleClass("open");
		$(".mobile-menu-overlay").toggleClass("show");
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


	$("[data-color]").each(function () {
		$(this).css("color", $(this).attr("data-color"));
	});
	$("[data-bgcolor]").each(function () {
		$(this).css("background-color", $(this).attr("data-bgcolor"));
	});
	$("[data-border]").each(function () {
		$(this).css("border", $(this).attr("data-border"));
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

// copy to clipboard function
function CopyToClipboard(value, showNotification, notificationText) {
	var $temp = $("<input>");
	if (value != "") {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(value).select();
		document.execCommand("copy");
		$temp.remove();
	}
	if (typeof showNotification === "undefined") {
		showNotification = true;
	}
	if (typeof notificationText === "undefined") {
		notificationText = "Copied to clipboard";
	}
	var notificationTag = $("div.copy-notification");
	if (showNotification && notificationTag.length == 0) {
		notificationTag = $("<div/>", {
			class: "copy-notification",
			text: notificationText,
		});
		$("body").append(notificationTag);

		notificationTag.fadeIn("slow", function () {
			setTimeout(function () {
				notificationTag.fadeOut("slow", function () {
					notificationTag.remove();
				});
			}, 1000);
		});
	}
}


