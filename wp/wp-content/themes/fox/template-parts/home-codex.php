<?php
/**
*  Card bài viết ở Home comic
**/
global $fox_options;
?>
<article class="codex-card <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<!-- Hình đại diện thay thế -->
	<?php if ( has_post_thumbnail() && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="land-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
	</div>
	<?php } else  if(!empty(fox_anh_dai_dien()) && empty(get_post_meta( $post->ID, 'photo1', true )) ) { ?>
	<div class="land-hinh">
	<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="400" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo fox_anh_dai_dien();?>"/></a>
	</div>
	<?php } ?>
	<!-- Hình đại diện thay thế -->
	<div class="codex-hai">
	<h2 style="font-size:18px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
	</div>
	<?php if ( 'post' === get_post_type() || (is_array(get_the_terms( $post->ID, 'run')) && !empty(get_the_terms( $post->ID, 'run')))){echo '<div style="margin-top:65px;"></div>';} ?>
	<div class="codex-footer">
		<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?>
		<div class="codex-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></div>
		<?php endif;  ?>
		<?php if(is_array(get_the_terms( $post->ID, 'run')) && !empty(get_the_terms( $post->ID, 'run'))){ echo '<div class="codex-cm">'; the_terms( $post->ID, 'run', '<i class="fa-regular fa-bolt"></i> '); echo '</div>'; } ?>
		<div class="comic-tacgia"><span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
	</div>
</article>
