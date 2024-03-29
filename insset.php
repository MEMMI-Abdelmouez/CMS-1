<?php
/*
Plugin Name: insset
Plugin URI: https://memmi.com/
Description: Ceci est le plugin  de Abdelmouez
Author: Abdelmouez MEMMI
Version: 1.0
Author URI: http://memmi.com/
*/

define('INSSET_FILE', __FILE__);
define('INSSET_DIR', dirname(INSSET_FILE));
define('INSSET_BASENAME', pathinfo((INSSET_FILE))['filename']);
define('INSSET_PLUGIN_NAME', INSSET_BASENAME);

register_activation_hook(__FILE__, function () {
    new Insset_Install();
});

foreach (glob(INSSET_DIR . '/classes/*/*.php') as $filename)
    if (!preg_match('/export|cron/i', $filename))
        if (!@require_once $filename)
            throw new Exception(sprintf(__('Failed to include %s'), $filename));

if (is_admin())
    new Insset_Admin();

