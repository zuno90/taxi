<?php global $error_options; ?>
<div class="box-loi" id="baoerror" style="display:none">
	<div id="demoloi"></div>
	<form id="baoloi">
	  <input required="" placeholder="<?php _e('Nhập nội dung lỗi', 'fox'); ?>" type="text" id="noidungloi" value="">
	  <button id="guiloi" type="submit"><i class="fa-regular fa-paper-plane-top"></i></button>
	</form> 
	<script>
	const form = document.querySelector("#baoloi");
	form.addEventListener("submit", (e) => {
	e.preventDefault();
	var noidung = document.getElementById("noidungloi").value;
	var my_text = '<?php echo get_site_url() .' '; _e('có thông báo:%0A - Tiêu đề: ', 'fox'); the_title(); _e('%0A - Liên kết: ', 'fox'); the_permalink(); _e('%0A - Nội dung: ', 'fox'); ?>'+noidung;
	var token = "<?php echo $error_options['key1']; ?>";
	var chat_id = "<?php echo $error_options['key2']; ?>";
	var url = 'https://api.telegram.org/bot'+token+'/sendMessage?chat_id='+chat_id+'&text='+my_text;
	if (noidung != ""){
	let api = new XMLHttpRequest();
	api.open("GET", url, true);
	api.send();
	console.log("Lỗi gửi thành công");
	document.getElementById("demoloi").innerHTML = "<span class='tberror'><?php _e('Cảm ơn! Thông báo của bạn đã được gửi đi', 'fox'); ?></span>";
	document.getElementById("baoloi").style.display = "none";
	var frm = document.getElementById('baoloi');
	frm.reset();
	} else {document.getElementById("demoloi").innerHTML = "<span class='tberror'><?php _e('Không được bỏ trống nội dung', 'fox'); ?></span>";}
	});
	</script>
</div>