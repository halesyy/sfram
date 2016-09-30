<?php
  class user {
    public $user = [];
    public $info = [];

    public function __construct($id) {
      # Will load all users details into the class vars.
      $this->loadUserId($id);
    }

    # Getting all the info.
    public function loadUserId($id) {
      global $psm;
      # The users table import.
      $this->user = $psm->gsqs("SELECT * FROM users WHERE id = :id", [':id' => $id]);
      $this->widget = $psm->gsqs("SELECT * FROM widgets WHERE userID = :id", [':id' => $id]);
    }

    public function u($item = 'username') {
      return $this->user[$item];
    }
    public function w($item = 'userID') {
      return $this->widget[$item];
    }
    # Function to return the ids of closest to latest birthdays.
    public function closest() { global $psm, $t;
      # Array store.
        $idAndDaysTillBirthday = [];
      # Looping each of the users friends and adding their days till birthday.
        foreach ($psm->c()->query("SELECT * FROM friends WHERE userID = '{$this->u('id')}'") as $row) {
          $idAndDaysTillBirthday[$row['id']] = $t->daysTill($row['friend_bday']);
        }
      # We now have an array containing the ids of the entries in the database where the cloest birthdays are.
        asort($idAndDaysTillBirthday);
      # Removing 0's - means their birthday has passed.
        foreach ($idAndDaysTillBirthday as $id => $daysTillBday) {
          if (!$daysTillBday) unset($idAndDaysTillBirthday[$id]);
        }
      # Finally got the pure array. - PURE - LOL WHAT.
        // global $tools;
        // $tools->display($idAndDaysTillBirthday);
        return $idAndDaysTillBirthday;
    }

    # Returns the names of the widgets the user wants.
    public function widgets() { global $psm;
      # Getting the set of the widgets the user wants.
        $set = $psm->gsqs("SELECT * FROM widgets WHERE userID = :uid", [':uid' => $this->u('id')]);
      # Sorting.
        if ($set['timetable']) $do['timetable'] = true; else $do['timetable'] = false;
        if ($set['birthdays']) $do['birthdays'] = true; else $do['birthdays'] = false;
        if ($set['assignments']) $do['assignments'] = true; else $do['assignments'] = false;
        if ($set['termdates']) $do['termdates'] = true; else $do['termdates'] = false;
      # Returning the array.
        return $do;
    }


  }
