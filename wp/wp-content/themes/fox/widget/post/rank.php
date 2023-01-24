<!-- bai viet theo chuyen muc -->
<div class="lienquan" style="margin-bottom:20px;padding:0px;">
<div class="rank-title">
<button class="ranktab rank-ac" title="<?php _e('Mới nhất', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-clock"></i> <?php _e('MỚI', 'fox'); ?></button>
<button class="ranktab" title="<?php _e('Thịnh hành', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-fire"></i> <?php _e('XEM', 'fox'); ?></button>
<button style="opacity:0.9" class="ranktab" title="<?php _e('Nhiều lượt xem', 'fox'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-bolt-lightning"></i> <?php _e('NỔI', 'fox'); ?></button>
</div>
<div class="rank-box rank" id="rankone">
    <?php
    $foxpost = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',
    'order'      => 'DESC',
    'posts_per_page'=> 8,
    ));
	if( $foxpost->have_posts() ) {
    while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
    <div class="rank-lienquan">
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
	wp_reset_query();?>
</div>
<div class="rank-box rank" id="ranktue" style="display:none">
    <?php
    $foxpost = new WP_Query(array(
    'post_type'=>'post',
    'post_status'=>'publish',
    'meta_key'  => 'post_views_count', // set custom meta key
    'orderby'    => 'meta_value_num',
    'order'      => 'DESC',
    'posts_per_page'=> 8,
    ));
	if( $foxpost->have_posts() ) {
    while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
    <div class="rank-lienquan">
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
	wp_reset_query();?>
</div>
<div class="rank-box rank" id="rankthere" style="display:none">
    <?php
    $foxpost = new WP_Query(array(
    'post_type' => 'post',
    'orderby' => 'rand',
    'posts_per_page'=> 8,
    ));
	if( $foxpost->have_posts() ) {
    while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
    <div class="rank-lienquan">
    <h3 class="rank-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
	<?php
	$categories = get_the_category(); $genres = array();
	echo '<div class="rank-cm">';
	foreach( $categories as $category ) {
		$genres[] = ' <a href="'.esc_url( get_category_link( $category->term_id ) ).'" title="'.esc_html( $category->name ).'">'.esc_html( $category->name ).'</a>';
		};
		echo implode(' ', $genres );
	echo '</div>';
	?>
    </div>
    <?php
    endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
	wp_reset_query();?>
</div>
</div>