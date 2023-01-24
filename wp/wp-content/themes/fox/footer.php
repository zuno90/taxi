<?php
/**
 * footer
 *
 */
	global $adsense_options;
	if(isset($adsense_options['enable'])) {
	echo '<div class="sense1">'.fox_add_adsense_widget_sense1().'</div>'; 
	echo '<div class="sense2">'.fox_add_adsense_widget_sense2().'</div>'; 
	}
?>
<footer>
<?php 
global $fox_options;
if(isset($fox_options['footer']) && $fox_options['footer'] == 'Footer 1') {
get_template_part( 'template-parts/footer-1', get_post_type() );
}
else if (isset($fox_options['footer']) && $fox_options['footer'] == 'Footer 2'){
get_template_part( 'template-parts/footer-2', get_post_type() ); 
}
else if (isset($fox_options['footer']) && $fox_options['footer'] == 'Footer 3'){
get_template_part( 'template-parts/footer-3', get_post_type() ); 
}
else if (isset($fox_options['footer']) && $fox_options['footer'] == 'Footer 4'){
get_template_part( 'template-parts/footer-4', get_post_type() ); 
}
else if (isset($fox_options['footer']) && $fox_options['footer'] == 'Custom'){
echo $fox_options['footer-custom'];
}
else{
get_template_part( 'template-parts/footer-1', get_post_type() ); 
}
if(isset($fox_options['darkmode1']) && isset($fox_options['darkmode2']) && $fox_options['darkmode2'] == "Bottom"){
?>
<div class="icondark darkmode-bottom">
<label class="theme-switch" for="checkbox"><input type="checkbox" id="checkbox"><span class="label" id="icontheme"><i class="fa-regular fa-moon"></i></span></label>
</div>
<?php } ?>
<button id="backtop" onclick="scrollBackToTop()" title="<?php _e('Lên đầu trang', 'fox'); ?>"><i class="fa-regular fa-chevron-up"></i></button>
</footer>
<?php wp_footer(); ?>
<?php if(isset($fox_options['speed1']) && isset($fox_options['speed4']) && isset($fox_options['speed3']) && !is_user_logged_in()) { ?>
<script type="rocketlazyloadscript" defer>
var link = document.createElement('link');
link.setAttribute('rel', 'stylesheet');
link.setAttribute('href', '<?php echo get_template_directory_uri(); ?>/fox/main/css/all.css');
document.head.appendChild(link);
</script>
<?php } ?>
</body>
</html>




