$(document).ready(function(){

	$("#celular").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

	$("#cel").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

    $("#phone1").mask("(99) 9999-9999?9")
    .focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

	$('.buttons').click(function(){
		$(this).siblings('.service_iten_info').toggle(500);
		$(this).children('.plus').toggle(0);
		$(this).children('.minus').toggle(0);
	});

	$('.service_iten_title').click(function(){
		$(this).siblings('.service_iten_info').toggle(500);
		$(this).siblings('.buttons').children('.plus').toggle(0);
		$(this).siblings('.buttons').children('.minus').toggle(0);
	});

	$('.content-area').css("margin-top", $('.header').height());

	// Ajusta dinamicamente a margem superior do elemento content-area para que o menu não o sobreponha
	$( window ).resize(function() {
		var height = $('.header').height();

		$('.content-area').css("margin-top", height);

	});

	$('#btn_news').click(function(){
		$('#caixa_news').show();
	});

	$('.header, .content-area, footer').click(function(){
		$('#caixa_news').hide();
	});

	

	$('.category > a').click(function(){

		$(this).siblings(".sub-categories").slideToggle();

	});
	$('.sub-category1 > a').click(function(){

		$(this).siblings(".sub-categories2").slideToggle();

	});
	$('.sub-category2 > a').click(function(){

		$(this).siblings(".sub-categories3").slideToggle();

	});

});
