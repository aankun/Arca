<?php
/**
 * 
 */

// simpler echo
if (!function_exists('e')) {
  function e($data){
    echo $data;
  }
}

// custom url
if (!function_exists('setUrl')) {
  function setUrl($link){
    $link = preg_replace('#^https?://#', '', $Link);
    return 'http://'.$link;
  }
}

// image placeholder
if (!function_exists('placeholder')) {
  function placeholder($width = '300', $height = '300', $text = true){
    if($text){
      return 'http://placehold.it/'.$width.'x'.$height.'?text='.get_bloginfo( 'name' );
    }else{
      return 'http://placehold.it/'.$width.'x'.$height;
    }
  }
}

if (!function_exists('getShareUrl')) {
  function getShareUrl($type = '', $args = array()){
    /*
    args format
    array(
      'title'   => 'The Title',
      'content' => 'The content',
      'source'  => 'Source'
    );

    example:
    <a href="#"                                             onclick="<?php echo getShareUrl('fb');?>">Facebook</a>
    <a href="<?php echo getShareUrl('pinterest', $args);?>" target="_blank">Pinterest</a>
    <a href="<?php echo getShareUrl('email', $args);?>"     target="_blank">Email</a>
    <a href="<?php echo getShareUrl('twitter', $args);?>"   target="_blank">Twitter</a>
    <a href="<?php echo getShareUrl('linkedin', $args)?>"   target="_blank">Linked In</a>
    <a href="<?php echo getShareurl('googleplus');?>"       target="_blank">G+</a></li>
    */
    $url = '';

    extract($args);
    if(!$title){
      $title = get_the_title();
    }
    if(!$content){
      $content = get_the_excerpt();
      $content .= '  '.esc_url_raw( get_permalink() );
    }else{
      $content = str_replace('{{link}}', esc_url_raw(get_permalink()), $content);
    }

    if(!$source){
      $source = get_bloginfo( 'name' );
    }

    if(has_post_thumbnail( get_the_id() )){
      $img = wp_get_attachment_url(get_post_thumbnail_id( get_the_id() ));
    }else{
      $img = placehold(400, 300);
    }
    switch ($type) {
      case 'fb':
        $url = 'window.open(\'http://www.facebook.com/sharer.php?u='.esc_url_raw(get_permalink()).'\', \'_blank\', \'location=yes,height=570,width=520,scrollbars=yes,status=yes\');';
        break;
      case 'email':
        $url = 'mailto:?subject='.esc_html($title).'&body='.$content;
        break;
      case 'pinterest':
        $url = 'https://www.pinterest.com/pin/create/button/?url='.esc_url_raw(get_permalink()).'&media='.esc_url_raw( $img ).'&description='.esc_html( strip_tags($content) );
        break;
      case 'twitter':
        $url = 'https://twitter.com/home?status='.$content;
        break;
      case 'linkedin':
        $url = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url_raw(get_permalink()).'&title='.$title.'&summary='.$content.'&source='.$source;
        break;
      case 'googleplus':
        $url = 'https://plus.google.com/share?url='.esc_url_raw( get_permalink() );
        break;
      default:
        # code...
        break;
    }
    return $url;
  }
}

if (!function_exists('limit')) {
  function limit($content, $limit = 50){
    $content = strip_shortcodes( $content );
    $content = strip_tags( $content );
    $content = substr( $content, 0, $limit );
    return $content.'...';
  }
}

if (!function_exists('btn_edit')) {
  function btn_edit(){
    return edit_post_link( __( '' ), '<span class="edit-link" title="Edit post">', '</span>' );
  }
}

if (!function_exists('wp_pagination')) {
  function wp_pagination() {

    if( is_singular() )
      return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
      return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
      $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
      $links[] = $paged - 1;
      $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
      $links[] = $paged + 2;
      $links[] = $paged + 1;
    }

    echo '<nav><ul class="pagination">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
      printf( '<li>%s</li>' . "\n", get_previous_posts_link('&laquo;') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
      $class = 1 == $paged ? ' class="active"' : '';

      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

      if ( ! in_array( 2, $links ) )
        echo '<li>...</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
      $class = $paged == $link ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
      if ( ! in_array( $max - 1, $links ) )
        echo '<li>...</li>' . "\n";

      $class = $paged == $max ? ' class="active"' : '';
      printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
      printf( '<li>%s</li>' . "\n", get_next_posts_link('&raquo;') );

    echo '</ul></nav>' . "\n";
  }
}