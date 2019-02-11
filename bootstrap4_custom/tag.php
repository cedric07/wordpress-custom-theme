<?php get_header(); ?>

<main role="main">
	<!-- section -->
	<section>

		<h1><?php _e('Tag Archive: ', 'bootstrap4_custom');
			echo single_tag_title('', FALSE); ?></h1>

		<?php get_template_part('loop'); ?>

		<?php get_template_part('pagination'); ?>

	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>