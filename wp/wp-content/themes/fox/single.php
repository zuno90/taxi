<?php
/**
 * trang tạp bài viết
 */
get_header(); 
global $fox_options, $story_options, $comment_options;
?>
	<main>
	<div class="homepage2" <?php if (isset($fox_options['side2'])){echo 'style="float:none;width:100%"';} ?>>
		<?php
		while ( have_posts() ) :
		    // hiển thị số lượt xem
			getPostViews(get_the_ID());
			the_post();
			if( get_post_type() == 'story' && isset($story_options['theme']) && $story_options['theme'] == 'Default') :
			get_template_part( 'template-parts/baiviet-story-style1', get_post_type() );
			elseif( get_post_type() == 'story' && $story_options['theme'] == 'Comic') :
			get_template_part( 'template-parts/baiviet-story-style2', get_post_type() );
			else:
			get_template_part( 'template-parts/baiviet', get_post_type() );
			endif;
			// tab binh luan mac dinh hoac facebook
			if(isset($comment_options['enable1']) && isset($comment_options['enable2'])) :
			?>
			<div class="comen-tab">
			<button class="cotabtab cotab-ac" title="<?php _e('Mặc định', 'fox'); ?>" onclick="opencomen(event, 'comments')"><i class="fa-solid fa-message-dots"></i> <?php _e('Mặc định', 'fox'); ?></button>
			<button class="cotabtab" title="<?php _e('Facebook', 'fox'); ?>" onclick="opencomen(event, 'facebook-comment')"><i class="fa-brands fa-facebook"></i> <?php _e('Facebook', 'fox'); ?></button>
			</div>
			<?php
			endif;
			// goi binh luan facebook
			if (isset($comment_options['enable2'])):
			fox_template_facebook();
			endif;
			// hiển thị from bình luận
			if (isset($comment_options['enable1']) && (comments_open() || get_comments_number()) ) :
			comments_template();
			endif;
		endwhile; ?>
	</div>
	<?php if (!isset($fox_options['side2'])){ ?>
	<div class="sidebar2">
	<!-- menutocbot -->
	<?php if(isset($fox_options['set3'])){ ?>
	<div class="box-card box-cardmobile">
			<div class="nenmodal" id="nenmodal-1">
			<div class="nenmodal2"></div>
			<div class="ndmodal">
			<div class="closemodal"><button onclick="momodal('nenmodal-1')"><i class="fa-solid fa-xmark"></i></button></div>
			<div class="menutocbot">
			<aside class="toc"></aside>
			</div>
			</div>
			</div>
	</div>
	<!-- nut tocbot mobile -->
    <button id="nuttocbot" title="<?php _e('Mục lục', 'fox'); ?>" onclick="momodal('nenmodal-1')"><i class="fa-solid fa-bars-staggered"></i></button>
	<!-- menutocbot -->
	<?php 
	}
	get_sidebar(); ?>
	</div>
	<div style="clear: both;" />
	<?php } ?>
	</main>
<!-- menu toc bot danh muc o bai viet -->
<script <?php if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
<?php if(isset($fox_options['set3'])){ ?>
tocbot.init({
        tocSelector: '.toc',
        contentSelector: '.box-noidung',
		headingSelector: 'h1, h2, h3, h4',
        hasInnerContainers: true,
		collapseDepth  :  6,
        headingsOffset :  1,
        orderedList    :  true
    });
<?php 
}
if(isset($fox_options['set2'])){ ?>
jQuery(document).ready(function(){
                Fancybox.bind(".noidung-tomtat img", {
                    Image: {
                        zoom: false,
                    },
                });
            })
<?php } ?>
</script>
<?php get_footer();
