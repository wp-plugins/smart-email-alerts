<?php
/**
 *
 * @package Followistic
 *
 * Plugin Name: Followistic
 * Description: WordPress plugin for Followistic alerts service.
 * Version: 1.0.8
 * Author: Followistic
 * Author URI: http://followistic.com/
 * License: GPL v3
 */


if (!function_exists('add_action')) {
  echo 'Plugin cannot be called directly.';
  exit;
}

if (WP_DEBUG === TRUE) {
  error_log("[FOLLOWISTIC] Plugin is installed.");
}

define('FOLLOWISTIC_VERSION', '1.0.8');
define('FOLLOWISTIC_MINIMUM_WP_VERSION', '3.1');
define('FOLLOWISTIC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FOLLOWISTIC_PLUGIN_BASE_DIR', plugin_dir_path(__FILE__));
define('FOLLOWISTIC_PLUGIN_LIB_DIR', FOLLOWISTIC_PLUGIN_BASE_DIR . 'lib/');
define('FOLLOWISTIC_PLUGIN_VIEWS_DIR', FOLLOWISTIC_PLUGIN_BASE_DIR . 'views/');
define('FOLLOWISTIC_PLUGIN_STATIC_URL', FOLLOWISTIC_PLUGIN_URL . 'static/');

function followistic_auto_load($class)
{
  static $classes = NULL;

  if ($classes === NULL) {
    $classes = array(
      'followistic'         => FOLLOWISTIC_PLUGIN_LIB_DIR . 'class.followistic.php',
      'followisticwidget'   => FOLLOWISTIC_PLUGIN_LIB_DIR . 'class.followistic.widget.php',
      'followisticfrontend' => FOLLOWISTIC_PLUGIN_LIB_DIR . 'class.followistic.frontend.php',
    );
  }

  $class_name = strtolower($class);

  if (isset($classes[$class_name])) {
    require_once($classes[$class_name]);
  }
}

if (function_exists('spl_autoload_register')) {
  spl_autoload_register('followistic_auto_load');
}

require_once(FOLLOWISTIC_PLUGIN_LIB_DIR . 'helper.php');

register_activation_hook(__FILE__, array('Followistic', 'activate'));
register_deactivation_hook(__FILE__, array('Followistic', 'deactivate'));

add_action('init', array('Followistic', 'init'));