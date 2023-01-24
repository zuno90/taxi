<?php
/**
 * Body trang
 */
?>
<div class="box-card">
	<div class="box-noidung">
		<div class="noidung-tacgia"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?> <?php the_author(); ?></a></div>
		<?php the_title( '<h1 class="noidung-h2">', '</h1>' ); ?>
		<div class="noidung-tomtat"><?php the_content(); ?></div>
	</div>
</div>

