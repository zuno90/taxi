<?php
global $login_options;


// TAO TRANG DANG NHAP
function fox_login_redirect( $redirect_to, $request, $user ) {
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return admin_url();
		} else {
			return home_url('/profile/');
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'fox_login_redirect', 10, 3 );
// CHUYEN TRANG DANG NHAP MAC DINH SANG TRANG MOI
function fox_redirect_login_page() {
    $login_page  = home_url( '/login/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);  

    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','fox_redirect_login_page');
/* Kiểm tra lỗi đăng nhập */
function fox_login_failed() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'fox_login_failed' );  

function fox_verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'fox_verify_username_password', 1, 3);
// chỉ admin moi vao wp-admin
function fox_admin_login_redirect(){
$kiemtra = get_current_user_id();
if( is_admin() && !defined('DOING_AJAX') && (current_user_can('author') || current_user_can('vip') || current_user_can('subscriber') || current_user_can('contributor'))){
if ( isset( $_GET[ 'action'] ) && 'trash' == $_GET[ 'action'] ) return;
wp_redirect( home_url() );
exit;
}
}
add_action('init','fox_admin_login_redirect');
// tat an thanh bar
function fox_disable_admin_bar() {
   if (current_user_can('administrator')) {
     show_admin_bar(true); 
   } else {
     show_admin_bar(false);
   }
}
add_action('after_setup_theme', 'fox_disable_admin_bar');


// chuyen nguoi dung ve trang ho so thong tin
function fox_redirect_profile_access(){
        if (current_user_can('manage_options')) return '';
        if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/profile.php' )) {
            wp_redirect ( home_url( '/profile' )); 
            exit();
        }
}
add_action ('init' , 'fox_redirect_profile_access');
// xoa logo wp trong admin
function fox_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'fox_admin_bar_remove_logo', 0 );

// thay doi form lay lai mk
function fox_thaydoi_logo() {  ?>
<style type="text/css">
h1, form#language-switcher, .privacy-policy-page-link, p#backtoblog{display:none;}
input#wp-submit {
    width: 100%;
    padding: 10px;
    background: #0056c1;
    border-radius: 7px;
}
form#lostpasswordform {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 1px 3px #ccc;
    border: none;
}
p.message, .login #login_error {
    border-radius: 10px;
}
div#login {
    max-width: 500px;
    width: 100%;
    padding: 7% 10px;
    box-sizing: border-box;
    font-size:19px;
}
p#nav, p#backtoblog {
    text-align: center;
}
</style>
    
<?php    
}
add_action('login_enqueue_scripts', 'fox_thaydoi_logo');
// Add tự động trang dang nhap va thong tin cho user
$link_login1 = __('Đăng nhâp','fox');
$link_login2 = __('Thông tin','fox');
$link_login3 = __('Quên mật khẩu','fox');
$link_login4 = __('Lấy lại mật khẩu','fox');
$link_login5 = __('Đăng ký','fox');
if (get_page_by_title($link_login1) == NULL){
$my_post_login1 = array(
	  'import_id'			  => 2000,
      'post_title'    => $link_login1,
      'post_status'   => 'publish',
	  'page_template' => 'login.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'login'
    );
wp_insert_post( $my_post_login1 );
}
if (get_page_by_title($link_login2) == NULL){
$my_post_login2 = array(
	  'import_id'			  => 2001,
      'post_title'    => $link_login2,
      'post_status'   => 'publish',
	  'page_template' => 'profile.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'profile'
    );
 wp_insert_post( $my_post_login2 );
}
if (get_page_by_title($link_login3) == NULL){
$my_post_login3 = array(
	  'import_id'			  => 2002,
      'post_title'    => $link_login3,
      'post_status'   => 'publish',
	  'page_template' => 'get-password.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'get-password'
    );
 wp_insert_post( $my_post_login3 );
}
if (get_page_by_title($link_login4) == NULL){
$my_post_login4 = array(
	  'import_id'			  => 2003,
      'post_title'    => $link_login4,
      'post_status'   => 'publish',
	  'page_template' => 'new-password.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'new-password'
    );
 wp_insert_post( $my_post_login4 );
}
if (get_page_by_title($link_login5) == NULL){
$my_post_login5 = array(
	  'import_id'			  => 2004,
      'post_title'    => $link_login5,
      'post_status'   => 'publish',
	  'page_template' => 'register.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'register'
    );
 wp_insert_post( $my_post_login5 );
}
// tao thong tin nhap du lieu ve vip
if ( current_user_can( 'manage_options' ) ) {  //check admin
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
?>
    <div style="padding:20px;border:1px solid #ccc;background:#fff;box-shadow:0px 0px 6px #ccc;margin-top:30px;">
    <div style="font-size:20px;font-weight:bold;margin-bottom:20px;margin-top:10px;color:#2271b1"><i class="fa-regular fa-user-group"></i> Dữ liệu thành viên VIP</div>
    <div>
        <div style="font-weight:bold"><i class="fa-regular fa-list"></i> Nhập dữ liệu Post ID</div>
            <p><textarea type="text" name="post" placeholder="Post ID" style="width:100%;height:150px"><?php echo esc_attr( get_the_author_meta( 'post', $user->ID ) ); ?></textarea></p>
        <div style="font-weight:bold"><i class="fa-regular fa-clock-eight"></i> Nhập ngày hết VIP</div>
            <p><input type="text" name="vipend" placeholder="02/09/2024" style="width:200px;" value="<?php echo esc_attr( get_the_author_meta( 'vipend', $user->ID ) ); ?>" /></p>
    </div>
    </div>
<?php }
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    $thongtin_nonce = $_POST['thongtin_nonce'];
    if( !isset( $thongtin_nonce ) ) {
    return;
    }
    if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
    return;
    }
    
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'post', $_POST['post'] );
    update_user_meta( $user_id, 'vipend', $_POST['vipend'] );
}
}

// bài viết trong admin hiển thị cho từng nhóm, bài ai người đó thấy
function fox_posts_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'level_10' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}
add_filter('parse_query', 'fox_posts_useronly' );

// hinh anh media chi admin moi thay het
function fox_user_attachments( $query ) {
    $user_id = get_current_user_id();
    if ( $user_id && !current_user_can('manage_options') ) {
        $query['author'] = $user_id;
    }
    return $query;
}
add_filter( 'ajax_query_attachments_args', 'fox_user_attachments' );
// them quyen cho author
function fox_add_author_delete_cap() {
    $role = get_role( 'author' );
    $role->add_cap( 'delete_posts' );
	$role->add_cap( 'delete_private_posts' );
	$role->add_cap( 'delete_published_posts' );
	$role->add_cap( 'edit_others_posts' );
    $role->add_cap( 'edit_posts' );
	$role->add_cap( 'edit_private_posts' );
	$role->add_cap( 'edit_published_posts' );
	$role->add_cap( 'publish_posts' );
	
    $role->add_cap( 'delete_pages' );
    $role->add_cap( 'delete_private_pages' );
	$role->add_cap( 'delete_published_pages' );
	$role->add_cap( 'edit_others_pages' );
	$role->add_cap( 'edit_pages' );
	$role->add_cap( 'edit_private_pages' );
	$role->add_cap( 'edit_published_pages' );
	$role->add_cap( 'publish_pages' );
	$role->add_cap( 'moderate_comments' );
}
add_action( 'admin_init', 'fox_add_author_delete_cap');

// Thêm mạng xã hội vào trình điều khiển
function fox_add_fields_user($profile_fields){
$profile_fields['twitter'] = 'Twitter';
$profile_fields['facebook'] = 'Facebook';
$profile_fields['telegram'] = 'Telegram';
$profile_fields['tiktok'] = 'Tiktok';
$profile_fields['phone'] = 'Phone';
$profile_fields['zalo'] = 'Zalo';
$profile_fields['slogan'] = 'Slogan';
return $profile_fields;
}
add_filter('user_contactmethods', 'fox_add_fields_user');


if(isset($login_options['enable3'])){
// tạo nhóm VIP --------------------------------------------- VIP
function fox_add_roles()
{
 global $wp_roles;
 if (!isset($wp_roles))
 $wp_roles = new WP_Roles();
 $adm = $wp_roles -> get_role('author');
 $wp_roles->add_role('vip', 'Vip', $adm -> capabilities);
}
add_action('init', 'fox_add_roles');

// them metbox khoa chuong bai viet --------------------------------------------------------------------metbox trong story.
function fox_meta_khoavip()
{
 add_meta_box( 'khoavip', __('Khoá nội dung theo thuộc tính', 'fox'), 'fox_thongtin_khoavip', array('post', 'story'));
}
add_action( 'add_meta_boxes', 'fox_meta_khoavip' );
function fox_thongtin_khoavip( $post )
{
  $lockpost1 = get_post_meta( $post->ID, 'lockpost1', true );
  $lockpost11 = get_post_meta( $post->ID, 'lockpost11', true );
  wp_nonce_field( 'save_thongtin', 'thongtin_nonce' ); ?>
  <div class="post-main">
    <select style="width:150px" class="post-sel" name="lockpost1">
        <option value="">No login</option>
        <option value="Login" <?php selected($lockpost1, 'Login'); ?>>Login</option>
        <option value="Vip" <?php selected($lockpost1, 'Vip'); ?>>Vip</option>
		<option value="Pass" <?php selected($lockpost1, 'Pass'); ?>>Pass</option>
    </select>
	<p><input style="width:150px" placeholder="<?php _e('Mật khẩu', 'fox'); ?>" id="post-input" type="text" name="lockpost11" value="<?php echo esc_attr( $lockpost11 ); ?>"></p>
    <p class="post-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Dùng để khoá nội dung bài viết hoặc chương truyện.', 'fox'); ?>
	<br><i><?php _e('Chú ý: Nếu bạn chọn kiểu khóa là Pass thì cần nhập mật khẩu vào ô bên dưới để có thể hoạt động', 'fox'); ?></i>
	</p>
	</div>
  <?php
}
function fox_thongtin_save_khoavip( $post_id )
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
if(isset($_POST['lockpost1'])){ 
 update_post_meta( $post_id, 'lockpost1', sanitize_text_field($_POST['lockpost1']));
}
if(isset($_POST['lockpost11'])){ 
 update_post_meta( $post_id, 'lockpost11', sanitize_text_field($_POST['lockpost11']));
}
}
add_action( 'save_post', 'fox_thongtin_save_khoavip' );
}

//gui email chao mung cho thanh vien moi---------------------------------------
if(isset($login_options['eenable'])){
function fox_send_welcome_email_to_new_user($user_id) {
	global $login_options;
    $user = get_userdata($user_id);
    $user_email = $user->user_email;
    $user_full_name = $user->user_login;
	if(!empty($login_options['etitle'])){$user_new_title = $login_options['etitle'];} else {$user_new_title = __('Chào mừng thành viên mới', 'fox');}
	if(!empty($login_options['enoidung'])){$user_new_note = $login_options['enoidung'];} else {$user_new_note = __('Bạn đã đăng ký tài khoản thành công', 'fox');}
    $to = $user_email;
    $subject = $login_options['etitle'];
    $body = '<div style="font-size:18px;background:#f1f1f1;color:#333;padding:25px;max-width:600px;margin:auto;">
<div style="background:#f1f1f1;color:#777;border-bottom: 2px solid #0768ea;padding-bottom:7px;color:#0768ea;font-size:20px;margin-bottom:10px;"><b>'. $user_full_name .'</b></div>
    '. $user_new_note .'</div>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if (wp_mail($to, $subject, $body, $headers)) {
      error_log(__('Email đã được gửi thành công đến người dùng có email là:', 'fox') .' '. $user_email);
    }else{
      error_log(__('Không gửi được email đến người dùng có email là:', 'fox') .' '. $user_email);
    }
  }
  add_action('user_register', 'fox_send_welcome_email_to_new_user');
}
// upload avatar ---------------------------------------------------------------------------------------------------------------
function fox_custom_scripts(){
    wp_enqueue_media();
    wp_enqueue_script('upload-avatar', get_stylesheet_directory_uri().'/inc/js/upload-avatar.js', array('jquery'), false, true );
}
add_action('admin_enqueue_scripts', 'fox_custom_scripts');
function fox_profile_fields( $user ) {
    $profile_pic = ($user!=='add-new-user') ? get_user_meta($user->ID, 'caodemspic', true): false;
    if( !empty($profile_pic) ){
        $image = wp_get_attachment_image_src( $profile_pic, 'medium' );
    } ?>
<div style="text-align: center;">
		<div style="margin-top:20px;"><img id="caodems-img" src="<?php echo !empty($profile_pic) ? $image[0] : ''; ?>" style="<?php echo  empty($profile_pic) ? 'display:none;' :'' ?>width:100px;height:100px;object-fit: cover;object-position: 50% 50%;border-radius:100%;" /></div>
        <div>
		<a id="reset-hinh-anh" style="color:#999;font-size:14px;text-decoration: none;cursor: pointer;padding:5px;display:none;"><i style="font-size:12px;margin-right:4px;" class="far fa-trash-alt"></i> <?php _e('xóa avatar', 'fox'); ?></a>
		<input type="button" data-id="caodems_image_id" data-src="caodems-img" class="button caodems-image" name="caodems_image" id="caodems-image" value="<?php _e('Ảnh đại diện', 'fox') ?>" />
        <input type="hidden" class="button" name="caodems_image_id" id="caodems_image_id" value="<?php echo !empty($profile_pic) ? $profile_pic : ''; ?>" />
		</div>
</div>
    <?php
}
add_action( 'show_user_profile', 'fox_profile_fields' );
add_action( 'edit_user_profile', 'fox_profile_fields' );
add_action( 'user_new_form', 'fox_profile_fields' );
function fox_profile_update($user_id){
        $profile_pic = empty($_POST['caodems_image_id']) ? '' : $_POST['caodems_image_id'];
        update_user_meta($user_id, 'caodemspic', $profile_pic);
}
add_action( 'personal_options_update', 'fox_profile_update' );
add_action( 'edit_user_profile_update', 'fox_profile_update' );

// add img avatar
add_filter( 'get_avatar' , 'fox_custom_avatar' , 1 , 5 );
function fox_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );
    }
    if($user){
        $custom_avatar  =   get_user_meta( $user->data->ID, 'caodemspic', true );
 
        if( !empty($custom_avatar) ){
            $image  =   wp_get_attachment_image_src($custom_avatar, array('30' , '30'));
            if( $image ){
                $avatar = "<img src='{$image[0]}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' loading='lazy' />";
            }
        }
    }
    return $avatar;
}

// add url avatar
add_filter( 'get_avatar_url' , 'fox_custom_avatar_url' , 10 , 3 );
function fox_custom_avatar_url( $url, $id_or_email, $args) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );
    }
    if($user){
        $custom_avatar  =   get_user_meta( $user->data->ID, 'caodemspic', true );
 
        if( !empty($custom_avatar) ){
            $image  =   wp_get_attachment_image_src($custom_avatar, array('30' , '30'));
            if( $image ){
                $url = "{$image[0]}";
            }
        }
    }
    return $url;
}
// thay link lay mat khau ---------------------------------------------------------------------------------------------------
add_action('login_form_lostpassword', 'redirect_to_custom_lostpassword');
function redirect_to_custom_lostpassword() {
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		if (is_user_logged_in()) {
			$this->redirect_logged_in_user();
			exit;
		}
		wp_redirect(home_url('get-password'));
		exit;
	}
}
// lay lai mk
add_action('login_form_lostpassword', 'do_password_lost');
function do_password_lost() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$errors = retrieve_password();
		if (is_wp_error($errors)) {
			$redirect_url = home_url('get-password');
			$redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
		} else {
			$redirect_url = home_url('login');
			$redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
		}

		wp_redirect($redirect_url);
		exit;
	}
}
// After send Email
add_action('login_form_rp', 'redirect_to_custom_password_reset');
add_action('login_form_resetpass', 'redirect_to_custom_password_reset');
function redirect_to_custom_password_reset() {
	if ('GET' == $_SERVER['REQUEST_METHOD']) {
		$user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('login?login=expiredkey'));
			} else {
				wp_redirect(home_url('login?login=invalidkey'));
			}
			exit;
		}

		$redirect_url = home_url('new-password');
		$redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
		$redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

		wp_redirect($redirect_url);
		exit;
	}
}
add_action('login_form_rp', 'do_password_reset');
add_action('login_form_resetpass', 'do_password_reset');
function do_password_reset() {
	if ('POST' == $_SERVER['REQUEST_METHOD']) {
		$rp_key = $_REQUEST['rp_key'];
		$rp_login = $_REQUEST['rp_login'];

		$user = check_password_reset_key($rp_key, $rp_login);
		// lien key het han
		if (!$user || is_wp_error($user)) {
			if ($user && $user->get_error_code() === 'expired_key') {
				wp_redirect(home_url('login?login=expiredkey'));
			} else {
				wp_redirect(home_url('login?login=invalidkey'));
			}
			exit;
		}

		if (isset($_POST['pass1'])) {
			if ($_POST['pass1'] != $_POST['pass2']) {
				// mat khau khac nhau
				$redirect_url = home_url('new-password');
				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}
			// mat khau trong
			if (empty($_POST['pass1'])) {
				$redirect_url = home_url('new-password');
				$redirect_url = add_query_arg('key', $rp_key, $redirect_url);
				$redirect_url = add_query_arg('login', $rp_login, $redirect_url);
				$redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url);

				wp_redirect($redirect_url);
				exit;
			}

			// thay doi thanh cong
			reset_password($user, $_POST['pass1']);
			wp_redirect(home_url('login?password=changed'));
		} else {
			echo "Invalid request.";
		}

		exit;
	}
}
// thay doi duong dan author thanh user
global $wp_rewrite;
$wp_rewrite->author_base = "user";
$wp_rewrite->flush_rules();
// shortcode dang nhap moi xem duoc
function fox_locklogin_content($atts, $content = null) {
global $login_options;
if (!empty($login_options['notelogin'])){ $login_lock =  $login_options['notelogin']; } else { $login_lock = __('Bạn cần đăng nhập tài khoản mới có thể xem được', 'fox'); }
if (is_user_logged_in() || !isset($login_options['enable3'])) { 
return do_shortcode($content);
} else {
 	$atts = '<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$login_lock.'</div></div>';
	return $atts;
}
}
add_shortcode('1lock', 'fox_locklogin_content');
// shortcode user vip moi xem duoc
function fox_lockvip_content($atts, $content = null) {
global $login_options, $post;
// tim kiem thoi gian vip
   $current_user = wp_get_current_user(); 
   $ngaysosanh = get_the_author_meta( 'vipend', $current_user->ID ); 
   $ngaysosanh = str_replace('/', '-', $ngaysosanh);
   $ngayhomnay = date("d-m-Y"); 
// tim id post trong data user
   $all_postid = nl2br(get_the_author_meta('post', $current_user->ID));
   $post_check = $post->ID;
if (!empty($login_options['notevip'])){ $vip_lock =  $login_options['notevip']; } else { $vip_lock = __('Bạn cần đăng ký tài khoản VIP để xem', 'fox'); }
if((current_user_can('author') && strtotime($ngayhomnay) <= strtotime($ngaysosanh) && !empty(strtotime($ngaysosanh))) || current_user_can('vip') || current_user_can('administrator') || current_user_can('editor') || get_current_user_id() == get_the_author_meta('ID') || (preg_match("~\b$post_check\b~",$all_postid) && !empty($all_postid)) || !isset($login_options['enable3'])){
return do_shortcode($content); 
} else {
 	$atts = '<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$vip_lock.'</div></div>';
	return $atts;
}
}
add_shortcode('2lock', 'fox_lockvip_content');
// shortcode login bang mat khau
function fox_pass_shortcode($atts, $content = null) {
	global $login_options;
	extract(shortcode_atts(array('pass' => ''), $atts));
	$lock_error 	= __('Mật khẩu bạn nhập không đúng','fox');
	$lock_form = $pass;
    $doi = strlen($pass);	
	$doila = bin2hex(md5($lock_form));
	$doila2 = substr($doila, -4);
	if (!empty($login_options['notepass'])){ $pass_lock =  $login_options['notepass']; } else { $pass_lock = __('Bạn cần nhập mật khẩu để mở khóa', 'fox'); }
	ob_start(); ?>
	<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i><?php _e('Nội dung đã bị khóa', 'fox'); ?></span></div>
	<div class="khoa-note"><?php echo $pass_lock; ?></div>
	<div class="khoa-noidung">
	<form action="#3lock<?php echo $doila2 . $doi ?>" method="post" id="3lock<?php echo $doila2 . $doi ?>">
	<div class="khoa-chuong-input">
    <input id="khoa-lock1" type="password" name="lock_input" placeholder="<?php _e('MẬT KHẨU','fox'); ?>">
    <input id="khoa-lock2" type="submit" name="lock_submit<?php echo $doila2 . $doi ?>" value="<?php _e('XEM','fox'); ?>">
	</div>
	<?php $form = ob_get_clean();
	if (isset($_POST['lock_submit'. $doila2 . $doi .''])) {
		if ($_POST['lock_input'] == $pass AND $pass != '') {
			return '<div id="3lock'. $doila2 . $doi .'">'. do_shortcode($content) .'</div>';
		}
		else
		{
			return $form.'<div class="khoa-chuong-eror">'.$lock_error.'</div></form></div></div>';
		}
	}
	else
	{
		return $form .'</form></div></div>';
	}
}
add_shortcode('3lock', 'fox_pass_shortcode');