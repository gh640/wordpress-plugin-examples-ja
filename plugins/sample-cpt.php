<?php

/**
 * Plugin Name: Sample: Custom Post Types
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'sample_init' );
function sample_init() {
  sample_register_post_types();
}

register_activation_hook( __FILE__, 'sample_activation_hook' );
function sample_activation_hook() {
  sample_register_post_types();
  flush_rewrite_rules( false );
}

register_deactivation_hook( __FILE__, 'sample_deactivation_hook' );
function sample_deactivation_hook() {
  unregister_post_type( 'product' );
  flush_rewrite_rules( false );
}

function sample_register_post_types() {
  register_post_type( 'product', [
    'label' => '商品',
    'description' => '商品情報を管理します',
    'public' => true,
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-products',
    'supports' => [
      'title',
      'editor',
      'revisions',
    ],
  ]);
}
