<?php get_header(); ?>

<main role="main">
	<div class="container">
		<h1><?php _e( 'Categories for ', 'your_text_domain' );
			single_cat_title(); ?></h1>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>
	</div>
</main>

<?php get_footer(); ?>
