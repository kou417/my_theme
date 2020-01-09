<!-- entry-related -->
<div class="entry-related">
<div class="related-title">関連記事</div>

<?php if( has_category() ) {
    $post_cats = get_the_category();
    $cat_ids = array();
    //所属カテゴリーのIDリストを作っておく
    foreach($post_cats as $cat) {
        $cat_ids[] = $cat->term_id;
    }
}

$myposts = get_posts( array(
    'post_type' => 'post', // 投稿タイプ
    'posts_per_page' => '6', // ８件を取得
    'post__not_in' => array( $post->ID ),// 表示中の投稿を除外
    'category__in' => $cat_ids, // この投稿と同じカテゴリーに属する投稿の中から
    'orderby' => 'rand' // ランダムに
) );

if( $myposts ): ?>


<div class="related-items">
    <?php foreach($myposts as $post): setup_postdata($post);?>
        <a class="related-item" href="<?php the_permalink(); ?>">
            <div class="related-item-img">
                <?php
                    if (has_post_thumbnail() ) {
                    // アイキャッチ画像が設定されてればミディアムサイズで表示
                    the_post_thumbnail('medium');
                    } else {
                    // なければnoimage画像をデフォルトで表示
                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                    }
                ?>
            </div>
            <div class="related-item-title"><?php the_title(); ?></div><!-- /related-item-title -->
        </a><!-- /related-item -->
    <?php endforeach; wp_reset_postdata(); ?>
</div><!-- /related-items -->
<?php endif; ?>
</div><!-- /entry-related -->