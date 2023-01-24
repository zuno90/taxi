<?php
/**
 * giao diện bình luận
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) : ?>
		<?php the_comments_navigation(); ?>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 50,
						'callback' => 'custom_comments'  // goi giao dien binh luan xoa neu muon
					)
				);
			?>
		</ol>
		<?php
		echo "<p style='text-align: center;'>"; paginate_comments_links( array('prev_next' => false,) ); echo "</p>"; // phan trang dạng số
		if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Rất tiếc, chức năng bình luận hiện không khả dụng cho bài viết này!', 'fox' ); ?></p>
		<?php endif;
	endif;
	comment_form(); ?>
</div>

