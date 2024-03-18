<?php
class Insset_Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'init'));
        add_action('admin_enqueue_scripts', array($this, 'assets'), 999);
        return;
    }

    public function init()
    {

        add_menu_page(
            __('Insset / Settings'),
            __('Insset'),
            'administrator',
            'insset_settings',
            array($this, 'insset_settings'),
            'images/marker.png',
            399
        );

        add_submenu_page(
            'insset_settings',
            __('Insset / Settings'),
            __('Settings'),
            'administrator',
            'insset_settings',
            array($this, 'insset_settings')
        );

    }
    public function insset_settings()
    {
        $Insset_Settings = new Insset_Settings();
        return $Insset_Settings->display();

    }

    public function assets()
    {

        wp_register_script('inssetjs', plugins_url(INSSET_PLUGIN_NAME . '/assets/js/Insset_Admin.js'), array('jquery'), '1.0', true);

        wp_localize_script(
            'inssetjs',
            'inssetjs',
            array(
                'security' => wp_create_nonce('ajax_nonce_insset'),
                'ajax_url' => admin_url('admin-ajax.php')
            )
        );

        wp_enqueue_script('inssetjs');
        wp_enqueue_style('insset-style', plugins_url(INSSET_PLUGIN_NAME . '/assets/css/insset-style.css'));

    }


}

