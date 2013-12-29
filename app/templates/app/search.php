 <?php
/*========================================
Search page template
===========================================*/
get_header();
?>
<section class='content'>
	<header>
		<h1><?php printf( __( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'templates/posts-navigation' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>