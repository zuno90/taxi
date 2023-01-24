<?php
/**
 * Body bài viết
 */
?>
<div class="box-card">
<?php
global $fox_options, $login_options, $error_options, $land_options;
?> 
	<div class="box-noidung" style="padding: 20px 20px 0px 20px;">
	    <ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			
			<?php if(is_array(get_the_terms( $post->ID, 'muc')) && !empty(get_the_terms( $post->ID, 'muc'))){  
            $term_link = get_the_terms( $post->ID, 'muc' );
            $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
			$terms_slug = join(', ', wp_list_pluck($term_link, 'slug'));
			?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_bloginfo('url') .'/land/'. $terms_slug; ?>"><span itemprop="name"><?php echo $terms_name; ?></span></a><meta itemprop="position" content="2" /></li>
			<?php } ?>
			
			<?php if (!empty(get_post_meta( $post->ID, 'adress1', true ))) { ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_bloginfo('url').'/search-land/?adress1='.get_post_meta( $post->ID, 'adress1', true ); ?>"><span itemprop="name"><?php echo get_post_meta( $post->ID, 'adress1', true ); ?></span></a><meta itemprop="position" content="3" /></li>
            <?php } ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="4" /></li>
         </ol>  
	<?php the_title( '<h1 id="noidung-h2" class="noidung-h2">', '</h1>' ); ?>
	<?php 
	if(!empty(get_post_meta( $post->ID, 'adress1', true )) || !empty(get_post_meta( $post->ID, 'adress2', true ))) {
	echo '<div class="box-land-adress">';	
	if(!empty(get_post_meta( $post->ID, 'adress1', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress1', true ) . '</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress2', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress2', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress3', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress3', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress4', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress4', true ) .'</span>';}
	echo '</div>';
	} ?>
	<div class="noidung-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?> <?php the_author(); ?></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
	<div id="zoomarea" style="font-size:18px" class="noidung-tomtat">
	<?php the_content();?>
	
	
	<?php if(isset($land_options['dang0'])){  ?>
	<div class="box-land-note"><div class="box-land-note-title"><i class="fa-regular fa-phone"></i> Liên hệ người bán</div>
	<div class="box-land-note-nd">
	<?php if(!empty(get_the_author_meta( 'phone'))) { echo '<div><span><i class="fa-solid fa-phone-volume"></i> Diện thoại</span> <a title="Gọi điện thoại" href="tel:'. get_the_author_meta( 'phone') .'" >'. get_the_author_meta( 'phone') .'</a></div>'; }?>
	<?php if(!empty(get_the_author_meta( 'zalo'))) {echo '<div><span><i class="fa-solid fa-message-captions"></i> Zalo</span> <a title="Gửi Zalo" href="https://zalo.me/'. get_the_author_meta( 'zalo') .'">Trò chuyện</a></div>';} ?>
	<?php if(!empty(get_the_author_meta( 'facebook'))) {echo '<div><span><i class="fa-brands fa-facebook-messenger"></i> Messenger</span> <a title="Gửi Messenger" href="https://m.me/'. get_the_author_meta( 'facebook') .'">Trò chuyện</a></div>';} ?>
	<?php if(!empty(get_the_author_meta( 'user_email'))) {echo '<div><span><i class="fa-solid fa-envelope"></i> Email</span> <a title="Gửi Email" href="mailto:'. get_the_author_meta( 'user_email') .'">Gửi mail</a></div>';} ?>
	</div>
	</div>
	<?php } else { if(!empty(get_post_meta( $post->ID, 'call1', true )) || !empty(get_post_meta( $post->ID, 'call2', true )) || !empty(get_post_meta( $post->ID, 'call3', true )) || !empty(get_post_meta( $post->ID, 'call4', true ))) { ?>
	<div class="box-land-note"><div class="box-land-note-title"><i class="fa-regular fa-phone"></i> Liên hệ người bán</div>
	<div class="box-land-note-nd">
	<?php if(!empty(get_post_meta( $post->ID, 'call1', true ))) { echo '<div><span><i class="fa-solid fa-phone-volume"></i> Diện thoại</span> <a title="Gọi điện thoại" href="tel:'. get_post_meta( $post->ID, 'call1', true ) .'" >'.get_post_meta( $post->ID, 'call1', true ).'</a></div>'; }?>
	<?php if(!empty(get_post_meta( $post->ID, 'call2', true ))) {echo '<div><span><i class="fa-solid fa-message-captions"></i> Zalo</span> <a title="Gửi Zalo" href="https://zalo.me/'. get_post_meta( $post->ID, 'call2', true ) .'">Trò chuyện</a></div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'call3', true ))) {echo '<div><span><i class="fa-brands fa-facebook-messenger"></i> Messenger</span> <a title="Gửi Messenger" href="https://m.me/'. get_post_meta( $post->ID, 'call3', true ) .'">Trò chuyện</a></div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'call4', true ))) {echo '<div><span><i class="fa-solid fa-envelope"></i> Email</span> <a title="Gửi Email" href="mailto:'. get_post_meta( $post->ID, 'call4', true ) .'">Gửi mail</a></div>';} ?>
	</div>
	</div>
	<?php } } ?>
	
	<div class="box-land-note"><div class="box-land-note-title"><i class="fa-regular fa-signs-post"></i> Thông tin bất động sản</div>
	<div class="box-land-note-nd">
	<?php if(!empty(get_post_meta( $post->ID, 'price1', true ))) { echo '<div><span><i class="fa-solid fa-coins"></i> Mức giá</span> <span style="color:#ff4444">'. fox_number(get_post_meta( $post->ID, 'price1', true )) .'</span></div>'; } ?>
	<?php if(!empty(get_post_meta( $post->ID, 'price1', true )) && !empty(get_post_meta( $post->ID, 'size3', true ))){ echo '<div><span><i class="fa-sharp fa-solid fa-coin"></i> Giá 1m<sup style="font-size:10px;">2</sup></span> ' . fox_number(get_post_meta( $post->ID, 'price1', true ) / get_post_meta( $post->ID, 'size3', true )) .'</div>'; }?>
	<?php if(is_array(get_the_terms( $post->ID, 'muc')) && !empty(get_the_terms( $post->ID, 'muc'))){ ?><div><span><i class="fa-solid fa-signs-post"></i> Phân loại</span> <?php echo $terms_name; ?></div><?php } ?>
	<?php if(!empty(get_post_meta( $post->ID, 'type1', true ))) {echo '<div><span><i class="fa-solid fa-road"></i> Đường</span> '. get_post_meta( $post->ID, 'type1', true ) .'</div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'type2', true ))) {echo '<div><span><i class="fa-solid fa-street-view"></i> Vị trí</span> '. get_post_meta( $post->ID, 'type2', true ) .'</div>';} ?>
	
	
	<?php if(!empty(get_post_meta( $post->ID, 'type3', true ))) {echo '<div><span><i class="fa-solid fa-compass"></i> Hướng</span> '. get_post_meta( $post->ID, 'type3', true ) .'</div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'type4', true ))) {echo '<div><span><i class="fa-solid fa-notes"></i> Pháp lý</span> '. get_post_meta( $post->ID, 'type4', true ) .'</div>';} ?>
	
	<?php if(!empty(get_post_meta( $post->ID, 'size3', true ))) {echo '<div><span><i class="fa-solid fa-up-right-from-square"></i> Diện tích</span> '. get_post_meta( $post->ID, 'size3', true ) .' m<sup style="font-size:10px;">2</sup></div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'size3', true ))){ echo '<div><span><i class="fa-duotone fa-compass-drafting"></i> Rộng / dài</span> '. get_post_meta( $post->ID, 'size1', true ) .' m / '. get_post_meta( $post->ID, 'size2', true ) .' m</div>'; } ?>
	<?php if(!empty(get_post_meta( $post->ID, 'home1', true ))) {echo '<div><span><i class="fa-solid fa-building"></i> Nhà</span> '. get_post_meta( $post->ID, 'home1', true ) .' tầng</div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'home2', true ))) {echo '<div><span><i class="fa-solid fa-bed"></i> P. Ngũ</span> '. get_post_meta( $post->ID, 'home2', true ) .' phòng</div>';} ?>
	<?php if(!empty(get_post_meta( $post->ID, 'home3', true ))) {echo '<div><span><i class="fa-solid fa-toilet"></i> P. Tắm</span> '. get_post_meta( $post->ID, 'home3', true ) .' phòng</div>';} ?>
	</div>
	</div>
	
	
	<?php if(!empty(get_post_meta( $post->ID, 'maps1', true ))) { echo '<div class="box-land-maps"><div class="box-land-note-title land-open-maps"><span><i class="fa-regular fa-map"></i> Vị trí bản đồ</span> <a title="Mở maps" href="https://www.google.com/maps/search/'. get_post_meta( $post->ID, 'maps1', true ) .'" target="_blank">mở maps</a></div>
	<iframe src="https://www.google.com/maps?q='. get_post_meta( $post->ID, 'maps1', true ) .'&output=embed" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>'; } ?>
	
	
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
<!-- bài viet lien quan -->
<div class="lienquan"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất', 'fox'); if(!empty(get_the_terms( $post->ID, 'muc'))){  echo ' / ' . $terms_name; } ?></div>
<?php
$args = [
'post_type' => 'land',
'post__not_in' => array($post->ID),
'posts_per_page'=>8,
'ignore_sticky_posts'=>1,
'tax_query' => [],
];
if(!empty(get_the_terms( $post->ID, 'muc'))){
	$args['tax_query'][] = [
	'taxonomy' => 'muc',
	'field' => 'slug',
	'terms' => $terms_slug,
	];
}
$foxpost = new WP_Query($args);
if( $foxpost->have_posts() ) {
while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
<div class="lq-lienquan">
<div class="lq-anh">
				<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'photo1', true ))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho()) && empty(get_post_meta( $post->ID, 'photo1', true ))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php }
				// add images slide	
				else  if(!empty(get_post_meta( $post->ID, 'photo1', true )) ) {
				$photo1 = get_post_meta($post->ID, 'photo1', true);  
				$photo1 = explode(',', $photo1);
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
				<?php } ?>			
</div>
<div class="lq-land-nd">
<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>

    <?php 
	if(!empty(get_post_meta( $post->ID, 'adress1', true )) || !empty(get_post_meta( $post->ID, 'adress2', true ))) {
	echo '<div class="lq-land-adress">';	
	if(!empty(get_post_meta( $post->ID, 'adress1', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress1', true ) . '</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress2', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress2', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress3', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress3', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress4', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress4', true ) .'</span>';}
	echo '</div>';
	} ?>


<?php if(!empty(get_post_meta( $post->ID, 'price1', true )) || !empty(get_post_meta( $post->ID, 'type2', true )) || !empty(get_post_meta( $post->ID, 'size3', true ))) { ?>
<div class="lq-land-dt">
<?php if(!empty(get_post_meta( $post->ID, 'price1', true ))) { echo '<span style="margin-right:10px;"><i class="fa-regular fa-coins"></i> '. fox_number(get_post_meta( $post->ID, 'price1', true )) .'</span>'; } ?>
<?php if(!empty(get_post_meta( $post->ID, 'type2', true ))) { echo '<span style="margin-right:10px;"><i class="fa-regular fa-street-view"></i> '. get_post_meta( $post->ID, 'type2', true ) .'</span>'; } ?>
<?php if(!empty(get_post_meta( $post->ID, 'size3', true ))) { echo '<span><i class="fa-regular fa-arrow-up-right-from-square"></i> '. get_post_meta( $post->ID, 'size3', true ) .' m<sup style="font-size:10px;">2</sup></span>'; } ?>
</div>
<?php } ?>
    <span class="lq-land-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span>
</div>
</div>
<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
wp_reset_query(); ?>
</div>
<!-- bai viet lien quan -->	

