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
	<aside class='aside' id='post-navigation'>
		<span class='fleft'><?php previous_posts_link(); ?></span> 
		<span class='fright'><?php next_posts_link(); ?></span> 
		<div class='clear'></div>
	</aside>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>