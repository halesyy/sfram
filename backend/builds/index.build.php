<?php
  $psm->posts([
    'first = first' => function($psm, $post){
      echo $post['first'].'<br/>';
    },
    'second = second' => function($psm, $post) {
      echo $post['second'];
    }
  ]);
