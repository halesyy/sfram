<?php
  class LogicController {
    # The Logic Controller class is a logic-intelligence class meant to make statements easier.
      # Vars.
      private $config     = [];
      private $conditions = [];
      # The current result from the iff function.
      private $current = null;

    /* Configuring the class.
      This function is added and configured, the output is usually something like:
        USERIS_LOGGED-IN = 1,
        BROWSER_DONT-TRACK = 1
      The user defines what they want from this function.
     */
    public function config($config_array) {
      # We are given an array that contains - keyword => DATA_TYPE-DATA_NAME,
        # Example -- LOGGED-IN => SESSION_signedin
      if (!count($config_array)) {} else {
        # Manage the given config.
        foreach ($config_array as $trigger => $given_data) {
          # First - Manipulating the given data to see what it is.
            $pieces = explode('_',$given_data);
            if (count($pieces) != 2) die('error - there is not enough or too many given splits in the data given from - <b>'.$given_data.'</b>');
            $data_type   = $pieces[0];
            $data_string = $pieces[1];
          # The main data-types are: SESSION = USERIS, BROWSER = BROWSER
            if ($data_type == 'SESSION') {
              # Management for the sessiosn the browser supplies / has.
                # Splitting the string.
                $pieces = explode('==',$data_string);
                if (count($pieces) == 2 OR count($pieces) == 1) {} else die('error - there is not enough or too many given splits in the data given from - <b>'.$data_string.'</b>');
                if (count($pieces) == 1) {
                  # User wants to check that the session is set.
                  if (isset($_SESSION[$pieces[0]])) {
                    # The session is set! Setting the conditional.
                    $this->conditions["USERIS_$trigger"] = 1;
                  } else {
                    # The session is not set! Will set the conditional.
                    $this->conditions["USERIS_$trigger"] = 0;
                  }
                } else {
                  # User wants to check that the session has the given correct data.
                  if (isset($_SESSION[$pieces[0]])) {
                    if ($_SESSION[$pieces[0]] == $pieces[1]) {
                      # The data given isn correct.
                      $this->conditions["USERIS_$trigger"] = 1;
                    } else {
                      # The data given isn't correct.
                      $this->conditions["USERIS_$trigger"] = 0;
                    }
                  } else {
                    $this->conditions["USERIS_$trigger"] = 0;
                  }

                  # ^ The session is not set, so going to return false anyway.
                }
            } else if ($data_type == 'BROWSER') { # End of if the data_type == SESSION.
              # Management for the headers the browser supplies.
                $req = apache_request_headers();
                $sen = apache_response_headers();
              # Merging the header.
                $headers = array_merge($req, $sen);
              # Checking if the data_string is in there.
                $pieces = explode('==',$data_string);
                if (count($pieces) != 2 OR count($pieces) != 1) {} else die('error - there is not enough or too many given splits in the data given from - <b>'.$data_string.'</b>');
                if (count($pieces) == 2) {
                  # The data given is to check the pairs of data. [header(piece1) == piece2]
                  if (!empty($headers[$pieces[0]])) {
                    # The header exists, will do one more test before judging data.
                    if ($headers[$pieces[0]] == $pieces[1]) {
                      # The header is what the user wants it to be.
                      $this->conditions["BROWSER_$trigger"] = 1;
                    } else {
                      # The header isn't waht the user wants it to be.
                      $this->conditions["BROWSER_$trigger"] = 0;
                    }
                  } else {
                    # The data doesn't exist, will return the condition as false.
                    $this->conditions["BROWSER_$trigger"] = 0;
                  }
                } else { # If there is two parts to the entry.
                  if (!empty($headers[$pieces[0]])) {
                    # The header exists, return true.
                    $this->conditions["BROWSER_$trigger"] = 1;
                  } else {
                    # The header doesn't exist.
                    $this->conditions["BROWSER_$trigger"] = 0;
                  }
                }
            } # End of if the data_type == BROWSER.
        }
      }
    }

    /* Loaded class when the user makes the class. */
    public function __construct($array = false) {
      if ($array) $this->config($array);
    }

    /* Function to show all current given conditions. */
    public function showcurrentconditions() {
      echo "<pre>",print_r($this->conditions),"</pre>";
    } public function show() { $this->showcurrentconditions(); }

    /* The management for the if statement given. */
    public function iff($statement = false) {
      # Will check if the given statement is either TRUE of FALSE.
        if (!$statement) die('iff called - no statement given as first parameter');
      # Splitting the string into "word", so accessed like word[1] = word [2] but looks neater.
        $word = explode(' ',$statement);
      # The user is calling the USERIS check [session!]
        if ($word[0] == 'USERIS') {
          # Manip for the word. - If statements.
          if (!empty($this->conditions['USERIS_'.$word[1]])) {
            if ($this->conditions["USERIS_{$word[1]}"] == 1) $this->current = true;
              else $this->current = false;
          } else {
            # Setting the result to false.
            $this->current = false;
          }
        } else if ($word[0] == 'BROWSER') {
          # Manip for the word. - If statements.
          if (!empty($this->conditions['BROWSER_'.$word[1]])) {
            if ($this->conditions["BROWSER_{$word[1]}"] == 1) $this->current = true;
              else $this->current = false;
          } else {
            # Setting the result to false.
            $this->current = false;
          }
        }

      return $this;
    }

    /* Is called when the user is supplying their 'do-code' */
    public function doo(callable $doCode, $givePsm = true) {
      # Checking that the current doesn't = null.
      if (isset($this->current)) {
        if ($givePsm AND $this->current) { # IF USER WANTS PSM AND CURRENT = TRUE, DO.
          global $psm;
          $doCode($psm, (object) $_POST, (object) $_SESSION);
        } else if ($this->current) { # IF ONLY CURRENT = TRUE, DO.
          $doCode((object) $_POST, (object) $_SESSION);
        } else { # IF CURRENT DOES NOT = TRUE, SET TOO NULL. [CURRENT = FALSE]
          $this->current = null;
        }
      } else {
        die('current = false, can\'t execute function <b>doo</b>, as no <b>iff()</b> before to check');
      }
    }

    /* Checking the current if statements return. */
    public function current() {
      if ($this->current) echo 'CURRENT IS TRUE!';
        else echo 'CURRENT IS FALSE!';
    }

  }
