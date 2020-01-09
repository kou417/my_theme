<?php
/**
* テーマのセットアップ
* 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#HTML5
**/
function my_setup()
{
add_theme_support('post-thumbnails'); // アイキャッチ画像を有効化
add_theme_support('automatic-feed-links'); // 投稿とコメントのRSSフィードのリンクを有効化
add_theme_support('title-tag'); // タイトルタグ自動生成
add_theme_support(
'html5',
array( //HTML5でマークアップ
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
)
);
}

add_action('after_setup_theme', 'my_setup');
// セットアップの書き方の型
// function custom_theme_setup() {
// add_theme_support( $feature, $arguments );
// }
// add_action( 'after_setup_theme', 'custom_theme_setup' );


/**
* CSSとJavaScriptの読み込み
*
* @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
*/
function my_script_init()
{
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css', array(), '1.0.0', 'all');
wp_enqueue_style('my', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');

wp_enqueue_script('my', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true);
wp_enqueue_script('menujs', get_template_directory_uri() . '/js/menu.js', array(), '1.0.0', 'all');

}
add_action('wp_enqueue_scripts','my_script_init');

/**
* メニューの登録
*
* 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
*/
function my_menu_init()
{
register_nav_menus(
array(
'global' => 'ヘッダーメニュー',
'utility' => 'ユーティリティメニュー',
'drawer' => 'ドロワーメニュー',
'footer-menu' => 'フッターメニュー'
)
);
}
add_action('init', 'my_menu_init');


/**
* ウィジェットの登録
*
* @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
*/
function my_widget_init() {
	register_sidebar(
	array(
	'name' => 'サイドバー', //表示するエリア名
	'id' => 'sidebar', //id
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>',
	)
	);
}
add_action( 'widgets_init', 'my_widget_init' );

/**
* アーカイブタイトル書き換え
*
* @param string $title 書き換え前のタイトル.
* @return string $title 書き換え後のタイトル.
*/
function my_archive_title( $title ) {

	if ( is_category() ) { // カテゴリーアーカイブの場合
	$title = '' . single_cat_title( '', false ) . '';
	} elseif ( is_tag() ) { // タグアーカイブの場合
	$title = '' . single_tag_title( '', false ) . '';
	} elseif ( is_post_type_archive() ) { // 投稿タイプのアーカイブの場合
	$title = '' . post_type_archive_title( '', false ) . '';
	} elseif ( is_tax() ) { // タームアーカイブの場合
	$title = '' . single_term_title( '', false );
	} elseif ( is_author() ) { // 作者アーカイブの場合
	$title = '' . get_the_author() . '';
	} elseif ( is_date() ) { // 日付アーカイブの場合
	$title = '';
	if ( get_query_var( 'year' ) ) {
	$title .= get_query_var( 'year' ) . '年';
	}
	if ( get_query_var( 'monthnum' ) ) {
	$title .= get_query_var( 'monthnum' ) . '月';
	}
	if ( get_query_var( 'day' ) ) {
	$title .= get_query_var( 'day' ) . '日';
	}
	}
	return $title;
	};
add_filter( 'get_the_archive_title', 'my_archive_title' );


/**

* 検索結果から固定ページを除外する
* @param string $search SQLのWHERE句の検索条件文
* @param object $wp_query WP_Queryのオブジェクト
* @return string $search 条件追加後の検索条件文

*/

function my_posts_search( $search, $wp_query ){
	//検索結果ページ・メインクエリ・管理画面以外の3つの条件が揃った場合
  
  if ( $wp_query->is_search() && $wp_query->is_main_query() && !is_admin() ){
	  // 検索結果を投稿タイプに絞る
	$search .= " AND post_type = 'post' ";
	return $search;
  }
  
	return $search;
  }
  
  /*記事本文の表示を140文字に変更*/
  add_filter('posts_search','my_posts_search', 10, 2);

  function twpp_change_excerpt_length( $length ) {
	return 140; 
  }
  add_filter( 'excerpt_length', 'twpp_change_excerpt_length', 999 );


  function twpp_change_excerpt_more( $more ) {
	return '';
  }
  
  add_filter( 'excerpt_more', 'twpp_change_excerpt_more' );



/**
* カテゴリーを1つだけ表示
*
* @param boolean $anchor aタグで出力するかどうか.
* @param integer $id 投稿id.
* @return void
*/

function my_the_post_category( $anchor = true, $id = 0 ) {
	global $post;
	//引数が渡されなければ投稿IDを見るように設定
	if ( 0 === $id ) {
	$id = $post->ID;
	}
	
	//カテゴリー一覧を取得
	$this_categories = get_the_category( $id );
	if ( $this_categories[0] ) {
		if ( $anchor ) { //引数がtrueならリンク付きで出力
		echo '<a href="' . esc_url( get_category_link( $this_categories[0]->term_id ) ) . '">' . esc_html( $this_categories[0]->cat_name ) . '</a>';
		} else { //引数がfalseならカテゴリー名のみ出力
		echo esc_html( $this_categories[0]->cat_name );
		}
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
// ビジュアルエディタ用CSSを読み込む
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //

add_editor_style('editor-style.css');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
// ビジュアルエディタのCSSを読み込む
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  //
function tinymce_add_buttons( $array ) {
	array_unshift( $array, 
	  'styleselect'
	);
	return $array;
  }
  add_filter( 'mce_buttons', 'tinymce_add_buttons' );
  
  
  //スタイルセレクトの初期設定を変更
  function customize_tinymce_settings($mceInit) {
	$style_formats = array(  
	  array(  
		'title' => 'div(段落)',  
		'block' => 'div',
		'classes' => 'normal-div',
		'wrapper' => true,
	  ),
	  array(  
		'title' => '見出し2',  
		'block' => 'h2',
		'classes' => 'h2-title',
	  ),
	  array(  
		'title' => '見出し3',  
		'block' => 'h3',
		'classes' => 'h3-title',
	  ),
	  array(
		'title' => 'ボックス(青)',
		'block' => 'div',
		'classes' => 'blue-box',
		'wrapper' => true,
	  ),
	  array(
		'title' => 'ボックス(引用)',
		'block' => 'div',
		'classes' => 'gray-box',
		'wrapper' => true,
	  ),
	  array(  
		'title' => 'アンダーライン（青）',  
		'block' => 'span',
		'classes' => 'under',
	  ),

	);
	$mceInit['style_formats'] = json_encode( $style_formats );  
	return $mceInit;
  }
  add_filter( 'tiny_mce_before_init', 'customize_tinymce_settings' );

remove_action( 'embed_head', 'print_embed_styles' );
remove_action( 'embed_footer', 'print_embed_sharing_dialog' );

function my_embed_styles() {
  wp_enqueue_style( 'wp-oembed-embed', '/wp-content/themes/kou_theme/css/wp-oembed-embed.css' );
}
add_action( 'embed_head', 'my_embed_styles' );