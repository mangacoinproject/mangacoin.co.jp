<!DOCTYPE HTML>
<html lang="ja">
    <?php if (is_single()) { ?><head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#"><?php } else { ?><head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#"><?php } ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="jauSli6URvNcuS3BYNsj9Xuhbz2ijTC985AFGlNN4DE">
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120534606-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-120534606-2');
</script>
<link href="<?php echo get_template_directory_uri(); ?>/css/cmn.css" rel="stylesheet" media="all">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/ogp/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/ogp/apple-touch-icon.png">
<meta property="og:locale" content="ja_JP">   
<meta property="og:type" content="<?php if($_SERVER["REQUEST_URI"] == "/"){ ?>website<?php } else { ?>article<?php }?>">
 <?php
 function print_current_uri() {
 echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}?>
<?php		
if (is_single()){
if(have_posts()): while(have_posts()): the_post();
echo '<meta property="og:description" content="'; bloginfo('name'); echo '　ー　'; bloginfo('description'); echo'">';echo "\n";
endwhile; endif;
echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";
echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";
} else {
echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";
echo '<meta property="og:title" content="'; wp_title( '|', true, 'right' ); echo '">';echo "\n";
echo '<meta property="og:url" content="http://'; print_current_uri(); echo '">';echo "\n";
}
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
if (is_single()){
if (has_post_thumbnail()){
$image_id = get_post_thumbnail_id();
$image = wp_get_attachment_image_src( $image_id, 'full');
echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {
echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
} else {
echo '<meta property="og:image" content="'.get_template_directory_uri().'/img/ogp/ogp.png">';echo "\n";
}
} else {
echo '<meta property="og:image" content="'.get_template_directory_uri().'/img/ogp/ogp.png">';echo "\n";
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
	<?php wp_head(); ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    </head> 
<body<?php if (((is_front_page() && is_home()) || (is_front_page() && ! is_home())) && ! is_paged()): ?> class="no-scroll"<?php endif; ?>>
<header>
<h1><a href="<?php bloginfo('url'); ?>">MANGA</a></h1>
<nav class="gnav">
	<ul><li><a href="<?php bloginfo('url'); ?>/news">ニュース</a></li>
		<li><a href="<?php bloginfo('url'); ?>/service">サービス</a></li>
		<li><a href="<?php bloginfo('url'); ?>/company">会社情報</a></li>
		<li><a href="<?php bloginfo('url'); ?>/contact">お問い合わせ</a></li>
	</ul>
</nav>
<div class="gnavbtn"><i class="fas fa-bars"></i></div>	
</header>