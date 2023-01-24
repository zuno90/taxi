<?php
/**
 * 404 error
 */
get_header(); ?>
	<main>
		<div class="box-card">
		<div class="box-noidung error-page">
		<img title="<?php _e('Lỗi', 'fox'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/error.png" />
		<h1 class="noidung-h2">404 :)</h1>
		<p>
		<?php _e( 'Không tìm thấy nội dung mà bạn cần tìm kiếm', 'fox'); ?>
		</p>
		<div class='backcomen'><a title="<?php _e('Trở lại', 'fox'); ?>" href="<?php echo get_bloginfo('url') ?>"><i class="fa-solid fa-arrow-left"></i> <?php _e('Trở lại', 'fox'); ?></a></div>
		</div>
		</div>
	</main>
<?php get_footer();
