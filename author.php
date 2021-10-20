<?php get_header(); ?>

<main role="main">
	<div class="container">
		<?php if ( have_posts() ): the_post(); ?>

			<h1><?php _e( 'Author Archives for ', 'your_text_domain' );
				echo get_the_author(); ?></h1>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>

				<?= get_avatar( get_the_author_meta( 'user_email' ) ); ?>

				<h2><?php _e( 'About ', 'your_text_domain' );
					echo get_the_author(); ?></h2>

				<?= get_the_author_meta( 'description' ); ?>

			<?php endif; ?>

			<?php rewind_posts();
			while ( have_posts() ) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( [
									120,
									120,
							] ); // Declare pixel size you need inside the array ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h2>
						<a href="<?php the_permalink(); ?>"
						   title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<!-- /Post title -->

					<!-- post details -->
					<span
							class="date"><?php the_date(); ?></span>
					<span
							class="author"><?php _e( 'Published by', 'your_text_domain' ); ?><?php the_author_posts_link(); ?></span>
					<span
							class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'your_text_domain' ), __( '1 Comment', 'your_text_domain' ), __( '% Comments', 'your_text_domain' ) ); ?></span>
					<!-- /post details -->

					<?php get_the_excerpt(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'your_text_domain' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		<?php get_template_part( 'pagination' ); ?>
	</div>
</main>

<?php get_footer(); ?>
