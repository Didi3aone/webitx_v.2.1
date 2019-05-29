$(function() {
	var navHeight = $('nav').height();
	$('body').css("padding-top", navHeight + "px");
	
	var burgerWidth = $('.navbar-default .navbar-toggle').outerWidth(true);
	$('.navbar-brand.visible-xs').css("left" , burgerWidth + "px");
});