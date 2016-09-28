<!-- All meta tags. -->
<meta charset='UTF-8'>
<?php
  foreach ($mconfig as $name => $content) {
    echo "<meta name='$name' content='$content' />";
  }
  foreach ($scratch_mconfig as $meta_name => $info) {
    echo "<meta $meta_name='{$info[0]}' content='{$info[1]}' />";
  }
