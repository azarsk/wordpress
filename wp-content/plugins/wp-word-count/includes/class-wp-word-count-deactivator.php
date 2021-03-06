<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://linksoftwarellc.com/wp-word-count
 * @since      2.0.1
 *
 * @package    Wp_Word_Count
 * @subpackage Wp_Word_Count/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      2.0.1
 * @package    Wp_Word_Count
 * @subpackage Wp_Word_Count/includes
 * @author     Link Software LLC <support@linksoftwarellc.com>
 */
class Wp_Word_Count_Deactivator {

	/**
	 * Remove tables and options.
	 *
	 * Remove all data from the WordPress database that WP Word Count has generated.
	 *
	 * @since    2.0.1
	 */
	public static function deactivate() {
		
		global $wpdb;
		
		// Empty database tables the plugin has made
		$table_name_posts = $wpdb->prefix.'wpwc_posts';
		
		$wpdb->query("DELETE FROM $table_name_posts");
		$wpdb->query("DROP TABLE $table_name_posts");
		
		// Delete options the plugin has made
		delete_option('wpwc_version');
		delete_option('wpwc_post_types');

	}

}
