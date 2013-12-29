<?php get_header(); ?>

<section class='content clearfix'>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content', get_post_format() ); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'templates/posts-navigation' ); ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
