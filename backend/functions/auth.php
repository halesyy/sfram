<?php
  class auth {
    # Special function set made so that people can use auth devices easily and safely.

    # Vars.
    private $usingpsm = false;
    private $psmvar = false;

    private $algotype = false;
    private $salt = false;
    private $key = false;

    public function __construct($psm = false) {
      if ($psm === false) die('auth class tried to initialize but no psm was found');
        else { # Adding the PSM to the class.
          $this->usignpsm = true;
          $this->psmvar = $psm;
        }
    }

    // *
    public function setup($algotype, $salt, $key) { # For setting up the auth class.
      $this->algotype = $algotype;
      $this->salt = $salt;
      $this->key = $key;
    }
    public function hash($string) { # Hashes a string using all given variables in the class.
      # String to hash.
      $toHash = $this->salt.$string.$this->salt;
      # Hashed string.
      $hashed = hash($this->algotype, $toHash);
      return $hashed;
    }


    public function basicCrypt($string) { # Not recommended to be used when making apps, hash is better for passwords.
      return crypt($string, $this->key);
    }
    public function matchCrypt($crypted, $string) {
      if (crypt($string, $this->key) == $crypted) return true;
      else return false;
    }

    # Data-base type functions.

      # Vars for db functions.
      private $table = 'users';    // Table to check in.
      private $first = 'username'; // "Username" type column.
      private $secnd = 'password'; // "Password" type column.

      public function setupDatabase($table = 'users', $first = 'username', $second = 'password') { # For setting up the Database functions.
        $this->table = $table;
        $this->first = $first;
        $this->secnd = $second;
      }
      public function correct($username, $password) { # Checks if given username and password match anything in the database.
        # Getting the row count of the username and password.
        $rowCount = $this->psmvar->GSRC("SELECT * FROM {$this->table} WHERE {$this->first} = :un AND {$this->secnd} = :pw", array(
          ':un' => $username,
          ':pw' => $this->hash($password)
        ));
        if ($rowCount != 0) return true;
          else return false;
      }

      public function insertTestResults($username = 'test', $password = 'test') { # Adds test results into database.
        # Adding into database.
        $this->psmvar->safeStaticQuery("INSERT INTO {$this->table} ({$this->first}, {$this->secnd}) VALUES (:un, :pw)", array(
          ':un' => $username,
          ':pw' => $this->hash($password)
        ));
      }





    # Access function for developers trying to get to the deepest layer of functions. - Private functions are accessable using this fuinction.
    public function accessFunction($functionName) {
      $this->$functionName();
    }

    # Some functions for developers.
    private function printKey() {
      echo $this->key;
    }
    private function printAll() {
      echo "
        algotype : {$this->algotype} <br/>
        key : {$this->key} <br/>
        salt : {$this->salt} <br/>
      ";
    }
    private function setKeyStand() {
      $this->key = 'test';
    }
  }
