<?php
/*
Template to display author biography.
*/
?>
<aside class='aside author'>
	<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>
	<h4> About <strong><?php the_author_meta( 'display_name' ); ?></strong> </h4>
	<p> 
		<?php the_author_meta( 'description' ); ?>
		<a href='#' rel='canonical'>Find out more &rarr;</a> 
	</p>
	<div class='clear'></div>
</aside>