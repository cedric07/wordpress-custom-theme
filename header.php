<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' :';
		} ?><?php bloginfo( 'name' ); ?></title>

	<link href="<?= IMG_PATH; ?>/favicon/favicon.ico" rel="shortcut icon">
	<link href="<?= IMG_PATH; ?>/favicon/touch.png" rel="apple-touch-icon-precomposed">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<link rel="preload" href="<?= FONT_PATH; ?>/montserrat/montserrat-v18-latin-regular.woff2'" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?= FONT_PATH; ?>/montserrat/montserrat-v18-latin-700.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="<?= FONT_PATH; ?>/montserrat/montserrat-v18-latin-300.woff2" as="font" type="font/woff2" crossorigin>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- header -->
<header class="header" role="banner">
	<div class="container">
		<!-- nav -->
		<nav role="navigation">
			<a href="<?= home_url(); ?>" class="logo">
				<img class="img-responsive" src="<?= IMG_PATH; ?>/logo.svg" alt="Logo">
			</a>
			<?php header_nav(); ?>
		</nav>
		<!-- /nav -->
	</div>
</header>
<!-- /header -->
