var APP = APP || {};

var $ = jQuery.noConflict();

APP.pref = {
	screen_xl: 1200,
	screen_lg_down: 1199.98,
	screen_lg: 992,
	screen_md_down: 991.98,
	screen_md: 768,
	screen_sm_down: 767.98,
	screen_sm: 576,
	screen_xs_down: 575.98
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
