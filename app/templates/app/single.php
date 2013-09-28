<?php
/*========================================
Single template: blog posts, default template for custom posts 
===========================================*/
$attachments = get_posts(array(	
	'post_type' => 'attachment',
	'numberposts'     => -1,
	'post_parent' => $post->ID
));
$custom_fields = get_post_custom();
$url = $custom_fields['url'];
$github = $custom_fields['github'];

get_header();
?>

<section class='content clearfix'>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1><?php the_title();?></h1>
		</header>
		<aside class='aside meta'>
			Posted on <?php the_time(get_option('date_format')); ?> in <?php the_category(', '); ?> <?php the_tags(' &#8226; Talking about ', ', '); ?> &#8226; <a href='#comments'><?php comments_number('No Comments :(', 'One Comment', '% Comments' ); ?></a> &#8226; <a title="Permalink to <?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">Permalink</a> 
		</aside>
		
		<?php the_content();?>
		
		<?php
			if ( $attachments ) {
				echo "<h3>Screenshots</h3>";
				foreach ( $attachments as $attachment ) {
					$href = wp_get_attachment_image_src( $attachment->ID, 'thumbnail'); 
					$full = wp_get_attachment_image_src( $attachment->ID, 'full');
					echo "<a class='screenshot cutout' href='".$full[0]."' target=\"_blank\" rel=\"lightbox\">";
					echo "<img src='".$href[0]."' alt='".get_the_title()."'/>"; 
					echo "</a>";
				}
			}
		?>

		<div class='tcenter clear'>
			<?php if($url) : ?>
				<a class='button large blue' target='_blank' href='<?php echo $url[0]; ?>'>Live Demo</a>
			<?php endif;?>
			<?php if($github) : ?>
				<a class='button large orange' target='_blank' href='<?php echo $github[0]; ?>'>Download</a>
			<?php endif;?>
		</div>

		<aside class='aside' id='post-navigation'>
			<span class='fleft'><?php previous_post_link(); ?></span> 
			<span class='fright'><?php next_post_link(); ?></span> 
			<div class='clear'></div>
		</aside>
		<?php Utils::related_posts($post->ID); ?>
		<aside class='aside author'>
			<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>
			<h4> About <strong><?php the_author_meta( 'display_name' ); ?></strong> </h4>
			<p> 
				<?php the_author_meta( 'description' ); ?>
				<a href='#' rel='canonical'>Find out more &rarr;</a> 
			</p>
			<div class='clear'></div>
		</aside>
		<?php comments_template(); ?>
	</article>
<?php endwhile; ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>