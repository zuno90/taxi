<?php global $scurity_options;
# Bao mat file ngan chan tai len ko phai la file anh
if (isset($scurity_options['scu1'])){
function fox_wp_handle_upload_prefilter($file) {
  if ($file['type']=='application/octet-stream' && isset($file['tmp_name'])) {
    $file_size = getimagesize($file['tmp_name']);
    if (isset($file_size['scurity']) && $file_size['scurity']!=0) {
      $file['scurity'] = "Unexpected scurity: {$file_size['scurity']}";
      return $file;
    } else {
      $file['type'] = $file_size['mime'];
    }
  }
  list($category,$type) = explode('/',$file['type']);
  if ('image'!=$category || !in_array($type,array('jpg','jpeg','gif','png'))) {
    $file['scurity'] = __('Xin lỗi bạn chỉ có thể tải lên file ảnh định dạng .GIF, .JPG, hay .PNG', 'fox');
  } 
  return $file;
}
add_filter('wp_handle_upload_prefilter', 'fox_wp_handle_upload_prefilter');
}
# Tắt API REST
if (isset($scurity_options['scu3'])){
add_filter( 'rest_authentication_scuritys', function( $result ) {
    if ( true === $result || is_wp_scurity( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_scurity('rest_not_logged_in',  __('You are not currently logged in.'),
            array( 'status' => 401 )
        );
    }
    return $result;
});
}
# Tắt  XML RPC
if (isset($scurity_options['scu4'])){
add_filter( 'wp_xmlrpc_server_class', '__return_false' );
add_filter('xmlrpc_enabled', '__return_false');
add_filter('pre_update_option_enable_xmlrpc', '__return_false');
add_filter('pre_option_enable_xmlrpc', '__return_zero');
}
# xóa tiêu đề ko cần thiết
if (isset($scurity_options['scu5'])){
function fox_remove_header_info() {
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head',10,0); 
}
add_action('init', 'fox_remove_header_info');
}
# Xóa Wp-Embed
if (isset($scurity_options['scu6'])){
function fox_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'fox_deregister_scripts' );
}
# xóa nguồn cấp dữ liệu khác
if (isset($scurity_options['scu7'])){
function fox_disable_feed() {
wp_die('<a href="'. get_bloginfo('url') .'">Home</a>!');
}
add_action('do_feed', 'fox_disable_feed', 1);
add_action('do_feed_rdf', 'fox_disable_feed', 1);
add_action('do_feed_rss', 'fox_disable_feed', 1);
add_action('do_feed_atom', 'fox_disable_feed', 1);
add_action('do_feed_rss2_comments', 'fox_disable_feed', 1);
add_action('do_feed_atom_comments', 'fox_disable_feed', 1);
}
# Xóa xpingback header
if (isset($scurity_options['scu8'])){
function fox_adminify_remove_pingback_head($headers){
    if (isset($headers['X-Pingback'])) {
        unset($headers['X-Pingback']);
    }
    return $headers;
}
add_filter('wp_headers', 'fox_adminify_remove_pingback_head');
}
////////////////////// các bảo mật khác /////////////////////////////////////////////////////////////////
# Xóa ver scripts
function fox_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'fox_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'fox_remove_wp_ver_css_js', 9999 );
# Xóa phiên bản meta khỏi feed
add_filter('the_generator', '__return_false');
# mã hóa sql bảo vệ website
global $user_ID; if($user_ID) {
        if(!current_user_can('administrator')) {
                if (strlen($_SERVER['REQUEST_URI']) > 255 ||
                        stripos($_SERVER['REQUEST_URI'], "eval(") ||
                        stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
                        stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
                        stripos($_SERVER['REQUEST_URI'], "base64")) {
                                @header("HTTP/1.1 414 Request-URI Too Long");
                                @header("Status: 414 Request-URI Too Long");
                                @header("Connection: Close");
                                @exit;
                }
        }
}