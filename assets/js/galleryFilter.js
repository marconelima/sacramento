$(document).ready(function(){
	$("#all").click(function(){
		$(".panties").animate({opacity:"1"});
		$(".bra").animate({opacity:"1"});
	});
  
	$("#panties").click(function(){
		$(".panties").animate({opacity:"1"});
		$(".bra").animate({opacity:"0.2"});
	});
  
	$("#bra").click(function(){
		$(".panties").animate({opacity:"0.2"});
		$(".bra").animate({opacity:"1"});
    });
});