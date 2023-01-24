<?php
/*
 Template Name: New password
 */
get_header(); ?>
<main>
<div class="box-card"> 
<div class="box-noidung">

<div class="box-card-small">
<div class="form-1"><div class="tieude1"><?php _e('Mật khẩu mới', 'fox'); ?></div>
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
<?php
if (!is_user_logged_in()) { ?>
        <div class="dangnhap-thongbao" style="margin-top:10px;">
		<?php
		if (isset($_REQUEST['login']) && isset($_REQUEST['key'])) {
			$attributes['login'] = $_REQUEST['login'];
			$attributes['key'] = $_REQUEST['key'];

			// Error messages
			$errors = array();
			if (isset($_REQUEST['error'])) {
				switch($_REQUEST['error']){
				case 'password_reset_mismatch':
				case 'password_reset_empty':
				echo '<p class="dang-nhaptb">'. __( 'Mật khẩu trống hoặc không giống nhau', 'fox' ). '</p>';
				}
			}
			$attributes['errors'] = $errors; ?>
	    </div>
			<div>
				<form name="resetpassform" id="resetpassform" action="<?php echo site_url('wp-login.php?action=resetpass'); ?>" method="post" autocomplete="off">
					<input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr($attributes['login']); ?>" autocomplete="off"/>
					<input type="hidden" name="rp_key" value="<?php echo esc_attr($attributes['key']); ?>"/>
					<?php if (count($attributes['errors']) > 0) : ?>
						<?php foreach ($attributes['errors'] as $error) : ?>
							<p>
								<?php echo $error; ?>
							</p>
						<?php endforeach; ?>
					<?php endif; ?>
					<div class="dangky-box-check">
						<div class="input-wrapper dangky-check">
							<input type="password" onkeyup="checktrigger()" placeholder="<?php _e('Mật khẩu', 'fox'); ?>" name="pass1" id="pwd1" class="input" size="20" value="" autocomplete="off"/>
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
						<input type="password" placeholder="<?php _e('Nhập lại mật khẩu', 'fox'); ?>" name="pass2" id="pwd2" class="input" size="20" value="" autocomplete="off"/>
						<label for="stuff" class="fa-regular fa-lock input-land-icon"></label>
					</div>
					<div><button type="submit" id="wp-submit"><?php _e('Thay đổi mật khẩu', 'fox'); ?></button></div>
				</form>
				<div class="quen-mk"><span><?php _e('Bạn đã có tài khoản?', 'fox'); ?> <a href="<?php echo get_bloginfo('url') ?>/login"><?php _e('đăng nhập', 'fox'); ?></a></span></div>
			</div>
			<?php
		} else {
		_e('Liên kết đặt lại mật khẩu không hợp lệ', 'fox');
		}
} else { 
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