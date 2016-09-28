<?php
  # Management for things user wants in their project.

  # The most ghetto "DEPENDANCY MANAGER" ever. ;) Thank Jek <3
    $plugins = [
      'jquery' => true,
      'mdl' => false,
      'materialize' => false,
      'material-icons' => false,
      'font-awesome' => true
    ];
    $plugin_files = [
      'jquery' => [
        ['js','https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js']
      ],
      'mdl' => [
        ['js','https://code.getmdl.io/1.2.0/material.min.js'],
        ['css','https://code.getmdl.io/1.2.0/material.indigo-pink.min.css','https://fonts.googleapis.com/icon?family=Material+Icons']
      ],
      'materialize' => [
        ['js','https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js'],
        ['css','https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css']
      ],
      'material-icons' => [
        ['css','https://fonts.googleapis.com/icon?family=Material+Icons']
      ],
      'font-awesome' => [
        ['css','/packages/font-awesome/font-awesome.min.css']
      ]
    ];
  # Project management.
  # Importing.
  foreach ($plugins as $plugin => $wants) {
    if ($wants === true) {
      foreach ($plugin_files[$plugin] as $container) {
        $type = $container[0];
        if ($type == 'js') {
          # Treat the declaration vars as a javascript imports.
          foreach ($container as $filename) if ($filename != 'js') {
            echo "<script src='$filename'></script>";
          }
        }
        if ($type == 'css') {
          # Treat the declaration vars as a javascript imports.
          foreach ($container as $filename) if ($filename != 'css') {
            echo "<link rel='stylesheet' type='text/css' href='$filename'>";
          }
        }
      }
    }
  }





  # Will manage the slugs importing of javascript and css.
    # $cur is the variable we use to tell what slug we are on.
    $imports = [
      # js = declaration; test.js = filename.

      'always' => [
        # Going to always be added no matter the page.
        ['css','/public/css/cssreset.css']
      ],

      'index|home' => [
        ['title','Jek\'s Framework']
      ]

    ];

    # The tempalte that the code runs by, if the first thing in the array is [css], then will replace the content in the array in REPLACE.
    $import_templates = [
      'css'   => '<link rel="stylesheet" href="REPLACE" type="text/css">',
      'js'    => '<script src="REPLACE"></script>',
      'title' => '<title>REPLACE</title>'
    ];

    # Re-write to make the system easier to understand.
    foreach ($imports as $slug => $to_import) {
      # Slug = The name of the slug that to_import has to be added to.
      # to_import = The files that are needed to be added.
        $slugs = explode('|',$slug);
        if (in_array($current,$slugs)) {
          # The slug was found, we need to import anything in to_import array.
          foreach ($to_import as $import_list) {
            # import_list = The array containing what is being added (css, cssFile1.css, cssFile2.css), so doing impost_list[0] = getting what file_type is being required.
            $file_type = array_shift($import_list);
            foreach ($import_list as $file_to_add) {
              # If the file_type = css, will load the CSS template.
              $template = $import_templates[$file_type];
              echo str_replace('REPLACE',$file_to_add,$template);
              # Will replace the REPLACE with the content and then add it to the viewing port.
            }
          }
        }
    } # End of importing the files.
    foreach ($imports['always'] as $always_import) {
      # Will load the files given always on each page.
      # Getting the file_type of the current files.
      $file_type = array_shift($always_import);
      foreach ($always_import as $file_to_add) {
        # Importing the files, following the rules given for the normal imports.
        $template = $import_templates[$file_type];
        echo str_replace('REPLACE',$file_to_add,$template);
        # Replacing the replace with the file_adding type.
      }
    }

    class Head {
      # Storing the current plugins added on this load.
      public $loaded_plugins = [];
      public $loaded_files   = [];

      # This fucntion is a function that will add all the files and plugins that were loaded into the class objects of loaded_plugins and loaded_files in an array.
      public function __construct() {
        global $plugins, $plugin_files, $current, $tools, $imports;
        # Getting the plugins that're loaded.
        array_push($this->loaded_plugins,"<b>THESE ARE ALL THE CURRENT FILES LOADED FOR THE SLUG $current</b>");
        foreach ($plugins as $plugin_name => $wants) if ($wants)
          array_push($this->loaded_plugins, "<font color='green'>[plug]</font> <b>{$plugin_name}</b>: loaded");
        # End of getting the loaded plugins.
        # Getting the loaded files.
        foreach ($imports as $slug => $to_import) {
          # Getting all the slugs in the code-base.
          $slugs = explode('|',$slug);
          if (in_array($current,$slugs)) {
            # This is the matching slug for our current slug, gotta add all the import files.
            foreach ($to_import as $importing_files) {
              # Looping each array that contains files we need to add.
              $file_type = array_shift($importing_files);
              foreach ($importing_files as $file_to_import) {
                array_push($this->loaded_files,"<font color='red'>[file]</font> <b>{$file_type}</b>: {$file_to_import}");
              } # Will loop the singular files that need to be imported into the view-port.
            }
          }
        } # End of management for different slugs.
        # Adding the "always loaded" files.
        foreach ($imports['always'] as $import_files) {
          # Looping file_type:import_files arrays.
          $file_type = array_shift($import_files);
          foreach ($import_files as $files_to_add) {
            # Loops the content in the array after removed the first part of the array containing the file_type.
            array_push($this->loaded_files,"<font color='blue'>[alwa]</font> <b>{$file_type}</b>: {$files_to_add}");
          }
        }
        # End of the management for the files that are always added.
      }


      # This function displays the current loaded functions.
      public function loaded() {
        global $tools;
        $files = array_merge($this->loaded_plugins,$this->loaded_files);
        $tools->display($files);
      }

      # Checks to see if a plugin is loaded.
      public function plugin_loaded($plugin_name) {
        global $plugins;
        if ($plugins[$plugin_name]) return true;
          else return false;
      }

    } $Head = new Head();
    # This is the Head class used to watch the HTML HEAD area if needed, use $Head->loaded() to see what the HTML HEAD has loaded for each slug.

    # Management for plugin-classes.
    $use_plugin_classes = true;
    if ($use_plugin_classes) require "build/plugin_classes.php";

    # Adding the meta tags if wanted.
    if ($use_metas) require "backend/templates/metas.php";

?></head><body>
