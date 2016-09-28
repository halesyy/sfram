<?php
  class PAAC3_MAIN extends PAAC3_TOOLS {
    public $sets = array();



    public function asciis() {
      $asciis = array();
      for ($i = 33; $i <= 126; $i++) {
        // Adds each ascii value character into the array.
        array_push($asciis, chr($i));
      }
      return $asciis;
    }








    public function charcount($string) {
      // Getting the amount of times words are used.
      $uniqueWords = array(); // Array with all words stored only once.
      foreach (explode(' ', $string) as $word) {
        if (!in_array($word, $uniqueWords)) array_push($uniqueWords, $word);
      }
      // End of inserting words if unique.
      foreach ($uniqueWords as $uniqueWord) {
        $all[$uniqueWord] = count(explode($uniqueWord, $string)) - 1;
      }
      // Adding amount of times word is used.
      arsort($all);
      return $all;
    }





    public function set($string) {
      // Gets smallests to largest ascii values. - Making sure the ascii isnt in the string.
      $small = $this->asciis($string);
      // Gets the ammount of times that the characters in the string are used.
      $charcount = $this->charcount($string);
      $string = str_replace(' ', '', $string);

      $count = 0; foreach ($charcount as $letter => $amount) {
        // Makes a new assoc array like: ARRAY[LETTER] = COMPRESSION_VALUE.
        $all[$letter] = $small[$count];

        $count++;
      }

      return $all;
    }


    public function compress($string, $printSet = 0) {
      // Gets the set definitions for the current string.
      $set = $this->set($string);
      if ($printSet) $this->display($set);
      // Ascii from small -> large.
      $pieces_of_compressed = array();
      // Makes new string and adds each compression to the array.
      $count = 0; foreach (explode(' ', $string) as $character) {
        if ($character != ' ') array_push($pieces_of_compressed, $set[$character]);
          else array_push($pieces_of_compressed, ' ');
      }

      $this->sets[implode('', $pieces_of_compressed)] = $set;
      return implode('', $pieces_of_compressed);
    }






    public function decompress($string, $set = false) {
      // Getting the correct set for decompressing.
      if ($set !== false) $set = $set;  // Not false
        else { // Is false.
          if (!isset($this->sets[$string])) die('could not decompress string - no previous compress set found');
            else $set = $this->sets[$string];
        }

      // Flips the set array.
      $set = array_flip($set);

      // Ascii from small -> large.
      $small = $this->asciis($string);
      // Makes new string and adds each compression to the array.
      $pieces_of_compressed = array();
      $count = 0; foreach (str_split($string) as $character) {
        if ($character != ' ') array_push($pieces_of_compressed, $set[$character]);
          else array_push($pieces_of_compressed, ' ');
      }

      return implode(' ', $pieces_of_compressed);
    }

  }
