<?php get_header(); ?>

<main role="main">
	<!-- section -->
	<section>

		<h1><?php _e('Archives', 'bootstrap4_custom'); ?></h1>

		<?php get_template_part('loop'); ?>

		<?php get_template_part('pagination'); ?>

	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>
