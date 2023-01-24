<?php
// METABOX SLIDE HÌNH ẢNH TRONG BÀI VIẾT
add_action( 'add_meta_boxes', 'fox_photo_metabox' );
function fox_photo_metabox() {
$post_type_add = array('land', 'story', 'shop');
add_meta_box( 'mebox-photo', __('Thêm hình ảnh', 'fox'), 'fox_photo_metabox_post', $post_type_add, 'normal', 'high' );
}
function fox_photo_metabox_post($post) {
$photo1 = get_post_meta($post->ID,'photo1',true);
?>
<style type="text/css">
.add_hinhanh_class ul li .delete-img { position: absolute; right: 3px; top: 2px; background: #333; border-radius: 50%; cursor: pointer; font-size: 14px; line-height: 20px; color: #fff; }
.add_hinhanh_class ul li { width: 120px; display: inline-block; vertical-align: middle; margin: 5px; position: relative; line-height:0}
.add_hinhanh_class ul li img { width:120px;height:100px;object-fit: cover;object-position: 50% 50%;border-radius:12px;}
.button{margin-right: 2px !important;}
</style>
<div><?php echo fox_photo_metabox_get( 'photo1', $photo1 ); ?></div>
<script type="text/javascript">
jQuery(function($) {
$('body').on('click', '.them_hinhanh', function(e) {
e.preventDefault();
var button = $(this),
custom_uploader = wp.media({
title: '<?php _e('Thêm hình ảnh', 'fox'); ?>',
button: { text: '<?php _e('Chọn','fox'); ?>' },
multiple: true
}).on('select', function() {
var attech_ids = '';
attachments
var attachments = custom_uploader.state().get('selection'),
attachment_ids = new Array(),
i = 0;
attachments.each(function(attachment) {
attachment_ids[i] = attachment['id'];
attech_ids += ',' + attachment['id'];
if (attachment.attributes.type == 'image') {
$(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="' + attachment.attributes.url + '" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.url + '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>');
} else {
$(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="' + attachment.attributes.url + '" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.icon + '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>');
}
i++;
});
var ids = $(button).siblings('.attechments-ids').attr('value');
if (ids) {
var ids = ids + attech_ids;
$(button).siblings('.attechments-ids').attr('value', ids);
} else {
$(button).siblings('.attechments-ids').attr('value', attachment_ids);
}
$(button).siblings('.xoa_tat_hinhanh').show();
})
.open();
});
$('body').on('click', '.xoa_tat_hinhanh', function() {
$(this).hide().prev().val('').prev().addClass('button').html('<?php _e('Thêm ảnh', 'fox'); ?>');
$(this).parent().find('ul').empty();
return false;
});
});
jQuery(document).ready(function() {
jQuery(document).on('click', '.add_hinhanh_class ul li i.delete-img', function() {
var ids = [];
var this_c = jQuery(this);
jQuery(this).parent().remove();
jQuery('.add_hinhanh_class ul li').each(function() {
ids.push(jQuery(this).attr('data-attechment-id'));
});
jQuery('.add_hinhanh_class').find('input[type="hidden"]').attr('value', ids);
});
})
</script>
<?php
}
// Xử lý hình ảnh ở dưới post
function fox_photo_metabox_get($name, $value = '') {
$image = '">'.__('Thêm ảnh', 'fox');
$image_str = '';
$image_size = 'full';
$display = 'none';
$value = explode(',', $value);
if (!empty($value)) {
foreach ($value as $values) {
if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {
$image_str .= '<li data-attechment-id=' . $values . '><a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a><i class="dashicons dashicons-no delete-img"></i></li>';
}
}
}
if($image_str){
$display = 'inline-block';
}
return '<div class="add_hinhanh_class"><ul>' . $image_str . '</ul><a href="#" class="them_hinhanh button' . $image . '</a><input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" /><a href="#" class="xoa_tat_hinhanh button" style="display:inline-block;display:' . $display . '">'. __('Xoá hết', 'fox') .'</a></div>';
}
// Lưu Metabox hinh anh.
function add_hinhanh_save( $post_id ) {
if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
return;
}
if( !current_user_can( 'edit_post', $post_id ) ) {
return;
}
if( isset( $_POST['photo1'] ) ){
update_post_meta( $post_id, 'photo1', $_POST['photo1'] );
}
}
add_action( 'save_post', 'add_hinhanh_save' );



// Đưa hình ảnh vào bài viết Story
function fox_photo_show($content) {	
$id = get_the_ID();
$photo1 = get_post_meta($id, 'photo1', true);  
$photo1 = explode(',', $photo1);

if(is_singular('story')) {
ob_start();
if(!empty(get_post_meta($id, 'photo1', true))) {
foreach ($photo1 as $id) { ?>
<img width="100%" class="lazyload" src="<?php echo wp_get_attachment_url( $id );?>" />
<?php 
} }
$imgshow = ob_get_clean();
return $content . $imgshow;
} 

// them hinh anh vao post và land
else if(is_singular('land')) {
ob_start();
if(!empty(get_post_meta($id, 'photo1', true))) {
?>
    <div class="slide-photo">
    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
      <div class="swiper-wrapper" style="width:100%;">
	    <?php foreach ($photo1 as $id) { ?><div class="slide-photo1 swiper-slide"><a href="<?php echo wp_get_attachment_url( $id );?>" data-fancybox="gallery"  data-caption="<?php echo wp_trim_words( get_the_title() , 6 ) ?>"><img class="lazyload" src="<?php echo wp_get_attachment_url( $id );?>" /></a></div><?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="" class="swiper mySwiper">
      <div class="swiper-wrapper">
	  <?php foreach ($photo1 as $id) { ?><div class="slide-photo2 swiper-slide"><img class="lazyload" src="<?php echo wp_get_attachment_url( $id );?>" /></div><?php } ?>
      </div>
    </div>
	</div>
<?php
}
$imgshow = ob_get_clean();
return $imgshow . $content;
}
else { return $content; }
}
add_filter('the_content', 'fox_photo_show');

// load swiper slide
function fox_swiper_post() {
if(is_singular(array('post', 'land', 'shop'))) {
wp_enqueue_style('swiper-css', get_template_directory_uri() . '/inc/css/swiper.css',);
wp_enqueue_script('swiper-js', get_template_directory_uri() . '/inc/js/swiper.js',);
}
}
add_action('wp_footer', 'fox_swiper_post');