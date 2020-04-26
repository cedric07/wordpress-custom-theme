<?php get_header(); ?>

<main role="main">
	<div class="container">
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail(); // Fullsize image for the single post ?>
					</a>
				<?php endif; ?>
				<!-- /post thumbnail -->

				<!-- post title -->
				<h1>
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h1>
				<!-- /post title -->

				<!-- post details -->
				<span
						class="date"><?php the_date(); ?></span>
				<span
						class="author"><?php _e( 'Published by', 'your_text_domain' ); ?><?php the_author_posts_link(); ?></span>
				<span class="comments"><?php if ( comments_open( get_the_ID() ) ) {
						comments_popup_link( __( 'Leave your thoughts', 'your_text_domain' ), __( '1 Comment', 'your_text_domain' ), __( '% Comments', 'your_text_domain' ) );
					} ?></span>
				<!-- /post details -->

				<?php the_content(); // Dynamic Content ?>

				<?php the_tags( __( 'Tags: ', 'your_text_domain' ), ', ', '<br>' ); // Separated by commas with a line break at the end ?>

				<p><?php _e( 'Categorised in: ', 'your_text_domain' );
					the_category( ', ' ); // Separated by commas ?></p>

				<p><?php _e( 'This post was written by ', 'your_text_domain' );
					the_author(); ?></p>

				<?php comments_template(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h1><?php _e( 'Sorry, nothing to display.', 'your_text_domain' ); ?></h1>

			</article>
			<!-- /article -->

		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
