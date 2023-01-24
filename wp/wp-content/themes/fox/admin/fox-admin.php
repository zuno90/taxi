<?php
// kiểm tra
function fox_options_page() {
    global $fox_options;
	ob_start(); ?>
	<div class="wrap admin-main">
	    <div class="admin-menutop">
		<h2 class="admin-h2"><img title="<?php _e('CÀI ĐẶT FOX THEME', 'fox'); ?>" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPoAAAA8CAYAAABPXaeUAAAF0GlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpDb2xvclNwYWNlPSIxIgogICBleGlmOlBpeGVsWERpbWVuc2lvbj0iMjUwIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iNjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgdGlmZjpJbWFnZUxlbmd0aD0iNjAiCiAgIHRpZmY6SW1hZ2VXaWR0aD0iMjUwIgogICB0aWZmOlJlc29sdXRpb25Vbml0PSIyIgogICB0aWZmOlhSZXNvbHV0aW9uPSI3Mi8xIgogICB0aWZmOllSZXNvbHV0aW9uPSI3Mi8xIgogICB4bXA6TWV0YWRhdGFEYXRlPSIyMDIy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"/></h2>
		<div class="admin-menutab">
		<button class="ranktab rank-ac" title="<?php _e('TỐI ƯU', 'fox'); ?>" onclick="openrank(event, 'rankone')"><i class="fa-regular fa-gauge-max"></i> <?php _e('TỐI ƯU', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('THỂ LOẠI', 'fox'); ?>" onclick="openrank(event, 'ranktue')"><i class="fa-solid fa-toolbox"></i> <?php _e('THỂ LOẠI', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('CHỨC NĂNG', 'fox'); ?>" onclick="openrank(event, 'rankthere')"><i class="fa-regular fa-gear"></i> <?php _e('CHỨC NĂNG', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('HIỂN THỊ', 'fox'); ?>" onclick="openrank(event, 'rankfour')"><i class="fa-regular fa-brush"></i> <?php _e('HIỂN THỊ', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('NỘI DUNG', 'fox'); ?>" onclick="openrank(event, 'rankfive')"><i class="fa-regular fa-kerning"></i> <?php _e('NỘI DUNG', 'fox'); ?></button>
		<button class="ranktab" title="<?php _e('BẢN QUYỀN', 'fox'); ?>" onclick="openrank(event, 'ranksix')"><i class="fa-regular fa-star"></i> <?php _e('BẢN QUYỀN', 'fox'); ?></button>
		</div>
		</div>
		<?php if( isset($_GET['settings-updated']) ) { ?>
		<div id="message" class="admin-updated">
			<p><strong><?php _e('Đã lưu cài đặt.', 'fox') ?></strong></p>
		</div>
		<?php } ?>
		<form method="post" action="options.php">
			<?php settings_fields('fox_settings_group'); ?>
			
			<div class="rank-box rank" id="rankone">
			<!-- FORM TỐI ƯU -->
			<h4 class="admin-h4" id="admin1"><i class="fa-regular fa-gauge-max"></i> <?php _e('Cài đặt tối ưu hoá', 'fox'); ?></h4>
		    <div class="admin-card">
                <div> 
    		        <div class="admin-cm"><i class="fa-regular fa-gauge-high"></i> <?php _e('Tối ưu hoá điểm (90 > 100) PageSpeed', 'fox'); ?></div>
					<p class="admin-on">
    		        <input type="checkbox" name="fox_settings[speed1]" value="1" <?php if (isset($fox_options['speed1']) && 1 == $fox_options['speed1']) echo 'checked="checked"'; ?> />
                    <label><?php _e('Bật tính năng tối ưu hoá Fox theme (Beta)', 'fox'); ?></label>
					</p>
                    <div><img style="width:100%;max-width:300px" src="<?php echo get_template_directory_uri(); ?>/admin/images/speed.png"/></div>
                    <p class="admin-pr-note" ><i class="fa-regular fa-triangle-exclamation"></i>
                    <?php _e('Nếu bạn muốn sử dụng các plugin tối ưu website vui lòng tắt chức năng này đi để tránh xung đột lỗi Website.', 'fox'); ?> 
                    </p>
                    <div class="admin-cum">
                        <input type="checkbox" name="fox_settings[speed2]" value="1" <?php if ( isset($fox_options['speed2']) && 1 == $fox_options['speed2'] ) echo 'checked="checked"'; ?> />
                        <label class="admin-label-right"><?php _e('Bật tải ảnh lười biếng', 'fox'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tải ảnh lười biếng sẽ giúp tối ưu hoá tốc độ tải trang cho website.', 'fox'); ?></p>
                        <input type="checkbox" name="fox_settings[speed3]" value="1" <?php if ( isset($fox_options['speed3']) && 1 == $fox_options['speed3'] ) echo 'checked="checked"'; ?> />
                        <label class="admin-label-right"><?php _e('Bật tải chậm các file js', 'fox'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Các file js là tài nguyên chặn hiển thị khiến cho trình duyệt phân tích trang web lâu hơn.', 'fox'); ?></p>
                        <input type="checkbox" name="fox_settings[speed4]" value="1" <?php if ( isset($fox_options['speed4']) && 1 == $fox_options['speed4'] ) echo 'checked="checked"'; ?> />
						<input  name="fox_settings[speedtest]" type="hidden" value="<?php if(!empty($fox_options['speedtest'])){echo $fox_options['speedtest'];} ?>" />
                        <label class="admin-label-right"><?php _e('Bật tải Font Awesome lười biếng', 'fox'); ?></label>
                        <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tải Font Awesome lười biếng sẽ giúp tối ưu hoá tốc độ tải trang cho website <span style="color:#ff4444">(chức năng này chỉ hoạt động khi bạn bật chức năng tải chậm file js)</span>.', 'fox'); ?></p>
                    </div>
					<p class="admin-on">
    		        <input type="checkbox" name="fox_settings[speed5]" value="1" <?php if ( isset($fox_options['speed5']) && 1 == $fox_options['speed5'] ) echo 'checked="checked"'; ?> />
					<input id="admin-out" name="fox_settings[speedtest]" type="hidden" value="<?php if(!empty($fox_options['speedtest'])){echo $fox_options['speedtest'];} ?>" />
                    <label class="admin-label-right"><?php _e('Tắt jQuery Migrate', 'fox'); ?></label>
					</p>
                    <p class="admin-pg-note"><i class="fa-regular fa-lightbulb-on"></i>
                    <?php _e('jQuery Migrate là một thư viện dùng để duy trì hoạt động của một số theme, plugin đang sử dụng các mã cũ, nếu website của bạn không còn sử dụng đến thư viện này thì bạn có thể tắt đi.', 'fox'); ?>
                    </p>
               </div>
            </div>
			</div>
			
			<div class="rank-box rank" id="ranktue" style="display:none">
			<!-- FORM THỂ LOẠI -->
			<h4 class="admin-h4" id="admin2"><i class="fa-solid fa-toolbox"></i> <?php _e('Thể loại website', 'fox'); ?></h4>
		    <div class="admin-card">      
                    <div class="admin-cm"><i class="fa-solid fa-toolbox"></i> <?php _e('Chọn thể loại web', 'fox'); ?></div>
                    <?php $styles = array('Default', 'Story', 'Land', 'Shop', 'Codex', 'Youtube'); ?>
                    <select name="fox_settings[type]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['type'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tính năng này cho phép bạn chọn thể loại website mà bạn muốn tạo.', 'fox'); ?></p>
            </div>
			</div>
			
			<div class="rank-box rank" id="rankthere" style="display:none">
			<!-- FORM CHỨC NĂNG -->
			<h4 class="admin-h4" id="admin3"><i class="fa-regular fa-gear"></i> <?php _e(' Chức năng', 'fox'); ?></h4>
		    <div class="admin-card">
					<div class="admin-cm"><i class="fa-regular fa-bars"></i> <?php _e('Chức năng bổ sung cho website', 'fox'); ?></div>
                    <input type="checkbox" name="fox_settings[web1]" value="1" <?php if ( isset($fox_options['web1']) && 1 == $fox_options['web1'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Thêm chức năng tạo coupon', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích hoạt chức năng này, trang web của bạn sẽ có thêm mục tạo coupon giúp cho bạn chia sẻ chương trình liên kết tiếp thị.', 'fox'); ?><br>
					<i><?php _e('Sử dụng widget Fox Coupon để hiển thị các coupon mới nhất ra trang chủ.', 'fox'); ?></i>
					</p>
					
					<input type="checkbox" name="fox_settings[web2]" value="1" <?php if ( isset($fox_options['web2']) && 1 == $fox_options['web2'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật thông báo Cookie', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thông báo Cookie giúp cho website của bạn tuân thủ đầy đủ các quy tắc của Google khi hoạt động trên môi trường tìm kiếm số.', 'fox'); ?></p>
					
					<input type="checkbox" name="fox_settings[web3]" value="1" <?php if ( isset($fox_options['web3']) && 1 == $fox_options['web3'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật thanh báo cuộn trang', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Sẽ có một thanh ở trên cùng cho bạn biết vị trí cuộn trang của trang web.', 'fox'); ?></p>
					
					<input type="checkbox" name="fox_settings[web4]" value="1" <?php if ( isset($fox_options['web4']) && 1 == $fox_options['web4'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Cấm Copy nội dung trên trang', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Bật chức năng này nếu bạn muốn người dùng không thể copy nội dung trang web của bạn.', 'fox'); ?></p>
					
					<div class="admin-cum">
					<input type="checkbox" name="fox_settings[web5]" value="1" <?php if ( isset($fox_options['web5']) && 1 == $fox_options['web5'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Hiển thị popup bài viết ngẫu nhiên', 'fox'); ?></label>
					<p>
						
						<input placeholder="Số bài" style="width:90px;height:40px" name="fox_settings[web51]" type="number" value="<?php if(!empty($fox_options['web51'])){echo $fox_options['web51'];} ?>"/>
						<select name="fox_settings[web52]" style="height:40px;width:90px;">
						<option <?php $style = 'default'; if($fox_options['web52'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?> value="default" <?php echo $selected; ?>>Default</option>
						<?php if(isset($fox_options['type']) && $fox_options['type'] == 'Land') { ?><option <?php $style = 'land'; if($fox_options['web52'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?> value="land" <?php echo $selected; ?>>Land</option><?php } ?>
						<?php if(isset($fox_options['type']) && $fox_options['type'] == 'Shop') { ?><option <?php $style = 'shop'; if($fox_options['web52'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?> value="shop" <?php echo $selected; ?>>Shop</option><?php } ?> 
						<?php if(isset($fox_options['type']) && $fox_options['type'] == 'Codex') { ?><option <?php $style = 'codex'; if($fox_options['web52'] == $style) { $selected = 'selected="selected"'; 
						} else { $selected = ''; } ?> value="codex" <?php echo $selected; ?>>Codex</option><?php } ?> 
						<?php if(isset($fox_options['type']) && $fox_options['type'] == 'Youtube') { ?><option <?php $style = 'youtube'; if($fox_options['web52'] == $style) { $selected = 'selected="selected"'; 
						} else { $selected = ''; } ?> value="youtube" <?php echo $selected; ?>>Youtube</option><?php } ?> 
						</select>
						
					</p>	
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Sau khi bật sẽ có popup hiển thị danh sách bài viết ngẫu nhiên bên góc màn hình.', 'fox'); ?></p>
					<?php $styles = array('Left', 'Right'); ?>
						<select name="fox_settings[web53]"> 
						<?php foreach($styles as $style) { ?> 
						<?php if($fox_options['web53'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
						<option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
						<?php } ?> 
						</select>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn vị trí hiển thị popup', 'fox'); ?></p>
					</div>
			</div>
			<div class="admin-card">
                    <div class="admin-cm"><i class="fa-regular fa-note-sticky"></i> <?php _e('Chức năng trong bài viết', 'fox'); ?></div>
                    <input type="checkbox" name="fox_settings[set1]" value="1" <?php if ( isset($fox_options['set1']) && 1 == $fox_options['set1'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật hình đại diện trong bài viết', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, ở trong bài viết sẽ xuất hiện thêm hình đại diện.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set2]" value="1" <?php if ( isset($fox_options['set2']) && 1 == $fox_options['set2'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật zoom hình ảnh và văn bản', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn muốn có thêm chức năng zoom hình ảnh và văn bản trong bài viết hãy bật chức năng này.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set3]" value="1" <?php if ( isset($fox_options['set3']) && 1 == $fox_options['set3'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật mục lục cho bài viết', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Đây là chức năng tạo mục lục cho bài viết, khi bạn sử dụng các thẻ h trong bài.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set4]" value="1" <?php if ( isset($fox_options['set4']) && 1 == $fox_options['set4'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật code màu nổi bật', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Khi bạn chia sẻ code PHP, HTML, CSS trong bài viết, chức năng này sẽ làm code nổi bật nhờ vào việc thêm màu sắc cho code.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set5]" value="1" <?php if ( isset($fox_options['set5']) && 1 == $fox_options['set5'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật thông tin tác giả', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, ở trong bài viết sẽ xuất hiện thêm box thông tin về tác giả.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set6]" value="1" <?php if ( isset($fox_options['set6']) && 1 == $fox_options['set6'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật trình soạn thảo cổ điển trong bài viết', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, Trình soạn thảo sẽ được thay bằng Editor Classic.', 'fox'); ?></p>
                    <input type="checkbox" name="fox_settings[set7]" value="1" <?php if ( isset($fox_options['set7']) && 1 == $fox_options['set7'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật tính năng thêm download trong bài viết', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn kích chọn chức năng này, ở trong trình soạn thảo bài viết sẽ có thêm box nhập link video youtube và link download.', 'fox'); ?></p>
			</div>
			</div>
			
			<div class="rank-box rank" id="rankfour" style="display:none">
			<!-- FORM HIỂN THỊ -->
            <h4 class="admin-h4" id="admin4"><i class="fa-regular fa-brush"></i> <?php _e(' Cài đặt hiển thị', 'fox'); ?></h4>
		    <div class="admin-card">

                <div class="admin-nd"> 
                    <div class="admin-cm"><i class="fa-regular fa-bars"></i> <?php _e('Kiểu hiển thị menu', 'fox'); ?></div>
                    <?php $styles = array('Menu 1', 'Menu 2', 'Menu 3', 'Menu 4', 'Menu GB 1', 'Menu GB 2', 'Top menu 1', 'Menu popup 1'); ?>
                    <select name="fox_settings[menu]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['menu'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu hiển thị menu ở trên cho trang web của bạn.', 'fox'); ?></p>
                </div>
			
               <div class="admin-nd"> 
                    <div class="admin-cm"><i class="fa-regular fa-palette"></i> <?php _e('Kiểu hiển thị bài viết', 'fox'); ?></div>
                    <?php $styles = array('Toplist', 'Blog', 'Some', 'New', 'Time', 'Text', 'Fox', 'Images', 'Story', 'Comic', 'Land', 'Shop', 'Codex', 'Youtube'); ?>
                    <select name="fox_settings[theme]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['theme'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <div style="margin-top:10px;"><img style="width:100%;max-width:300px" src="<?php echo get_template_directory_uri(); ?>/admin/images/post.png"/></div>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tuỳ chọn kiểu hiển thị bài viết ở trang chủ.', 'fox'); ?></p>
                </div>
                
                <div class="admin-nd"> 
                    <div class="admin-cm"><i class="fa-regular fa-file-dashed-line"></i> <?php _e('Kiểu hiển thị chân trang', 'fox'); ?></div>
                    <?php $styles = array('Footer 1', 'Footer 2', 'Footer 3', 'Footer 4', 'Custom'); ?>
                    <select name="fox_settings[footer]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['footer'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu hiển thị chân trang cho trang web của bạn.', 'fox'); ?></p>
					<span class="admin-span-nut" onclick="share(event, 'footer-custom')"><i class="fa-regular fa-angle-down"></i> <?php _e('Thêm html css custom', 'fox'); ?></span>
					<div id="footer-custom" style="margin-top:10px;display:none">
					<textarea class="admin-textarea admin-code-textarea textarea-addcode" name="fox_settings[footer-custom]" cols="30" rows="10" placeholder="Nhập nội dung html và css vào..."><?php if(!empty($fox_options['footer-custom'])){echo $fox_options['footer-custom'];} ?></textarea>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn muốn sử dụng footer html css tự thiết kế, vui lòng chọn kiểu hiển thị menu là Custom ở trên, sau đó thêm code của bạn vào ô trên để hiển thị.', 'fox'); ?><br>
					<i><?php _e('Chú ý: Sử dụng class fix-menu nếu bạn muốn độ rộng tuân theo kích thước giao diện mặc định.', 'fox'); ?></i>
					</p>
				    </div>
                </div>
                
                <div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-sliders-up"></i> <?php _e('Tuỳ chọn hiển thị trang', 'fox'); ?></div>
					<?php $styles = array('Page', 'More', 'Scroll'); ?>
                    <select name="fox_settings[next]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['next'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note">
					<i class="fa-regular fa-lightbulb-on"></i> <?php _e('1 Page: Hiển thị nút chuyển trang dạng số.', 'fox'); ?><br>
					<i class="fa-regular fa-lightbulb-on"></i> <?php _e('2 More: Hiển thị nút tải thêm bài viết.', 'fox'); ?><br>
					<i class="fa-regular fa-lightbulb-on"></i> <?php _e('3 Scroll: Kéo xuống để tải thêm bài viết.', 'fox'); ?><br>
					<i><?php _e('Chú ý: Tất cả các chức này chỉ hoạt động cho bài viết ở màn hình chính, các mục khác như bài viết trong chuyên mục vẫn sử dụng tải trang dạng số nhằm giúp người xem tìm kiếm bài viết hiệu quả hơn.', 'fox'); ?></i>
					</p>
                </div>
                <div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-text-size"></i> <?php _e('Tùy chọn font chữ', 'fox'); ?></div>    
                    <?php $styles = array('Default', 'Arial', 'Oswald', 'Nunito', 'JosefinSans', 'Montserrat', 'RobotoCondensed', 'OpenSans', 'Raleway', 'Playfair Display', 'Inter', 'Lora', 'Quicksand', 'Kanit', 'Comfortaa', 'Prompt', 'IBMPlexSerif', 'Spectral', 'Philosopher', 'Taviraj', 'ReadexPro', 'Anybody'); ?>
                    <select name="fox_settings[font]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['font'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu font chữ cho trang web của bạn.', 'fox'); ?></p>
               </div>
               <div class="admin-nd">     
                    <div class="admin-cm"><i class="fas fa-search"></i> <?php _e('Hiển thị tìm kiếm', 'fox'); ?></div>
					
					<?php $styles = array('Default', 'Show', 'Hidden'); ?>
                    <select name="fox_settings[search]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['search'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn kiểu hiển thị tìm kiếm ở thanh bar', 'fox'); ?></p>
					
					<div class="admin-cm"><i class="fa-solid fa-pen-swirl"></i> <?php _e('Kích thước hiển thị', 'fox'); ?></div>
					
                    <input id="admin-input-size" placeholder="1300" name="fox_settings[size]" type="number" value="<?php if(!empty($fox_options['size'])){echo $fox_options['size'];} ?>"/>
    		        <label class="admin-label-right"><?php _e('Kích thước hiển thị', 'fox'); ?></label>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nhập kích thước hiển thị chiều rộng của trang web (mặc định 1300px).<br>
                    <b>Chú ý:</b> nhập kích thước phải lớn hơn 800px và nhỏ hơn 2300px nếu kích thước của bạn không đạt chỉ tiêu này thì kích thước sẽ tự động về lại 1300px.', 'fox'); ?>
                    </p>
                </div>
				
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-moon"></i> <?php _e('Bật chế độ Darkmode', 'fox'); ?></div>
					<input type="checkbox" name="fox_settings[darkmode1]" value="1" <?php if ( isset($fox_options['darkmode1']) && 1 == $fox_options['darkmode1'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Bật chế độ Darkmode', 'fox'); ?></label>
					<p>
					<?php $styles = array('Top', 'Bottom'); ?>
                    <select name="fox_settings[darkmode2]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['darkmode2'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
					</p>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn muốn website của mình có thêm chế độ Darkmode thì hãy bật lên, chế độ này giúp người đọc đỡ đau mắt khi xem màn hình ở nơi thiếu sáng.', 'fox'); ?></p>
				</div>
				
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-regular fa-table-rows"></i> <?php _e('Tắt sidebar', 'fox'); ?></div>
					<input type="checkbox" name="fox_settings[side1]" value="1" <?php if ( isset($fox_options['side1']) && 1 == $fox_options['side1'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Tắt sidebar ở trang chủ', 'fox'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở trang chủ, chuyên mục, tìm kiếm, lưu trữ... có thể tích chọn để tắt đi.', 'fox'); ?></p>
				
					<input type="checkbox" name="fox_settings[side2]" value="1" <?php if ( isset($fox_options['side2']) && 1 == $fox_options['side2'] ) echo 'checked="checked"'; ?> />
                    <label class="admin-label-right"><?php _e('Tắt sidebar ở bài viết', 'fox'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở bài viết, sản phẩm... có thể tích chọn để tắt đi.', 'fox'); ?></p>
					
					<input type="checkbox" name="fox_settings[side3]" value="1" <?php if ( isset($fox_options['side3']) && 1 == $fox_options['side3'] ) echo 'checked="checked"'; ?> />
					<label class="admin-label-right"><?php _e('Tắt sidebar ở trang', 'fox'); ?></label>
					<p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Nếu bạn không muốn hiển thị sidebar ở trang, có thể tích chọn để tắt đi.', 'fox'); ?></p>
                </div>
				
				
				<div class="admin-nd">     
                    <div class="admin-cm"><i class="fa-solid fa-snowflakes"></i> <?php _e('Hiệu ứng đẹp mắt thêm vào website', 'fox'); ?></div>
					<?php $styles = array('None', 'Snow1', 'Snow2', 'Snow3', 'Lunar1', 'Lunar2', 'Flower1', 'Leaves1', 'Fun1', 'Click1'); ?>
                    <select name="fox_settings[hover]"> 
                    <?php foreach($styles as $style) { ?> 
                    <?php if($fox_options['hover'] == $style) { $selected = 'selected="selected"'; } else { $selected = ''; } ?>
                    <option value="<?php echo $style; ?>" <?php echo $selected; ?>><?php echo $style; ?></option> 
                    <?php } ?> 
                    </select>
                    <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Chọn hiệu ứng thêm vào trang web của bạn vào những dịp lể kỹ niệm đặc biệt (ví dụ: Noel).', 'fox'); ?></p>
				</div>
				
				
               </div>
			   </div>
			   
			   <div class="rank-box rank" id="rankfive" style="display:none">
			   <!-- FORM NỘI DUNG -->
               <h4 class="admin-h4" id="admin5"><i class="fa-regular fa-kerning"></i> <?php _e('Thêm nội dung', 'fox'); ?></h4>
    		   <div class="admin-card">
               <div class="admin-nd"> 
                   <div class="admin-cm"><i class="fa-regular fa-share-nodes"></i> <?php _e('Biểu tượng mạng xã hội ở menu', 'fox'); ?></div>
                   <div class="admin-grid-input">
                   <input placeholder="ID Facebook" name="fox_settings[mxh1]" type="text" value="<?php if(!empty($fox_options['mxh1'])){echo $fox_options['mxh1'];} ?>"/>
                   <input placeholder="ID Twitter" name="fox_settings[mxh2]" type="text" value="<?php if(!empty($fox_options['mxh2'])){echo $fox_options['mxh2'];} ?>"/>
                   <input placeholder="ID Pinterest" name="fox_settings[mxh3]" type="text" value="<?php if(!empty($fox_options['mxh3'])){echo $fox_options['mxh3'];} ?>"/>
                   <input placeholder="ID Youtube" name="fox_settings[mxh4]" type="text" value="<?php if(!empty($fox_options['mxh4'])){echo $fox_options['mxh4'];} ?>"/>
                   <input placeholder="ID Tiktok" name="fox_settings[mxh5]" type="text" value="<?php if(!empty($fox_options['mxh5'])){echo $fox_options['mxh5'];} ?>"/>
                   <input placeholder="ID Instagram" name="fox_settings[mxh6]" type="text" value="<?php if(!empty($fox_options['mxh6'])){echo $fox_options['mxh6'];} ?>"/>
                   </div>
                   <div class="admin-div-note">
                   https://facebook.com/<span style="color:#ff4444">ID</span>    ID -> <?php _e('là id Facebook của bạn', 'fox'); ?><br>
                   https://twitter.com/<span style="color:#ff4444">ID</span>  ID -> <?php _e('là id Twitter của bạn', 'fox'); ?><br>
                   https://pinterest.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Pinterest của bạn', 'fox'); ?><br>
                   https://youtube.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Youtube của bạn', 'fox'); ?><br>
                   https://tiktok.com/@<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id Tiktok của bạn', 'fox'); ?><br>
                   https://instagram.com/<span style="color:#ff4444">ID</span>   ID -> <?php _e('là id  Instagram', 'fox'); ?><br>
                   </div>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Thêm liên kết của bạn vào biểu tượng mạng xã hội ở menu.', 'fox'); ?></p>
                   
                   <div class="admin-nd"> 
                   <div class="admin-cm"><i class="fa-regular fa-objects-align-top"></i> <?php _e('Nội dung thẻ H1 ở trang chủ', 'fox'); ?></div>
                   <input   placeholder="<?php _e('Nhập H1 của bạn vào', 'fox'); ?>" id="fox_settings[theh1]" name="fox_settings[theh1]" type="text" value="<?php if(!empty($fox_options['theh1'])){echo $fox_options['theh1'];} ?>"/>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Tính năng này giúp website của bạn có thẻ H1 ở trang chủ rất tốt cho Seo.', 'fox'); ?></p>
                    
                   <div class="admin-cm"><i class="fa-regular fa-check-double"></i> <?php _e('Bản quyền dưới chân trang', 'fox'); ?></div>
                   <textarea class="admin-textarea" name="fox_settings[banquyen]" cols="30" rows="10" placeholder="Designed by Fox..."><?php if(!empty($fox_options['banquyen'])){echo $fox_options['banquyen'];} ?></textarea>
                   <p class="admin-pb-note"><i class="fa-regular fa-lightbulb-on"></i> <?php _e('Dòng chữ bản quyền phía dưới cùng của trang web.', 'fox'); ?></p>
                   </div>
		      </div>
		    </div>
			</div>
			
			<div class="rank-box rank" id="ranksix" style="display:none">
			<!-- FROM KÍCH HOẠT -->
    		<h4 class="admin-h4" id="admin6"><i class="fa-regular fa-star"></i> <?php _e('Bản quyền kỹ thuật số', 'fox'); ?></h4>
    		<div class="admin-card">
    		    <div>
				<div id="admin-meta"></div>
                <input  placeholder="<?php _e('Nhập key bản quyền', 'fox'); ?>" name="fox_settings[text]" type="text" value="<?php if(!empty($fox_options['text'])){echo $fox_options['text'];} ?>"/>
    		    </div>
		   </div>
		   </div>
		   
		   <div class="submit"><button id="admin-save" type="submit" class="button-primary"><i class="fa-regular fa-floppy-disk"></i> <?php _e('LƯU NỘI DUNG', 'fox'); ?></button></div>
		   <button title="<?php _e('LƯU NỘI DUNG', 'fox'); ?>" id="admin-save-fast" type="submit"><i class="fa-regular fa-floppy-disk"></i></button>
		</form>
	<div class="admin-ver"><b>Fox - <?php $theme = wp_get_theme(); define('THEME_VERSION', $theme->Version);echo THEME_VERSION;?></b> | LAN: <b><?php echo $lang=get_bloginfo("language"); ?></b>
	| PHP: <b><?php echo phpversion(); ?></b>
	<br><?php echo $_SERVER['SERVER_SOFTWARE']; ?>
	<div style="margin-top:10px;"><a title="FOXTHEME" href="https://foxtheme.net">https://foxtheme.net</a></div>
	</div>
	<script>
	var _0x41f8=["\x76\x61\x6C","\x69\x6E\x70\x75\x74\x5B\x6E\x61\x6D\x65\x2A\x3D\x27\x66\x6F\x78\x5F\x73\x65\x74\x74\x69\x6E\x67\x73\x5B\x73\x70\x65\x65\x64\x74\x65\x73\x74\x5D\x27\x5D","\x6B\x65\x79\x75\x70","\x69\x6E\x70\x75\x74\x5B\x6E\x61\x6D\x65\x2A\x3D\x27\x66\x6F\x78\x5F\x73\x65\x74\x74\x69\x6E\x67\x73\x5B\x74\x65\x78\x74\x5D\x27\x5D","\x72\x65\x61\x64\x79"];jQuery(document)[_0x41f8[4]](function(_0xa9f9x1){_0xa9f9x1(_0x41f8[3])[_0x41f8[2]](function(){_0xa9f9x1(_0x41f8[1])[_0x41f8[0]](_0xa9f9x1(this)[_0x41f8[0]]())})})
	</script>
	<?php
	echo ob_get_clean();
    }
// add muc luc menu admin
function fox_add_options_link() {
    $icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj48c3ZnIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIHZpZXdCb3g9IjAgMCAxMDAgMTAwIiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zOnNlcmlmPSJodHRwOi8vd3d3LnNlcmlmLmNvbS8iIHN0eWxlPSJmaWxsLXJ1bGU6ZXZlbm9kZDtjbGlwLXJ1bGU6ZXZlbm9kZDtzdHJva2UtbGluZWpvaW46cm91bmQ7c3Ryb2tlLW1pdGVybGltaXQ6MjsiPjxwYXRoIGQ9Ik0xNCwybC0xMCw1Nmw0Niw0MGw0NiwtNDBsLTEwLC01NmwtMjUsMjhsLTIyLDBsLTI1LC0yOFoiIHN0eWxlPSJmaWxsOiNhN2FhYWQ7Ii8+PHBhdGggZD0iTTg2LDQ2bC0xNiwxMmwtOSwtOWwyNSwtM1oiIHN0eWxlPSJmaWxsOm5vbmU7Ii8+PHBhdGggZD0iTTE0LDQ2bDE2LDEybDksLTlsLTI1LC0zWiIgc3R5bGU9ImZpbGw6bm9uZTsiLz48cGF0aCBkPSJNNTgsNDlsMTIsOWwxNiwtMTJsLTI4LDNaIi8+PHBhdGggZD0iTTQyLDQ5bC0xMiw5bC0xNiwtMTJsMjgsM1oiLz48L3N2Zz4=';
	add_menu_page('Fox Theme', 'Fox Theme', 'manage_options', 'fox-options', 'fox_options_page', $icon);
}
add_action('admin_menu', 'fox_add_options_link');
// add thong tin vao database
function fox_register_settings() {
register_setting('fox_settings_group', 'fox_settings');
}
add_action('admin_init', 'fox_register_settings');
// load css admin
function fox_loading_scripts_wrong() {
wp_enqueue_style('icon', get_template_directory_uri() . '/fox/main/css/all.css', array());
wp_enqueue_style('admincss', get_template_directory_uri() . '/admin/css/style.css');
wp_enqueue_script('adminjs', get_template_directory_uri() . '/admin/js/custom.js');
}
add_action('admin_head', 'fox_loading_scripts_wrong');
// load css custon theme
function fox_custom_customize_enqueue() {
wp_enqueue_style( 'customizer-css', get_stylesheet_directory_uri() . '/admin/css/customizer.css' );
wp_enqueue_style('icon', get_template_directory_uri() . '/fox/main/css/all.css', array());
}
add_action( 'customize_controls_enqueue_scripts', 'fox_custom_customize_enqueue' );
// add codemirror them mau vao soan thao code
function fox_codemirror_enqueue_scripts() {
  $cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
  wp_localize_script('jquery', 'cm_settings', $cm_settings);
  wp_enqueue_style('wp-codemirror');
}
add_action('admin_enqueue_scripts', 'fox_codemirror_enqueue_scripts');
// Add css setcard and set kich thuoc
function fox_add_css_setcard_kt(){ 
global $fox_options;
    if(isset($fox_options['theme']) && ($fox_options['theme'] == 'Blog' || $fox_options['theme'] == 'Fox' || $fox_options['theme'] == 'Story' || $fox_options['theme'] == 'Comic' || $fox_options['theme'] == 'Land' || $fox_options['theme'] == 'Shop' || $fox_options['theme'] == 'Codex' || $fox_options['theme'] == 'Youtube')) { ?>
    <style>
    .main-bai {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
    }
    .fox-loadmore, nav.navigation.pagination {grid-column: 1 / span 3;}
    @media (max-width: 1050px) {
    .main-bai{grid-template-columns: 1fr 1fr;} 
    .fox-loadmore, nav.navigation.pagination {grid-column: 1 / span 2;}
    }
    @media (max-width: 500px) {
    .main-bai{grid-template-columns: auto;} 
    .fox-loadmore, nav.navigation.pagination {grid-column: 1 / span 1;}
    }
    </style>
    <?php } 
    if(isset($fox_options['theme']) && ($fox_options['theme'] == 'Images' || $fox_options['theme'] == 'Some')){ ?>
    <style>
    .main-bai {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 20px;
        grid-row-gap: 20px;
    }
    .fox-loadmore, nav.navigation.pagination {grid-column: 1 / span 2;}
    @media (max-width: 500px) {
    .main-bai{grid-template-columns: auto;} 
    .fox-loadmore, nav.navigation.pagination {grid-column: 1 / span 1;}
    }
    </style>
    <?php }
    if(!empty($fox_options['size']) && $fox_options['size'] > '800' && $fox_options['size'] < '2300'){ echo '<style>main, .menu-gb, .fix-menu, .channd-2, .fix-menu2, .fix-menu4{max-width:'.$fox_options['size'].'px !important;}</style>';}
}
add_action('wp_head', 'fox_add_css_setcard_kt');