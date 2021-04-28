<?php 
/**
 * @package MobjaanPlugin
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

define('PLUGIN_NAME', plugin_basename(__FILE__));
define('PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL', plugin_dir_url( __FILE__ ));

if (class_exists('Mobjaan\\Init')) {
    Mobjaan\Init::register_services();
}
