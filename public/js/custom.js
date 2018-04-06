$(document).ready(function(){
	"use strict";


/*==================================
	Home Page Main Slider
	==================================*/

	if($(".slick.main").length){
		$('.slick.main').slick({
			dots: false,
			infinite: true,
			speed: 600,
			fade: true,
			cssEase: 'linear',
			autoplay:true,
			pauseOnHover:false,
			autoplaySpeed: 5000
		});
	};


/*==================================
	Listing Slider
	==================================*/

	if($(".slick.listing").length){
		$('.slick.listing').slick({
			dots: false,
			infinite: true,
			speed: 600,
			cssEase: 'linear',
			autoplay:true,
			pauseOnHover:false,
			autoplaySpeed: 5000,
			slidesToShow: 3,
			responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			]

		});
	};


	$('.carousel .vertical .item').each(function(){
		var next = $(this).next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo($(this));
		
		for (var i=1;i<2;i++) {
			next=next.next();
			if (!next.length) {
				next = $(this).siblings(':first');
			}
			
			next.children(':first-child').clone().appendTo($(this));
		}
	});

	$(".toggle-explore").on("click", function(){
		$(".explore-list").fadeToggle("slow");
	});


	$(".trigger-main-menu").on("click", function(){
		$(".menu.main").slideToggle();
	})

	/*$(function () {
		$('[data-toggle="tooltip"]').tooltip()
		tooltip('enable')
	})

	$(".dropdown-trigger").on("click", function(){
		$(".menu-links").slideToggle();
	})

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
		tooltip('enable')
	})*/



	var window_width = $(window).width();
	if(window_width <= 767){
		$(".searched-list").removeClass("mCustomScrollbar");
		// alert();
	};
});