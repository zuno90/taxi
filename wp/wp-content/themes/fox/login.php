<?php
/*
 Template Name: Login
 */
get_header(); ?> 
<main>
<div class="box-card">
<div class="box-noidung">


<div class="box-card-small">
<div class="form-1">
<div class="tieude1"><?php _e('Đăng nhập', 'fox'); ?></div>
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
        			$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
        			if ( $login === "failed" ) {
        				echo '<p class="dang-nhaptb">'. __('Sai tên đăng nhập hoặc mật khẩu!', 'fox') .'</p>';
        			} elseif ( $login === "empty" ) {
        				echo '<p class="dang-nhaptb">'. __('Bạn đã đăng xuất tài khoản!', 'fox') .'</p>';
        			} elseif ( $login === "false" ) {
        				echo '<p class="dang-nhaptb">'. __('Bạn đã đăng xuất tài khoản!', 'fox') .'</p>';
        			}
        // tb lay lai mk					
		$attributes['password_updated'] = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';
		if ( $attributes['password_updated'] ) { echo '<p class="dang-nhaptc">'. __('Mật khẩu của bạn đã được thay đổi', 'fox'). '</p>';} 
		$attributes['lost_password_sent'] = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';
		if ( $attributes['lost_password_sent'] ) { echo '<p class="dang-nhaptb">'. __('Kiểm tra email của bạn để tìm liên kết đặt lại mật khẩu mới', 'fox'). '</p>';} 
		$attributes['lost_password_sent'] = isset( $_REQUEST['login'] ) && $_REQUEST['login'] == 'invalidkey';
		if ( $attributes['lost_password_sent'] ) { echo '<p class="dang-nhaptb">'. __('Liên kết này đã không còn hiệu lực', 'fox'). '</p>';} 
		?>
        </div>
		<?php
        			$args = array(
        				'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
        				'echo'           => false,
        				'form_id'        => 'dangnhap', //Để dành viết CSS
        				'label_username' => '',
        				'label_password' => '',
        				'label_log_in'   => __( 'Đăng nhập', 'fox'),
        				'label_remember' => __( 'Lưu tài khoản', 'fox'),
        				'remember' => false,
        			);
        			$form = wp_login_form( $args );
        			$form = str_replace('name="log"', 'id="nhapuser" name="log" placeholder="'. __('Tên tài khoản hoặc Email', 'fox') .'"', $form);
        			$form = str_replace('name="pwd"', 'id="nhappass" name="pwd" placeholder="'. __('Mật khẩu', 'fox') .'"', $form);
					$form = str_replace('for="user_login"', 'for="user_login" class="fa-regular fa-user input-land-icon"', $form);
					$form = str_replace('for="user_pass"', 'for="user_login" class="fa-regular fa-lock input-land-icon"', $form);
        			echo $form;
        		?>
    <div class="quen-mk">
		<span><a href="<?php echo get_bloginfo('url') ?>/get-password"><?php _e('Quên mật khẩu', 'fox'); ?></a></span>
	    <span><?php _e('Bạn chưa có tài khoản?', 'fox'); ?> <a href="<?php echo get_bloginfo('url') ?>/register"><?php _e('đăng ký', 'fox'); ?></a></span>
	</div>
<?php } else {  
_e('Bạn đã đăng nhập với tài khoản', 'fox'); ?> 
<script>window.location.replace("<?php bloginfo('url'); ?>/profile");</script>
<?php } ?>
</div>

</div>
</div>
</div>
</main>
<?php get_footer();
