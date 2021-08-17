<?php
class Mail {
	public static function init() {
		self::setHook();
	}

	protected static function setHook() {
		add_filter( 'wp_mail_content_type', function () {
			return "text/html";
		} );

		add_filter( 'wp_mail', function ( $args ) {
			$matches = [];
			// <br> regex
			if ( preg_match( "/<body[^>]*>(.*?)<\/body>/is", $args['message'], $matches ) ) {
				$args['message'] = $matches[1];
			}

			ob_start();
			set_query_var('content', $args['message']);
			get_template_part('templates/email', 'template');
			$args['message'] = ob_get_contents();
			ob_end_clean();
			return $args;
		} );

	}
}
