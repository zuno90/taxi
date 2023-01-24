<?php
/**
*  Card bài viết ở Home grid
**/
global $fox_options;
?>
<article class="fox-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<div class="fox-noidung">
	<!-- Hình đại diện thay thế -->
	<div>
	<?php if ( has_post_thumbnail()) { ?>
	<div class="fox-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien())) { ?>
	<div class="fox-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<div>
	<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
	<div class="fox-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div><?php endif;  ?>
	<div class="fox-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="25" height="25" alt="<?php echo get_site_url(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>"/></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
	<h2 style="font-size:18px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 15 ) ?></a></h2>
	<?php 
	// chương truyen o card
	if (isset($fox_options['type']) && $fox_options['type'] == 'Story'){
	$story = new WP_Query();
	$args = array(
  		'post_type'   => 'story',
  		'post_status' => 'publish',
      	'post_parent'    => $post->ID,
      	'posts_per_page'=> 2,
  	);
  	$story = new WP_Query( $args );
	if( $story->have_posts() ) : 
	echo '<div class="title-chuong">';
	while( $story->have_posts() ) : $story->the_post(); ?>
	<a class="card-chuong" href="<?php echo the_permalink(); ?>" ><i class="fa-solid fa-angle-right"></i> <?php echo get_the_title(); ?></a>
	<?php endwhile;
    echo '</div>';	
	endif; wp_reset_postdata(); 
	// ket thuc card chuong
	} ?>
	</div>
	</div>
	</div>
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
	<!-- them nut like cho bai viet -->	
	<div class="fox-chancard">
	   <span><?php if ($total_like1 >= 1){echo '<i class="fa-solid fa-heart" style="margin-right:3px;color:#ff8888"></i>';} else {echo '<i class="fa-regular fa-heart" style="margin-right:3px;"></i>';} ?> <?php echo $total_like1; ?></span>
	   <span style="text-align: right;"><i class="fa-regular fa-message-lines" style="margin-right:3px;"></i> <?php echo get_comments_number($post->ID); ?></span>
	</div>
</article>