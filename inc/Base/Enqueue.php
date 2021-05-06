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
        wp_enqueue_style( 
            'font-awesome-5', 
            'https://use.fontawesome.com/releases/v5.3.0/css/all.css', 
            array(), 
            '5.3.0' 
        );
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
        wp_enqueue_style('mobjaanpluginstyle_testimonialscss', Constants::getPluginURL() . 'assets/css/testimonials.css');
        wp_enqueue_script('jquery_custom', 'https://code.jquery.com/jquery-3.6.0.min.js');
        wp_enqueue_script('popperjs', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js');
        wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js');
    }

}