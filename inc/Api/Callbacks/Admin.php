<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Api\Callbacks;

use Mobjaan\Base\Constants;


class Admin 
{   
    
    function adminDashboard()
    {
        return require_once Constants::getPluginPath() . 'templates/admin/index.php';
    }


}