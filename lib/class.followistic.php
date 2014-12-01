<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

class Followistic
{
  const API_KEY_VERIFY_ENDPOINT = 'http://api.followistic.com/v1/publishers/%s/verify';

  /**
   * @var Followistic
   */
  private static $_instance = NULL;

  public static function init()
  {
    if (!self::$_instance) {
      self::$_instance = new Followistic();
      self::getInstance()->init_hooks();
    }

    if (!empty($_POST) && isset($_POST['vendor']) && $_POST['vendor'] == 'followistic') {
      switch ($_POST['event']) {
        case 'update_api_key':
          self::getInstance()->update_api_key();
          break;

        case 'update_placement':
          self::getInstance()->update_widget_placement();
          break;

        default:
          throw new Exception("Unrecognised event received {$_POST['event']}");
      }
    }
  }

  /**
   * @return Followistic|null
   */
  public static function getInstance()
  {
    return self::$_instance;
  }

  /**
   * @return bool
   */
  private function init_hooks()
  {
    if ($this->has_api_key()) {
      FollowisticFrontend::init_article_hooks();
    }

    if (is_admin()) {
      FollowisticFrontend::init_admin_hooks();
    }

    return TRUE;
  }

  public function has_api_key()
  {
    return $this->get_api_key() !== FALSE;
  }

  public function get_api_key()
  {
    return apply_filters('followistic_get_api_key', get_option('followistic_api_key'));
  }

  public function get_widget_placement()
  {
    return apply_filters('followistic_get_widget_placement', get_option('followistic_widget_placement'));
  }

  public static function activate()
  {
    if (version_compare($GLOBALS['wp_version'], FOLLOWISTIC_MINIMUM_WP_VERSION, '<')) {
      FollowisticFrontend::version_missmatch();
      exit();
    }
  }

  /**
   * @desc remove all followistic options
   */
  public static function deactivate()
  {
    $option_keys = array('followistic_api_key', 'followistic_widget_placement');
    foreach ($option_keys as $option_key) {
      delete_option($option_key);
    }
  }

  /**
   * @return array
   */
  public function get_widget_placement_options()
  {
    $widget_placement_options = array(
      'after_content' => __('Below post', 'followistic'),
      'add_to_theme'  => __('Add to Theme (manual placement)', 'followistic')
    );

    return $widget_placement_options;
  }

  /**
   * @return bool
   */
  private function update_api_key()
  {
    if (function_exists('current_user_can') && !current_user_can('manage_options')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    $api_key     = preg_replace('/[^a-h0-9]/i', '', $_POST['api_key']);
    $old_api_key = $this->get_api_key();

    if (empty($api_key)) {
      FollowisticFrontend::set_message('error', __('Your API key empty.', 'followistic'));
      return TRUE;
    }

    if ($api_key == $old_api_key) {
      FollowisticFrontend::set_message('success', __('Your API key was updated.', 'followistic'));
      return TRUE;
    }

    try {
      if ($this->verify_key($api_key) === FALSE) {
        FollowisticFrontend::set_message('error', __('Your API key is invalid.', 'followistic'));
        return TRUE;
      }
    } catch (Exception $e) {
      FollowisticFrontend::set_message('error', __('An error has occured while verifying your API key. Please try again later.', 'followistic'));
      return TRUE;
    }

    update_option('followistic_api_key', $api_key);
    FollowisticFrontend::set_message('success', __('Your API key was updated.', 'followistic'));

    return TRUE;
  }

  /**
   * @return bool
   * @throws Exception
   */
  private function update_widget_placement()
  {
    if (function_exists('current_user_can') && !current_user_can('manage_options')) {
      wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    $placement = $_POST['placement'];
    $options   = array_keys($this->get_widget_placement_options());

    if (!in_array($placement, $options)) {
      throw new Exception("Invalid placement value received: {$placement}");
    }

    update_option('followistic_widget_placement', $placement);
    FollowisticFrontend::set_message('success', __('Your widget placement was updated.', 'followistic'));

    return TRUE;
  }

  /**
   * @param $api_key
   * @return bool
   * @throws Exception
   */
  private function verify_key($api_key)
  {
    $verify_url = sprintf(self::API_KEY_VERIFY_ENDPOINT, $api_key);
    $data       = $this->http_request($verify_url);

    switch ($data['response']['code']) {
      case 200:
        return TRUE;

      case 404:
        return FALSE;

      default:
        throw new Exception("Unrecognised response code received {$data['response']['code']}");
    }
  }

  /**
   * @param $url
   * @param array $body
   * @param string $method
   * @return array
   * @throws BadMethodCallException
   */
  private function http_request($url, $body = array(), $method = 'GET')
  {
    $params = array_merge($this->http_request_headers(), array('body' => $body));

    switch ($method) {
      case 'GET':
        $response = wp_remote_get($url, $params);
        break;

      case 'POST':
        $response = wp_remote_post($url, $params);
        break;

      default:
        throw new BadMethodCallException();
    }

    if (is_wp_error($response)) {
      return array('', '');
    }

    return $response;
  }

  /**
   * @return array
   */
  private function http_request_headers()
  {
    $followistic_useragent = sprintf('WordPress/%s | Followistic/%s', $GLOBALS['wp_version'], constant('FOLLOWISTIC_VERSION'));
    $followistic_useragent = apply_filters('followistic', $followistic_useragent);

    $http_args = array(
      'headers'     => array(
        'Content-Type' => 'application/x-www-form-urlencoded; charset=' . get_option('blog_charset'),
        'User-Agent'   => $followistic_useragent,
      ),
      'httpversion' => '1.0',
      'timeout'     => 15
    );

    return $http_args;
  }
}
