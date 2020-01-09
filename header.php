<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>kou's theme</title>
    <?php wp_head(); ?>
</head>


<body>
  <div class="header">
        <div class="header-logo">
          <a href="https://kou-sandbox.site/"><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt=""></a>  
        </div>
        <div class="header-items">

            <?php
            wp_nav_menu(
            //.header-listを置き換えて、PC用メニューを動的に表示する
              array(
                'depth' => 2,
                'theme_location' => 'global', //グローバルメニューをここに表示すると指定
                'container' => 'false',
                'menu_class' => 'header-list',
                )
              );
            ?>
        </div>

        <!-- <div class="header-drop-icon"><i class="fas fa-bars"></i></div> -->
        <div id="nav-drawer">
          <input id="nav-input" type="checkbox" class="nav-unshown">
          <label id="nav-open" for="nav-input"><span></span></label>
          <label class="nav-unshown" id="nav-close" for="nav-input"></label>
          <div id="nav-content">

          <?php
            wp_nav_menu(
            //.header-listを置き換えて、PC用メニューを動的に表示する
              array(
                'depth' => 2,
                'theme_location' => 'global', //グローバルメニューをここに表示すると指定
                'container' => 'false',
                'menu_class' => 'header-list',
              )
            );
          ?>
          
          </div>
          
        </div>
  </div>