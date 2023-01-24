<?php
/*
 Template Name: Land edit
 */
 get_header(); 
  global $land_options;
 ?>
<main>
<div class="box-card">
<div style="padding:20px;">
<div class="lienquan-title"><i class="fa-regular fa-bolt"></i> Sửa tin của bạn
<span class="xemthem" style="float:right;margin-top:0px"><a href="<?php bloginfo('url'); ?>/land-manager"><i class="fa-solid fa-arrow-left"></i> Quay lại</a></span>
</div>
<?php
$post_id = !empty($_GET['id']) ? trim(strip_tags(stripslashes($_GET['id']))) : ''; 
if(is_user_logged_in() && get_post($post_id) && !empty($_GET['id'])) {   
wp_enqueue_media();   

$current_user = wp_get_current_user(); 
$userid = $current_user->ID; $curpost = get_post( $post_id ); 
$userlevel = $current_user->user_level;

// thoi gian vip 1
$current_user = wp_get_current_user(); $vipuserid = $current_user->ID;
$ngaysosanh = get_the_author_meta( 'vipend', $vipuserid ); 
$ngaysosanh = str_replace('/', '-', $ngaysosanh);
$ngayhomnay = date("d-m-Y"); 
if($userlevel >= 10 || current_user_can('vip') || (!empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) <= strtotime($ngaysosanh))) { $dangbai = "publish"; } else { $dangbai = "pending"; }
// kiem tra quyen sua bai cua user
$checkuser = $curpost->post_author;

if ($userid == $checkuser || $userlevel > 2 ) { 
    if( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST['add_new_post'] ) && current_user_can('level_0') && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' )) {
            if (isset($_POST['post_title'])) {
                $post_title = $_POST['post_title'];
            }
            if (isset($_POST['post_content'])) {
                $post_content = $_POST['post_content'];
            }
            if (isset ($_POST['post_category'])) {
                $post_category = $_POST['post_category'];
            } 
			if( $post_title == "" || $post_content == "") {
                $thongbao = '<div class="pe-land-tb-er">Vui lòng không bỏ trống những thông tin bắt buộc</div>';
			} else {
             
				$post = array(
				'ID' => $post_id,
				'post_title'    => wp_strip_all_tags($post_title),
				'post_status' => 'pending',
				'post_content'  => $post_content,
				'post_type' => 'land',
				'post_status'   => $dangbai,
				'comment_status' => 'open',
			    'ping_status' => 'closed',
				);
				$post_dang = wp_insert_post($post);
				
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
				
				wp_set_object_terms($post_dang, $post_category, 'muc'); ?>
				<script>window.location.replace("<?php bloginfo('url'); ?>/land-manager");</script>
				<?php
				$thongbao = '<div class="pe-land-tb-tc">Sửa nội dung thành công</div>';
	        }
	} 

			$adress1 = get_post_meta( $post_id, 'adress1', true );
			$adress2 = get_post_meta( $post_id, 'adress2', true );
			$adress3 = get_post_meta( $post_id, 'adress3', true );
			$adress4 = get_post_meta( $post_id, 'adress4', true );
			$maps1 = get_post_meta( $post_id, 'maps1', true );
			$type1 = get_post_meta( $post_id, 'type1', true );
			$type2 = get_post_meta( $post_id, 'type2', true );
			$type3 = get_post_meta( $post_id, 'type3', true );
			$type4 = get_post_meta( $post_id, 'type4', true );
			$size1 = get_post_meta( $post_id, 'size1', true );
			$size2 = get_post_meta( $post_id, 'size2', true );
			$home1 = get_post_meta( $post_id, 'home1', true );
			$home2 = get_post_meta( $post_id, 'home2', true );
			$home3 = get_post_meta( $post_id, 'home3', true );
			$price1 = get_post_meta( $post_id, 'price1', true );
			$call1 = get_post_meta( $post_id, 'call1', true );
			$call2 = get_post_meta( $post_id, 'call2', true );
			$call3 = get_post_meta( $post_id, 'call3', true );
			$call4 = get_post_meta( $post_id, 'call4', true );

?>
            <form id="new_post" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
				<div class="pe-land-meta">
				<div class="pe-land-tit"><i class="fa-regular fa-note"></i> Tiêu đề tin</div>
				
                <input type="text" name="post_title" id="tde-hoi" value="<?php echo get_the_title($post_id) ;?>" class="form-control" placeholder="Tiêu đề">
				
				<div class="pe-land-tit"><i class="fa-regular fa-note"></i> Nội dung tin</div>
				
				<?php  $post = get_post( $post_id, OBJECT, 'edit' ); $content = $post->post_content; ?>
				<textarea class="ep-editor" name="post_content" id="post_content" cols="30" rows="10" placeholder="Nội dung tin..."><?php echo $content ?></textarea>
				  
				<div class="pe-land-tit"><i class="fa-regular fa-images"></i> Hình ảnh đính kèm</div>	
				
				<div class="pe-land-side">
				<?php echo fox_photo_metabox_post($post); ?>
				</div>
				<div class="pe-land-tit"><i class="fa-regular fa-location-dot"></i> Địa chỉ nhà đất</div>
				<div class="pe-land-note">Địa chỉ: 
				<?php if(!empty($adress1) || !empty($adress2) || !empty($adress3)){ 
				if(!empty($adress1)) {echo '<b>'. $adress1 . '</b> / ';} if(!empty($adress2)) {echo '<b>'. $adress2 .'</b>';} if(!empty($adress3)) {echo ' / <b>'. $adress3 .'</b>';} if(!empty($adress4)) {echo ' / <b>'. $adress4 .'</b>';}  
				} ?>
				</div>
				
				<div class="pe-land-grid-3">
				<div class="fox-select input-wrapper">
				<select name="adress1" class="adress1" id="city">
				<option data-id="" value="<?php echo esc_attr( $adress1 ); ?>">Chọn tỉnh thành</option>
				</select>
				<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
				</div>
					

				<div class="fox-select input-wrapper">	
				<select name="adress2" class="adress2" id="district" >
				<option data-id="" value="<?php echo esc_attr( $adress2 ); ?>">Chọn quận huyện</option>
				</select>
				<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
                </div>

                <div class="fox-select input-wrapper">
				<select name="adress3" class="adress3" id="ward" >
				<option data-id="" value="<?php echo esc_attr( $adress3 ); ?>" >Chọn phường xã</option>
				</select>
				<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
				</div>
				
				</div>
				
				<input placeholder="Thôn / đường" type="text" name="adress4" value="<?php echo esc_attr( $adress4 ); ?>" />

				<div class="pe-land-tit"><i class="fa-regular fa-map-pin"></i> Tọa độ Google Maps</div>
				
				<input placeholder="123456789, 123456789" type="text" name="maps1" value="<?php echo esc_attr( $maps1 ); ?>" />

				<?php if(!empty(get_post_meta( $post->ID, 'maps1', true ))) { echo '<div class="box-land-maps" style="margin-bottom:10px;">
				<iframe src="https://www.google.com/maps?q='. get_post_meta( $post->ID, 'maps1', true ) .'&output=embed" width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>'; } ?>	
					
				
				<div class="pe-land-tit"><i class="fa-regular fa-arrow-down-big-small"></i> Thông tin</div>
				
				<div class="pe-land-grid-4">
				
				<div class="fox-select input-wrapper">
				<select name="type1" >
				<option value="" >Chọn đường</option>
				<option value="Ô tô" <?php selected($type1, 'Ô tô'); ?>>Ô tô</option>
				<option value="Xe máy" <?php selected($type1, 'Xe máy'); ?>>Xe máy</option>            
				</select>
				<label for="stuff" class="fa-regular fa-road input-land-icon"></label>
				</div>	

				<div class="fox-select input-wrapper">	
				<select name="type2" >
				<option value="" >Chọn vị trí</option>
				<option value="Mặt tiền" <?php selected($type2, 'Mặt tiền'); ?>>Mặt tiền</option>
				<option value="Hẻm" <?php selected($type2, 'Hẻm'); ?>>Hẻm</option>  
				</select>
				<label for="stuff" class="fa-regular fa-street-view input-land-icon"></label>
				</div>

				<div class="fox-select input-wrapper">
				<select name="type3" >
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
				<label for="stuff" class="fa-regular fa-compass input-land-icon"></label>
				</div>
                
				<div class="fox-select input-wrapper">
				<select name="type4" >
				<option value="" >Chọn pháp lý</option>
				<option value="Sổ đỏ" <?php selected($type4, 'Sổ đỏ'); ?>>Sổ đỏ</option>
				<option value="Sổ hồng" <?php selected($type4, 'Sổ hồng'); ?>>Sổ hồng</option>
				<option value="Sổ chung" <?php selected($type4, 'Sổ chung'); ?>>Sổ chung</option>
				<option value="Hợp đồng" <?php selected($type4, 'Hợp đồng'); ?>>Hợp đồng</option> 
				<option value="Viết tay" <?php selected($type4, 'Viết tay'); ?>>Viết tay</option>  
				</select>
				<label for="stuff" class="fa-regular fa-notes input-land-icon"></label>
			    </div>
			
			    </div>
				
				<div class="pe-land-tit"><i class="fa-regular fa-arrow-up-right-from-square"></i> Diện tích / đơn vị m</div>
				
				
				<div style="display: grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;">
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" placeholder="Chiều rộng" type="number" name="size1" value="<?php echo esc_attr( $size1 ); ?>" />
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="6" placeholder="Chiều dài" type="number" name="size2" value="<?php echo esc_attr( $size2 ); ?>" />
				</div>
				
				
				
				
				
				<div class="pe-land-tit"><i class="fa-regular fa-person-booth"></i>Tiện ích</div>
				
				
				<div style="display: grid;grid-template-columns: 1fr 1fr 1fr;grid-column-gap: 10px;">
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" placeholder="Số tầng" type="number" name="home1" value="<?php echo esc_attr( $home1 ); ?>" />
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" placeholder="Phòng ngũ" type="number" name="home2" value="<?php echo esc_attr( $home2 ); ?>" />
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" placeholder="Phòng tắm" type="number" name="home3" value="<?php echo esc_attr( $home3 ); ?>" />
				</div>
				
				
				<div class="pe-land-tit"><i class="fa-regular fa-coins"></i> Mức giá</div>
				
				
				<div class="pe-land-note">Giá bán: <span id="ratien"><?php if(!empty($price1)){ echo fox_number($price1); } else {echo '0';} ?></span> đồng</div>
				
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" placeholder="Giá bán" type="number" name="price1" id="nhaptien" value="<?php echo esc_attr( $price1 ); ?>" />
				
				<?php if(!isset($land_options['dang0'])){  ?>
				<div class="pe-land-tit"><i class="fa-regular fa-phone"></i> Liên hệ với bạn?</div>
				
				<div class="pe-land-grid-4">
				
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="Số diện thoại" type="number" name="call1" value="<?php echo esc_attr( $call1 ); ?>" />
				<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" placeholder="Số Zalo" type="number" name="call2" value="<?php echo esc_attr( $call2 ); ?>" />
				<input placeholder="ID Facebook" type="text" name="call3" value="<?php echo esc_attr( $call3 ); ?>" />
				<input placeholder="Email" type="text" name="call4" value="<?php echo esc_attr( $call4 ); ?>" />
				
				</div>
				<?php } ?>
				
		        <div class="pe-land-tit"><i class="fa-regular fa-signs-post"></i> Phân loại theo</div>
				
				<div class="fox-select input-wrapper">	
				<select name="post_category">
				<?php if(!empty(get_the_terms( $post_id, 'muc'))){  
                $term_link = get_the_terms( $post_id, 'muc' );
                $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
				} else { $terms_name = null; }
			    ?>
				<?php
				
								$terms = get_terms([
									'taxonomy' => 'muc',
									'hide_empty' => false,
								]);
								foreach ($terms as $term){ ?>
								<?php if ($term->parent > 0) { ?>
									<option value="<?php echo $term->name; ?>" <?php selected($terms_name, $term->name); ?>><?php echo $term->name; ?></option>	
									<?php } else { ?>
									<option style="font-weight:bold"  value="<?php echo $term->name; ?>" <?php selected($terms_name, $term->name); ?>><?php echo $term->name; ?></option>
								<?php } 
								}  ?> 		
				</select>
                <label for="stuff" class="fa-regular fa-signs-post input-land-icon"></label>				
				</div>
                <input type="hidden" name="add_new_post" value="post" />
                <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
				</div>
				
				
				<div><button type="submit" id="updateuser"><i class="fa-regular fa-floppy-disk" style="margin-right:7px;"></i> Lưu thay đổi</button></div>
            </form>
<?php
if(isset($thongbao)){echo $thongbao;}
} else { echo '<span>Bạn không có quyền sửa tin này</span>'; } 
} else { ?>
<span>Bạn cần phải đăng nhập tài khoản mới có thể sử dụng được chức năng này</span>
<script>window.location.replace("<?php bloginfo('url'); ?>/land-manager");</script>
<?php } ?>
</div>
</div>
</main>
<script>
const node=document.getElementById("nhaptien");node.addEventListener("keyup",function(e){var n,t=document.getElementById("nhaptien").value;document.getElementById("ratien").innerHTML=(n=t)<1e3?n:n>=1e3&&n<1e6?+(n/1e3).toFixed(2)+" ng\xecn":n>=1e6&&n<1e9?+(n/1e6).toFixed(2)+" triệu":n>=1e9&&n<1e12?+(n/1e9).toFixed(2)+" tỷ":n>=1e12?+(n/1e12).toFixed(1)+" ng\xe0n tỷ":void 0});
</script>
<style>	
	.wp-core-ui .button {color: #666 !important;border: 2px solid #666 !important;background: none !important;border-radius: 7px;}
	.wp-core-ui .button:hover{border: 2px solid #0c0!important;color:#0c0!important;}
	/* media a */
	.media-frame-title h1{display:none} .media-frame-title:before{content:"Thư viện ảnh của bạn";font-weight: bold;} #media-frame-title{font-size:20px !important;padding-top:10px;text-transform:uppercase}
	.media-modal.wp-core-ui{max-width:700px;margin:0 auto;max-height:700px;}
	.media-modal.wp-core-ui button {border-radius: 0px !important;} .media-modal.wp-core-ui h1{text-transform: uppercase;color:#0c0!important}
	.media-frame-router button{background:none !important;color:#333 !important;border:none !important;border-radius:0px !important;margin-right:5px !important;}
	.media-frame-menu {display: none;} h2.media-frame-menu-heading {display:none} button.button.button-link.media-frame-menu-toggle {display: none !important;}

	 .details .uploaded, .details .file-size, .details .dimensions, .details a.edit-attachment, .attachment-display-settings{display: none; !important}
	 .attachment-details.save-ready span, .attachment-details.save-ready p, .attachments-browser .media-toolbar{display:none !important}
	 .attachments-browser .uploader-inline, .attachments-browser.has-load-more .attachments-wrapper, .attachments-browser:not(.has-load-more) .attachments {top:2px !important;}
	 
	.media-frame-content {
    left: 0px !important;
    background: #fcfcfc !important;
	border-top: 6px solid #e5e5e5 !important;
	border-bottom: 6px solid #e5e5e5 !important;
	}
	.media-frame-router {
    left: 0px !important;
	}
	.media-frame-title, .media-frame-toolbar{
    left: 10px !important;
	}
	.media-modal-content{border-radius:5px;outline: none !important}
	button.media-modal-close:hover {
    border-top-right-radius: 5px !important;
    }
	.media-router .media-menu-item:focus{box-shadow:none !important}
</style>
<?php get_footer();