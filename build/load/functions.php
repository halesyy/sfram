<?php
  # A LOAD FILE MADE FOR LOADING ALL FUNCTIONS IN THE FRAMEWORK.
  foreach (glob('backend/functions/*.php') as $function) {
    require "$function";
  }
