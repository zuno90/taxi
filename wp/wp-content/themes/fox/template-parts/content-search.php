<?php
/**
*  Tìm kiếm
**/
?>
<div class="box-card">
<div class="hinh"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_the_post_thumbnail_url (get_the_ID(), array('80' , '80')); ?>" /></a></div>
<div class="noidung">
	<h2 class="noidung-h2"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 15 ) ?></a></h2>
	<div class="noidung-tomtat"><?php echo wp_trim_words( get_the_excerpt() , 25 ) ?></div>
	<div class="noidung-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a> <span><?php $timeago = vi_human_time_diff(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
</div>
</div>
