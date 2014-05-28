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

// GitHub Updater
include_once('updater.php');

if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'taxonomy-series', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/ierhyna/taxonomy-series', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/ierhyna/taxonomy-series/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/ierhyna/taxonomy-series', // the github url of your github repo
        'zip_url' => 'https://github.com/ierhyna/taxonomy-series/zipball/master', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.9.1', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > Github Updates when this example plugin is installed
    );
    new WP_GitHub_Updater($config);
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

// Hook into the 'init' action
add_action( 'init', 'taxonomy_series', 0 );
?>
