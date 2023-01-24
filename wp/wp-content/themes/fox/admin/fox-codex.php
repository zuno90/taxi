<?php
function fox_codex_options_page() {
	global $codex_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX CODEX', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('codex_settings_group'); ?>
	
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Cài đặt Codex', 'fox'); ?></div>
			
			<div class="admin-div-note">
		         <?php _e('Nếu bạn kích hoạt chức năng này những bài viết Codex sẽ hiển thị ở trang chủ.', 'fox'); ?>
		        </div>
				<p class="admin-on">
		        <input type="checkbox" name="codex_settings[enable]" value="1" <?php if (isset($codex_options['enable']) && 1 == $codex_options['enable']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật hiển thị Codex', 'fox'); ?></label>
                </p>
			</div>
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_codex_add_options_link() {
	add_submenu_page ('fox-options', 'Codex', '<i class="fa-regular fa-code"></i> Codex', 'manage_options', 'codex-options', 'fox_codex_options_page');
}
add_action('admin_menu', 'fox_codex_add_options_link');
function fox_codex_register_settings() {
	register_setting('codex_settings_group', 'codex_settings');
}
add_action('admin_init', 'fox_codex_register_settings');

