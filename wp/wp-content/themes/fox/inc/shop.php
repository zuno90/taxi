<?php
// REGISTER POST TYPE: Shop
function fox_shop_create_post_type(){
    $label = array(
        'name' => __('Mặt hàng', 'fox'),
    	'singular_name' => __('Mặt hàng', 'fox'),
    	'add_new' => __('Thêm mặt hàng', 'fox'),
    	'add_new_item' => __('Thêm mặt hàng', 'fox'),
    	'edit_item' => __('Chỉnh sửa mặt hàng', 'fox'),
    	'new_item' => __('Mặt hàng', 'fox'),
    	'view_item' => __('Xem mặt hàng', 'fox'),
    	'search_items' => __('Tìm mặt hàng', 'fox'),
    	'not_found' => __('Không có mặt hàng nào', 'fox'),
    	'not_found_in_trash' => __('Không có mặt hàng nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả mặt hàng', 'fox'),
    	'menu_name' => __('Mặt hàng', 'fox'),
    	'name_admin_bar' => __('Mặt hàng', 'fox'),
    );
 
    $args = array(
        'labels'              => $label,
        'supports'            => array( 'title', 'editor', 'parent', 'revisions', 'thumbnail', 'comments'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true, 
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true, 
        'show_in_admin_bar'   => true,
        'menu_position'       => 5, 
        'menu_icon'           => 'dashicons-cart', 
        'can_export'          => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'map_meta_cap'        => true,  
		'has_archive'         => 'shop',
		'rewrite'             => array('slug' => 'shop/%type%'),

    );
 
    register_post_type('shop', $args);
}
add_action( 'init', 'fox_shop_create_post_type' );
// custom chuyen type code
function fox_shop_custom_taxonomy() {
    $labels = array(
        'name' => __('Danh mục', 'fox'),
        'singular' => __('Danh mục', 'fox'),
        'menu_name' => __('Danh mục', 'fox'),
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
		'rewrite' => array('slug' => 'shop'),
		
    );
    register_taxonomy('type', 'shop' , $args);
}
add_action( 'init', 'fox_shop_custom_taxonomy', 0 );
// tao thu type dong sau luu tru
function fox_create_shop_link( $post_link, $id = 0 ){
$post = get_post($id);
if ( is_object( $post ) ){
$terms = wp_get_object_terms( $post->ID, 'type' );
if( $terms ){
return str_replace( '%type%' , $terms[0]->slug, $post_link );
} else {return str_replace( '%type%' , 'type', $post_link );}
}
return $post_link;
}
add_filter( 'post_type_link', 'fox_create_shop_link', 1, 3 );
flush_rewrite_rules();




// khai bao thong tin
function fox_thongtin_meta_shop()
{
add_meta_box( 'mebox-shop', __('Thêm thông tin về mặt hàng', 'fox'), 'fox_thongtin_output_shop', 'shop' );
}
add_action( 'add_meta_boxes', 'fox_thongtin_meta_shop' );
 
// khai báo callback
function fox_thongtin_output_shop( $post ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
$price1 = get_post_meta( $post->ID, 'price1', true );
$deal1 = get_post_meta( $post->ID, 'deal1', true );
$affiliate1 = get_post_meta( $post->ID, 'affiliate1', true );
$affiliate2 = get_post_meta( $post->ID, 'affiliate2', true );
$affiliate3 = get_post_meta( $post->ID, 'affiliate3', true );
$affiliate4 = get_post_meta( $post->ID, 'affiliate4', true );
$affiliate5 = get_post_meta( $post->ID, 'affiliate5', true );
$affiliate6 = get_post_meta( $post->ID, 'affiliate6', true );
?>
<div class="post-main">
<div class="post-muc"><i class="fa-regular fa-coins"></i> <?php _e('Giá bán', 'fox'); ?></div>
<p>
<div class="post-test"><?php _e('Giá bán', 'fox'); ?> <span id="ratien"><?php if(!empty($price1)){ echo fox_number($price1); } else {echo '0';} ?></span></div>
<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="<?php _e('Giá bán', 'fox'); ?>" type="number" name="price1" id="nhaptien" value="<?php echo esc_attr( $price1 ); ?>" />
</p>
<div class="post-muc"><i class="fa-regular fa-badge-percent"></i> <?php _e('Phần trăm giảm giá', 'fox'); ?></div>
<p>
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="<?php _e('Nhập phần trăm giảm giá', 'fox'); ?>" type="number" name="deal1" id="nhaptien" value="<?php echo esc_attr( $deal1 ); ?>" />
</p>
<div class="post-muc"><i class="fa-regular fa-link"></i> <?php _e('Liên kết tiếp thị', 'fox'); ?></div>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Shopee', 'fox'); ?>" type="text" name="affiliate1" value="<?php echo esc_attr( $affiliate1 ); ?>" /></p>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Tiki', 'fox'); ?>" type="text" name="affiliate2" value="<?php echo esc_attr( $affiliate2 ); ?>" /></p>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Lazada', 'fox'); ?>" type="text" name="affiliate3" value="<?php echo esc_attr( $affiliate3 ); ?>" /></p>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Sendo', 'fox'); ?>" type="text" name="affiliate4" value="<?php echo esc_attr( $affiliate4 ); ?>" /></p>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Amazon', 'fox'); ?>" type="text" name="affiliate5" value="<?php echo esc_attr( $affiliate5 ); ?>" /></p>
<p><input id="post-input" placeholder="<?php _e('Liên kết tiếp thị Banggood', 'fox'); ?>" type="text" name="affiliate6" value="<?php echo esc_attr( $affiliate6 ); ?>" /></p>
</div>
<script>
// check số tiền nhập vào
const node = document.getElementById("nhaptien");
node.addEventListener("keyup", function(event) {
var n = document.getElementById("nhaptien").value; 
  const formatCash = n => {
  if (n < 1e3) return n;
  if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(2) + " <?php _e('nghìn', 'fox'); ?>";
  if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(2) + " <?php _e('triệu', 'fox'); ?>";
  if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(2) + " <?php _e('tỷ', 'fox'); ?>";
  if (n >= 1e12) return +(n / 1e12).toFixed(1) + " <?php _e('ngàn tỷ', 'fox'); ?>";     
  };
  document.getElementById("ratien").innerHTML = formatCash(n);
});
</script>
<?php }
// Lưu dữ liệu và tạo nonce bảo mật
function fox_thongtin_save_shop( $post_id ) {
if(isset($_POST['thongtin_nonce'])){
$thongtin_nonce = $_POST['thongtin_nonce'];
}
if( !isset( $thongtin_nonce ) ) {
return;
}
if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
return;
}
if(isset($_POST['price1'])){
update_post_meta( $post_id, 'price1', sanitize_text_field( $_POST['price1'] ));
}
if(isset($_POST['deal1'])){
update_post_meta( $post_id, 'deal1', sanitize_text_field( $_POST['deal1'] ));
}
if(isset($_POST['affiliate1'])){
update_post_meta( $post_id, 'affiliate1', sanitize_text_field( $_POST['affiliate1'] ));
}
if(isset($_POST['affiliate2'])){
update_post_meta( $post_id, 'affiliate2', sanitize_text_field( $_POST['affiliate2'] ));
}
if(isset($_POST['affiliate3'])){
update_post_meta( $post_id, 'affiliate3', sanitize_text_field( $_POST['affiliate3'] ));
}
if(isset($_POST['affiliate4'])){
update_post_meta( $post_id, 'affiliate4', sanitize_text_field( $_POST['affiliate4'] ));
}
if(isset($_POST['affiliate5'])){
update_post_meta( $post_id, 'affiliate5', sanitize_text_field( $_POST['affiliate5'] ));
}
if(isset($_POST['affiliate6'])){
update_post_meta( $post_id, 'affiliate6', sanitize_text_field( $_POST['affiliate6'] ));
}
}
add_action( 'save_post', 'fox_thongtin_save_shop' );
// hien thi shop ra trang chu
function fox_shop_home_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('shop'));
    return $query;
}
add_filter('pre_get_posts','fox_shop_home_type');
// chuyen so tien qua so tiền rút gọn
function fox_number($number)
{
    $abbrevs = [12 => __('ngàn tỷ', 'fox'), 9 => __('tỷ', 'fox'), 6 => __('triệu', 'fox'), 3 => __('nghìn', 'fox'), 0 => ''];
    foreach ($abbrevs as $exponent => $abbrev) {
        if (abs($number) >= pow(10, $exponent)) {
            $display = $number / pow(10, $exponent);
            $number = round($display, 2).' '.$abbrev;
            break;
        }
    }
    return $number;
}
