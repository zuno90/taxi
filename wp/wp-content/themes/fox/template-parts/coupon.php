<article class="coupon-card">
				    <div style="display:flex;">
						<div class="coupon-lon">
						 <?php 
						 // phan tram giam gia
						 if( !empty(get_post_meta( $post->ID, 'coupon2', true )) ) { echo get_post_meta( $post->ID, 'coupon2', true ) . '%<br><span class="coupon-off">OFF</span>';  
						 } else { echo '<span class="coupon-no">'. __('NHẬN NGAY', 'fox') .'</span>'; } ?>
						 <?php
						 // ngay con han ma giam gia
						 $coupon_datanow = date("d-m-Y");
						 $coupon_data = get_post_meta( $post->ID, 'coupon3', true );
						 $coupon_datacheck = str_replace('/', '-', $coupon_data);
						 if(!empty($coupon_data) && strtotime($coupon_datanow) > strtotime($coupon_datacheck)){
							$coupon_checkdate = _('Hết hạn', 'fox'); 
						 } else {
							$coupon_checkdate = $coupon_data;
						 }
						 if( !empty($coupon_data) ) { 
						 echo '<span class="coupon-date">'. $coupon_checkdate .'</span>';  
						 } else { 
						 echo '<span class="coupon-date">'. __('COUPON', 'fox') . '</span>'; 
						 } ?>
						</div>
						<div class="coupon-nodung">
							<h2 style="font-size:19px;line-height: 1.3;margin:0px;"><a title="<?php the_title_attribute(); ?>" href="<?php echo the_permalink(); ?>" ><?php echo wp_trim_words( get_the_title() , 18 ) ?></a></h2>
							<?php 
							// noi dung giam gia
							if( !empty(get_post_meta( $post->ID, 'coupon1', true )) ) { echo '<span>'. get_post_meta( $post->ID, 'coupon1', true ) . '</span>'; } ?>
							<div class="coupon-get">
							<?php 
							// ma giam gia
							if( !empty(get_post_meta( $post->ID, 'coupon4', true )) ) { 
							$couget = 'style="position: absolute;"';
							$couget_name = __('Nhận mã', 'fox');
							echo '<div class="coupon-ma">'. get_post_meta( $post->ID, 'coupon4', true ) . '</div>'; 
							} else {
							$couget = null;
							$couget_name = __('Xem', 'fox');
							} ?>
							<?php 
							// link giam gia
							if( !empty(get_post_meta( $post->ID, 'coupon5', true )) ) { echo '<div id="coupon-show-'. $post->ID .'" class="coupon-link" '. $couget .'><i class="fa-regular fa-scissors"></i><a title="'. $couget_name .'" href="'. get_the_permalink() . '" >'. $couget_name .'</a></div>'; } ?>
							</div>
						</div>
					</div>
					<?php 
					// nha cung cap giam gia
					if(is_array(get_the_terms( $post->ID, 'show')) && !empty(get_the_terms( $post->ID, 'show'))){ echo '<div style="margin-top:35px" /><div class="coupon-show">'; the_terms( $post->ID, 'show', __('Mã giãm giá đến từ ', 'fox')); echo '</div>'; } ?>
</article>