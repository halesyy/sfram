<?php
  class tools {
    # This is the class that has all of the "tools" for the code.

    public function __construct() {
      # Loaded every time the page is loaded.
    }
    // Can tell if the user is on mobile or not.
    public static function onMobile() {
      return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    // Encodes for javascript.
    public static function jEncode($text) {
      $new = str_replace('"', '', $text);
      return $new;
    }
    // Remakes for lower / caps want in text.
    public static function down($text) {
      return strtolower($text);
    }
    public static function up($text) {
      return strtoupper($text);
    }
    // Limits text length.
    public static function limit($string, $length = 10) {
      # Will initialize the parts array, then the amount of characters the user wants to be put in the array then returning the imploded string.
      $parts = [];
      for ($i = 0; $i <= strlen($string); $i++) {
        if ($i < $length) array_push($parts,$string[$i]);
      } return implode('',$parts).'...';
    }
    // Gets time date currently.
    public static function date($date = 'j - m - y') {
      date_default_timezone_set('Australia/Sydney');
      $timedate = date($date);
      return $timedate;
    }
    // Getting the current day of the year. (for daily updates kind-of-thing)
    public static function dooty() {
      return date('z');
    }
    # Get time reference - gets the difference between time() function calls.
    public static function GTR($before, $after) {
      $reference = $after - $before;
      // Sets up the references.
      $second = 1;
      $minute = $second * 60;
      $hour = $minute * 60;
      $day = $hour * 24;
      $year = $day * 365;
      // End of time references.
      if ($reference < $minute) {
        return $reference.' Seconds Ago';
      } else if ($reference < $hour) {
        return ceil($reference / $minute).' Minutes Ago';
      } else if ($reference < $day) {
        return ceil($reference / $hour).' Hours Ago';
      } else if ($reference < $year) {
        return ceil($reference / $day).' Days Ago';
      } else if ($reference > $year) {
        return ceil($reference / $year).' Years Ago';
      }
    }
    // Will reconstruct a string getting the areas (example - 0 1 2) and returning that string, example "string" then inputting "string" and 0,1,2 you will get a return of str.
    public static function reconstruct($string, $selections) {
      $returnStore = array(); # Where the return is placed.

      // Loops each letter in string (selections).
      for ($i = 0; $i <= strlen($selections) - 1; $i++) {
        if (!is_numeric($selections[$i]) ) $interconnect = $selections[$i];
      }

      // Loops each of the letters in the string (selections) exploded using the $interconnect.
      foreach (explode($interconnect,$selections) as $accessNumber) {
        if (is_numeric($accessNumber)) array_push($returnStore, $string[$accessNumber]);
      }

      // Returns the constructed string.
      return implode('', $returnStore);
    }
    // Will display all items in an array.
    public static function display($array) {
      echo '<pre>',print_r($array),'</pre>';
    }

    # Cause of the author of this lovely code, this is some rewrites of functions that are made
    # CAREFULLY, so that they're FUCKING PERFECT, it's so that during production everything is fucking
    # PERFECT WHEN YOURE DOING YOUR APP...

    public static function safe_HASONLYNUMBERS($string) {
      # An old fashioned method for making sure a string is number only.
      $non_numbers = 0;
      $numbers = range('0', '9');
      foreach (str_split($string) as $character) {
        $numcheck = 0;
        # Checks if the character is any of the numbers.
        foreach ($numbers as $number) {
          if ($character == $number) $numcheck++;
        }
        # Checks if the $numcheck was successful.
        if ($numcheck == 0) $non_numbers++;
      }

      if ($non_numbers != 0) return false;
        else return true;
    }
    # For checking if a string contains another string, if ab contains a return true, ez. :D
    public static function string_contains($string, $has) {
      # Getting the amount of letters in each string.
      if (strpos($string, $has) !== false) return true;
        else return false;
    }
    # For quick-parse loading.
    public static function load($location, $typeset = 1, $addFromDir = false) {
      # EX STRING: backend functions auth.php
      if ($typeset == 1) $location = str_replace(':','/',$location);
        else if ($typeset == 2) $location = str_replace(' ','/',$location);
        else if ($typeset == 3) $location = str_replace('->','/',$location);

      if ($addFromDir !== false) {
        $dir = $location;
        # Will loop each file the user wants to add from the dir and require.
        foreach ($addFromDir as $fileInDir) require "$dir/$fileInDir";
      } else {
        # Will require the file now.
        require "$location";
      }
    }



    public static function stable() {
      echo "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp' style='font-family: Open Sans, Roboto, Arial; margin: 20px;'>";
    } public static function etable() {
      echo "</table>";
    }

    # Will create a table from the string given.
    public static function table($str) { global $tools;
      $this->stable(); # Start table.
        $rows = explode("\n",$str);
        # Header management - build.
          echo "<thead><tr>";
          foreach (explode(' ',$rows[0]) as $thead_part) {
            $thead_part = str_replace('_',' ',$thead_part);
            echo "<th>$thead_part</th>";
            // echo $thead_part.'<br/>';
          }
          echo "</tr></thead>";

        # Body management.
          echo "<tbody>";
          for ($i = 1; $i <= count(explode("\n",$str)) - 1; $i++) {
            $tbody_part = explode(' ',$rows[$i]);
            echo "<tr>";
              foreach ($tbody_part as $data_piece) {
                # Data_piece = a single piece of the table.
                $data_piece = str_replace('_',' ',$data_piece);
                if ($data_piece == '-') {
                  echo "<td style='font-size: 10px;'>-----</td>";
                } else {
                  echo "<td>$data_piece</td>";
                }
              }
            echo "</tr>";
          }
          echo "</tbody>";
      $this->etable(); # End table.
    }













    #
  }
