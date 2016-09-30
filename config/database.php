<?php
  # Management for database-related connections.

  # Loading PSM.
    $tools->load('packages PSM',2,['extra_class.php','query_class.php','main_class.php']);

  # Config for use of database / auth.
    $use_database = true;
    $use_auth     = true; # PSM Plugin - Adds authentification to database tables. (hash,salt,etc...)

  # Management for data_strings. (NOTHING IN STRING = NOT USED)
    $data_string = '';

  # Database config.
    $db = [
      'host' => 'localhost',
      'db'   => 'forum',
      'user' => 'root',
      'pass' => 'EM',

      'safeconnection' => true
    ];
  # Auth config.
    $authv = [
      'key' => '91sbg93b8ams;s',
      'algotype' => 'ripemd160',
      'salt' => 's92nsgopwlx',

      'tableName' => 'users',
      'usernameTable' => 'username',
      'passwordTable' => 'password'
    ];


    # Management for making the database connection, will output $psm as a variable.
      if (!empty($data_string)) {
        $generated = PSM::parse_data_string($data_string);
          $psm = $generated['psm'];
          if (explode(' ',$data_string) == 2) $auth = $generated['auth'];
      } else if ($use_database) { # If the user isn't using a data_string, will use given details to connect.
        # Making the connection.
        $psm = new PSM("{$db['host']} {$db['db']} {$db['user']} {$db['pass']}",['safeconnection' => $db['safeconnection']]);
        $pdo = $psm->handler;

        # Making the user class if needed.
        if ($is_signedin) $user = new user($_SESSION['signedin']);

        if ($use_auth) {
          $auth = new auth($psm);
          $auth->setup(
            $authv['algotype'],
            $authv['salt'],
            $authv['key']
          ); # Setting up the auth class. - For general use.
          $auth->setupDatabase(
            $authv['tableName'],
            $authv['usernameTable'],
            $authv['passwordTable']
          ); # Setting up the auth class for database support.
        } # End of auth setup if needed.
      }
