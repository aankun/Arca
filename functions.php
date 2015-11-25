<?php
/**
 * Arca functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Arca
 */

define('ARCA_DIR', get_template_directory());
define('ARCA_URL', get_template_directory_uri());
define('ARCA_IMG', ARCA_URL.'/assets/images');
define('ARCA_CSS', ARCA_URL.'/assets/styles');
define('ARCA_MAIN_CSS', get_stylesheet_uri());
define('ARCA_JS', ARCA_URL.'/assets/scripts');

function loader($folders){
  foreach ($folders as $folder) {
    $paths = ARCA_DIR.'/'.$folder;
    $files = glob($paths.'/*.php');

    foreach ($files as $key => $file) {
      if(file_exists($file))
        require_once $file;
    }
  }
}

$folders = array(
  'libs/inc',
  'libs/extends'
);

loader($folders);