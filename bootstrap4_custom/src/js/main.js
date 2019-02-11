var APP = APP || {};

var $ = jQuery.noConflict();

APP.pref = {
	screenLarge: 1200,
	screenMedium: 992,
	screenSmall: 768,
	screenExtraSmall: 576
};

$(document).ready(function () {
	APP.global.init();
	APP.global.onResize();
	APP.global.onScroll();
});

APP.global = {
	init: function () {  /** init function */
  	APP.exemple.init();
	},
	onResize: function () {
		/** onResize function */
		$(window).on('resize', function () {

		});
	},
	onScroll: function () {
		/** Scroll function */
		$(window).on('scroll', function () {

		});
	}
};

APP.exemple = {
  exempleVar: $(),

  init: function() {
    this.exempleVar = $('.myClass');

    APP.exemple.exempleVar.hide();
  }
};
