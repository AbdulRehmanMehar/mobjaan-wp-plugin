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

register_activation_hook(__FILE__, array('Mobjaan\\Base\\Plugin', 'activate'));
register_deactivation_hook(__FILE__, array('Mobjaan\\Base\\Plugin', 'deactivate'));


if (class_exists('Mobjaan\\Init')) {
    Mobjaan\Init::register_services();
}
