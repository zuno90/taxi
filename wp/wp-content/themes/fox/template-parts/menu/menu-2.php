<div class="fix-menu2">
<div id="menu-list2" class="menu-list2">
	<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'wp-menu2',
						'menu_class'	=> 'wp-menu2',
					)
				);
	?>
<?php global $fox_options; if (!empty($fox_options['mxh1']) || !empty($fox_options['mxh2']) || !empty($fox_options['mxh3']) || !empty($fox_options['mxh4']) || !empty($fox_options['mxh5']) || !empty($fox_options['mxh6'])){ ?>
<ul class="menu-mxh">
 <?php if (!empty($fox_options['mxh1'])) { ?><li><a rel="nofollow" class="mxh-fb" title="Facebook" href="https://facebook.com/<?php echo $fox_options['mxh1']; ?>"><i class="fa-brands fa-facebook"></i></a></li><?php } ?>
 <?php if (!empty($fox_options['mxh2'])) { ?><li><a rel="nofollow" class="mxh-tw" title="Twitter" href="https://twitter.com/<?php echo $fox_options['mxh2']; ?>"><i class="fa-brands fa-twitter"></i></a></li><?php } ?>
 <?php if (!empty($fox_options['mxh3'])) { ?><li><a rel="nofollow" class="mxh-pr" title="Pinterest" href="https://pinterest.com/<?php echo $fox_options['mxh3']; ?>"><i class="fa-brands fa-pinterest"></i></a></li><?php } ?>
 <?php if (!empty($fox_options['mxh4'])) { ?><li><a rel="nofollow" class="mxh-yt" title="Youtube" href="https://youtube.com/<?php echo $fox_options['mxh4']; ?>"><i class="fa-brands fa-youtube"></i></a></li><?php } ?>
 <?php if (!empty($fox_options['mxh5'])) { ?><li><a rel="nofollow" class="mxh-tt" title="Tiktok" href="https://tiktok.com/@<?php echo $fox_options['mxh5']; ?>"><i class="fa-brands fa-tiktok"></i></a></li><?php } ?>
 <?php if (!empty($fox_options['mxh6'])) { ?><li><a rel="nofollow" class="mxh-it" title="Instagram" href="https://instagram.com/<?php echo $fox_options['mxh6']; ?>"><i class="fa-brands fa-instagram"></i></a></li><?php } ?>
</ul>
<?php } ?>
<div style="clear: both;"></div>
</div>
</div>