(function ($) {

	"use strict";

	$('[data-toggle="tooltip"]').tooltip()

})(jQuery);

$(document).ready(function () {

	$('.card').delay(1800).queue(function (next) {
		$(this).removeClass('hover');
		$('a.hover').removeClass('hover');
		next();
	});
});