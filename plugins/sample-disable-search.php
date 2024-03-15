<?php

/**
 * Plugin Name: Sample: Disable Search Feature
 */

defined( 'ABSPATH' ) || exit;

add_action( 'parse_query', 'sample_search_filter_query' );
add_filter( 'get_search_form', '__return_null' );

/**
 * サイト内検索機能を無効にする
 */
function sample_search_filter_query( $query, $error = true ) {
  if ( is_search() ) {
    $query->is_search = false;
    $query->query_vars['s'] = false;
    $query->query['s'] = false;

    if ( $error == true ) {
      $query->is_404 = true;
    }
  }
}

add_filter( 'allowed_block_types_all', 'sample_allowed_block_types_all', 5, 2 );

/**
 * 検索ブロックを利用不可にする
 */
function sample_allowed_block_types_all( $allowed_block_types, $block_editor_context ) {
	$disallowed_blocks = [
		'core/search',
	];

	// Get all registered blocks if $allowed_block_types is not already set.
	if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
		$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
		$allowed_block_types = array_keys( $registered_blocks );
	}

	$filtered_blocks = [];

	foreach ( $allowed_block_types as $block ) {
		if ( ! in_array( $block, $disallowed_blocks, true ) ) {
			$filtered_blocks[] = $block;
		}
	}

	return $filtered_blocks;
}
