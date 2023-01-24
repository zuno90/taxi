<?php
// REGISTER POST TYPE: land
function create_post_type(){
    $label = array(
        'name' => __('Nhà đất', 'fox'),
    	'singular_name' => __('Nhà đất', 'fox'),
    	'add_new' => __('Thêm tin mới', 'fox'),
    	'add_new_item' => __('Thêm tin mới', 'fox'),
    	'edit_item' => __('Chỉnh sửa tin', 'fox'),
    	'new_item' => __('Tin', 'fox'),
    	'view_item' => __('Xem tin', 'fox'),
    	'search_items' => __('Tìm tin', 'fox'),
    	'not_found' => __('Không có tin nào', 'fox'),
    	'not_found_in_trash' => __('Không có tin nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả tin', 'fox'),
    	'menu_name' => __('Nhà đất', 'fox'),
    	'name_admin_bar' => __('Tin', 'fox'),
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
        'menu_icon'           => 'dashicons-format-aside', 
        'can_export'          => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'map_meta_cap'        => true,  
		'has_archive'         => 'land',
		'rewrite'             => array('slug' => 'land/%muc%'),

    );
 
    register_post_type('land', $args);
}
add_action( 'init', 'create_post_type' );
// custom chuyen muc code
function land_custom_taxonomy() {
    $labels = array(
        'name' => __('Loại', 'fox'),
        'singular' => __('Loại', 'fox'),
        'menu_name' => __('Loại', 'fox'),
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
		'rewrite' => array('slug' => 'land'),
		
    );
    register_taxonomy('muc', 'land' , $args);
}
add_action( 'init', 'land_custom_taxonomy', 0 );
// tao thu muc dong sau luu tru
function fox_create_land_link( $post_link, $id = 0 ){
$post = get_post($id);
if ( is_object( $post ) ){
$terms = wp_get_object_terms( $post->ID, 'muc' );
if( $terms ){
return str_replace( '%muc%' , $terms[0]->slug, $post_link );
} else {return str_replace( '%muc%' , 'muc', $post_link );}
}
return $post_link;
}
add_filter( 'post_type_link', 'fox_create_land_link', 1, 3 );
flush_rewrite_rules();




// khai bao thong tin
function fox_thongtin_meta_land()
{
add_meta_box( 'mebox-land', __('Thêm thông tin về bất động sản', 'fox'), 'fox_thongtin_output_land', 'land' );
}
add_action( 'add_meta_boxes', 'fox_thongtin_meta_land' );
 
// khai báo callback
function fox_thongtin_output_land( $post ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
$adress1 = get_post_meta( $post->ID, 'adress1', true );
$adress2 = get_post_meta( $post->ID, 'adress2', true );
$adress3 = get_post_meta( $post->ID, 'adress3', true );
$adress4 = get_post_meta( $post->ID, 'adress4', true );
$maps1 = get_post_meta( $post->ID, 'maps1', true );
$type1 = get_post_meta( $post->ID, 'type1', true );
$type2 = get_post_meta( $post->ID, 'type2', true );
$type3 = get_post_meta( $post->ID, 'type3', true );
$type4 = get_post_meta( $post->ID, 'type4', true );
$size1 = get_post_meta( $post->ID, 'size1', true );
$size2 = get_post_meta( $post->ID, 'size2', true );
$home1 = get_post_meta( $post->ID, 'home1', true );
$home2 = get_post_meta( $post->ID, 'home2', true );
$home3 = get_post_meta( $post->ID, 'home3', true );
$price1 = get_post_meta( $post->ID, 'price1', true );
$call1 = get_post_meta( $post->ID, 'call1', true );
$call2 = get_post_meta( $post->ID, 'call2', true );
$call3 = get_post_meta( $post->ID, 'call3', true );
$call4 = get_post_meta( $post->ID, 'call4', true );
?>
<div class="post-main">
<div class="post-test">Địa chỉ: 
<?php if(!empty($adress1) || !empty($adress2) || !empty($adress3)){ 
if(!empty($adress1)) {echo '<b>'. $adress1 . '</b> / ';} if(!empty($adress2)) {echo '<b>'. $adress2 .'</b>';} if(!empty($adress3)) {echo ' / <b>'. $adress3 .'</b>';} if(!empty($adress4)) {echo ' / <b>'. $adress4 .'</b>';}  
} ?>
</div>
<p>
<select name="adress1" class="adress1 post-sel" id="city">
<option data-id="" value="<?php echo esc_attr( $adress1 ); ?>" >Chọn tỉnh thành</option>        
</select>
          
<select name="adress2" class="adress2 post-sel" id="district" >
<option data-id="" value="<?php echo esc_attr( $adress2 ); ?>">Chọn quận huyện</option>
</select>

<select name="adress3" class="adress3 post-sel" id="ward" >
<option data-id="" value="<?php echo esc_attr( $adress3 ); ?>" >Chọn phường xã</option>
</select>
</p>
<p><input id="post-input" placeholder="Thôn / đường" type="text" name="adress4" value="<?php echo esc_attr( $adress4 ); ?>" /></p>

<div class="post-muc"><i class="fa-regular fa-map-pin"></i> Tọa độ bản đồ Google Maps</div>
<p><input id="post-input" placeholder="123456789, 123456789" type="text" name="maps1" value="<?php echo esc_attr( $maps1 ); ?>" /></p>

<div class="post-muc"><i class="fa-regular fa-arrow-down-big-small"></i> Thông tin</div>
<p>
<select class="post-sel" name="type1" >
<option value="" >Chọn đường</option>
<option value="Ô tô" <?php selected($type1, 'Ô tô'); ?>>Ô tô</option>
<option value="Xe máy" <?php selected($type1, 'Xe máy'); ?>>Xe máy</option>            
</select>
          
<select class="post-sel" name="type2" >
<option value="" >Chọn vị trí</option>
<option value="Mặt tiền" <?php selected($type2, 'Mặt tiền'); ?>>Mặt tiền</option>
<option value="Hẻm" <?php selected($type2, 'Hẻm'); ?>>Hẻm</option>  
</select>

<select class="post-sel" name="type3" >
<option value="" >Chọn hướng</option>
<option value="Đông" <?php selected($type3, 'Đông'); ?>>Đông</option>
<option value="Tây" <?php selected($type3, 'Tây'); ?>>Tây</option>
<option value="Nam" <?php selected($type3, 'Nam'); ?>>Nam</option>
<option value="Bắc" <?php selected($type3, 'Bắc'); ?>>Bắc</option>
<option value="Đông Bắc" <?php selected($type3, 'Đông Bắc'); ?>>Đông Bắc</option>
<option value="Tây Bắc" <?php selected($type3, 'Tây Bắc'); ?>>Tây Bắc</option>
<option value="Đông Nam" <?php selected($type3, 'Đông Nam'); ?>>Đông Nam</option>
<option value="Tây Nam" <?php selected($type3, 'Tây Nam'); ?>>Tây Nam</option>
</select>

<select class="post-sel" name="type4" >
<option value="" >Chọn pháp lý</option>
<option value="Sổ đỏ" <?php selected($type4, 'Sổ đỏ'); ?>>Sổ đỏ</option>
<option value="Sổ hồng" <?php selected($type4, 'Sổ hồng'); ?>>Sổ hồng</option>
<option value="Sổ chung" <?php selected($type4, 'Sổ chung'); ?>>Sổ chung</option>
<option value="Hợp đồng" <?php selected($type4, 'Hợp đồng'); ?>>Hợp đồng</option> 
<option value="Viết tay" <?php selected($type4, 'Viết tay'); ?>>Viết tay</option>  
</select>
</p>
<div class="post-muc"><i class="fa-regular fa-arrow-up-right-from-square"></i> Diện tích (đất hoặc nhà ở) / đơn vị: M</div>
<p style="display:flex">
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" placeholder="Chiều rộng" type="number" name="size1" value="<?php echo esc_attr( $size1 ); ?>" />
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" placeholder="Chiều dài" type="number" name="size2" value="<?php echo esc_attr( $size2 ); ?>" />
</p>
<div class="post-muc"><i class="fa-regular fa-person-booth"></i> Tiện ích (nhà ở / chung cư / căn hộ)</div>
<p style="display:flex">
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2"  placeholder="Số tầng" type="number" name="home1" value="<?php echo esc_attr( $home1 ); ?>" />
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2"  placeholder="Số phòng ngũ" type="number" name="home2" value="<?php echo esc_attr( $home2 ); ?>" />
<input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2"  placeholder="Số phòng tắm" type="number" name="home3" value="<?php echo esc_attr( $home3 ); ?>" />
</p>
<div class="post-muc"><i class="fa-regular fa-coins"></i> Giá bán / đơn vị: VNĐ</div>
<p>
<div class="post-test">Giá bán: <span id="ratien"><?php if(!empty($price1)){ echo fox_number($price1); } else {echo '0';} ?></span> đồng</div>
<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Giá bán" type="number" name="price1" id="nhaptien" value="<?php echo esc_attr( $price1 ); ?>" />
</p>
<div class="post-muc"><i class="fa-regular fa-phone"></i> Người mua liên hệ với bạn?</div>
<p><input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="Số diện thoại" type="number" name="call1" value="<?php echo esc_attr( $call1 ); ?>" /></p>
<p><input id="post-input" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="Số Zalo" type="number" name="call2" value="<?php echo esc_attr( $call2 ); ?>" /></p>
<p><input id="post-input" placeholder="ID Facebook" type="text" name="call3" value="<?php echo esc_attr( $call3 ); ?>" /></p>
<p><input id="post-input" placeholder="Email" type="text" name="call4" value="<?php echo esc_attr( $call4 ); ?>" /></p>
</div>
<script>
// check số tiền nhập vào
const node = document.getElementById("nhaptien");
node.addEventListener("keyup", function(event) {
var n = document.getElementById("nhaptien").value; 
  const formatCash = n => {
  if (n < 1e3) return n;
  if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(2) + " nghìn";
  if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(2) + " triệu";
  if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(2) + " tỷ";
  if (n >= 1e12) return +(n / 1e12).toFixed(1) + " ngàn tỷ";     
  };
  document.getElementById("ratien").innerHTML = formatCash(n);
});
</script>
<?php }
// Lưu dữ liệu và tạo nonce bảo mật
function fox_thongtin_save_land( $post_id ) {
if(isset($_POST['thongtin_nonce'])){
$thongtin_nonce = $_POST['thongtin_nonce'];
}
if( !isset( $thongtin_nonce ) ) {
return;
}
if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
return;
}
if(isset($_POST['adress1'])){
update_post_meta( $post_id, 'adress1', sanitize_text_field( $_POST['adress1'] ));
}
if(isset($_POST['adress2'])){
update_post_meta( $post_id, 'adress2', sanitize_text_field( $_POST['adress2'] ));
}
if(isset($_POST['adress3'])){
update_post_meta( $post_id, 'adress3', sanitize_text_field( $_POST['adress3'] ));
}
if(isset($_POST['adress4'])){
update_post_meta( $post_id, 'adress4', sanitize_text_field( $_POST['adress4'] ));
}
if(isset($_POST['maps1'])){
update_post_meta( $post_id, 'maps1', sanitize_text_field( $_POST['maps1'] ));
}
if(isset($_POST['type1'])){
update_post_meta( $post_id, 'type1', sanitize_text_field( $_POST['type1'] ));
}
if(isset($_POST['type2'])){
update_post_meta( $post_id, 'type2', sanitize_text_field( $_POST['type2'] ));
}
if(isset($_POST['type3'])){
update_post_meta( $post_id, 'type3', sanitize_text_field( $_POST['type3'] ));
}
if(isset($_POST['type4'])){
update_post_meta( $post_id, 'type4', sanitize_text_field( $_POST['type4'] ));
}
if(isset($_POST['size1'])){
update_post_meta( $post_id, 'size1', sanitize_text_field( $_POST['size1'] ));
}
if(isset($_POST['type2'])){
update_post_meta( $post_id, 'size2', sanitize_text_field( $_POST['size2'] ));
}
if(isset($_POST['size1']) && isset($_POST['size2'])){
if(!empty($_POST['size1']) && !empty($_POST['size2'])){
$size3 = $_POST['size1'] * $_POST['size2'];
} else {
$size3 = null;
}
update_post_meta( $post_id, 'size3', sanitize_text_field( $size3 ));
}
if(isset($_POST['home1'])){
update_post_meta( $post_id, 'home1', sanitize_text_field( $_POST['home1'] ));
}
if(isset($_POST['home2'])){
update_post_meta( $post_id, 'home2', sanitize_text_field( $_POST['home2'] ));
}
if(isset($_POST['home3'])){
update_post_meta( $post_id, 'home3', sanitize_text_field( $_POST['home3'] ));
}
if(isset($_POST['price1'])){
update_post_meta( $post_id, 'price1', sanitize_text_field( $_POST['price1'] ));
}
if(isset($_POST['call1'])){
update_post_meta( $post_id, 'call1', sanitize_text_field( $_POST['call1'] ));
}
if(isset($_POST['call2'])){
update_post_meta( $post_id, 'call2', sanitize_text_field( $_POST['call2'] ));
}
if(isset($_POST['call3'])){
update_post_meta( $post_id, 'call3', sanitize_text_field( $_POST['call3'] ));
}
if(isset($_POST['call4'])){
update_post_meta( $post_id, 'call4', sanitize_text_field( $_POST['call4'] ));
}
}
add_action( 'save_post', 'fox_thongtin_save_land' );

// load land index
function fox_loading_scripts_land_index() {
if(!is_singular('post')) {
wp_enqueue_script('js-land1', get_template_directory_uri() . '/inc/js/axios-land.min.js',);
wp_enqueue_script('js-land-data', get_template_directory_uri() . '/inc/js/data-land-index.js',);
}
}
add_action('wp_footer', 'fox_loading_scripts_land_index');
add_action('admin_footer', 'fox_loading_scripts_land_index');

// hien thi land ra trang chu
add_filter('pre_get_posts','fox_custom_post_type');
function fox_custom_post_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('land'));
    return $query;
}
// chuyen so tien qua so tiền rút gọn
function fox_number($number)
{
    $abbrevs = [12 => 'ngàn tỷ', 9 => 'tỷ', 6 => 'triệu', 3 => 'nghìn', 0 => ''];
    foreach ($abbrevs as $exponent => $abbrev) {
        if (abs($number) >= pow(10, $exponent)) {
            $display = $number / pow(10, $exponent);
            $number = round($display, 2).' '.$abbrev;
            break;
        }
    }
    return $number;
}


// Add bộ lọc land
$link_land1 = "Bộ lọc bất động sản";
if (get_page_by_title($link_land1) == NULL ){
$my_post_land1 = array(
	  'import_id'			  => 1000,
      'post_title'    => $link_land1,
      'post_status'   => 'publish',
	  'page_template' => 'search-land.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'search-land'
    );
wp_insert_post( $my_post_land1 );
}
global $land_options; 
if(isset($land_options['login0'])){
// Quan ly manager
$link_land2 = "Quản lý tin";
if (get_page_by_title($link_land2) == NULL ){
$my_post_land2 = array(
	  'import_id'			  => 1001,	
      'post_title'    => $link_land2,
      'post_status'   => 'publish',
	  'page_template' => 'land-manager.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'land-manager'
    );
wp_insert_post( $my_post_land2 );
}
// Dang tin
$link_land3 = "Đăng tin";
if (get_page_by_title($link_land3) == NULL ){
$my_post_land3 = array(
	  'import_id'			  => 1002,
      'post_title'    => $link_land3,
      'post_status'   => 'publish',
	  'page_template' => 'land-post.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'land-post'
    );
wp_insert_post( $my_post_land3 );
}
// Sua tin
$link_land4 = "Sửa tin";
if (get_page_by_title($link_land4) == NULL ){
$my_post_land4 = array(
	  'import_id'			  => 1003,
      'post_title'    => $link_land4,
      'post_status'   => 'publish',
	  'page_template' => 'land-edit.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'land-edit'
    );
wp_insert_post( $my_post_land4 );
}
} else {
wp_delete_post(1001);
wp_delete_post(1002);
wp_delete_post(1003);
}



