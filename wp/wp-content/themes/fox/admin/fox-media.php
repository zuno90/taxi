<?php
function fox_media_options_page() {
	global $media_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX MEDIA', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
		<?php settings_fields('media_settings_group'); ?>   
		<div class="admin-card">
                <div class="admin-cm"><?php _e('Tùy chọn chức năng media của theme', 'fox'); ?></div>
				
				<input type="checkbox" name="media_settings[sel1]" value="1" <?php if (isset($media_options['sel1']) && 1 == $media_options['sel1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật chặn cắt hình ảnh khi tải lên', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Fox theme chỉ sử dụng một định dạng hình ảnh (góc) để hiển thị, bạn có thể bật chức năng này lên nếu muốn hình ảnh tải lên không bị cắt thành nhiều kích thước thu nhỏ.', 'fox'); ?></p>
				
				<input type="checkbox" name="media_settings[sel2]" value="1" <?php if (isset($media_options['sel2']) && 1 == $media_options['sel2']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Giới hạn kích thước file tải lên', 'fox'); ?></label>
				<br>
				<br>
				<input id="admin-input-size" placeholder="1500" name="media_settings[sel21]" type="number" value="<?php if(!empty($media_options['sel21'])){echo $media_options['sel21'];} ?>"/>
    		    <label class="admin-label-right"><?php _e('KB', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bạn có thể giới hạn kích thước file tải lên bằng cách bật và gõ kích thước giới hạn vào ô bên trên.', 'fox'); ?></p>
				
				<input type="checkbox" name="media_settings[sel3]" value="1" <?php if (isset($media_options['sel3']) && 1 == $media_options['sel3']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật xóa bài viết xóa luôn hình ảnh', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chức năng này cho phép bạn xóa bài viết thì hình ảnh đính kèm trong bài viết cũng bị xóa luôn (chú ý nếu các bài viết có dùng chung một hình ảnh cũng sẽ bị mất hình khi xóa).', 'fox'); ?></p>
				
				<input type="checkbox" name="media_settings[sel4]" value="1" <?php if (isset($media_options['sel4']) && 1 == $media_options['sel4']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Căn giữa tất cả hình ảnh trong bài viết', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tất cả hình ảnh trong bài viết sẽ được căn giữa.', 'fox'); ?></p>
				

					
		</div>
			    
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_media_add_options_link() {
	add_submenu_page ('fox-options', 'Media', '<i class="fa-regular fa-photo-film-music"></i> Media', 'manage_options', 'media-options', 'fox_media_options_page');
}
add_action('admin_menu', 'fox_media_add_options_link');
function fox_media_register_settings() {
	register_setting('media_settings_group', 'media_settings');
}
add_action('admin_init', 'fox_media_register_settings');








































