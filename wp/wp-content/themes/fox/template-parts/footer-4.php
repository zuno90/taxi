<div class="chan-4">
<div class="channd-4">
<?php if ( is_active_sidebar('sidebar-2') ) { ?>
<?php dynamic_sidebar( 'sidebar-2' ); ?>
<?php } ?>
<div class="chanmenu-4">
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
<?php
global $fox_options;
if (!empty($fox_options['mxh1']) || !empty($fox_options['mxh2']) || !empty($fox_options['mxh3']) || !empty($fox_options['mxh4']) || !empty($fox_options['mxh5']) || !empty($fox_options['mxh6'])){ ?>
<div class="chanicon-4">
 <?php if (!empty($fox_options['mxh1'])) { ?><a rel="nofollow" title="Facebook" href="https://facebook.com/<?php echo $fox_options['mxh1']; ?>"><i class="fa-brands fa-facebook"></i></a><?php } ?>
 <?php if (!empty($fox_options['mxh2'])) { ?><a rel="nofollow" title="Twitter" href="https://twitter.com/<?php echo $fox_options['mxh2']; ?>"><i class="fa-brands fa-twitter"></i></a><?php } ?>
 <?php if (!empty($fox_options['mxh3'])) { ?><a rel="nofollow" title="Pinterest" href="https://pinterest.com/<?php echo $fox_options['mxh3']; ?>"><i class="fa-brands fa-pinterest"></i></a><?php } ?>
 <?php if (!empty($fox_options['mxh4'])) { ?><a rel="nofollow" title="Youtube" href="https://youtube.com/<?php echo $fox_options['mxh4']; ?>"><i class="fa-brands fa-youtube"></i></a><?php } ?>
 <?php if (!empty($fox_options['mxh5'])) { ?><a rel="nofollow" title="Tiktok" href="https://tiktok.com/@<?php echo $fox_options['mxh5']; ?>"><i class="fa-brands fa-tiktok"></i></a><?php } ?>
 <?php if (!empty($fox_options['mxh6'])) { ?><a rel="nofollow" title="Instagram" href="https://instagram.com/<?php echo $fox_options['mxh6']; ?>"><i class="fa-brands fa-instagram"></i></a><?php } ?>
</div>
<?php } ?>
<div class="fox-4">
<?php 
if(empty($fox_options['banquyen'])) { ?>
Designed by <a title="Foxtheme" alt="foxtheme" href="https://foxtheme.net">Fox</a>
<?php
} else {echo $fox_options['banquyen'];}
?>
</div>
</div>
</div>
