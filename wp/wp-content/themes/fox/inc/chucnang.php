<?php
// ramdam bài viết ở top face
function wpse260713_randomize_posts( $sql_query, $query ) {
    $rand = (int) $query->get( '_randomize_posts_count' );
    if( $rand ) {
        $found_rows = '';
        if( stripos( $sql_query, 'SQL_CALC_FOUND_ROWS' ) !== FALSE ) {
            $found_rows = 'SQL_CALC_FOUND_ROWS';
            $sql_query = str_replace( 'SQL_CALC_FOUND_ROWS ', '', $sql_query );
        }
        $sql_query = sprintf( 'SELECT %s wp_posts.* from ( %s ) wp_posts ORDER BY rand() LIMIT %d', $found_rows, $sql_query, $rand );
    }
    return $sql_query;
}
add_filter( 'posts_request', 'wpse260713_randomize_posts', 10, 2 );
// ảnh đại diện bài viết home
function fox_anh_dai_dien() {
global $post;
$first_img = '';
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
if(isset($matches[1][0])){
$first_img = $matches[1][0];
}
return $first_img;
}
// ảnh đại diện bài viết nhỏ
function fox_anh_dai_dien_nho() {
global $post, $posts, $wpdb;
$first_img = '';
if(preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches)){
if(isset($matches[1][0])){
$first_img = $matches [1][0];
}
return $first_img;
}
else {
$first_img = get_template_directory_uri() . '/images/anh-dai-dien.png';
return $first_img;
}
}
// thoi gian tinh theo ngay thang nam
function fox_time($from, $to = '') {
    if (empty($to))
        $to = time();
    $diff = (int) abs($to - $from);
    if ($diff < HOUR_IN_SECONDS) {
        $mins = round($diff / MINUTE_IN_SECONDS);
        if ($mins <= 1)
            $mins = 1;
        /* translators: min=minute */
        $since = sprintf(_n(__('%s phút', 'fox'), __('%s phút', 'fox'), $mins), $mins);
    } elseif ($diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS) {
        $hours = round($diff / HOUR_IN_SECONDS);
        if ($hours <= 1)
            $hours = 1;
        $since = sprintf(_n(__('%s giờ', 'fox'), __('%s giờ', 'fox'), $hours), $hours);
    } elseif ($diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS) {
        $days = round($diff / DAY_IN_SECONDS);
        if ($days <= 1)
            $days = 1;
        $since = sprintf(_n(__('%s ngày', 'fox'), __('%s ngày', 'fox'), $days), $days);
    } elseif ($diff < 30 * DAY_IN_SECONDS && $diff >= WEEK_IN_SECONDS) {
        $weeks = round($diff / WEEK_IN_SECONDS);
        if ($weeks <= 1)
            $weeks = 1;
        $since = sprintf(_n(__('%s tuần', 'fox'), __('%s tuần', 'fox'), $weeks), $weeks);
    } elseif ($diff < YEAR_IN_SECONDS && $diff >= 30 * DAY_IN_SECONDS) {
        $months = round($diff / (30 * DAY_IN_SECONDS));
        if ($months <= 1) $months = 1; $since = sprintf(_n(__('%s tháng', 'fox'), __('%s tháng', 'fox'), $months), $months); } elseif ($diff >= YEAR_IN_SECONDS) {
        $years = round($diff / YEAR_IN_SECONDS);
        if ($years <= 1)
            $years = 1;
        $since = sprintf(_n(__('%s năm', 'fox'), __('%s năm', 'fox'), $years), $years);
    }
    return $since;
}
// get code setting
goto YNBkO; YNBkO: $fox_options = get_option("\146\x6f\x78\137\x73\x65\164\x74\151\x6e\x67\x73"); goto FbSwd; FbSwd: if (fox_admin_view_script_v1() != "\x6c\x69\155\x69\x74") { $scurity_options = get_option("\163\143\165\162\151\x74\x79\x5f\x73\x65\164\x74\x69\x6e\x67\163"); $media_options = get_option("\155\x65\x64\x69\x61\137\163\x65\164\x74\x69\x6e\147\163"); $addcode_options = get_option("\141\x64\144\x63\157\144\x65\137\163\145\x74\x74\151\x6e\147\x73"); $adsense_options = get_option("\141\x64\x73\x65\x6e\x73\x65\137\163\145\x74\x74\151\156\147\163"); $notify_options = get_option("\x6e\x6f\x74\151\x66\x79\x5f\x73\x65\x74\164\151\156\x67\x73"); $comment_options = get_option("\143\157\x6d\155\x65\156\x74\137\x73\x65\164\164\x69\x6e\147\163"); $onchat_options = get_option("\x6f\156\143\x68\x61\164\137\163\145\x74\164\x69\156\147\x73"); $story_options = get_option("\163\x74\157\x72\171\x5f\x73\145\x74\164\151\156\x67\x73"); $land_options = get_option("\x6c\x61\156\144\137\163\x65\164\x74\151\x6e\147\163"); $shopp_options = get_option("\x73\x68\x6f\x70\160\x5f\163\145\164\x74\151\156\147\163"); $codex_options = get_option("\x63\157\x64\x65\170\137\163\x65\x74\x74\151\156\147\163"); $login_options = get_option("\x6c\x6f\147\x69\x6e\137\163\x65\164\x74\x69\x6e\x67\163"); $error_options = get_option("\145\x72\162\157\x72\x5f\x73\x65\x74\x74\151\x6e\147\x73"); } goto LGHxf; LGHxf: 
// kết thúc tạo sanh sách matric
// loai page ra khoi tim kiem
function fox_remove_searchpage($query) {
if ( is_admin() || ! $query->is_main_query() )
return;
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
add_filter('pre_get_posts','fox_remove_searchpage');

// them id cho the h1 h2 o bai viet
function fox_add_headings( $content ) {
	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );
    return $content;
}
add_filter( 'the_content', 'fox_add_headings' );
// add js css 
function fox_enqueue_assets(){
global $fox_options;
// chuc nang
if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){
wp_enqueue_script( 'img-lazy', get_template_directory_uri() . '/inc/js/lazysizes.min.js', array('jquery'), '', true);
}
wp_enqueue_script( 'chucnang', get_template_directory_uri() . '/inc/js/chucnang.js', array('jquery'), '', true);
wp_enqueue_script( 'weather', get_template_directory_uri() . '/inc/js/weather.js', array('jquery'), '', true);
if(!isset($fox_options['speed1']) || !isset($fox_options['speed4']) || !isset($fox_options['speed3']) || is_user_logged_in()) {
wp_enqueue_style('icon', get_template_directory_uri() . '/fox/main/css/all.css');
}
// js tối ưu hoá
if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()) {
wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.min.js', array('jquery'), '', true);
}
if( is_single() ) {
// post js
wp_enqueue_script( 'post', get_template_directory_uri() . '/inc/js/post.js', array('jquery'), '', true);
// tocbot
if(isset($fox_options['set3'])) {
wp_enqueue_script( 'tocbotjs', get_template_directory_uri() . '/inc/js/tocbot.min.js');
wp_enqueue_style('tocbotcss', get_template_directory_uri() . '/inc/css/tocbot.css');
}
// zoom
if(isset($fox_options['set2'])) {
wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/js/fancybox.js');
wp_enqueue_style('fancybox', get_template_directory_uri() . '/inc/css/fancybox.css');
}
}
}
add_action('wp_enqueue_scripts', 'fox_enqueue_assets');
// add code mau
if(isset($fox_options['set4'])) {
function fox_add_code_mau_footer(){
if ( !is_single() ) { return; }
ob_start(); ?>
<script <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript"<?php } ?>>
jQuery(document).ready(function($){
$('pre').attr("id","showcode");
$('<div class="pre-tit"><span></span><span></span><span></span></div>').insertBefore('#showcode');
});
</script>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_code_mau_footer');
}
// add font google
function fox_add_font(){
global $fox_options;
ob_start(); ?>
<style>
<?php if($fox_options['font'] == 'Default') {echo '';}
if($fox_options['font'] == 'Oswald') { ?>
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Oswald', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'Arial') {
?>
body button, body input, body textarea, body select, html{font-family: Arial, Helvetica, sans-serif !important;}
<?php } 
if($fox_options['font'] == 'Nunito') {
?>
@import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Nunito', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'JosefinSans') {
?>
@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Josefin Sans', sans-serif !important;}
<?php 
}
if($fox_options['font'] == 'Montserrat') {
?>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Montserrat', sans-serif !important;}
<?php }
if($fox_options['font'] == 'RobotoCondensed') {
?>
@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Roboto Condensed', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'OpenSans') {
?>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Open Sans', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Raleway') {
?>
@import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Raleway', sans-serif !important;}
<?php }
if($fox_options['font'] == 'PlayfairDisplay') {
?>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Playfair Display', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Inter') {
?>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Inter', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'Lora') {
?>
@import url('https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Lora', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Quicksand') {
?>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Quicksand', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Kanit') {
?>
@import url('https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Kanit', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Comfortaa') {
?>
@import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Comfortaa', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Prompt') {
?>
@import url('https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Prompt', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'IBMPlexSerif') {
?>
@import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'IBM Plex Serif', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Spectral') {
?>
@import url('https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Spectral', sans-serif !important;}
<?php }
if($fox_options['font'] == 'Philosopher') {
?>
@import url('https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Philosopher', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'Taviraj') {
?>
@import url('https://fonts.googleapis.com/css2?family=Taviraj:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Taviraj', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'ReadexPro') {
?>
@import url('https://fonts.googleapis.com/css2?family=Readex+Pro:wght@200;300;400;500;600;700&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Readex Pro', sans-serif !important;}
<?php } 
if($fox_options['font'] == 'Anybody') {
?>
@import url('https://fonts.googleapis.com/css2?family=Anybody:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body button, body input, body textarea, body select, html{font-family: 'Anybody', sans-serif !important;}
<?php } ?>
</style>
<?php echo ob_get_clean();    
}
add_action('wp_head', 'fox_add_font');
// Khởi chạy chức năng tối ưu hoá cho website----------------------------------------------------------------------------------------------
global $fox_options;
if(isset($fox_options['speed1']) && isset($fox_options['speed3'])) {
// tai cham js tang toc site
function defer_parsing_of_jss( $url ) {
    if ( is_user_logged_in() ) {
    return $url; 
    }
    if (FALSE === strpos( $url, '.js' )){ 
    return str_replace( ' src', ' type="rocketlazyloadscript" src', $url );
    }
    if (FALSE !== strpos( $url, 'lazyload.min.js' ) || FALSE !== strpos( $url, 'chucnang.js' )){
    return $url;
    }
    else
    {
    return str_replace( ' src', ' type="rocketlazyloadscript" src', $url );    
    }
}
add_filter( 'script_loader_tag', 'defer_parsing_of_jss', 10 );
}
// Khởi chạy chức năng tối ưu hoá cho website----------------------------------------------------------------------------------------------
// Remove jquery-migrate
if(isset($fox_options['speed5'])){
function remove_jquery_migrate( $scripts ) {
   if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
   if ( $script->deps ) { 
        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
 }
 }
 }
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
}
// Add tự động trang chuyển hướng liên kết
$link_inc1 = "Link";
if (get_page_by_title($link_inc1) == NULL){
$my_post_inc1 = array(
	  'import_id'			  => 3000,
      'post_title'    => $link_inc1,
      'post_status'   => 'publish',
	  'page_template' => 'link.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'link'
    );
 wp_insert_post( $my_post_inc1 );
}
// remove chuyenmuc: title, lưu trữ, tác gia
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) { 
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});
// Code Đếm lượt xem bài viết
function getPostViews($postID, $is_single = true){
global $post;
if(!$postID) $postID = $post->ID;
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if(!$is_single){
return '<span class="svl_show_count_only">'.$count.' '. __('lượt xem', 'fox') .'</span>';
}
$nonce = wp_create_nonce('devvn_count_post');
if($count == "0" || empty($count) || !isset($count)){
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
return '<span class="svl_post_view_count" data-id="'.$postID.'" data-nonce="'.$nonce.'">0 '.__('lượt xem', 'fox') .'</span>';
}
return '<span class="svl_post_view_count" data-id="'.$postID.'" data-nonce="'.$nonce.'">'.$count.' '. __('lượt xem', 'fox') .'</span>';
}
function setPostViews($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count == "0" || empty($count) || !isset($count)){
add_post_meta($postID, $count_key, 1);
update_post_meta($postID, $count_key, 1);
}else{
$count++;
update_post_meta($postID, $count_key, $count);
}
}
add_action( 'wp_ajax_svl-ajax-counter', 'svl_ajax_callback' );
add_action( 'wp_ajax_nopriv_svl-ajax-counter', 'svl_ajax_callback' );
function svl_ajax_callback() {
if ( !wp_verify_nonce( $_REQUEST['nonce'], "devvn_count_post")) {
exit();
}
$count = 0;
if ( isset( $_GET['p'] ) ) {
global $post;
$postID = intval($_GET['p']);
$post = get_post( $postID );
if($post && !empty($post) && !is_wp_error($post)){
setPostViews($post->ID);
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
}
}
die($count.' '. __('lượt xem', 'fox'));
}
add_action( 'wp_footer', 'svl_ajax_script', PHP_INT_MAX );
function svl_ajax_script() {
if(!is_single()) return;
?>
<script <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
(function($){
$(document).ready( function() {
$('.svl_post_view_count').each( function( i ) {
var $id = $(this).data('id');
var $nonce = $(this).data('nonce');
var t = this;
$.get('<?php echo admin_url( 'admin-ajax.php' ); ?>?action=svl-ajax-counter&nonce='+$nonce+'&p='+$id, function( html ) {
$(t).html( html );
});
});
});
})(jQuery);
</script>
<?php
}
//CODE HIEN THI SO LUOT XEM BAI VIET TRONG DASHBOARDH
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
$defaults['post_views'] = __( 'Lượt xem' , 'fox');
return $defaults;
}
function posts_custom_column_views($column_name, $id){
if( $column_name === 'post_views' ) {
echo getPostViews( get_the_ID(), false);
}
}
// thong bao loi
add_filter('wp_die_handler', 'get_my_custom_die_handler');
function get_my_custom_die_handler() {
    return 'my_custom_die_handler';
}
function my_custom_die_handler($message, $title='', $args=array()) {
 $errorTemplate = get_theme_root().'/'.get_template().'/eror.php';
 if(!is_admin() && file_exists($errorTemplate)) {
    $defaults = array( 'response' => 500 );
    $r = wp_parse_args($args, $defaults);
    $have_gettext = function_exists('__');
    if ( function_exists( 'is_wp_error' ) && is_wp_error( $message ) ) {
        if ( empty( $title ) ) {
            $error_data = $message->get_error_data();
            if ( is_array( $error_data ) && isset( $error_data['title'] ) )
                $title = $error_data['title'];
        }
        $errors = $message->get_error_messages();
        switch ( count( $errors ) ) :
        case 0 :
            $message = '';
            break;
        case 1 :
            $message = "<div>{$errors[0]}</div>";
            break;
        default :
            $message = "<ul>\n\t\t<li>" . join( "</li>\n\t\t<li>", $errors ) . "</li>\n\t</ul>";
            break;
        endswitch;
    } elseif ( is_string( $message ) ) {
        $message = "<p>$message</p>";
    }
    if ( isset( $r['back_link'] ) && $r['back_link'] ) {
        $back_text = $have_gettext? '<i class="fa-solid fa-arrow-left"></i> '. __('Trở lại', 'fox')  : '<i class="fa-solid fa-arrow-left"></i> '. __('Trở lại', 'fox');
        $message .= "\n<div class='backcomen'><a href='javascript:history.back()'>$back_text</a></div>";
    }
    if ( empty($title) )
        $title = $have_gettext ? 'WordPress &rsaquo; Error' : 'WordPress &rsaquo; Error';
    require_once($errorTemplate);
    die();
 } else {
    _default_wp_die_handler($message, $title, $args);
 }
}
// shortcode ghi chu download ---------------------------------------------------------------------
function taoghichu($args, $content) {
	return "<div class='ghichu'>".$content."</div>";
}
add_shortcode( 'note', 'taoghichu' );
// shortcode dowload adnroid, ios, windows, mac, linux
function create_tai_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fas fa-arrow-circle-down'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'tai', 'create_tai_shortcode' );
function create_tai1_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-windows'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'windows', 'create_tai1_shortcode' );
function create_tai2_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-apple'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'macos', 'create_tai2_shortcode' );
function create_tai3_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-ubuntu'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'linux', 'create_tai3_shortcode' );
function create_tai4_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-google-play'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'android', 'create_tai4_shortcode' );
function create_tai5_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fa-brands fa-app-store-ios'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'ios', 'create_tai5_shortcode' );
function create_tai6_shortcode($args, $content) {
        return "
<div class='foxtai'><a target='_blank' href='/link?url=".bin2hex($content)."' ><i class='fab fa-wordpress'></i>". __(' TẢI NGAY', 'fox') ."</a></div>
";
}
add_shortcode( 'wordpress', 'create_tai6_shortcode' );
// manager fox add script theme
function fox_scripts_add_footer(){
ob_start();
if (fox_admin_view_script_v1() == "\x6c\x69\155\151\x74") { ?>
<script>var _0x97f7=["\x6C\x69\x6D\x69\x74"];var dumetane=_0x97f7[0]</script>
<?php } else { ?>
<script>var _0x4ec4=["\x66\x75\x6C\x6C"];var dumetane=_0x4ec4[0]</script>	
<?php }
echo ob_get_clean();
}
add_action('wp_footer', 'fox_scripts_add_footer');
add_action('admin_head', 'fox_scripts_add_footer');
// tạp phân trang cho custom post
function myPaginateLinks( WP_Query $wp_query, $args = '' ) {
    global $wp_rewrite, $pagez, $onpage;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );

    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = !empty($_GET['pg'. $pagez]) ? absint($_GET['pg'. $pagez]) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= '?pg'.$pagez.'=%#%#onpage'. $onpage;

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => '&#10094;',
        'next_text'          => '&#10095;',
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // Array of query args to add.
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );

        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }

        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }

    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="prev page-numbers" href="%s">%s</a>',
            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['prev_text']
        );
    endif;

    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = sprintf(
                '<span aria-current="%s" class="page-numbers current">%s</span>',
                esc_attr( $args['aria_current'] ),
                $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="page-numbers" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url( apply_filters( 'paginate_links', $link ) ),
                    $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
                );

                $dots = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<span class="page-numbers dots">&hellip;</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="next page-numbers" href="%s">%s</a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['next_text']
        );
    endif;

    switch ( $args['type'] ) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= implode( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = implode( "\n", $page_links );
            break;
    }
    $r = apply_filters( 'paginate_links_output', $r, $args );

    return $r;
}
// popup cookie
if(isset($fox_options['web2']) && !is_user_logged_in()){
function fox_cookie_popup_footer(){ 
ob_start(); ?>
  <div class="cookiebox" id="cookiebox">
      <div class="cookietitle"><i class="fa-regular fa-cookie-bite"></i> <?php _e('Đồng ý Cookie', 'fox'); ?></div>
      <?php _e('Trang web này sử dụng Cookie để nâng cao trải nghiệm duyệt web của bạn và cung cấp các đề xuất được cá nhân hóa. Bằng cách chấp nhận để sử dụng trang web của chúng tôi', 'fox'); ?>
      <div class="cookienut">
        <button title="<?php _e('Tôi chấp nhận', 'fox'); ?>" class="cookieitem"><?php _e('Tôi chấp nhận', 'fox'); ?></button>
      </div>
  </div>
<?php 
echo ob_get_clean();
}
add_action('wp_footer', 'fox_cookie_popup_footer');
}
// thanh load trang
if(isset($fox_options['web3'])){
function fox_line_scroll_footer(){
ob_start();	?>
<div class="line-scroll"><div class="scroll-load"></div></div>
<?php 
echo ob_get_clean();
}
add_action('wp_footer', 'fox_line_scroll_footer');
}
// ngan copy va vao f12
if(isset($fox_options['web4'])){
function fox_block_copy_footer(){ 
ob_start(); ?>
<script>var _0x7eff=["\x63","\x43","\x78","\x75","\x49","\x70\x72\x65\x76\x65\x6E\x74\x44\x65\x66\x61\x75\x6C\x74","\x53\x6F\x72\x72\x79\x2C\x20\x79\x6F\x75\x20\x63\x61\x6E\x27\x74\x20\x76\x69\x65\x77\x20\x6F\x72\x20\x63\x6F\x70\x79\x21","\x63\x6F\x6E\x74\x65\x78\x74\x6D\x65\x6E\x75","\x61\x64\x64\x45\x76\x65\x6E\x74\x4C\x69\x73\x74\x65\x6E\x65\x72","\x6B\x65\x79\x64\x6F\x77\x6E","\x63\x74\x72\x6C\x4B\x65\x79","\x6B\x65\x79","\x69\x6E\x63\x6C\x75\x64\x65\x73","\x46\x31\x32"];const disabledKeys=[_0x7eff[0],_0x7eff[1],_0x7eff[2],_0x7eff[3],_0x7eff[4]];const showAlert=(_0xc0c8x3)=>{_0xc0c8x3[_0x7eff[5]]();return alert(_0x7eff[6])};document[_0x7eff[8]](_0x7eff[7],(_0xc0c8x3)=>{showAlert(_0xc0c8x3)});document[_0x7eff[8]](_0x7eff[9],(_0xc0c8x3)=>{if(_0xc0c8x3[_0x7eff[10]]&& disabledKeys[_0x7eff[12]](_0xc0c8x3[_0x7eff[11]])|| _0xc0c8x3[_0x7eff[11]]=== _0x7eff[13]){showAlert(_0xc0c8x3)}})</script>
<script src='https://cdn.jsdelivr.net/npm/disable-devtool'></script>
<script>
    DisableDevtool({

    });
</script>
<?php
echo ob_get_clean(); 
}
add_action('wp_footer', 'fox_block_copy_footer');
// Tao trang No javascript
$link_inc2 = "No Javascript";
if (get_page_by_title($link_inc2) == NULL){
$my_post_inc2 = array(
	  'import_id'			  => 3001,
      'post_title'    => $link_inc2,
      'post_status'   => 'publish',
	  'page_template' => 'nojavascript.php',
      'post_author'   => 1,
      'post_type'     => 'page',
	  'post_name'     => 'no-javascript'
    );
 wp_insert_post( $my_post_inc2 );
}
} else {
	wp_delete_post(3001);
}
// hien thi popup bai viet ngau nhien
if(isset($fox_options['web5'])){
function fox_popup_post() {
	global $fox_options;
    ob_start(); ?>
	<div class="popup-post-box" <?php if(isset($fox_options['web53']) && $fox_options['web53'] == 'Left') {echo 'style="left:10px;right:auto"';} ?>><div class="popup-post-tit"><span><i class="fa-regular fa-bolt"></i> <?php _e('Đề xuất cho bạn', 'fox'); ?></span> <span><button title="<?php _e('Đóng', 'fox'); ?>" onclick="share(event, 'popup-post')"><i class="fa-regular fa-xmark"></i></button></span></div>
	<div class="post-post-card">
	<?php
	if(isset($fox_options['web52']) && $fox_options['web52'] == 'land') {$post_type_popup = 'land';} 
	else if(isset($fox_options['web52']) && $fox_options['web52'] == 'shop') {$post_type_popup = 'shop';}  
	else if(isset($fox_options['web52']) && $fox_options['web52'] == 'codex') {$post_type_popup = 'codex';} 
	else if(isset($fox_options['web52']) && $fox_options['web52'] == 'youtube') {$post_type_popup = 'youtube';} 
	else {$post_type_popup = 'post';}
	if(!empty($fox_options['web51'])){$post_popup_total = $fox_options['web51'];} else {$post_popup_total = 10;}
    $foxpost = new WP_Query(array(
        'post_type' =>  $post_type_popup,
        'posts_per_page'    =>  $post_popup_total,
		'orderby' => 'rand',
    ));
    if($foxpost->have_posts()){ 
        while($foxpost->have_posts()): $foxpost->the_post(); ?>
        <div class="popup-lienquan">
			<div class="popup-post-img">
				<?php if ( has_post_thumbnail() && empty(get_post_meta( get_the_ID(), 'photo1', true )) && empty(get_post_meta( get_the_ID(), 'youtube1', true ))) { ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo get_the_post_thumbnail_url (get_the_ID()); ?>" /></a>
				<?php }
				// anh dai dien tu dong lay anh dau tien
				else if (!empty(fox_anh_dai_dien_nho()) && empty(get_post_meta( get_the_ID(), 'photo1', true )) && empty(get_post_meta( get_the_ID(), 'youtube1', true ))){ ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img width="150" height="150" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="<?php echo fox_anh_dai_dien_nho(); ?>"/></a>
				
				<?php // add images slide	
				} else  if(!empty(get_post_meta( get_the_ID(), 'photo1', true ))) {
				$photo1 = get_post_meta(get_the_ID(), 'photo1', true);  
				$photo1 = explode(',', $photo1);
				?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien-lon.png" data-';} ?>src="<?php echo wp_get_attachment_url( $photo1[0] );?>"/></a>
				<!-- video youtube -->
				<?php } else if(!empty(get_post_meta( get_the_ID(), 'youtube1', true ))) { 
				$url = get_post_meta( get_the_ID(), 'youtube1', true );
				parse_str( parse_url( $url, PHP_URL_QUERY ), $link_tube ); $tube = $link_tube['v']; ?>
				<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" width="150" height="150" class="lazyload" <?php if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){echo 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';} ?>src="https://img.youtube.com/vi/<?php echo $tube; ?>/hqdefault.jpg" /></a>
				<?php } ?>
				</div>
				<div>
				<h3 class="lq-tenbai"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_trim_words( get_the_title() , 23 ) ?></a></h3>
				<span class="lq-tenbai-time"><i class="fa-regular fa-clock"></i> <?php $timeago = fox_time(get_the_time('U'), current_time('timestamp')); if ($timeago == false) { the_time('d/m/Y'); } else { echo $timeago . ' '. __('trước', 'fox'); } ?></span>
			</div>
		</div>
        <?php endwhile;  }
	wp_reset_query(); ?>
	</div>
	</div>
	<?php
    $result = ob_get_clean(); 
    wp_send_json_success($result); 
    die();
}
add_action( 'wp_ajax_popuppost', 'fox_popup_post' );
add_action( 'wp_ajax_nopriv_popuppost', 'fox_popup_post' );
// in popup footer hook
function fox_popup_post_footer(){
if(is_home() || is_single()){	
ob_start(); ?>
<div id="popup-post" style="display:block" class="popup_post_set"></div>
<script <?php global $fox_options; if(isset($fox_options['speed1']) && isset($fox_options['speed3']) && !is_user_logged_in()){ ?>type="rocketlazyloadscript" defer<?php } ?>>
    (function($){
        $(document).ready(function(){
                $.ajax({
                    type : "post", 
                    dataType : "json", 
                    url : '<?php echo admin_url('admin-ajax.php');?>',
                    data : {
                        action: "popuppost", 
                    },
                    context: this,
                    beforeSend: function(){
                    },
                    success: function(response) {
                        if(response.success) {
                            $('.popup_post_set').html(response.data);
                        }
                        else {
							console.log( 'Unable to randomly load articles');
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                            console.log( 'Case: ' + textStatus, errorThrown );
                    }
                })
                return false;
        })
    })(jQuery)
</script>
<?php 
echo ob_get_clean();
}
}
add_action('wp_footer', 'fox_popup_post_footer');
}
// them hieu ung cho trang web như noel tuyet roi
if(isset($fox_options['hover']) && $fox_options['hover'] == 'Snow1'){
function fox_add_hover_style_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-1.js');
} 
add_action('wp_footer', 'fox_add_hover_style_1');
}
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Snow2'){
function fox_add_hover_style_2(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-2.js');
ob_start(); ?>
<canvas id="snowflakesCanvas" style="position: absolute;" width="100%" height="100%"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_2');
}
if(isset($fox_options['hover']) && $fox_options['hover'] == 'Snow3'){
function fox_add_hover_style_3(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-3.js');
}
add_action('wp_footer', 'fox_add_hover_style_3');
}
// them hieu ung nen lunar
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Lunar1'){
function fox_add_hover_style_lunar_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-lunar-1.js');
ob_start(); ?>
<canvas id="phaohoa" style="position: fixed;top:0;left:0;width:100%;height:100%;z-index:-1;"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_lunar_1');
}
if(isset($fox_options['hover']) && $fox_options['hover'] == 'Lunar2'){
function fox_add_hover_style_lunar_2(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-lunar-2.js');
} 
add_action('wp_footer', 'fox_add_hover_style_lunar_2');
}
// them hieu ung nen hoa bay
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Flower1'){
function fox_add_hover_style_flower_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-flower-1.js');
ob_start(); ?>
<canvas id="world" style="position:fixed;top:0;left:0;width:100%;z-index:-1;"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_flower_1');
}
// them hieu ung nen lá rơi
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Leaves1'){
function fox_add_hover_style_leaves_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-leaves-1.js');
ob_start(); ?>
<canvas id="phaohoa" style="position:fixed;top:0;left:0;width:100%;z-index:-1;"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_leaves_1');
}
// them hieu ung fun
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Fun1'){
function fox_add_hover_style_fun_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-fun-1.js');
ob_start(); ?>
<canvas id='confetti' style="position: absolute;top:0;left:0;width:100%;z-index:-1"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_fun_1');
}
// them hieu ung click color
if (isset($fox_options['hover']) && $fox_options['hover'] == 'Click1'){
function fox_add_hover_style_click_1(){
wp_enqueue_script( 'hover', get_template_directory_uri() . '/inc/js/hover-style-click-1.js');
ob_start(); ?>
<canvas id="phaohoa" style="position: fixed;top: 0;left: 0;width: 100%;z-index: -1;"></canvas>
<?php echo ob_get_clean();
}
add_action('wp_footer', 'fox_add_hover_style_click_1');
}
// foxtheme f12
function fox_theme_f12_view(){
ob_start(); ?>
<script>
var _0xe17b=["\x25\x63\x20\x46\x6F\x78\x20\x74\x68\x65\x6D\x65\x20\x66\x72\x6F\x6D\x20\x66\x6F\x78\x74\x68\x65\x6D\x65\x2E\x6E\x65\x74\x20\x25\x63","\x66\x6F\x6E\x74\x2D\x66\x61\x6D\x69\x6C\x79\x3A\x20\x22\x48\x65\x6C\x76\x65\x74\x69\x63\x61\x20\x4E\x65\x75\x65\x22\x2C\x20\x48\x65\x6C\x76\x65\x74\x69\x63\x61\x2C\x20\x41\x72\x69\x61\x6C\x2C\x20\x73\x61\x6E\x73\x2D\x73\x65\x72\x69\x66\x3B\x66\x6F\x6E\x74\x2D\x73\x69\x7A\x65\x3A\x32\x34\x70\x78\x3B\x63\x6F\x6C\x6F\x72\x3A\x23\x30\x30\x62\x62\x65\x65\x3B\x2D\x77\x65\x62\x6B\x69\x74\x2D\x74\x65\x78\x74\x2D\x66\x69\x6C\x6C\x2D\x63\x6F\x6C\x6F\x72\x3A\x23\x30\x30\x62\x62\x65\x65\x3B\x2D\x77\x65\x62\x6B\x69\x74\x2D\x74\x65\x78\x74\x2D\x73\x74\x72\x6F\x6B\x65\x3A\x20\x31\x70\x78\x20\x23\x30\x30\x62\x62\x65\x65\x3B","\x66\x6F\x6E\x74\x2D\x73\x69\x7A\x65\x3A\x31\x32\x70\x78\x3B\x63\x6F\x6C\x6F\x72\x3A\x23\x39\x39\x39\x39\x39\x39\x3B","\x6C\x6F\x67"];(function(){console[_0xe17b[3]](_0xe17b[0],_0xe17b[1],_0xe17b[2])})()
</script>
<?php 
echo ob_get_clean();
}
add_action('wp_footer', 'fox_theme_f12_view');
