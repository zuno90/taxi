<?php
/**
*  Card bài viết ở Home
**/
global $fox_options;
?>
<article class="box-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<div class="box-noidung">
		<div class="noidung-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="30" height="30" class="lazyload"   alt="<?php echo get_site_url(); ?>"  <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>"/> <?php the_author(); ?></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
		<h2 class="noidung-h2"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 35 ) ?></a></h2>
		<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
		<div class="noidung-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
		<?php endif; ?>
		<div class="noidung-tomtat"><?php echo wp_trim_words( get_the_excerpt() , 35 ) ?></div>
	</div>
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail()) { ?>
	<div class="box-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload"  <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien())) { ?>
	<div class="box-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload"  <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<div class="box-luotxem"><?php echo getPostViews(get_the_ID()); ?> | <?php 	echo get_comments_number($post->ID); ?> <?php _e('bình luận', 'fox'); ?></div>
	<div class="box-share" id="o<?php echo get_the_ID(); ?>pen" style="display:none">
	<a class="s-facebook" style="margin-right:15px;" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
	<a class="s-twitter" style="margin-right:15px;" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
	<a class="s-pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
	</div>
	<div class="box-footer">
		<!-- them nut like cho bai viet -->
		<?php 
		global $wpdb;
		$l=0;
		$postid=get_the_ID();
		$clientip=fox_get_client_ip();
		$row1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid' AND clientip = '$clientip'");
		if(!empty($row1)){
		$l=1;
		}
		$totalrow1 = $wpdb->get_results( "SELECT id FROM $wpdb->post_like_table WHERE postid = '$postid'");
		$total_like1 = $wpdb->num_rows;
		?>
		<div class="post-like"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php if ($total_like1 >= 1){echo '<i class="fa-solid fa-heart" style="margin-right:3px;color:#ff8888"></i>';} else {echo '<i class="fa-regular fa-heart" style="margin-right:3px;"></i>';} ?> <?php echo $total_like1; ?></a></div>
		<!-- them nut like cho bai viet -->	
		<div><a href="<?php the_permalink(); ?>#respond" title="<?php _e('Bình luận', 'fox'); ?>"><i class="fa-regular fa-message-lines" style="margin-right:3px;"></i> <?php _e('Bình luận', 'fox'); ?></a></div>
		<div><span style="cursor: pointer;" onclick="share(event, 'o<?php echo get_the_ID(); ?>pen')" title="<?php _e('Chia sẻ', 'fox'); ?>"><i class="fa-regular fa-share" style="margin-right:3px;"></i> <?php _e('Chia sẻ', 'fox'); ?></span></div>
	</div>
</article>

