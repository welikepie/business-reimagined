/*global $:false */
window.init = function () {
	"use strict";

	var current_index,
		ranges = [
			{
				'range': [0, 699],
				'columns': 1,
				'gutter': 0
			},
			{
				'range': [700, 1023],
				'columns': 3,
				'gutter': 12
			},
			{
				'range': [1024, Infinity],
				'columns': 3,
				'gutter': 16
			}
		],

		masonry_func = function () {

			var width = $(window).width(),
				i, index;

			for (i = 0; i < ranges.length; i += 1) {
				if ((width >= ranges[i].range[0]) && (width <= ranges[i].range[1])) {
					index = i;
					break;
				}
			}

			if ((typeof index === 'number') && (index !== current_index)) {

				current_index = index;

				// Remove any previous instances of Masonry
				$('section#main .listing').masonry('destroy');

				// If more than one column, schedule re-initialisation of Masonry
				if (ranges[index].columns > 1) {
					window.setTimeout(function () {
						$('section#main .listing').masonry({
							'itemSelector': 'article',
							'columnWidth': parseInt($('section#main .listing > article:not(.video)')
								.css('width')
								.replace(/^[^0-9]*([0-9]+)[^0-9]*$/i, "$1"), 10),
							'gutterWidth': ranges[index].gutter
						});
					}, 100);
				}

			}
		};

	$(window).smartresize(masonry_func);
	masonry_func();

	// Handlers for sharing functionality of posts in a listing.
	// URL for sharing an appropriate post is already put in HREF attribute.
	// When the script runs, just make the clicks open up a new window for
	// the share.
	$('a.share, .share a').on('click', function (ev) {

		ev.preventDefault();
		if (this.href) {
			window.open(
				this.href,
				'SharingWindow',
				'width=600,height=400'
			);
		}
		return false;

	});

	var new_form = $('form.contact'),
		old_form = $('form.wpcf7-form');

	if (new_form.length) {
		old_form.find('input[type="hidden"]').detach().appendTo(new_form);
		new_form
			.attr('action', old_form.attr('action'))
			.find('button')
				.attr('value', old_form.find('input[type="submit"]').attr('value'));
	}

};