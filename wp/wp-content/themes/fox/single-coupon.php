<?php
/**
 * trang tạo bài viết
 */
get_header(); 
?>
	<main>
	<div class="homepage2" style="float:none;width:100%">
		<?php
		while ( have_posts() ) :
		    // hiển thị số lượt xem
			getPostViews(get_the_ID());
			the_post();
			get_template_part( 'template-parts/coupon', 'content');
            endwhile; ?>
	<!-- ma giam gia ngau nhien -->
				<?php
				$foxpost = new WP_Query(array(
				'post_type'=>'coupon',
				'post_status'=>'publish',
				'orderby' => 'ID',
				'order' => 'DESC',
				'post__not_in' => array($post->ID),
				'posts_per_page'=>8,
				));
				?>
				<div class="post-page-title"><i class="fa-regular fa-bolt"></i> <?php _e('COUPON', 'fox'); ?> / <a title="<?php _e('Xem tất cả mã giảm giá', 'fox'); ?>" href="<?php echo get_site_url(); ?>/coupon"><?php _e('XEM NGAY', 'fox'); ?></a></div>
				<div id="onpage<?php echo $onpage; ?>" style="margin-bottom:20px;">
				<?php
				global $post;
				if( $foxpost->have_posts() ) {
				while ($foxpost->have_posts()) : $foxpost->the_post();
				get_template_part( 'template-parts/coupon', get_post_type() );
				endwhile;
				} else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
				wp_reset_query();?>
				</div>
	
	</div>
	</main>
<?php get_footer();
