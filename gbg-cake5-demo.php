<?php

/**
 * Gloubi Boulga WP CakePHP 5 adapter demo
 *
 * @wordpress-plugin
 *
 * Plugin Name:         Gloubi Boulga WP CakePHP 5 Adapter Demo
 * Plugin URI:          https://github.com/gloubi-boulga-team
 * Description:         Demonstrate how to use gbg-cake5 plugin (requires gbg-cake5 WP plugin)
 * Version:             5.0.0
 * Author:              Gloubi Boulga Team
 * Author URI:          https://github.com/gloubi-boulga-team
 * License:             MIT
 * License URI:         https://opensource.org/licenses/mit-license.php
 * Text Domain:         gbg-cake5-demo
 * Tested up to:        6.5
 * Requires at least:   6.2
 * Requires PHP:        8.1
 * Domain Path:         /resources/locales
 *
 * @package             Gbg\Cake5Demo
 */

declare(strict_types=1);

// phpcs:disable PSR1.Files.SideEffects -- some important checks need
// to be done before function declarations

defined('WPINC') || die;

// check blocking requirements -----------------------------------------------------------------------------------------

$phpMin = '8.1';
if (version_compare(PHP_VERSION, $phpMin, '<')) {
    add_action('admin_notices', function () use ($phpMin) {
        echo '<div class="notice notice-error">';
        echo '<p>';
        echo '<strong>' . sprintf(__('Plugin « %1$s » can not run because obsolete PHP version %2$s is not supported (should be >=%3$s). Upgrade it as soon as possible !', 'gbg-cake5'), 'Gloubi Boulga WP CakePHP 5 demo', PHP_VERSION, $phpMin); // phpcs:ignore Generic.Files.LineLength
        echo '</p>';
        echo '</div>';
    });
    return;
}

if (!is_plugin_active('gbg-cake5/gbg-cake5.php')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error">';
        echo '<p>';
        echo sprintf(__('Plugin « %s » can not work because the required plugin « %s » is not active.', 'gbg-cake5-demo'), 'Gloubi Boulga WP CakePHP 5 demo', 'Gloubi Boulga WP CakePHP 5 adapter'); // phpcs:ignore Generic.Files.LineLength
        echo '</p>';
        echo '</div>';
    }, 99);
    return;
}

// Say hello just for fun 😜

add_action('admin_notices', function () {
    echo '<div class="notice info">';
    echo '<p>';
    echo sprintf(
        __(
            'Plugin « %s » is running 👍🤩. But... the only interesting thing in this plugin resides in its php files where you can find some interesting code examples.', // phpcs:ignore Generic.Files.LineLength
            'gbg-cake5-demo'
        ),
        'Gloubi Boulga WP CakePHP 5 demo'
    );
    echo '</p>';
    echo '</div>';
}, 1);

// Include standalone utilities
/** @phpstan-ignore-next-line */
include_once WP_PLUGIN_DIR . '/gbg-cake5/src/Wrapper/Text.php';

/**
 * ---------------------------------------------------------------------------------------------------------------------
 * ------------- And after these knick-knacks, lets talk seriously of gbg-cake functionalities -------------------------
 * ---------------------------------------------------------------------------------------------------------------------
 */

include_once 'gbg-cake5-demo-orm.php';
include_once 'gbg-cake5-demo-cache.php';
include_once 'gbg-cake5-demo-log.php';

// also remember that Gbg/Core plugin brings a lot of useful utilities
add_action('Gbg/Core5.loaded', function () {

    //    $requirements = Gbg\Core5\Utility\Requirement::newInstance()
    //        ->requirePhpIniValue('memory_limit', '<1k OR (>10kB AND <15K) OR (>15k AND (>150TB OR <149TB))')
    //        ->requireFunction('file_exists OR gbgDump OR yourCustomFunction')
    //        ->requireWp('>=6.2 AND <=999.999', __gbg('Php version `%s` does not match requirement `>%s`'))
    //        ->requirePhp( '>999.999.999')
    //        ->requireFunction( 'unknownFunc');
    //
    //    if (!$requirements->isSatisfied()) {
    //        $requirements = implode(', ', $requirements->getErrorMessages());
    //        gbgAdminNotice(
    //          'error',
    //          __gbg(
    //              'Fake message from « %s » || BAD trip 😜 : %s',
    //              ['Gloubi Boulga WP CakePHP 5 demo', $requirements]
    //          )
    //      );
    //    }
}, 50);

register_activation_hook(__FILE__, 'gbgCake5DemoActivate');
register_deactivation_hook(__FILE__, 'gbgCake5DemoDeactivate');

/**
 * Activation hook to create gbg-cake5-demo tables
 */
function gbgCake5DemoActivate(): void
{

    global $wpdb;

    $tableName = $wpdb->prefix . 'gbg_cake5_demo_things';
    $sql = "CREATE TABLE `$tableName` (
        `id` int(11) unsigned NOT NULL,
        `column_text` varchar(255) DEFAULT NULL,
        `column_bool` tinyint(1) DEFAULT 0,
        `column_datetime` datetime DEFAULT NULL,
        `column_json` varchar(500) DEFAULT NULL,
        `created_at` datetime DEFAULT NULL,
        `created_by` int(11) DEFAULT NULL,
        `modified_at` datetime DEFAULT NULL,
        `modified_by` int(11) DEFAULT NULL,
        `archived_at` datetime DEFAULT NULL,
        `archived_by` int(11) DEFAULT NULL,
        PRIMARY KEY(id)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

    if ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") !== $tableName) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    $tableName = $wpdb->prefix . 'gbg_cake5_demo_thing_metas';
    $sql = "CREATE TABLE `$tableName` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `thing_id` int(11) unsigned NOT NULL,
        `meta_name` varchar(255) DEFAULT NULL,
        `meta_value` varchar(255) DEFAULT NULL,
        `created_at` datetime DEFAULT NULL,
        `created_by` int(11) DEFAULT NULL,
        `modified_at` datetime DEFAULT NULL,
        `modified_by` int(11) DEFAULT NULL,
        `archived_at` datetime DEFAULT NULL,
        `archived_by` int(11) DEFAULT NULL,
        PRIMARY KEY(id)
      ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

    if ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") !== $tableName) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

/**
 * Deactivation hook to drop gbg-cake5-demo tables
 */
function gbgCake5DemoDeactivate(): void
{
    global $wpdb;

    $tableName = $wpdb->prefix . 'gbg_cake5_demo_things';
    $sql = "DROP TABLE IF EXISTS `$tableName`";
    $wpdb->query($sql);

    $tableName = $wpdb->prefix . 'gbg_cake5_demo_thing_metas';
    $sql = "DROP TABLE IF EXISTS `$tableName`";
    $wpdb->query($sql);
}
