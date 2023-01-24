<?php
// WEDGET SEARCH LAND
    class fox_land_search extends WP_Widget {    
		// Thông tin Widget
		function __construct() {
			parent::__construct(
			'fox_widget_land1',
			'Fox Land search',
			array(
			'description' => __('Hiển tìm kiếm nhà đất', 'fox')
			)
			);
        }
		// Hiển thị nội dung Widget lên website
        function widget($args, $instance) {
			extract($args);
			get_template_part( '/template-parts/land-search', get_post_type() ); 
        }
    }