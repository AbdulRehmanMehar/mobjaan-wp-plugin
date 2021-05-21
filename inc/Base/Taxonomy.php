<?php
/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Base;


class Taxonomy 
{
    function register() 
    {
        add_action( 'init', array($this, 'addTaxonomies'), 0);
        
    }

    function addTaxonomies()
    {
        register_taxonomy( 'mobjaan_plugin_location_taxonomy', array('listings'), array(
            'hierarchical' => true,
            'labels' => [
                'name' => 'Location',
            ],
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'location' ),
        ));
        flush_rewrite_rules();
    }
}