jQuery(document).ready(function() {

				jQuery(".ot-slider").owlCarousel({
					items : 1,
					autoplay : true,
					nav : true,
					lazyload : false,
					responsive : true,
					dots : true,
					margin : 15
				});

				jQuery(".big-pic-random .slider-items").owlCarousel({
					items : 1,
					autoplay : false,
					nav : true,
					lazyload : false,
					dots : false,
					margin : 15
				});

				jQuery(".related-articles-inherit").owlCarousel({
					items : 4,
					autoplay : false,
					nav : true,
					lazyload : false,
					dots : true,
					margin : 15,
					responsive:{
						0:{
							items: 1,
							nav: true
						},
						400:{
							items: 2,
							nav: false
						},
						700:{
							items: 4,
							nav: true,
							loop: false
						}
					}
				});	
});