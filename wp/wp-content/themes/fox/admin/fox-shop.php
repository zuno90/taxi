<?php
function fox_shopp_options_page() {
	global $shopp_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX SHOP', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('shopp_settings_group'); ?>
	
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Cài đặt mua hàng', 'fox'); ?></div>
			<?php $styles = array('Default', 'Affiliate'); ?>
            <select name="shopp_settings[sel]"> 
            <?php foreach($styles as $style) { ?> 
            <?php if($shopp_options['sel'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
            <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
            <?php } ?> 
            </select>
		    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Lựa chọn phương thức mua hàng, tới liên kết tiếp thị hoặc liên hệ trực tiếp.', 'fox'); ?></p>
			
			<div class="admin-cm"><?php _e('Cài đặt liên hệ mua hàng', 'fox'); ?></div>
		    <input type="number" name="shopp_settings[sdt]" placeholder="<?php _e('Số điện thoại', 'fox'); ?>" value="<?php if(!empty($shopp_options['sdt'])){echo $shopp_options['sdt'];} ?>" />
			<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập số điện thoại liên hệ của bạn vào ô trên.', 'fox'); ?></p>
            <input type="text" name="shopp_settings[facebook]" placeholder="ID Facebook" value="<?php if(!empty($shopp_options['facebook'])){echo $shopp_options['facebook'];} ?>" />
		    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> https://facebook.com/<span style="color:#ff4444">ID</span> <?php _e('ID chính là ID Facebook của bạn.', 'fox'); ?></p>
            <input type="number" name="shopp_settings[zalo]" placeholder="ID Zalo" value="<?php if(!empty($shopp_options['zalo'])){echo $shopp_options['zalo'];} ?>" />
			<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập số điện thoại Zalo của bạn vào ô trên.', 'fox'); ?></p>
			   
			<div class="admin-cm"><?php _e('Thêm shortcode biểu mẫu liên hệ', 'fox'); ?></div>  
			<textarea class="admin-textarea" name="shopp_settings[code]" style="height:50px;" placeholder="<?php _e('Nhập [Shortcode] vào đây', 'fox'); ?>"><?php if(!empty($shopp_options['code'])){echo $shopp_options['code'];} ?></textarea>
			
			<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bạn có thể sử dụng một số plugin để tạo biểu mẫu liên hệ, sau đó lấy shortcode biểu mẫu đó và thêm vào ô trên.', 'fox'); ?></p> 
			 
			</div>
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_shopp_add_options_link() {
	add_submenu_page ('fox-options', 'Shop', '<i class="fa-regular fa-cart-shopping"></i> Shop', 'manage_options', 'shopp-options', 'fox_shopp_options_page');
}
add_action('admin_menu', 'fox_shopp_add_options_link');
function fox_shopp_register_settings() {
	register_setting('shopp_settings_group', 'shopp_settings');
}
add_action('admin_init', 'fox_shopp_register_settings');

