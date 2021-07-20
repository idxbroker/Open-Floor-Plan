jQuery(function( $ ){
	// Add class based on scroll position
	$(window).scroll(function () {
		if ($(document).scrollTop() > 1 ) {
			$('.sticky-header, .home').addClass('sticky');
			$('.site-inner').css({"padding-top": $('.sticky-header').height()});
		} else {
			$('.sticky-header, .home').removeClass('sticky');
			$('.site-inner').css({"padding-top": ""});
		}
	});
});