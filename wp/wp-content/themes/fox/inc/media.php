<?php
global $media_options;
# bộ lọc ngăn crop hình ảnh tải lên
if (isset($media_options['sel1'])){
function fox_tat_crop( $enable, $orig_w, $orig_h, $dest_w, $dest_h, $crop ){
return false;
}
add_filter( 'image_resize_dimensions', 'fox_tat_crop', 10, 6 );
function fox_tat_image_sizes() {
foreach ( get_intermediate_image_sizes() as $size ) {
remove_image_size( $size );
}
}
add_action( 'init', 'fox_tat_image_sizes' );
}
# han che tai len file 
if (isset($media_options['sel2']) && !empty($media_options['size'])){ 
function fox_change_upload_size(){
global $media_options;
if(!empty($media_options['sel21'])){
$mlimit = $media_options['sel21'];
} else {
$mlimit = 100000;	
}
return 1000 * $mlimit;
}
add_filter( 'upload_size_limit', 'fox_change_upload_size' );
}
# Xóa bài viết sẽ xóa luôn hình ảnh đính kèm trong post story land
if (isset($media_options['sel3'])){
function fox_delete_all_attached_media( $post_id ) {
if(get_post_type($post_id) == "post" || get_post_type($post_id) == "story" || get_post_type($post_id) == "land" ) {
$attachments = get_attached_media( '', $post_id );
foreach ($attachments as $attachment) {
wp_delete_attachment( $attachment->ID, 'true' );
}
$photo1 = get_post_meta($post_id, 'photo1', true);  
$photo1 = explode(',', $photo1);
foreach ($photo1 as $id) {
wp_delete_attachment( $id, 'true' );
}
}
}
add_action( 'before_delete_post', 'fox_delete_all_attached_media' );
}
# images center
if(isset($media_options['sel4'])){
function fox_images_center_footer(){
if (is_single()){
ob_start();	?>
<style>.noidung-tomtat img{margin: auto auto 10px auto !important;display: block !important;}</style>
<?php }
echo ob_get_clean();
}
add_action('wp_footer', 'fox_images_center_footer');
}