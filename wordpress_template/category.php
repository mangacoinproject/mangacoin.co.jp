<?php get_header(); ?>
<article>
<h2 class="header">ニュース</h2>
<nav class="catnav"><ul><li<?php if (is_category('1')) { ?> class="current-cat"<?php } else { ?><?php } ?>><a href="<?php bloginfo('url'); ?>/news">すべて</a></li><?php wp_list_categories('title_li=&depth=1&child_of=1'); ?></ul></nav>
<section class="postlist linklist">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<dl>
<dt><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) {
	$thumbnail_id = get_post_thumbnail_id($post_object->ID);
	$image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
	$src = $image[0]; 
  echo '<img src="'.$src.'" alt="';the_title();echo'" title="';the_title();echo'">';} else { ?><?php } ?></a></dt>
<dd><aside class="info"><?php categories_label() ?><time><?php the_time("Y.m.d"); ?></time></aside><strong><a href="<?php the_permalink(); ?>"><?php the_title();?></a></strong></dd>	
</dl>
<?php endwhile; ?><?php else : ?><?php endif; ?>
</section>
<nav class="pagenav mbm04 clearfix"><?php wp_pagenavi(); ?></nav>
</article>
<?php get_footer(); ?>