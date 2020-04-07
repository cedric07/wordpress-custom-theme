<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' :';
		} ?><?php bloginfo( 'name' ); ?></title>

	<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/touch.png" rel="apple-touch-icon-precomposed">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- header -->
<header class="header" role="banner">
	<div class="container">
		<!-- nav -->
		<nav role="navigation">
			<a href="<?php echo home_url(); ?>" class="logo">
				<img class="img-responsive" src="<?php echo IMG_PATH; ?>/logo.svg" alt="Logo">
			</a>
			<?php menu_nav(); ?>
		</nav>
		<!-- /nav -->
	</div>
</header>
<!-- /header -->
