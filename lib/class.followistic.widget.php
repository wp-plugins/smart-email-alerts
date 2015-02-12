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
    $title     = self::encode(get_the_title());
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


    // IMAGE
    try {
      // featured image
      $featured_image_url   = self::featured_image_url_for($post->ID);
      $attachment_image_url = self::attachment_image_url_for($post->ID);
      $image_url            = empty($featured_image_url) ? $attachment_image_url : $featured_image_url;

      if (!empty($image_url)) {
        $content .= <<<EOT

      followistic('image', '{$image_url}');
EOT;
      }
    } catch (Exception $e) {
    }


    // AUTHOR
    try {
      $author = self::encode(get_userdata($post->post_author)->display_name);

      if (!empty($author)) {
        $content .= <<<EOT

      followistic('tag', 'author', '{$author}');
EOT;
      }
    } catch (Exception $e) {
    }

    // CATEGORIES
    $categories = get_the_category();
    if (!empty($categories)) {
      $list = array();
      foreach ($categories as $category) {
        $list[] = "'" . self::encode($category->name) . "'";
      }

      $list = implode(', ', $list);
      $content .= <<<EOT

      followistic('tag', 'category', [{$list}]);
EOT;
    }

    // KEYWORDS
    $keywords = wp_get_post_tags($post->ID);
    if (!empty($keywords)) {
      $list = array();
      foreach ($keywords as $keyword) {
        $list[] = "'" . self::encode($keyword->name) . "'";
      }

      $list = implode(', ', $list);
      $content .= <<<EOT

      followistic('tag', 'keyword', [{$list}]);
EOT;
    }

    // PREVIEW MODE?
    $is_preview = $post->post_status != 'publish';
    if ($is_preview) {
      $content .= <<<EOT

      followistic('mode', 'preview');
EOT;
    }

    $content .= <<<EOT
</script>
EOT;

    // MARGINS?
    $has_margins = Followistic::getInstance()->has_margins();
    if ($has_margins) {
      $margins          = Followistic::getInstance()->get_widget_margins();
      $around_div_style = [];

      foreach ($margins as $placement => $value) {
        if ($value == 0) continue;

        $around_div_style[] = "margin-$placement:{$value}px";
      }

      $around_div_style = implode($around_div_style, ';');
      $content          = '<div class="followistic-alerts" style="' . $around_div_style . '">' . $content . '</div>';
    }

    return $content;
  }

  private static function encode($string)
  {
    return addslashes(html_entity_decode($string, ENT_QUOTES, 'UTF-8'));
  }

  private static function featured_image_url_for($post_id)
  {
    $has_thumbnail = has_post_thumbnail($post_id);
    if ($has_thumbnail == FALSE) {
      return '';
    }

    $image_id       = get_post_thumbnail_id($post_id);
    $image_resource = wp_get_attachment_image_src($image_id, 'full');
    $image_url      = self::extract_image_from_resource($image_resource);

    return $image_url;
  }

  private static function attachment_image_url_for($post_id)
  {
    $args = array(
      'numberposts'    => 1,
      'order'          => 'ASC',
      'post_mime_type' => 'image',
      'post_parent'    => $post_id,
      'post_status'    => NULL,
      'post_type'      => 'attachment',
    );

    $image_attachments = get_children($args);

    if (empty($image_attachments)) {
      return '';
    }

    $image_attachment = reset($image_attachments);
    $image_resource   = wp_get_attachment_image_src($image_attachment->ID, 'full');
    $image_url        = self::extract_image_from_resource($image_resource);

    return $image_url;
  }

  private function extract_image_from_resource($resource)
  {
    preg_match('@src="([^"]+)"@', $resource[0], $match);

    $image_url = empty($match) ? $resource[0] : $match[1];

    return $image_url;
  }
}