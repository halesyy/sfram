<?php
  session_start(); ob_start();
  # Adding the configuration.
    # ADD ICO IMAGE.
    # ADD METAS.
    # CRYPTING KEY.
  require "config/config.php";
  # Building the backend script.
    # ADDING FUNCTIONS.
    # SETTING CLASS OBJECTS.
    # SETTING SOME ALWAYS NEEDED VARIABLES.
    # RENAMES.
  require "build/build.php";
  # Building the Database connection. (using PSM)
    # Connecting to a database using PSM.
    # Adding the auth class if the user wants it.
  require "config/database.php";

    # STARTING PAGE RENDER.
    if ($current == 'api') {
      # API Requires nothing.
      require "backend/api/api.php";
    } else {
      # Simply adds the start of a HTML file.
      require "backend/templates/html/html_page_starter.php";
      # Adding everything to be added in the HTML <Head> - imports etc...
      # IMPORT MANAGEMENT IS IN HERE.
      require "backend/templates/html_head.php";
      # HEADER.
      require "backend/templates/header.php";
      # Serving the users content that they want.
      # Adding the build file with variable setting then the template of HTML (the view).
      require "build/routes.php";
    }
