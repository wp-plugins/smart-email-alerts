<?php

if (!defined('FOLLOWISTIC_VERSION')) {
  header('Status: 403 Forbidden');

  header('HTTP/1.1 403 Forbidden', TRUE, 403);
  exit();
}

?>
<div id="followistic-admin">

  <?php /* REGISTER */ ?>
  <?php if (followistic_has_api_key() === FALSE): ?>
    <header><a href="http://followistic.com/" title="followistic" target="_blank"><img alt="followistic.setup" border="0" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOC4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjM4LjRweCIgaGVpZ2h0PSIzMC40cHgiIHZpZXdCb3g9IjAgMCAyMzguNCAzMC40IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMzguNCAzMC40IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik00LjEsNi45aDUuMXYzLjVINC4xdjEyLjlIMFYxMC40VjYuOVY1LjhDMCwxLjEsMi41LDAsNS44LDBjMS41LDAsMy4zLDAuMyw0LjYsMC43TDkuNSwzLjgNCgkJYy0wLjgtMC4zLTItMC40LTMtMC40QzQuOCwzLjQsNC4xLDMuOSw0LjEsNlY2Ljl6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEwLjgsMTVjMC02LjcsMi42LTguNiw3LjktOC42YzUuMywwLDgsMS45LDgsOC42YzAsNi43LTIuNiw4LjctOCw4LjdDMTMuNCwyMy43LDEwLjgsMjEuNywxMC44LDE1eg0KCQkgTTE0LjksMTVjMCw0LjUsMC45LDUuNCwzLjcsNS40YzIuOSwwLDMuOC0wLjksMy44LTUuNGMwLTQuNy0wLjktNS40LTMuOC01LjRDMTUuOCw5LjYsMTQuOSwxMC40LDE0LjksMTV6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTM0LjYsMTguNmMwLDEuNiwwLjQsMi43LDEuMywzLjlMMzIuMywyNGMtMS4xLTEuMy0xLjgtMi44LTEuOC01LjJWMC4xaDQuMVYxOC42eiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik00My40LDE4LjZjMCwxLjYsMC40LDIuNywxLjMsMy45TDQxLjEsMjRjLTEuMS0xLjMtMS44LTIuOC0xLjgtNS4yVjAuMWg0LjFWMTguNnoiLz4NCgk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNNDcuNSwxNWMwLTYuNywyLjYtOC42LDcuOS04LjZjNS4zLDAsOCwxLjksOCw4LjZjMCw2LjctMi42LDguNy04LDguN0M1MC4xLDIzLjcsNDcuNSwyMS43LDQ3LjUsMTV6DQoJCSBNNTEuNywxNWMwLDQuNSwwLjksNS40LDMuNyw1LjRjMi45LDAsMy44LTAuOSwzLjgtNS40YzAtNC43LTAuOS01LjQtMy44LTUuNEM1Mi41LDkuNiw1MS43LDEwLjQsNTEuNywxNXoiLz4NCgk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNNzQuOSwyMy4yaC00LjdjLTEuNS01LjctMy4zLTExLjMtNS4xLTE2LjNoNC4xYzEuMywzLjYsMy42LDEyLjMsMy42LDEyLjNzMi45LTkuOCwzLjQtMTIuM2gzLjgNCgkJYzEsMy4yLDIuNSw4LjgsMy4yLDEyLjNjMS40LTQuMSwyLjctOC4yLDMuNy0xMi4zaDMuOWMtMS40LDUuMy0zLjQsMTEuMi01LjQsMTYuM2gtNC44Yy0wLjYtMy4zLTIuNS0xMC45LTIuNS0xMC45DQoJCVM3NS42LDIwLjksNzQuOSwyMy4yeiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik05Ny43LDIuMWMwLDEuOS0wLjYsMi4yLTIuMywyLjJjLTEuOCwwLTIuNC0wLjMtMi40LTIuMmMwLTEuNywwLjYtMiwyLjQtMkM5Ny4xLDAuMSw5Ny43LDAuNCw5Ny43LDIuMXoNCgkJIE05Ny40LDIzLjJoLTQuMVY2LjloNC4xVjIzLjJ6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTExMi45LDEwLjRjLTEuMy0wLjQtMy4yLTAuOC00LjgtMC44Yy0yLDAtMywwLjItMywxLjljMCwxLjEsMC43LDEuNSwzLjQsMS44YzQsMC40LDUuOCwxLjYsNS44LDQuOQ0KCQljMCw0LjItMi45LDUuNS03LjEsNS41Yy0xLjgsMC00LjQtMC4zLTUuOS0wLjlsMC44LTMuMWMxLjIsMC40LDMuMywwLjgsNC45LDAuOGMyLjIsMCwzLjMtMC4zLDMuMy0yYzAtMS4yLTAuNy0xLjctMy42LTINCgkJYy0zLjctMC4zLTUuNi0xLjMtNS42LTQuN2MwLTQuMiwyLjktNS40LDcuMS01LjRjMS43LDAsMy45LDAuNCw1LjYsMC45TDExMi45LDEwLjR6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEyMi44LDEwLjR2N2MwLDIsMC42LDIuOSwyLjUsMi45YzEuMSwwLDItMC4yLDIuOC0wLjRsMC43LDMuMWMtMS4yLDAuNC0zLDAuNy00LjYsMC43DQoJCWMtMy43LDAtNS42LTEuMS01LjYtNS45di03LjRIMTE2VjYuOWgyLjhWNC4xbDQuMS0xLjZ2NC40aDUuNXYzLjVDMTI4LjMsMTAuNCwxMjIuOCwxMC40LDEyMi44LDEwLjR6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEzNS44LDIuMWMwLDEuOS0wLjYsMi4yLTIuMywyLjJjLTEuOCwwLTIuNC0wLjMtMi40LTIuMmMwLTEuNywwLjYtMiwyLjQtMkMxMzUuMywwLjEsMTM1LjgsMC40LDEzNS44LDIuMQ0KCQl6IE0xMzUuNSwyMy4yaC00LjFWNi45aDQuMVYyMy4yeiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0xNTIuNywyMi44Yy0xLjMsMC41LTMuNSwwLjgtNS4xLDAuOGMtNS4xLDAtOC4yLTItOC4yLTguN2MwLTYuNywzLjItOC42LDguMi04LjZjMS42LDAsMy44LDAuMyw1LjEsMC44DQoJCWwtMC45LDMuNGMtMS0wLjQtMi41LTAuNy0zLjktMC43Yy0yLjksMC00LjMsMC42LTQuMyw1LjJjMCw0LjMsMS40LDUuMiw0LjMsNS4yYzEuNCwwLDIuOC0wLjQsMy45LTAuOEwxNTIuNywyMi44eiIvPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMTYwLDIzLjVjLTEuMiwwLTEuNS0wLjMtMS41LTEuNWMwLTEuMiwwLjMtMS41LDEuNS0xLjVjMS4yLDAsMS41LDAuMywxLjUsMS41DQoJCQlDMTYxLjUsMjMuMiwxNjEuMiwyMy41LDE2MCwyMy41eiIvPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMTY1LjcsMjEuNWMxLjUsMC40LDIuOCwwLjUsNCwwLjVjMy4zLDAsNC41LTEuMiw0LjUtM2MwLTEuNi0wLjgtMi4xLTMuOS0zLjRjLTMuMy0xLjMtNC41LTIuMi00LjUtNC41DQoJCQljMC0yLjksMi4xLTQuNCw1LjgtNC40YzEuMywwLDIuNywwLjMsMy44LDAuNmwtMC4yLDEuNWMtMS4zLTAuMy0yLjQtMC41LTMuNy0wLjVjLTIuNiwwLTMuOSwwLjktMy45LDIuN2MwLDEuNCwwLjcsMS45LDMuOCwzLjENCgkJCWMzLjUsMS40LDQuNywyLjEsNC43LDQuOGMwLDIuOC0xLjksNC42LTYuNSw0LjZjLTEuNCwwLTIuNy0wLjItNC4xLTAuNUwxNjUuNywyMS41eiIvPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMTkxLjEsMjIuOWMtMS42LDAuNC0zLjIsMC42LTQuOSwwLjZjLTQsMC02LjYtMS4yLTYuNi04LjNjMC02LjgsMi42LTguNSw2LjYtOC41czUuNywxLjYsNS43LDcuNg0KCQkJYzAsMC40LDAsMC43LDAsMS4yaC0xMC40YzAuMSw1LjgsMS44LDYuNiw1LjEsNi42YzEuNiwwLDIuOS0wLjIsNC4zLTAuNkwxOTEuMSwyMi45eiBNMTkwLDE0Yy0wLjEtNC44LTEuMy01LjgtNC01LjgNCgkJCWMtMi43LDAtNC40LDEuMS00LjUsNS44SDE5MHoiLz4NCgkJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTE5Nyw3LjJWMi4ybDEuOS0wLjN2NS4yaDMuOHYxLjVIMTk5djExYzAsMS43LDAuNiwyLjIsMS44LDIuMmMwLjcsMCwxLjQtMC4xLDItMC4zbDAuMiwxLjUNCgkJCWMtMC44LDAuMi0xLjYsMC40LTIuNSwwLjRjLTIuNSwwLTMuNC0xLTMuNC0zLjRWOC43aC0yLjVWNy4ySDE5N3oiLz4NCgkJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTIwOC40LDcuMlYxOGMwLDIuOSwxLjEsNCwzLjQsNGMxLjcsMCwzLjUtMC43LDUuNy0yLjFWNy4yaDEuOXYxNi4xaC0xLjZsLTAuMS0xLjgNCgkJCWMtMi4xLDEuMi00LjIsMi4xLTYuMywyLjFjLTMuMywwLTQuOS0xLjYtNC45LTUuM1Y3LjJIMjA4LjR6Ii8+DQoJCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0yMjUuNCw3LjJoMS42bDAuMSwxLjdjMS45LTEuMiwzLjYtMiw1LjUtMmMzLjYsMCw1LjcsMS43LDUuNyw4LjJjMCw2LjUtMy4zLDguNS02LjgsOC41DQoJCQljLTEuNiwwLTMtMC41LTQuMy0xLjJsMCwwYzAuMSwxLjUsMC4xLDIuOCwwLjEsNC4xdjMuOWgtMS45VjcuMnogTTIyNy4zLDIwLjdjMS41LDAuOCwyLjYsMS4zLDQuMSwxLjNjMi41LDAsNS0xLjQsNS02LjkNCgkJCXMtMS42LTYuNy00LjItNi43Yy0xLjUsMC0yLjksMC43LTUsMlYyMC43eiIvPg0KCTwvZz4NCjwvZz4NCjwvc3ZnPg0K"></a></header>

    <div class="spacer"></div>

    <p><?php _e('Followistic enables your readers to subscribe to custom email alerts for all the topics, authors and categories of your website.','followistic'); ?></p>

    <?php include('messages.php'); ?>

    <section>
      <header><?php _e('New to Followistic?', 'followistic'); ?></header>
      <p class="info-register"><?php _e('Create an account for free to design your widget and get your API key.', 'followistic'); ?></p>

      <a href="http://www.followistic.com/?utm_source=wordpress&utm_medium=button&utm_campaign=wp_plugin" class="btn btn-primary active" role="button" target="_blank"><?php _e('Get started', 'followistic'); ?></a>
    </section>

    <section>
      <header><?php _e('Already have an account?', 'followistic'); ?></header>

      <form class="register" method="POST" action="<?php echo followistic_admin_page_url(); ?>">
        <input type="hidden" name="vendor" value="followistic"/>
        <input type="hidden" name="event" value="update_api_key"/>

        <label><?php _e('Paste your API key here:', 'followistic'); ?></label>
        <input name="api_key" type="text" value="<?php if (!empty($_POST) && $_POST['event'] == 'update_api_key') echo $_POST['api_key']; ?>">
        <input class="btn btn-primary active" type="submit" value="<?php _e('Use this key', 'followistic'); ?>">
      </form>
    </section>

    <?php /* SETTINGS */ ?>
  <?php else: ?>

  <header><a href="http://followistic.com/" title="followistic" target="_blank"><img alt="followistic.settings" border="0" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOC4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMjcycHgiIGhlaWdodD0iMzAuOHB4IiB2aWV3Qm94PSIwIDAgMjcyIDMwLjgiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDI3MiAzMC44IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik00LjEsNi45aDUuMXYzLjVINC4xdjEyLjlIMFYxMC40VjYuOVY1LjhDMCwxLjEsMi41LDAsNS44LDBjMS41LDAsMy4zLDAuMyw0LjYsMC43TDkuNSwzLjgNCgkJYy0wLjgtMC4zLTItMC40LTMtMC40QzQuOCwzLjQsNC4xLDMuOSw0LjEsNlY2Ljl6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEwLjgsMTVjMC02LjcsMi42LTguNiw3LjktOC42czgsMS45LDgsOC42cy0yLjYsOC43LTgsOC43QzEzLjQsMjMuNywxMC44LDIxLjcsMTAuOCwxNXogTTE0LjksMTUNCgkJYzAsNC41LDAuOSw1LjQsMy43LDUuNGMyLjksMCwzLjgtMC45LDMuOC01LjRjMC00LjctMC45LTUuNC0zLjgtNS40QzE1LjgsOS42LDE0LjksMTAuNCwxNC45LDE1eiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0zNC42LDE4LjZjMCwxLjYsMC40LDIuNywxLjMsMy45TDMyLjMsMjRjLTEuMS0xLjMtMS44LTIuOC0xLjgtNS4yVjAuMWg0LjFWMTguNnoiLz4NCgk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNNDMuNCwxOC42YzAsMS42LDAuNCwyLjcsMS4zLDMuOUw0MS4xLDI0Yy0xLjEtMS4zLTEuOC0yLjgtMS44LTUuMlYwLjFoNC4xQzQzLjQsMC4xLDQzLjQsMTguNiw0My40LDE4LjZ6DQoJCSIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik00Ny41LDE1YzAtNi43LDIuNi04LjYsNy45LTguNnM4LDEuOSw4LDguNnMtMi42LDguNy04LDguN0M1MC4xLDIzLjcsNDcuNSwyMS43LDQ3LjUsMTV6IE01MS43LDE1DQoJCWMwLDQuNSwwLjksNS40LDMuNyw1LjRjMi45LDAsMy44LTAuOSwzLjgtNS40YzAtNC43LTAuOS01LjQtMy44LTUuNEM1Mi41LDkuNiw1MS43LDEwLjQsNTEuNywxNXoiLz4NCgk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNNzQuOSwyMy4yaC00LjdjLTEuNS01LjctMy4zLTExLjMtNS4xLTE2LjNoNC4xYzEuMywzLjYsMy42LDEyLjMsMy42LDEyLjNzMi45LTkuOCwzLjQtMTIuM0g4MA0KCQljMSwzLjIsMi41LDguOCwzLjIsMTIuM2MxLjQtNC4xLDIuNy04LjIsMy43LTEyLjNoMy45Yy0xLjQsNS4zLTMuNCwxMS4yLTUuNCwxNi4zaC00LjhjLTAuNi0zLjMtMi41LTEwLjktMi41LTEwLjkNCgkJUzc1LjYsMjAuOSw3NC45LDIzLjJ6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTk3LjcsMi4xYzAsMS45LTAuNiwyLjItMi4zLDIuMkM5My42LDQuMyw5Myw0LDkzLDIuMWMwLTEuNywwLjYtMiwyLjQtMkM5Ny4xLDAuMSw5Ny43LDAuNCw5Ny43LDIuMXoNCgkJIE05Ny40LDIzLjJoLTQuMVY2LjloNC4xVjIzLjJ6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTExMi45LDEwLjRjLTEuMy0wLjQtMy4yLTAuOC00LjgtMC44Yy0yLDAtMywwLjItMywxLjljMCwxLjEsMC43LDEuNSwzLjQsMS44YzQsMC40LDUuOCwxLjYsNS44LDQuOQ0KCQljMCw0LjItMi45LDUuNS03LjEsNS41Yy0xLjgsMC00LjQtMC4zLTUuOS0wLjlsMC44LTMuMWMxLjIsMC40LDMuMywwLjgsNC45LDAuOGMyLjIsMCwzLjMtMC4zLDMuMy0yYzAtMS4yLTAuNy0xLjctMy42LTINCgkJYy0zLjctMC4zLTUuNi0xLjMtNS42LTQuN2MwLTQuMiwyLjktNS40LDcuMS01LjRjMS43LDAsMy45LDAuNCw1LjYsMC45TDExMi45LDEwLjR6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEyMi44LDEwLjR2N2MwLDIsMC42LDIuOSwyLjUsMi45YzEuMSwwLDItMC4yLDIuOC0wLjRsMC43LDMuMWMtMS4yLDAuNC0zLDAuNy00LjYsMC43DQoJCWMtMy43LDAtNS42LTEuMS01LjYtNS45di03LjRIMTE2VjYuOWgyLjhWNC4xbDQuMS0xLjZ2NC40aDUuNXYzLjVDMTI4LjMsMTAuNCwxMjIuOCwxMC40LDEyMi44LDEwLjR6Ii8+DQoJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTEzNS44LDIuMWMwLDEuOS0wLjYsMi4yLTIuMywyLjJjLTEuOCwwLTIuNC0wLjMtMi40LTIuMmMwLTEuNywwLjYtMiwyLjQtMkMxMzUuMywwLjEsMTM1LjgsMC40LDEzNS44LDIuMQ0KCQl6IE0xMzUuNSwyMy4yaC00LjFWNi45aDQuMVYyMy4yeiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0xNTIuNywyMi44Yy0xLjMsMC41LTMuNSwwLjgtNS4xLDAuOGMtNS4xLDAtOC4yLTItOC4yLTguN3MzLjItOC42LDguMi04LjZjMS42LDAsMy44LDAuMyw1LjEsMC44DQoJCWwtMC45LDMuNGMtMS0wLjQtMi41LTAuNy0zLjktMC43Yy0yLjksMC00LjMsMC42LTQuMyw1LjJjMCw0LjMsMS40LDUuMiw0LjMsNS4yYzEuNCwwLDIuOC0wLjQsMy45LTAuOEwxNTIuNywyMi44eiIvPg0KCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0xNjAsMjMuNWMtMS4yLDAtMS41LTAuMy0xLjUtMS41czAuMy0xLjUsMS41LTEuNXMxLjUsMC4zLDEuNSwxLjVTMTYxLjIsMjMuNSwxNjAsMjMuNXoiLz4NCgk8Zz4NCgkJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTE2NS43LDIxLjVjMS41LDAuNCwyLjgsMC41LDQsMC41YzMuMywwLDQuNS0xLjIsNC41LTNjMC0xLjYtMC44LTIuMS0zLjktMy40Yy0zLjMtMS4zLTQuNS0yLjItNC41LTQuNQ0KCQkJYzAtMi45LDIuMS00LjQsNS44LTQuNGMxLjMsMCwyLjcsMC4zLDMuOCwwLjZsLTAuMiwxLjVjLTEuMy0wLjMtMi40LTAuNS0zLjctMC41Yy0yLjYsMC0zLjksMC45LTMuOSwyLjdjMCwxLjQsMC43LDEuOSwzLjgsMy4xDQoJCQljMy41LDEuNCw0LjcsMi4xLDQuNyw0LjhjMCwyLjgtMS45LDQuNi02LjUsNC42Yy0xLjQsMC0yLjctMC4yLTQuMS0wLjVMMTY1LjcsMjEuNXoiLz4NCgkJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTE5MS41LDIyLjljLTEuNiwwLjQtMy4yLDAuNi00LjksMC42Yy00LDAtNi42LTEuMi02LjYtOC4zYzAtNi44LDIuNi04LjUsNi42LTguNXM1LjcsMS42LDUuNyw3LjYNCgkJCWMwLDAuNCwwLDAuNywwLDEuMmgtMTAuNGMwLjEsNS44LDEuOCw2LjYsNS4xLDYuNmMxLjYsMCwyLjktMC4yLDQuMy0wLjZMMTkxLjUsMjIuOXogTTE5MC40LDE0Yy0wLjEtNC44LTEuMy01LjgtNC01LjgNCgkJCWMtMi43LDAtNC40LDEuMS00LjUsNS44SDE5MC40eiIvPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMTk3LjcsNy4xVjIuMmwxLjktMC4zdjUuMmgzLjh2MS41aC0zLjh2MTFjMCwxLjcsMC42LDIuMiwxLjgsMi4yYzAuNywwLDEuNC0wLjEsMi0wLjNsMC4yLDEuNQ0KCQkJYy0wLjgsMC4yLTEuNiwwLjQtMi41LDAuNGMtMi41LDAtMy40LTEtMy40LTMuNFY4LjZoLTIuNVY3LjFIMTk3Ljd6Ii8+DQoJCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0yMDcuOSw3LjFWMi4ybDEuOS0wLjN2NS4yaDMuOHYxLjVoLTMuOHYxMWMwLDEuNywwLjYsMi4yLDEuOCwyLjJjMC43LDAsMS40LTAuMSwyLTAuM2wwLjIsMS41DQoJCQljLTAuOCwwLjItMS42LDAuNC0yLjUsMC40Yy0yLjUsMC0zLjQtMS0zLjQtMy40VjguNmgtMi41VjcuMUgyMDcuOXoiLz4NCgkJPHBhdGggZmlsbD0iIzBDNzQ5QiIgZD0iTTIxOC45LDNjLTEuMSwwLTEuNC0wLjMtMS40LTEuNGMwLTEuMSwwLjMtMS40LDEuNC0xLjRjMS4xLDAsMS40LDAuMywxLjQsMS40QzIyMC4zLDIuNywyMjAsMywyMTguOSwzeg0KCQkJIE0yMTgsNy4xaDEuOXYxNi4xSDIxOFY3LjF6Ii8+DQoJCTxwYXRoIGZpbGw9IiMwQzc0OUIiIGQ9Ik0yMjYuMiw3LjFoMS42bDAuMSwxLjhjMi4xLTEuMiw0LjItMi4xLDYuMy0yLjFjMy4zLDAsNC45LDEuNiw0LjksNS4zdjExLjFoLTEuOVYxMi40YzAtMi45LTEuMS00LTMuNC00DQoJCQljLTEuNywwLTMuNSwwLjgtNS43LDIuMXYxMi44aC0xLjlWNy4xeiIvPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMjU4LjYsOC41Yy0xLDAuMS0yLjEsMC4xLTMuMSwwLjJjMC43LDAuNywxLjIsMS45LDEuMiwzLjljMCw0LjMtMi4xLDUuOS02LjEsNS45Yy0xLjMsMC0yLjItMC4yLTIuOS0wLjUNCgkJCWMtMC44LDAuNS0xLjEsMC45LTEuMSwxLjRjMCwwLjcsMC40LDEuMiwyLjksMS43YzEuOSwwLjQsMy42LDAuNyw0LjksMWMyLjQsMC41LDMuNSwxLjUsMy41LDMuNmMwLDIuOS0yLjEsNS03LjUsNQ0KCQkJYy01LjEsMC02LjktMS44LTYuOS00LjZjMC0yLjEsMS40LTMuNCwzLjMtNC4yYy0xLjQtMC41LTIuMS0xLjItMi4xLTIuM2MwLTEsMC41LTEuNiwxLjUtMi4zYy0xLTAuOS0xLjctMi4yLTEuNy00LjgNCgkJCWMwLTQuMywyLjEtNS45LDYuMS01LjljMS40LDAsMi4zLDAuMiwzLDAuNWg1VjguNXogTTI0OC44LDIyLjVjLTEuOCwwLjYtMy4zLDEuNi0zLjMsMy41YzAsMiwxLjEsMy4zLDUsMy4zDQoJCQljNC4yLDAsNS41LTEuNyw1LjUtMy40YzAtMS4zLTAuOC0yLTIuNC0yLjNDMjUxLjksMjMuMiwyNTAuNCwyMi45LDI0OC44LDIyLjV6IE0yNTAuNSw4LjFjLTMsMC00LjIsMS00LjIsNC40czEuMSw0LjUsNC4yLDQuNQ0KCQkJYzMsMCw0LjItMSw0LjItNC40QzI1NC44LDkuMiwyNTMuNSw4LjEsMjUwLjUsOC4xeiIvPg0KCQk8cGF0aCBmaWxsPSIjMEM3NDlCIiBkPSJNMjYxLjYsMjEuNWMxLjUsMC40LDIuOCwwLjUsNCwwLjVjMy4zLDAsNC41LTEuMiw0LjUtM2MwLTEuNi0wLjgtMi4xLTMuOS0zLjRjLTMuMy0xLjMtNC41LTIuMi00LjUtNC41DQoJCQljMC0yLjksMi4xLTQuNCw1LjgtNC40YzEuMywwLDIuNywwLjMsMy44LDAuNmwtMC4yLDEuNWMtMS4zLTAuMy0yLjQtMC41LTMuNy0wLjVjLTIuNiwwLTMuOSwwLjktMy45LDIuN2MwLDEuNCwwLjcsMS45LDMuOCwzLjENCgkJCWMzLjUsMS40LDQuNywyLjEsNC43LDQuOGMwLDIuOC0xLjksNC42LTYuNSw0LjZjLTEuNCwwLTIuNy0wLjItNC4xLTAuNUwyNjEuNiwyMS41eiIvPg0KCTwvZz4NCjwvZz4NCjwvc3ZnPg0K"></a></header>
  <div class="clear"></div>

  <?php include('messages.php'); ?>

  <section>
    <form class="settings-placement" method="POST" action="<?php echo followistic_admin_page_url(); ?>">
      <input type="hidden" name="vendor" value="followistic"/>
      <input type="hidden" name="event" value="update_placement"/>

      <label for="placement"><?php _e('Placement of the widget:', 'followistic'); ?></label>
      <select name="placement" id="followistic-widget-placement" onchange="this.form.submit();">
        <?php foreach (followistic_widget_placement_options() as $key => $label): ?>
          <option value="<?php echo $key; ?>"<?php if (followistic_widget_placement() == $key) echo ' selected'; ?>><?php echo $label; ?></option>
        <?php endforeach; ?>
      </select>

      <?php if (followistic_widget_placement() == 'add_to_theme'): ?>
        <p class="info-add-to-theme"><?php _e("Add this code anywhere in your theme to show the Followistic widget:<br/><strong>&lt;?php if (function_exists ('followistic_widget')) followistic_widget();
?&gt;</strong>", 'followistic'); ?></p>
      <?php endif; ?>
    </form>


    <?php $has_margins = followistic_widget_has_margins(); if ($has_margins): $margins = followistic_widget_margins(); $options = followistic_widget_margin_options(); ?>
      <form class="settings-margins" method="POST" class="settings" action="<?php echo followistic_admin_page_url(); ?>">
        <input type="hidden" name="vendor" value="followistic"/>
        <input type="hidden" name="event" value="update_margins"/>

        <label for="margins"><?php _e('Margins:', 'followistic'); ?></label>

        <?php foreach ($options as $key => $label): ?>
          <label for="margins[<?php echo $key; ?>]"><?php echo $label; ?></label>
          <input name="margins[<?php echo $key; ?>]" type="number" min="0" value="<?php echo $margins[$key]; ?>">&nbsp;<?php _e('px', 'followistic'); ?>
        <?php endforeach; ?>

        <input class="btn btn-primary active" type="submit" value="<?php _e('Save', 'followistic'); ?>">
      </form>
    <?php endif; ?>


    <div class="clear"></div>
  </section>

  <section>
    <form class="api-key" method="POST" action="<?php echo followistic_admin_page_url(); ?>">
      <input type="hidden" name="vendor" value="followistic"/>
      <input type="hidden" name="event" value="update_api_key"/>

      <label for="api_key"><?php _e('Current API Key:', 'followistic'); ?></label>
      <input name="api_key" type="text" value="<?php echo followistic_api_key(); ?>">
      <input class="btn btn-primary active" type="submit" value="<?php _e('Change key', 'followistic'); ?>">
    </form>
  </section>

  <section>
    <label><?php _e('Layout and Statistics:', 'followistic'); ?></label>

    <p class="info-layout-and-statistics"><?php _e("Simply log in at <a href=\"http://followistic.com/\" target=\"_blank\">www.followistic.com</a> to customize your
    widget and notification layout or to
check your website's statistics.", 'followistic'); ?>
  </section>

    <div class="spacer"></div>

    <p><?php _e("In case you need any help or got questions please give us a shout at <a href=\"mailto:hello@followistic.com\" target=\"_top\">hello@followistic.com</a>
        or head over to our <a href=\"https://followistic.groovehq.com/help_center/\" target=\"_blank\">Help Desk</a>", 'followistic'); ?></p>

  <?php endif; ?>
</div>