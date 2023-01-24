<?php
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC
    class fox_post extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget',
			'Fox Post',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			  'grid' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false';
			echo ('<p><input type="text" class="widefat" placeholder="Tên chuyên mục" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
			?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'fox'); ?></label></p>
            <?php
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			$instance['grid'] = $new_instance['grid'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- bai viet theo chuyen muc -->
				<?php
				$foxpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'cat' => $instance['id'],
				'orderby' => 'ID',
				'order' => 'DESC',
				'posts_per_page'=> $instance['total'],
				));
				?>
				<div class="lienquan" style="margin-bottom:20px;"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php echo $instance['title']; ?></div>
				<div class="lienquan-box" <?php if ('on' == isset($instance['grid'])) { echo 'style="display:grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;grid-row-gap: 10px;"'; } ?> >
				<?php
				global $fox_options;
				if( $foxpost->have_posts() ) {
				while ($foxpost->have_posts()) : $foxpost->the_post();
				?>
				<div class="lq-lienquan">
				<div class="lq-anh">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
				</div>
				<div>
				<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="lq-tenbai-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span>
				</div>
				</div>
				<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
				wp_reset_query(); ?>
				</div>
				<div class="xemthem"><a href="<?php echo get_category_link( $instance['id'] ); ?>"><?php _e('Thêm', 'fox'); ?> <i class="fa-solid fa-arrow-right"></i></a></div>
				</div>
			<?php
        }
    }
// WEDGET BÌNH LUẬN GẦN ĐÂY
class fox_comment extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget2',
			'Fox Comment',
			array(
			'description' => __('Hiển thị bình luận gần đây', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tiêu đề nội dung bình luận', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');

        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$total = $instance['total'];
				// bình luận gần đây 
				$args = array(
					'status' => 'approve',
					'number'=> $total,
				);
				echo '<div class="box-card" style="padding:20px;margin-bottom:20px">';
				if(!empty($instance['title'])){$comen_tit = $instance['title'];} else {$comen_tit = __('Bình luận gần đây', 'fox');}
				echo '<div class="widget-tieu">'.$before_title.'<i class="fa-regular fa-message-lines" style="margin-right:5px;"></i> '.$comen_tit.$after_title.'</div>';
				echo '<div class="binhluan-new">';
				global $fox_options;
				$comments_query = new WP_Comment_Query;
				$comments = $comments_query->query( $args );
				if ($comments) {
					foreach ($comments as $comment) {
						$url = '<a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">';
						echo '<div class="td-comment">'. $url . wp_trim_words(get_the_title($comment->comment_post_ID), 10);
						if ($comment->post_parent > 0){echo ' - ' .wp_trim_words(get_the_title($comment->post_parent), 10);}
						echo '</a></div>';
						echo '<div class="tap-comment">';
					if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){$lazycoment = 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} else {$lazycoment = "";}
						echo '<div class="comment-av"><a href="'.$comment->comment_author_url.'"><img alt="'.get_site_url().'" width="40" height="40"  class="lazyload" '.$lazycoment.'src="'.get_avatar_url($comment->comment_author_email).'"/></a></div>';  // Get Gravatar 
						$timeago = human_time_diff(strtotime( $comment->comment_date ), current_time('timestamp'));
						echo '<div class="comment-nd"><div style="margin-bottom:5px;"><a href="'.$comment->comment_author_url.'">'.$comment->comment_author.'</a> <span style="font-size:15px;">'. $timeago .' '. __('trước', 'fox') . '</span></div>';
						global $search_icon, $replace_icon;
						$loc_comen = str_replace($search_icon, $replace_icon, $comment->comment_content);
						echo '<div>' . $loc_comen . '</div>';
						echo '</div></div>';
					}
				}
				echo '</div></div></div>';
        }
    }
// WEDGET THỜI TIẾT
class fox_weather extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget3',
			'Fox Weather',
			array(
			'description' => __('Hiển thị thời tiết', 'fox')
			)
			);
        }
        
        // Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$lang = esc_attr($instance['lang']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Địa điểm thời tiết', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			return $instance;
			
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$title = $instance['title'];
			?>
				<!-- Card thời tiết -->	
                <div id="thoitiet" class="thoitiet">
                <div class="searchtiet">
                      <input type="text" class="search-bar" id="otiet" placeholder="<?php _e('Tìm kiếm địa điểm', 'fox'); ?>">
                      <button title="search" id="timtiet"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="weather loading">
                      <div class="city"></div>
                      <div class="temp"></div>
					  <div style="flex">
					  <span class="temp-min"></span>
					  <span class="temp-max"></span>
					  </div>
                	  <div class="may">
                      <img alt="Cloud"  width="40" height="40" class="maytroi" src="<?php echo get_template_directory_uri(); ?>/images/weather/icon/04d.png" />
                      <span class="description"></span>
                	  </div>
                	  <div class="tietthem">
                      <span class="humidity"></span>
                      <span class="wind"></span>
					  <span class="pressure"></span>
                	  </div>
                </div>
                </div>
                <script>
				var weatherimg = <?php echo json_encode(get_template_directory_uri() . '/images/weather/icon/'); ?>;
				var weatherbg = <?php echo json_encode(get_template_directory_uri() . '/images/weather/background/'); ?>;
                var diadiem = <?php if (!empty($title)){ echo json_encode($title); } else {echo  json_encode('Ha noi');} ?>;
				var langtiet = <?php if (get_locale() == 'vi') { echo '"vi"'; } else {echo '"us"';} ?>;
				var doam = <?php echo json_encode(__('Độ ẩm', 'fox')); ?>;
				var sucgio = <?php echo json_encode(__('Gió', 'fox')); ?>;
				var apsuat = <?php echo json_encode(__('Áp suất', 'fox')); ?>;
				var nodiadiem = <?php echo json_encode(__('Không có địa điểm', 'fox')); ?>;
                </script>
			<?php
        }
    }
// WIDGET POST SOLID
class fox_post_slide extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget4',
			'Fox Post slide',
			array(
			'description' => __('Hiển thị bài viết theo slide', 'fox')
			)
			);
        }

        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/face', get_post_type() );
        }
    }
    

// WIDGET HIỂN THỊ CHUYÊN MỤC TUỲ CHỌN
class fox_categories extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget5',
			'Fox Categories',
			array(
			'description' => __('Hiển thị bài viết theo slide', 'fox')
			)
			);
        }
        
        // Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id1' => '',
			  'id2' => '',
			  'id3' => '',
			  'id4' => '',
			  'grid' => '',

			);
			$instance = wp_parse_args($instance, $default);
			$id1 = esc_attr($instance['id1']);
			$id2 = esc_attr($instance['id2']);
			$id3 = esc_attr($instance['id3']);
			$id4 = esc_attr($instance['id4']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false'; ?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'fox'); ?></label></p>
			<?php
			// get chuyen muc ID1
			$cats = get_the_category();
                    if( $cats ) {
                    $id1 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id1'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id1
            ) ); echo '<br/>';
            // get chuyen muc ID2
			$cats = get_the_category();
                    if( $cats ) {
                    $id2 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id2'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id2
            ) ); echo '<br/>';
            // get chuyen muc ID3
			$cats = get_the_category();
                    if( $cats ) {
                    $id3 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id3'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id3
            ) ); echo '<br/>';
            // get chuyen muc ID4
			$cats = get_the_category();
                    if( $cats ) {
                    $id4 = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id4'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id4
            ) );
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['grid'] = $new_instance['grid'];
			$instance['id1'] = $new_instance['id1'];$instance['id2'] = $new_instance['id2'];$instance['id3'] = $new_instance['id3'];$instance['id4'] = $new_instance['id4'];
			return $instance;
			
        }

        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			<div class="post-cm" <?php if ('on' == $instance['grid']) { echo 'style="grid-template-columns: 1fr 1fr;"'; } ?> data-aos="fade-in">
			    <a style="border-left: 5px solid var(--texta);display:flex" href="<?php echo get_category_link( $instance['id1'] ); ?>"><span style="width:100%"><i class="fa-regular fa-bolt" style="margin-right:10px;color:var(--texta);"></i><?php echo get_cat_name( $category_id = $instance['id1'] );?></span><span style="width:30px;"><i class="fa-solid fa-circle-chevron-right"></i><span></a>
			    <a style="border-left: 5px solid var(--texta);display:flex" href="<?php echo get_category_link( $instance['id2'] ); ?>"><span style="width:100%"><i class="fa-regular fa-bolt" style="margin-right:10px;color:var(--texta);"></i><?php echo get_cat_name( $category_id = $instance['id2'] );?></span><span style="width:30px;"><i class="fa-solid fa-circle-chevron-right"></i><span></a>
			    <a style="border-left: 5px solid var(--texta);display:flex" href="<?php echo get_category_link( $instance['id3'] ); ?>"><span style="width:100%"><i class="fa-regular fa-bolt" style="margin-right:10px;color:var(--texta);"></i><?php echo get_cat_name( $category_id = $instance['id3'] );?></span><span style="width:30px;"><i class="fa-solid fa-circle-chevron-right"></i><span></a>
			    <a style="border-left: 5px solid var(--texta);display:flex" href="<?php echo get_category_link( $instance['id4'] ); ?>"><span style="width:100%"><i class="fa-regular fa-bolt" style="margin-right:10px;color:var(--texta);"></i><?php echo get_cat_name( $category_id = $instance['id4'] );?></span><span style="width:30px;"><i class="fa-solid fa-circle-chevron-right"></i><span></a>
		    </div>
			<?php
        }
    }
// WEDGET TIME
class fox_time extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget6',
			'Fox Time',
			array(
			'description' => __('Hiển thị thời gian', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- Card thời gian -->	
                <div class="lich">
                  <div class="days"><span id="days"></span></div>
                  <div id="dates"></div>
                  <div class="timex"><span><i class="fa-regular fa-clock-three"></i></span><span id="times"></span></div>
                </div>
				<script>
				var varthang = <?php _e('["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"]', 'fox'); ?>;
				var varthu = <?php _e('["Chủ Nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7"]', 'fox'); ?>;
				</script>
			<?php
        }
    }
// WEDGET BICOIN
class fox_coin extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget7',
			'Fox Coin',
			array(
			'description' => __('Hiển thị Coin', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- coin -->
				<div class="card-coin">
				<?php global $fox_options;?>
				<div class="title-coin"><a title="<?php _e('Xem thêm', 'fox'); ?>" href="https://coingecko.com"><i class="fa-brands fa-bitcoin"></i> <?php _e('Thị trường coin', 'fox'); ?></a></div>
                <div class="nd-coin"><div class="hinhcoin"><img width="60px" height="60px" alt="<?php echo get_site_url(); ?>"  class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_template_directory_uri(); ?>/images/widget/btc.png" /></div><div class="socoin"><span class="bic1">Bitcoin <span class="tag-coin">BTC</span></span></span><span class="bic2" id="bitcoin"></span></div></div>
                <div class="nd-coin"><div class="hinhcoin"><img width="60px" height="60px" alt="<?php echo get_site_url(); ?>"  class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_template_directory_uri(); ?>/images/widget/eth.png" /></div><div class="socoin"><span class="bic1">Ethereum <span class="tag-coin">ETH</span></span><span class="bic2" id="ethereum"></span></div></div>
                <div class="nd-coin"><div class="hinhcoin"><img width="60px" height="60px" alt="<?php echo get_site_url(); ?>"  class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_template_directory_uri(); ?>/images/widget/usdt.png" /></div><div class="socoin"><span class="bic1">Tether <span class="tag-coin">USDT</span></span><span class="bic2" id="tether"></span></div></div>
                <div class="nd-coin"><div class="hinhcoin"><img width="60px" height="60px" alt="<?php echo get_site_url(); ?>"  class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_template_directory_uri(); ?>/images/widget/doge.png" /></div><div class="socoin"><span class="bic1">Dogecoin <span class="tag-coin">DOGE</span></span><span class="bic2" id="dogecoin"></span></div></div>
                <div class="nd-coin"><div class="hinhcoin"><img width="60px" height="60px" alt="<?php echo get_site_url(); ?>"  class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_template_directory_uri(); ?>/images/widget/sol.png" /></div><div class="socoin"><span class="bic1">Solana <span class="tag-coin">SOL</span></span><span class="bic2" id="solana"></span></div></div>
                </div>
			<?php
        }
    }
// WEDGET AM LCIH
class fox_lunar extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget8',
			'Fox Lunar',
			array(
			'description' => __('Hiển thị âm lịch', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- am lich -->
				<div class="amlichv">
				<?php global $fox_options;?>
				<div id="amlich-calendar"></div>
	            <script <?php if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
                  jQuery(function() {
                    jQuery('#amlich-calendar').amLich({
                      type: 'calendar',
                      tableWidth: '100%'
                    });
                  });
                  </script>
                </div>
			<?php
        }
    }
// WEDGET ALL TAG
class fox_tag extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget9',
			'Fox Tag',
			array(
			'description' => __('Hiển thị tất cả tag', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?> 
			    <!-- Tag -->
				<div class="box-card widget-tag" style="padding:17px;margin-bottom:20px">
				    <div class="scroll-tag">
				    <?php 
                     $tags = get_tags();
                     if ($tags) { ?>
                      <?php
                        foreach ($tags as $tag) {
                        echo '<a href="'.get_tag_link( $tag->term_id ).'" title="'.sprintf( __( "Xem %s" ), $tag->name ).'" '.'># '.$tag->name.'</a>';
                      } 
                     } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} ?>
                    </div>
                </div>
			<?php
        }
    }
// WEDGET SEARCH
class fox_search extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget10',
			'Fox Search',
			array(
			'description' => __('Hiển thị box tìm kiếm', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			        <!-- tim kiem -->
                	<form method="get" action="<?php bloginfo('url'); ?>">
                	<div class="timkiem">
                	<input id="otim" placeholder="<?php _e('Nhập nội dung cần tìm kiếm', 'fox'); ?>" type="text" name="s" value="" maxlength="50" required="required" />
                	<button title="Search" type="submit" id="nuttim"><i class="fas fa-search"></i></button>
                	</div>
                	</form>
					<div class="widget-search">
					<?php
					$foxpost = new WP_Query(array(
					'post_type'=>'post',
					'post_status'=>'publish',
					'order'      => 'DESC',
					'posts_per_page'=> 3,
					'post__not_in' => get_option("sticky_posts"),
					'orderby' => 'rand',
					));
					if( $foxpost->have_posts() ) {
					while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
					<h3 class="widget-search-tit"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><i class="fa-regular fa-magnifying-glass"></i> <?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
					<?php
					endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
					wp_reset_query();?>
					</div>
			<?php
        }
    }
// WEDGET BÀI VIẾT CÓ NHIỀU LƯỢT XEM
    class fox_post_views extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget11',
			'Fox Post views',
			array(
			'description' => __('Hiển thị bài viết có nhiều lượt xem', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'total' => '',
			  'grid' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$total = esc_attr($instance['total']);
			$grid = $instance[ 'grid' ] ? 'true' : 'false';
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
			?>
			<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'grid' ); ?>" name="<?php echo $this->get_field_name( 'grid' ); ?>" /> 
            <label><?php _e('Lưới', 'fox'); ?></label></p>
            <?php
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['total'] = $new_instance['total'];
			$instance['grid'] = $new_instance['grid'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);

				$foxpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'meta_key'  => 'post_views_count', // set custom meta key
                'orderby'    => 'meta_value_num',
                'order'      => 'DESC',
				'posts_per_page'=> $instance['total'],
				'post__not_in' => get_option("sticky_posts"),
				));
				?>
				<div class="lienquan" style="margin-bottom:20px;">
				<div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php _e('Có nhiều lượt xem', 'fox'); ?></div>
				<div class="lienquan-box" <?php if ('on' == $instance['grid']) { echo 'style="display:grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;grid-row-gap: 10px;"'; } ?> >
				<?php
				global $fox_options;
				if( $foxpost->have_posts() ) {
				while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
				<div class="lq-lienquan lq-lienquan-new">
				<div class="lq-anhav-view">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
				<div class="lq-anh-view"><span class="lq-sobai"></span></div>
				</div>
				<div>
				<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="view-lxem"><?php echo getPostViews(get_the_ID()); ?></span>
				</div>
				</div>
				<?php
				endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}  
				wp_reset_query(); ?>
				</div>
				</div>
			<?php
        }
    }
// WEDGET BÀI VIẾT RANK
    class fox_post_rank extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget12',
			'Fox Post rank',
			array(
			'description' => __('Hiển thị bài viết có nhiều lượt xem và thịnh hành', 'fox')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/rank', get_post_type() );
        }
    }
// WEDGET BÀI VIẾT BANNER
    class fox_post_banner extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget13',
			'Fox Post banner',
			array(
			'description' => __('Hiển thị bài viết theo dạng banner slide', 'fox')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/banner', get_post_type() );
        }
    }
    
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC SLIDE
    class fox_post_pro extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget14',
			'Fox Post pro',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục slide', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			<div class="lienquan-pro" style="margin-bottom:20px;"><div class="lienquan-title"><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Bạn nên xem', 'fox');} ?> <span class="xemthem" style="float:right;margin-top:0px" ><a href="<?php echo get_category_link( $instance['id'] ); ?>"><?php _e('Thêm', 'fox'); ?> <i class="fa-solid fa-arrow-right"></i></a></span></div>
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $fox_options;
			$foxpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $instance['id'],
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $instance['total'],
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="itenbai">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			<div class="itembai1ten"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query() ;?>
			</div>
			</div>
			</div>
<?php
        }
    }

// WEDGET TINH KHOAN VAY
class fox_loan extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget15',
			'Fox Loan',
			array(
			'description' => __('Hiển thị tính khoản vay', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- Card khoan vay -->	
				<div class="vdh_tragop">
					<div class="vdh_heading">
							<div class="vdh_title" id="loan"><i class="fa-regular fa-coins"></i> <?php _e('Tính lãi suất tiền vay', 'fox'); ?></div>
					</div>

					<form action="#" id="vdh_form">
						<div class="vdh_form_group">
							<label class="vdh_label"><?php _e('Số tiền vay (triệu đồng)', 'fox'); ?></label>
							<div id="so_tien_vay_direction"></div>
						</div>
						<div class="vdh_form_group">
							<label class="vdh_label"><?php _e('Kỳ hạn vay (tháng)', 'fox'); ?></label>
							<div id="ky_han_vay_direction"></div>
						</div>
						<div class="vdh_form_group">
							<label class="vdh_label"><?php _e('Lãi suất (%/năm)', 'fox'); ?></label>
							<div id="lai_suat_direction"></div>
						</div>
						<button type="submit" class="vdh_button" id="handle"><i class="fa-regular fa-file-export"></i> <?php _e('XUẤT KẾT QUẢ', 'fox'); ?></button>
					</form>

					<div class="vdh_modal">
						<div class="vdh_modal_content">
							<span class="vdh_close_button">&times;</span>
							
							<div>
								<p class="title_tra_gop"><i class="fa-regular fa-sack-dollar"></i> <?php _e('Đơn vị: VNĐ', 'fox'); ?></p>
							</div>

							<div class="vdh_tab">
								<button class="tablinks active" onclick="openTab(event, 'tab1')">
									<i class="fa-regular fa-grid-2"></i> <?php _e('DƯ NỢ GIẢM DẦN', 'fox'); ?>
								</button>
								<button class="tablinks" onclick="openTab(event, 'tab2')">
									<i class="fa-regular fa-grid-2"></i> <?php _e('ĐỀU HÀNG THÁNG', 'fox'); ?>
								</button>
							</div>

							<div id="tab1" class="vdh_tabcontent" style="display: block;">

								<table class="vdh_bang_tra_gop">
									<thead>
										<tr align="center" class="title-ky">
											<th width="10%"><i class="fa-regular fa-calendar-days"></i> <?php _e('Kỳ', 'fox'); ?></th>
											<th width="20%"><?php _e('Tổng số gốc còn nợ', 'fox'); ?></th>
											<th width="20%"><?php _e('Tiền gốc trả trong tháng', 'fox'); ?></th>
											<th width="25%"><?php _e('Tiền lãi trong tháng', 'fox'); ?></th>
											<th width="25%">
												<?php _e('Tổng số tiền thanh toán hàng tháng', 'fox'); ?>
											</th>
										</tr>
									</thead>
									<tbody class="ket_qua1">
										
									</tbody>

									<tfoot>
									    <tr>
											
									    </tr>
									</tfoot>
								</table>

							</div>

							<div id="tab2" class="vdh_tabcontent">
								<table class="vdh_bang_tra_gop">
									<thead>
										<tr align="center" class="title-ky">
											<th width="10%"><i class="fa-regular fa-calendar-days"></i> <?php _e('Kỳ', 'fox'); ?></th>
											<th width="30%"><?php _e('Tiền gốc hàng tháng', 'fox'); ?></th>
											<th width="30%"><?php _e('Tiền lãi hàng tháng', 'fox'); ?></th>
											<th width="30%">
												<?php _e('Tổng số tiền thanh toán hàng tháng', 'fox'); ?>
											</th>
										</tr>
									</thead>
									<tbody class="ket_qua2">
										
									</tbody>

									<tfoot>
									    <tr>
											
									    </tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

				</div>
			<?php
        }
    }
	
// WEDGET BÀI VIẾT BANNER
    class fox_top_post extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget16',
			'Fox Top post',
			array(
			'description' => __('Hiển thị bài viết mới ở trên cùng', 'fox')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( 'widget/post/grid', get_post_type() );
        }
    }





// WEDGET CHUYỂN ĐỔI TIỀN TỆ
class fox_converter extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget17',
			'Fox Converter',
			array(
			'description' => __('Hiển thị bộ chuyển đổi tiền tệ', 'fox')
			)
			);
        }
        
        // Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$lang = esc_attr($instance['lang']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Nhập API key', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo '<p><a target="_blank" href="https://v6.exchangerate-api.com">'. __('Lấy API key ngay', 'fox') .'</a></p>';
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			return $instance;
			
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			$title = $instance['title'];
			?>
				  <div id="wconvert" class="wwrapper">
				  <div class="wtitle"><i class="fa-regular fa-sack-dollar"></i> <?php _e('Chuyển đổi tiền tệ', 'fox'); ?></div>
				  <form class="wform" action="#">
					<div class="wdrop-list">
					<div>
					  <div class="wbox">
						<div class="wselect-box">
						  <img src="https://flagcdn.com/48x36/us.png" alt="flag">
						  <select> <!-- Options tag are inserted from JavaScript --> </select>
						</div>
					  </div>
					  <div class="wto">
						<div class="wselect-box">
						  <img src="https://flagcdn.com/48x36/vn.png" alt="flag">
						  <select> <!-- Options tag are inserted from JavaScript --> </select>
						</div>
					  </div>
					</div>
					<div class="wicon"><div class="wbicon"><i class="fa-regular fa-rotate"></i></div></div>
					</div>
					<div class="exchange-rate"><?php _e('Đang chuyển đổi...', 'fox'); ?></div>
					<div class="wamount">
					  <div class="wxuat"><input type="text" value="1"><button><i class="fa-regular fa-arrow-right-arrow-left"></i></button></div>
					</div>
				  </form>
				</div>
                <script>
                var wapikey = <?php if (!empty($title)){ echo json_encode($title); }?>;
				var wxuatketqua = <?php echo json_encode(__('Đang chuyển đổi...', 'fox')); ?>;
				var wnoketqua = <?php echo json_encode(__('Đã xảy ra sự cố', 'fox')); ?>;
                </script>
			<?php
        }
    }

// WEDGET BÀI VIẾT THEO CHUYÊN MỤC PAGE
    class fox_post_page extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget18',
			'Fox Post page',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục có tải trang', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			echo ('<p><input type="text" class="widefat" placeholder="Tên chuyên mục" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			global $pagez, $onpage;
			?>
				<!-- bai viet theo chuyen muc -->
				<?php
				if(!empty($instance['id'])){$pagez = $onpage = $instance['id'];} else {$pagez = $onpage  = null;}
				$foxpost = new WP_Query(array(
				'post_type'=>'post',
				'post_status'=>'publish',
				'cat' => $instance['id'],
				'orderby' => 'ID',
				'order' => 'DESC',
				'paged' => !empty($_GET['pg'. $pagez]) ? absint($_GET['pg'. $pagez]) : 1,
				));
				?>
				<div class="post-page-title"><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){echo $instance['title'];} else { _e('Xem bài viết ngay', 'fox');} ?></div>
				<div class="main-bai" id="onpage<?php echo $onpage; ?>" style="margin-bottom:20px;">
				<?php
				if( $foxpost->have_posts() ) {
				while ($foxpost->have_posts()) : $foxpost->the_post();
				get_template_part( 'setcard', get_post_type() );
				endwhile;
				if(!empty(myPaginateLinks($foxpost))){ echo '<nav class="navigation pagination" aria-label="1"><div class="land-page">'. myPaginateLinks($foxpost) .'</div></nav>';}
				} else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
				wp_reset_query(); ?>
				</div>
				<?php
        }
    }

// WEDGET AUTHOR
    class fox_author extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget19',
			'Fox Author',
			array(
			'description' => __('Hiển thị hồ sơ của bạn', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'id' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$id = esc_attr($instance['id']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Nhập id user của bạn', 'fox') .'" name="'.$this->get_field_name('id').'" value="'.$id.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['id'] = $new_instance['id'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
				<!-- bai viet theo chuyen muc -->
				<div class="author-site-bg widget-author" >
				<img alt="<?php _e('Ảnh đại diện', 'fox'); ?>" width="150" height="150" class="lazyload" <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo esc_url( get_avatar_url( $instance['id'], ['size' => '150'])); ?>" />
				</div>			
				<div class="box-card author-site-box">
				<div class="author-site-card">
				<div><a href="<?php echo get_author_posts_url( get_the_author_meta( $instance['id'] ), get_the_author_meta( 'user_nicename', $instance['id'] ) ); ?>">
				<img alt="<?php _e('Ảnh đại diện', 'fox'); ?>" width="150" height="150" class="lazyload" <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo esc_url( get_avatar_url( $instance['id'], ['size' => '150'])); ?>" />
				</a></div>
				<div class="widget-author-xacthuc"><i class="fa-solid fa-circle-check"></i></div>
				<?php if(!empty(get_the_author_meta('first_name', $instance['id'])) || !empty(get_the_author_meta('last_name', $instance['id']))){ ?>
				<div class="author-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( $instance['id'] ), get_the_author_meta( 'user_nicename', $instance['id'] ) ); ?>"><?php echo get_the_author_meta('last_name', $instance['id']) .' '. get_the_author_meta('first_name', $instance['id']); ?></a></div><?php } ?>
				<?php if(!empty(get_the_author_meta('slogan', $instance['id']))) {echo '<div class="author-slogan"><span data-text="' . get_the_author_meta('slogan', $instance['id']) .'"></span></div>';} ?>
				<?php
				if(!empty(get_the_author_meta( 'facebook', $instance['id'])) || !empty(get_the_author_meta( 'twitter', $instance['id'])) || !empty(get_the_author_meta( 'tiktok', $instance['id'])) || !empty(get_the_author_meta( 'zalo', $instance['id'])) || !empty(get_the_author_meta( 'phone', $instance['id'])) || !empty(get_the_author_meta( 'telegram', $instance['id']))){ ?>
				<div class="author-icon">
				<?php if(!empty(get_the_author_meta( 'facebook', $instance['id']))){ ?><button title="Facebook" onclick="window.open('https://facebook.com/<?php the_author_meta( 'facebook', $instance['id']); ?>','_blank')"><i class="fa-brands fa-facebook"></i></button><?php } ?>
				<?php if(!empty(get_the_author_meta( 'twitter', $instance['id']))){ ?><button title="Twiiter" onclick="window.open('https://twitter.com/<?php the_author_meta( 'twitter', $instance['id']); ?>','_blank')"><i class="fa-brands fa-twitter"></i></button><?php } ?>
				<?php if(!empty(get_the_author_meta( 'telegram', $instance['id']))){ ?><button title="Telegram" onclick="window.open('https://telegram.me/<?php the_author_meta( 'telegram', $instance['id']); ?>','_blank')"><i class="fa-brands fa-telegram"></i></button><?php } ?>
				<?php if(!empty(get_the_author_meta( 'tiktok', $instance['id']))){ ?><button title="Tiktok" onclick="window.open('https://tiktok.com/@<?php the_author_meta( 'tiktok', $instance['id']); ?>','_blank')"><i class="fa-brands fa-tiktok"></i></button><?php } ?>
				<?php if(!empty(get_the_author_meta( 'zalo', $instance['id'])) && get_locale() == 'vi'){ ?><button title="Zalo" onclick="window.open('https://zalo.me/<?php the_author_meta( 'zalo', $instance['id']); ?>','_blank')"><i class="fa-solid fa-message-dots"></i></button><?php } ?>
				<?php if(!empty(get_the_author_meta( 'phone', $instance['id']))){ ?><button title="Phone" onclick='window.location.href = "tel:<?php the_author_meta( 'phone', $instance['id']); ?>"'><i class="fa-solid fa-circle-phone"></i></button><?php } ?>
				</div>
				<?php } 
				if(!empty(get_the_author_meta('description', $instance['id']))){ ?>
				<div class="widget-description ghichu">
				<?php the_author_meta( 'description', $instance['id']); ?>
				</div>
				<?php } ?>
				</div>
				</div>
				
				
				
				<?php
        }
    }
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC SLIDE GRADIENT
    class fox_post_gradient extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget20',
			'Fox Post gradient',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục slide có nền gradient', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			  'color1' => '',
			  'color2' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			$color1 = esc_attr($instance['color1']);
			$color2 = esc_attr($instance['color2']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo '<p style="font-weight:bold">'. __('Chọn màu nền gradient', 'fox') .'</p>';
			echo ('<p><input type="color" style="width:80px;height:50px" class="widefat"  name="'.$this->get_field_name('color1').'" value="'.$color1.'" /></p>');
			echo ('<p><input type="color" style="width:80px;height:50px" class="widefat"  name="'.$this->get_field_name('color2').'" value="'.$color2.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			$instance['color1'] = $new_instance['color1'];
			$instance['color2'] = $new_instance['color2'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			<div class="lienquan-pro widget-gradient-box" style="margin-bottom:20px;<?php if(!empty($instance['color1']) && !empty($instance['color2'])){ echo 'background: linear-gradient(153deg, '.$instance['color1'].' 0%, '.$instance['color2'].' 100%);';}?>">
			<div class="widget-gradient-tit"><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Bạn nên xem', 'fox');} ?> <span class="xemthem widget-gradient-more" style="float:right;margin-top:0px" ><a href="<?php echo get_category_link( $instance['id'] ); ?>"><?php _e('Thêm', 'fox'); ?> <i class="fa-solid fa-arrow-right"></i></a></span></div>
            <div class="top-face2">
            <div class="scrol">
            <?php 
			global $fox_options;
			$foxpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $instance['id'],
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $instance['total'],
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="itenbai">
				<?php if ( has_post_thumbnail()) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="facebai lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			<div class="itembai1ten"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 12 ) ?></a></div>
			</div>
			<?php endwhile; } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query();?>
			</div>
			</div>
			</div>
<?php
        }
    }
	
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC LINE COLOR
    class fox_post_line extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget21',
			'Fox Post line',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục có đường viền màu tùy chọn', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			  'color1' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			$color1 = esc_attr($instance['color1']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			echo '<p style="font-weight:bold">'. __('Chọn màu đường viền và tiêu đề', 'fox') .'</p>';
			echo ('<p><input type="color" style="width:80px;height:50px" class="widefat"  name="'.$this->get_field_name('color1').'" value="'.$color1.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			$instance['color1'] = $new_instance['color1'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			<div class="widget-line-tit" <?php if(!empty($instance['color1'])){ echo 'style="color:'.$instance['color1'] .';"';}?>><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Có thể bạn muốn xem qua', 'fox');} ?></div>
			<div class="widget-line-box" <?php if(!empty($instance['color1'])){ echo 'style="color:'.$instance['color1'] .';border:2px solid '.$instance['color1'] .';"';}?>>
			<?php 
			global $fox_options;
			$foxpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $instance['id'],
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $instance['total'],
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="widget-line-tg"><a <?php if(!empty($instance['color1'])){ echo 'style="color:'.$instance['color1'] .';"';}?> href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 25 ); ?>  <b><?php the_author(); ?></b></a> <span><?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span></div>
			<div class="widget-line-nd">
				<?php if ( has_post_thumbnail()) { ?>
				<a class="widget-line-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="450" height="200" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a class="widget-line-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="450" height="200" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>

				<div class="widget-line-text">
				  <h3><a <?php if(!empty($instance['color1'])){ echo 'style="color:'.$instance['color1'] .';"';}?> href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 15 ) ?></a></h3>
				  <div class="widget-line-note"><?php echo wp_trim_words( get_the_excerpt() , 20 ) ?></div>
				</div>
			</div>
			<?php endwhile; ?> 
			<button <?php if(!empty($instance['color1'])){ echo 'style="background:'.$instance['color1'] .';"';}?> id="widget-line-but" onclick="window.location.href='<?php echo get_category_link( $instance['id'] ); ?>'"><?php _e('Xem thêm bài viết', 'fox'); ?></button>
			<?php } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query(); ?>
			</div>			
<?php
        }
    }
	
// WEDGET BÀI VIẾT THEO CHUYÊN MỤC HAT
    class fox_post_hat extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget22',
			'Fox Post hat',
			array(
			'description' => __('Hiển thị bài viết theo chuyên mục có đường viền hạt', 'fox')
			)
			);
        }
		
		// Form cập nhật các option cho Widget
        function form($instance) {
			$default = array(
			  'title' => '',
			  'id' => '',
			  'total' => '',
			);
			$instance = wp_parse_args($instance, $default);
			$title = esc_attr($instance['title']);
			$id = esc_attr($instance['id']);
			$total = esc_attr($instance['total']);
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên chuyên mục', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
			// get chuyen muc
			$cats = get_the_category();
                    if( $cats ) {
                    $id = $cats[0]->term_id;
                    }
			wp_dropdown_categories( array(
                    'orderby'    => 'title',
                    'id'         => 'chuyen-muc-sua',
					'hide_empty' => false,
					'name' =>      $this->get_field_name('id'),
                    'class'      => 'form-control',
					'hierarchical' => true,
                    'selected'   => $id,
                    'post__not_in' => get_option("sticky_posts"),
            ) );
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Số lượng', 'fox') .'" name="'.$this->get_field_name('total').'" value="'.$total.'" /></p>');
        }
        
        // Hàm cập nhật Widget
        function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['id'] = $new_instance['id'];
			$instance['total'] = $new_instance['total'];
			return $instance;
			
        }
		
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			<div class="widget-hat-tit"><?php if(!empty($instance['title'])){ echo $instance['title'];} else { _e('Xem nhanh', 'fox');} ?></div>
			<div class="widget-hat-box">
			<?php 
			global $fox_options;
			$foxpost = new WP_Query(array( 
                    'post_type'=>'post',
                	'post_status'=>'publish',
                	'cat' => $instance['id'],
                	'orderby' => 'ID',
                	'order' => 'DESC',
                	'posts_per_page'=> $instance['total'],
                    'post__not_in' => get_option("sticky_posts"),
                    
            ));
			if( $foxpost->have_posts() ) {
			while ($foxpost->have_posts()) : $foxpost->the_post(); ?>
			<div class="widget-hat-nd">
				<div class="widget-hat-text">
				  <h3><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title() , 15 ) ?></a></h3>
				</div>
				<?php if ( has_post_thumbnail()) { ?>
				<a class="widget-hat-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="100" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho())){ ?>
				<a class="widget-hat-img" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="100" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				<?php } ?>
			</div>
			<?php endwhile; ?> 
			<?php } else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';}
			wp_reset_query(); ?>
			</div>			
<?php
        }
    }
	
// WEDGET CALENDA
class fox_calendar extends WP_Widget {
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget23',
			'Fox Calendar',
			array(
			'description' => __('Hiển thị box lịch ngày tháng', 'fox')
			)
			);
        }
        // Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			?>
			        <div class="date-wrapper" id="date-wrapper">
					  <div class="date-hed">
						<p class="current-date"></p>
						<div class="date-bieutuong">
						  <span id="date-prev"><i class="fa-regular fa-chevron-left"></i></span>
						  <span id="date-next"><i class="fa-regular fa-chevron-right"></i></span>
						</div>
					  </div>
					  <div class="date-calendar">
						<ul class="date-weeks">
						  <li><?php _e('T 2', 'fox'); ?></li>
						  <li><?php _e('T 3', 'fox'); ?></li>
						  <li><?php _e('T 4', 'fox'); ?></li>
						  <li><?php _e('T 5', 'fox'); ?></li>
						  <li><?php _e('T 6', 'fox'); ?></li>
						  <li><?php _e('T 7', 'fox'); ?></li>
						  <li><?php _e('CN', 'fox'); ?></li>
						</ul>
						<ul class="date-days"></ul>
					  </div>
					</div>
					<script>
					var datevarthang = <?php _e('["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"]', 'fox'); ?>;
					</script>
			<?php
        }
    }