<?php
/*
 Template Name: Land manager
 */
get_header(); 
$land_title = $_GET['search'] ?? '';
$muc1 = $_GET['muc1'] ?? '';
$tus1 = $_GET['tus1'] ?? '';
?> 
<main>
<div class="box-card">
<div style="padding:20px;">
<div class="lienquan-title"><i class="fa-regular fa-bolt"></i> Quản lý tin 
<span class="xemthem" style="float:right;margin-top:0px"><a href="<?php bloginfo('url'); ?>/land-post"><i class="fa-regular fa-pen-to-square" style="margin-right:7px;"></i> Đăng tin</a></span>
</div>
<?php if(is_user_logged_in()) { 
$current_user = wp_get_current_user();
$current_user->user_login;
$userid = $current_user->ID; 
?>
<form action="<?php bloginfo('url'); ?>/land-manager">
	<div class="mana-land-search">
				<div class="land-input">
				    <div class="input-wrapper">
				    <input type="text" name="search" placeholder="Tìm kiếm tin của bạn" value="">
					<label for="stuff" class="fa-regular fa-house input-land-icon"></label>
					</div>
					<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
				</div>
				
				<div class="land-search-type">
					<div class="fox-select input-wrapper">
						<select name="muc1" >
						<option value="" >Phân loại</option>
						<?php
							$terms = get_terms([
								'taxonomy' => 'muc',
								'hide_empty' => false,
							]);
							foreach ($terms as $term){
								echo '<option value="'. $term->slug .'" >'. $term->name .'</option>';
							}
						?> 					
						</select>
						<label for="stuff" class="fa-regular fa-signs-post input-land-icon"></label>
                        </div>
				
					<div class="fox-select input-wrapper">
						<select name="tus1" >
						<option value="" >Trạng thái</option>
						<option value="pending" >Chưa duyệt</option>
						<option value="publish" >Đã duyệt</option>
						</select>
						<label for="stuff" class="fa-regular fa-eye input-land-icon"></label>
                        </div>
				</div>
			
	</div>
</form>
        <?php		
			$args = [
					'post_type' => 'land',
					'post_status' => array('publish', 'pending'),
					'orderby' => 'ID',
					'order' => 'DESC',
					'author' => $userid,
					'paged' => !empty($_GET['pg']) ? absint($_GET['pg']) : 1,
					's' => $land_title,
					'sentence' => true,
					'tax_query' => [],
					'meta_query'     => []
					];
			
			if ($muc1) {
					$args['tax_query'][] = [
					'taxonomy' => 'muc',
					'field' => 'slug',
					'terms' => $muc1,
					];
			}
			if ($tus1) {
					$args['post_status'] = $tus1;
			}
			

			$foxbai = new WP_Query($args);
			if ( $foxbai->have_posts() ) { ?>
			<div class="land-box-card">
			<?php
            while ($foxbai->have_posts()) : $foxbai->the_post(); 
            $postid = get_the_ID(); ?>
			<div class="mana-land-box">
				<div class="mana-land-nd">
					<div class="mana-land-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></div>
					<div>
					<div class="mana-land-tit"><a href="<?php $stt = get_post_status($postid); if($stt=="publish"){ the_permalink(); } ?>"><?php the_title() ;?></a></div> 
					<?php if(is_array(get_the_terms( $post->ID, 'muc')) && !empty(get_the_terms( $post->ID, 'muc'))){
					echo '<div class="mana-land-muc">';
						the_terms( $post->ID, 'muc');
					echo '</div>';
					} ?>
					</div>
				</div>
				<div class="mana-land-tool" <?php $stt = get_post_status($postid); if($stt=="publish"){ echo ''; } else {echo 'style="border-top: 2px solid var(--texta);"';  } ?>>
						<span><?php $stt = get_post_status($postid); if($stt=="publish"){ echo "<i class='fas fa-eye'></i>"; } else {echo "<i class='fas fa-eye-slash no-land-pub'></i>";  } ?></span>
						<span><a class="sua-a" title="Sửa" href="<?php bloginfo('url');?>/land-edit/?id=<?php echo $postid;?>"><i class="fas fa-pen-nib"></i></a></span>
						<span><?php $current_user = wp_get_current_user(); if ( $current_user->ID == $post->post_author ) { ?><a style="color:#ff3333;" title="Xóa" onclick="return confirm('Bạn có muốn xóa bài viết này không?');" href="<?php echo get_delete_post_link($postid); ?>"><i class="fas fa-trash-alt"></i></a><?php } ?></span>
				</div>
			</div>
			<?php endwhile; ?>
</div>

			<?php if(!empty(myPaginateLinks($foxbai))){ echo '<div class="land-page">'. myPaginateLinks($foxbai) .'</div>'; }
			wp_reset_query();
			} else { ?>
			 <div class="land-manager-error">
				<img title="<?php _e('Lỗi', 'fox'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/error.png" />
				<h1 class="noidung-h2">Tin trống :)</h1>
			 </div>
			 <?php	}
			 } else { ?>
			<span>Bạn cần phải đăng nhập tài khoản mới có thể sử dụng được chức năng này</span>
			<script>window.location.replace("<?php bloginfo('url'); ?>/login");</script>
			<?php } ?>
</div>
</div>
</main>
<?php
get_footer();