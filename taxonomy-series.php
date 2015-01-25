<?php
/*
Plugin Name: Post Series by oriolo
Plugin URI: http://oriolo.ru/posts-series-plugin/
Description: Plugin creates Custom Taxonomy called Series to posts. So you can use not only categories and tags, but also series to categorize your posts.
Version: 1.1
Author: Irina Sokolovskaja
Author URI: http://oriolo.ru
License: GPLv2
*/

function github_plugin_updater(){ 
	// register actions
	add_action( 'init', 'github_plugin_updater' ); // using GitHub updater

	// add updater
	require_once(sprintf("%s/updater.php", dirname(__FILE__)));
	define( 'WP_GITHUB_FORCE_UPDATE', true );
	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'taxonomy-series',
			'api_url' => 'https://api.github.com/repos/ierhyna/taxonomy-series',
			'raw_url' => 'https://raw.github.com/ierhyna/taxonomy-series/dev',
			'github_url' => 'https://github.com/ierhyna/taxonomy-series',
			'zip_url' => 'https://github.com/ierhyna/taxonomy-series/archive/dev.zip',
			'sslverify' => true,
			'requires' => '2.8.0',
			'tested' => '4.1',
			'readme' => 'readme.txt',
			'access_token' => '',
		);
		new WP_GitHub_Updater( $config );
	}
}

if(!class_exists('Taxonomy_Series'))
{
	class Taxonomy_Series
	{
	/**
	* Construct the plugin object
	*/
	public function __construct()
		{
			// register taxonomy
			require_once(sprintf("%s/series-template.php", dirname(__FILE__)));
			$Post_Series_Taxonomy = new Post_Series_Taxonomy();

		} // END public function __construct

		/**
		* Activate the plugin
		*/
		public static function activate()
		{
			// flush the rewrite rules
			// create_taxonomy_series();
			flush_rewrite_rules();
		} // END public static function activate

		/**
		* Deactivate the plugin
		*/
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate
	} // END class Taxonomy_Series
} // END if(!class_exists('Taxonomy_Series'))

if(class_exists('Taxonomy_Series'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Taxonomy_Series', 'activate'));
	register_deactivation_hook(__FILE__, array('Taxonomy_Series', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new Taxonomy_Series();
}

?>
