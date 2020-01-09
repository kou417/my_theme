<?php get_header(); ?>

  <div class="main">
    
    <!-- <div class="archive_title">ブログタイロルはここに入りますよ</div> -->

    <div class="main-content">
        <div class="main-topic single-topiic">
            <div class="single_title"><?php the_title(); ?></div>
            <div class="single-time">公開日：<?php the_time('Y年n月j日'); ?>（最終更新日：<?php the_modified_date('Y年n月j日') ?>）</div>

            <?php
                if (has_post_thumbnail() ) {
                    the_post_thumbnail('large');
                } else {
                // なければnoimage画像をデフォルトで表示
                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                }
            ?>

            <div class="single_content">
                <!-- 記事投稿ここから -->
						<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						  <?php the_content(); ?>
						<?php endwhile; endif; ?> 
                <!-- 記事投稿ここまで -->

                <!-- entry-tag-items -->
                <?php get_template_part('template-parts/tagItems'); ?>
                <!-- /entry-tag-items -->

                <?php get_template_part('template-parts/kanren'); ?>

            </div>
        
        </div>

        <!-- /////////sideverここから///////// -->
        <?php get_sidebar(''); ?>
        <!-- /////////sideverここまで///////// -->

        
    </div>
  </div>

<?php get_footer(); ?>