<?php
function fox_scurity_options_page() {
	global $scurity_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX SCURITY', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
		<?php settings_fields('scurity_settings_group'); ?>   
		<div class="admin-card">
		        <div class="admin-cm"><?php _e('Chức năng bảo mật cho website của bạn', 'fox'); ?></div>
		        <div class="admin-div-note">
		         <?php _e('Sau khi kích hoạt chức năng bảo mật website của bạn sẽ an toàn hơn khi bị tấn công.', 'fox'); ?>
		        </div>
				<p class="admin-on">
		        <input type="checkbox" name="scurity_settings[enable]" value="1" <?php if (isset($scurity_options['enable']) && 1 == $scurity_options['enable']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật scurity', 'fox'); ?></label>
                </p>
				<br>
                <div class="admin-cm"><?php _e('Tùy chọn chức năng bảo mật của theme', 'fox'); ?></div>
				<input type="checkbox" name="scurity_settings[scu1]" value="1" <?php if (isset($scurity_options['scu1']) && 1 == $scurity_options['scu1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật chặn tải lên file không phải hình ảnh', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn chặn tải lên tất cả các file không phải là hình ảnh.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu3]" value="1" <?php if (isset($scurity_options['scu3']) && 1 == $scurity_options['scu3']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Tắt REST API', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không sử dụng REST API thì nên tắt đi để bảo mật website.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu4]" value="1" <?php if (isset($scurity_options['scu4']) && 1 == $scurity_options['scu4']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Tắt XML RPC', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không sử dụng XML RPC thì nên tắt đi để bảo mật website.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu5]" value="1" <?php if (isset($scurity_options['scu5']) && 1 == $scurity_options['scu5']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Xóa các header info không cần thiết', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Xóa các header info không cần thiết nếu bạn muốn.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu6]" value="1" <?php if (isset($scurity_options['scu6']) && 1 == $scurity_options['scu6']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Tắt Wp-Embed', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không sử dụng Wp-Embed thì nên tắt đi để bảo mật website.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu7]" value="1" <?php if (isset($scurity_options['scu7']) && 1 == $scurity_options['scu7']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Tắt nguồn cấp dữ liệu khác', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tắt nguồn cấp dữ liệu khác không cần thiết.', 'fox'); ?></p>
				
				<input type="checkbox" name="scurity_settings[scu8]" value="1" <?php if (isset($scurity_options['scu8']) && 1 == $scurity_options['scu8']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Tắt X-Pingback', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không sử dụng X-Pingback thì nên tắt đi để bảo mật website.', 'fox'); ?></p>
					
		</div>
			    
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_scurity_add_options_link() {
	add_submenu_page ('fox-options', 'Scurity', '<i class="fa-regular fa-shield-check"></i> Scurity', 'manage_options', 'scurity-options', 'fox_scurity_options_page');
}
add_action('admin_menu', 'fox_scurity_add_options_link');
function fox_scurity_register_settings() {
	register_setting('scurity_settings_group', 'scurity_settings');
}
add_action('admin_init', 'fox_scurity_register_settings');







































