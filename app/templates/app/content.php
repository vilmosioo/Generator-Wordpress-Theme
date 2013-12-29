<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php is_singular() ? post_class('hentry entry clearfix') : post_class('hentry entry article clearfix'); ?>>
	
	<?php if ( !is_singular() ) Utils::post_thumbnail('thumbnail', 'cutout'); ?>	
	
	<header class="entry-header">
		<?php if ( is_singular() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( is_single() ) get_template_part( 'templates/post', 'meta' ); ?>
		<?php else : ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( !is_singular() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<a href='<?php the_permalink(); ?>' rel='canonical'>Continue reading &rarr;</a>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php if( is_single() ) : ?>
			<?php get_template_part( 'templates/post', 'navigation' ); ?>
			<?php get_template_part( 'templates/post', 'related' ); ?>
			<?php get_template_part( 'templates/author-bio' ); ?>
			<?php comments_template(); ?>
		<?php endif; // end single ?>	
	</div><!-- .entry-content -->
	<?php endif; ?>

</article>