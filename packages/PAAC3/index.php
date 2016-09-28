<?php
  require "install/install.php";
  require "PAC/base_class.php";
  require "PAAC1/install/install.php";
  require "test_text/text1.php";
  require "test_text/text2.php";
  require "test_text/text3.php";

  $p = new PAAC2_MAIN();
  $pold = new PAAC1_MAIN();
  $pac = new PAC();

  set_time_limit(600);
  echo $p->compress('playing around with the compression engine');

  echo $p->display($p->sets);



  // @PAC = 3.0994415283203E-6
  // @OLD = 2.8610229492188E-6
  // @NEW = 4.0531158447266E-6
  // @NOT = 2.1457672119141E-6
