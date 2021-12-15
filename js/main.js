"use strict";

jQuery(document).ready(function() {


   	//carousel
   	if (jQuery().carousel) {
		jQuery('.carousel').carousel();
	}

	//owl caousel
	if (jQuery().owlCarousel) {
	    jQuery(".owl-carousel").owlCarousel({
	    	navigation : true,
			items : 4,
	    	navigationText : false,
	    	pagination : false
	    });
	}


});
