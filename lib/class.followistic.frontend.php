<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

class FollowisticFrontend
{
  private static $messages = array();

  /**
   * @param $type
   * @param $message
   */
  public static function set_message($type, $message)
  {
    self::$messages[][$type] = $message;
  }

  /**
   * @return array
   */
  public static function get_messages()
  {
    return self::$messages;
  }

  /**
   * @return bool
   */
  public static function is_post()
  {
    global $post;

    return is_singular() && !is_front_page() && !is_home() && $post->post_type == 'post';
  }

  public static function init_article_hooks()
  {
    add_action('the_content', array('FollowisticFrontend', 'attach_widget'));
  }

  public static function init_admin_hooks()
  {
    add_action('admin_menu', array('FollowisticFrontend', 'admin_menu'));
    add_action('admin_notices', array('FollowisticFrontend', 'display_plugins_notice'));
    add_action('admin_notices', array('FollowisticFrontend', 'display_dashboard_notice'));
    add_action('admin_enqueue_scripts', array('FollowisticFrontend', 'load_custom_wp_admin_style'));
  }

  public static function admin_menu()
  {
    $icon_data = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOC4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgMjMuMiAyMy4yIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMy4yIDIzLjIiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTEwLjUsNi45aDUuMXYzLjVoLTUuMXYxMi45SDYuNFYxMC40VjYuOVY1LjhDNi40LDEuMSw5LDAsMTIuMiwwYzEuNSwwLDMuMywwLjMsNC42LDAuN2wtMC45LDMuMQ0KCWMtMC44LTAuMy0yLTAuNC0zLTAuNGMtMS42LDAtMi4zLDAuNS0yLjMsMi42TDEwLjUsNi45TDEwLjUsNi45eiIvPg0KPC9zdmc+DQo=";

    add_menu_page(__('Followistic Plugin', 'followistic'), __('Followistic', 'followistic'), 'manage_options', 'followistic_admin', '', $icon_data);
    add_plugins_page(__('Settings', 'followistic'), __('Settings', 'followistic'), 'manage_options', 'followistic_admin', array('FollowisticFrontend', 'settings'));
  }

  public static function load_custom_wp_admin_style()
  {
    wp_register_style('followistic', FOLLOWISTIC_PLUGIN_STATIC_URL . 'followistic.css', array('bootstrap'), FOLLOWISTIC_VERSION);
    wp_enqueue_style('followistic');
  }

  public static function settings()
  {
    wp_register_style('bootstrap', FOLLOWISTIC_PLUGIN_STATIC_URL . 'bootstrap.css', FALSE, FOLLOWISTIC_VERSION);
    wp_enqueue_style('bootstrap');

    self::render('settings');
  }

  public static function messages()
  {
    self::render('messages');
  }

  public static function version_missmatch()
  {
    self::render('version_missmatch');
  }

  public static function display_plugins_notice()
  {
    global $hook_suffix;

    if ($hook_suffix == 'plugins.php' && Followistic::getInstance()->has_api_key() === FALSE) {
      wp_register_style('bootstrap', FOLLOWISTIC_PLUGIN_STATIC_URL . 'bootstrap.css', FALSE, FOLLOWISTIC_VERSION);
      wp_enqueue_style('bootstrap');

      self::render('plugins_notice');
    }
  }

  public static function display_dashboard_notice()
  {
    global $hook_suffix;

    if ($hook_suffix == 'index.php' && Followistic::getInstance()->has_api_key() === FALSE) {
      self::render('dashboard_notice');
    }
  }

  /**
   * @param $content
   * @return string
   */
  public static function attach_widget($content)
  {
    if (self::is_post() == FALSE) {
      return $content;
    }

    $placement = Followistic::getInstance()->get_widget_placement();
    $script    = FollowisticWidget::get_script();

    switch ($placement) {
      case 'add_to_theme':
        return $content;
        break;

      case 'after_content':
      default:
        return $content . $script;
        break;
    }
  }

  /**
   * @desc Render template
   * @param $template
   */
  private static function render($template)
  {
    load_plugin_textdomain('followistic');

    include(sprintf("%s/$template.php", FOLLOWISTIC_PLUGIN_VIEWS_DIR));
  }
}