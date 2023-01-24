<?php
function fox_error_options_page() {
	global $error_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX ERROR', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
		<?php settings_fields('error_settings_group'); ?>   
		<div class="admin-card">
		        <div class="admin-cm"><?php _e('Thông báo lỗi bài viết hoặc chương truyện về Telegram', 'fox'); ?></div>
		        <div class="admin-div-note">
		         <?php _e('Sau khi bạn bật Fox Error, trang web của bạn sẽ có thêm phần thông báo lỗi ở bài viết và chương truyện "thông báo này sẽ được gửi tới nhóm Telegram của bạn".', 'fox'); ?>
		        </div>
				<p class="admin-on">
		        <input type="checkbox" name="error_settings[enable]" value="1" <?php if (isset($error_options['enable']) && 1 == $error_options['enable']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật thông báo Telegram', 'fox'); ?></label>
                </p>

                <div class="admin-cm"><?php _e('Nhập thông tin API Telegram vào ô bên dưới', 'fox'); ?></div>
                <div>
				<p><input placeholder="API token" name="error_settings[key1]" type="text" value="<?php if(!empty($error_options['key1'])){echo $error_options['key1'];} ?>"/></p>
				<p><input placeholder="Chat ID" name="error_settings[key2]" type="text" value="<?php if(!empty($error_options['key2'])){echo $error_options['key2'];} ?>"/></p>
			    </div>	 
		</div>
			    
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_error_add_options_link() {
	add_submenu_page ('fox-options', 'Error', '<i class="fa-regular fa-triangle-exclamation"></i> Error', 'manage_options', 'error-options', 'fox_error_options_page');
}
add_action('admin_menu', 'fox_error_add_options_link');
function fox_error_register_settings() {
	register_setting('error_settings_group', 'error_settings');
}
add_action('admin_init', 'fox_error_register_settings');

