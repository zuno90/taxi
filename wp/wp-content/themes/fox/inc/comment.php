<?php
global $comment_options;
// thong bao email khi co ai tra loi nhan xet
if(isset($comment_options['comen1'])){
function fox_send_email_on_reply( $comment_id, $comment_object ) {
  $parent_comment = get_comment( $comment_object->comment_parent );
  $to = $parent_comment->comment_author_email;
  $subject = __('Bình luận của bạn vừa được trả lời', 'fox');
  $message = __('Bình luận của bạn vừa được trả lời ở bài viết', 'fox') .' '. get_the_title( $comment_object->comment_post_ID ) . ': ' . get_comment_link( $comment_id );
  wp_mail( $to, $subject, $message );
}
add_action( 'wp_insert_comment', 'fox_send_email_on_reply', 10, 2 );
}

// phan biet admin hoăc người dùng khi binh luan
if(isset($comment_options['comen2'])){
if ( ! class_exists( 'Fox_Comment_Author_Role_Label' ) ) :
class Fox_Comment_Author_Role_Label {
public function __construct() {
add_filter( 'get_comment_author', array( $this, 'fox_get_comment_author_role' ), 10, 3 );
add_filter( 'get_comment_author_link', array( $this, 'fox_comment_author_role' ) );
}
function fox_get_comment_author_role($author, $comment_id, $comment) {
global $comment_options;	
$authoremail = get_comment_author_email( $comment);
if(!empty($comment_options['comen-input1'])){$iconadmin = $comment_options['comen-input1'];} else {$iconadmin = '<i class="fa-regular fa-circle-check"></i>';}
if(!empty($comment_options['comen-color1'])){$coloradmin = 'style="color:'. $comment_options['comen-color1'] .'";';} else {$coloradmin = null;}  
if(!empty($comment_options['comen-input2'])){$iconuser = $comment_options['comen-input2'];} else {$iconuser = null;} 
if(!empty($comment_options['comen-color2'])){$coloruser = 'style="color:'. $comment_options['comen-color2'] .'";';} else {$coloruser = null;}  
if (email_exists($authoremail)) {
$commet_user_role = get_user_by( 'email', $authoremail );
$comment_user_role = $commet_user_role->roles[0];
$this->comment_user_role = ' <span '. $coloradmin .' class="comment-author-'.$comment_user_role.'">'. $iconadmin .'</span>';
} else { 
$this->comment_user_role = ' <span '. $coloruser .' class="comment-author-guid">'. $iconuser .'</span>';
} 
return $author;
} 
function fox_comment_author_role($author) { 
return $author .= $this->comment_user_role; 
} 
}
new Fox_Comment_Author_Role_Label;
endif;
}

// comment facebook
if (isset($comment_options['enable2'])){
if(!empty($comment_options['face-input1'])){
function fox_add_id_facebook(){
global $comment_options;
ob_start(); ?>
<script>
window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php echo $comment_options['face-input1']; ?>', 
      xfbml      : true,
      version    : 'v15.0'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<?php 
echo ob_get_clean();
}
add_action( 'wp_head', 'fox_add_id_facebook' );
}
function fox_template_facebook(){
	global $comment_options;
	if(!isset($comment_options['enable1'])){$onboxfb = 'style="display:block"';} else {$onboxfb = null;}
	if(!empty($comment_options['face-input2'])){$numberfb = $comment_options['face-input2'];} else {$numberfb = '10';}
	echo '<div class="facebook-comment comments-area" id="facebook-comment" '. $onboxfb .'><div id="respond" class="fb-comments" data-href="'. get_the_permalink() .'" data-colorscheme="light" data-mobile="auto" data-numposts="'. $numberfb .'"></div></div>';
}
}