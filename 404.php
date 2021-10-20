<?php get_header(); ?>

<main role="main">
	<div class="container">
		<!-- article -->
		<article id="post-404">

			<h1><?php _e( 'Page not found', 'your_text_domain' ); ?></h1>
			<h2>
				<a
						href="<?= home_url(); ?>"><?php _e( 'Return home?', 'your_text_domain' ); ?></a>
			</h2>

		</article>
		<!-- /article -->
	</div>
</main>

<?php get_footer(); ?>
