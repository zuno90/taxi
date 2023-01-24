<?php
// thay doi binh luan
function custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        default : ?>
            <li <?php comment_class(); ?> id="anbl-<?php comment_ID(); ?>"> 
            <article <?php comment_class(); ?> class="comment" id="comment-<?php comment_ID(); ?>">
            <div class="box-comen">
            <div class="hinh-comen"><?php echo get_avatar( $comment, 40 );?></div>
			<div class="comen">
            <div class="tgia-comen"><b><?php comment_author_link(); ?></b>   <span class="tgian-comen"> <time <?php comment_time( 'c' ); ?> class="comment-time"><?php comment_date(); ?></time></span></div>
			<?php
			// hien thi tra loi nguoi binh luan 
			if( $comment->comment_parent) { ?>
			<div class="tentraloi">
			@<?php echo comment_author( $comment->comment_parent ); 
			echo '<br><span>' . get_comment_text($comment->comment_parent) .'</span>'; ?>
			</div>
			<?php } ?>
			<?php if ( $comment->comment_approved == '0' ) { ?><div class="phe-comen"><?php _e( 'Phản hồi sẻ hiển thị sau khi được phê duyệt.', 'fox' ); ?></div><?php } ?>
            <div class="ndung-comen"><?php comment_text(); ?></div>
            </div>
            </div>
 
            <footer class="comment-footer">
            <div class="tra-comen" >
			<?php comment_reply_link( array_merge( $args, array(
			'reply_text' => '<i class="fa-solid fa-arrow-turn-down-right"></i> '. __('Trả lời', 'fox'),
			'after' => ' <span> </span>',
			'depth' => $depth,'max_depth' => $args['max_depth'] ) ) ); 
			?>
			</div>
            </footer>
            </article><!-- #comment-<?php comment_ID(); ?> -->
        <?php 
        break;
    endswitch;
}
// loc shortcode de in ra bieu tuong smile
        $search_icon = ['[c:]', '[b:]', '[t:]', '[n:]', '[y:]', '[o:]', '[k:]', '[w:]', '[s:]', '[h:]', '[d:]', '[f:]'];
		$replace_icon = [
		              '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/cuoi.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/buon.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/tuc.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/ngau.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/yeu.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/oi.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/khoc.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/wow.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/shit.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/tim.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/dam.png" /></span>',
					  '<span class="i-smile"><img src="'.get_template_directory_uri().'/images/smile/fox.png" /></span>',
					    ];
function icon_add_coment ($loc_comen){
        global $search_icon, $replace_icon;
		$loc_comen = str_replace($search_icon, $replace_icon, get_comment_text());
		return $loc_comen;
}
add_filter( 'comment_text', 'icon_add_coment' );
// sua lai binh o nhat binh luan
add_filter( 'comment_form_defaults', 'fox_comment_form_args' );
function fox_comment_form_args($defaults) {
	global $user_identity, $id;
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? ' aria-required="true"' : '' );
	$author = '<div id="popup-hotmail" class="popup-homail"><span onclick="share(event, &#39;popup-hotmail&#39;)" class="close-popup-hotmail">&#x2715</span><div class="popup-hotmail-tit">'.__('Xác nhận thông tin của bạn', 'fox').'</div><div id="homail" class="homail">' .
	          '<div class="input-wrapper">
			     <input id="author" name="author" type="text" class="author" placeholder="'.__('Nhập tên của bạn', 'fox') .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . '/>
				 <label for="stuff" class="fa-regular fa-user input-icon"></label>
			   </div><hr>';
	$email =  '<div class="input-wrapper">
	             <input id="email" name="email" type="text" class="email" placeholder="'. __('Nhập email của bạn', 'fox') .'" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' />
				 <label for="stuff" class="fa-regular fa-at input-icon"></label>
			   </div><hr>';	
	$url =  '<div class="input-wrapper">
				<input id="url" name="url" type="text" class="url" placeholder="'. __('Nhập url của bạn', 'fox') .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="2" />
				<label for="stuff" class="fa-regular fa-globe input-icon"></label>
			</div></div><button type="submit" id="button-comen">'.__('Xác nhận thông tin', 'fox').'</button></div>';
	// kiem tra dang nhap hay chua de hien thi nut gui binh luan
	if(is_user_logged_in()){
	$nuisencom = '<button type="submit"><i class="fa-regular fa-paper-plane-top" style="margin-right:7px"></i> '. __('Đăng', 'fox').'</button>';	
	} else {
	$nuisencom = '<span onclick="share(event, &#39;popup-hotmail&#39;)" class="button-popup-hotmail"><i class="fa-regular fa-paper-plane-top" style="margin-right:7px"></i> '. __('Đăng', 'fox').'</span>';
	}
	$comment_field = '<p class="comment-form-comment">' .
	                 '<textarea id="comment" name="comment" cols="45" rows="8" placeholder="'. __('Viết bình luận', 'fox') .'" required="" class="form" tabindex="4" aria-required="true"></textarea>' .
	                 '<div class="menuicon">
					 <div class="addicon">
					 <img id="openicon" style="width:32px;height:32px;" class="nuticon" src="'.get_template_directory_uri().'/images/smile/cuoi.png" />
					 '.$defaults['submit_button'] = '<span class="dangbinhluan">'.$nuisencom.'</span>'.'
					 </div>
					 <div id="hienmenuicon" class="menuicon-content">
					 <div class="menu-eicon">
					 <span>'.__('Biểu tượng cảm xúc', 'fox').'</span>
					 <a id="one1"><img src="'.get_template_directory_uri().'/images/smile/cuoi.png" /></a>
					 <a id="one2"><img src="'.get_template_directory_uri().'/images/smile/buon.png" /></a>
					 <a id="one3"><img src="'.get_template_directory_uri().'/images/smile/tuc.png" /></a>
					 <a id="one4"><img src="'.get_template_directory_uri().'/images/smile/ngau.png" /></a>
					 <a id="one5"><img src="'.get_template_directory_uri().'/images/smile/yeu.png" /></a>
					 <a id="one6"><img src="'.get_template_directory_uri().'/images/smile/oi.png" /></a>
					 <a id="one7"><img src="'.get_template_directory_uri().'/images/smile/khoc.png" /></a>
					 <a id="one8"><img src="'.get_template_directory_uri().'/images/smile/wow.png" /></a>
					 <a id="one9"><img src="'.get_template_directory_uri().'/images/smile/shit.png" /></a>
					 <a id="one10"><img src="'.get_template_directory_uri().'/images/smile/tim.png" /></a>
					 <a id="one11"><img src="'.get_template_directory_uri().'/images/smile/dam.png" /></a>
					 <a id="one12"><img src="'.get_template_directory_uri().'/images/smile/fox.png" /></a>
					 </div>
					 </div>
					 </div>
					 </p>';
	$defaults['title_reply_to'] = '';
	$defaults['cancel_reply_link'] = '<span class="dongtraloi">&#x2715 '. __('Hủy trả lời', 'fox') .'</span>';
	$defaults['must_log_in'] = '<p class="no-comments"><i class="fa-solid fa-triangle-exclamation"></i> '. __('Chức năng bình luận hiện chỉ có thể hoạt động sau khi bạn đăng nhập!', 'fox') .'</p>';
	$args = array(
		'fields' => array(
		'author' => $author,
		'email'  => $email,
		'url'    => $url,
		),
		'comment_field'        => $comment_field,
		'title_reply'          => '',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
	);
	$args = wp_parse_args( $args, $defaults );
	return apply_filters( 'fox_comment_form_args', $args, $user_identity, $id, $commenter, $req, $aria_req );
}
// xoa dong chu dang xuat o o nhap binh nuan
add_filter( 'comment_form_logged_in', '__return_empty_string' );
// ghi de tra loi nhan xet long vao nhau do sau 15 nhan xet (các nhan xet con sẽ còn 1 hàng)
add_filter( 'option_thread_comments_depth', function( $val )
{
    if( ! is_admin() )
        $val = 15;

    return $val;
} );
// hien thi ngay phut giay binh luan
function fox_comment_time($date, $d, $comment){
	return sprintf( _x( __('%s trước', 'fox'), '%s = human-readable time difference'), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
}
add_filter('get_comment_date', 'fox_comment_time', 10, 3);
