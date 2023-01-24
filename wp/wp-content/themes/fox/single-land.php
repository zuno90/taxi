<?php
/**
 * trang tạp bài viết
 */
get_header(); 
global $fox_options, $story_options, $land_options, $comment_options;
?>
	<main>
	<div class="homepage2" <?php if (isset($fox_options['side2'])){echo 'style="float:none;width:100%"';} ?>>
		<?php
		while ( have_posts() ) :
		    // hiển thị số lượt xem
			getPostViews(get_the_ID());
			the_post();
			get_template_part( 'template-parts/baiviet-land', get_post_type() );
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
	     		<form action="<?php bloginfo('url'); ?>/search-land">
				<div class="widget-land1">
				     <div class="widget-land1-nd">
					    <div class="input-wrapper">
						<input type="text" name="search" placeholder="Tìm kiếm bất động sản" value="">
						<label for="stuff" class="fa-regular fa-house input-land-icon"></label>
					    </div>
					 </div>
				     <?php if (isset($land_options['loc0'])) { ?>
				     <div class="widget-land1-nd">
					 <div class="widget-land1-title"><i class="fa-regular fa-location-dot"></i> Lọc tin theo vị trí</div>
					 
					    <div class="fox-select input-wrapper">
						<select name="adress1" id="city" >
						<option data-id="" value="" >Lọc tỉnh thành</option>        
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
                        </div>

						<div class="fox-select input-wrapper">
						<select name="adress2" id="district" >
						<option data-id="" value="">Lọc quận huyện</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="adress3" id="ward" >
						<option data-id="" value="" >Lọc phường xã</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc1'])) { ?>
					<div class="widget-land1-nd">
					<div class="widget-land1-title"><i class="fa-regular fa-signs-post"></i> Lọc tin theo phân loại</div>
					    <div class="fox-select input-wrapper">
						<select name="muc1" >
						<option value="" >Lọc phân loại</option>
						<?php
							$terms = get_terms([
								'taxonomy' => 'muc',
								'hide_empty' => false,
							]);
							foreach ($terms as $term){
								if ($term->parent > 0) {
									echo '<option value="'. $term->slug .'" >'. $term->name .'</option>';	
								} else {
									echo '<option style="font-weight:bold"  value="'. $term->slug .'" >'. $term->name .'</option>';	
								}
							}
						?>
						</select>
						<label for="stuff" class="fa-regular fa-signs-post input-land-icon"></label>
					    </div> 
					</div>
					<?php } ?>
					
                    <?php if (isset($land_options['loc2'])) { ?>					
					<div class="widget-land1-nd">
					<div class="widget-land1-title"><i class="fa-regular fa-arrow-down-big-small"></i> Lọc tin theo thông tin</div>
						<div class="fox-select input-wrapper">
						<select name="type2" >
						<option value="">Lọc vị trí</option>
						<option value="Mặt tiền">Mặt tiền</option>
						<option value="Hẻm">Hẻm</option>
						</select>
						<label for="stuff" class="fa-regular fa-street-view input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type3" >
						<option value="">Lọc hướng</option>
						<option value="Đông">Đông</option>
						<option value="Tây">Tây</option>
						<option value="Nam">Nam</option>
						<option value="Bắc">Bắc</option>
						<option value="Đông Bắc">Đông Bắc</option>
						<option value="Tây Bắc">Tây Bắc</option>
						<option value="Đông Nam">Đông Nam</option>
						<option value="Tây Nam">Tây Nam</option>
						</select>
						<label for="stuff" class="fa-regular fa-compass input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type4" >
						<option value="">Lọc pháp lý</option>
						<option value="Sổ đỏ">Sổ đỏ</option>
						<option value="Sổ hồng">Sổ hồng</option>
						<option value="Sổ chung">Sổ chung</option>
						<option value="Hợp đồng">Hợp đồng</option>
						<option value="Viết tay">Viết tay</option>
						</select>
						<label for="stuff" class="fa-regular fa-notes input-land-icon"></label>
						</div>
						
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc3'])) { ?>
					<div class="widget-land1-nd">
					<div class="widget-land1-title"><i class="fa-regular fa-arrow-up-right-from-square"></i> Lọc tin theo diện tích</div>
					
					    <div class="fox-select input-wrapper">
						<select name="size1" >
						<option value="" >Lọc diện tích</option>
						<option value="max" >Từ nhỏ tới lớn</option>
						<option value="min" >Từ lớn tới nhỏ</option>
						<option value="99" >Dưới 100 m2</option>   
						<option value="100" >Trên 100 m2</option>
						</select>
						<label for="stuff" class="fa-regular fa-up-right-from-square input-land-icon"></label>
                        </div>						

						
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc4'])) { ?>
					<div class="widget-land1-nd">
					<div class="widget-land1-title"><i class="fa-regular fa-sack-dollar"></i> Lọc tin theo giá</div>
					
					    <div class="fox-select input-wrapper">
						<select name="price1" >
						<option value="" >Lọc giá</option>
						<option value="max" >Từ thấp tới cao</option>
						<option value="min" >Từ cao xuống thấp</option>
						<option value="999999999" >Dưới 1 tỷ</option>   
						<option value="1000000000" >Trên 1 tỷ</option>
						</select>
						<label for="stuff" class="fa-regular fa-coins input-land-icon"></label>
                        </div>						

						
					</div>
					<?php } ?>
					
					<div class="widget-land1-input">
					<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
				    </div>
				</div>
			    </form>
	<?php get_sidebar(); ?>
	</div>
	<div style="clear: both;" />
	<?php } ?>
	</main>
<?php get_footer();
