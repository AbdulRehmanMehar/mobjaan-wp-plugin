<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Pages;

use Mobjaan\Base\Constants;


class Home 
{
    function register() {

        add_action( 'wp_head', array($this, 'injectIt') );

    }

    function injectIt() {
        load_template( Constants::getPluginPath() . 'templates/standard/auth/login.php' );
    }
}