<?php

// REGISTER POST TYPE: CHAP
function create_post_type(){
    $label = array(
        'name' => __('Chương', 'fox'),
    	'singular_name' => __('Chương', 'fox'),
    	'add_new' => __('Thêm chương mới', 'fox'),
    	'add_new_item' => __('Thêm chương mới', 'fox'),
    	'edit_item' => __('Chỉnh sửa chương', 'fox'),
    	'new_item' => __('Chương', 'fox'),
    	'view_item' => __('Xem chương', 'fox'),
    	'search_items' => __('Tìm chương', 'fox'),
    	'not_found' => __('Không có chương nào', 'fox'),
    	'not_found_in_trash' => __('Không có chương nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả chương', 'fox'),
    	'menu_name' => __('Chương', 'fox'),
    	'name_admin_bar' => __('Chương', 'fox'),
    );
 
    $args = array(
        'labels'              => $label,
        'supports'            => array( 'title', 'editor', 'parent', 'revisions', 'thumbnail', 'comments'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true, 
        'show_in_menu'        => false,
        'show_in_nav_menus'   => true, 
        'show_in_admin_bar'   => true,
        'menu_position'       => 5, 
        'menu_icon'           => '', 
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post'
    );
 
    register_post_type('story', $args);
}
add_action( 'init', 'create_post_type' );

// taxonomy tacgia
function fox_add_author(){

	$args = array(
		'labels'            => array(
			'name'      => __('Tác giả', 'fox'),
			'singular'  => __('Tác giả', 'fox'),
			'menu-name' => __('Tác giả', 'fox')
		),
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_tagcloud'     => true,
		'show_in_nav_menus' => true,
		'rewrite'           => array( 'slug' => 'tac-gia' )
	);

	register_taxonomy('tac-gia', 'post', $args);

}
add_action('init', 'fox_add_author', 0);



// nut thêm chuong tự đông lấy bài viết theo id trong ds chuong
add_filter( 'admin_url', 'wpse_271288_change_add_new_link_for_post_type', 10, 2 );
function wpse_271288_change_add_new_link_for_post_type( $url, $path ){
$post_td = !empty($_GET['post_parent']) ? trim(strip_tags(stripslashes($_GET['post_parent']))): '';
    if( $path === 'post-new.php?post_type=story' ) {
        $url = get_bloginfo('url').'/wp-admin/post-new.php?post_type=story&post_parent='.$post_td;
    }
    return $url;
}
// thay đổi thông tin post thanh truyện
function chuck_change_post_type_menu() {
	global $menu;
	global $submenu;
	$menu[5][0]                 = __('Truyện', 'fox');
	$submenu['edit.php'][5][0]  = __('Quản lý truyện', 'fox');
	$submenu['edit.php'][10][0] = __('Truyện mới', 'fox');
	foreach ( $menu as $key => $val ) {
		if ( 'Truyện' == $val[0] ) {
			$menu[$key][6] = 'dashicons-welcome-write-blog';
		}
	}
}
add_action( 'admin_menu', 'chuck_change_post_type_menu' );
// tao input nhap ten truyen goc
function mystoryparrent( $post_data = false ) {
$scr = get_current_screen();
$post_td = !empty($_GET['post_parent']) ? trim(strip_tags(stripslashes($_GET['post_parent']))): ''; // lấy id của truyện trên url
if (!empty($post_td)){
$tieude = get_the_title($post_td);
} else {
$tieude = '';
}
$value = '';
if ( $post_data ) {
$t = get_post($post_data);
$a = get_post($t->post_parent);
$value = $a->post_title;
}
if ($scr->id == 'story')
echo '<input style="width:100%;padding:0px 10px;font-size:17px;" placeholder="'. __('Nhập tên truyện vào', 'fox') .'" type="text" name="parent" value="'.$tieude.$value.'" /></label><br /><br />';
}
add_action( 'edit_form_after_title', 'mystoryparrent' );

add_action( 'save_post', 'save_mystory' );
function save_mystory( $post_id ) {
$story = isset( $_POST['parent'] ) ? get_page_by_title($_POST['parent'], 'OBJECT', 'post') : false ;
if ( ! wp_is_post_revision( $post_id ) && $story ){
remove_action('save_post', 'save_mystory');
$postdata = array(
'ID' => $_POST['ID'],
'post_parent' => $story->ID
);
wp_update_post( $postdata );
add_action('save_post', 'save_mystory');
}
}

// them mo ta cua truyen ---------------------------------------------------------------metabox trong giới thiệu truyện.
function fox_meta_story_mota()
{
 add_meta_box( 'mota-story', __('Chức năng đăng truyện chữ', 'fox'), 'fox_thongtin_story_mota', 'post' );
}
add_action( 'add_meta_boxes', 'fox_meta_story_mota' );
function fox_thongtin_story_mota( $post )
{
  $story_mota1 = get_post_meta( $post->ID, 'story_mota1', true );
  $story_mota2 = get_post_meta( $post->ID, 'story_mota2', true );
  wp_nonce_field( 'save_thongtin', 'thongtin_nonce' ); ?>
  <div class="post-main">
  <div class="post-muc"><i class="fa-regular fa-badge-check"></i> <?php _e('Trạng thái', 'fox'); ?></div>
   <p><select class="post-sel" name="story_mota1">
        <option value=""><?php _e('Không chọn', 'fox'); ?></option>
        <option value="<?php _e('Đang ra', 'fox'); ?>" <?php selected($story_mota1, __('Đang ra', 'fox')); ?>><?php _e('Đang ra', 'fox'); ?></option>
        <option value="<?php _e('Hoàn thành', 'fox'); ?>" <?php selected($story_mota1, __('Hoàn thành', 'fox')); ?>><?php _e('Hoàn thành', 'fox'); ?></option>
   </select></p>
   <div class="post-muc"><i class="fa-regular fa-house-chimney-user"></i> <?php _e('Nguồn truyện', 'fox'); ?></div>
   <p><input style="width:100%;border:2px solid #ccc" placeholder="<?php _e('Nguồn truyện', 'fox'); ?>" type="text" name="story_mota2" value="<?php echo esc_attr($story_mota2); ?>" /></p>
   <p>
   <a class="post-download" href="<?php echo get_bloginfo('url'); ?>/wp-admin/post-new.php?post_type=story&post_parent=<?php echo $post->ID; ?>"><i class="fa-regular fa-plus"></i> <?php _e('Chương mới', 'fox'); ?></a>
   <a class="post-download" href="<?php echo get_bloginfo('url'); ?>/wp-admin/edit.php?post_type=story&post_parent=<?php echo $post->ID; ?>"><i class="fa-regular fa-list"></i> <?php _e('Danh sách chương', 'fox'); ?></a>
   </p>
   </div>
  <?php
}
function fox_thongtin_save_story_mota( $post_id )
{
if(isset($_POST['thongtin_nonce'])){	
$thongtin_nonce = $_POST['thongtin_nonce'];
}
 if( !isset( $thongtin_nonce ) ) {
  return;
 }
 if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
  return;
 }
 if(isset($_POST['story_mota1'])){ 
 update_post_meta( $post_id, 'story_mota1', sanitize_text_field($_POST['story_mota1']));
 }
 if(isset($_POST['story_mota2'])){ 
 update_post_meta( $post_id, 'story_mota2', sanitize_text_field($_POST['story_mota2']));
 }
}
add_action( 'save_post', 'fox_thongtin_save_story_mota' );
// them audio truyen ---------------------------------------------------------------metabox audio.
global $story_options;
if (isset($story_options['enable2'])){
function rum_meta_story_audio()
{
 add_meta_box( 'thong-tin3', __('Chức năng đăng truyện Audio', 'fox'), 'rum_thongtin_story_audio',  array('post', 'story'));
}
add_action( 'add_meta_boxes', 'rum_meta_story_audio' );
function rum_thongtin_story_audio( $post ) {
  $story_audio1 = get_post_meta( $post->ID, 'story_audio1', true );
  
  $story_audio2 = get_post_meta($post->ID, 'story_audio2', true);
  $story_audio2 = explode(',', $story_audio2);
  $story_audio21 = get_post_meta($post->ID, 'story_audio21', true);
  $story_audio21 = explode(',', $story_audio21);
  $audio_link_all1 = array_combine($story_audio2, $story_audio21);
  
  $story_audio3 = get_post_meta( $post->ID, 'story_audio3', true );
  wp_nonce_field( 'save_thongtin', 'thongtin_nonce' ); ?>
  <div class="post-main">
   <div class="post-muc"><i class="fa-regular fa-headphones-simple"></i> <?php _e('Thông tin truyện', 'fox'); ?></div>
    <p><input id="post-input" placeholder="<?php _e('Tác giả truyện hoặc list truyện', 'fox'); ?>" type="text" name="story_audio1" value="<?php echo esc_attr($story_audio1); ?>" /></p>
    <div class="post-muc"><i class="fa-regular fa-file-audio"></i> <?php _e('Tập tin truyện', 'fox'); ?></div>
    <div class="banglink1">
        <?php
        if(isset($audio_link_all1) && is_array($audio_link_all1)) {
            $i = 1;
            $output = '';
            foreach($audio_link_all1 as $text => $text2){
                $output = '<div style="display:flex;margin-top:10px">
                <input id="post-input" placeholder="'. __('Nhập link file MP3 vào', 'fox') .'" type="text" name="story_audio2[]" value="' . $text . '">
                <input id="post-input" placeholder="'. __('Nhập tên truyện', 'fox') .'" type="text" name="story_audio21[]" value="' . $text2 . '">';
                if( $i !== 1 && $i > 1 ) $output .= '<a href="#" class="remove_field post-download-del">X</a></div>';
                else $output .= '</div>';
                echo $output;
                $i++;
            }
        } else {
        echo '<div style="display:flex;margin-top:10px">
        <input id="post-input" placeholder="'. __('Nhập link file MP3 vào', 'fox') .'" type="text" name="story_audio2[]">
        <input id="post-input" placeholder="'. __('Nhập tên truyện', 'fox') .'" type="text" name="story_audio21[]"></div>';
        }
    ?>
    </div>
    <p><a class="themlink1 post-download"><i class="fa-regular fa-album-collection"></i> <?php _e('Thêm list', 'fox'); ?></a></p>
    <div class="post-muc"><i class="fa-regular fa-file-audio"></i> <?php _e('Thay vì bạn nhập từng file như ở trên, bạn có thể nhập danh sách file mp3 bằng ô bên dưới và nhớ là phải xuống dòng nhé.', 'fox'); ?></div>
    <p><textarea class="post-textarea" placeholder="<?php _e('Thêm list file mp3', 'fox'); ?>" type="text" name="story_audio3"><?php echo esc_textarea($story_audio3); ?></textarea></p>
	</div>
<?php }
function admin_enqueue_scripts_audio() {
    wp_enqueue_script( 'audio-script', get_template_directory_uri() . '/inc/js/link-mp3.js', array( 'jquery' ), true);
}
add_action('admin_enqueue_scripts', 'admin_enqueue_scripts_audio');

function rum_thongtin_save_story_audio( $post_id )
{
if(isset($_POST['thongtin_nonce'])){	
$thongtin_nonce = $_POST['thongtin_nonce'];
}
 if( !isset( $thongtin_nonce ) ) {return;}
 if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {return;}	
 if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
 if(isset($_POST['story_audio1'])){
 update_post_meta( $post_id, 'story_audio1', sanitize_text_field( $_POST['story_audio1']) );
 }

 
 if(isset($_POST['story_audio2'])){
 $type1 =  implode(',', $_POST['story_audio2']);
 $type2 =  implode(',', $_POST['story_audio21']);
 update_post_meta( $post_id, 'story_audio2', sanitize_text_field($type1));
 update_post_meta( $post_id, 'story_audio21', sanitize_text_field($type2));
 }
 
 if(isset($_POST['story_audio3'])){
 update_post_meta( $post_id, 'story_audio3', sanitize_textarea_field( $_POST['story_audio3'] ));
 }
 
}
add_action( 'save_post', 'rum_thongtin_save_story_audio' );
}
// tao chon chuong
function get_dropdown_part( $id ) { 
	global $post, $wpdb; 
	$query = $wpdb->get_results(sprintf('select * from %s where post_type = \'%s\' and post_parent = %d and post_status = \'%s\'  order by post_date asc', $wpdb->posts, 'story', $id, 'publish')); 
	$n = 0; 
	echo '<form id="selectpart"><select id="nut-cchuong" name="part" onchange="window.location.href = (this.options[this.selectedIndex].value)">';
	if ($query) { foreach ( $query as $k ) { $uri = get_permalink($k->ID);
	$n++;
	if ( ! preg_match('/.*page-[0-9].*/', $uri) && $k->ID != $post->ID){
	     echo '<option value="'.$uri.'">'. __('Chương', 'fox') .' '.$n.'</option>';
	   } else {
	     echo '<option value="'.$uri.'" selected="selected">'. __('Chương', 'fox') .' '.$n.'</option>';
	   } 
	    
	}
}
echo '</select></form>';
}

// nut them chuong moi + ds chuong trong soan thao chuong
function rewrite_cpt_header(){
     global $post;
     $post_td = !empty($_GET['post_parent']) ? trim(strip_tags(stripslashes($_GET['post_parent']))): '';
     $screen = get_current_screen();
     if( $screen->id !='story' ){
         return;
     } else {
         if (!empty($post_td)){
         ?>
         <div class="wrap">
         <h1 class="wp-heading-inline show" style="display:inline-block;"><?php _e('Chương', 'fox'); ?></h1>
         <a href="<?php echo admin_url('/edit.php?post_type=story&post_parent='); echo $post_td; ?>" class="page-title-action show"><?php _e('DS chương', 'fox'); ?></a>
         <a href="<?php echo admin_url('post-new.php?post_type=story&post_parent='); echo $post_td; ?>" class="page-title-action show"><?php _e('Chương mới', 'fox'); ?></a>
         </div>
         <style scoped>
         .wp-heading-inline:not(.show),
         .page-title-action:not(.show) { display:none !important;}
         </style>
         <?php } else { ?>
         <div class="wrap">
         <h1 class="wp-heading-inline show" style="display:inline-block;"><?php _e('Chương', 'fox'); ?></h1>
         <a href="<?php echo admin_url('/edit.php?post_type=story&post_parent='); echo $post->post_parent; ?>" class="page-title-action show"><?php _e('DS chương', 'fox'); ?></a>
         <a href="<?php echo admin_url('post-new.php?post_type=story&post_parent='); echo $post->post_parent; ?>" class="page-title-action show"><?php _e('Chương mới', 'fox'); ?></a>
         </div>
         <style scoped>
         .wp-heading-inline:not(.show),
         .page-title-action:not(.show) { display:none !important;}
         </style>
        <?php
        }
     }
 }
 add_action('admin_notices','rewrite_cpt_header');

// thêm bộ lọc danh sach chương khi vào ds chương
function fox_post_parent_public() {
    if ( is_admin() )
        $GLOBALS['wp']->add_query_var( 'post_parent' );
}
add_action( 'init', 'fox_post_parent_public' );

// Tạo cột quản lý ds chương cho bài viết 
function fox_story_column_register( $columns ) {
    $columns['showstory'] = __('Quản lý chương', 'fox');
    return $columns;
}
add_filter( 'manage_edit-post_columns', 'fox_story_column_register' );
// Tạo cột quản lý ds chương cho bài viết 
function fox_story_column_display( $column_name, $post_id ) {
    global $post;
    if ( 'showstory' != $column_name )
    return;
    echo '<a class="story-add" href="'.get_bloginfo('url').'/wp-admin/post-new.php?post_type=story&post_parent='.$post->ID.'"><i class="fa-regular fa-plus"></i></a>';
	$args = array(
		'post_type'      => 'story',
		'post_status'    => 'publish',
		'post_parent'    => $post_id,
	);
	$count = new wp_query($args);
	if ($count->found_posts > 0) {
	echo '<a class="story-list" href="'.get_bloginfo('url').'/wp-admin/edit.php?post_type=story&post_parent='.$post->ID.'"><i class="fa-regular fa-list"></i></a>';
	echo '<p class="story-note"><i class="fa-regular fa-circle-plus"></i> '. __('Số chương:', 'fox') .' '.$count->found_posts.'</p>';
	}
}
add_action( 'manage_posts_custom_column', 'fox_story_column_display', 10, 2 );

// chuyen url parren-post
add_filter('post_type_link', 'fox_rewrite_chapter_link', 1, 3);
add_action('init', 'fox_add_new_rules');
function fox_rewrite_chapter_link($link, $post = 0){
    if($post->post_type == 'story') {
        $parents = get_post_ancestors($post->ID);
        $parent_id = ($parents) ? $parents[count($parents) - 1] : 0;
        $parent = get_post($parent_id);
	    if(!empty($parent->post_name)){
        $newlink = $parent->post_name . '/' . $post->post_name .'-s';
		}
		else{ $newlink = '';}
        return home_url($newlink);
    } else {
        return $link;
    }
}
function fox_add_new_rules() {
	add_rewrite_rule('^tac-gia/([^/]+)$','index.php?tac-gia=$matches[1]', 'top');
	add_rewrite_rule('([^/]+)/([^/]+)-s$','index.php?post_type=story&name=$matches[2]', 'top');
	flush_rewrite_rules();
}
 

// nut chuyen chuong
function fox_get_next_chap($id){
	global $wpdb;
	$current_post_id = get_the_ID();
	$query = $wpdb->get_results("select * from  ".$wpdb->posts." where ID > '$current_post_id' AND post_type = 'story' and post_parent = '$id' and post_status = 'publish' ORDER BY ID ASC LIMIT 1");
	if($query){
		foreach($query as $chap) {
			echo '<a id="nut-cquay2" id="next_chap" href="'.get_the_permalink($chap->ID).'">'. __('tiếp', 'fox') .' &#10095;</a>';
		}
	}
	else
		echo '<a id="nut-cquaynot" href="javascript:void(0)" title="'. __('Không tìm thấy chương', 'fox') .'">&#10095;</a>';
}
function fox_get_prev_chap($id){
	global $wpdb;
	$current_post_id = get_the_ID();
	$query = $wpdb->get_results("select * from  ".$wpdb->posts." where ID < '$current_post_id' AND post_type = 'story' and post_parent = '$id' and post_status = 'publish' ORDER BY ID DESC LIMIT 1");
	if($query){
		foreach($query as $chap) {
			echo '<a id="nut-cquay3" id="prev_chap" href="'.get_the_permalink($chap->ID).'">&#10094; '. __('sau', 'fox') .'</a>';
		}
	}
	else
		echo '<a id="nut-cquaynot" href="javascript:void(0)" title="'. __('Không tìm thấy chương', 'fox') .'">&#10094;</a>';
}
// tinh so chuong hien tai cua bai dang
function fox_count_chap($id){
	$args = array(
		'post_type'      => 'story',
		'post_status'    => 'publish',
		'post_parent'    => $id,
	);
	$count = new wp_query($args);
	if ($count->found_posts > 0) {
	echo '<span><i class="fa-regular fa-circle-plus trangthai"></i> '. __('Số chương:', 'fox') .' '.$count->found_posts.' '. __('Chương', 'fox') .'</span>';
	}
}
// xoa bai viet xoa luon chuong truyen
function wpse53967_clear_all_childs($post_id){
	global $post;
   $args = array(
        'post_parent' => $post_id,
        'post_type' => 'story', 
    );
	$posts = get_posts( $args );
    if(empty($posts))
        return;

    foreach($posts as $post){
        wp_delete_post($post->ID, true); 
    }
}
add_action('delete_post', 'wpse53967_clear_all_childs');