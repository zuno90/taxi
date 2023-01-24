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
			<?php if(is_array(get_the_terms( $post->ID, 'channel')) && !empty(get_the_terms( $post->ID, 'channel'))){  
            $term_link = get_the_terms( $post->ID, 'channel' );
            $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
			$terms_slug = join(', ', wp_list_pluck($term_link, 'slug'));
			?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_bloginfo('url') .'/youtube/'. $terms_slug; ?>"><span itemprop="name"><?php echo $terms_name; ?></span></a><meta itemprop="position" content="2" /></li>
			<?php } ?>
			<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo get_the_permalink(); ?>"><span itemprop="name"><?php echo get_the_title(); ?></span></a><meta itemprop="position" content="3" /></li>
         </ol>  
	<?php if(!empty(get_post_meta( $post->ID, 'youtube1', true ))){ ?>
	<div style="margin:0px -20px 10px -20px;">
	<?php $url = get_post_meta( $post->ID, 'youtube1', true ); parse_str( parse_url( $url, PHP_URL_QUERY ), $tube_link ); $tube = $tube_link['v']; ?>
    <div class="video-container" style="margin: 10px 0px;">
	<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $tube; ?>?rel=0&amp;controls=1&amp&amp;showinfo=0&amp;modestbranding=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
    </div>
	</div>
	<?php } ?>
	<?php the_title( '<h1 id="noidung-h2" class="noidung-h2" style="margin:0px">', '</h1>' ); ?>
	<div class="youtube-view"><i class="fa-regular fa-eye"></i> <?php echo getPostViews(get_the_ID()); ?></div>
	</div>
</div>	

<div class="box-card">
	<div class="box-noidung" style="padding: 20px 20px 0px 20px;">	
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
<div class="lienquan-pro" style="margin-bottom:20px;"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất', 'fox'); ?><?php if(!empty(get_the_terms( $post->ID, 'channel'))){  echo ' / '. $terms_name; } ?></div>
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $fox_options;
			$args = [
			'post_type' => 'youtube',
			'post__not_in' => array($post->ID),
			'posts_per_page'=>10,
			'ignore_sticky_posts'=>1,
			'tax_query' => [],
			];
			if(!empty(get_the_terms( $post->ID, 'channel'))){
			$args['tax_query'][] = [
			'taxonomy' => 'channel',
			'field' => 'slug',
			'terms' => $terms_slug,
			];
			}
			$foxpost = new WP_Query($args);
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="itenbai">
				<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'youtube1', true ))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho()) && empty(get_post_meta( $post->ID, 'youtube1', true ))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<!-- video youtube -->
				<?php } else if(!empty(get_post_meta( $post->ID, 'youtube1', true ))) { 
				$url = get_post_meta( $post->ID, 'youtube1', true );
				parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars ); $tube = $my_array_of_vars['v']; ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="https://img.youtube.com/vi/<?php echo $tube; ?>/hqdefault.jpg" /></a>
				<span class="youtube-play"><img alt="<?php echo get_site_url(); ?>" width="30" height="30" src='<?php echo get_template_directory_uri() ?>/images/play.svg'/></span>
				<?php } ?>	
			<div class="itembai1ten"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query() ;?>
			</div>
			</div>
</div>
<!-- bài viet lien quan -->

