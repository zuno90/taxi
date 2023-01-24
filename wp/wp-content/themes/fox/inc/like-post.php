<?php
function fox_post_like_table_create() {
global $wpdb;
$table_name = $wpdb->prefix. "post_like_table";
global $charset_collate;
$charset_collate = $wpdb->get_charset_collate();
global $db_version;
if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name)
{ $create_sql = "CREATE TABLE " . $table_name . " (
id INT(11) NOT NULL auto_increment,
postid INT(11) NOT NULL ,
clientip VARCHAR(40) NOT NULL ,
PRIMARY KEY (id))$charset_collate;";
require_once(ABSPATH . "wp-admin/includes/upgrade.php");
dbDelta( $create_sql );
}
if (!isset($wpdb->post_like_table))
{
$wpdb->post_like_table = $table_name;
$wpdb->tables[] = str_replace($wpdb->prefix, '', $table_name);
}
}
add_action( 'init', 'fox_post_like_table_create');
function fox_theme_name_scripts() {
if( is_singular()) {
wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/post-like.js', array('jquery'), '1.0.0', true );
}
wp_localize_script( 'script-name', 'MyAjax', array(
'ajaxurl' => admin_url( 'admin-ajax.php' ),
'security' => wp_create_nonce( 'my-special-string' )
));
}
add_action( 'wp_enqueue_scripts', 'fox_theme_name_scripts' );
function fox_get_client_ip() {
$ip=$_SERVER['REMOTE_ADDR']; 
return $ip;
}
function fox_my_action_callback() {
check_ajax_referer( 'my-special-string', 'security' );
$postid = intval( $_POST['postid'] );
$clientip=fox_get_client_ip();
$like=0;
$dislike=0;
$like_count=0;
global $wpdb;
$row = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");
if(empty($row)){
$wpdb->insert( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip' => $clientip ), array( '%d', '%s' ) );
$like=1;
}
if(!empty($row)){
$wpdb->delete( $wpdb->post_like_table, array( 'postid' => $postid, 'clientip'=> $clientip ), array( '%d','%s' ) );
$dislike=1;
}
$totalrow = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
$total_like=$wpdb->num_rows;
$data=array( 'postid'=>$postid,'likecount'=>$total_like,'clientip'=>$clientip,'like'=>$like,'dislike'=>$dislike);
echo json_encode($data);
die(); 
}
add_action( 'wp_ajax_my_action', 'fox_my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'fox_my_action_callback' );