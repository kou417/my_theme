<?php get_header(); ?>
  <div class="main">

  <?php get_template_part('template-parts/pickup'); ?>
    
    <div class="main-content">
      <?php if (have_posts() ) : ?>
      <div class="main-topic">
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="main-topic-item">
            <a href="<?php the_permalink(); ?>">
              <!-- img-warp -->
              <div class="img-warp">
                  <?php
                      if (has_post_thumbnail() ) {
                          the_post_thumbnail('large');
                      } else {
                      // なければnoimage画像をデフォルトで表示
                          echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                      }
                  ?>
              </div>
              <div class="time">公開日：<?php the_time('Y年n月j日'); ?>（最終更新日：<?php the_modified_date('Y年n月j日') ?>）</div>
              <div class="main-topic-title"><?php the_title(); ?></div>
              <div class="main-topic-detail"><?php the_excerpt(); ?></div>
            </a>
          </div>
        <?php endwhile; ?>

        
        <!-- pagenation -->
        <?php get_template_part('template-parts/pagenation'); ?>
        <!-- /pagenation -->

      </div><!-- /main-topic -->

      <?php endif; ?>

      <?php get_sidebar(''); ?>
    </div><!-- /main-content -->

  </div><!-- /main -->

<?php get_footer(); ?>
