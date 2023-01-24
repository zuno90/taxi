<?php
/**
*  Card bài viết ở Home some
**/
global $fox_options;
?>
<article class="some-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
		<div style="padding:15px;">
		<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
		<div class="some-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name );  ?></a></div><?php endif; ?>
		<div class="some-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="25" height="25"  alt="<?php echo get_site_url(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>"/></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
		<h2 style="font-size:23px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
		<div class="some-tomtat"><?php echo wp_trim_words( get_the_excerpt() , 20 ) ?></div>
		</div>
	
		<!-- Hình đại diện thay thế -->
		<?php if ( has_post_thumbnail()) { ?>
		<div style="margin-top:230px" />
		<div class="some-hinh">
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
		</div>
		<?php } else  if(!empty(fox_anh_dai_dien())) { ?>
		<div style="margin-top:230px" />
		<div class="some-hinh">
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
		</div>
		<?php } ?>
		<!-- Hình đại diện thay thế -->
</article>
