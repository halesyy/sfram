<?php
  class html {
    # Class variables.
    public $classes = array();
    public $savedStyles = array();


    public function startDiv($divStyle = false, $class = false) { # Starts div and will give it a style if wanted.
      if ($divStyle == 'IGNORE' OR $divStyle == 'NOTHING' or empty($divStyle)) $useStyle = false;
        else $useStyle = true;
      if ($divStyle === false) $useStyle = false;
      // Setting the use style as true or false.
      if ($class === false) $useClass = false;
        else $useClass = true;
      // Setting the use class as true or false.

      ?>
        <div <?php if ($useStyle) echo "style='$divStyle'"; ?> <?php if ($useClass) echo "class='$class'"; ?> >
      <?php
    }

    public function endDiv() { # Ends a div.
      echo '</div>';
    }



    public function element($elementName, $restOfElement = false) { # Makes an element.
      if ($restOfElement !== false) echo "<$elementName $restOfElement>";
        else echo "<$elementName>";
    }

    public function createClass($className, $styles) { # Makes a CSS class.
      # Manip for if given is an array.
      $styleString = '';
      if (is_array($styles)) foreach ($styles as $style) {
        if ($style[strlen($style) - 1] != ';' AND $style[strlen($style) - 1] == ' ') $style[strlen($style) - 1] = ';';
        if ($style[strlen($style) - 1] != ';') $style .= ';';
        if ($style[strlen($style) - 1] != ' ') $style .= ' ';
        $styleString .= $style;
      }
      # End of array manip.

      # If it's a normal string.
      if (!is_array($styles)) $styleString = $styles;
      # End of normal string making.

      # Making the string.
      echo "<style> .$className { $styleString } </style>";
    }


    public function saveStyles($name, $styleString = false) {
      if ($styleString === false) die('no style string given! function saveStyles() killed script');
      if (is_array($styleString)) die('arrays not valid for function saveStyles()');
      # End of error handling.
      $this->savedStyles[$name] = $styleString;
      return $this;
    }

    public function loadStyle($name) {
      return $this->savedStyles[$name];
    }





    public function specDiv($styleName = false, callable $divContent) {
      if ($styleName === false) die('no given style name to call and get style values from. fucntion specDiv() killed script.');
      # End of error handling. - Showing content. v
      echo "<div style='{$this->savedStyles[$styleName]}'>";
        $divContent();
      echo "</div>";
    }


    public function multiDiv($styleNames = false, callable $divContent) {
      $styles = explode(' ', $styleNames);
      $styleStore = ''; // Where the Styles are stores after manip.
      foreach ($styles as $style) { $styleStore .= ' '.$this->savedStyles[$style]; }
      # Displaying the content after manip. ^
      echo "<div style='$styleStore'>";
        $divContent();
      echo "</div>";
    }

  }
