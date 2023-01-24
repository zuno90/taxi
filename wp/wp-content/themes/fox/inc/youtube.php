<?php
// REGISTER POST TYPE: Youtube
global $youtube_options;
function fox_youtube_create_post_type(){
    $label = array(
        'name' => __('Youtube', 'fox'),
    	'singular_name' => __('Youtube', 'fox'),
    	'add_new' => __('Thêm Youtube', 'fox'),
    	'add_new_item' => __('Thêm Youtube', 'fox'),
    	'edit_item' => __('Chỉnh sửa Youtube', 'fox'),
    	'new_item' => __('Youtube', 'fox'),
    	'view_item' => __('Xem Youtube', 'fox'),
    	'search_items' => __('Tìm Youtube', 'fox'),
    	'not_found' => __('Không có Youtube nào', 'fox'),
    	'not_found_in_trash' => __('Không có Youtube nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả Youtube', 'fox'),
    	'menu_name' => __('Youtube', 'fox'),
    	'name_admin_bar' => __('Youtube', 'fox'),
    );
 
    $args = array(
        'labels'              => $label,
        'supports'            => array( 'title', 'editor', 'comments'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true, 
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true, 
        'show_in_admin_bar'   => true,
        'menu_position'       => 5, 
        'menu_icon'           => 'dashicons-video-alt3', 
        'can_export'          => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'map_meta_cap'        => true,  
		'has_archive'         => 'youtube',
		'rewrite'             => array('slug' => 'youtube/%channel%'),

    );
 
    register_post_type('youtube', $args);
}
add_action( 'init', 'fox_youtube_create_post_type' );
// custom chuyen channel youtube
function fox_youtube_custom_taxonomy() {
    $labels = array(
        'name' => __('Chuyên mục', 'fox'),
        'singular' => __('Chuyên mục', 'fox'),
        'menu_name' => __('Chuyên mục', 'fox'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'youtube'),
		
    );
    register_taxonomy('channel', 'youtube' , $args);
}
add_action( 'init', 'fox_youtube_custom_taxonomy', 0 );
// tao thu channel dong sau luu tru
function fox_create_youtube_link( $post_link, $id = 0 ){
$post = get_post($id);
if ( is_object( $post ) ){
$terms = wp_get_object_terms( $post->ID, 'channel' );
if( $terms ){
return str_replace( '%channel%' , $terms[0]->slug, $post_link );
} else {return str_replace( '%channel%' , 'channel', $post_link );}
}
return $post_link;
}
add_filter( 'post_type_link', 'fox_create_youtube_link', 1, 3 );
flush_rewrite_rules();




// khai bao thong tin
function fox_thongtin_meta_youtube()
{
add_meta_box( 'mebox-youtube', __('Thêm video Youtube của bạn', 'fox'), 'fox_thongtin_output_youtube', 'youtube' );
}
add_action( 'add_meta_boxes', 'fox_thongtin_meta_youtube' );
 
// khai báo callback
function fox_thongtin_output_youtube( $post ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
$youtube1 = get_post_meta( $post->ID, 'youtube1', true );
?>
<div class="post-main">
<p><input id="post-input" placeholder="<?php _e('Thêm link Youtube', 'fox'); ?>" type="text" name="youtube1" value="<?php echo esc_attr( $youtube1 ); ?>" /></p>
<p class="post-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bạn nhập link video Youtube vào ô trên', 'fox'); ?></p>
</div>
<?php }
// Lưu dữ liệu và tạo nonce bảo mật
function fox_thongtin_save_youtube( $post_id ) {
if(isset($_POST['thongtin_nonce'])){
$thongtin_nonce = $_POST['thongtin_nonce'];
}
if( !isset( $thongtin_nonce ) ) {
return;
}
if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
return;
}
if(isset($_POST['youtube1'])){
update_post_meta( $post_id, 'youtube1', $_POST['youtube1']);
}
}
add_action( 'save_post', 'fox_thongtin_save_youtube' );
// hien thi youtube ra trang chu
function fox_youtube_home_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('youtube'));
    return $query;
}
add_filter('pre_get_posts','fox_youtube_home_type');

