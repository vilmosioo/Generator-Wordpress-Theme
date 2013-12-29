<?php
/*
Template to display related posts.
*/
$categories = get_the_category($id);
$tags = get_the_tags($id);

if ($categories || $tags) {
	$category_ids = array();
	if($categories) foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
	$tag_ids = array();
	if($tags) foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
 
	$args=array(
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $category_ids
			),
			array(
				'taxonomy' => 'post_tag',
				'field' => 'id',
				'terms' => $tag_ids
			)
		),
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 4, // Number of related posts that will be shown.
	);
 
	$my_query = new WP_Query( $args );
	if( $my_query->have_posts() ) {
	echo "<h3>Related posts</h3><ul class='list related'>";
	while( $my_query->have_posts() ) {
		$my_query->the_post(); ?>
		<li>
		<?php Utils::post_thumbnail('thumbnail', 'cutout'); ?>
		<a href='<?php the_permalink(); ?>' rel='canonical'><?php the_title();?></a>
		</li>
		<?php
	}
	echo "</ul><div class='clear'></div>";
	}
}
wp_reset_postdata();