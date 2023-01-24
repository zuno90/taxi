<?php
function fox_addcode_options_page() {
	global $addcode_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX CODE', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('THÊM CSS', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-code"></i> <?php _e('THÊM CSS', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('THÊM CODE', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-code"></i> <?php _e('THÊM CODE', 'fox'); ?></button>
		</div>
		
		<form method="post" action="options.php">
		   <?php settings_fields('addcode_settings_group'); ?>
        <div class="rank-box rank" id="rankone">
			<div class="admin-card">
		        <div class="admin-cm"><?php _e('Thêm tùy biến css vào website', 'fox'); ?></div>
				<div class="admin-div-note"><?php _e('Sử dụng hộp nhập bên dưới để thêm tùy biến css vào website của bạn', 'fox'); ?>.</div><br>
			<textarea class="admin-textarea admin-code-textarea textarea-addcode fox-codex" name="addcode_settings[css1]" cols="30" rows="10"><?php if(!empty($addcode_options['css1'])){echo $addcode_options['css1'];} ?></textarea>
			</div>
		</div>
		<div class="rank-box rank" id="ranktue" style="display:none">
		   <div class="admin-card">
		        <div class="admin-cm"><?php _e('Thêm code vào trị ví Header của website', 'fox'); ?></div>
				<div class="admin-div-note"><?php _e('Thêm Script vào trong thẻ', 'fox'); ?> <b>&lt;head&gt;</b>.</div><br>
			<textarea class="admin-textarea admin-code-textarea textarea-addcode" name="addcode_settings[script1]" cols="30" rows="10" placeholder="<?php _e('Thêm code vào đây...', 'fox'); ?>"><?php if(!empty($addcode_options['script1'])){echo $addcode_options['script1'];} ?></textarea>
			</div>
			<div class="admin-card">
		        <div class="admin-cm"><?php _e('Thêm code vào ngay dưới thẻ Body của website', 'fox'); ?></div>
				<div class="admin-div-note"><?php _e('Thêm Script vào dưới thẻ', 'fox'); ?> <b>&lt;body&gt;</b>.</div><br>
			<textarea class="admin-textarea admin-code-textarea textarea-addcode" name="addcode_settings[script2]" cols="30" rows="10" placeholder="<?php _e('Thêm code vào đây...', 'fox'); ?>"><?php if(!empty($addcode_options['script2'])){echo $addcode_options['script2'];} ?></textarea>
			</div>
			<div class="admin-card">
		        <div class="admin-cm"><?php _e('Thêm code vào trị ví Footer của website', 'fox'); ?></div>
				<div class="admin-div-note"><?php _e('Thêm Script vào trên thẻ', 'fox'); ?> <b>&lt;/body&gt;</b>.</div><br>
			<textarea class="admin-textarea admin-code-textarea textarea-addcode" name="addcode_settings[script3]" cols="30" rows="10" placeholder="<?php _e('Thêm code vào đây...', 'fox'); ?>"><?php if(!empty($addcode_options['script3'])){echo $addcode_options['script3'];} ?></textarea>
			</div>
		</div>
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_addcode_add_options_link() {
	add_submenu_page ('fox-options', 'Add Code', '<i class="fa-regular fa-code"></i> Add Code', 'manage_options', 'addcode-options', 'fox_addcode_options_page');
}
add_action('admin_menu', 'fox_addcode_add_options_link');
function fox_addcode_register_settings() {
	register_setting('addcode_settings_group', 'addcode_settings');
}
add_action('admin_init', 'fox_addcode_register_settings');
// add Header
if (!empty($addcode_options['script1'])){
function fox_addcode_header_css_js() {
global $addcode_options;
echo $addcode_options['script1'];
}
add_action( 'wp_head', 'fox_addcode_header_css_js' );
}
// add Body
if (!empty($addcode_options['script2'])){
function fox_addcode_body_css_js() {
global $addcode_options;
echo $addcode_options['script2'];
}
add_action( 'wp_body_open', 'fox_addcode_body_css_js' );
}
// add Footer
if (!empty($addcode_options['script3'])){
function fox_addcode_footer_css_js() {
global $addcode_options;
echo $addcode_options['script3'];
}
add_action( 'wp_footer', 'fox_addcode_footer_css_js' );
}
// add Css
if (!empty($addcode_options['css1'])){
function fox_addcode_footer_css_js() {
global $addcode_options;
echo '<style>'. $addcode_options['css1'] . '</style>';
}
add_action( 'wp_footer', 'fox_addcode_footer_css_js' );
}