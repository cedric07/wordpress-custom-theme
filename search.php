<?php get_header(); ?>

<main role="main">
	<div class="container">
		<h1><?php echo sprintf( __( '%s Search Results for ', 'your_text_domain' ), $wp_query->found_posts );
			echo get_search_query(); ?></h1>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>
	</div>
</main>

<?php get_footer(); ?>
