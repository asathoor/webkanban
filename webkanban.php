<?php
/*
Plugin Name: Webkanban
Plugin URI: http://multimusen.dk/Webkanban
Description: Webkanban with a changelog for project management.
Version: 0.2
Author: Per Thykjaer Jensen, MA 
Author URI: http://multimusen.dk
License: (C) GPLv3 Per Thykjaer Jensen - 2013. 
*/

session_start();

/**
* The stylesheet
*/

add_action( 'admin_enqueue_scripts', 'safely_add_stylesheet_to_admin' );
    /**
     * Add stylesheet to the page
     */
    function safely_add_stylesheet_to_admin() {
        wp_enqueue_style( 'prefix-style', plugins_url('KbnCss.css', __FILE__) );
    }

/**
* GLOBAL FUNCTIONS
* e.g. $wpdb for database management and global classes
* also errors from PHP is on / off here
*/
include_once('config.php');

/**
* INSTALL
* First time install of the database.
*/
include_once('kbnInstall.php');


/**
* MENUS IN DASHBOARD
*/
include_once('kbnMenu.php');

/**
* Shortcode
* Displaying kanbans on pages, posts and dashboards.
*/
include('KbnShortcode.php');

?>
