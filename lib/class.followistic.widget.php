<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

include_once(ABSPATH . 'wp-admin/includes/plugin.php');

class FollowisticWidget
{
  /**
   * @return mixed
   */
  public static function get_script()
  {
    global $post;

    $account   = Followistic::getInstance()->get_api_key();
    $guid      = $post->ID;
    $title     = addslashes(get_the_title());
    $published = get_the_date('c');
    $content   = <<<EOT
    <div id="followistic-root"></div>
    <script type="text/javascript">
(function(m,u,s,i,c,a,l){m['FollowisticObject']=c;m[c]=m[c]||function(){(m[c].p=m[c].p||[]).push(arguments)},
a=u.createElement(s),l=u.getElementsByTagName(s)[0];a.async=1;a.src=i;l.parentNode.insertBefore(a,l)})
(window,document,'script','//static.followistic.com/widget/flw.js','followistic');

      followistic('account', '{$account}');
      followistic('guid', '{$guid}');
      followistic('title', '{$title}');
      followistic('published', '{$published}');
EOT;

    // post modified time
    $modified = get_the_modified_date('c');
    if (!empty($modified) && $modified != $published) {
      $content .= <<<EOT

      followistic('modified', '{$modified}');
EOT;
    }

    // image
    if (has_post_thumbnail($post->ID)) {
      $image_resource = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID));
      $image_url      = $image_resource[0];
      $content .= <<<EOT

      followistic('image', '{$image_url}');
EOT;
    }

    // author
    try {
      $author = addslashes(get_userdata($post->post_author)->user_nicename);
      if (!empty($author)) {
        $content .= <<<EOT

      followistic('tag', '{$author}', 'author');
EOT;
      }
    } catch (Exception $e) {
    }

    // categories
    $cagegories = get_the_category();
    if (!empty($cagegories)) {
      $list = array();
      foreach ($cagegories as $cagegory) {
        $list[] = "'" . addslashes($cagegory->name) . "'";
      }

      $list = implode(', ', $list);
      $content .= <<<EOT

      followistic('tag', [{$list}], 'category');
EOT;
    }

    // keywords
    $keywords = wp_get_post_tags($post->ID);
    if (!empty($keywords)) {
      $list = array();
      foreach ($keywords as $keyword) {
        $list[] = "'" . addslashes($keyword->name) . "'";
      }

      $list = implode(', ', $list);
      $content .= <<<EOT

      followistic('tag', [{$list}], 'keyword');
EOT;
    }

    // preview mode
    $is_preview = $post->post_status != 'publish';
    if ($is_preview) {
      $content .= <<<EOT

      followistic('mode', 'preview');
EOT;
    }

    $content .= <<<EOT

    </script>
EOT;

    return $content;
  }
}