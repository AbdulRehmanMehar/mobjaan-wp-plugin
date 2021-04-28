<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Base;


class Plugin 
{
    
    /**
     * Runs on plugin activation
     * @param 
     * @return 
     */
    static function activate() 
    {
        flush_rewrite_rules();
    }

    /**
     * Runs on plugin deactivation
     * @param 
     * @return 
     */
    static function deactivate() 
    {
        flush_rewrite_rules();
    }

}