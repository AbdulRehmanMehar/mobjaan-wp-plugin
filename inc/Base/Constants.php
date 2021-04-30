<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;


class Constants 
{

    static function getPluginPath() 
    {
        return plugin_dir_path( dirname(__FILE__, 2) );
    }

    static function getPluginName() 
    {
        return plugin_basename( dirname(__FILE__, 3) ) . '/mobjaan-plugin.php';
    }

    static function getPluginURL() 
    {
        return plugin_dir_url( dirname(__FILE__, 2) );
    }

}
