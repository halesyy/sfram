<?php
  class token {
    # Generate a random token.
    public function generate() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ:=;,.<>[]{}\_+-';
      $charactersLength = strlen($characters);
      $randomString = '';
        for ($i = 0; $i < 32; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
      return $_SESSION['token'] = $randomString;
    }

    public function check($token) {
      if (isset($_SESSION['token']) && $token === $_SESSION['token']) {
        return true;
      } else return false;
    }

  }
