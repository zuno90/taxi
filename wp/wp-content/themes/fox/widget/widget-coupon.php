<?php
// WEDGET COUPON PAGE
    class fox_coupon extends WP_Widget {
        
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget_coupon1',
			'Fox Coupon',
			array(
			'description' => __('Hiển thị tất cả coupon', 'fox')
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
			echo ('<p><input type="text" class="widefat" placeholder="'. __('Tên hiển thị', 'fox') .'" name="'.$this->get_field_name('title').'" value="'.$title.'" /></p>');
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
			global $pagez, $onpage;
			?>
				<!-- bai viet theo chuyen muc -->
				<?php
				if(!empty($instance['id'])){$pagez = $onpage = $instance['id'];} else {$pagez = $onpage  = null;}
				$foxpost = new WP_Query(array(
				'post_type'=>'coupon',
				'post_status'=>'publish',
				'orderby' => 'ID',
				'order' => 'DESC',
				'posts_per_page'=> $instance['total'],
				'paged' => !empty($_GET['pg'. $pagez]) ? absint($_GET['pg'. $pagez]) : 1,
				));
				?>
				<div class="post-page-title"><i class="fa-regular fa-bolt"></i> <?php if(!empty($instance['title'])){echo $instance['title'];} else { _e('COUPON', 'fox');} ?> / <a title="<?php _e('Xem tất cả mã giảm giá', 'fox'); ?>" href="<?php echo get_site_url(); ?>/coupon"><?php _e('XEM NGAY', 'fox'); ?></a></div>
				<div id="onpage<?php echo $onpage; ?>" style="margin-bottom:20px;">
				<?php
				global $post;
				if( $foxpost->have_posts() ) {
				while ($foxpost->have_posts()) : $foxpost->the_post();
				get_template_part( 'template-parts/coupon', get_post_type() );
				endwhile;
				if(!empty(myPaginateLinks($foxpost))){ echo '<nav class="navigation pagination" aria-label="1"><div class="land-page">'. myPaginateLinks($foxpost) .'</div></nav>';}
				} else {echo '<div class="nopost"><span><i class="fa-regular fa-circle-exclamation"></i> '.__('Không có nội dung', 'fox'). '</span></div>';} 
				wp_reset_query(); ?>
				</div>
				<?php
        }
    }