$(document).ready(function() {

	$(".ninja-popup__close").click(function() {
		$(".main-firstscreen__ninja-popup").fadeOut('300');
	});

	$(".header-categories__item").click(function() {
		$(".main-firstscreen__ninja-popup").fadeIn('300');
	});

	$('[data-toggle="input-num"]').bind("change keyup input click", function() {
		if (this.value.match(/[^0-9]/g)) {
			this.value = this.value.replace(/[^0-9]/g, '');
		}
	});

	$('input, select').styler();

	$('.jq-selectbox__trigger-arrow').append('<i class="fa fa-sort-up"></i>');

	$('.slide-toggle-close').click(function() {
		$(this).toggleClass('closed');
		$(this).closest('.slide-toggle-item').find('.slide-toggle-body').slideToggle();
	});
	
});
