<?php
/**
 * Template Name: Search Land
 */
get_header(); ?>
<?php
$land_title = $_GET['search'] ?? '';
$adress1 = $_GET['adress1'] ?? '';
$adress2 = $_GET['adress2'] ?? '';
$adress3 = $_GET['adress3'] ?? '';
$muc1 = $_GET['muc1'] ?? '';
$type2 = $_GET['type2'] ?? '';
$type3 = $_GET['type3'] ?? '';
$type4 = $_GET['type4'] ?? '';
$size1 = $_GET['size1'] ?? '';
$price1 = $_GET['price1'] ?? '';
?>
			<main>
				<?php
                get_template_part( '/template-parts/land-search', get_post_type() ); 
				if ( $land_title || $adress1 || $adress2 || $adress3 || $muc1 || $type2 || $type3 || $type4 || $size1 || $price1 ): ?>
						<?php
						$args = [
						    'post_type' => 'land',
							'paged' => !empty($_GET['pg']) ? absint($_GET['pg']) : 1,
							's' => $land_title,
							'sentence' => true,
							'tax_query' => [],
							'meta_query'     => []
						];
						if ($muc1) {
							$args['tax_query'][] = [
							'taxonomy' => 'muc',
							'field' => 'slug',
							'terms' => $muc1,
							];
						}
						if ($price1 && $price1 == 'max') {
							$args['meta_query'][] = ['key' => 'price1'];
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'ASC';
						}
						if ($price1 && $price1 == 'min') {
							$args['meta_query'][] = ['key' => 'price1'];
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'DESC';
						}
						if ($size1 && $size1 == 'max') {
							$args['meta_query'][] = ['key' => 'size3'];
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'ASC';
						}
						if ($size1 && $size1 == 'min') {
							$args['meta_query'][] = ['key' => 'size3'];
							$args['orderby'] = 'meta_value_num';
							$args['order'] = 'DESC';
						}
						if ($adress1) {
							$args['meta_query'][] = [
							    'post_type' => 'land',
								'key'     => 'adress1',
								'value'   => $adress1,
								'compare' => '=',
								
							];
						}
						if ($adress2) {
							$args['meta_query'][] = [
								'key'     => 'adress2',
								'value'   => $adress2,
								'compare' => '=',
							];
						}
						if ($adress3) {
							$args['meta_query'][] = [
								'key'     => 'adress3',
								'value'   => $adress3,
								'compare' => '=',
							];
						}
						if ($type2) {
							$args['meta_query'][] = [
								'key'     => 'type2',
								'value'   => $type2,
								'compare' => '=',
							];
						}
						if ($type3) {
							$args['meta_query'][] = [
								'key'     => 'type3',
								'value'   => $type3,
								'compare' => '=',
							];
						}
						if ($type4) {
							$args['meta_query'][] = [
								'key'     => 'type4',
								'value'   => $type4,
								'compare' => '=',
							];
						}
						if ($size1 && $size1 == 99) {
							$args['meta_query'][] = [
								'key'     => 'size3',
								'value'   => $size1,
								'compare' => '<=',
                                'type' => 'NUMERIC'
							];
						}
						if ($size1 && $size1 == 100) {
							$args['meta_query'][] = [
								'key'     => 'size3',
								'value'   => $size1,
								'compare' => '>=',
                                'type' => 'NUMERIC'
							];
						}
						if ($price1 && $price1 == 999999999) {
							$args['meta_query'][] = [
								'key'     => 'price1',
								'value'   => $price1,
								'compare' => '<=',
                                'type' => 'NUMERIC'
							];
						}
						if ($price1 && $price1 == 1000000000) {
							$args['meta_query'][] = [
								'key'     => 'price1',
								'value'   => $price1,
								'compare' => '>=',
                                'type' => 'NUMERIC'
							];
						}
						$search_query = new WP_Query( $args );
						if ( $search_query->have_posts() ): ?>
						<div id="main" class="main-bai">
						<?php
							while ( $search_query->have_posts() ):
								$search_query->the_post();
								get_template_part( '/setcard', get_post_type() );
							endwhile; ?>
						</div>
						<?php if(!empty(myPaginateLinks($search_query))){ echo '<div class="land-page">'. myPaginateLinks($search_query) .'</div>'; }
						wp_reset_postdata(); ?>
						<?php else: ?>
					    <div class="land-error">
						<img title="<?php _e('Lỗi', 'fox'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/error.png" />
		                <h1 class="noidung-h2">Lỗi lọc nội dung :)</h1>
						Không tìm thấy nội dung mà bạn đã lọc
						</div>
						<?php endif; ?>
				<?php else : ?>
				<div class="land-error">
				<img title="<?php _e('Lỗi', 'fox'); ?>" src="<?php echo get_template_directory_uri(); ?>/images/error.png" />
				<h1 class="noidung-h2">Lọc nội dung bất động sản :)</h1>
				Sử dụng bộ lọc ở trên để lọc nội dung mà bạn muốn
				</div>
				<?php endif; ?>
			</main>
<?php get_footer();