<?php
function fox_adsense_options_page() {
	global $adsense_options;
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX ADSENSE', 'fox'); ?></h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('THÊM', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-gear"></i> <?php _e('THÊM', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('VỊ TRÍ', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-rectangle-ad"></i> <?php _e('VỊ TRÍ', 'fox'); ?></button>
		</div>
		
		<form method="post" action="options.php">
			<?php echo settings_fields('adsense_settings_group'); ?>
			
		<div class="rank-box rank" id="rankone">	
		   <div class="admin-card">
		       <div class="admin-cm"><?php _e('Bật quảng cáo Adsense trên Website', 'fox'); ?></div>
			   <div class="admin-div-note"><?php _e('Nếu bạn bật lên, thì code Adsense sẽ được gắn vào trang web của bạn, ngược lại tắt đi, thì toàn bộ code Adsense sẽ không còn hoạt động trên trang web nữa.', 'fox'); ?></div>
			   <p class="admin-on">
		       <input id="adsense_settings[enable]" type="checkbox" name="adsense_settings[enable]" value="1" <?php if ( isset($adsense_options['enable']) && 1 == $adsense_options['enable'] ) echo 'checked="checked"'; ?> />
               <label><?php _e('Bật Adsense', 'fox'); ?></label>
			   </p>
		        <div class="admin-cm"><?php _e('Thêm Adsense vào website', 'fox'); ?></div>
                <input type="text" name="adsense_settings[adsense]" placeholder="pub-xxxxxxxxxxxxxxxx" value="<?php if(!empty($adsense_options['adsense'])){echo $adsense_options['adsense'];} ?>" />
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập ID Adsense vào ô bên dưới lấy nó ở <b>Cài đặt > Thông tin tài khoản</b> của trình quản lý Adsense.', 'fox'); ?></p>
			</div>
		</div>

		<div class="rank-box rank" id="ranktue" style="display:none">
			<div class="admin-card">
				<div class="admin-cm"><?php _e('Thêm quảng cáo trong cố định trong bài viết', 'fox'); ?></div>
				<textarea class="admin-textarea admin-code-textarea" name="adsense_settings[adsense2]" cols="30" rows="10" placeholder="Thêm code vào đây..."><?php if (!empty($adsense_options['adsense2'])){echo $adsense_options['adsense2'];} ?></textarea>
			    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Code này bạn có thể lấy nó trong phần <b>Quảng cáo > Tổng quan > Theo đơn vị quảng cáo > Tùy chọn loại quảng cáo muốn hiển thị</b> của trình quản lý Adsense.', 'fox'); ?></p>
				<input id="adsense_settings[enable1]" type="checkbox" name="adsense_settings[enable1]" value="1" <?php if ( isset($adsense_options['enable1']) && 1 == $adsense_options['enable1'] ) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị trên cùng', 'fox'); ?></label>
				<br><br>
				<input id="adsense_settings[enable2]" type="checkbox" name="adsense_settings[enable2]" value="1" <?php if ( isset($adsense_options['enable2']) && 1 == $adsense_options['enable2'] ) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị dưới cùng', 'fox'); ?></label>
                
                <br><br>
                <div class="admin-cm"><?php _e('Thêm quảng cáo Adsense vào vị trí tự động trong bài viết', 'fox'); ?></div>
				<input id="admin-adsense-v1" type="number" name="adsense_settings[sothe]" placeholder="<?php _e('Số dòng', 'fox'); ?>" value="<?php if(!empty($adsense_options['sothe'])){echo $adsense_options['sothe'];} ?>" />
				<input id="admin-adsense-v2" name="adsense_settings[the]" placeholder="</p>" value="<?php if(!empty($adsense_options['the'])){echo $adsense_options['the'];} ?>" />
                <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Số dòng khi gặp thẻ đó là hiển thị quảng cáo (mặc định là dòng số 2 thẻ đóng p).', 'fox'); ?></p>
                <input type="checkbox" name="adsense_settings[enable3]" value="1" <?php if (isset($adsense_options['enable3']) && 1 == $adsense_options['enable3']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị vị trí tự động trong bài viết', 'fox'); ?></label>
                
                <br><br>
                <div class="admin-cm"><?php _e('Thêm quảng cáo Adsense vào Widget', 'fox'); ?></div>
				<textarea class="admin-textarea admin-code-textarea" name="adsense_settings[adsense3]" cols="30" rows="10" placeholder="<?php _e('Thêm code vào đây...', 'fox'); ?>"><?php if(!empty($adsense_options['adsense3'])){echo $adsense_options['adsense3'];} ?></textarea>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Code này bạn có thể lấy nó trong phần <b>Quảng cáo > Tổng quan > Theo đơn vị quảng cáo > Tùy chọn loại quảng cáo muốn hiển thị</b> của trình quản lý Adsense.', 'fox'); ?></p>
				<input id="adsense_settings[enable1]" type="checkbox" name="adsense_settings[widget1]" value="1" <?php if (isset($adsense_options['widget1']) && 1 == $adsense_options['widget1']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị giữa trang', 'fox'); ?></label>
				<br><br>
				<input id="adsense_settings[enable2]" type="checkbox" name="adsense_settings[widget2]" value="1" <?php if (isset($adsense_options['widget2']) && 1 == $adsense_options['widget2']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị thanh bên', 'fox'); ?></label>
                
                <br><br>
                <div class="admin-cm"><?php _e('Thêm quảng cáo Adsense vào 2 bên max rộng', 'fox'); ?></div>
				<textarea class="admin-textarea admin-code-textarea" name="adsense_settings[adsense4]" cols="30" rows="10" placeholder="<?php _e('Thêm code vào đây...', 'fox'); ?>"><?php if(!empty($adsense_options['adsense4'])){echo $adsense_options['adsense4'];} ?></textarea>
				<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Code này bạn có thể lấy nó trong phần <b>Quảng cáo > Tổng quan > Theo đơn vị quảng cáo > Tùy chọn loại quảng cáo muốn hiển thị</b> của trình quản lý Adsense.', 'fox'); ?></p>
				<input id="adsense_settings[enable1]" type="checkbox" name="adsense_settings[widget3]" value="1" <?php if (isset($adsense_options['widget3']) && 1 == $adsense_options['widget3']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị bên phải', 'fox'); ?></label>
				<br><br>
				<input id="adsense_settings[enable2]" type="checkbox" name="adsense_settings[widget4]" value="1" <?php if (isset($adsense_options['widget4']) && 1 == $adsense_options['widget4']) echo 'checked="checked"'; ?> />
                <label class="admin-label-right"><?php _e('Hiển thị bên trái', 'fox'); ?></label>
			
			</div>
		</div>	
		<div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		 <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_adsense_add_options_link() {
	add_submenu_page ('fox-options', 'Adsense', '<i class="fa-regular fa-rectangle-ad"></i> Adsense', 'manage_options', 'adsense-options', 'fox_adsense_options_page');
}
add_action('admin_menu', 'fox_adsense_add_options_link');
function fox_adsense_register_settings() {
	register_setting('adsense_settings_group', 'adsense_settings');
}
add_action('admin_init', 'fox_adsense_register_settings');


// them adsense vao website
global $adsense_options;
if(isset($adsense_options['enable'])) {
// ad id script adsense website
if (!empty($adsense_options['adsense'])){
function fox_adsense_add_ads_js_head() {
global $adsense_options;
ob_start(); ?>
<script data-ad-client="ca-<?php echo $adsense_options['adsense']; ?>" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php
echo ob_get_clean();
}
add_action( 'wp_head', 'fox_adsense_add_ads_js_head' );
}
// add adsense content
function fox_adsense_add_content_top($content) {
global $adsense_options;
if(is_singular(array('post', 'story', 'land', 'shop', 'youtube'))) {
ob_start();
?>
<div style="margin-top:10px;margin-bottom:10px;"><?php echo $adsense_options['adsense2']; ?></div>
<?php 
$adsense_top = $adsense_bottom  = $ad_code = ob_get_clean();
if(!isset($adsense_options['enable1'])) {
	$adsense_top = "";
}
if(!isset($adsense_options['enable2'])) {
	$adsense_bottom = "";
}
if(!isset($adsense_options['enable3'])) {
	$ad_code = "";
}
if(!empty($adsense_options['sothe'])){
    $sothe = $adsense_options['sothe'];
} else{
    $sothe = '2'; 
}
return $adsense_top .  fox_insert_after( $ad_code, $sothe, $content ) . $adsense_bottom; 
}else {
return $content;
}
}
add_filter('the_content', 'fox_adsense_add_content_top');
// thiet lap vi tri the hien thi
function fox_insert_after( $insertion, $paragraph_id, $content ) {
global $adsense_options;
if(!empty($adsense_options['the'])){
    $closing_p = $adsense_options['the'];
} else{
    $closing_p = '<p>'; 
}
$paragraphs = explode( $closing_p, $content );
foreach ($paragraphs as $index => $paragraph) {
if ( trim( $paragraph ) ) {
$paragraphs[$index] .= $closing_p;
}
 
if ( $paragraph_id == $index + 1 ) {
$paragraphs[$index] .= $insertion;
}
}
return implode( '', $paragraphs );
}
function fox_add_adsense_widget_center(){
global $adsense_options;
ob_start();
if(isset($adsense_options['widget1'])){ ?>
<div style="margin-bottom:20px;"><?php echo $adsense_options['adsense3']; ?></div>
<?php
}
return ob_get_clean();
}
function fox_add_adsense_widget_right(){
global $adsense_options;
ob_start();
if(isset($adsense_options['widget2'])){ ?>
<div style="margin-bottom:20px;"><?php echo $adsense_options['adsense3']; ?></div>
<?php
}
return ob_get_clean();
}
function fox_add_adsense_widget_sense1(){
global $adsense_options;
ob_start();
if(isset($adsense_options['widget3'])){ ?>
<div style="margin-bottom:20px;"><?php echo $adsense_options['adsense3']; ?></div>
<?php
}
return ob_get_clean();
}
function fox_add_adsense_widget_sense2(){
global $adsense_options;
ob_start();
if(isset($adsense_options['widget4'])){ ?>
<div style="margin-bottom:20px;"><?php echo $adsense_options['adsense3']; ?></div>
<?php
}
return ob_get_clean();
}
}


