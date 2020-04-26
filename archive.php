<?php get_header(); ?>

<main role="main">
	<div class="container">
		<h1><?php _e( 'Archives', 'your_text_domain' ); ?></h1>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>
	</div>
</main>

<?php get_footer(); ?>
