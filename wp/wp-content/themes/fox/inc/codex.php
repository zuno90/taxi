<?php
// REGISTER POST TYPE: Codex
global $codex_options;
function fox_codex_create_post_type(){
    $label = array(
        'name' => __('Codex', 'fox'),
    	'singular_name' => __('Codex', 'fox'),
    	'add_new' => __('Thêm codex', 'fox'),
    	'add_new_item' => __('Thêm codex', 'fox'),
    	'edit_item' => __('Chỉnh sửa codex', 'fox'),
    	'new_item' => __('Codex', 'fox'),
    	'view_item' => __('Xem codex', 'fox'),
    	'search_items' => __('Tìm codex', 'fox'),
    	'not_found' => __('Không có codex nào', 'fox'),
    	'not_found_in_trash' => __('Không có codex nào trong thùng rác', 'fox'),
    	'all_items' => __('Tất cả codex', 'fox'),
    	'menu_name' => __('Codex', 'fox'),
    	'name_admin_bar' => __('Codex', 'fox'),
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
        'menu_icon'           => 'dashicons-editor-code', 
        'can_export'          => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
		'map_meta_cap'        => true,  
		'has_archive'         => 'codex',
		'rewrite'             => array('slug' => 'codex/%run%'),

    );
 
    register_post_type('codex', $args);
}
add_action( 'init', 'fox_codex_create_post_type' );
// custom chuyen run codex
function fox_codex_custom_taxonomy() {
    $labels = array(
        'name' => __('Chuyên mục', 'fox'),
        'singular' => __('Chuyên mục', 'fox'),
        'menu_name' => __('Chuyên mục', 'fox'),
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
		'rewrite' => array('slug' => 'codex'),
		
    );
    register_taxonomy('run', 'codex' , $args);
}
add_action( 'init', 'fox_codex_custom_taxonomy', 0 );
// tao thu run dong sau luu tru
function fox_create_codex_link( $post_link, $id = 0 ){
$post = get_post($id);
if ( is_object( $post ) ){
$terms = wp_get_object_terms( $post->ID, 'run' );
if( $terms ){
return str_replace( '%run%' , $terms[0]->slug, $post_link );
} else {return str_replace( '%run%' , 'run', $post_link );}
}
return $post_link;
}
add_filter( 'post_type_link', 'fox_create_codex_link', 1, 3 );
flush_rewrite_rules();

// khai bao thong tin
function fox_thongtin_meta_codex()
{
add_meta_box( 'mebox-codex', __('Thêm: HTML / CSS / JAVASCRIPT / JQUERY', 'fox'), 'fox_thongtin_output_codex', 'codex' );
}
add_action( 'add_meta_boxes', 'fox_thongtin_meta_codex' );
 
// khai báo callback
function fox_thongtin_output_codex( $post ) {
wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
$codex1 = get_post_meta( $post->ID, 'codex1', true );
?>
<div class="post-main">
<p class="admin-flex"><input type="text" id="inputcopi" value="<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>"></input><span onclick="codecopi()"><i class="fa-regular fa-copy"></i></span></p>
<p class="post-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thêm jQuery CDN nếu bạn muốn viết lệnh về nó', 'fox'); ?></p>
<textarea id="setjq" class="admin-code-textarea fox-codex" style="width:100%;border:2px solid #ccc;height:450px;white-space: pre-wrap;" name="codex1"><?php echo esc_textarea( $codex1 ); ?></textarea>
</div>
<?php }
// Lưu dữ liệu và tạo nonce bảo mật
function fox_thongtin_save_codex( $post_id ) {
if(isset($_POST['thongtin_nonce'])){
$thongtin_nonce = $_POST['thongtin_nonce'];
}
if( !isset( $thongtin_nonce ) ) {
return;
}
if( !wp_verify_nonce( $thongtin_nonce, 'save_thongtin' ) ) {
return;
}
if(isset($_POST['codex1'])){
update_post_meta( $post_id, 'codex1', $_POST['codex1']);
}
}
add_action( 'save_post', 'fox_thongtin_save_codex' );
// hien thi codex ra trang chu
if (isset($codex_options['enable'])){
function fox_codex_home_type($query) {
  if (is_home() && $query->is_main_query ())
    $query->set ('post_type', array ('codex'));
    return $query;
}
add_filter('pre_get_posts','fox_codex_home_type');
}
// Shortcode hien thi codex trong bai viet
function fox_create_codex_shortcode($args, $content) {
global $post;
return '<div class="codex-code"><div class="codex-code-link"><a target="_blank" title="'. __('Trang thử nghiệm', 'fox') .'" href="'. get_permalink($args['id']) .'" >'. __('Trang thử nghiệm', 'fox') .' <i class="fa-regular fa-arrow-right"></i></a></div><embed src="'. get_permalink($args['id']) .'"></div>';
}
add_shortcode( 'codex', 'fox_create_codex_shortcode' );
// Shortcode hien thi nut toi codex trong bai viet
function fox_create_codex_link_shortcode($args, $content) {
global $post;
return '<div class="codex-link"><a target="_blank" title="'. __('Thử nghiệm mã', 'fox') .'" href="'. get_permalink($args['id']) .'">'. __('Thử nghiệm mã', 'fox') .' <i class="fa-regular fa-arrow-right"></i></a></div>';
}
add_shortcode( 'codet', 'fox_create_codex_link_shortcode' );
// Tạo cột quản lý 
function price_column_register( $columns ) {
    $columns['codex'] = __('Shorcode: Code/Link', 'fox');
    return $columns;
}
add_filter( 'manage_edit-codex_columns', 'price_column_register' );
// Tạo cột quản lý 
function fox_price_column_display( $column_name, $post_id ) {
    global $post;
    if ( 'codex' != $column_name )
    return; ?>
	<p>
	<span><?php _e('Hộp thử nghiệm', 'fox'); ?></span>
    <input type="text" class="large-text code" value="[codex id='<?php echo get_the_ID(); ?>']">
	</p>
	<p>
	<span><?php _e('Tới trang thử nghiệm', 'fox'); ?></span>
	<input type="text" class="large-text code" value="[codet id='<?php echo get_the_ID(); ?>']">
	</p>
	<?php
}
add_action( 'manage_posts_custom_column', 'fox_price_column_display', 10, 2 );
// add top style
function fox_add_top_codex(){ ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/inc/codex/css/codemirror.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/inc/codex/css/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/fox/main/css/all.css">
<?php
}
add_action('fox_topcodex', 'fox_add_top_codex');
// add bottom script 
function fox_add_bottom_codex(){ ?>
<script src="<?php echo get_template_directory_uri() ?>/inc/codex/js/codemirror.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/inc/codex/js/xuly.js"></script>
<?php
}
add_action('fox_bottomcodex', 'fox_add_bottom_codex');

