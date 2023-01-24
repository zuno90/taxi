<?php
/**
*  Card bài viết ở Home text
**/
global $fox_options;
?>
<article class="text-card text-noidung <?php if(is_sticky()){echo 'post-sticky';} ?>">
	<div class="text-top">
	<div class="text-topimg"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><img width="35" height="35" alt="<?php echo get_site_url(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), ['size' => '30']); ?>"/></a></div>
	<div class="text-topcm">
	<span class="text-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span>
	<span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span>
	</div></div>
	<div class="text-tieude">
		<h2 style="font-size:19px;line-height: 1.3;margin:0px;"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
		<div class="text-tomtat"><?php echo wp_trim_words( get_the_excerpt() , 20 ) ?></div>
		<?php if ( 'post' === get_post_type() ) : $category = get_the_category(); $category = reset( $category ); ?><span class="text-cm"><a  href="<?php echo esc_url( get_category_link( $category ) ); ?>"><i class="fa-regular fa-bolt"></i> <?php echo esc_html( $category->name ); ?></a></span><?php endif; ?>
	</div>
</article>
