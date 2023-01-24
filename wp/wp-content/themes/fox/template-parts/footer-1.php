<div class="chan fix-menu">
<?php if ( is_active_sidebar('sidebar-2') ) { ?>
<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php } ?>
<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'wp-menu2',
						'menu_class'	=> 'wp-menu2',
					)
				);
?>
<div class="fox">
<?php global $fox_options;
if(empty($fox_options['banquyen'])) { ?>
Designed by <a title="Foxtheme" alt="foxtheme" href="https://foxtheme.net">Fox</a>
<?php
} else {echo $fox_options['banquyen'];}
?>
</div>
</div>