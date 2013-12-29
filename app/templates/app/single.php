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
	<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>