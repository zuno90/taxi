<?php
/**
 * trang index
 */
get_header();
global $fox_options;
?>
<main>
<!-- widget giữa top -->
<?php if ( is_active_sidebar('sidebar-5') && is_home() && !is_paged() ) { ?>
<div class="sidebar-img">
<?php dynamic_sidebar( 'sidebar-5' ); ?>
</div>
<?php } ?>
<div class="homepage" <?php if (isset($fox_options['side1'])){echo 'style="float:none;width:100%"';} ?>>
	<!-- widget giữa trang -->
	<?php if ( is_active_sidebar('sidebar-3') && is_home() && !is_paged() ) { ?>
	<div class="sidebar-img">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
	<?php } ?>
	<?php 
	global $adsense_options;
	if(isset($adsense_options['enable'])) {
	echo fox_add_adsense_widget_center(); 
	}
	?>
	<div id="main" class="main-bai">
			<?php
			if ( have_posts() ) : if ( is_home() && ! is_front_page() ) : ?>
				<header>
						<h1 class="card-titile"><?php single_post_title(); ?></h1>
				</header>
				<?php endif;
				while ( have_posts() ) : the_post();
					get_template_part( 'setcard', get_post_type() );
				endwhile;
				// chuyen trang dạng số
                if((isset($fox_options['next']) && $fox_options['next'] == 'Page') || !isset($fox_options['next'])) :
				$nav = get_the_posts_pagination( array(
					'prev_text'          => '&#10094;',
					'next_text'          => '&#10095;',
					'screen_reader_text' => '1'
					));
    			$nav = str_replace('<h2 class="screen-reader-text">1</h2>', '', $nav);
    			echo $nav;
                endif;
                // chuyen trang dạng số
			else :
				get_template_part( 'template-parts/trong', get_post_type());
			endif; ?>
			<?php 
			global $wp_query;
            if ($wp_query->max_num_pages > 1 && (isset($fox_options['next']) && $fox_options['next'] == 'More')) {echo '<span  class="fox-loadmore"><span  class="fox-loadmore2"><i class="fa-regular fa-circle-arrow-down"></i> '. __('Tải thêm', 'fox') .'</span></span>'; } 
			?>
	</div>
	<!-- widget dưới cùng -->
	<?php if ( is_active_sidebar('sidebar-6') && is_home() && !is_paged() ) { ?>
	<div style="margin-top:20px;" class="sidebar-img">
	<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div>
	<?php } ?>
	
</div>
<?php if (!isset($fox_options['side1'])){ ?>
<div class="sidebar">
<aside class="sidebar-img">
<?php get_sidebar(); ?>
</aside>
</div>
<div style="clear: both;" />
<?php } ?>
</main>
<?php get_footer();
