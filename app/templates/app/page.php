 <?php
/*========================================
Page template
===========================================*/
get_header();
?>
<section class='content full clearfix'>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<header>
			<h1><?php the_title(); ?></h1>
		</header>
		<?php the_content();?>
	<?php endwhile; ?>
</section>
<?php get_footer(); ?>