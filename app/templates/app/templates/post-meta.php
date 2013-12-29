<?php
/*
Template to display post metadata.
*/
?>
<aside class='aside meta'>
	Posted on <?php the_time(get_option('date_format')); ?> in <?php the_category(', '); ?> <?php the_tags(' &#8226; Talking about ', ', '); ?> &#8226; <a href='#comments'><?php comments_number('No Comments :(', 'One Comment', '% Comments' ); ?></a> &#8226; <a title="Permalink to <?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">Permalink</a> 
</aside>
	