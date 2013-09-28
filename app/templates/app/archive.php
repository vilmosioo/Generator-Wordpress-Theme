<?php
/*========================================
Archive template
Used for: categories, archives, tags, author, taxonomies
===========================================*/
get_header();
?>

<section class='content clearfix'>
	<header>
		<h1>
			<?php if ( is_category() ) : ?> Currently browsing: <?php single_cat_title(); ?>
			<?php elseif ( is_tag() ) : ?> Talking about: <?php single_cat_title(); ?>
			<?php elseif ( is_day() ) : ?><?php printf( __( '<span>Daily Archive</span>: %s' ), get_the_date() ); ?>
			<?php elseif ( is_month() ) : ?><?php printf( __( '<span>Monthly Archive</span>: %s' ), get_the_date('F Y') ); ?>
			<?php elseif ( is_year() ) : ?><?php printf( __( '<span>Yearly Archive</span>: %s' ), get_the_date('Y') ); ?>
			<?php elseif ( is_post_type_archive() ) : post_type_archive_title(); ?>
			<?php endif; ?>
		</h1>
	</header>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry entry article clearfix' ); ?>>
			<?php Utils::post_thumbnail( 'thumbnail', 'cutout' );?>
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