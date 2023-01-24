	<div class="box-card">
	<div class="box-noidung" style="padding: 20px 20px 20px 20px;">
	    <ol id="crumbs" itemscope itemshow="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemshow="http://schema.org/ListItem"><a itemshow="http://schema.org/Thing" itemprop="item" href="<?php echo get_option('home'); ?>"><span itemprop="name">Home</span></a><meta itemprop="position" content="1" /></li>
			
			<?php if(is_array(get_the_terms( $post->ID, 'show')) && !empty(get_the_terms( $post->ID, 'show'))){  
            $term_link = get_the_terms( $post->ID, 'show' );
            $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
			$terms_slug = join(', ', wp_list_pluck($term_link, 'slug'));
			?>
			<li itemprop="itemListElement" itemscope itemshow="http://schema.org/ListItem"><a itemshow="http://schema.org/Thing" itemprop="item" href="<?php echo get_bloginfo('url') .'/coupon/'. $terms_slug; ?>"><span itemprop="name"><?php echo $terms_name; ?></span></a><meta itemprop="position" content="2" /></li>
			<?php } ?>
			<li itemprop="itemListElement" itemscope itemshow="http://schema.org/ListItem"><a itemshow="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="3" /></li>
         </ol>  
	
	<?php the_title( '<h1 id="noidung-h2" class="noidung-h2">', '</h1>' ); ?>
	<div class="coupon-nodung">
		<?php 
		// noi dung giam gia
		if( !empty(get_post_meta( $post->ID, 'coupon1', true )) ) { echo '<span>'. get_post_meta( $post->ID, 'coupon1', true ) . '</span>'; } ?>
		<div class="coupon-get">
		<?php 
		// ma giam gia
		if( !empty(get_post_meta( $post->ID, 'coupon4', true )) ) { 
		$couget = 'style="position: absolute;"';
		$couget_name = __('Nhận mã', 'fox');
		echo '<div class="coupon-ma">'. get_post_meta( $post->ID, 'coupon4', true ) . '</div>'; 
		} else {
		$couget = null;
		$couget_name = __('Xem', 'fox');
		} ?>
		<?php 
		// lien ket tiep thi
		if( !empty(get_post_meta( $post->ID, 'coupon5', true )) ) { echo '<div id="coupon-show-'. $post->ID .'" class="coupon-link" '. $couget .'><i class="fa-regular fa-scissors"></i><a target="_blank" title="'. $couget_name .'" href="'. get_post_meta( $post->ID, 'coupon5', true ) . '" onclick="share(event, &#39;coupon-show-'. $post->ID .'&#39;)" >'. $couget_name .'</a></div>'; } ?>
		</div>
		<?php 
		// phan tram giam gia
		if( !empty(get_post_meta( $post->ID, 'coupon2', true )) ) { echo '<div class="coupon-post-off">'. get_post_meta( $post->ID, 'coupon2', true ) . '% OFF</div>';} ?>
		<?php
		// ngay con han ma giam gia
		$coupon_datanow = date("d-m-Y");
		$coupon_data = get_post_meta( $post->ID, 'coupon3', true );
		$coupon_datacheck = str_replace('/', '-', $coupon_data);
		if(!empty($coupon_data) && strtotime($coupon_datanow) > strtotime($coupon_datacheck)){
		$coupon_checkdate = _('Hết hạn', 'fox'); 
		} else {
		$coupon_checkdate = $coupon_data;
		}
		if( !empty($coupon_data) ) { 
		echo '<div class="coupon-post-date">'. __('Thời gian hiệu lực đến: ', 'fox') .  $coupon_checkdate .'</div>';  
		} ?>
		<?php 
		// nguon cung cap ma giam gia
		if(is_array(get_the_terms( $post->ID, 'show')) && !empty(get_the_terms( $post->ID, 'show'))){ echo '<div class="coupon-post-show">'; the_terms( $post->ID, 'show', __('Mã giãm giá đến từ ', 'fox')); echo '</div>'; } ?>
		<div class="coupon-post-view">
		 <div><i class="fa-regular fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></div>
		 <div>
			<a title="Facebook" class="s-facebook" style="margin-right:10px;" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
			<a title="Twitter" class="s-twitter" style="margin-right:10px;" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
			<a title="Pinterest" class="s-pinterest" style="margin-right:10px;" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
			<a title="Telegram" class="s-telegram" href="https://t.me/share/url?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-telegram"></i></a>
		</div>
		</div>
		
	</div>
	</div>
    </div>