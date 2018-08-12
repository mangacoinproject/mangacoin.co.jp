<?php get_header(); ?>
<article>
<h2 class="header">ニュース</h2>
<section class="posttype00">
<div class="inbox03 mbm00 ppt01">
<h3 class="title03"><?php the_title();?></h3>
<aside class="info"><?php categories_label() ?><time><?php the_time("Y.m.d"); ?></time></aside>
</div>
<div class="inbox01"><?php if (has_post_thumbnail()) {
	$thumbnail_id = get_post_thumbnail_id($post_object->ID);
	$image = wp_get_attachment_image_src( $thumbnail_id, 'large' );
	$src = $image[0]; 
  echo '<img src="'.$src.'" alt="';the_title();echo'" title="';the_title();echo'">';} else { ?><?php } ?></div>
<div class="inbox03 mbm04">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?> <?php the_content(); ?><?php endwhile; ?><?php else : ?><div><p>no.data</p></div><?php endif; ?></div>	
<div class="inbox02">
<strong class="center mbm03">共有する</strong>
<ul class="sharebox">
<li><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ) ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow', 'width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=1' ); return false;"><i class="fab fa-twitter"></i></a></li>
<li><a href="http://www.facebook.com/share.php?u=<?php echo get_permalink() ?>" onclick="window.open(this.href, 'window', 'width=550, height=450,personalbar=0,toolbar=0,scrollbars=1,resizable=1'); return false;" target="_blank"><i class="fab fa-facebook"></i></a></li>
<li><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo get_permalink() ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;"><i class="hatena">B!</i></a></li>
<li><a href="https://plus.google.com/share?url=<?php echo get_permalink() ?>"><i class="fab fa-google-plus-g"></i></a></li>
<li><a href="http://line.me/R/msg/text/?<?php echo get_permalink() ?>" target="_blank"><i class="fab fa-line"></i></a></li>
</ul>	
</div>
</section>	
</article>
<?php get_footer(); ?>