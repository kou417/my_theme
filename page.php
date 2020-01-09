<?php get_header(); ?>

  <div class="main">
    
    <!-- <div class="archive_title">ブログタイロルはここに入りますよ</div> -->

    <div class="page-content">
        <div class="single-topiic">
            <div class="single_title"><?php the_title(); ?></div>

            <?php the_post_thumbnail('large'); ?>

            <div class="single_content">
                <!-- 記事投稿ここから -->
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				    <?php the_content(); ?>
    			<?php endwhile; endif; ?> 
                <!-- 記事投稿ここまで -->
            </div>
        
        </div>

        
    </div>
  </div>

<?php get_footer(); ?>