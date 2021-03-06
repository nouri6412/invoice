<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://hyperhse.com
 * @since             1.0.0
 * @package           ADMIN_WOO_INVOICE
 *
 * @wordpress-plugin
 * Plugin Name:       فاکتور ادمین
 * Plugin URI:        https://hyperhes.com
 * Description:       افزونه فاکتور ادمین ووکامرس
 * Version:           1.0.0
 * Author:            جلیل نوری
 * Author URI:        https://hyperhse.com
 * Text Domain:       admin-woo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) die;

/* General Definition
******************************/
define('ADMIN_WOO_INVOICE_VERSION', '1.0.0');

define('ADMIN_WOO_INVOICE_BASE', plugin_dir_path(__FILE__));
define('ADMIN_WOO_INVOICE_URI', plugin_dir_url(__FILE__));
define('ADMIN_WOO_INVOICE_FILE', __FILE__);
define('ADMIN_WOO_INVOICE_Include', ADMIN_WOO_INVOICE_BASE . 'include/');
define('ADMIN_WOO_INVOICE_View', ADMIN_WOO_INVOICE_BASE . 'view/');
$ViewData = [];


require ADMIN_WOO_INVOICE_Include . 'lib/jdf.php';
require ADMIN_WOO_INVOICE_Include . 'lib/tools.php';

require ADMIN_WOO_INVOICE_Include . 'sql_scripts.php';
  




foreach (glob(ADMIN_WOO_INVOICE_Include."hooks/*.php") as $filename)
{
    include $filename;
}

require ADMIN_WOO_INVOICE_Include . 'core.php';






