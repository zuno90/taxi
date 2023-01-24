<?php
function foxnote_options_page() {
	ob_start(); ?>
	<div class="wrap fox-admin admin-main">
		<h2 class="admin-h2"><?php _e('FOX NOTE', 'fox'); ?></h2>
		
		<div class="admin-tab">
		<button class="ranktab rank-ac" title="<?php _e('CODE', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-book"></i> <?php _e('CODE', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('WIDGET', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-regular fa-book"></i> <?php _e('WIDGET', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('DOC', 'fox'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-book"></i> <?php _e('DOC', 'fox'); ?></button>
		</div>
		
		<div class="rank-box rank" id="rankone">
		<div class="admin-card">
    		   <div class="admin-cm"><?php _e('Shortcode làm đẹp cho bài viết', 'fox'); ?></div>
			   <div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">[note]</span> <?php _e('nội dung', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/note]</span> <?php _e('ghi chú trong bài viết của bạn.', 'fox'); ?>
			   </div>
			   <br>
			   <div class="admin-cm"><?php _e('Shortcode nút tải về trong bài viết', 'fox'); ?></div>
    		   <div class="admin-div-note admin-note-card">
				<p>
					<span style="font-weight:bold;color:#ff4444">[windows]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/windows]</span> <?php _e('nút tải theo kiểu Windows.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[linux]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/linux]</span> <?php _e('nút tải theo kiểu Linux.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[macos]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/macos]</span> <?php _e('nút tải theo kiểu Macos.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[ios]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/ios]</span> <?php _e('nút tải theo kiểu Ios.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[android]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/android]</span> <?php _e('nút tải theo kiểu Android.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[wordpress]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/wordpress]</span> <?php _e('nút tải theo kiểu Wordpress.', 'fox'); ?>
				</p>
					<span style="font-weight:bold;color:#ff4444">[tai]</span> <?php _e('link tải', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/tai]</span> <?php _e('nút tải chung.', 'fox'); ?>
    		   </div>
			   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chú ý: Các shortcode tải này đều đã được tạo trang chuyển hướng và mã hoá liên kết', 'fox'); ?></p>
			   
			   <div class="admin-cm"><?php _e('Shortcode khóa nội dung trong bài viết', 'fox'); ?></div>
    		   <div class="admin-div-note admin-note-card">
				<p>
					<span style="font-weight:bold;color:#ff4444">[1lock]</span> <?php _e('Nội dung cần khóa', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/1lock]</span> <?php _e('nội dung này được mở khóa khi người dùng đăng nhập.', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">[2lock]</span> <?php _e('Nội dung cần khóa', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/2lock]</span> <?php _e('nội dung này được mở khóa khi người dùng thuộc (nhóm vip, đã thêm id bài viết đó vào tài khoản, còn thời gian VIP).', 'fox'); ?>
				</p>
					<span style="font-weight:bold;color:#ff4444">[3lock pass="<?php _e('Mật khẩu', 'fox'); ?>"]</span> <?php _e('Nội dung cần khóa', 'fox'); ?> <span style="font-weight:bold;color:#ff4444">[/3lock]</span> <?php _e('nội dung này được mở khóa khi người dùng nhập đúng mật khẩu.', 'fox'); ?>
				
    		   </div>
			   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chú ý: Các shortcode này chỉ hoạt động khi bạn đã kích hoạt FOX LOGIN và bật chức năng khóa bài viết hoặc chương truyện', 'fox'); ?></p>
			   
		</div>
		</div>
		
		<div class="rank-box rank" id="ranktue" style="display:none">
			   <div class="admin-card">
			   <div class="admin-cm"><?php _e('Tổng hợp các Widget của Fox theme', 'fox'); ?></div>
			   <div class="admin-docs-tit"><?php _e('Widget chung', 'fox'); ?></div>
			   <div class="admin-div-note admin-note-card">
			      <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post</span>  :  <?php _e('Hiển thị các bài viết theo chuyên mục dạng danh sách hoặc lưới', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Comment</span>  :  <?php _e('Hiển thị các bình luận gần đây', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Weather</span>  :  <?php _e('Hiển thị hộp thời thiết', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post slide</span>  :  <?php _e('Hiển thị các bài viết ngẫu nhiên dạng slide', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Categories</span>  :  <?php _e('Hiển thị các chuyên mục dạng text', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Time</span>  :  <?php _e('Hiển thị hộp thời gian và ngày tháng', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Coin</span>  :  <?php _e('Hiển thị hộp thông báo về thị trường coin', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Lunar</span>  :  <?php _e('Hiển thị hộp âm lịch', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Tag</span>  :  <?php _e('hiển thị tất cả các thẻ tag', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Search</span>  :  <?php _e('Hiển thị hộp nhập tìm kiếm bài viết', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post views</span>  :  <?php _e('Hiển thị bài viết có nhiều lượt xem', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post rank</span>  :  <?php _e('Hiển thị bài viết lượt xem / ngẫu nhiên / nổi bật', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post banner</span>  :  <?php _e('Hiển thị bài viết dạng banner', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post pro</span>  :  <?php _e('Hiển thị bài viết theo chuyên mục dạng kéo qua lại', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Loan</span>  :  <?php _e('Hiển thị hộp tính khoản vay', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Top post</span>  :  <?php _e('Hiển thị bài viết dạng lưới thường sử dụng trên cùng', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Converter</span>  :  <?php _e('Hiển thị hộp chuyển đổi tiền tệ', 'fox'); ?>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post page</span>  :  <?php _e('Hiển thị bài viết theo chuyên mục tương tự bài viết trang chủ kèm phân trang', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post gradient</span>  :  <?php _e('Hiển thị bài viết theo chuyên mục có thể thay đổi màu sắc của phong nền', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post line</span>  :  <?php _e('Hiển thị bài viết theo chuyên mục có thể thay đổi màu sắc đường viền và liên kết', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Calendar</span>  :  <?php _e('Hiển thị hộp lịch', 'fox'); ?> 
				  </p>
				  <p>
					<span style="font-weight:bold;color:#ff4444">Fox Post hat</span>  :  <?php _e('Hiển thị bài viết theo chuyên mục với kiểu đường viền tinh tế', 'fox'); ?> 
				  </p>
					<span style="font-weight:bold;color:#ff4444">Fox Author</span>  :  <?php _e('Hiển thị chi tiết thông tin tài khoản theo ID', 'fox'); ?> <span style="color:#fff;background:#0c0;padding:4px 7px;border-radius:20px;"><?php _e('ở giữa', 'fox'); ?></span>
				</div>
				<div class="admin-docs-tit"><?php _e('Widget Land', 'fox'); ?></div>
				   <div class="admin-div-note admin-note-card">
						<span style="font-weight:bold;color:#ff4444">Fox Land search</span>  :  <?php _e('Hiển thị bộ lọc tìm kiếm bất động sản', 'fox'); ?>
				   </div>
				   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Shortcode này chỉ hiển thị khi bạn lựa chọn thể loại web là land', 'fox'); ?></p>
				<div class="admin-docs-tit"><?php _e('Widget Coupon', 'fox'); ?></div>
				   <div class="admin-div-note admin-note-card">
						<span style="font-weight:bold;color:#ff4444">Fox Coupon</span>  :  <?php _e('Hiển thị danh sách coupon ra trang chủ', 'fox'); ?>
				   </div>
				   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Shortcode này chỉ hiển thị khi bạn bật chức năng Thêm chức năng tạo coupon trong cài đặt Foxtheme', 'fox'); ?></p>
			   </div>
		</div>
		
		
		
		<div class="rank-box rank" id="rankthere" style="display:none">
		
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu chung', 'fox'); ?></div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">photo1</span>  :  <?php _e('Chức năng úp ảnh cho Story hoặc slide ảnh cho Post, Land, Shop, (id1, id2, id3, id4, id5, ..., idN)', 'fox'); ?>
				</div>
			</div>
			
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Post', 'fox'); ?></div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
				<p>
				<div class="admin-cum">
					<span style="font-weight:bold;color:#ff4444">download_link1</span> :  <?php _e('Link download thường, (link1, link2, link3,..., link10)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">download_link11</span> :	<?php _e('Tên download thường, (name1, name2, name3,...., name10)', 'fox'); ?>
				</div>
				</p>
				<div class="admin-cum">
					<span style="font-weight:bold;color:#ff4444">download_link2</span> :  <?php _e('Link download nhảy giây, (link1, link2, link3,..., link10)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">download_link21</span> :	<?php _e('Tên download nhảy giây, (name1, name2, name3,...., name10)', 'fox'); ?>
				</div>
				</div>
			</div>
		
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Story', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">story</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">tac-gia</span> : <?php _e('Tác giả của truyện', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
				<p>
					<span style="font-weight:bold;color:#ff4444">story_mota1</span>  :  <?php _e('Trạng thái truyện (đang ra / hoàn thành)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">story_mota2</span>  :  <?php _e('Nguồn truyện', 'fox'); ?>
				</p>
					<span style="font-weight:bold;color:#ff4444">story_audio1</span> :	<?php _e('Tác giả audio MP3', 'fox'); ?><br>
					<div class="admin-cum">
					<span style="font-weight:bold;color:#ff4444">story_audio2</span> :  <?php _e('Liên kết audio MP3, (link1, link2, link3,..., link10)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">story_audio21</span> :	<?php _e('Tên tập audio MP3, (name1, name2, name3,...., name10)', 'fox'); ?>
					</div>
				    <span style="font-weight:bold;color:#ff4444">story_audio3</span> :	<?php _e('Danh sách link MP3 xuống dòng', 'fox'); ?>
				</div>
			</div>
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Land', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">land</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">muc</span> : <?php _e('Chuyên mục bất động sản', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
				<p>
					<span style="font-weight:bold;color:#ff4444">adress1</span>  :  <?php _e('Tỉnh / thành', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">adress2</span>  :  <?php _e('Quận / huyện', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">adress3</span>  :  <?php _e('Phường / xã', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">adress4</span>  :  <?php _e('Thôn / đường', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">maps1</span> :	<?php _e('Tọa độ Google maps', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">type1</span> :	<?php _e('Loại đường (ô tô / xe máy)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">type2</span> :	<?php _e('Vị trí (mặt tiền / hẻm)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">type3</span> :	<?php _e('Hướng (đông / tây / nam / bắc / ...)', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">type4</span> :	<?php _e('Pháp lý (sổ đỏ / sổ hồng / viết tay / ...)', 'fox'); ?>
				</p>
				<p>
				    <span style="font-weight:bold;color:#ff4444">size1</span> : <?php _e('Chiều rộng', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">size2</span> : <?php _e('Chiều dài', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">size3</span> : <?php _e('Diện tích', 'fox'); ?>
				</p>
				<p>
				    <span style="font-weight:bold;color:#ff4444">price1</span> : <?php _e('Số tiền', 'fox'); ?>
				</p>
				    <span style="font-weight:bold;color:#ff4444">call1</span> : <?php _e('Điện thoại', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">call2</span> : <?php _e('Zalo', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">call3</span> : <?php _e('Messenger', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">call4</span> : <?php _e('Email', 'fox'); ?>
				</div>
			</div>
			
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Shop', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">shop</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">type</span> : <?php _e('Chuyên mục sản phẩm', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
				<p>
				    <span style="font-weight:bold;color:#ff4444">price1</span> : <?php _e('Số tiền', 'fox'); ?>
				</p>
				<p>
					<span style="font-weight:bold;color:#ff4444">deal1</span> :	<?php _e('% giảm giá', 'fox'); ?>
				</p>
				    <span style="font-weight:bold;color:#ff4444">affiliate1</span> : <?php _e('Link tiếp thị Shopee', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">affiliate2</span> : <?php _e('Link tiếp thị Tiki', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">affiliate3</span> : <?php _e('Link tiếp thị Lazada', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">affiliate4</span> : <?php _e('Link tiếp thị Sendo', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">affiliate5</span> : <?php _e('Link tiếp thị Amazon', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">affiliate6</span> : <?php _e('Link tiếp thị Banggood', 'fox'); ?>
				</div>
			</div>
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Codex', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">codex</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">run</span> : <?php _e('Chuyên mục code', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
				     <span style="font-weight:bold;color:#ff4444">codex1</span> : <?php _e('Mã Html / CSS / Javascript / jQuery', 'fox'); ?>
				</div>
			</div>
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Youtube', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">youtube</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">channel</span> : <?php _e('Chuyên mục Youtube', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">youtube1</span> : <?php _e('Link Youtube', 'fox'); ?>
				</div>
			</div>
			
			<div class="admin-card">
			<div class="admin-cm"><?php _e('Tài liệu về Coupon', 'fox'); ?></div>
				<div class="admin-docs-tit">Post type</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">coupon</span>
				</div>
				<div class="admin-docs-tit">Taxonomy</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">show</span> : <?php _e('Nguồn coupon', 'fox'); ?>
				</div>
				<div class="admin-docs-tit">Metabox</div>
				<div class="admin-div-note admin-note-card">
					<span style="font-weight:bold;color:#ff4444">coupon1</span> : <?php _e('Nội dung coupon', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">coupon2</span> : <?php _e('Phần trăm giảm giá', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">coupon3</span> : <?php _e('Ngày hết hạn', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">coupon4</span> : <?php _e('Mã giảm giá', 'fox'); ?><br>
					<span style="font-weight:bold;color:#ff4444">coupon5</span> : <?php _e('Liên kết tiếp thị', 'fox'); ?>
				</div>
			</div>
			
		</div>
	
	<div class="admin-card">
			<div class="admin-cm"><?php _e('Hướng dẫn sử dụng và tài liệu trực tuyến', 'fox'); ?></div>
			<?php _e('Bạn có thể xem hướng dẫn sử dụng Foxtheme tại đại chỉ này:', 'fox'); ?> <a title="foxtheme" href="https://foxtheme.net">Foxtheme.net</a>
	</div>
	</div>
	<?php
	echo ob_get_clean();
}
function fox_note_add_options_link() {
	add_submenu_page ('fox-options', 'Note', '<i class="fa-regular fa-note"></i> Note', 'manage_options', 'foxnote-options', 'foxnote_options_page');
}
add_action('admin_menu', 'fox_note_add_options_link');

