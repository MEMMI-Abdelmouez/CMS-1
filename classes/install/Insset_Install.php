<?php

class Insset_Install
{
    public function __construct()
    {
        $this->setup();
        return;
    }

    public function setup()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

        $sql_param = '
        CREATE TABLE IF NOT EXISTS `' . $wpdb->prefix . INSSET_BASENAME . '_config` (
            `id` VARCHAR(255) NOT NULL,
            `value` VARCHAR(255) NOT NULL,
            `description` VARCHAR(255) NULL,
            `rank` INT(11),
            PRIMARY KEY (`id`, `value`)
        ) ENGINE=InnoDB ' . $charset_collate;

        if (dbDelta($sql_param)) {
            $wpdb->insert($wpdb->prefix . INSSET_BASENAME . '_config', array('id' => 'dateOuverture', 'value' => date('Y-m-d H:i:s'), 'description' => 'Date Ouverture', 'rank' => 10));
            $wpdb->insert($wpdb->prefix . INSSET_BASENAME . '_config', array('id' => 'dateFermeture', 'value' => date('Y-m-d H:i:s'), 'description' => 'Date Fermeture', 'rank' => 20));
        }
    }
}

