<?php
add_action('wp_ajax_insset_admin_function', array('Insset_Controllers_Admin', 'update'));
class Insset_Controllers_Admin
{

    static public function update()
    {

        check_ajax_referer('ajax_nonce_insset', 'security');

        if ((!isset ($_REQUEST)) || sizeof(@$_REQUEST) < 1)
            exit;

        foreach ($_REQUEST as $key => $value)
            if ($$key = (string) trim($value))
                Insset_Crud::setData($key, $$key); //méthode statique

        print 'ok';
        exit;

    }

}
