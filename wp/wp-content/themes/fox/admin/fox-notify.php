<?php
global $notify_options;
function fox_notify_options_page() {
	global $notify_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX NOTIFY', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('NOTIFY', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-bell"></i> <?php _e('NOTIFY', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('BLOCKER', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-block-brick-fire"></i> <?php _e('BLOCKER', 'fox'); ?></button>
		</div>
		
		<form method="post" action="options.php">
			<?php settings_fields('notify_settings_group'); ?>

		   <div class="rank-box rank" id="rankone">
           <div class="admin-card">
		       <div class="admin-cm"><?php _e('Chức năng hiển thị thông báo trên Website', 'fox'); ?></div>
		        <div class="admin-div-note"><?php _e('Notify là chức năng hiển thị một popup thông báo trên cùng của website cho phép người dùng có thể dễ dàng tiếp cận được nội dung mà bạn truyền tải.', 'fox'); ?></div>
				<p class="admin-on">
		        <input type="checkbox" name="notify_settings[enable1]" value="1" <?php if (isset($notify_options['enable1']) && 1 == $notify_options['enable1']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật Notify', 'fox'); ?></label>
                </p>
                <textarea class="admin-textarea" name="notify_settings[nnoidung]" cols="30" rows="10" placeholder="<?php _e('Nhập nội dung bạn muốn vào...', 'fox'); ?>"><?php if(!empty($notify_options['nnoidung'])){echo $notify_options['nnoidung'];} ?></textarea>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập nội dung bạn muốn hiển thị ở thông báo vào ô trên, bạn có thể thêm liên kết nếu muốn.', 'fox'); ?></p>
				<div class="admin-cm"><?php _e('Màu nền hiển thị', 'fox'); ?></div>
                    <?php $styles = array('Blue', 'Green', 'Orange', 'Red'); ?>
                    <select name="notify_settings[nstyle]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($notify_options['nstyle'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu màu nền của thông báo hiển thị.', 'fox'); ?></p>
			</div>
			</div>
		   	<div class="rank-box rank" id="ranktue" style="display:none">	
		    <div class="admin-card">
		       <div class="admin-cm"><?php _e('Chức năng thông báo chặn quảng cáo trên Website', 'fox'); ?></div>
		        <div class="admin-div-note"><?php _e('Blocker là tính năng hiển thị thông báo cho người dùng khi họ đang sử dụng trình chặn quảng cáo trên trình duyệt.', 'fox'); ?></div>
				<p class="admin-on">
		        <input type="checkbox" name="notify_settings[enable2]" value="1" <?php if (isset($notify_options['enable2']) && 1 == $notify_options['enable2']) echo 'checked="checked"'; ?> />
                <label><?php _e('Bật Blocker', 'fox'); ?></label>
                </p>
                <textarea class="admin-textarea" name="notify_settings[bnoidung]" cols="30" rows="10" placeholder="<?php _e('Nhập nội dung bạn muốn vào...', 'fox'); ?>"><?php if(!empty($notify_options['bnoidung'])){echo $notify_options['bnoidung'];} ?></textarea>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập nội dung bạn muốn hiển thị thông báo về Blocker ở ô trên.', 'fox'); ?></p>
				
				<input type="checkbox" name="notify_settings[btype1]" value="1" <?php if (isset($notify_options['btype1']) && 1 == $notify_options['btype1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Bật nút tắt', 'fox'); ?></label>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật nút tắt thông báo Blocker nếu bạn muốn, khi đó người dùng có thể tắt thông báo hiển thị.', 'fox'); ?></p>
			</div>
			</div>
			
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_notify_add_options_link() {
	add_submenu_page ('fox-options', 'Notify', '<i class="fa-regular fa-bell"></i> Notify', 'manage_options', 'notify-options', 'fox_notify_options_page');
}
add_action('admin_menu', 'fox_notify_add_options_link');
function fox_notify_register_settings() {
	register_setting('notify_settings_group', 'notify_settings');
}
add_action('admin_init', 'fox_notify_register_settings');

// add notify hook footer
if(isset($notify_options['enable1'])){
function fox_notify_hook() { 
global $notify_options;
if(isset($notify_options['nstyle']) && $notify_options['nstyle'] == "Blue"){
	$nstyle = 'style="background-color: #4ea5cd;border-color: #3b8eb5;"';
} else if(isset($notify_options['nstyle']) && $notify_options['nstyle'] == "Green"){
	$nstyle = 'style="background-color: #61b832;border-color: #55a12c;"';
} else if (isset($notify_options['nstyle']) && $notify_options['nstyle'] == "Orange"){
	$nstyle = 'style="background-color: #eaaf51;border-color: #d99a36;"';
} else if (isset($notify_options['nstyle']) && $notify_options['nstyle'] == "Red"){
	$nstyle = 'style="background-color: #de4343;border-color: #c43d3d;"';
} else {
	$nstyle = 'style="background-color: #4ea5cd;border-color: #3b8eb5;"';
}
ob_start();
?>
<div class="noti-info noti-message" id="noti-message" <?php echo $nstyle; ?>>
<div class="fix-menu noti-message-box">
	<div class="noti-message-1"><i class="fa-regular fa-party-horn" style="margin-right:7px"></i> <?php if (!empty($notify_options['nnoidung'])){ echo $notify_options['nnoidung']; } else { _e('Bạn chưa thêm nội dung vào', 'fox');} ?></div>
	<div class="noti-message-2"><button onclick="share(event, 'noti-message')">&#215;</button></div>
</div>
</div>
<?php
echo ob_get_clean();
}
add_action( 'fox_notify', 'fox_notify_hook' );
}
// add blocker hook footer
if(isset($notify_options['enable2'])){
function fox_blocker_add_content() {
global $notify_options;
ob_start();
if (!empty($notify_options['bnoidung'])){ $content_blocker = $notify_options['bnoidung']; } else { $content_blocker = __('Mình rất buồn khi bạn sử dụng tính năng chặn quảng cáo trên trang web này, hãy bỏ chặn trang này để ủng hộ cho tác giả', 'fox');}
if (isset($notify_options['btype1'])){$off_blocker = "<button id='nut-blocker'>". __('Tôi hiểu rồi', 'fox') ."</button>";} else {$off_blocker = '';}
?>
<script>
var conblocker = <?php echo json_encode($content_blocker); ?>;
var titblocker = <?php echo json_encode(__('Tắt AdBlocker', 'fox')); ?>;
var offblocker = <?php echo json_encode($off_blocker); ?>;
</script>
<div style="display:none" id="adsblocker">
<div class="ads ad adsbox doubleclick ad-placement carbon-ads" style="background-color:red;height:300px;width:100%;"><!-- Quang cao -->Google Ads, Facebook Ads Google Adsense<!-- Ads --></div>
</div>
<div id="setblocker"></div>
<?php 
$blocker = ob_get_clean();
echo $blocker;
}
add_action( 'wp_footer', 'fox_blocker_add_content' );
// add css js
function fox_blocker_addjscss_head() {
wp_enqueue_style( 'blocker-css', get_template_directory_uri() . '/inc/css/blocker.css', array());
wp_enqueue_script( 'blocker-js', get_template_directory_uri() . '/inc/js/blocker.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'fox_blocker_addjscss_head' );
}
