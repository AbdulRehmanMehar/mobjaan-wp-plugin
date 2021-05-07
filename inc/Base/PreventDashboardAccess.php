<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;



class PreventDashboardAccess
{

    function register()
    {
        add_action( 'init', array($this, 'redirectBack'));
        add_action('after_setup_theme', array($this, 'removeAdminBar'));

    }

    function redirectBack()
    {
        if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('subscriber') || current_user_can('contributor') ) ){
            wp_redirect(home_url());
            exit;
        }
    }

    function removeAdminBar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }

}