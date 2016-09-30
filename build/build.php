<?php
  # Going to start to build the script.
    require "build/load/functions.php";

    # Adding PAAC3.
    require "packages/PAAC3/install/install.php";
    $paac = new PAAC3_MAIN(); # (Compression Engine)

    $url = new url('/');
    $tools = new Tools();
    $html = new html();
    $token = new token();
    $t = new time();

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

    # Managing if the user is signed in or not.
    if (isset($_SESSION['signedin'])) $is_signedin = true;
      else $is_signedin = false;

    # This is a LogicController - under here is where you configure all your needs.
      $lc = new LogicController();
        $lc->config([
          'SUPER-ADM'  => 'SESSION_signedin==1',
          'LOGGED-IN'  => 'SESSION_signedin',
          'DONT-TRACK' => 'BROWSER_DNT'
        ]);












    #
