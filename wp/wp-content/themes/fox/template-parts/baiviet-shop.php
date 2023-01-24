<?php
/**
 * Body bài viết
 */
global $fox_options, $shopp_options;
?>
<div class="box-card">
	<div class="box-noidung" style="padding: 20px 20px 20px 20px;">
	    <ol id="crumbs" itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			
			<?php if(is_array(get_the_terms( $post->ID, 'type')) && !empty(get_the_terms( $post->ID, 'type'))){  
            $term_link = get_the_terms( $post->ID, 'type' );
            $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
			$terms_slug = join(', ', wp_list_pluck($term_link, 'slug'));
			?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_bloginfo('url') .'/shop/'. $terms_slug; ?>"><span itemprop="name"><?php echo $terms_name; ?></span></a><meta itemprop="position" content="2" /></li>
			<?php } ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="3" /></li>
         </ol>  
	<?php 
	$id = get_the_ID();
	if(!empty(get_post_meta($id, 'photo1', true))) { 
	$photo1 = get_post_meta($id, 'photo1', true);  
	$photo1 = explode(',', $photo1);
	?>
	<div class="slide-photo">
    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
      <div class="swiper-wrapper" style="width:100%;">
	    <?php foreach ($photo1 as $id) { ?><div class="slide-photo1 swiper-slide"><a href="<?php echo wp_get_attachment_url( $id );?>" data-fancybox="gallery"  data-caption="<?php echo wp_trim_words( get_the_title() , 6 ) ?>"><img class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo wp_get_attachment_url( $id );?>" /></a></div><?php } ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
    <div thumbsSlider="" class="swiper mySwiper">
      <div class="swiper-wrapper">
	  <?php foreach ($photo1 as $id) { ?><div class="slide-photo2 swiper-slide"><img class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo wp_get_attachment_url( $id );?>" /></div><?php } ?>
      </div>
    </div>
	</div>
	<?php } ?>
	<?php the_title( '<h1 id="noidung-h2" class="noidung-h2">', '</h1>' ); ?>
	<?php if( !empty(get_post_meta( $post->ID, 'price1', true )) ) { 
	if( !empty(get_post_meta( $post->ID, 'price1', true )) && empty(get_post_meta( $post->ID, 'deal1', true )) ) {
	echo '<div class="shop-box-tien"><u>đ</u> '. number_format(get_post_meta( $post->ID, 'price1', true )) .'</div>'; 
	} 
	if ( !empty(get_post_meta( $post->ID, 'price1', true )) && !empty(get_post_meta( $post->ID, 'deal1', true )) ) {
	$total = get_post_meta( $post->ID, 'price1', true );
	$deal = get_post_meta( $post->ID, 'deal1', true );
	$dealm = ($deal * $total) / 100;
	$totaldeal = $total - $dealm;
	echo '<span class="box-set-deal"><u>đ</u> '.  number_format($total) .'</span>';
	echo '<span class="shop-box-tien-new"><u>đ</u> '. number_format($totaldeal) .'</span>';
	echo '<br><div class="shop-box-deal"><i class="fa-regular fa-badge-percent"></i> Giảm '. $deal .'% '. fox_number(($deal * $total) / 100) .'</div>';
	} } ?>
	
	<?php if(isset($shopp_options['sel']) && $shopp_options['sel'] == 'Affiliate'){ ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate1', true )) || !empty(get_post_meta( $post->ID, 'affiliate2', true )) || !empty(get_post_meta( $post->ID, 'affiliate3', true )) || !empty(get_post_meta( $post->ID, 'affiliate4', true )) ) { ?>
	<div class="shop-box-title"><i class="fa-regular fa-cart-shopping"></i> <?php _e('Mua hàng', 'fox'); ?></div>
	<div class="shop-box-mua">
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate1', true )) ) { ?>
	<a class="shopee" href="<?php echo get_post_meta( $post->ID, 'affiliate1', true ); ?>"><img title="Shopee" src="<?php echo get_template_directory_uri(); ?>/images/shop/shoppe.png"></a>
	<?php } ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate2', true )) ) { ?>
	<a class="tiki" href="<?php echo get_post_meta( $post->ID, 'affiliate2', true ); ?>"><img title="Tiki" src="<?php echo get_template_directory_uri(); ?>/images/shop/tiki.png"></a>
	<?php } ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate3', true )) ) { ?>
	<a class="lazada" href="<?php echo get_post_meta( $post->ID, 'affiliate3', true ); ?>"><img title="Lazada" src="<?php echo get_template_directory_uri(); ?>/images/shop/lazada.png"></a>
	<?php } ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate4', true )) ) { ?>
	<a class="sendo" href="<?php echo get_post_meta( $post->ID, 'affiliate4', true ); ?>"><img title="Sendo" src="<?php echo get_template_directory_uri(); ?>/images/shop/sendo.png"></a>
	<?php } ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate5', true )) ) { ?>
	<a class="amazon" href="<?php echo get_post_meta( $post->ID, 'affiliate5', true ); ?>"><img title="Amazon" src="<?php echo get_template_directory_uri(); ?>/images/shop/amazon.png"></a>
	<?php } ?>
	<?php if( !empty(get_post_meta( $post->ID, 'affiliate6', true )) ) { ?>
	<a class="banggood" href="<?php echo get_post_meta( $post->ID, 'affiliate6', true ); ?>"><img title="Banggood" src="<?php echo get_template_directory_uri(); ?>/images/shop/banggood.png"></a>
	<?php } ?>
	</div>
	<?php }
	} else {
	?>
	<div class="shop-box-title"><i class="fa-regular fa-cart-shopping"></i> <?php _e('Mua hàng', 'fox'); ?></div>
	<div class="shop-box-lienhe">
	<button onclick="share(event, 'shop-icon')"><i class="fa-regular fa-cart-shopping"></i> <?php _e('Liên hệ ngay', 'fox'); ?></button>
		<div class="shop-box-form" id="shop-icon">
		<div class="shop-box-icon">
		 <?php if(!empty($shopp_options['sdt'])){ ?><span class="shop-phone"><span><i class="fa-regular fa-phone"></i></span><a title="<?php _e('Gọi điện', 'fox') ?>" href="tel:<?php echo $shopp_options['sdt']; ?>"><?php echo $shopp_options['sdt']; ?></a></span><?php } ?>
		 <?php if(!empty($shopp_options['facebook'])){ ?><a class="shop-facebook" title="<?php _e('Nhắn tin Messenger', 'fox') ?>" href="https://m.me/<?php echo $shopp_options['facebook']; ?>"><i class="fa-brands fa-facebook-messenger"></i></a><?php } ?>
		 <?php if(!empty($shopp_options['zalo'])){ ?><a class="shop-zalo" title="<?php _e('Nhắn tin Zalo', 'fox') ?>" href="https://zalo.me/<?php echo $shopp_options['zalo']; ?>"><i class="fa-solid fa-message-dots"></i></a><?php } ?>
		</div>
		<?php if(!empty($shopp_options['code'])){ ?><div class="shop-code"><?php echo do_shortcode($shopp_options['code']); ?></div><?php } ?>
		</div>
	</div>
	<?php } ?>	
	</div>
<div class="shop-view"><i class="fa-regular fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></div>
</div>	

<div class="box-card">
	<div class="box-noidung" style="padding: 20px 20px 0px 20px;">	
	<div class="shop-box-title-content"><i class="fa-regular fa-note-sticky"></i> <?php _e('Thông tin', 'fox'); ?></div>
	<div id="zoomarea" style="font-size:18px" class="noidung-tomtat">
	<?php the_content(); ?>
	</div>
	<div class="box-footer" style="grid-template-columns:1fr 1fr">
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
		<a title="Facebook" class="s-facebook" style="margin-right:10px;" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
		<a title="Twitter" class="s-twitter" style="margin-right:10px;" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
		<a title="Pinterest" class="s-pinterest" style="margin-right:10px;" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
		<a title="Telegram" class="s-telegram" href="https://t.me/share/url?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-telegram"></i></a>
		</div>
		</div>

</div>
</div>
<!-- bài viet lien quan -->
<div class="lienquan-pro" style="margin-bottom:20px;"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất', 'fox'); ?><?php if(!empty(get_the_terms( $post->ID, 'type'))){  echo ' / '. $terms_name; } ?></div>
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $fox_options;
			$args = [
			'post_type' => 'shop',
			'post__not_in' => array($post->ID),
			'posts_per_page'=>10,
			'ignore_sticky_posts'=>1,
			'tax_query' => [],
			];
			if(!empty(get_the_terms( $post->ID, 'type'))){
			$args['tax_query'][] = [
			'taxonomy' => 'type',
			'field' => 'slug',
			'terms' => $terms_slug,
			];
			}
			$foxpost = new WP_Query($args);
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="itenbai">
				<?php if ( has_post_thumbnail() && empty(get_post_meta($post->ID, 'photo1', true))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho()) && empty(get_post_meta($post->ID, 'photo1', true))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php }
				// add images slide	
				else  if(!empty(get_post_meta($post->ID, 'photo1', true)) ) {
				$photo1 = get_post_meta($post->ID, 'photo1', true);  
				$photo1 = explode(',', $photo1);
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
				<?php } ?>	
			<div class="lienquan-shop-tit">
			<?php if( !empty(get_post_meta( $post->ID, 'price1', true )) ) { 
			if( !empty(get_post_meta( $post->ID, 'price1', true )) && empty(get_post_meta( $post->ID, 'deal1', true )) ) {
			echo '<div class="shop-tien"><u>đ</u> '. number_format(get_post_meta( $post->ID, 'price1', true )) .'</div><br>'; 
			} 
			if ( !empty(get_post_meta( $post->ID, 'price1', true )) && !empty(get_post_meta( $post->ID, 'deal1', true )) ) {
			$total = get_post_meta( $post->ID, 'price1', true );
			$deal = get_post_meta( $post->ID, 'deal1', true );
			$dealm = ($deal * $total) / 100;
			$totaldeal = $total - $dealm;
			echo '<div class="shop-tien set-deal"><u>đ</u> '.  number_format($total) .'</div>';
			echo '<div class="shop-tien-new"><u>đ</u> '. number_format($totaldeal) .'</div><br>';
			} } ?>
			<a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a>
			</div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query() ;?>
			</div>
			</div>
</div>
<!-- bài viet lien quan -->


