<?php
/**
 * Some WP filter
 * 
 */

/* replace howdy */
function replace_howdy( $wp_admin_bar ) {
  $my_account = $wp_admin_bar->get_node( 'my-account' );
  $newtitle   = str_replace( 'Howdy,', 'Hi, ', $my_account->title );
  $wp_admin_bar->add_node( array(
    'id'    => 'my-account',
    'title' => $newtitle,
  ) );
}

add_filter( 'admin_bar_menu', 'replace_howdy', 25 );

/* Modify the length of post excerpts */
function sp_excerpt_length( $length ) {
  return 50; // pull first 50 words
}
add_filter( 'excerpt_length', 'sp_excerpt_length' );

/* Remove three dots for content excerpt */
function new_excerpt_more( $more ) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* allow upload file type */
function pick_mime_types($mimes){
  $mimes['svg'] = '/image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'pick_mime_types' );