(function ($) {
"use strict";

/* slicknav_menu */
$(document).ready(function(){
	$('#nav').slicknav();
	$(".slicknav_menu").appendTo(".mainmenu_area");
	$(".slicknav_menu").appendTo(".mainmenu_area_2");
	$(".slicknav_menu").appendTo(".mainmenu_area_3");
	
/* portfolio-area */
    $('.portfolio-area').on( 'click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });

     var $grid = $('.grid.filter').isotope({
      itemSelector: '.grid-item',
      percentPosition: true,
      
      masonry: {
        // use outer width of grid-sizer for columnWidth
        columnWidth: '.grid-item'
      }
    });
/* ScrollReveal */
  window.sr = ScrollReveal();
  sr.reveal('.reveal-top, .reveal-bottom, .reveal-left, .reveal-right', {
    delay: 700,
    easing: 'ease',
    duration: 800,
    scale: 0,
  });

  sr.reveal('.reveal-top', {
    origin: 'top',
  },250);
  sr.reveal('.reveal-bottom', {
    origin: 'bottom',
  },250);  
  sr.reveal('.reveal-left', {
    origin: 'left',
  },250);
  sr.reveal('.reveal-right', {
    origin: 'right',
  },250);
  
});


/* header_sticky */
 $(window).on('scroll',function() {
   var scroll = $(window).scrollTop();
   if (scroll < 245) {
    $("#header_sticky").removeClass("scroll_header");
   }else{
    $("#header_sticky").addClass("scroll_header");
   }
    var scroll = $(window).scrollTop();
   if (scroll < 245) {
    $("#header_sticky_2").removeClass("scroll_header_2");
   }else{
    $("#header_sticky_2").addClass("scroll_header_2");
   }
    var scroll = $(window).scrollTop();
   if (scroll < 245) {
    $("#header_sticky_3").removeClass("scroll_header_3");
   }else{
    $("#header_sticky_3").addClass("scroll_header_3");
   }
  });

  
$(function () {
	$('a.smoth-scroll').on('click', function (event) {
		var $anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $($anchor.attr('href')).offset().top - 5
		}, 1000);
		event.preventDefault();
	});
});
 

  
  
/* slider-active */
$('.slider-active').owlCarousel({
    loop:true,
    nav:true,
	autoplay:true,
    smartSpeed:1500,               // Effet fade out
	dots:false,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        767:{
            items:1
        },
        1000:{
            items:1
        }
    }
})

/* testimonial-active */
$('.grid-slider').owlCarousel({
    loop:true,
    nav:false,
	dots:false,
	autoplay:true,
    responsive:{
        0:{
            items:1
        },
        767:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

/* testimonial-active 2*/
$('.testimonials-slider-2').owlCarousel({
    loop:true,
    nav:false,
	dots:true,
	autoplay:true,
    responsive:{
        0:{
            items:1
        },
        767:{
            items:1
        },
        1000:{
            items:2
        }
    }
})

/* TESTIMONIALS SLIDER 3 */
    if ($(".testimonials-slider-3").length) {
        $(".testimonials-slider-3").owlCarousel({
			autoplay:true,
			smartSpeed: 600,
			margin: 0,
			loop:true,
			dots:false,
			nav:true,
			navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
			responsive:{
				0:{
					items:1
				},
				767:{
					items:1
				},
				1000:{
					items:1
				}
			}
        });
    }
	


/* brand-active */
$('.brand-active').owlCarousel({
    loop:true,
    nav:false,
	dots:false,
	autoplay:true,
  autoplayTimeout: 2000,     // Change toutes les 3 secondes
autoplayHoverPause: true,
    responsive:{
        0:{
            items:1
        },
        576:{
            items:2
        },
        768:{
            items:3
        },
        992:{
            items:4
        },
        1200:{
            items:5
        }
    }
})


 $('.slider-content-three').owlCarousel({
	    center: false,
	    items: 1,
	    loop: true,
			stagePadding: 0,
	    margin: 0,
	    autoplay: true,
	    pauseOnHover: false,
	    nav: false,
	    smartSpeed: 1000,
	  });


/* services-section-style2 */
$('.services-section-style2').owlCarousel({
    loop:true,
    nav:true,
	dots:true,
	autoplay:true,
	navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        767:{
            items:2
        },
        1000:{
            items:3
        }
    }
})

/* Scroll Up */
$.scrollUp({
	easingType: 'linear',
	scrollSpeed: 900,
	animation: 'fade',
	scrollText: '<i class="fa fa-angle-up"></i>',
});

/* counter Up */
$('.counter').counterUp({
    delay: 10,
    time: 2000
}); 



  $(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
  );


//for filter menu active class
$('.portfolio-menu button').on('click', function(event) {
	$(this).siblings('.active').removeClass('active');
	$(this).addClass('active');
	event.preventDefault();
});


$('.preloader').delay(1000).fadeOut(500, function() {});
  
/* Demo purposes only */
$(".hover").mouseleave(
    function () {
      $(this).removeClass("hover");
    }
);
  
  
  
/* ACTIVE POPUP IMAGE */  
    if ($(".fancybox").length) {
        $(".fancybox").fancybox({
            openEffect  : "elastic",
            closeEffect : "elastic",
            wrapCSS     : "project-fancybox-title-style"
        });
    }
  


/* POPUP VIDEO */  
    if ($(".video-btn").length) {
        $(".video-btn").on("click", function(){
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title'         : this.title,
                helpers     : {  
                    title : { type : 'inside' },
                    media : {}
                },

                beforeShow : function(){
                    $(".fancybox-wrap").addClass("gallery-fancybox");
                }
            });
            return false
        });    
    }

  /* Scrolling Effect js */
	// Select all links with hashes
	$('a[href*="#"]')
	  // Remove links that don't actually link to anything
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .click(function(event) {
		// On-page links
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  // Figure out element to scroll to
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
			// Only prevent default if animation is actually gonna happen
			event.preventDefault();
			$('html, body').animate({
			  scrollTop: target.offset().top
			}, 500, function() {
			  // Callback after animation
			  // Must change focus!
			  var $target = $(target);
			  $target.focus();
			  if ($target.is(":focus")) { // Checking if the target was focused
				return false;
			  } else {
				$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
				$target.focus(); // Set focus again
			  };
			});
		  }
		}
	});	
  
  
})(jQuery);