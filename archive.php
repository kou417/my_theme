<?php get_header(); ?>

  <div class="main">
    <!-- breadcrumb -->
    <div class="breadcrumb">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
    <!-- /breadcrumb -->
    
    <div class="archive_title">『 <?php the_archive_title(); ?> 』の記事一覧</div>

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
              <div class="main-topic-title"><?php the_title(); ?></div>
              <div class="main-topic-detail"><?php the_excerpt(); ?></div>
              <div class="time">公開日：<?php the_time('Y年n月j日'); ?></div>
            </a>
          </div>
        <?php endwhile; ?>

        
        <!-- pagenation -->
        <?php if (paginate_links() ) : //ページが1ページ以上あれば以下を表示 ?>
          <div class="pagenation">
            <?php
              echo
              paginate_links(
              array(
              'end_size' => 0,
              'mid_size' => 1,
              'prev_next' => true,
              'prev_text' => '<i class="fas fa-angle-left"></i>',
              'next_text' => '<i class="fas fa-angle-right"></i>',
              )
              );
            ?>
          </div>
        <?php endif; ?>
        <!-- /pagenation -->

      </div><!-- /main-topic -->

      <?php else: ?><!-- 記事が１件もなかった場合 -->

        <div class="main-topic">
            <div class="no-title">『 <?php the_archive_title(); ?> 』の記事はありませんでした。</div>
        </div>

      <?php endif; ?>


      <?php get_sidebar(''); ?>
    </div><!-- /main-content -->

  </div>

<?php get_footer(); ?>