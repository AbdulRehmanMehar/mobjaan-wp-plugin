<?php

/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Pages;

class Admin {

    function register() {
        add_action( 'init', array( $this, 'custom_post_type' )  );
        add_action( 'admin_menu', array($this, 'add_admin_pages') );
        add_filter( 'plugin_action_links_' . PLUGIN_NAME, array($this, 'plugin_link_filter') );
    }

    function custom_post_type() {
        register_post_type( 'listings', ['public' => true, 'label' => 'Listings'] );
    }

    function add_admin_pages() {
        add_menu_page( 'Mobjaan Plugin', 'Mobjaan', 'manage_options', 'mobjaan', array($this, 'admin_pages_template_index'), 'dashicons-schedule', 40 );
    }

    function admin_pages_template_index() {
        require_once PLUGIN_PATH . 'templates/admin/index.php';
    }

    function plugin_link_filter($links) {
        $settings_link = '<a href="admin.php?page=mobjaan">Settings</a>';
        $developer_link = '<a href="https://github.com/AbdulRehmanMehar" target="_blank">Developer?</a>';

        array_push($links, $settings_link, $developer_link);
        return $links;
    }
}