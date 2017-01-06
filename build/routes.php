<?php
  # Managing the slug-system. $current = the current (first) slug.

  # The route system, the slug that is to be loaded and the two files to be loaded after.
  $routing = [
    'index|home'  => ['index.build.php','index.view.php'],
    'create'      => 'adapt',
    'test'        => 'adapt'
  ];

  # Routing management.
  foreach ($routing as $page => $requires) {
    foreach (explode('|',$page) as $slug) {
      if ($page == $current AND $requires == 'adapt') {
        # Management for if the user just wants the slug to adapt to the name it's been given. (test = will load test.build.php THEN test.view.php)
        require "backend/builds/$page.build.php";
        require "backend/views/$page.view.php";
      } else if ($slug == $current) {
        # Management for adding the specific files.
        require "backend/builds/{$requires[0]}";
        require "backend/views/{$requires[1]}";
      }
    }
  }
