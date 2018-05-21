<?php

add_action(
	'init', function () {
		register_post_type(
			'template', [
				'labels'              => [
					'name'               => _x( 'Templates', 'post type general name', 'boilerplate' ),
					'singular_name'      => _x( 'Template', 'post type singular name', 'boilerplate' ),
					'menu_name'          => _x( 'Templates', 'admin menu', 'boilerplate' ),
					'name_admin_bar'     => _x( 'Template', 'add new on admin bar', 'boilerplate' ),
					'add_new'            => _x( 'Add New', 'book', 'boilerplate' ),
					'add_new_item'       => __( 'Add New Template', 'boilerplate' ),
					'new_item'           => __( 'New Template', 'boilerplate' ),
					'edit_item'          => __( 'Edit Template', 'boilerplate' ),
					'view_item'          => __( 'View Template', 'boilerplate' ),
					'all_items'          => __( 'All Templates', 'boilerplate' ),
					'search_items'       => __( 'Search Templates', 'boilerplate' ),
					'parent_item_colon'  => __( 'Parent Templates:', 'boilerplate' ),
					'not_found'          => __( 'No templates found.', 'boilerplate' ),
					'not_found_in_trash' => __( 'No templates found in Trash.', 'boilerplate' ),
				],
				'supports'            => [ 'title' ],
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 20,
				'menu_icon'           => 'dashicons-schedule',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'map_meta_cap'        => true,
			]
		);
	}
);

add_action(
	'add_meta_boxes', function () {
		remove_meta_box( 'wpseo_meta', 'template', 'normal' );
	}
);
