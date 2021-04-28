<?php

/**
 * @package MobjaanPlugin
 */

namespace Mobjaan;

class Init {

    /**
     * Loop through the classes and call register method if exists
     * @return 
     */
    static function register_services() 
    {
        foreach(self::get_services() as $obj) {
            $service = self::instantiate($obj);

            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }


    /**
     * Holds array of the service classes
     * @return array of classes
     */
    private static function get_services() 
    {
        return [
            Base\Enqueue::class,
            Pages\Admin::class
        ];
    }


    /**
     * Creates the instance of a service class and returns it
     * @param class $class   class from the serivces array
     * @return class   new instance of the service class...
     */
    private static function instantiate($class) {
        return new $class();
    }

}