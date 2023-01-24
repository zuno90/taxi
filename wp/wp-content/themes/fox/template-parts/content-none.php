<?php
/**
*  Card bài viết ở Home
**/
global $fox_options;
?>
<div class="homepage" <?php if (isset($fox_options['side1'])){echo 'style="float:none;width:100%"';} ?>>
			<!-- form tim kiem -->
			<form method="get" action="<?php bloginfo('url'); ?>">
			<div class="timkiem">
			<input id="otim" placeholder="<?php _e('Nhập nội dung cần tìm kiếm', 'fox'); ?>" value="<?php printf( get_search_query()); ?>" type="text" name="s" value="" maxlength="50" required="required" />
			<button type="submit" id="nuttim"><i class="fas fa-search"></i></button>
			</div>
			</form>
			<!-- ket thuc form tim kiem -->
<div class="box-card">
	<div class="box-noidung error-page">
	<img title="<?php _e('Lỗi', 'fox'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/error.png" />
	<h1 class="noidung-h2"><?php printf( get_search_query()); ?> ?</h1>
	<?php _e('Từ khoá mà bạn đang tìm kiếm, có vẽ như không tồn tại :)', 'fox'); ?>
	</div>
</div>
</div>

