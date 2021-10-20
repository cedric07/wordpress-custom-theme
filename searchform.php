<!-- search -->
<form class="search" method="get" action="<?= home_url(); ?>"
      role="search">
	<input class="search-input" type="search" name="s"
	       placeholder="<?php _e( 'Search', 'your_text_domain' ); ?>">
	<button class="search-submit" type="submit"
	        role="button"><?php _e( 'Search', 'your_text_domain' ); ?></button>
</form>
<!-- /search -->
