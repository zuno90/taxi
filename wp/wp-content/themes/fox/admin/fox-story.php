<?php
function fox_story_options_page() {
	global $story_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX STORY', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('story_settings_group'); ?>   
		   <div class="admin-card">
				 <div class="admin-cm"><?php _e('Giao diện chương', 'fox'); ?></div>
                    <?php $styles = array('Default', 'Comic'); ?>
                    <select name="story_settings[theme]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($story_options['theme'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn giao diện hiển thị chương truyện mà bạn muốn.', 'fox'); ?><br></p>
                <div class="admin-cm"><?php _e('Hiển thị chương trong truyện chính', 'fox'); ?></div>
                <input id="admin-input-size" placeholder="10" name="story_settings[page]" type="number" value="<?php echo $story_options['page']; ?>"/>
    		    <label class="admin-label-right"><?php _e('Số lượng chương hiển thị', 'fox'); ?></label>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Mặc định hiển thị 10 chương mới chuyển trang.', 'fox'); ?><br></p>
                <input type="checkbox" name="story_settings[enable1]" value="1" <?php if (isset($story_options['enable1']) && 1 == $story_options['enable1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật hiển thị chương mới', 'fox'); ?></label>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Hiển thị 6 chương mới nhất giúp cho những người theo dõi truyện dễ dàng đọc hơn.', 'fox'); ?><br></p>
                
                <input type="checkbox" name="story_settings[enable2]" value="1" <?php if (isset($story_options['enable2']) && 1 == $story_options['enable2']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật chức năng truyện Audio', 'fox'); ?></label>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này là bạn có thể đăng truyện Audio rồi đó.', 'fox'); ?><br></p>
            
			</div>
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_story_add_options_link() {
	add_submenu_page ('fox-options', 'Story', '<i class="fa-regular fa-books"></i> Story', 'manage_options', 'story-options', 'fox_story_options_page');
}
add_action('admin_menu', 'fox_story_add_options_link');
function fox_story_register_settings() {
	register_setting('story_settings_group', 'story_settings');
}
add_action('admin_init', 'fox_story_register_settings');

