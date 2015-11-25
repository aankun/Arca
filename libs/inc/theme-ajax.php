<?php
/**
 * All ajax request will processed here
 */
// sample
add_action( 'wp_ajax_nopriv_get-post', 'ajax_get_post' );
add_action( 'wp_ajax_get-post', 'ajax_get_post' );

function ajax_get_post(){
  extract($_GET);

  if (!wp_verify_nonce( $nonce, 'WayanLamunNonce12412984718' ))
    die('Busted!');

  $data = get_post( $id );
  $result = array(
    'id' => $id,
    'slug' => $data->post_name,
    'title' => $data->post_title,
    'content' => $data->post_content
  );
  $data = json_encode($result);
  echo $data;
  exit;
}
?>