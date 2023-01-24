<div class="chan-2">
<div class="channd-2">
<?php if ( is_active_sidebar('sidebar-2') ) { ?>
<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php } ?>
<div>
<div><b><?php _e('Liên kết trên trang', 'fox'); ?></b></div>
<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'wp-menu2',
						'menu_class'	=> 'wp-menu2',
					)
				);
?>
</div>


</div>
</div>
<div class="fox-2">
<?php global $fox_options;
if(empty($fox_options['banquyen'])) { ?>
Designed by <a title="Foxtheme" alt="foxtheme" href="https://foxtheme.net">Fox</a>
<?php
} else {echo $fox_options['banquyen'];}
?>
</div>

