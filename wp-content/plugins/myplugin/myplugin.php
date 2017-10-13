<?php
    /*
    Plugin Name: myplugin
    Plugin URI: http://www.orangecreative.net
    Description: Plugin for displaying products from an OSCommerce shopping cart database
    Author: C. Lupu
    Version: 1.0
    Author URI: http://www.orangecreative.net
    */
	function my_form() {
    include('my_test_form.php');
	}
	
	function my_form_list(){
	include('list.php');	
	}
	
	add_action('admin_menu', 'my_plugin_admin');
	function my_plugin_admin(){
		add_menu_page('My Page Title', 'My Plugin', 'manage_options', 'my-menu', 'my_form' );
		add_submenu_page('my-menu', 'Displaying page List', 'Page List', 'manage_options', 'my_form_list' );
		//add_submenu_page('my-menu', 'Submenu Page Title2', 'Whatever You Want2', 'manage_options', 'my-menu2' );
	}
	
	 
	
    //adding menu to dashboard 
    add_action('admin_menu', 'my_plugin_admin');
	//add_action('admin_menu', 'my_plugin_admin_submenu');
	
	
	//adding submenu to myplugin 
	//add_submenu_page("My Plugin","Displaying The List Of Articles","List","manage_options","my-submenu-handle","my_form_list"); 
	
	
	/*add_action('admin_menu', 'sep_menuexample_create_menu' );
	
	function sep_menuexample_create_menu() {
	//create custom top-level menu
	add_menu_page( 'My Plugin Settings Page', 'Menu Example Settings','manage_options', __FILE__, 'sep_menuexample_settings_page',screen_icon('edit'));
	add_submenu_page( __FILE__, 'About My Plugin', 'About', 'manage_options',__FILE__.'_about', sep_menuexample_about_page );
	}
	
	 
	add_action( 'admin_menu', 'sep1_menuexample_create_menu' );
	function sep1_menuexample_create_menu() {
	//create a submenu under Settings
	add_options_page( 'My Plugin Settings Page', 'Menu Example Settings','manage_options', __FILE__, 'sep_menuexample_settings_page' );
	}

    */
	 

 ?>