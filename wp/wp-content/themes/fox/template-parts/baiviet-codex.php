<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php the_title(); ?></title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo get_template_directory_uri() ?>/images/icon.png" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/icon.png" type="image/x-icon" />
<?php do_action( 'fox_topcodex' ); ?>
<script>
if (window.addEventListener) {              
    window.addEventListener("resize", browserResize);
} else if (window.attachEvent) {                 
    window.attachEvent("onresize", browserResize);
}
var xbeforeResize = window.innerWidth;

function browserResize() {
    var afterResize = window.innerWidth;
    if ((xbeforeResize < (970) && afterResize >= (970)) || (xbeforeResize >= (970) && afterResize < (970)) ||
        (xbeforeResize < (728) && afterResize >= (728)) || (xbeforeResize >= (728) && afterResize < (728)) ||
        (xbeforeResize < (468) && afterResize >= (468)) ||(xbeforeResize >= (468) && afterResize < (468))) {
        xbeforeResize = afterResize;
        
        if (document.getElementById("adngin-try_it_leaderboard-0")) {
                adngin.queue.push(function(){  adngin.cmd.startAuction(["try_it_leaderboard"]); });
              }
         
    }
    if (window.screen.availWidth <= 768) {
      restack(window.innerHeight > window.innerWidth);
    }
    fixDragBtn();
    showFrameSize();    
}
var fileID = "";
</script>
</head>
<body>
<div id="tap1" class="rum">
<textarea style="display:none" id=t><?php echo esc_textarea( get_post_meta($post->ID, 'codex1', true )); ?></textarea>
<div class="trytopnav">
<div class="w3-bar" style="overflow:auto">
  <a onclick="restack(currentStack)" title="<?php _e('Thay đổi hiển thị', 'fox'); ?>" class="w3-button w3-bar-item w3-hide-small topnav-icons fa-light fa-table-pivot"></a>
  <a onclick="retheme()" title="<?php _e('Thay đổi giao diện', 'fox'); ?>" class="w3-button w3-bar-item topnav-icons fa-light fa-moon"></a>
  <a onclick="getcode()" title="<?php _e('Mã nhúng & chia sẻ', 'fox'); ?>" class="w3-button w3-bar-item topnav-icons fa-light fa-link"></a>
  <a onclick="saveTextAsFile(t.value,'index.html')" title="<?php _e('Lưu', 'fox'); ?>" class="w3-button w3-bar-item topnav-icons fa-light fa-floppy-disk"></a>
  <a onclick="submitTryit(1)" title="<?php _e('Chạy lệnh', 'fox'); ?>" class="w3-button w3-bar-item topnav-icons fa-light  fa-circle-play" style="color:#ff4444"></a>
  <span class="w3-right w3-hide-small" style="padding:8px 16px 8px 0;display:block;float:right;font-size:16px;margin-top:9px"><span id="framesize"></span></span>
</div>
</div>
<div id="shield"></div>
<a href="javascript:void(0)" id="dragbar"></a>
<div id="container">
<div id="menuOverlay" class="w3-overlay w3-transparent" style="cursor:pointer;z-index:4"></div>
  <div id="textareacontainer">
    <div id="textarea">
      <div id="textareawrapper">
<textarea autocomplete="off" id="textareaCode" wrap="logical" spellcheck="false"><?php echo  htmlspecialchars(get_post_meta( $post->ID, 'codex1', true )); ?></textarea>
        <form id="codeForm" autocomplete="off" style="margin:0px;display:none;">
          <input type="hidden" name="code" id="code" />
        </form>
       </div>
    </div>
  </div>
  <div id="iframecontainer">
    <div id="iframe">
      <div id="iframewrapper"></div>
    </div>
  </div>
</div>
</div>
<!-- html modal -->
<div class="nenmodal" id="nenmodal-1">
<div class="nenmodal2"></div>
<div class="ndmodal">
<div class="closemodal"><button onclick="getcode();">×</button></div>
<div class="titlemodal"><?php _e('Mã nhúng & chia sẻ', 'fox'); ?></div>
<h1><?php the_title(); ?></h1>
<div class="code-copi">
<input type="text" id="inputcopi" value="<embed src='<?php echo get_permalink(); ?>' style='width:100%;height:500px;'>">
<button onclick="codecopi();"><i class="fa-solid fa-copy"></i></button>
</div>
<div class="box-icon-mxh">
	<a class="s-facebook" style="margin-right:15px;" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-facebook"></i></a> 
	<a class="s-twitter" style="margin-right:15px;" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-twitter"></i></a> 
	<a class="s-pinterest" href="https://www.pinterest.com/pin/create/link/?url=<?php the_permalink(); ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>" onclick='window.open(this.href,&quot;popupwindow&quot;,&quot;status=0,height=500,width=500,resizable=0,top=50,left=100&quot;);return false;' rel='nofollow' target="_blank"><i class="fa-brands fa-pinterest"></i></a>
</div>
</div>
</div>
<!-- kết thúc html modal -->
<?php do_action( 'fox_bottomcodex' ); ?>
</body>
</html>