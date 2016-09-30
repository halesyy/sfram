<?php
  # The token that any user on the page has to know before building a new file.
  $AUTH_TOKEN = '123';

  $psm->posts([
    'sub' => function($psm,$post){ global $AUTH_TOKEN;
      # Making sure the AUTH is correct first.
      if ($post->token != $AUTH_TOKEN) die('the token was incorrect');

      # Making the build and view files.
      $build = fopen("backend/builds/{$post->filename}.build.php",'w');
      $view  = fopen("backend/views/{$post->filename}.view.php",'w');

# The content that is loaded into the build file.
$BUILD_TEXT = "<b>{$post->filename} - build_file</b><br/>
you generated this file, you will want to edit the contents of the files at: <br/><br/>
<b>backend/builds/{$post->filename}.build.php";
# The content that is loaded into the view file.
$VIEW_TEXT = "<b>{$post->filename} - view_file</b><br/>
you generated this file, you will want to edit the contents of the files at: <br/><br/>
<b>backend/views/{$post->filename}.view.php";

      # Adding content into the files.
      fwrite($build,$BUILD_TEXT);
      fwrite($view ,$VIEW_TEXT);

      # Closing the files.
      fclose($build);
      fclose($view);
    }
  ]);
