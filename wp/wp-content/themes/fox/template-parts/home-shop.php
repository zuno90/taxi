<?php
/**
*  Card bài viết ở Home shop
**/
global $fox_options;
?>
<article class="shop-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="shop-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien()) && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="shop-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php }
    // add images slide	
	else  if(!empty(get_post_meta( $post->ID, 'photo1', true )) ) {
	$photo1 = get_post_meta($post->ID, 'photo1', true);  
    $photo1 = explode(',', $photo1);
	?>
	<div class="shop-hinh">
	<span><?php echo count($photo1); ?></span>
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<div class="shop-hai">
	<h2 style="font-size:18px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
	
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
	
    <?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
	<div class="shop-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
	<?php endif;  ?>
	</div>
	<?php if(is_array(get_the_terms( $post->ID, 'type')) && !empty(get_the_terms( $post->ID, 'type'))){ echo '<div style="margin-top:35px;"></div><div class="shop-tin">'; the_terms( $post->ID, 'type', '<i class="fa-regular fa-cart-shopping"></i>'); echo '</div>'; } ?>
</article>
