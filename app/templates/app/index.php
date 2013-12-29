<?php get_header(); ?>

<section class='content clearfix'>
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
