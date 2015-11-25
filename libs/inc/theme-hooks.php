<?php
/**
 * 
 */

/**
 * Enqueue scripts and styles.
 */
function arca_scripts() {
  wp_enqueue_style( 'arca-style', ARCA_MAIN_CSS );
  wp_enqueue_script( 'arca-lib', ARCA_JS . '/lib/lib.min.js', array(), '20120206', true );
  wp_enqueue_script( 'arca-app', ARCA_JS . '/app.js', array(), '20130115', true );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'arca_scripts' );


// function arca_admin_styles() {
//   wp_enqueue_style( 'arca_admin', ARCA_CSS.'/admin.css');
// }
// add_action( 'admin_enqueue_scripts', 'arca_admin_styles' );

function arca_favicon(){
  ?>
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo ARCA_IMG;?>/favicon/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="<?php echo ARCA_IMG;?>/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo ARCA_IMG;?>/favicon/android-chrome-192x192.png" sizes="192x192">
  <link rel="icon" type="image/png" href="<?php echo ARCA_IMG;?>/favicon/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="<?php echo ARCA_IMG;?>/favicon/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="<?php echo ARCA_IMG;?>/favicon/manifest.json">
  <link rel="mask-icon" href="<?php echo ARCA_IMG;?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="msapplication-TileImage" content="/mstile-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <?php
}
add_action( 'wp_head', 'arca_favicon' );
