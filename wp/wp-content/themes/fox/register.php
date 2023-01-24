<?php
/*
 Template Name: Register
 */
get_header(); ?> 
<main>
<div class="box-card">
<div class="box-noidung">

<div class="box-card-small" >
<div class="form-1"><div class="tieude1"><?php _e('Đăng ký', 'fox'); ?></div>
<ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
  </ul>
</div>
<div class="form-2">
<img src="<?php echo get_template_directory_uri() . '/images/login.png'; ?>" />
<?php if(!is_user_logged_in()) { ?>
		<?php global $login_options;
        if (isset($login_options['enable2'])){ ?>
        <div class="icon-login-mxh" style="text-align: center;"><?php echo do_shortcode('[TheChamp-Login redirect_url="'.get_bloginfo('url').'/profile"]') ?></div>
        <?php } ?>
		<div class="dangnhap-thongbao" style="margin-top:10px;">
        <?php
		$err = ''; $success = ''; global $PasswordHash, $current_user, $user_ID; if(isset($_POST['task']) && $_POST['task'] == 'register' ) { $pwd1 = esc_sql(trim($_POST['pwd1']));
        $pwd2 = esc_sql(trim($_POST['pwd2']));
        $email2 = esc_sql(trim($_POST['email2']));
        $username = esc_sql(trim($_POST['username']));
		$first_name = esc_sql(trim($_POST['first_name']));
		$last_name = esc_sql(trim($_POST['last_name']));
        $ktpwd1 = strlen("12345");
        $ktpwd2 = strlen($pwd1);
                // Xác Thực reCAPTCHA
                if (isset($login_options['enable1'])){
                if(isset($_POST['g-recaptcha-response'])){$fox_tut_captcha = $_POST['g-recaptcha-response'];} 
                }
                // Kết thúc reCAPTCHA
        if( $email2 == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
            $err = '<p class="dang-nhaptb">'. __('Vui lòng không bỏ trống những thông tin bắt buộc!', 'fox') .'</p>';
		// xac thuc reCAPTCHA	
		} else if(isset($login_options['enable1']) && !$fox_tut_captcha){
            $err = '<p class="dang-nhaptb">'. __('Bạn chưa xác thực reCAPTCHA!', 'fox') .'</p>';
		} else if(!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
            $err = '<p class="dang-nhaptb">'. __('Địa chỉ email không hợp lệ!', 'fox') .'</p>';
        } else if(email_exists($email2) ) {
            $err = '<p class="dang-nhaptb">'. __('Địa chỉ email đã tồn tại!', 'fox') .'</p>';
        } else if($pwd1 <> $pwd2 ){
            $err = '<p class="dang-nhaptb">'. __('Hai mật khẩu không giống nhau!', 'fox') .'<p>';
        } else if($pwd1 == $username || $pwd1 == "123456" || $pwd1 == "abcdef" || $pwd1 == "iloveyou" || $pwd1 == "abc123" || $pwd1 == "aaaaaa" || $pwd1 == "111111" || $pwd1 == "222222" || $pwd1 == "333333" || $pwd1 == "444444" || $pwd1 == "555555" || $pwd1 == "666666" || $pwd1 == "777777" || $pwd1 == "888888" || $pwd1 == "999999" || $pwd1 == "000000"){
            $err = '<p class="dang-nhaptb">'. __('Mật khẩu quá đơn giản!', 'fox') .'</p>';
        } else if($ktpwd1 > $ktpwd2 ){
            $err = '<p class="dang-nhaptb">'. __('Mật khẩu quá ngắn!', 'fox') .'<p>';
        } else {
            $user_id = wp_insert_user( array ('user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email2), 'first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'role' => 'author' ) );
            if( is_wp_error($user_id) ) {
                $err = '<p class="dang-nhaptb">'. __('Lỗi khởi tạo tài khoản!', 'fox') .'<p>';
            }else {
                do_action('user_register', $user_id);
                $success = '<p class="dang-nhaptc">'. __('Bạn đã đăng ký thành công', 'fox') .'</p>';
            }
        }
    }
            if(! empty($err) ) :
                echo $err;
            endif;
        ?>
        <?php
            if(! empty($success) ) :
                $login_page  = home_url( '/login' );
                echo $success;
            endif;
        ?>
	</div>

    <form  method="post" role="form">
	<div style="display:grid;grid-template-columns: 1fr 1fr; grid-column-gap:10px;">
    <div class="input-wrapper dangky-site-input">
		<input  class="text-input" name="last_name" type="text" id="last_name" placeholder="<?php _e('Họ của bạn', 'fox'); ?>" />
		<label for="stuff" class="fa-regular fa-user input-land-icon"></label>
	</div>
    <div class="input-wrapper dangky-site-input">
		<input  class="text-input" name="first_name" type="text" id="first_name" placeholder="<?php _e('Tên của bạn', 'fox'); ?>" />
		<label for="stuff" class="fa-regular fa-user input-land-icon"></label>
	</div>
    </div>
    <div class="input-wrapper dangky-site-input">
		<input readonly onfocus="this.removeAttribute('readonly');"  type="text" name="username" id="username" placeholder="<?php _e('Tên đăng nhập', 'fox'); ?>">
		<label for="stuff" class="fa-regular fa-user input-land-icon"></label>
	</div>
    <div class="input-wrapper dangky-site-input">
		<input  type="email"  name="email2" id="email2" placeholder="<?php _e('Địa chỉ email', 'fox'); ?>">
		<label for="stuff" class="fa-regular fa-at input-land-icon"></label>
	</div>
	<div class="dangky-box-check">
            <div class="dangky-check input-wrapper">
               <input onkeyup="checktrigger()" type="password" name="pwd1" id="pwd1" placeholder="<?php _e('Mật khẩu', 'fox'); ?>">
			   <label for="stuff" class="fa-regular fa-lock input-land-icon"></label>
               <span class="nutxempas"><?php _e('XEM', 'fox'); ?></span>
            </div>
            <div class="checkpass">
               <span class="weak"></span>
               <span class="medium"></span>
               <span class="strong"></span>
            </div>
            <div class="textcheck"></div>
	</div>
    <div class="input-wrapper dangky-site-input">
		<input  type="password" name="pwd2" id="pwd2" placeholder="<?php _e('Nhập lại mật khẩu', 'fox'); ?>">
		<label for="stuff" class="fa-regular fa-lock input-land-icon"></label>
	</div>
    <?php if (isset($login_options['enable1'])){ ?>
    <div style="text-align: center;margin-bottom:10px"><div style="display: inline-block;" class="g-recaptcha" data-sitekey="<?php echo $login_options['key1']; ?>"></div></div>
    <?php } ?>
    <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
    <div>
    <button type="submit" id="wp-submit"><?php _e('Đăng ký', 'fox'); ?></button>
    <input type="hidden" name="task" value="register" />
    </div>
    </form>
	<div class="quen-mk"><span><?php _e('Bạn đã có tài khoản?', 'fox'); ?> <a href="<?php echo get_bloginfo('url') ?>/login"><?php _e('đăng nhập', 'fox'); ?></a></span></div>
<?php } else {
_e('Bạn đã đăng nhập tài khoản', 'fox'); ?>
<script>window.location.replace("<?php bloginfo('url'); ?>/profile");</script>
<?php } ?>
</div>

</div>
</div>
</div>
</main>
<script>
var passcheckno = <?php echo json_encode( __('Mật khẩu quá yếu', 'fox')); ?>;
var passcheckok = <?php echo json_encode( __('Mật khẩu trung bình', 'fox')); ?>;
var passcheckgood = <?php echo json_encode( __('Mật khẩu rất mạnh', 'fox')); ?>;
var passshow = <?php echo json_encode( __('ẨN', 'fox')); ?>;
var passhidden = <?php echo json_encode( __('XEM', 'fox')); ?>;
</script>
<?php get_footer();