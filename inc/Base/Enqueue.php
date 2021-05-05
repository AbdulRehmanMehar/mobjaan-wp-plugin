<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;

use Mobjaan\Base\Constants;


class Enqueue 
{

    /**
     * The bare bone function to add wordpress actions, hooks or filters
     * @param 
     * @return 
     */
    function register() 
    {
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_assets') );
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue_assets') );
    }


    /**
     * Admin Styles and scripts
     * @param 
     * @return 
     */
    function enqueue_admin_assets() 
    {
        wp_enqueue_style('mobjaanpluginstyle', Constants::getPluginURL() . 'assets/css/main.css');
        wp_enqueue_script('mobjaanpluginscript', Constants::getPluginURL() . 'assets/js/main.js');
    }

    /**
     * Standard Styles and scripts
     * @param 
     * @return 
     */
    function enqueue_assets() 
    {
        wp_enqueue_style('mobjaanpluginstyle_bootstrap', Constants::getPluginURL() . 'assets/css/bootstrap.min.css');
        wp_enqueue_style('mobjaanpluginstyle_ratingcss', Constants::getPluginURL() . 'assets/css/rating.css');
        wp_enqueue_style('mobjaanpluginstyle_customcss', Constants::getPluginURL() . 'assets/css/client.css');
    }

}