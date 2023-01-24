<?php
global $fox_options; 
if(isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 1') {
get_template_part( 'template-parts/menu/menu-1');
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 2'){
get_template_part( 'template-parts/menu/menu-2'); 
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 3'){
get_template_part( 'template-parts/menu/menu-3'); 
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu 4'){
get_template_part( 'template-parts/menu/menu-4'); 
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu GB 1'){
get_template_part( 'template-parts/menu/menu-gb-1'); 
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu GB 2'){
get_template_part( 'template-parts/menu/menu-gb-2'); 
}
else if (isset($fox_options['menu']) && $fox_options['menu'] == 'Menu popup 1'){
get_template_part( 'template-parts/menu/menu-popup-1'); 
}
?>