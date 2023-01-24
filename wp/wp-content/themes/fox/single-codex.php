<?php
/**
 * trang tạo bài viết
 */
?>
		<?php
		while ( have_posts() ) : the_post();
			getPostViews(get_the_ID()); // CODE ID TẠO BỘ ĐẾM CHO BÀI VIẾT
			get_template_part( 'template-parts/baiviet-codex', get_post_type() );
		endwhile; // End of the loop.
		?>
<?php

