<?php
/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Base;


class Taxonomy 
{
    function register() 
    {
        add_action( 'init', array($this, 'addTaxonomies'));
    }

    function addTaxonomies()
    {
        register_taxonomy( 'mobjaan_plugin_location_taxonomy', array('listings'), [
            'labels' => [
                'name' => 'Location',
            ],
            'show_admin_column' => false,
            'hierarchical' => true,
            'rewrite' => false
        ]);
    }
}