<?php
/**
 * Body bài viết
 */
?>
<div class="box-card">
<?php
global $fox_options, $login_options, $error_options;
if(isset($fox_options['set1'])){
?>
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail()) { ?>
	<div class="top-hinh-bai">
	<img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400"  class="lazyload"  <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" />
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien())) { ?>
	<div class="top-hinh-bai">
	<img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400"  class="lazyload"  <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/>
	</div>
	<?php } } ?>
	<!-- Hình đại diện thay thế -->    
	<div class="box-noidung">
	    <ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo esc_url( get_category_link( $category ) ); ?>"><span itemprop="name"><?php echo esc_html( $category->name ); ?></span></a><meta itemprop="position" content="2" /></li>
			<?php endif; ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="3" /></li>
         </ol>   
		<div class="noidung-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?> <?php the_author(); ?></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
		<?php the_title( '<h1 id="noidung-h2" class="noidung-h2">', '</h1>' ); ?>
	<?php if(isset($fox_options['set2'])){ ?>
	<!-- zoom text post -->
	<div class="zoom" style="margin-bottom:10px;margin-top:10px;">
	<button title="<?php _e('Thu nhỏ chữ', 'fox'); ?>" id="zoomin" class="zoomout" onclick="zoomOut()"><i class="fa-solid fa-minus"></i></button>
	<button title="<?php _e('Phóng to chữ', 'fox'); ?>" id="zoomout" class="zoomin" onclick="zoomIn()"><i class="fa-solid fa-plus"></i></button>
	</div>
	<?php } ?>
	<!-- zoom text post -->
	
	<div id="zoomarea" style="font-size:18px" class="noidung-tomtat">
	<?php
    	// kiem tra khoa bai viet ------------------------------------------------------------------------------------------------------------------------------------------------
    	
    	// tim kiem thoi gian vip
    	$current_user = wp_get_current_user(); 
        $ngaysosanh = get_the_author_meta( 'vipend', $current_user->ID ); 
        $ngaysosanh = str_replace('/', '-', $ngaysosanh);
        $ngayhomnay = date("d-m-Y");
        
        // tim id post trong data user
        $all_postid = nl2br(get_the_author_meta('post', $current_user->ID));
	    $post_check = $post->ID;
        
		// hien thi thoi gian het han vip
        if(current_user_can('author') && !empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) < strtotime($ngaysosanh) && get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
        $songay = strtotime($ngaysosanh) - strtotime($ngayhomnay);
        $tinhngay = round($songay / (60 * 60 * 24));
        echo '<span class="han-vip"><i class="fa-regular fa-clock"></i> '. __('Số ngày còn lại để đọc:', 'fox') .' '.$tinhngay. '</span>';
        }
        
        else if (current_user_can('author') && !empty(strtotime($ngaysosanh)) && strtotime($ngayhomnay) == strtotime($ngaysosanh) && get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
        echo '<span class="han-vip"><i class="fa-regular fa-clock"></i> '. __('Hôm nay là hết hạn', 'fox') .'</span>';
        }
        
		// tao ham goi du lieu trong bai viet
		function fox_check_showvip(){ 
		global $post, $fox_options; ob_start();
				// kiem tra co ton tai bai viet con
			    $args = array('post_parent' => $post->ID, 'post_type' => 'story');
				$children = get_children( $args );
				if (isset($fox_options['type']) && $fox_options['type'] == 'Story' && !empty($children) ) { ?>
					<div id="bai-more"><div id="p-more">
					<?php the_content(); ?>
					</div><div id="read-more"><span><i class="fa-regular fa-angle-down"></i> <?php _e('XEM THÊM', 'fox'); ?></span></div><div id="read-less"><span><i class="fa-regular fa-angle-up"></i>  <?php _e('THU GỌN', 'fox'); ?></span></div></div>
				<?php } else { the_content();}
				// trang thai truyen story
				get_template_part( 'template-parts/app/trang-thai-truyen', get_post_type());
				//add download manager
				if (isset($fox_options['set7'])){get_template_part( 'template-parts/app/download-manager', get_post_type());}
				return ob_get_clean();
		}
		

        // check login
        if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Login'){
    	    if(is_user_logged_in() || !isset($login_options['enable3'])){
				echo fox_check_showvip();
    	    }
    	    else {
			if (!empty($login_options['notelogin'])){ $login_lock =  $login_options['notelogin']; } else { $login_lock = __('Bạn cần đăng nhập tài khoản mới có thể xem được', 'fox'); }
                echo '<div class="khoa-chuong"><div class="khoa-img"><span><i class="fa-solid fa-lock"></i> '.__('Nội dung đã bị khóa', 'fox').'</span></div><div class="khoa-noidung">'.$login_lock.'</div></div>';
			}
    	}
		// check vip
        else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip'){
            if((current_user_can('author') && strtotime($ngayhomnay) <= strtotime($ngaysosanh) && !empty(strtotime($ngaysosanh))) || current_user_can('vip') || current_user_can('administrator') || current_user_can('editor') || get_current_user_id() == get_the_author_meta('ID') || (preg_match("~\b$post_check\b~",$all_postid) && !empty($all_postid)) || !isset($login_options['enable3'])){
			    echo fox_check_showvip();
            } else {
                if (!empty($login_options['notevip'])){ $vip_lock =  $login_options['notevip']; } else { $vip_lock = __('Bạn cần đăng ký tài khoản VIP để xem', 'fox'); }
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
						echo fox_check_showvip();
					} else {
						echo $form.'<div class="khoa-chuong-eror">'.$lock_error.'</div></form></div></div>';
					}
				} else {
					echo $form .'</form></div></div>';
				}
			
		}
        else {
			    echo fox_check_showvip();
        }
        // -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	?>
	</div>
	</div>
	<?php if(!empty(get_the_tags())){ ?><div class="noidung-tag"><?php the_tags( '', '', '<br />' ); ?><p /></div><?php } ?>
	<div class="box-luotxem"><?php echo getPostViews(get_the_ID()); ?> | <?php 	echo get_comments_number($post->ID); ?> <?php _e('bình luận', 'fox'); ?></div>
	<div class="box-share" id="o<?php echo get_the_ID(); ?>pen" style="display:none">
	<a title="Facebook" class="s-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
	<a title="Twitter" class="s-twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
	<a title="Pinterest" class="s-pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
	<a title="Telegram" class="s-telegram" href="https://t.me/share/url?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-telegram"></i></a>
	</div>
	<?php
    // bao lỗi bài viết	
	if(isset($error_options['enable'])){ get_template_part( 'template-parts/app/loierror', get_post_type());} ?>
	<div class="box-footer">
		<!-- them nut like cho bai viet -->
		<?php 
		global $wpdb;
		$l=0;
		$postid=get_the_id();
		$clientip=fox_get_client_ip();
		$row1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");
		if(!empty($row1)){
		$l=1;
		}
		$totalrow1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
		$total_like1 = $wpdb->num_rows;
		?>
		<div class="pp-oklike"><a class="pp_like <?php if($l==1) {echo "liked"; } ?>" href="#" data-id="<?php echo get_the_id(); ?>" title="<?php _e('Thích', 'fox'); ?>"><?php if ($total_like1 >= 1){echo '<i class="fa-solid fa-heart" style="margin-right:3px;color:#ff8888"></i>';} else {echo '<i class="fa-regular fa-heart" style="margin-right:3px;"></i>';} ?> <span><?php echo $total_like1; ?></span></a></div>
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
<?php if (isset($fox_options['set5'])){ 
get_template_part( 'template-parts/author', get_post_type() );
}
?>

<!-- bài viet lien quan -->
<div class="lienquan"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất cho bạn', 'fox'); ?></div>
<?php
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $term_category) $category_ids[] = $term_category->term_id;
$args=array(
'category__in'   => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>8,
'ignore_sticky_posts'=>1,
);
$foxpost = new WP_Query($args);
if( $foxpost->have_posts() ) {
while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
<div class="lq-lienquan">
<div class="lq-anh">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
</div>
<div>
<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
<span class="lq-tenbai-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span>
</div>
</div>
<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
wp_reset_query(); } ?>
</div>
<!-- bai viet lien quan -->	

