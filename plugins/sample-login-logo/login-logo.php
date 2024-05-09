<?php

/**
 * Plugin Name: Sample: Login Logo
 */

add_action( 'login_head', function () {
  $url = plugin_dir_url( __FILE__ ) . '/logo.png';
  ?>
  <style type="text/css">
    .login h1 a {
      background-image: url(<?php echo $url ?>);
      background-size: contain;
    }
  </style>
  <?php
} );

add_filter( 'login_headertext', fn () => get_bloginfo('name') );
add_filter( 'login_headerurl', fn () => home_url() );
