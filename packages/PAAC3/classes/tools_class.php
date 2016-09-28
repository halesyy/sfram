<?php

  class PAAC3_TOOLS {

    public function value($string) {
      // Return the value of all of the ascii values to the string.
      $vals = array();
      // Getting each ascii value and adding in array.
      foreach (str_split($string) as $str) {
        array_push($vals, ord($str) );
      }
      // Returns the value.
      return array_sum($vals);
    }



    public function compare($string, $disstring = 1) {
      // Gets the uncompressed string values and the compressed string value.
      if ($disstring) $data['string'] = $string;
        else $data['string'] = 'not wanted to display';
      if ($disstring) $data['actually compressed'] = $this->compress($string);
        else $data['actually compressed'] = 'not wanted to display';
      // End of sorting out the data that is possibly largely outputted.
      $data['uncompressed'] = $this->value($string);
      $data['compressed'] =  $this->value($this->compress($string));
      $data['difference'] = $data['uncompressed'] - $data['compressed'];
      // Gets the percentage of the original string.
      $pOfOr = floor($data['compressed'] / $data['uncompressed'] * 100);
      $data['percentage of oringinal string'] = $pOfOr.'%';
      $data['percentage decrease'] = (100 - $pOfOr).'%';
      // Displays the data.
      echo '<pre>',print_r($data),'</pre>';
      // THANKS SUR FOR HELPING ME DO THE PERCENTAGES!
    }




    public function com_dec($string) {
      $data['uncompressed'] = $string;
      $data['compressed'] = $this->compress($string);
      $data['uncompressed compress'] = $this->decompress($data['compressed']);

      $this->display($data);
    }


    public function runtime($test) {
      $before = microtime(true);
        echo $test.'<br/>';
      $after = microtime(true) - $before;
      return $after.'<br/>';
    }


    public function display($array) {
      echo '<pre>',print_r($array),'</pre>';
    }

  }
