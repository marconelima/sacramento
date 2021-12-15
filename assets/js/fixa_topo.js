jQuery("document").ready(function($){
    
    var nav = $('.header');
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            nav.addClass("f-nav");
        } else {
            nav.removeClass("f-nav");
        }
    }); 
	
	$('#btn_news').click(function(){
		$('#caixa_news').slideToggle();
	});
 
});