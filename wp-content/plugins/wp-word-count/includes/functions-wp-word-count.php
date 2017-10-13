<?php

/**
 * The file that defines the core plugin functions
 *
 * Includes functions used across both the public-facing side of the site and the admin area.
 *
 * @link       http://linksoftwarellc.com/wp-word-count
 * @since      2.0.0
 *
 * @package    Wp_Word_Count
 * @subpackage Wp_Word_Count/includes
 */

/**
 * The core plugin functions.
 *
 * This is used to define functions for database issues on the admin and public side.
 *
 * @since      2.0.0
 * @package    Wp_Word_Count
 * @subpackage Wp_Word_Count/includes
 * @author     Link Software LLC <support@linksoftwarellc.com>
 */
 
/**
* Store all posts data to the plugin table
*
* @since    2.0.0
*/	
function wpwc_populate_plugin_tables() {
	
	$post_types = get_option('wpwc_post_types');
	
	global $wpdb;
	
	$table_name = $wpdb->prefix.'wpwc_posts';
	$wpdb->query("DELETE FROM $table_name");
	
	$post_types = get_post_types('', 'names');

	$args = array(
		
		'post_type' => $post_types,
		'post_status' => array('publish', 'draft'),
		'orderby'   => 'ID',
		'order'     => 'ASC',
		'posts_per_page' => -1
		
	);

	$query = new WP_Query($args);
	
	foreach ($query->posts as $post) {
	
		if ($post->post_author != 0 && $post->post_type != 'attachment' && $post->post_type != 'nav_menu_item') {
		
			wpwc_save_post_data($post);
	
		}
	
	}
}

/**
 * Maintain our plugin table with post-related information
 *
 * @since   2.0.0
 * @param	int		$post_id	The post ID.
 * @param	post	$post		The post object.
 */
function wpwc_save_post_data($post) {
	
	global $wpdb;
	
	if ($post && $post->post_author != 0) {
		
		$post_word_count = wpwc_word_count($post->post_content);
		$table_name = $wpdb->prefix.'wpwc_posts';
		
		$sql_post_data = "
			INSERT INTO $table_name (post_id, post_author, post_date, post_status, post_modified, post_parent, post_type, post_word_count) 
			VALUES (%d, %d, %s, %s, %s, %s, %s, %d) 
			ON DUPLICATE KEY UPDATE 
			post_date = %s, 
			post_status = %s, 
			post_modified = %s, 
			post_parent = %d, 
			post_type = %s, 
			post_word_count = %d";
		$post_data = $wpdb->prepare($sql_post_data, $post->ID, $post->post_author, $post->post_date, $post->post_status, $post->post_modified, $post->post_parent, $post->post_type, $post_word_count, $post->post_date, $post->post_status, $post->post_modified, $post->post_parent, $post->post_type, $post_word_count);
		$wpdb->query($post_data);
		
	}
	
}

/**
 * Calculate word count in a given set of text.
 *
 * @since 	2.0.0
 * @param	string	$content	The post content
 */
function wpwc_word_count($content) {
	
	
	
	
	
	$content = strip_tags( nl2br( $content ) );
	 // echo $full_description = preg_replace('/style=\\"[^\\"]*\\"/', '', $content);exit;
	  
	  
	  $text = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
          // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $content);
		
		echo $text;exit;
	  
	  
	  
	  
	  
	 //echo reg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
	 echo preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $content);
	 //$value = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $value);


	 
	
	if ( preg_match( "/[\x{4e00}-\x{9fa5}]+/u", $content ) ) {
		 
		$content = preg_replace( '/[\x80-\xff]{1,3}/', ' ', $content, -1, $n );
		$n += str_word_count($content);
		
		return $n;
	
	} else {
		
		return count( preg_split( '/\s+/', $content ) );
		
	}
	
}

/**
* Store the plugin version as an option.
*
* @since 	2.0.0
* @param	string	$wpwc_version	The latest plugin version.
*/	
function wpwc_set_plugin_version($wpwc_version) {

	update_option('wpwc_version', $wpwc_version);

}

/**
* Create the necessary table(s) for our plugin data.
*
* @since    2.0.0
*/	
function wpwc_create_plugin_tables() {

	require_once(ABSPATH.'wp-admin/includes/upgrade.php');

	global $wpdb;

	// Create database table
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix.'wpwc_posts';
	
	$sql = "CREATE TABLE $table_name (
		post_id bigint(20) NOT NULL,
		post_author bigint(20) NOT NULL,
		post_date datetime NOT NULL,
		post_status varchar(20) NOT NULL,
		post_modified datetime NOT NULL,
		post_parent bigint(20) NOT NULL,
		post_type varchar(20) NOT NULL,
		post_word_count bigint(20) NOT NULL,
		UNIQUE KEY post_id (post_id)
	) $charset_collate;";
	dbDelta($sql);
}