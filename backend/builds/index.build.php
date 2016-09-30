<?php
  $psm->posts([
    'sub = register' => function($psm, $post) { global $tools,$auth;
      # Management for if the email exists.
      if (in_array($post->email, $psm->getall('users','email'))) {
        $error['Email'] = "Email is already in use!";
      } else {
        # Can manage the email and make a new account.
          $psm->insert([
            'table' => 'users',
            'username' => $post->user,
            'password' => $auth->hash($post->pass),
            'lastLogin' => time(),
            'lastIP' => $_SERVER['REMOTE_ADDR'],
            'signupDate' => $tools->date()
          ]);
        # End of inserting the account.
          $_SESSION['signedin'] = $psm->glid();
      }
    }, 'sub = login' => function($psm, $post) { global $auth;
        if ($auth->correct($post->user, $post->pass)) {
          # Getting the users id.
          $_SESSION['signedin'] = $auth->recent();
          # Sends the user to the dashboard.
          header("Location: /dashboard");
        } else {
          # Will let the code return an error.
          $error['Login'] = 'Those login details were incorrect.';
        }
    }
  ]);
