<?php
/**
 * 
 */
function main_menu(){
  wp_nav_menu( array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => '',
    'container_class'   => '',
    'container_id'      => '',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker())
  );
}