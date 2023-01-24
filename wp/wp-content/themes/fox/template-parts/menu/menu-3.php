<div class="fix-menu2">
<div id="menu-list3" class="menu-list3">
<div class="scroll-m">
	<?php
	 $menuParameters = array(
	 'theme_location' => 'menu-1',
	 'container'       => false,
	 'echo'            => false,
	 'items_wrap'      => '%3$s',
	 'depth'           => 0,
	 );
	 echo strip_tags(wp_nav_menu( $menuParameters ), '<a><i>' );
?>
</div>
</div>
</div>
