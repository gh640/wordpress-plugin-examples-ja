<?php

/**
 * Plugin Name: Example: Custom Field Block Binding
 * Description: Demonstrate the custom field block binding.
 * Version: 0.1.0
 * Requires at least: 6.5
 */

add_action( 'init', 'sample_register_meta' );

/**
 * 投稿にカスタムフィールド `sample_reading_time` 所要時間を追加する
 */
function sample_register_meta() {
  register_meta(
    'post',
    'sample_reading_time',
    [
      'show_in_rest' => true,
      'single' => true,
      'type' => 'string',
      'sanitize_callback' => 'wp_strip_all_tags',
    ]
  );
}

add_filter( 'register_post_type_args', 'sample_register_post_type_args', 0, 2 );

/**
 * 投稿のブロックテンプレートを変更する
 */
function sample_register_post_type_args( $args, $post_type ) {
  if ( $post_type === 'post' ) {
    $template = [
      [
        'core/heading',
        [
          'content' => '所要時間',
          'level' => 2,
          'lock' => [ 'remove' => true, 'move' => true ],
        ],
      ],
      [
        'core/paragraph',
        [
          'lock' => [ 'remove' => true, 'move' => true ],
          'metadata' => [
            'bindings' => [
              'content' => [
                'source' => 'core/post-meta',
                'args' => [ 'key' => 'sample_reading_time' ],
              ],
            ],
          ],
        ],
      ],
      [
        'core/paragraph',
      ],
    ];
    $args['template'] = $template;
  }

  return $args;
}
