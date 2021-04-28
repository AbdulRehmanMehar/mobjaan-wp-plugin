<?php

/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Base;

class Enqueue {

    function register() {
        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin_assets') );
    }


    function enqueue_admin_assets() {
        wp_enqueue_style('mobjaanpluginstyle', PLUGIN_URL . 'assets/css/main.css');
        wp_enqueue_script('mobjaanpluginscript', PLUGIN_URL . 'assets/js/main.js');
    }
}