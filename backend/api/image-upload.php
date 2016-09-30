<?php
  define ('SITE_ROOT', realpath(dirname(__FILE__)));
  # The backend for image-uploading.
  $ppath = "/public/img/bday-img/";
  $path  = SITE_ROOT."/public/img/bday-img/";
  $path  = str_replace('backend\api/','',$path);
  $path  = str_replace('\\','/',$path);
  # The valid formats we can use to upload.
  $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
  # Image management.
  if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
    # Getting the name and size of the photos.
    $name = $_FILES['photoimg']['name'];
    $size = $_FILES['photoimg']['size'];
    if(strlen($name)) {
      list($txt, $ext) = explode(".", $name);
      if(in_array($ext,$valid_formats)) {
        if($size<(1024*1024)) { # Max-size image is 1MB.
          $actual_image_name = time().".".$ext;
          $tmp = $_FILES['photoimg']['tmp_name'];
          if(move_uploaded_file($tmp, $path.$actual_image_name)) {
            # Displaying the actual image.
            echo $ppath.$actual_image_name;
            // echo "<img src='$path".$actual_image_name."'>";
          }
        }
      }
    }
  }
