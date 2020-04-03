<?php get_header(); ?>

<main role="main">
	<h1><?php _e( 'Latest Posts', 'custom_theme' ); ?></h1>
	<?php get_template_part( 'loop' ); ?>
	<?php get_template_part( 'pagination' ); ?>
</main>

<?php get_footer(); ?>
