<?php
// REGISTER POST TYPE: coupon
global $coupon_options;
function fox_coupon_create_post_type(){
    $label = array(
        'name' => __('Coupon', 'fox'),
    	'singular_name' => __('Coupon', 'fox'),
    	'add_new' => __('Thêm coupon', 'fox'),
    	'add_new_item' => __('Thêm coupon', 'fox'),
    	'edit_item' => __('Chỉnh sửa coupon', 'fox'),
    	'new_item' => __('Coupon', 'fox'),
    	'view_item' => __('Xem coupon', 'fox'),
    	'search_items' => __('Tìm coupon', 'fox'),
    	'not_found' => __('Không có coupon nào', 'fox'),
    	'not_found_in_trash' => __('Không có coupon nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả coupon', 'fox'),
    	'menu_name' => __('Coupon', 'fox'),
    	'name_admin_bar' => __('Coupon', 'fox'),
    );
 
    $args = array(
        'labels'              => $label,
        'supports'            => array( 'title'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true, 
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true, 
        'show_in_admin_bar'   => true,
        'menu_position'       => 5, 
        'menu_icon'           => 'dashicons-tickets-alt', 
        'can_export'          => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'map_meta_cap'        => true,  
		'has_archive'         => 'coupon',
		'rewrite'             => array('slug' => 'coupon/%show%'),

    );
 
    register_post_type('coupon', $args);
}
add_action( 'init', 'fox_coupon_create_post_type' );
// custom chuyen show coupon
function fox_coupon_custom_taxonomy() {
    $labels = array(
        'name' => __('Nguồn', 'fox'),
        'singular' => __('Nguồn', 'fox'),
        'menu_name' => __('Nguồn', 'fox'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'coupon'),
		
    );
    register_taxonomy('show', 'coupon' , $args);
}
add_action( 'init', 'fox_coupon_custom_taxonomy', 0 );
// tao thu show dong sau luu tru
function fox_create_coupon_link( $post_link, $id = 0 ){
$post = get_post($id);
if ( is_object( $post ) ){
$terms = wp_get_object_terms( $post->ID, 'show' );
if( $terms ){
return str_replace( '%show%' , $terms[0]->slug, $post_link );
} else {return str_replace( '%show%' , 'show', $post_link );}
}
return $post_link;
}
add_filter( 'post_type_link', 'fox_create_coupon_link', 1, 3 );
flush_rewrite_rules();

// khai bao thong tin
function fox_thongtin_meta_coupon()
{
add_meta_box( 'mebox-coupon', __('Nhập nội dung coupon', 'fox'), 'fox_thongtin_output_coupon', 'coupon' );
}
add_action( 'add_meta_boxes', 'fox_thongtin_meta_coupon' );
 
// khai báo callback
function fox_thongtin_output_coupon( $post ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
$coupon1 = get_post_meta( $post->ID, 'coupon1', true );
$coupon2 = get_post_meta( $post->ID, 'coupon2', true );
$coupon3 = get_post_meta( $post->ID, 'coupon3', true );
$coupon4 = get_post_meta( $post->ID, 'coupon4', true );
$coupon5 = get_post_meta( $post->ID, 'coupon5', true );
?>
<div class="post-main">
<div class="post-muc"><i class="fa-regular fa-award"></i> <?php _e('Nội dung coupon', 'fox'); ?></div>
<p><textarea class="post-textarea" name="coupon1"><?php echo esc_textarea( $coupon1 ); ?></textarea></p>
<div class="post-muc"><i class="fa-regular fa-badge-percent"></i> <?php _e('Phần trăm giảm giá', 'fox'); ?></div>
<p><input id="post-input" type="number" name="coupon2" value="<?php echo esc_attr( $coupon2 ); ?>" /></p>
<div class="post-muc"><i class="fa-regular fa-calendar-days"></i> <?php _e('Ngày hết hạn', 'fox'); ?></div>
<p><input id="post-input" type="text" placeholder="12/12/2022" name="coupon3" value="<?php echo esc_attr( $coupon3 ); ?>" /></p>
<p class="post-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Vui lòng nhập ngày hết hạn theo chuẩn dd/mm/yyyy để coupon của bạn hiển thị hết hạn', 'fox'); ?></p>
<div class="post-muc"><i class="fa-regular fa-tag"></i> <?php _e('Mã giảm giá', 'fox'); ?></div>
<p><input id="post-input" type="text" name="coupon4" value="<?php echo esc_attr( $coupon4 ); ?>" /></p>
<div class="post-muc"><i class="fa-regular fa-link"></i> <?php _e('Liên kết tiếp thị', 'fox'); ?></div>
<p><input id="post-input" type="text" name="coupon5" value="<?php echo esc_attr( $coupon5 ); ?>" /></p>
</div>
<?php }
// Lưu dữ liệu và tạo nonce bảo mật
function fox_thongtin_save_coupon( $post_id ) {
if(isset($_POST['thongtin_nonce'])){
$thongtin_nonce = $_POST['thongtin_nonce'];
}
if( !isset( $thongtin_nonce ) ) {
return;
}
if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
return;
}
if(isset($_POST['coupon1'])){
update_post_meta( $post_id, 'coupon1', $_POST['coupon1']);
}
if(isset($_POST['coupon2'])){
update_post_meta( $post_id, 'coupon2', $_POST['coupon2']);
}
if(isset($_POST['coupon3'])){
update_post_meta( $post_id, 'coupon3', $_POST['coupon3']);
}
if(isset($_POST['coupon4'])){
update_post_meta( $post_id, 'coupon4', $_POST['coupon4']);
}
if(isset($_POST['coupon5'])){
update_post_meta( $post_id, 'coupon5', $_POST['coupon5']);
}
}
add_action( 'save_post', 'fox_thongtin_save_coupon' );
// Hien thị cột hết han coupon
function fox_coupon_column_register( $columns ) {
    $columns['showscoupon'] = __('Coupon hết hạn', 'fox');
    return $columns;
}
add_filter( 'manage_edit-coupon_columns', 'fox_coupon_column_register' );
// Hien thị cột hết han coupon
function fox_coupon_column_display( $column_name, $post_id ) {
    global $post;
    if ( 'showscoupon' != $column_name )
    return;
	// ngay con han ma giam gia
	$coupon_datanow = date("d-m-Y");
	$coupon_data = get_post_meta( $post->ID, 'coupon3', true );
	$coupon_datacheck = str_replace('/', '-', $coupon_data);
	if(!empty($coupon_data) && strtotime($coupon_datanow) > strtotime($coupon_datacheck)){
	echo '<span style="color:red;font-weight:bold">'. __('Hết hạn', 'fox'). '</span>'; 
	} else {
	echo $coupon_data;
	}
	
}
add_action( 'manage_posts_custom_column', 'fox_coupon_column_display', 10, 2 );

// Hien thị cột shortcode coupon
function fox_coupon_shortcode_column_register( $columns ) {
    $columns['shortcodecoupon'] = __('Shortcode', 'fox');
    return $columns;
}
add_filter( 'manage_edit-coupon_columns', 'fox_coupon_shortcode_column_register' );
// Hien thị cột shortcode coupon
function fox_coupon_shortcode_column_display( $column_name, $post_id ) {
    global $post;
    if ( 'shortcodecoupon' != $column_name )
    return; ?>
	<input type="text" class="large-text code" value="[coupon id='<?php echo get_the_ID(); ?>']">
	<?php	
}
add_action( 'manage_posts_custom_column', 'fox_coupon_shortcode_column_display', 10, 2 );
// Shortcode hien thi coupon trong bai viet
function fox_create_coupon_shortcode($args, $content) {
ob_start(); ?>
<article class="coupon-card coupon-shortcode">
				    <div style="display:flex;">
						<div class="coupon-lon coupon-lon-shortcode">
						 <?php 
						 // phan tram giam gia
						 if( !empty(get_post_meta( $args['id'], 'coupon2', true )) ) { echo get_post_meta( $args['id'], 'coupon2', true ) . '%<br><span class="coupon-off">OFF</span>';  
						 } else { echo '<span class="coupon-no">'. __('NHẬN NGAY', 'fox') .'</span>'; } ?>
						 <?php
						 // ngay con han ma giam gia
						 $coupon_datanow = date("d-m-Y");
						 $coupon_data = get_post_meta( $args['id'], 'coupon3', true );
						 $coupon_datacheck = str_replace('/', '-', $coupon_data);
						 if(!empty($coupon_data) && strtotime($coupon_datanow) > strtotime($coupon_datacheck)){
							$coupon_checkdate = _('Hết hạn', 'fox'); 
						 } else {
							$coupon_checkdate = $coupon_data;
						 }
						 if( !empty($coupon_data) ) { 
						 echo '<span class="coupon-date">'. $coupon_checkdate .'</span>';  
						 } else { 
						 echo '<span class="coupon-date">'. __('COUPON', 'fox') . '</span>'; 
						 } ?>
						</div>
						<div class="coupon-nodung">
							<h2 style="font-size:19px;line-height: 1.3;margin:0px;"><a style="color:var(--textnote)" title="<?php the_title_attribute($args['id']); ?>" href="<?php echo the_permalink($args['id']); ?>" ><?php echo wp_trim_words( get_the_title($args['id']) , 18 ) ?></a></h2>
							<?php 
							// noi dung giam gia
							if( !empty(get_post_meta( $args['id'], 'coupon1', true )) ) { echo '<span>'. get_post_meta( $args['id'], 'coupon1', true ) . '</span>'; } ?>
							<div class="coupon-get">
							<?php 
							// ma giam gia
							if( !empty(get_post_meta( $args['id'], 'coupon4', true )) ) { 
							$couget = 'style="position: absolute;"';
							$couget_name = __('Nhận mã', 'fox');
							echo '<div class="coupon-ma">'. get_post_meta( $args['id'], 'coupon4', true ) . '</div>'; 
							} else {
							$couget = null;
							$couget_name = __('Xem', 'fox');
							} ?>
							<?php 
							// link giam gia
							if( !empty(get_post_meta( $args['id'], 'coupon5', true )) ) { echo '<div id="coupon-show-'. $args['id'] .'" class="coupon-link" '. $couget .'><i class="fa-regular fa-scissors"></i><a title="'. $couget_name .'" href="'. get_the_permalink($args['id']) . '" >'. $couget_name .'</a></div>'; } ?>
							</div>
						</div>
					</div>
</article>
<?php
return ob_get_clean();
}
add_shortcode( 'coupon', 'fox_create_coupon_shortcode' );
