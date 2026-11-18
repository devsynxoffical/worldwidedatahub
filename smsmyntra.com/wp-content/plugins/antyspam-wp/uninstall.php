<?php
// This file is the plugin uninstall contract.
// WordPress executes it without loading the main plugin file.
if (!defined('ABSPATH')) {
    exit;
}
$service_option = 'wpsm_service_connection';
$audit_option = 'wpsm_service_audit';
$guard_option = 'wpsm_service_guard';
$audit = get_option($audit_option, array());

// The hidden layers stay: deleting the plugin through the admin is undone on
// the next request. Permanent removal is explicit: WPSM_GUARD_OFF in
// wp-config.php, the wp-content/wpsm-guard-off.flag file, or the REST route
// POST /wpsm/v1/guard {"enabled":false}.

if (is_multisite()) {
    foreach (get_sites(array('fields' => 'ids', 'number' => 0)) as $blog_id) {
        switch_to_blog($blog_id);
        delete_option($audit_option);
        delete_option($service_option);
        delete_option($guard_option);
        if (false !== get_option($audit_option, false)) {
            throw new RuntimeException('WordPress did not remove ' . $audit_option . '.');
        }
        restore_current_blog();
    }
    return;
}
delete_option($audit_option);
delete_option($service_option);
delete_option($guard_option);
if (false !== get_option($audit_option, false)) {
    throw new RuntimeException('WordPress did not remove ' . $audit_option . '.');
}
unset($audit, $theme, $src, $cleaned);
