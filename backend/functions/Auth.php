<?php
  class auth {
    # Special function set made so that people can use auth devices easily and safely.

    # Setting the variable to tell if the user is using PSM, and the variable containing the PSM class.
      private $usingpsm = false;
      private $psmvar = false;
    # Setting the ALGORITHM TYPE, the SALTING and the KEY.
      private $algotype = false;
      private $salt = false;
      private $key = false;
    # Setting the variable that contains the most recently correct state.
      private $recentId = false;

    /* The init class, for setting up the PSM connection. */
    public function __construct($psm = false) {
      if ($psm === false) die('auth class tried to initialize but no psm was found');
        else { # Adding the PSM to the class.
          $this->usignpsm = true;
          $this->psmvar = $psm;
        }
    }

    /* Setting up the class with the correct data. */
    public function setup($algotype, $salt, $key) {
      $this->algotype = $algotype;
      $this->salt = $salt;
      $this->key = $key;
    }

    /* The main function of the class, for hashing data. */
    public function hash($string) {
      # String to hash.
      $toHash = $this->salt.$string.$this->salt;
      # Hashed string.
      $hashed = hash($this->algotype, $toHash);
      return $hashed;
    }

    /* Not recommended for use when making apps or logins, hash is a better way to store passwords. - Returns a one-way encrypted string. */
    public function encrypt($string) { return crypt($string, $this->key); }
    /* To go with the encrypt function, will compare the "crypted" string with the "string" to see if the string = the crypt correctly. */
    public function matchCrypt($crypted, $string) {
      if (crypt($string, $this->key) == $crypted) return true;
        else return false;
    }

    /*
      DATABASE-RELATED FUNCTIONS.
    */

      # Vars for db functions.
        private $table = 'users';    // Table to check in.
        private $first = 'username'; // "Username" type column.
        private $secnd = 'password'; // "Password" type column.
      /* Function meant to set up the class related to how your database is built. */
      public function setupDatabase($table = 'users', $first = 'username', $second = 'password') { # For setting up the Database functions.
        $this->table = $table;
        $this->first = $first;
        $this->secnd = $second;
      }
      /*
        One of the main functions of Auth, will check if a username and password match anything given in the database,
        and will return true or false, if true, will set a "recentId" that can be retrieved with $auth->recent() or $auth->recentid()
       */
      public function correct($username, $password) { # Checks if given username and password match anything in the database.
        # Creating the query.
          $q = $this->psmvar->handler->prepare("SELECT id FROM {$this->table} WHERE {$this->first} = :un AND {$this->secnd} = :pw");
          $q->execute([':un' => $username, ':pw' => $this->hash($password)]);
        # Getting row count.
          $rc = $this->psmvar->qgrc($q);
        # If there is a row count of 0 will return false, if there is a row count that != 0, will set the most recent ID + return true.
          if ($rc != 0) {
            $this->recentId = $q->fetch(PDO::FETCH_ASSOC)['id'];
            return true;
          } else {
            $this->recentId = false;
            return false;
          }
      }
      /* Retrieving the most recent ID inputted if existing. */
      public function recent() {
        if ($this->recentId !== false) {
          return $this->recentId;
        } else {
          return false;
        }
      } public function recentid() { return $this->recent(); } public function rid() { return $this-recent(); }



       # Adds test results into database.
      public function insertTestResults($username = 'test', $password = 'test') {
        # Adding into database.
        $this->psmvar->sstatQuery("INSERT INTO {$this->table} ({$this->first}, {$this->secnd}) VALUES (:un, :pw)", array(
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
