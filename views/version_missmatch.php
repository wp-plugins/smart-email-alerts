<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

?>
<!doctype html>
<html>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <style>
    * {
      font-family: "Open Sans", sans-serif;
      text-align: center;
      margin: 0;
      padding: 0;
    }
  </style>
<body>
<p>
  <strong><?php echo sprintf(esc_html__('Followistic requires WordPress %s or higher.', 'followistic'), FOLLOWISTIC_MINIMUM_WP_VERSION); ?></strong>
  <?php echo sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to the current version.', 'followistic'), 'https://codex.wordpress.org/Upgrading_WordPress'); ?></strong>
</p>
</body>
</html>