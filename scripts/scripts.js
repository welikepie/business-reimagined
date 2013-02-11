/*global $:false */
window.init = function () {
	"use strict";

	// Debounce function for decent handling of resizes
	var debounce = function (func, timeout) {
		var id = null;
		return function () {
			var that = this,
				args = Array.prototype.slice.apply(arguments);
			if (id) { window.clearTimeout(id); }
			id = window.setTimeout(function () {
				func.apply(that, args);
				id = null;
			}, timeout);
		};
	};

	$('section#main').masonry({
		'itemSelector': 'article',
		'columnWidth': parseInt($('section#main .listing > article:not(.double)')
				.css('width')
				.replace(/^[^0-9]*([0-9]+)[^0-9]*$/i, "$1"), 10),
		'gutterWidth': 16
	});

	/*$('#container').masonry({
    // options
    itemSelector : '.item',
    columnWidth : 240
  });*/

};