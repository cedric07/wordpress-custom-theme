<?php get_header(); ?>

<main role="main">
	<h1><?php _e('Latest Posts', 'bootstrap4_custom'); ?></h1>
	<?php get_template_part('loop'); ?>
	<?php get_template_part('pagination'); ?>
</main>

<?php get_footer(); ?>
