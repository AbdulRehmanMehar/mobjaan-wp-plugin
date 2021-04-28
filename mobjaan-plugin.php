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


$autoload = dirname(__FILE__). '/vendor/autoload.php';

if (!file_exists($autoload)) {  
    die ('Problem with Composer Autoload');
} 

require_once $autoload;

use Mobjaan\Admin\Dashboard as AdminDashboard;

if ( !class_exists('MobjaanPlugin') ) {


    class MobjaanPlugin 
    {
        private $admin;

        function __construct() {
            $this->admin = new AdminDashboard();
            add_action( 'init', array( $this->admin, 'custom_post_type' )  );

            // Register Admin Scripts
            add_action( 'admin_enqueue_scripts', array($this->admin, 'enqueue_admin_assets') );
            add_action( 'admin_menu', array($this->admin, 'add_admin_pages') );
            add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this->admin, 'plugin_link_filter') );
        }

        function activate() {
            $this->admin->custom_post_type();
            flush_rewrite_rules();
        }

        function deactivate() {
            flush_rewrite_rules();
        }

        static function uninstall() {

        }
    }


    
    $mobjaan_plugin =  new MobjaanPlugin();
    register_activation_hook( __FILE__, array( $mobjaan_plugin, 'activate' ) );
    register_deactivation_hook( __FILE__, array( $mobjaan_plugin, 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'MobjaanPlugin' , 'uninstall' ) );
}