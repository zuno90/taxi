<?php
global $comment_options;
function fox_comment_options_page() {
	global $comment_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX COMMENT', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('MẶC ĐỊNH', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-message-captions"></i> <?php _e('MẶC ĐỊNH', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('FACEBOOK', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-message-captions"></i> <?php _e('FACEBOOK', 'fox'); ?></button>
		</div>
		
		<form method="post" action="options.php">
			<?php settings_fields('comment_settings_group'); ?>

		   <div class="rank-box rank" id="rankone">
           <div class="admin-card">
		       <div class="admin-cm"><?php _e('Chức năng bình luận mặc định', 'fox'); ?></div>
		        <div class="admin-div-note"><?php _e('Bật chức năng hiển thị bình luận mặc định cho Foxtheme.', 'fox'); ?></div>
				<p class="admin-on">
		        <input type="checkbox" name="comment_settings[enable1]" value="1" <?php if (isset($comment_options['enable1']) && 1 == $comment_options['enable1']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật bình luận mặc định', 'fox'); ?></label>
                </p>
			   <div class="admin-cm"><?php _e('Cấu hình chức năng thông báo', 'fox'); ?></div>
			   <input type="checkbox" name="comment_settings[comen1]" value="1" <?php if (isset($comment_options['comen1']) && 1 == $comment_options['comen1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật thông báo khi có trả lời bình luận', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật lên nếu bạn muốn thông báo đến email người dùng khi bình luận của họ có người trả lời.', 'fox'); ?></p>
				<div class="admin-cm"><?php _e('Cấu hình chức năng hiển thị', 'fox'); ?></div>
			   <input type="checkbox" name="comment_settings[comen2]" value="1" <?php if (isset($comment_options['comen2']) && 1 == $comment_options['comen2']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật hiển thị biểu tượng phân biệt admin hoặc người dùng', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn bật chức năng này, sẽ có biểu tượng hoặc văn bản hiển thị sau tên tác giả bình luận thể hiện vai trò của họ.', 'fox'); ?></p>
				<p class="admin-p-tit"><?php _e('Văn bản hoặc biểu tượng dành cho admin', 'fox'); ?></p>
				<p style="display:flex">
				<input style="width:170px;" placeholder="<i class='fa-regular fa-circle-check'></i>" name="comment_settings[comen-input1]" type="text" value="<?php if(!empty($comment_options['comen-input1'])){echo $comment_options['comen-input1'];} ?>"/>
				<input name="comment_settings[comen-color1]" type="color" value="<?php if(!empty($comment_options['comen-color1'])){echo $comment_options['comen-color1'];} ?>"/>
				</p>
				<p class="admin-p-tit"><?php _e('Văn bản hoặc biểu tượng dành cho người dùng', 'fox'); ?></p>
				<p style="display:flex">
				<input style="width:170px;" placeholder="" name="comment_settings[comen-input2]" type="text" value="<?php if(!empty($comment_options['comen-input2'])){echo $comment_options['comen-input2'];} ?>"/>
				<input name="comment_settings[comen-color2]" type="color" value="<?php if(!empty($comment_options['comen-color2'])){echo $comment_options['comen-color2'];} ?>"/>
				</p>
			</div>
			</div>
		   	<div class="rank-box rank" id="ranktue" style="display:none">	
		    <div class="admin-card">
		       <div class="admin-cm"><?php _e('Thêm bình luận Facebook vào website', 'fox'); ?></div>
		        <div class="admin-div-note"><?php _e('Bật chức năng này và điền đầy đủ các thông tin bên dưới để cấu hình thêm bình luận Facebook vào website của bạn.', 'fox'); ?></div>
				<p class="admin-on">
		        <input type="checkbox" name="comment_settings[enable2]" value="1" <?php if (isset($comment_options['enable2']) && 1 == $comment_options['enable2']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật bình luận Facebook', 'fox'); ?></label>
                </p>
				<div class="admin-cm"><?php _e('Cấu hình', 'fox'); ?></div>
				<input placeholder="<?php _e('Nhập ID ứng dụng', 'fox'); ?>" name="comment_settings[face-input1]" type="text" value="<?php if(!empty($comment_options['face-input1'])){echo $comment_options['face-input1'];} ?>" />
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bạn cần thêm ID ứng dụng Facebook vào ô bên trên.', 'fox'); ?></p>
				<input style="width:140px;" placeholder="Số bình luận" name="comment_settings[face-input2]" type="number" value="<?php if(!empty($comment_options['face-input2'])){echo $comment_options['face-input2'];} ?>"/>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập số lượng bình luận hiển thị vào ô trên.', 'fox'); ?></p>
			</div>
			</div>
			
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_comment_add_options_link() {
	add_submenu_page ('fox-options', 'Comment', '<i class="fa-regular fa-message-captions"></i> Comment', 'manage_options', 'comment-options', 'fox_comment_options_page');
}
add_action('admin_menu', 'fox_comment_add_options_link');
function fox_comment_register_settings() {
	register_setting('comment_settings_group', 'comment_settings');
}
add_action('admin_init', 'fox_comment_register_settings');

