<?php

class Insset_Crud
{
    static public function setData($key, $value = '')
    {

        if (!$key)
            return false;

        global $wpdb;
        return $wpdb->update(
            $wpdb->prefix . INSSET_BASENAME . '_config',
            array(
                'value' => $value
            ),
            array(
                'id' => (string) $key,
            )
        );

    }

}