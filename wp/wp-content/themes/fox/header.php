<?php
/**
 * Header Card
 **/
$current_user = wp_get_current_user(); $user_id = get_current_user_id(); global $fox_options; 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if(isset($fox_options['web4'])){ ?><noscript><meta http-equiv="refresh" content="0; url=<?php echo get_site_url(); ?>/no-javascript" /></noscript><?php } ?>
	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php  if( is_home() && !empty($fox_options['theh1'])) { ?><h1 style="display:none"><?php echo $fox_options['theh1']; ?></h1><?php } ?>
<?php do_action( 'fox_notify' ); // notify ?>
<header>
    <?php if(isset($fox_options['search']) && ($fox_options['search'] == 'Show' || $fox_options['search'] == 'Hidden')){ ?>
	<div id="searchtop"  class="search-bg" <?php if($fox_options['search'] == 'Hidden'){ echo 'style="display:none"';} ?>>
    <div class="fix-menu" style="padding:0px">
        <!-- tim kiem -->
		<div class="fox-ajax-search">
        <form method="get" action="<?php bloginfo('url'); ?>" autocomplete="off">
        <div class="search-mau" style="display:flex">
		<div class="otimkiembg input-wrapper">
        <input id="otimkiem" placeholder="<?php _e('Nhập từ khoá tìm kiếm', 'fox'); ?>" type="text" name="s"  onkeyup="foxsearch()">
		<label for="stuff" class="fas fa-search input-land-icon"></label>
		</div>
        <button <?php if($fox_options['search'] == 'Show'){echo 'style="border-radius:5px;"';} ?> id="nutmotim" title="<?php _e('Tìm kiếm', 'fox'); ?>" type="submit"><i class="fas fa-search"></i></button>
		<?php if($fox_options['search'] == 'Hidden'){ ?><span id="nutdongtim" title="<?php _e('Đóng tìm kiếm', 'fox'); ?>" type="submit" onclick="share(event, 'searchtop')"><i class="fa-solid fa-xmark"></i></span><?php } ?>
        </div>
        </form>
		<div style="display:none" id="fox-ajax-get">
		</div>
		</div>
    </div>
	</div>
    <?php } ?>
<nav class="menu-top">
<div class="fix-menu">
	<div class="logo"><a alt="Logo <?php echo get_site_url(); ?>" href="<?php echo get_bloginfo('url') ?>" rel="home"><img alt="Logo <?php echo get_site_url(); ?>" width="160" height="41" src="<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>"></a>
	<?php
	// get menu top
	if(isset($fox_options['menu']) && $fox_options['menu'] == 'Top menu 1'){ get_template_part( 'template-parts/menu/top-menu-1'); }?>
	</div>
    	<?php if(isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 1') { ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list')"><i class="fa-regular fa-bars"></i></button></div>
        <?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 2'){ ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list2')"><i class="fa-regular fa-bars"></i></button></div>     
        <?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 3'){ ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list3')"><i class="fa-regular fa-bars"></i></button></div>
        <?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 4'){ ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list4')"><i class="fa-regular fa-bars"></i></button></div>
        <?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu GB 1'){ ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list-gb-1')"><i class="fa-regular fa-bars"></i></button></div> 	
        <?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu GB 2'){ ?>
            <div class="iconmenu"><button title="Menu" id="buttonicon" onclick="share(event, 'menu-list-gb-2')"><i class="fa-regular fa-bars"></i></button></div>
		<?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Top menu 1'){ ?>
			<div class="iconmenu iconmenu-top"><button title="Menu" id="buttoniconhi" onclick="share(event, 'top-menu-mobile-1')"><i class="fa-regular fa-bars"></i></button></div>
		<?php } else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu popup 1'){ ?>
			<div class="iconmenu"><button title="Menu" id="buttoniconhi" onclick="share(event, 'menu-popup-1')"><i class="fa-regular fa-bars"></i></button></div>
        <?php } 
    if(isset($fox_options['search']) && $fox_options['search'] == 'Hidden'){ ?>
    <div class="iconlogin"><button title="<?php _e('Tìm kiếm', 'fox'); ?>" onclick="share(event, 'searchtop')"><i class="fa-regular fa-magnifying-glass" style="font-size:28px;"></i></button></div>
	<?php }
	global $login_options; if(isset($login_options['enable'])){
	if(is_user_logged_in()) { ?>
	<div class="iconavatar icon-user-menu"><button id="login-avatar" title="<?php _e('Quản lý tài khoản', 'fox'); ?>" onclick="share(event, 'user-menu')"><img title="<?php _e('Ảnh đại diện', 'fox'); ?>" width="40px" height="40px" src="<?php echo get_avatar_url( $current_user->ID); ?>" /></button>
		<div class="user-menu" id="user-menu">
		<a title="<?php _e('Quản lý', 'fox'); ?>" href="<?php echo get_bloginfo('url') ?>/profile"><i class="fa-regular fa-gear"></i> <?php _e('Quản lý', 'fox'); ?></a>
		<a title="<?php _e('Cá nhân', 'fox'); ?>" href="<?php echo get_author_posts_url($user_id); ?>"><i class="fa-regular fa-user"></i> <?php _e('Cá nhân', 'fox'); ?></a>
		<a title="<?php _e('Đăng xuất', 'fox'); ?>" href="<?php echo esc_url(wp_logout_url()); ?>"><i class="fa-regular fa-arrow-right-from-bracket"></i> <?php _e('Đăng xuất', 'fox'); ?></a>
		</div>
	</div>
	<?php } else { ?>
	<div class="iconlogin icon-user-menu"><button title="<?php _e('Quản lý tài khoản', 'fox'); ?>" onclick="share(event, 'user-menu')"><i class="fa-regular fa-circle-user"></i></button>
		<div class="user-menu" id="user-menu">
		<a title="<?php _e('Đăng nhập', 'fox'); ?>" href="<?php echo get_bloginfo('url') ?>/login"><i class="fa-regular fa-gear"></i> <?php _e('Đăng nhập', 'fox'); ?></a>
		<a title="<?php _e('Đăng ký', 'fox'); ?>" href="<?php echo get_bloginfo('url') ?>/register"><i class="fa-regular fa-user"></i> <?php _e('Đăng ký', 'fox'); ?></a>
		</div>
	</div>
	<?php } } 
	if(isset($fox_options['darkmode1']) && isset($fox_options['darkmode2']) && $fox_options['darkmode2'] == "Top"){
	?>
	<div class="icondark">
	<label class="theme-switch" for="checkbox"><input type="checkbox" id="checkbox"><span class="label" id="icontheme"><i class="fa-regular fa-moon"></i></span></label>
	</div>
	<?php } ?>
	<div style="clear: both;" />
</div>
</nav>
<?php get_template_part( 'setmenu', get_post_type() );
// get menu top
if(isset($fox_options['menu']) && $fox_options['menu'] == 'Top menu 1'){get_template_part( 'template-parts/menu/top-menu-mobile-1');}
?>
</header>

