<?php
function fox_login_options_page() {
	global $login_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX LOGIN', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('CÀI ĐẶT', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-gear"></i> <?php _e('CÀI ĐẶT', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('EMAIL', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-paper-plane-top"></i> <?php _e('EMAIL', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('SMTP', 'fox'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-envelope"></i> <?php _e('SMTP', 'fox'); ?></button>
		</div>
		
		<form method="post" action="options.php">
			<?php settings_fields('login_settings_group'); ?>
			
		<div class="rank-box rank" id="rankone">
		   <div class="admin-card">
		        <div class="admin-cm"><?php _e('Chức năng tạo trang đăng nhập & đăng ký cho Website', 'fox'); ?></div>
		        <div class="admin-div-note">
		         <?php _e('Sau khi bạn bật Fox Login, trang web của bạn sẽ có thêm phần đăng nhập, đăng ký, quản lý thông tin thành viên.', 'fox'); ?>
		        </div>
				<p class="admin-on">
		        <input type="checkbox" name="login_settings[enable]" value="1" <?php if (isset($login_options['enable']) && 1 == $login_options['enable']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật Login', 'fox'); ?></label>
                </p>
			</div>

			<div class="admin-card">
                <div class="admin-cm"><?php _e('Thêm Google Captcha vào đăng ký', 'fox'); ?></div>
                <input type="checkbox" name="login_settings[enable1]" value="1" <?php if (isset($login_options['enable1']) && 1 == $login_options['enable1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật Google Captcha', 'fox'); ?></label>
				<p><input placeholder="Site key" name="login_settings[key1]" type="text" value="<?php if(!empty($login_options['key1'])){echo $login_options['key1'];} ?>"/></p>
				<p><input placeholder="Secret key" name="login_settings[key2]" type="text" value="<?php if(!empty($login_options['key2'])){echo $login_options['key2'];} ?>"/></p>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Google Captcha v2.0 sẽ được thêm vào form đăng ký.', 'fox'); ?></p>
			</div>
			    
			<div class="admin-card">
				<div class="admin-cm"><?php _e('Thêm đăng nhập & đăng ký bằng mạng xã hội', 'fox'); ?></div>
                <input type="checkbox" name="login_settings[enable2]" value="1" <?php if (isset($login_options['enable2']) && 1 == $login_options['enable2']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật icon đăng nhập bằng mạng xã hội', 'fox'); ?></label>
                <br>
                <div class="admin-div-note">
                <?php _e('Truy cập vào <b>Plugin > Cài mới</b> tìm kiếm plugin <b>Super Socializer</b> và cài đặt.
                <p>1. Vào plugin <b>Super Socializer > Social login ></b> tích chọn <b>Enable Social Login</b></p>
                <p>2. Tích chọn mạng xã hội muốn tạo đăng nhập.</p>
                <p>3. Điền API login của ứng dụng mạng xã hội vào rồi lưu lại.</p>', 'fox'); ?>
                </div>
			</div>
			    
			<div class="admin-card">
				<div class="admin-cm"><?php _e('Chức năng khóa bài viết hoặc chương truyện', 'fox'); ?></div>
                <input type="checkbox" name="login_settings[enable3]" value="1" <?php if (isset($login_options['enable3']) && 1 == $login_options['enable3']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật chức năng khoá bài viết', 'fox'); ?></label>
                <br>
                <div class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i>
                <?php _e('Khi bạn bật chức năng này, trình soạn thảo bài viết sẽ có thêm tuỳ chọn khoá ( và shortcode khóa mới có thể hoạt động).', 'fox'); ?>
			    </div>
			    <br>
				<textarea class="admin-textarea" name="login_settings[notevip]" cols="30" rows="10" placeholder="<?php _e('Nhập nội dung hiển thị cho VIP vào đây', 'fox'); ?>"><?php if(!empty($login_options['notevip'])){echo $login_options['notevip'];} ?></textarea>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Khi bạn sử dụng khoá VIP thì nội dung này sẽ hiển thị khi người dùng truy cập bài viết.', 'fox'); ?></p>
				<textarea class="admin-textarea" name="login_settings[notelogin]" cols="30" rows="10" placeholder="<?php _e('Nhập nội dung hiển thị cho đăng nhập vào đây', 'fox'); ?>"><?php if(!empty($login_options['notelogin'])){echo $login_options['notelogin'];} ?></textarea>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Khi bạn sử dụng khoá đăng nhập thì nội dung này sẽ hiển thị khi người dùng truy cập bài viết.', 'fox'); ?></p>
				<textarea class="admin-textarea" name="login_settings[notepass]" cols="30" rows="10" placeholder="<?php _e('Nhập nội dung hiển thị cho mật khẩu vào đây', 'fox'); ?>"><?php if(!empty($login_options['notepass'])){echo $login_options['notepass'];} ?></textarea>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Khi bạn sử dụng khoá mật khẩu thì nội dung này sẽ hiển thị khi người dùng truy cập bài viết.', 'fox'); ?></p>
		    </div>
		   
		</div>
		
		<div class="rank-box rank" id="ranktue" style="display:none">
		   <div class="admin-card">
                <div class="admin-cm"><?php _e('Cài đặt nội dung email gửi tới sau khi người dùng đăng ký', 'fox'); ?></div>
				<input type="checkbox" name="login_settings[eenable]" value="1" <?php if (isset($login_options['eenable']) && 1 == $login_options['eenable']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật gửi email cho người dùng sau khi đăng ký tài khoản', 'fox'); ?></label>
                <br>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn bật chức năng này lên, sau đó điền đầy đủ thông tin bên dưới, sau khi người dùng đăng ký tài khoản sẽ có email thông báo cho người dùng tương ứng với nội dung mà bạn đã thêm vào.', 'fox'); ?></p>
				<p><input  placeholder="<?php _e('Tiêu đề email', 'fox'); ?>" name="login_settings[etitle]" type="text" value="<?php if(!empty($login_options['etitle'])){echo $login_options['etitle'];} ?>"/></p>
				<p><textarea class="admin-textarea" name="login_settings[enoidung]" cols="30" rows="10" placeholder="<?php _e('Nội dung email...', 'fox'); ?>"><?php if(!empty($login_options['enoidung'])){echo $login_options['enoidung'];} ?></textarea></p>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Đây là nội dung của email mà người dùng sau khi đăng ký thành công sẽ nhận được, để hoạt động website của bạn cần cấu hình mail SMTP trước.', 'fox'); ?></p>
		  </div>
		</div>
		
		<div class="rank-box rank" id="rankthere" style="display:none">
		   <div class="admin-card">
                <div class="admin-cm"><?php _e('Cấu hình Gmail SMTP', 'fox'); ?></div>
				
				<div class="admin-div-note">
		         <?php _e('Kích hoạt chức năng này và nhập nội dung cấu hình bên dưới để có thể nhận thông báo về tài khoản email của bạn thông qua Gmail SMTP.', 'fox'); ?>
		        </div>
				<p class="admin-on">
		        <input type="checkbox" name="login_settings[gsmtp]" value="1" <?php if (isset($login_options['gsmtp']) && 1 == $login_options['gsmtp']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật Gmail SMTP', 'fox'); ?></label>
                </p>
				
				<p style="font-weight:bold"><?php _e('Tên người gửi', 'fox'); ?><p>
				<p><input  placeholder="<?php _e('Tên người gửi', 'fox'); ?>" name="login_settings[gsmtp1]" type="text" value="<?php if(!empty($login_options['gsmtp1'])){echo $login_options['gsmtp1'];} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Địa chỉ email', 'fox'); ?><p>
				<p><input  placeholder="<?php _e('Địa chỉ email', 'fox'); ?>" name="login_settings[gsmtp2]" type="text" value="<?php if(!empty($login_options['gsmtp2'])){echo $login_options['gsmtp2'];} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Tài khoản', 'fox'); ?><p>
				<p><input  placeholder="<?php _e('Tài khoản', 'fox'); ?>" name="login_settings[gsmtp3]" type="text" value="<?php if(!empty($login_options['gsmtp3'])){echo $login_options['gsmtp3'];} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Mật khẩu ứng dụng', 'fox'); ?><p>
				<p><input  placeholder="<?php _e('Mật khẩu ứng dụng', 'fox'); ?>" name="login_settings[gsmtp4]" type="password" value="<?php if(!empty($login_options['gsmtp4'])){echo $login_options['gsmtp4'];} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Máy chủ SMTP', 'fox'); ?><p>
				<p><input name="login_settings[gsmtp5]" type="text" value="<?php if(!empty($login_options['gsmtp5'])){echo $login_options['gsmtp5'];} else {echo 'smtp.gmail.com';} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Cổng SMTP', 'fox'); ?><p>
				<p><input style="width:70px;" name="login_settings[gsmtp6]" type="number" value="<?php if(!empty($login_options['gsmtp6'])){echo $login_options['gsmtp6'];} else {echo '587';} ?>"/></p>
				
				<p style="font-weight:bold"><?php _e('Giao thức SMTP', 'fox'); ?><p>
				<?php $styles = array('TLS', 'SSL'); ?>
				<select style="width:70px;" name="login_settings[sgmtp7]"> 
				<?php foreach($styles as $style) { ?> 
				<?php if($login_options['sgmtp7'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
				<option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
				<?php } ?> 
				</select>
		  </div>
		</div>
		
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_login_add_options_link() {
	add_submenu_page ('fox-options', 'Login', '<i class="fa-regular fa-arrow-right-to-bracket"></i> Login', 'manage_options', 'login-options', 'fox_login_options_page');
}
add_action('admin_menu', 'fox_login_add_options_link');
function fox_login_register_settings() {
	register_setting('login_settings_group', 'login_settings');
}
add_action('admin_init', 'fox_login_register_settings');
// them code google captche vao header
if(isset($login_options['enable1'])) {
function fox_catpcha_add_ads_js_footer() {
ob_start(); ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<?php
echo ob_get_clean();
}
add_action( 'wp_footer', 'fox_catpcha_add_ads_js_footer' );
}

