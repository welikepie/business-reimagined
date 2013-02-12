/*global $:false */
window.init = function () {
	"use strict";

	$('section#main .listing').masonry({
		'itemSelector': 'article',
		'columnWidth': parseInt($('section#main .listing > article:not(.double)')
				.css('width')
				.replace(/^[^0-9]*([0-9]+)[^0-9]*$/i, "$1"), 10),
		'gutterWidth': 16
	});

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

};