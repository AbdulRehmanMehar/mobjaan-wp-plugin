<?php
/**
 * @package MobjaanPlugin
 */
namespace Mobjaan\Pages;

use Mobjaan\Base\Constants;
use Mobjaan\Api\SettingsApi;
use Mobjaan\Api\Callbacks\Admin as Callbacks;

class Admin
{

    private $pages;
    private $settings;
    private $sub_pages;
    private $callbacks;

    function __construct() 
    {
        $this->callbacks = new Callbacks();
        $this->settings = new SettingsApi();
        $this->initPages();
    }

    /**
     * The bare bone function to add wordpress actions, hooks or filters
     * @param 
     * @return 
     */
    function register() 
    {
        add_action( 'init', array( $this, 'custom_post_type' )  );
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->sub_pages)->register();
        add_filter( 'plugin_action_links_' . Constants::getPluginName(), array($this, 'plugin_link_filter') );
    }

    function initPages() {
        $this->pages = array(
            array(
                'page_title' => 'Mobjaan Plugin',
                'menu_title' => 'Mobjaan',
                'capability' => 'manage_options',
                'menu_slug' => 'mobjaan',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-schedule',
                'position' => 40
            )
        );

        $this->sub_pages = array(
            array(
                'page_title' => 'Listings',
                'menu_title' => 'Listings',
                'capability' => 'manage_options',
                'menu_slug' => 'edit.php?post_type=listings',
                'parent_slug' => 'mobjaan'
            ),
            array(
                'page_title' => 'Reviews',
                'menu_title' => 'Reviews',
                'capability' => 'manage_options',
                'menu_slug' => 'edit.php?post_type=reviews',
                'parent_slug' => 'mobjaan'
            ),
            array(
                'page_title' => 'Location',
                'menu_title' => 'Location',
                'capability' => 'manage_options',
                'menu_slug' => 'edit-tags.php?taxonomy=mobjaan_plugin_location_taxonomy',
                'parent_slug' => 'mobjaan'
            )
        );
    }

    /**
     * creates custom post type named "LISTINGS"..... 
     * Gets called by init hook
     * @param 
     * @return 
     */
    function custom_post_type() 
    {
        register_post_type( 'listings', [
            'public' => true, 
            'label' => 'Listings', 
            'show_in_menu' => false,
            'supports'   => array( 'title', 'editor', 'author', 'thumbnail' ),
            'taxonomies' => array('category', 'post_tag')
        ]);


        register_post_type( 'reviews', [
            'label' => 'Reviews',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 40,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
            'show_in_rest'       => false,
            'show_in_menu' => false
        ] );

    }
    
    /**
     * Plugin Actions Link
     * adds setting and developer portal links.... 
     * @param 
     * @return 
     */
    function plugin_link_filter($links)
    {
        $settings_link = '<a href="admin.php?page=mobjaan">Settings</a>';
        $developer_link = '<a href="https://github.com/AbdulRehmanMehar" target="_blank">Developer?</a>';

        array_push($links, $settings_link, $developer_link);
        return $links;
    }
    
}