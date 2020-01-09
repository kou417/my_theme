<div class="main-pickUp">

      <?php $pickup_ids = array( 1, 2 , 3); // ピックアップする記事の投稿idを指定する ?>
      <?php foreach ( $pickup_ids as $id ) : ?>

      <div class="main-pickUp-item">
        <a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
          <?php
              if ( has_post_thumbnail( $id ) ) {
              echo get_the_post_thumbnail( $id, 'large' );
              } else {
              echo '<img src="' . esc_url( get_template_directory_uri() ) . '/img/noimg.png" alt="">';
              }
          ?>
          <div class="main-pickUp-title"><?php echo esc_html( get_the_title( $id ) ); ?></div>
        </a>
      </div>

      <?php endforeach; ?>

</div>