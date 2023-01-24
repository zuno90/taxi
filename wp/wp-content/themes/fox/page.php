<?php
/**
 * trang tạp bài viết
 */
get_header();
global $fox_options;
?>
<main>
<div class="homepage2" <?php if (isset($fox_options['side3'])){echo 'style="float:none;width:100%"';} ?>>
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; ?>
</div>
		<?php if (!isset($fox_options['side3'])){ ?>
		<div class="sidebar2">
		<?php get_sidebar(); ?>
		</div>
		<div style="clear: both;" />
		<?php } ?>
</main>
<?php get_footer();

