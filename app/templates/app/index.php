<?php get_header(); ?>

<section class='content clearfix'>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry entry article clearfix' ); ?>>
			<?php Utils::post_thumbnail('thumbnail', 'cutout');?>
			<header>
				<h2 class='entry-title'><a href='<?php the_permalink(); ?>' rel='canonical'><?php the_title();?></a></h2>
			</header>
			<div class='entry-content'>
				<?php the_excerpt(); ?> 
			</div>
			<a href='<?php the_permalink(); ?>' rel='canonical'>Continue reading &rarr;</a>
		</article>
	<?php endwhile; ?>
	<aside class='aside' id='post-navigation'>
		<span class='fleft'><?php previous_posts_link(); ?></span> 
		<span class='fright'><?php next_posts_link(); ?></span> 
		<div class='clear'></div>
	</aside>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
