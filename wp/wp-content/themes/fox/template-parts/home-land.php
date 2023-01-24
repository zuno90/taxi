<?php
/**
*  Card bài viết ở Home comic
**/
global $fox_options;
?>
<article class="comic-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="land-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien()) && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="land-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php }
    // add images slide	
	else  if(!empty(get_post_meta( $post->ID, 'photo1', true )) ) {
	$photo1 = get_post_meta($post->ID, 'photo1', true);  
    $photo1 = explode(',', $photo1);
	?>
	<div class="land-hinh">
	<span><?php echo count($photo1); ?></span>
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<?php if(is_array(get_the_terms( $post->ID, 'muc')) && !empty(get_the_terms( $post->ID, 'muc'))){ echo '<div class="land-loai">'; the_terms( $post->ID, 'muc', '<i class="fa-regular fa-signs-post"></i> '); echo '</div>'; } ?>
	<?php if(!empty(get_post_meta( $post->ID, 'price1', true ))) { if(!empty(get_post_meta( $post->ID, 'price1', true ))) { echo '<div class="land-tien"><i class="fa-regular fa-coins"></i> '. fox_number(get_post_meta( $post->ID, 'price1', true )) .'</div>'; } else {echo '<div class="land-tien"><i class="fa-regular fa-phone"></i> Liên hệ</div>';} }?>
	
	<div class="comic-hai">
	<h2 style="font-size:18px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
    <?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
	<div class="comic-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
	<?php endif;  ?>
	<div class="comic-tacgia"><span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
	
	<?php if(!empty(get_post_meta( $post->ID, 'type2', true )) || !empty(get_post_meta( $post->ID, 'size3', true ))) { ?>
	<div class="land-dt">
	<?php if(!empty(get_post_meta( $post->ID, 'type2', true ))) { echo '<span style="margin-right:10px;"><i class="fa-regular fa-street-view"></i> '. get_post_meta( $post->ID, 'type2', true ) .'</span>'; } ?>
	<?php if(!empty(get_post_meta( $post->ID, 'size3', true ))) { echo '<span><i class="fa-regular fa-arrow-up-right-from-square"></i> '. get_post_meta( $post->ID, 'size3', true ) .' m<sup style="font-size:10px;">2</sup></span>'; } ?>
	</div>
	<?php } ?>
	
	
	<?php 
	if(!empty(get_post_meta( $post->ID, 'adress1', true )) || !empty(get_post_meta( $post->ID, 'adress2', true ))) {
	echo '<div class="land-dc">';	
	if(!empty(get_post_meta( $post->ID, 'adress1', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress1', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress2', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress2', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress3', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress3', true ) .'</span>';} 
	if(!empty(get_post_meta( $post->ID, 'adress4', true ))) {echo '<span>'. get_post_meta( $post->ID, 'adress4', true ) .'</span>';}
	echo '</div>';
	} ?>
	
	</div>
</article>
