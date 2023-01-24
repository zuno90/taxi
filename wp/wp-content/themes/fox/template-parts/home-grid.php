<?php
/**
*  Card bài viết ở Home grid
**/
global $fox_options;
?>
<article class="grid-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<div class="card-noidung">
	<!-- Hình đại diện thay thế -->
	<div>
	<?php if ( has_post_thumbnail()) { ?>
	<div class="grid-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien())) { ?>
	<div class="grid-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<div style="padding:15px;">
	<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
	<div class="grid-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name );  ?></a></div><?php endif; ?>
	<div class="grid-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="25" height="25"  alt="<?php echo get_site_url(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>"/></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
	<h2 style="font-size:18px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
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
	while( $story->have_posts() ) : $story->the_post(); ?>
	<a class="card-chuong" href="<?php echo the_permalink(); ?>" ><i class="fa-regular fa-memo"></i> <?php echo get_the_title(); ?></a>
	<?php endwhile;  endif; wp_reset_postdata(); 
	// ket thuc card chuong
	} ?>
	</div>
	</div>
	</div>
</article>
