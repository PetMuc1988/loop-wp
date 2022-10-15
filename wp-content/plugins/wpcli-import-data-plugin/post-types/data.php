<?php

/**
 * Registers the `data` post type.
 */
function data_init() {
	register_post_type(
		'data',
		[
			'labels'                => [
				'name'                  => __( 'Data', 'wpcli-import-data-plugin' ),
				'singular_name'         => __( 'Data', 'wpcli-import-data-plugin' ),
				'all_items'             => __( 'All Data', 'wpcli-import-data-plugin' ),
				'archives'              => __( 'Data Archives', 'wpcli-import-data-plugin' ),
				'attributes'            => __( 'Data Attributes', 'wpcli-import-data-plugin' ),
				'insert_into_item'      => __( 'Insert into Data', 'wpcli-import-data-plugin' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Data', 'wpcli-import-data-plugin' ),
				'featured_image'        => _x( 'Featured Image', 'data', 'wpcli-import-data-plugin' ),
				'set_featured_image'    => _x( 'Set featured image', 'data', 'wpcli-import-data-plugin' ),
				'remove_featured_image' => _x( 'Remove featured image', 'data', 'wpcli-import-data-plugin' ),
				'use_featured_image'    => _x( 'Use as featured image', 'data', 'wpcli-import-data-plugin' ),
				'filter_items_list'     => __( 'Filter Data list', 'wpcli-import-data-plugin' ),
				'items_list_navigation' => __( 'Data list navigation', 'wpcli-import-data-plugin' ),
				'items_list'            => __( 'Data list', 'wpcli-import-data-plugin' ),
				'new_item'              => __( 'New Data', 'wpcli-import-data-plugin' ),
				'add_new'               => __( 'Add New', 'wpcli-import-data-plugin' ),
				'add_new_item'          => __( 'Add New Data', 'wpcli-import-data-plugin' ),
				'edit_item'             => __( 'Edit Data', 'wpcli-import-data-plugin' ),
				'view_item'             => __( 'View Data', 'wpcli-import-data-plugin' ),
				'view_items'            => __( 'View Data', 'wpcli-import-data-plugin' ),
				'search_items'          => __( 'Search Data', 'wpcli-import-data-plugin' ),
				'not_found'             => __( 'No Data found', 'wpcli-import-data-plugin' ),
				'not_found_in_trash'    => __( 'No Data found in trash', 'wpcli-import-data-plugin' ),
				'parent_item_colon'     => __( 'Parent Data:', 'wpcli-import-data-plugin' ),
				'menu_name'             => __( 'Data', 'wpcli-import-data-plugin' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-book-alt',
			'show_in_rest'          => true,
			'rest_base'             => 'data',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'data_init' );

/**
 * Sets the post updated messages for the `data` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `data` post type.
 */
function data_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['data'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Data updated. <a target="_blank" href="%s">View Data</a>', 'wpcli-import-data-plugin' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wpcli-import-data-plugin' ),
		3  => __( 'Custom field deleted.', 'wpcli-import-data-plugin' ),
		4  => __( 'Data updated.', 'wpcli-import-data-plugin' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Data restored to revision from %s', 'wpcli-import-data-plugin' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Data published. <a href="%s">View Data</a>', 'wpcli-import-data-plugin' ), esc_url( $permalink ) ),
		7  => __( 'Data saved.', 'wpcli-import-data-plugin' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Data submitted. <a target="_blank" href="%s">Preview Data</a>', 'wpcli-import-data-plugin' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Data scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Data</a>', 'wpcli-import-data-plugin' ), date_i18n( __( 'M j, Y @ G:i', 'wpcli-import-data-plugin' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Data draft updated. <a target="_blank" href="%s">Preview Data</a>', 'wpcli-import-data-plugin' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'data_updated_messages' );

/**
 * Sets the bulk post updated messages for the `data` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `data` post type.
 */
function data_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['data'] = [
		/* translators: %s: Number of Data. */
		'updated'   => _n( '%s Data updated.', '%s Data updated.', $bulk_counts['updated'], 'wpcli-import-data-plugin' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Data not updated, somebody is editing it.', 'wpcli-import-data-plugin' ) :
						/* translators: %s: Number of Data. */
						_n( '%s Data not updated, somebody is editing it.', '%s Data not updated, somebody is editing them.', $bulk_counts['locked'], 'wpcli-import-data-plugin' ),
		/* translators: %s: Number of Data. */
		'deleted'   => _n( '%s Data permanently deleted.', '%s Data permanently deleted.', $bulk_counts['deleted'], 'wpcli-import-data-plugin' ),
		/* translators: %s: Number of Data. */
		'trashed'   => _n( '%s Data moved to the Trash.', '%s Data moved to the Trash.', $bulk_counts['trashed'], 'wpcli-import-data-plugin' ),
		/* translators: %s: Number of Data. */
		'untrashed' => _n( '%s Data restored from the Trash.', '%s Data restored from the Trash.', $bulk_counts['untrashed'], 'wpcli-import-data-plugin' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'data_bulk_updated_messages', 10, 2 );
