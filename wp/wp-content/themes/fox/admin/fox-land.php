<?php
function fox_land_options_page() {
	global $land_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX LAND', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('land_settings_group'); ?>
			
			<div class="admin-card">
			   <div class="admin-cm"><?php _e('Chọn bộ lọc hiển thị', 'fox'); ?></div>
			   <p><input type="checkbox" name="land_settings[loc0]" value="1" <?php if (isset($land_options['loc0']) && 1 == $land_options['loc0']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Lọc vị trí', 'fox'); ?></label></p>
			   
			   <p><input type="checkbox" name="land_settings[loc1]" value="1" <?php if (isset($land_options['loc1']) && 1 == $land_options['loc1']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Lọc phân loại', 'fox'); ?></label></p>
			   
			   <p><input type="checkbox" name="land_settings[loc2]" value="1" <?php if (isset($land_options['loc2']) && 1 == $land_options['loc2']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Lọc thông tin', 'fox'); ?></label></p>
			   
			   <p><input type="checkbox" name="land_settings[loc3]" value="1" <?php if (isset($land_options['loc3']) && 1 == $land_options['loc3']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Lọc diện tích', 'fox'); ?></label></p>
			   
			   <p><input type="checkbox" name="land_settings[loc4]" value="1" <?php if (isset($land_options['loc4']) && 1 == $land_options['loc4']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Lọc giá', 'fox'); ?></label></p>
			   
			   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn bộ lọc hiển thị ở trang và widget.', 'fox'); ?><br></p>
			   
			   <div class="admin-cm"><?php _e('Giao bộ lọc tìm kiếm', 'fox'); ?></div>
                    <?php $styles = array('Style1', 'Style2'); ?>
                    <select name="land_settings[style]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($land_options['style'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
			   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu hiển thị bộ lọc tìm kiếm.', 'fox'); ?><br></p>
			</div>
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Thành viên đăng tin', 'fox'); ?></div>
			<p><input type="checkbox" name="land_settings[login0]" value="1" <?php if (isset($land_options['login0']) && 1 == $land_options['login0']) echo 'checked="checked"'; ?> />
            <label class="admin-label-right"><?php _e('Cho phép thành viên đăng', 'fox'); ?></label></p>
			<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tùy chọn này thêm chức năng cho phép thành viên đăng ký có thể đăng tin.', 'fox'); ?><br></p>
			</div>
			
			<div class="admin-card">
			   <div class="admin-cm"><?php _e('Cài đặt đăng tin', 'fox'); ?></div>
			   <p><input type="checkbox" name="land_settings[dang0]" value="1" <?php if (isset($land_options['dang0']) && 1 == $land_options['dang0']) echo 'checked="checked"'; ?> />
               <label class="admin-label-right"><?php _e('Sử dụng liên hệ hồ sơ', 'fox'); ?></label></p>
			   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu chọn chức năng này, trường liên hệ ở tin sẻ được lấy từ hồ sơ người dùng thay cho việc nhập tin.', 'fox'); ?><br></p>
			</div>
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_land_add_options_link() {
	add_submenu_page ('fox-options', 'land', '<i class="fa-regular fa-location-dot"></i> Land', 'manage_options', 'land-options', 'fox_land_options_page');
}
add_action('admin_menu', 'fox_land_add_options_link');
function fox_land_register_settings() {
	register_setting('land_settings_group', 'land_settings');
}
add_action('admin_init', 'fox_land_register_settings');

