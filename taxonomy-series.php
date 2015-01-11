<?php
/*
Plugin Name: Post Series by oriolo
Plugin URI: http://oriolo.ru/posts-series-plugin/
Description: Plugin creates Custom Taxonomy called Series to posts. So you can use not only categories and tags, but also series to categorize your posts.
Version: 1.0.2
Author: Irina Sokolovskaja
Author URI: http://oriolo.ru
License: GPLv2
*/


add_action( 'init', 'github_plugin_updater' ); // using GitHub updater
function github_plugin_updater() {
	include_once 'updater.php';
	define( 'WP_GITHUB_FORCE_UPDATE', true );
	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'taxonomy-series',
			'api_url' => 'https://api.github.com/repos/ierhyna/taxonomy-series',
			'raw_url' => 'https://raw.github.com/ierhyna/taxonomy-series/master',
			'github_url' => 'https://github.com/ierhyna/taxonomy-series',
			'zip_url' => 'https://github.com/ierhyna/taxonomy-series/archive/master.zip',
			'sslverify' => true,
			'requires' => '2.8.0',
			'tested' => '4.1',
			'readme' => 'README.md',
			'access_token' => '',
		);
		new WP_GitHub_Updater( $config );
	}
}



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

//runs only when the theme is set up
function taxonomy_series_flush_rules(){
	//defines the post type so the rules can be flushed.
	taxonomy_series();

	//and flush the rules.
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'taxonomy_series_flush_rules');

// Hook into the 'init' action
add_action( 'init', 'taxonomy_series', 0 );
?>
