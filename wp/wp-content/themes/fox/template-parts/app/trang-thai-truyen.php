<?php
	global $fox_options, $story_options, $login_options;
	if (isset($fox_options['type']) && $fox_options['type'] == 'Story'){
	if(!empty(get_post_meta( $post->ID, 'story_mota1', true)) || !empty(get_post_meta( $post->ID, 'story_mota2', true))){
    	// thong tin tac gia truyen
    	echo '<div class="thongtin-truyen">';
    	if(!empty(get_post_meta( $post->ID, 'story_mota1', true))) {echo '<span><i class="fa-regular fa-badge-check trangthai"></i> '. __('Trạng thái:', 'fox') .' <b class="trangthai">' .get_post_meta( $post->ID, 'story_mota1', true). '</b></span>';}
        // the loai
		$categories = get_the_category();
		$genres = array();
		echo '<span><i class="fa-regular fa-bolt-lightning trangthai"></i> '. __('Thể loại:', 'fox') .' ';
		foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(',', $genres );
		echo '</span>';
        // tac gia
		$author = get_the_terms($post->ID, 'tac-gia'); 
		if ($author): 
		$out = array(); 
		echo '<span><i class="fa-regular fa-user-large trangthai"></i> '. __('Tác giả:', 'fox') .' ';
		foreach ($author as $authors): 
		$out[] = ' <a href="'.get_site_url().'/tac-gia/'.$authors->slug.'" title="'.$authors->name.'">'.$authors->name.'</a>';
		endforeach;
		echo implode(',', $out ); 
		endif;
		echo '</span>';
		// nguon
    	if(!empty(get_post_meta( $post->ID, 'story_mota2', true))) {echo '<span><i class="fa-regular fa-star trangthai"></i> '. __('Nguồn:', 'fox') .' '.get_post_meta( $post->ID, 'story_mota2', true). '</span>';}
		// ngay cap nhat
		$u_time = get_the_time('U');
		$u_modified_time = get_the_modified_time('U');
		if ($u_modified_time >= $u_time + 86400) {
		echo '<span><i class="fa-regular fa-clock-three trangthai"></i> '. __('Cập nhật:', 'fox') .' ';
		the_modified_time('d/m/Y');
		echo "</span> "; } 
		// so chuong hien tai
		fox_count_chap($post->ID);
		// chuong dau tien
		$data = array(
		'post_type'      => 'story',
		'post_status'    => 'publish',
		'ignore_sticky_posts' => -1,
		'posts_per_page' => 1,
		'post_parent'    => $post->ID,
		'orderby'        => 'modified',
		'orderby'          => array( 'meta_value_num' => 'ASC', 'ID' => 'ASC' )
		);
		$doctudau = new wp_query($data);
		while($doctudau->have_posts()){
		$doctudau->the_post();
         ?>
		<button id="doctudau" title="Đọc từ đầu" onclick="location.href='<?php the_permalink()?>'"><i class="fa-regular fa-play" style="margin-right:10px"></i> <?php _e('Đọc từ đầu' ,'fox') ?></button>
		<?php }
		wp_reset_postdata(); 
		
		
    	echo '</div>';
	}
	// add audio
    if (!empty(get_post_meta( $post->ID, 'story_audio1', true )) && isset($story_options['enable2'])){get_template_part( 'template-parts/app/audio', get_post_type() );}
	
    // danh sach cac chương mơi cap nhat
    if (isset($story_options['enable1'])){
    $story = new WP_Query();
	$args = array(
  		'post_type'   => 'story',
  		'post_status' => 'publish',
      	'post_parent'    => $post->ID,
      	'posts_per_page'=> 6,
  	);
  	$story = new WP_Query( $args );
	if( $story->have_posts() ) : ?>
    <div class="hds-title"><h2 class="ds-title"><i class="fa-solid fa-books" style="margin-right:7px"></i> <?php _e('MỚI CẬP NHẬT', 'fox'); ?></h2></div>
    <div class="ds-menu">
    <div class="grid-chuong">
	<?php while( $story->have_posts() ) : $story->the_post();?>
	<div class="mucchuong">
	<a class="achuong" href=<?php echo the_permalink();?>>
	 <?php if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Login' && isset($login_options['enable3'])){ ?>
	 <i class="fa-regular fa-arrow-right-to-bracket" style="color:#ff4444;margin-right:3px"></i>
	 <?php }  else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip' && isset($login_options['enable3'])){ ?>
	 <i class="fa-regular fa-lock" style="color:#ff4444;margin-right:3px"></i>
	 <?php }  else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Pass' && isset($login_options['enable3'])){ ?>
	 <i class="fa-regular fa-key" style="color:#ff4444;margin-right:3px"></i>
	 <?php }  else { ?>
	 <i class="fa-regular fa-eye" style="margin-right:3px"></i>
	 <?php }  echo get_the_title();?>
	 </a>
	 <span class="chuong-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
    <?php endwhile;?>
    </div>
    </div>
    <?php endif; wp_reset_postdata(); 
	}
	
	
	// danh sach chuong theo thứ tự
	if (!empty($story_options['page'])){ $sopage = $story_options['page']; } else {$sopage = 10;}
	$story = new WP_Query();
	$args = array(
  		'post_type'   => 'story',
  		'post_status' => 'publish',
      	'order' => 'ASC',
      	'post_parent'    => $post->ID,
      	'posts_per_page'=> $sopage,
      	'paged' => !empty($_GET['pg']) ? absint($_GET['pg']) : 1,
  	);
  	$story = new WP_Query( $args );
	if( $story->have_posts() ) : ?>
    <div class="hds-title"><h2 id="onpage" class="ds-title"><i class="fa-solid fa-books" style="margin-right:7px"></i> <?php _e('DANH SÁCH CHƯƠNG', 'fox'); ?></h2></div>
    <div class="ds-menu">
    <div class="grid-chuong">
	<?php while( $story->have_posts() ) : $story->the_post();?>
	 <div class="mucchuong">
	 <a class="achuong" href=<?php echo the_permalink();?>>
	 <?php if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Login' && isset($login_options['enable3'])){ ?>
	 <i class="fa-regular fa-arrow-right-to-bracket" style="margin-right:3px"></i>
	 <?php }  else if (get_post_meta( $post->ID, 'lockpost1', true ) == 'Vip' && isset($login_options['enable3'])){ ?>
	 <i class="fa-regular fa-lock" style="color:#ff4444;margin-right:3px"></i>
	 <?php }  else { ?>
	 <i class="fa-regular fa-eye" style="margin-right:3px"></i>
	 <?php }  echo get_the_title();?>
	 </a>
	 <span class="chuong-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
    <?php endwhile; ?>
    </div>
    <?php global $wp_rewrite; if(!empty(myPaginateLinks($story))){ ?>
    <!-- đến trang -->
    <form method="get" action="<?php echo get_permalink($post->post_parent); ?>">
    <div class="tim-chuong">
    <input id="otimchuong" placeholder="Trang" type="text" name="pg" value="" maxlength="50" required="required" />
    <button title="Search" type="submit" id="nuttimchuong"><?php _e('ĐẾN', 'fox'); ?></button>
    </div>
    </form>
    <?php }  echo '<div class="page-dschuong">' .myPaginateLinks($story). '</div>';  ?>
    </div>
    <?php endif; wp_reset_postdata();
	}
	
	