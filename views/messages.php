<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

$messages = followistic_messages();

if (!empty($messages)): ?>
  <div class="spacer"></div>

  <ul>
    <?php foreach ($messages as $message): ?>
      <li class="<?php echo $key = key($message); ?>"><?php echo $message[$key]; ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>