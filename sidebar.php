<div class="sidever">

    <div class="sidever-search">
        <form id="form2" action="<?php echo home_url('/'); ?>" method="get">
            <input id="sbox2"  name="s" type="text"/>
            <button type="submit" id="sbtn2"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="sidever-profile">
        <a href="https://kmarketo.com/profile/">
          <img src="<?php echo get_template_directory_uri() ?>/img/IMG_4498 2.JPG" alt="">
        </a>
        <div class="sidever-profile-name">kou(こう)</div>
        <div class="sidever-profile-detail">
        このテーマの作者です！<br><br><br>
        1995年3月7日生まれの24才。<br>
        プログラミングが好き。
        <br><br>

        <ul class="sidever-profile-icons">
            <li class="prof"><a href="#"><i class="fas fa-address-card"></i>プロフィール ≫</a></li>
            <li class="twitter"><a href="#"><i class="fab fa-twitter"></i>twitter ≫</a></li>
            <li class="instagram"><a href="#"><i class="fab fa-instagram"></i>instagram ≫</a></li>
            <li class="youtube"><a href="#"><i class="fab fa-youtube"></i>Youtube ≫</a></li>
            <li class="work"><a href="#"><i class="fas fa-briefcase"></i>お仕事の依頼はこちら ≫</a></li>
        </ul>
        </div>
    </div>

    
    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
      <?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>


</div>