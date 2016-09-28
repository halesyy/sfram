<?php
  # Going to start to build the script.
    require "build/load/functions.php";

    # Adding PAAC3.
    require "packages/PAAC3/install/install.php";
    $paac = new PAAC3_MAIN(); # (Compression Engine)

    $url = new url('/');
    $tools = new tools();
    $html = new html();
    $token = new token();

    # Variables given to code each time it's ran.
    $ip   = $_SERVER['REMOTE_ADDR'];
    $time = time();

    # Management for getting the current first slug.
    if (!$url->segment(1)) $current = 'index';
      else $current = $url->segment(1);
    # Renames.
    $cur = $current;
    $basic = $tools;
    $tool = $tools;
