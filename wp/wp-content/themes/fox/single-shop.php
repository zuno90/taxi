<?php
/**
 * trang tạo bài viết
 */
get_header(); 
global $fox_options, $story_options, $land_options, $comment_options;
if(is_array(get_the_terms( $post->ID, 'type')) && !empty(get_the_terms( $post->ID, 'type'))){
	$term_link = get_the_terms( $post->ID, 'type' );
    $terms_name = join(', ', wp_list_pluck($term_link, 'name'));
    $terms_slug = join(', ', wp_list_pluck($term_link, 'slug'));
}
?>
	<main>
	<div class="homepage2" <?php if (isset($fox_options['side2'])){echo 'style="float:none;width:100%"';} ?>>
		<?php
		while ( have_posts() ) :
		    // hiển thị số lượt xem
			getPostViews(get_the_ID());
			the_post();
			get_template_part( 'template-parts/baiviet-shop', get_post_type() );
			// tab binh luan mac dinh hoac facebook
			if(isset($comment_options['enable1']) && isset($comment_options['enable2'])) :
			?>
			<div class="comen-tab">
			<button class="cotabtab cotab-ac" title="<?php _e('Mặc định', 'fox'); ?>" onclick="opencomen(event, 'comments')"><i class="fa-solid fa-message-dots"></i> <?php _e('Mặc định', 'fox'); ?></button>
			<button class="cotabtab" title="<?php _e('Facebook', 'fox'); ?>" onclick="opencomen(event, 'facebook-comment')"><i class="fa-brands fa-facebook"></i> <?php _e('Facebook', 'fox'); ?></button>
			</div>
			<?php
			endif;
			// goi binh luan facebook
			if (isset($comment_options['enable2'])):
			fox_template_facebook();
			endif;
			// hiển thị from bình luận
			if (isset($comment_options['enable1']) && (comments_open() || get_comments_number()) ) :
			comments_template();
			endif;
		endwhile; ?>
	</div>
	<?php if (!isset($fox_options['side2'])){ ?>
	<div class="sidebar2">
<!-- bài viet lien quan -->
<div class="lienquan" style="margin-bottom:20px;"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất', 'fox'); ?></div>
<?php
$args = [
'post_type' => 'shop',
'post__not_in' => array($post->ID),
'posts_per_page'=>3,
'ignore_sticky_posts'=>1,
'orderby' => 'rand',
];
$foxpost = new WP_Query($args);
if( $foxpost->have_posts() ) {
while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
<div class="shop-lienquan">
<div class="shop-lq-anh">
				<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'photo1', true ))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="400" height="250" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho()) && empty(get_post_meta( $post->ID, 'photo1', true ))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="400" height="250" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php }
				// add images slide	
				else  if(!empty(get_post_meta( $post->ID, 'photo1', true )) ) {
				$photo1 = get_post_meta($post->ID, 'photo1', true);  
				$photo1 = explode(',', $photo1);
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="400" height="250" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
				<?php } ?>			
</div>
<div class="lq-land-nd">
<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
<?php if(is_array(get_the_terms( $post->ID, 'type')) && !empty(get_the_terms( $post->ID, 'type'))){ echo '<div class="shop-lq-cm">'; the_terms( $post->ID, 'type', ''); echo '</div>'; } ?>
<?php if( !empty(get_post_meta( $post->ID, 'price1', true )) ) { 
	if( !empty(get_post_meta( $post->ID, 'price1', true )) && empty(get_post_meta( $post->ID, 'deal1', true )) ) {
	echo '<div class="shop-tien"><u>đ</u> '. number_format(get_post_meta( $post->ID, 'price1', true )) .'</div>'; 
	} 
	if ( !empty(get_post_meta( $post->ID, 'price1', true )) && !empty(get_post_meta( $post->ID, 'deal1', true )) ) {
	$total = get_post_meta( $post->ID, 'price1', true );
	$deal = get_post_meta( $post->ID, 'deal1', true );
	$dealm = ($deal * $total) / 100;
	$totaldeal = $total - $dealm;
	echo '<div class="shop-tien set-deal"><u>đ</u> '.  number_format($total) .'</div>';
	echo '<div class="shop-tien-new"><u>đ</u> '. number_format($totaldeal) .'</div>';
	echo '<br><div class="shop-deal"><i class="fa-regular fa-badge-percent"></i> Giảm '. $deal .'% '. fox_number(($deal * $total) / 100) .'</div>';
	} } ?>
</div>
</div>
<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
wp_reset_query(); ?>
</div>
<!-- bai viet lien quan -->	
	<?php get_sidebar(); ?>
	</div>
	<div style="clear: both;" />
	<?php } ?>
	</main>
<?php get_footer();
