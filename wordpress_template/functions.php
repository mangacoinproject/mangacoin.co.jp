<?php
add_action( 'wp_enqueue_scripts', 'my_delete_plugin_styles' );
	function my_delete_plugin_styles() {
	wp_deregister_style( 'contact-form-7' );
}
remove_action('wp_head','wp_generator');
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } 
    return $title;
});
function breadcrumb(){
	global $post;
	$str ='';
	if(!is_home()&&!is_admin()){
		$str.= '<li class="home" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/">トップ<i class="fas fa-angle-right"></i></a></li>';	
		if(is_search()){
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. get_search_query() .'</b></li>';
		} elseif(is_tag()){
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. single_tag_title( '' , false ). '</b></li>';
		} elseif(is_404()){
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">ページが見つかりませんでした</b></li>';
		} elseif(is_date()){
			if(get_query_var('day') != 0){
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '">' . get_query_var('year'). '年<i class="fas fa-angle-right"></i></a></li>';
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '">'. get_query_var('monthnum') .'月<i class="fas fa-angle-right"></i></a></li>';
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. get_query_var('day'). '日</b></li>';
			} elseif(get_query_var('monthnum') != 0){
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')) .'">'. get_query_var('year') .'年<i class="fas fa-angle-right"></i></a></li>';
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. get_query_var('monthnum'). '月</b></li>';
			} else {
				$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. get_query_var('year') .'年</b></li>';
			}
		} elseif(is_category()) {
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'">'. get_cat_name($ancestor) .'<i class="fas fa-angle-right"></i></a></li>';
				}
			}
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. $cat -> name . '</b></li>';
		} elseif(is_author()){
			$str .='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. get_the_author_meta('display_name', get_query_var('author')).'</b></li>';
		} elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'<i class="fas fa-angle-right"></i></a></li>';
				}
			}
			$str.= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. $post -> post_title .'</b></li>';
			
		} elseif(is_attachment()){
			if($post -> post_parent != 0 ){
				$str.= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($post -> post_parent).'">'. get_the_title($post -> post_parent) .'<i class="fas fa-angle-right"></i></a></li>';
			}
			$str.= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">' . $post -> post_title . '</b></li>';
		} elseif(is_single()){
			$categories = get_the_category($post->ID);
			$cat = $categories[0];
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'">'. get_cat_name($ancestor). '<i class="fas fa-angle-right"></i></a></li>';
				}
			}
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '">'. $cat-> cat_name . '<i class="fas fa-angle-right"></i></a></li>';
			$str.= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. $post -> post_title .'</b></li>';
		} else{
			$str.='<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><b itemprop="title">'. wp_title('', false) .'</b></li>';
		}
	}
	echo $str;
}








function categories_label() {
    $cats = get_the_category();
	$exclude = array(1);
    foreach((array)$cats as $cat){
		if(!in_array($cat->cat_ID, $exclude)){
		echo '<span class="cat">';
        echo esc_html($cat->name);
		echo '</span>';
			}
    }
}

function my_get_the_category( $id = false, $exclude = array() ) {
	$cats = get_the_category( $id );
	$excluded_cats = array();
	foreach( $cats as $cat ) {
		if ( !in_array( $cat->cat_ID, $exclude ) ) {
			$excluded_cats[] = $cat;
		}
	}
	return $excluded_cats;
}


remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

add_filter( "wp_pagenavi", "ik_pagination", 10, 2 );
function ik_pagination($html) {
	$out = '';
	$out = str_replace("<a","<li><a",$html);	
	$out = str_replace("</a>","</a></li>",$out);
	$out = str_replace("<span","<li><span",$out);	
	$out = str_replace("</span>","</span></li>",$out);
 
	return '<ul>'.$out.'</ul>';
}

function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

function remove_cssjs_ver2( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );

foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
    remove_action( $action, 'the_generator' );
}

function custom_admin_footer() {
	echo 'サイト作成：katuo_meme';
}
add_theme_support('post-thumbnails');
add_filter('admin_footer_text', 'custom_admin_footer');
if ( ! isset( $content_width ) )
	$content_width = 1000;	

/*タグの自動削除回避*/
function my_tiny_mce_before_init( $init_array ) {
    $init_array['valid_elements']          = '*[*]';
    $init_array['extended_valid_elements'] = '*[*]';

    return $init_array;
}
add_filter( 'tiny_mce_before_init' , 'my_tiny_mce_before_init' );
?>