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

$arca_includes = array(
  'libs/inc/theme-action.php',
  'libs/inc/theme-ajax.php',
  'libs/inc/theme-filter.php',
  'libs/inc/theme-frontend.php',
  'libs/inc/theme-functions.php',
  'libs/inc/theme-hooks.php',
  'libs/inc/theme-options.php',
  'libs/inc/theme-post-types.php',
  'libs/inc/theme-setup.php',
  'libs/extends/menu-walker.php',
  'libs/extends/custom-header.php',
  'libs/extends/customizer.php',
  'libs/extends/extras.php',
  'libs/extends/jetpack.php',
  'libs/extends/template-tags.php',
  'libs/extends/get-the-image.php',
);

foreach ($arca_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'arca'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);