<?php
/**
 * Template Name: Profile
 */
global $current_user, $wp_roles;
wp_get_current_user();
fox_custom_scripts(); // file goi tai len avatar
$error = array();
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
        if ( $_POST['pass1'] == $_POST['pass2'] )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
        else
            $error[] = __('Mật khẩu mà bạn nhập không khớp!', 'fox');
    }
    if ( isset( $_POST['user_url'] ) ){
                wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['user_url'] ) ) );
            }
    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( isset( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
	if ( isset( $_POST['tiktok'] ) ) {
            update_user_meta( $current_user->ID, 'tiktok', esc_attr( $_POST['tiktok'] ) ); }
    if ( isset( $_POST['telegram'] ) ) {
            update_user_meta( $current_user->ID, 'telegram', esc_attr( $_POST['telegram'] ) ); }
    if ( isset( $_POST['facebook'] ) ) {
            update_user_meta( $current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) ); }
    if ( isset( $_POST['twitter'] ) ) {
            update_user_meta( $current_user->ID, 'twitter', esc_attr( $_POST['twitter'] ) ); }
	if ( isset( $_POST['zalo'] ) && get_locale() == 'vi') {
            update_user_meta( $current_user->ID, 'zalo', esc_attr( $_POST['zalo'] ) ); }
	if ( isset( $_POST['phone'] ) ) {
            update_user_meta( $current_user->ID, 'phone', esc_attr( $_POST['phone'] ) ); }
	if ( isset( $_POST['slogan'] ) ) {
            update_user_meta( $current_user->ID, 'slogan', esc_attr( $_POST['slogan'] ) ); }
	if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink() );
        exit;
    }
}
get_header(); ?>
<main>
<div class="box-card">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ( !is_user_logged_in() ) : ?>
<div style="padding:20px;text-align: center;">
<?php _e('Trang này chỉ hoạt động sau khi bạn đã đăng nhập', 'fox'); ?>
<script>window.location.replace("<?php bloginfo('url'); ?>/login");</script>
</div>
<?php else : ?>             
<div class="box-noidung">
<?php if ( count($error) > 0 ){ echo '<div class="thongtin-loi">  '.implode($error).'</div>';} ?>
                <form class="thongtin-form" autocomplete="off" method="post" id="adduser" action="<?php the_permalink(); ?>">
                    <div class="thongtin-img">
                    <?php echo get_avatar( $current_user->ID, 150 ); ?>
                    <div class="thongtin-user"><b><?php echo the_author_meta( 'nickname', $current_user->ID ); ?></b></div>
					
					
					<?php
					// quan ly cua land
					global $fox_options; if (isset($fox_options['type']) && $fox_options['type'] == 'Land' && isset($land_options['login0'])){ ?>
					<div class="thongtin-land">
						<a title="Đăng" href="<?php bloginfo('url'); ?>/land-post"><i class="fa-regular fa-pen-to-square"></i> Đăng tin</a>
						<a title="Quản lý" href="<?php bloginfo('url'); ?>/land-manager"><i class="fa-regular fa-bars-staggered"></i> Quản lý tin</a>
					</div>
					<?php } ?>
					
					<div class="thongtin-lap">
                    <span class="user-tb"><?php global $wp_query; $registered = date_i18n( "d/m/Y", strtotime( get_the_author_meta( 'user_registered', $wp_query->queried_object_id ) ) ); echo $registered; ?> | <?php echo __('Số ID:', 'fox') .' '. get_current_user_id(); ?></span>
                        <?php if(current_user_can('author')) { ?>
                        <span><?php _e('Bạn đang sử dụng tài khoản thường', 'fox'); ?></span>
                        <?php 
                        // thoi gian vip 1
                    	$current_user = wp_get_current_user(); $vipuserid = $current_user->ID;
                        $ngaysosanh = get_the_author_meta( 'vipend', $vipuserid ); 
                        $ngaysosanh = str_replace('/', '-', $ngaysosanh);
                        $ngayhomnay = date("d-m-Y"); 
                        if(!empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) < strtotime($ngaysosanh)){
                        $songay = strtotime($ngaysosanh) - strtotime($ngayhomnay);
                        $tinhngay = round($songay / (60 * 60 * 24));
                        echo '<span>'. __('Số ngày hết vip:', 'fox') .' '. $tinhngay .'</span>';
                        }
                        else if (!empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) == strtotime($ngaysosanh)){
                        echo '<span>'. __('Hôm nay là hết hạn', 'fox') .'</span>';
                        } 
                        }
                        
                        if (current_user_can('vip')) { ?>
                        <span><?php _e('Bạn đang sử dụng tài khoản VIP', 'fox'); ?></span>
                        <?php } 
                        if (current_user_can('administrator')) { ?>
                        <span><?php _e('Bạn đang sử dụng tài khoản Admin', 'fox'); ?></span>
                        <?php } 
                        ?>
					</div>
					
					
					<div class="thongtin-out"><a href="<?php echo esc_url(wp_logout_url()); ?>"><i class="fa-regular fa-arrow-right-from-bracket"></i></a></div> 
                    </div>
                    <div class="thongtin-noidung">
                        <div class="thongtin-tieude" style="margin-top:0px"><?php _e('Thông tin cơ bản', 'fox'); ?></div>
    					<div class="thongtin-box">
                        <div class="input-wrapper">
						<input class="text-input" name="last-name" type="text" id="tt-input1" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" placeholder="<?php _e('Họ của bạn', 'fox'); ?>" width="100%" />
						<label for="stuff" class="fa-regular fa-user input-land-icon"></label>
						</div>
                        <div class="input-wrapper">
						<input class="text-input" name="first-name" type="text" id="tt-input2" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" placeholder="<?php _e('Tên của bạn', 'fox'); ?>" />
						<label for="stuff" class="fa-regular fa-user input-land-icon"></label>
						</div>
                        </div>
    
						<div class="thongtin-box">
							<div class="input-wrapper">
							<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" type="number" class="form-control" id="tt-input22" name="phone" placeholder="<?php _e('Số điện thoại', 'fox'); ?>" value="<?php the_author_meta( 'phone', $current_user->ID ); ?>">
							<label for="stuff" class="fa-regular fa-phone input-land-icon"></label>
					        </div>
							<?php if (get_locale() == 'vi'){ ?>
							<div class="input-wrapper">
							<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" type="number" class="form-control" id="tt-input23" name="zalo" placeholder="<?php _e('Số Zalo', 'fox'); ?>" value="<?php the_author_meta( 'zalo', $current_user->ID ); ?>">
							<label for="stuff" class="fa-regular fa-message-lines input-land-icon"></label>
					        </div>
							<?php } ?>
                        </div>
						
    					<div class="thongtin-box">
							<div class="input-wrapper">
							<input type="text" class="form-control" id="tt-input4" name="tiktok" placeholder="ID Tiktok" value="<?php the_author_meta( 'tiktok', $current_user->ID ); ?>">
							<label for="stuff" class="fa-brands fa-tiktok input-land-icon"></label>
							</div>
							<div class="input-wrapper">
							<input type="text" class="form-control" id="tt-input3" name="telegram" placeholder="ID Telegram" value="<?php the_author_meta( 'telegram', $current_user->ID ); ?>">
							<label for="stuff" class="fa-brands fa-telegram input-land-icon"></label>
							</div>
                        </div>
    					<div class="thongtin-note">
    					❖ https://tiktok.com/@<span style="color:#0768ea">Id</span>  <?php _e('là Id Tiktok của bạn.', 'fox'); ?><br/>
						❖ https://telegram.me/<span style="color:#0768ea">Id</span> <?php _e('là Id Telegram của bạn.', 'fox'); ?>
    					</div>
                        <div class="thongtin-box">
							<div class="input-wrapper">
							<input readonly onfocus="this.removeAttribute('readonly');" type="text" class="form-control" id="tt-input5" name="facebook" placeholder="ID Facebook" value="<?php the_author_meta( 'facebook', $current_user->ID ); ?>">
							<label for="stuff" class="fa-brands fa-facebook input-land-icon"></label>
							</div>
							<div class="input-wrapper">
							<input readonly onfocus="this.removeAttribute('readonly');" type="text" class="form-control" id="tt-input6" name="twitter" placeholder="ID Twitter" value="<?php the_author_meta( 'twitter', $current_user->ID ); ?>">
							<label for="stuff" class="fa-brands fa-twitter input-land-icon"></label>
							</div>
                        </div>
    					<div class="thongtin-note">
    					❖ https://facebook.com/<span style="color:#0768ea">Id</span>  <?php _e('là Id Facebook của bạn.', 'fox'); ?><br/>
    					❖ https://twitter.com/<span style="color:#0768ea">Id</span>  <?php _e('là Id Twitter của bạn.', 'fox'); ?>
    					</div>
                        <div class="thongtin-tieude"><?php _e('Chia sẻ thêm về bạn', 'fox'); ?></div>
							<div class="thongtin-box-one">
							<div class="input-wrapper">
							<input type="text" class="form-control" id="tt-input-slogan" name="slogan" placeholder="<?php _e('Slogan', 'fox'); ?>" value="<?php the_author_meta( 'slogan', $current_user->ID ); ?>">
							<label for="stuff" class="fa-regular fa-check input-land-icon"></label>
							</div>
							</div>
						
                        <div><textarea placeholder="<?php _e('Bạn muốn giới thiệu bản thân?', 'fox'); ?>" maxlength="200" name="description" id="tt-input7" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea></div>
                        <div class="thongtin-tieude"><?php _e('Bạn có muốn thay đổi mật khẩu mới?', 'fox'); ?></div>
    					<div class="thongtin-box">
							<div class="input-wrapper">
							<input class="text-input" name="pass1" type="password" id="tt-input8" placeholder="<?php _e('Mật khẩu', 'fox'); ?>" />
							<label for="stuff" class="fa-regular fa-lock input-land-icon"></label>
							</div>
							<div class="input-wrapper">
							<input class="text-input" name="pass2" type="password" id="tt-input9" placeholder="<?php _e('Nhập lại mật khẩu', 'fox'); ?>" />
							<label for="stuff" class="fa-regular fa-lock input-land-icon"></label>
							</div>
    					</div>
						<?php echo fox_profile_fields( $current_user ); ?>
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Cập nhật thông tin', 'fox'); ?>" />
                        <?php wp_nonce_field( 'update-user' ) ?>
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </div>
                </form>
<?php endif; ?>
<?php endwhile;  else: ?>
<p class="no-data"><?php _e('Xin lỗi, trang này không tồn tại.', 'fox'); ?></p>
<?php endif; ?>
</div>
</main>
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
