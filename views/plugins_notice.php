<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

?>
<div class="updated" style="padding: 0; margin: 0; border: none; background: none;">
  <div class="followistic-alert">
    <div class="followistic-note">

      <div class="btn-container">
        <a href="<?php echo followistic_admin_page_url(); ?>" class="btn btn-primary active" role="button"><?php _e('Activate your Followistic account',
            'followistic'); ?></a>
      </div>

      <div class="msg-container"><?php _e('You are almost done - just activate your account and your readers will be able to subscribe to customized email alerts.', 'followistic'); ?></div>
    </div>
  </div>
</div>