<?php
/**
 * Funciton
 */
if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}
function fox_support_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'menu-1' => __( 'Trên', 'fox' ),
			'menu-2' => __( 'Dưới', 'fox' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'fox_support_setup' );

function fox_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fox_content_width', 640 );
}
add_action( 'after_setup_theme', 'fox_content_width', 0 );
// sidebar thanh bên
function fox_widgets_init() {
	// khai báo wedget
	require_once(realpath(dirname(__FILE__)).'/widget/widget.php');
    register_widget('fox_post');
	register_widget('fox_comment');
	register_widget('fox_weather');
	register_widget('fox_post_slide');
	register_widget('fox_categories');
	register_widget('fox_time');
	register_widget('fox_coin');
	if (get_locale() == 'vi') {
	register_widget('fox_lunar');
	register_widget('fox_loan');
	}
	register_widget('fox_tag');
	register_widget('fox_search');
	register_widget('fox_post_views');
	register_widget('fox_post_rank');
	register_widget('fox_post_banner');
	register_widget('fox_post_pro');
	register_widget('fox_top_post');
	register_widget('fox_converter');
	register_widget('fox_post_page');
	register_widget('fox_author');
	register_widget('fox_post_gradient');
	register_widget('fox_post_line');
	register_widget('fox_post_hat');
	register_widget('fox_calendar');
	global $fox_options;  if(isset($fox_options['web1'])){
	require_once(realpath(dirname(__FILE__)).'/widget/widget-coupon.php');
	register_widget('fox_coupon');
	}
	if (isset($fox_options['type']) && $fox_options['type'] == 'Land'){
	require_once(realpath(dirname(__FILE__)).'/widget/widget-land.php');
	register_widget('fox_land_search');
	}
	// widget thanh bên
	register_sidebar(
		array(
			'name'          => __( 'Thanh bên', 'fox' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget chân trang
	register_sidebar(
		array(
			'name'          => __( 'Chân trang', 'fox' ),
			'id'            => 'sidebar-2',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget giữa trang
	register_sidebar(
		array(
			'name'          => __( 'Giữa trang', 'fox' ),
			'id'            => 'sidebar-3',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget weather and time
	register_sidebar(
		array(
			'name'          => __( 'Thời tiết', 'fox' ),
			'id'            => 'sidebar-4',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget giua top
	register_sidebar(
		array(
			'name'          => __( 'Giữa top', 'fox' ),
			'id'            => 'sidebar-5',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	// widget duoi cung
	register_sidebar(
		array(
			'name'          => __( 'Dưới cùng', 'fox' ),
			'id'            => 'sidebar-6',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'fox_widgets_init' );
require get_template_directory() . '/inc/custom-color.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/like-post.php';
require get_template_directory() . '/inc/binhluan.php';
require get_template_directory() . '/inc/chucnang.php';
require get_template_directory() . '/inc/metabox-imgshow.php';
require get_template_directory() . '/inc/media.php';
require get_template_directory() . '/inc/comment.php';
global $fox_options, $story_options, $login_options, $land_options, $scurity_options;
// Coupon
if(isset($fox_options['web1'])){
require get_template_directory() . '/inc/coupon.php';
}
// download
if (isset($fox_options['set7'])){
require get_template_directory() . '/inc/metabox-download.php';
}
// login
if (isset($login_options['enable'])){
require get_template_directory() . '/inc/login.php';
} else {
	wp_delete_post(2000);
	wp_delete_post(2001);
	wp_delete_post(2002);
	wp_delete_post(2003);
}
// Gmail smtp
if(isset($login_options['gsmtp'])){
add_action( 'phpmailer_init', function( $phpmailer ) {
global $login_options;
if(!empty($login_options['gsmtp1'])){$smtp_name = $login_options['gsmtp1'];} else {$smtp_name = null;}
if(!empty($login_options['gsmtp2'])){$smtp_e = $login_options['gsmtp2'];} else {$smtp_e = null;}
if(!empty($login_options['gsmtp3'])){$smtp_tk = $login_options['gsmtp3'];} else {$smtp_tk = null;}
if(!empty($login_options['gsmtp4'])){$smtp_mk = $login_options['gsmtp4'];} else {$smtp_mk = null;}
if(!empty($login_options['gsmtp5'])){$smtp_sv = $login_options['gsmtp5'];} else {$smtp_sv = null;}
if(!empty($login_options['gsmtp6'])){$smtp_hot = $login_options['gsmtp6'];} else {$smtp_hot = null;}
if(!empty($login_options['gsmtp7'])){$smtp_kn = $login_options['gsmtp7'];} else {$smtp_kn = null;}
if ( !is_object( $phpmailer ) )
$phpmailer = (object) $phpmailer;
$phpmailer->Mailer = 'smtp';
$phpmailer->Host = $smtp_sv;
$phpmailer->SMTPAuth = 1;
$phpmailer->Port = $smtp_hot;
$phpmailer->Username = $smtp_tk;
$phpmailer->Password = $smtp_mk;
$phpmailer->SMTPSecure = $smtp_kn;
$phpmailer->From = $smtp_e;
$phpmailer->FromName = $smtp_name;
});
}
// Scurity
if (isset($scurity_options['enable'])){
require get_template_directory() . '/inc/scurity.php';
}
// quan ly admin fox theme
include_once (get_template_directory() . '/admin/fox-admin.php');
if (isset($fox_options['type']) && $fox_options['type'] == 'Story'){
include_once (get_template_directory() . '/admin/fox-story.php');
require get_template_directory() . '/inc/story.php';
}
if (isset($fox_options['type']) && $fox_options['type'] == 'Land'){
include_once (get_template_directory() . '/admin/fox-land.php');
require get_template_directory() . '/inc/land.php';
} else { 
wp_delete_post(1000); 
wp_delete_post(1001);
wp_delete_post(1002);
wp_delete_post(1003);
}
if (isset($fox_options['type']) && $fox_options['type'] == 'Shop'){
include_once (get_template_directory() . '/admin/fox-shop.php');
require get_template_directory() . '/inc/shop.php';
}
if (isset($fox_options['type']) && $fox_options['type'] == 'Codex'){
include_once (get_template_directory() . '/admin/fox-codex.php');
require get_template_directory() . '/inc/codex.php';
}
if (isset($fox_options['type']) && $fox_options['type'] == 'Youtube'){
require get_template_directory() . '/inc/youtube.php';
}
include_once (get_template_directory() . '/admin/fox-scurity.php');
include_once (get_template_directory() . '/admin/fox-media.php');
include_once (get_template_directory() . '/admin/fox-login.php');
include_once (get_template_directory() . '/admin/fox-comment.php');
include_once (get_template_directory() . '/admin/fox-addcode.php');
include_once (get_template_directory() . '/admin/fox-adsense.php');
include_once (get_template_directory() . '/admin/fox-onchat.php');
include_once (get_template_directory() . '/admin/fox-notify.php');
include_once (get_template_directory() . '/admin/fox-error.php');
include_once (get_template_directory() . '/admin/fox-note.php');

// trinh soan thao co dien
if (isset($fox_options['set6']) || isset($fox_options['type']) && $fox_options['type'] == 'Story'){
add_filter('use_block_editor_for_post', '__return_false');
}

// khai bao tai trang bằng ajax
 function fox_load_more_scripts()
{
    global $wp_query, $fox_options;
    ?>
	<script>
	var loadbut = <?php echo json_encode('<img width="55px" src="'.get_template_directory_uri().'/images/loading.gif" />'); ?>;
	var nuttaibut = <?php echo json_encode('<span  class="fox-loadmore"><span  class="fox-loadmore2"><i class="fa-regular fa-circle-arrow-down"></i> '. __('Tải thêm', 'fox') .'</span>'); ?>;
	</script>
    <?php	
    wp_enqueue_script('jquery');
    if( is_home() ) {
	if (isset($fox_options['next']) && $fox_options['next'] == 'More'){
    wp_enqueue_script( 'ajax-pagination-script', get_template_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ) );
	} else if (isset($fox_options['next']) && $fox_options['next'] == 'Scroll'){
	wp_enqueue_script( 'ajax-pagination-script', get_template_directory_uri() . '/js/ajax-pagination-scroll.js', array( 'jquery' ) );	
	} else {
	wp_enqueue_script( 'ajax-pagination-script', get_template_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ) );
	}
    }
    wp_localize_script( 'ajax-pagination-script', 'fox_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 
        'posts' => json_encode($wp_query->query_vars), 
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ));
 	wp_enqueue_script('myloadmore');
}
add_action('wp_enqueue_scripts', 'fox_load_more_scripts');
// thực thi tải trang ajax
if (fox_admin_view_script_v1() != "\154\151\x6d\151\164") {
function fox_loadmore_ajax_handler()
{
    $args = json_decode(stripslashes($_POST['query'] ), true);
    $args['paged'] = $_POST['page'] + 1; 
    $args['post_status'] = 'publish';
    query_posts( $args );
 
    if(have_posts()) :
        while(have_posts()): the_post();
			get_template_part( '/setcard', get_post_type() );
        endwhile;
    endif;
    die;
}
add_action('wp_ajax_loadmore', 'fox_loadmore_ajax_handler'); 
add_action('wp_ajax_nopriv_loadmore', 'fox_loadmore_ajax_handler');
}
 // fix loi tra loi comment trên seo
 add_filter( 'rank_math/frontend/remove_reply_to_com', '__return_false' );
 add_filter( 'wpseo_remove_reply_to_com', '__return_false' );
 
 
// cap nhat bai viet moi len dau trang 
function lmt_orderby_modified_posts( $query ) {
    if( $query->is_main_query() && !is_admin() ) {
	if ( $query->is_home() || $query->is_category() || $query->is_tag() ) {
            $query->set( 'orderby', 'modified' );
            $query->set( 'order', 'desc' );
	}
    }
}
add_action( 'pre_get_posts', 'lmt_orderby_modified_posts' );


// dat lien ket cố định 
function reset_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure( '/%postname%/' );
}
add_action( 'init', 'reset_permalinks' );


// ngon ngu
load_theme_textdomain( 'fox', get_template_directory() .'/lang/');
$locale = get_locale();
$locale_file = get_template_directory() . "/lang/$locale.php";
if ( is_readable( $locale_file ) ) {
    require_once( $locale_file );
}


// xoa srcset hinh anh content
function fox_wp_responsive_images() {
	return 1;
}
add_filter('max_srcset_image_width', 'fox_wp_responsive_images');
if(isset($fox_options['speed1']) && isset($fox_options['speed2'])){
// thêm class lazyload cho hình ảnh the content
function fox_img_content($content) {
   global $post;
   $imglazy = 'src="'.get_template_directory_uri().'/images/anh-dai-dien.png" data-';
   $search ="/<img(.*?)class=\"(.*?)\"(.*?)\s(.*?)>/i";
   $rum = '<img$1class="$2 lazyload" '.$imglazy.'$4>';
   $content = preg_replace($search, $rum, $content);
   return $content;
}
add_filter('the_content', 'fox_img_content');
}
// Goi ajax cho search
function fox_get_ajax_search() {
?>
<script type="text/javascript">
function foxsearch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'fox_data_ajax_search', keyword: jQuery('#otimkiem').val() },
        success: function(data) {
            jQuery('#fox-ajax-get').html( data );
        }
    });

}
</script>
<?php
}
add_action( 'wp_footer', 'fox_get_ajax_search' );
// Form tim kiem fox ajax search
function fox_data_ajax_search(){
    $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post' ) );
    if( $the_query->have_posts() ) :
        echo '<div id="fox-ajax-box">';
        while( $the_query->have_posts() ): $the_query->the_post(); ?>

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

        <?php endwhile;
        echo '</div>';
        wp_reset_postdata();  
    endif;
    die();
}
add_action('wp_ajax_fox_data_ajax_search' , 'fox_data_ajax_search');
add_action('wp_ajax_nopriv_fox_data_ajax_search','fox_data_ajax_search');
// Thay doi qua widget classic
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );




