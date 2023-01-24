<?php
/*
 Template Name: No Javascript
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
<head>
    <title><?php _e('Trình duyệt không bật Javascript', 'fox'); ?></title>
	<meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo get_template_directory_uri() ?>/images/icon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/icon.png" type="image/x-icon" />
	<script src="http://code.jquery.com/jquery-latest.min.js "></script>
    <script>
      $(document).ready(function() {$("#box-js").hide();});
      window.location.replace("<?php bloginfo('url'); ?>");
	</script>
	<style>
	body{
		background:#333;
	}
	#box-js {
		max-width: 700px;
		margin: auto;
		text-align: center;
		background: #222;
		padding: 20px;
		color: #999;
		border-radius: 10px;
		font-size: 30px;
		text-transform: uppercase;
		font-weight: bold;
		font-family: system-ui;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		border: 3px solid #444444;
	}
	</style>
</head>
<body>
    <div id="box-js"><?php _e('Vui lòng bật Javascript để có thể truy cập trang', 'fox'); ?></div>
</body>
</html>