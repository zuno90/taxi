<?php
/**
 * Body bài viết
 */
?>
<div class="box-card">
<?php
global $fox_options, $story_options, $login_options, $error_options; ?>
	<!-- Hình đại diện thay thế -->    
	<div class="box-noidung">
	<ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
             <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			<?php if ( 'post' === get_post_type($post->post_parent) ) : $category = get_the_category($post->post_parent); $category = reset( $category ); ?>
			 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><span itemprop="name"><?php echo esc_html( $category->name ); ?></span></a><meta itemprop="position" content="2" /></li>
			<?php endif; ?>
			 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink($post->post_parent); ?>"><span itemprop="name"><?php echo get_the_title($post->post_parent); ?></span></a><meta itemprop="position" content="3" /></li>
			 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php the_title(); ?></span></a><meta itemprop="position" content="4" /></li>
    </ol> 
	<h1 class="noidung-h2"><?php echo get_the_title($post->post_parent); ?></h1>
    <h2 class="truyen-chinh"><?php the_title(); ?></h2>
    <span class="truyen-dow">
    <a id="nut-cquay1" href="<?php echo get_permalink($post->post_parent); ?>"><i class="fa-regular fa-house-blank"></i></a>
    <?php
	fox_get_prev_chap($post->post_parent);
    get_dropdown_part($post->post_parent); 
	fox_get_next_chap($post->post_parent);
	?>
	<?php if(isset($fox_options['set2'])){ ?>
	<button title="<?php _e('Thu nhỏ chữ', 'fox'); ?>" id="zoomin-story" class="zoomout" onclick="zoomOut()"><i class="fa-solid fa-minus"></i></button>
	<button title="<?php _e('Phóng to chữ', 'fox'); ?>" id="zoomout-story" class="zoomin" onclick="zoomIn()"><i class="fa-solid fa-plus"></i></button>
	<?php } ?>
	</span>


	<div id="zoomarea" style="font-size:18px;line-height:2" class="noidung-tomtat">
	<?php
    	// kiem tra khoa bai viet ------------------------------------------------------------------------------------------------------------------------------------------------
    	// tim kiem thoi gian vip
    	$current_user = wp_get_current_user(); 
        $ngaysosanh = get_the_author_meta( 'vipend', $current_user->ID ); 
        $ngaysosanh = str_replace('/', '-', $ngaysosanh);
        $ngayhomnay = date("d-m-Y");
        
        // tim id post trong data user
        $all_postid = nl2br(get_the_author_meta('post', $current_user->ID));
	    $post_check = $post->post_parent;
        
        if(current_user_can('author') && !empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) < strtotime($ngaysosanh) && get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
        $songay = strtotime($ngaysosanh) - strtotime($ngayhomnay);
        $tinhngay = round($songay / (60 * 60 * 24));
        echo '<span class="han-vip"><i class="fa-regular fa-clock"></i> '. __('Số ngày còn lại để đọc:', 'fox') .' '.$tinhngay. '</span>';
        }
        
        else if (current_user_can('author') && !empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) == strtotime($ngaysosanh) && get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
        echo '<span class="han-vip"><i class="fa-regular fa-clock"></i> '. __('Hôm nay là hết hạn', 'fox') .'</span>';
        }
        
        // check login
        if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Login'){
    	    if(is_user_logged_in() || !isset($login_options['enable3'])){
				the_content();
				// audio
				if (!empty(get_post_meta( $post->ID, 'story_audio1', true )) && isset($story_options['enable2'])){get_template_part( 'template-parts/app/audio', get_post_type() );}
				}
			else {
				if (!empty($login_options['notelogin'])){$login_lock =  $login_options['notelogin'];} else {$login_lock = __('Bạn cần đăng nhập tài khoản mới có thể xem được', 'fox');}
				echo '<div class="khoa-chuong"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$login_lock.'</div></div>';
			}
    	}
		// check vip
        else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
            if(current_user_can('author') && strtotime($ngayhomnay) <= strtotime($ngaysosanh) && !empty(strtotime($ngaysosanh)) || current_user_can('vip') || current_user_can('administrator') || current_user_can('editor') || get_current_user_id() == get_the_author_meta('ID') || preg_match("~\b$post_check\b~",$all_postid) && !empty($all_postid) || !isset($login_options['enable3'])){
                the_content();
                // audio
                if (!empty(get_post_meta( $post->ID, 'story_audio1', true )) && isset($story_options['enable2'])){get_template_part( 'template-parts/app/audio', get_post_type() );}
                
			} else {
				if (!empty($login_options['notevip'])){$vip_lock =  $login_options['notevip'];} else {$vip_lock = __('Bạn cần đăng ký tài khoản VIP để xem', 'fox');}
				 echo '<div class="khoa-chuong"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$vip_lock.'</div></div>';
			}
        }
		// check pass
		else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Pass'){
				$lock_error 	= __('Mật khẩu bạn nhập không đúng','fox');
				$lock_form = get_post_meta( $post->ID, 'lockpost11', true );
				$doi = strlen($lock_form);	
				$doila = bin2hex(md5($lock_form));
				$doila2 = substr($doila, -4);
				if (!empty($login_options['notepass'])){ $pass_lock =  $login_options['notepass']; } else { $pass_lock = __('Bạn cần nhập mật khẩu để mở khóa', 'fox'); }
				ob_start(); ?>
				<div class="khoa-chuong"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i><?php _e('Nội dung đã bị khóa', 'fox'); ?></span></div>
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
						the_content();
					} else {
						echo $form.'<div class="khoa-chuong-eror">'.$lock_error.'</div></form></div></div>';
					}
				} else {
					echo $form .'</form></div></div>';
				}
			
		}
        else {
              the_content();
              // audio
              if (!empty(get_post_meta( $post->ID, 'story_audio1', true )) && isset($story_options['enable2'])){get_template_part( 'template-parts/app/audio', get_post_type() );}
        }
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	?>
	</div>
	</div>
	<div class="chuyen-chuong">
	<span><?php fox_get_prev_chap($post->post_parent); ?></span>
    <span><?php get_dropdown_part($post->post_parent); ?></span>
	<span><?php fox_get_next_chap($post->post_parent); ?></span>
	</div>
	<div class="box-share" id="o<?php echo get_the_ID(); ?>pen" style="display:none">
	<a title="Facebook" class="s-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
	<a title="Twitter" class="s-twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
	<a title="Pinterest" class="s-pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
	<a title="Telegram" title="Telegram" class="s-telegram" href="https://t.me/share/url?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-telegram"></i></a>
	</div>
	<?php
    // bao lỗi bài viết	
	if(isset($error_options['enable'])){ get_template_part( 'template-parts/app/loierror', get_post_type());} ?>
	<div class="box-footer" style="grid-template-columns: auto auto;">
		<!-- them nut like cho bai viet -->	
		<div>
		<?php
        // bao loi bai viet
		if(isset($error_options['enable'])){ ?>
		<a href="javascript:void(0);" onclick="share(event, 'baoerror')" title="<?php _e('Báo lỗi', 'fox'); ?>"><i class="fa-regular fa-triangle-exclamation" style="margin-right:3px;"></i> <?php _e('Báo lỗi', 'fox'); ?></a>
		<?php } else { ?>
		<a href="javascript:void(0);"  id="nutms" title="<?php _e('Bình luận', 'fox'); ?>"><i class="fa-regular fa-message-lines" style="margin-right:3px;"></i> <?php _e('Bình luận', 'fox'); ?></a>
		<?php } ?>
		</div>
		<div><a href="javascript:void(0);" onclick="share(event, 'o<?php echo get_the_ID(); ?>pen')" title="<?php _e('Chia sẻ', 'fox'); ?>"><i class="fa-regular fa-share" style="margin-right:3px;"></i> <?php _e('Chia sẻ', 'fox'); ?></a></div>
	</div>
</div>
<style>.noidung-tomtat img{border-radius:0px !important;box-shadow: none;margin-bottom: -17px;}</style>



