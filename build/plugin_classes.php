<?php
  # This is a file that is loaded if the user asks for it to be loaded.
    # This file contains a bunch of classes that are made to help the compatability of plugins.

    # FONT AWESEOME CLASS.
    if ($Head->plugin_loaded('font-awesome')) {
      class FA {
        public static function AddFont($font = 'ambulance') {
          return "fa-$font";
        }
      } $fa = new FA();
    }

    # MATERIAL ICONS CLASS.
    if ($Head->plugin_loaded('material-icons')) {
      class MATERIAL_ICONS {
        public static function AddIcon($icon = 'accessibility') {
          return "<i class='material-icons'>$icon</i>";
        }
      } $MATERIAL_ICONS = new MATERIAL_ICONS();
    }
