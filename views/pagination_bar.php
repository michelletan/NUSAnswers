<nav>
    <?php
        // Determine the next page's url
        $url = $_SERVER[REQUEST_URI];
        $parts = explode('/', $url);
        $num_parts = count($parts);
        if ($num_parts <= 2) {
            // At base directory, home
            $next_url = "/popular-questions/" . ($page+1);
        } else if ($num_parts >= 3) {
            // On a page that looks like eg: /some-type/2
            // Just increment
            $next_url = $page + 1;
        }
    ?>
  <ul class="pager">
    <?php if ($page != 1) { ?><li><a href="<?php echo ($page - 1); ?>">Previous</a></li><?php }?>
    <?php if ($has_next_page) { ?><li><a class="jscroll-next" href="<?php echo $next_url; ?>">Next</a></li><?php }?>
  </ul>
</nav>
