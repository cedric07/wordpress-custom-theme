<?php get_header(); ?>

<main role="main">
	<div class="container">
		<h1>Your homepage</h1>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>
	</div>
</main>

<?php get_footer(); ?>
