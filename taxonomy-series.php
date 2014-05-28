<?php
/*
Plugin Name: Series Taxonomy
Plugin URI: http://oriolo.ru
Description: That plugin creates Custom Taxonomy called Series to posts. Based on Category.
Version: 1.1
Author: Irina Sokolovskaja
Author URI: http://oriolo.ru
License: GPLv2
*/


// Register Custom Taxonomy
function taxonomy_series() {

	$labels = array(
		'name'                       => _x( 'Series', 'Series', 'oriolo' ),
		'singular_name'              => _x( 'Series', 'Series', 'oriolo' ),
		'menu_name'                  => __( 'Series', 'oriolo' ),
		'all_items'                  => __( 'All Items', 'oriolo' ),
		'parent_item'                => __( 'Parent Item', 'oriolo' ),
		'parent_item_colon'          => __( 'Parent Item:', 'oriolo' ),
		'new_item_name'              => __( 'New Item Name', 'oriolo' ),
		'add_new_item'               => __( 'Add New Item', 'oriolo' ),
		'edit_item'                  => __( 'Edit Item', 'oriolo' ),
		'update_item'                => __( 'Update Item', 'oriolo' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'oriolo' ),
		'search_items'               => __( 'Search Items', 'oriolo' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'oriolo' ),
		'choose_from_most_used'      => __( 'Choose from the most used items', 'oriolo' ),
		'not_found'                  => __( 'Not Found', 'oriolo' ),
	);
	$rewrite = array(
		'slug'                       => 'series',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'series', 'post', $args );

}

// Hook into the 'init' action
add_action( 'init', 'taxonomy_series', 0 );
?>
