<?php

/**
 * @package MobjaanPlugin
 */

namespace Mobjaan\Admin;

class Dashboard {
    function custom_post_type() {
        register_post_type( 'listings', ['public' => true, 'label' => 'Listings'] );
    }

    function enqueue_admin_assets() {
        wp_enqueue_style( 'mobjaanpluginstyle', plugins_url( '../../assets/css/main.css', __FILE__ ) );
        wp_enqueue_script('mobjaanpluginscript', plugins_url( '../../assets/js/main.js', __FILE__ ));
    }

    function add_admin_pages() {
        add_menu_page( 'Mobjaan Plugin', 'Mobjaan', 'manage_options', 'mobjaan', array($this, 'admin_pages_template_index'), 'dashicons-schedule', 40 );
    }

    function admin_pages_template_index() {
        require_once plugin_dir_path( __FILE__ ) . '../../templates/admin/index.php';
    }

    function plugin_link_filter($links) {
        $settings_link = '<a href="admin.php?page=mobjaan">Settings</a>';
        $developer_link = '<a href="https://github.com/AbdulRehmanMehar" target="_blank">Developer?</a>';

        array_push($links, $settings_link, $developer_link);
        return $links;
    }
}