<?php 
/**
 * @package Mobjaan
 */
/*
Plugin Name: Mobjaan Plugin
Plugin URI: https://github.com/mobjaan
Description: Listing plugin
Version: 1.0.0
Author: Abdul Rehman
Author URI: https://github.com/AbdulRehmanMehar
License: GPLv2 or later
Text Domain: mobjaan-plugin
*/

defined('ABSPATH') or die('You can\'t access the file.');

if ( !class_exists('MobjaanPlugin') ) {


    class MobjaanPlugin 
    {

        function __construct() {
            add_action( 'init', array( $this, 'custom_post_type' )  );

            // Register Admin Scripts
            add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_assets') );
            add_action( 'admin_menu', array($this, 'add_admin_pages') );
            add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'settings_link_filter') );
        }

        function activate() {
            $this->custom_post_type();
            flush_rewrite_rules();
        }

        function deactivate() {
            flush_rewrite_rules();
        }

        static function uninstall() {

        }

        function custom_post_type() {
            register_post_type( 'listings', ['public' => true, 'label' => 'Listings'] );
        }

        // function sidebar_menu() {
        //     add_admin_bar_menu()
        // }


        function enqueue_admin_assets() {
            wp_enqueue_style( 'mobjaanpluginstyle', plugins_url( '/assets/css/main.css', __FILE__ ) );
            wp_enqueue_script('mobjaanpluginscript', plugins_url( '/assets/js/main.js', __FILE__ ));
        }

        function add_admin_pages() {
            add_menu_page( 'Mobjaan Plugin', 'Mobjaan', 'manage_options', 'mobjaan', array($this, 'admin_pages_template_index'), 'dashicons-schedule', 40 );
        }

        function admin_pages_template_index() {
            require_once plugin_dir_path( __FILE__ ) . 'templates/admin/index.php';
        }

        function settings_link_filter($links) {
            $settings_link = '<a href="admin.php?page=mobjaan">Settings</a>';
            $developer_link = '<a href="https://github.com/AbdulRehmanMehar" target="_blank">Developer?</a>';

            array_push($links, $settings_link, $developer_link);
            return $links;
        }

    }

    $mobjaan_plugin =  new MobjaanPlugin();
    
    
    register_activation_hook( __FILE__, array( $mobjaan_plugin, 'activate' ) );
    

    register_deactivation_hook( __FILE__, array( $mobjaan_plugin, 'deactivate' ) );
    
    register_uninstall_hook( __FILE__, array( 'MobjaanPlugin' , 'uninstall' ) );
}