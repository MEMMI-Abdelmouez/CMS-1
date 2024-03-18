<?php
class Insset_Settings
{
    public function display()
    {
        global $wpdb;

        $sql = 'SELECT * FROM  `' . $wpdb->prefix . INSSET_BASENAME . '_config` WHERE 1 ORDER BY `rank` ASC';
        $params = $wpdb->get_results($sql, 'ARRAY_A');

        ?>
        <div class="wrap generic-config" id="insset_param_update">
            <h1 class="wp-heading-inline">
                <?php print get_admin_page_title(); ?>
            </h1>
            <div class="notice notice-info notice-alt is-dismissible hide update-message">
                <p>
                    <?php _e('Successfully updated!'); ?>
                </p>
            </div>

            <table class="wp-list-table widefat fixed striped">
                <tfoot>
                    <tr>
                        <th colspan="2">
                            <button class="button button-primary left update" target="_blank">
                                <i class="fas fa-check"></i>
                                <?php _e('Update'); ?>
                            </button>
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($params as $param): ?>
                        <tr>
                            <th class="smallwidth" style="text-transform: capitalize;">
                                <?php print $param['id'] ?>
                            </th>
                            <td>
                                <?php if (preg_match('/html/i', $param['id'])): ?>
                                    <?php wp_editor(stripslashes($param['value']), $param['id'], array()); ?>
                                <?php elseif (preg_match('/date/i', $param['id'])): ?>
                                    <input type="datetime-local" id="<?php print $param['id'] ?>"
                                        value="<?php print preg_replace('/\s/', 'T', $param['value']) ?>" />
                                <?php elseif (preg_match('/^is|^display/i', $param['id'])): ?>
                                    <input id="<?php print $param['id'] ?>" type="checkbox" <?php print ((preg_match('/on|true/i', (string) $param['value'])) ? 'checked' : '') ?> />
                                <?php else: ?>
                                    <input id="<?php print $param['id'] ?>" type="text" value="<?php print $param['value'] ?>" />
                                <?php endif; ?>
                                <span class="helper-text">
                                    <?php print $param['description'] ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <?php
    }
}
