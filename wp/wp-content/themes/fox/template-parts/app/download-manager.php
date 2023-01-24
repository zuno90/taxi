<?php
	function fox_download_showvip(){
	global $post;	
		ob_start();
        if (!empty(get_post_meta( $post->ID, 'download_link1', true )) || !empty(get_post_meta( $post->ID, 'download_link2', true )) ){ ?>
		<div class="download-box"><div class="download-manager-title"><i class="fa-regular fa-link" style="margin-right:7px;"></i> <?php _e('Chia sẻ tập tin', 'fox'); ?></div>
        <div class="download-manager">
        <?php // link tai mã hóa
		if (!empty(get_post_meta( $post->ID, 'download_link1', true ))){
            $download_link1 = get_post_meta($post->ID, 'download_link1', true);
			$download_link1 = explode(',', $download_link1);
			$download_link11 = get_post_meta($post->ID, 'download_link11', true);
			$download_link11 = explode(',', $download_link11);
			$download_link_all1 = array_combine($download_link1, $download_link11);
            foreach($download_link_all1 as $text => $text2){
			if(!empty($text)){ ?>
			<button onclick="window.open('<?php echo esc_url( home_url( '/' ) ); ?>/link?url=<?php echo bin2hex($text); ?>')" ><i class="fa-solid fa-arrow-down-to-square" style="margin-right:7px;"></i> <?php if(!empty($text2)){echo $text2;} else {_e('Tải về', 'fox');} ?></button>
			<?php } }
		}
		// download nhảy giây
		if (!empty(get_post_meta( $post->ID, 'download_link2', true ))){
		    $download_link2 = get_post_meta($post->ID, 'download_link2', true);
		    $download_link2 = explode(',', $download_link2);
		    $download_link21 = get_post_meta($post->ID, 'download_link21', true);
		    $download_link21 = explode(',', $download_link21);
		    $download_link_all2 = array_combine($download_link2, $download_link21);
            foreach($download_link_all2 as $text => $text2){
		    if(!empty($text)){
			$iddownload = bin2hex($text);
			?>
			<button id="dow-nut<?php echo $iddownload ?>"><i class="fa-solid fa-arrow-down-to-square" style="margin-right:7px;"></i> <?php if(!empty($text2)){echo $text2;} else {_e('Tải về', 'fox');} ?> <b id="box-nut<?php echo $iddownload ?>"> <span id="giay-nut<?php echo $iddownload ?>"></span></b></button>
			<script <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
			jQuery(document).ready((function(o){var n="<?php echo $text; ?>";if(get=n.replace(/\/file\/d\/(.+)\/(.+)/,"/uc?export=download&id=$1"),get!==n){function d(n,d){o("#giay-nut<?php echo $iddownload ?>").text(n),o("#box-nut<?php echo $iddownload ?>").show();var e=setInterval((function(){n-=1,o("#giay-nut<?php echo $iddownload ?>").text(n),0==n&&(clearInterval(e),window.location=get,o("#box-nut<?php echo $iddownload ?>").hide())}),1e3);o("#box-nut<?php echo $iddownload ?>").click((function(){clearInterval(e),window.location=d}))}jQuery(document).ready((function(o){var n=!1;o("#dow-nut<?php echo $iddownload ?>").click((function(){0==n&&(d(30,document.URL),n=!0)}))}))}else{function d(n,d){o("#giay-nut<?php echo $iddownload ?>").text(n),o("#box-nut<?php echo $iddownload ?>").show();var e=setInterval((function(){n-=1,o("#giay-nut<?php echo $iddownload ?>").text(n),0==n&&(clearInterval(e),window.location=get,o("#box-nut<?php echo $iddownload ?>").hide())}),1e3);o("#box-nut<?php echo $iddownload ?>").click((function(){clearInterval(e),window.location=d}))}jQuery(document).ready((function(o){var n=!1;o("#dow-nut<?php echo $iddownload ?>").click((function(){0==n&&(d(30,document.URL),n=!0)}))}))}}));
		    </script>
        <?php  } }
		} ?>
		</div></div>
		<?php } 
	return ob_get_clean();
	}
		global $login_options;
		// tim kiem thoi gian vip
    	$current_user = wp_get_current_user(); 
        $ngaysosanh = get_the_author_meta( 'vipend', $current_user->ID ); 
        $ngaysosanh = str_replace('/', '-', $ngaysosanh);
        $ngayhomnay = date("d-m-Y");
        // tim id post trong data user
        $all_postid = nl2br(get_the_author_meta('post', $current_user->ID));
		
	    $post_check = $post->ID;
		// check bai viet khoa vip hay login
        if (get_post_meta( $post->ID, 'download_link3', true ) == 'Login'){
    	    if(is_user_logged_in() || !isset($login_options['enable3'])){
				echo fox_download_showvip();
    	    }
    	    else {
			if (!empty($login_options['notelogin'])){ $login_lock =  $login_options['notelogin']; } else { $login_lock = __('Bạn cần đăng nhập tài khoản mới có thể xem được', 'fox'); }
                echo '<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$login_lock.'</div></div>';
			}
    	}
        else if (get_post_meta( $post->ID, 'download_link3', true ) == 'Vip'){
            if((current_user_can('author') && strtotime($ngayhomnay) <= strtotime($ngaysosanh) && !empty(strtotime($ngaysosanh))) || current_user_can('vip') || current_user_can('administrator') || current_user_can('editor') || get_current_user_id() == get_the_author_meta('ID') || (preg_match("~\b$post_check\b~",$all_postid) && !empty($all_postid)) || !isset($login_options['enable3'])){
			   echo fox_download_showvip();
            } else {
                if (!empty($login_options['notevip'])){ $vip_lock =  $login_options['notevip']; } else { $vip_lock = __('Bạn cần đăng ký tài khoản VIP để xem', 'fox'); }
                echo '<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$vip_lock.'</div></div>';
            }
        }
		else if (get_post_meta( $post->ID, 'download_link3', true ) == 'Pass'){
				$lock_error 	= __('Mật khẩu bạn nhập không đúng','fox');
				$lock_form = get_post_meta( $post->ID, 'download_link31', true );
				$doi = strlen($lock_form);	
				$doila = bin2hex(md5($lock_form));
				$doila2 = substr($doila, -4);
				if (!empty($login_options['notepass'])){ $pass_lock =  $login_options['notepass']; } else { $pass_lock = __('Bạn cần nhập mật khẩu để mở khóa', 'fox'); }
				ob_start(); ?>
				<div class="khoa-chuong" style="margin:0px;margin-top:10px;border-radius:10px;"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i><?php _e('Nội dung đã bị khóa', 'fox'); ?></span></div>
				<div class="khoa-note"><?php echo $pass_lock; ?></div>
				<div class="khoa-noidung">
				<form action="#3lock<?php echo $doila2 . $doi ?>" method="post" id="3lock<?php echo $doila2 . $doi ?>">
				<div class="khoa-chuong-input">
				<input id="khoa-lock1" type="password" name="lock_input" placeholder="<?php _e('MẬT KHẨU','fox'); ?>">
				<input id="khoa-lock2" type="submit" name="lock_submit<?php echo $doila2 . $doi ?>" value="<?php _e('XEM','fox'); ?>">
				</div>
				<?php $form = ob_get_clean();
				if (isset($_POST['lock_submit'. $doila2 . $doi .''])) {
					if ($_POST['lock_input'] == $lock_form AND $lock_form != '') {
						echo '<div id="3lock'. $doila2 . $doi .'">'. fox_download_showvip() .'</div>';
					} else {
						echo $form.'<div class="khoa-chuong-eror">'.$lock_error.'</div></form></div></div>';
					}
				} else {
					echo $form .'</form></div></div>';
				}
			
		}
        else {
			    echo fox_download_showvip();
        }

		
		
		