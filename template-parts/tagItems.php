<?php $post_tags = get_the_tags(); ?>
<div class="entry-tag-items">
    <div class="entry-tag-head">タグ</div><!-- /entry-tag-head -->
    <?php if ( $post_tags ) : ?>
        <?php foreach ( $post_tags as $tag ) : ?>
           <div class="entry-tag-item"><a href="<?php echo esc_url( get_tag_link($tag->term_id) ); ?>"><?php echo esc_html( $tag->name ); ?></a></div><!-- /entry-tag-item -->
        <?php endforeach; ?>
    <?php endif; ?>
</div>