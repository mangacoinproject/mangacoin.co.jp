<?php get_header(); ?>
<article>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
<?php //remove_filter('the_content', 'wpautop'); ?>
<?php the_content(); ?>
<?php endwhile; ?><?php else : ?><div><p>no.data</p></div>
<?php endif; ?>
</article>
<?php get_footer(); ?>