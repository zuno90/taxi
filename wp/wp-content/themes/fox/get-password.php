<?php
/*
 Template Name: Get password
 */
get_header(); ?> 
<main>
<div class="box-card"> 
<div class="box-noidung">

<div class="box-card-small">
<div class="form-1"><div class="tieude1"><?php _e('Quên mật khẩu', 'fox'); ?></div>
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
<?php if (!is_user_logged_in()) { ?>
<div class="dangnhap-note"><?php _e('Bạn sẽ nhận được một Email chứa liên kết thay đổi mật khẩu mới vào địa chỉ Email mà bạn đã đăng ký tài khoản','fox'); ?></div>
		<div class="dangnhap-thongbao" style="margin-top:10px;">
		<?php
		if ( isset( $_REQUEST['errors'] ) ) {
			switch($_REQUEST['errors']){
				case 'empty_username':
				case 'invalid_email':
				case 'invalidcombo':
					echo '<p class="dang-nhaptb">'. __( 'Tài khoản hoặc địa chỉ email bạn nhập không hợp lệ', 'fox' ). '</p>';
			}
		}
		?>
		</div>
		<div>
			<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
				<div class="input-wrapper dangky-site-input">
					<input type="text" name="user_login" id="email2" placeholder="<?php _e('Tên tài khoản hoặc địa chỉ Email', 'fox'); ?>">
					<label for="stuff" class="fa-regular fa-at input-land-icon"></label>
				</div>
				<div>
				<button type="submit" id="wp-submit"><?php _e('Xác nhận lấy lại', 'fox'); ?></button>
				</div>
			</form>
			<div class="quen-mk"><span><?php _e('Bạn đã có tài khoản?', 'fox'); ?> <a href="<?php echo get_bloginfo('url') ?>/login"><?php _e('đăng nhập', 'fox'); ?></a></span></div>
		</div>
		<?php
} else { 
_e('Bạn đã đăng nhập tài khoản', 'fox'); ?>
<script>window.location.replace("<?php bloginfo('url'); ?>/profile");</script> 
<?php } ?>
</div>

</div>
</div>
</div>
</main>
<?php get_footer();