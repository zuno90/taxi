<?php
global $land_options, $fox_options; ?>
	<div class="land-images-dang">
	<?php
	// quan ly cua land
	if (isset($fox_options['type']) && $fox_options['type'] == 'Land' && isset($land_options['login0'])){ ?>
	<a class="land-dang-tin" href="<?php bloginfo('url'); ?>/profile"><i class="fa-regular fa-pen-to-square"></i> Đăng tin</a>
	<?php } ?>
	</div>
	<div class="land-main-search">
	<form action="<?php bloginfo('url'); ?>/search-land">
				<div class="land-input">
				    <div class="input-wrapper">
				    <input type="text" name="search" placeholder="Tìm kiếm bất động sản" value="">
					<label for="stuff" class="fa-regular fa-house input-land-icon"></label>
					</div>
					<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
				</div>
				
<?php function fox_land_search_style() { global $land_options; ob_start(); ?>				
				
				<div class="land-button">
				    <?php if (isset($land_options['loc0'])) { ?>
				     <div class="land-div">
				     <span class="land-popup" onclick="share(event, 'land-adress')"><i class="fa-regular fa-location-dot"></i> Lọc vị trí</span>
					 <div class="land-sel" id="land-adress" style="display:none">
					 <div class="land-sel-title"><i class="fa-regular fa-location-dot"></i> Lọc tin theo vị trí</div>
					 
					    <div class="fox-select input-wrapper">
						<select name="adress1" id="city" >
						<option data-id="" value="" >Lọc tỉnh thành</option>        
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
                        </div>						
						
						<div class="fox-select input-wrapper">
						<select name="adress2" id="district" >
						<option data-id="" value="">Lọc quận huyện</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="adress3" id="ward" >
						<option data-id="" value="" >Lọc phường xã</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
						<span onclick="share(event, 'land-adress')">Áp dụng</span>
					</div>
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc1'])) { ?>
					<div class="land-div">
					<span class="land-popup" onclick="share(event, 'land-muc')"><i class="fa-regular fa-signs-post"></i> Lọc phân loại</span>
					<div class="land-sel" id="land-muc" style="display:none">
					<div class="land-sel-title"><i class="fa-regular fa-signs-post"></i> Lọc tin theo phân loại</div>
					<div class="fox-select input-wrapper">
						<select name="muc1" >
						<option value="" >Lọc loại đất</option>
						<?php
							$terms = get_terms([
								'taxonomy' => 'muc',
								'hide_empty' => false,
							]);
							foreach ($terms as $term){
								if ($term->parent > 0) {
									echo '<option value="'. $term->slug .'" >'. $term->name .'</option>';	
								} else {
									echo '<option style="font-weight:bold"  value="'. $term->slug .'" >'. $term->name .'</option>';	
								}
							}
						?> 					
						</select>
						<label for="stuff" class="fa-regular fa-signs-post input-land-icon"></label>
                        </div>
						<span onclick="share(event, 'land-muc')">Áp dụng</span>
					</div>
					</div>
					<?php } ?>
					
					
					<?php if (isset($land_options['loc2'])) { ?>
					<div class="land-div">
					<span class="land-popup" onclick="share(event, 'land-type')"><i class="fa-regular fa-arrow-down-big-small"></i> Lọc thông tin</span>
					<div class="land-sel" id="land-type" style="display:none">
					<div class="land-sel-title"><i class="fa-regular fa-arrow-down-big-small"></i> Lọc tin theo thông tin</div>						
						<div class="fox-select input-wrapper">
						<select name="type2" >
						<option value="">Lọc vị trí</option>
						<option value="Mặt tiền">Mặt tiền</option>
						<option value="Hẻm">Hẻm</option>
						</select>
						<label for="stuff" class="fa-regular fa-street-view input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type3" >
						<option value="">Lọc hướng</option>
						<option value="Đông">Đông</option>
						<option value="Tây">Tây</option>
						<option value="Nam">Nam</option>
						<option value="Bắc">Bắc</option>
						<option value="Đông Bắc">Đông Bắc</option>
						<option value="Tây Bắc">Tây Bắc</option>
						<option value="Đông Nam">Đông Nam</option>
						<option value="Tây Nam">Tây Nam</option>
						</select>
						<label for="stuff" class="fa-regular fa-compass input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type4" >
						<option value="">Lọc pháp lý</option>
						<option value="Sổ đỏ">Sổ đỏ</option>
						<option value="Sổ hồng">Sổ hồng</option>
						<option value="Sổ chung">Sổ chung</option>
						<option value="Hợp đồng">Hợp đồng</option>
						<option value="Viết tay">Viết tay</option>
						</select>
						<label for="stuff" class="fa-regular fa-notes input-land-icon"></label>
						</div>
						
						<span onclick="share(event, 'land-type')">Áp dụng</span>
					</div>
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc3'])) { ?> 
					<div class="land-div">
					<span class="land-popup" onclick="share(event, 'land-size')"><i class="fa-regular fa-arrow-up-right-from-square"></i> Lọc diện tích</span>
					<div class="land-sel" id="land-size" style="display:none">
					<div class="land-sel-title"><i class="fa-regular fa-arrow-up-right-from-square"></i> Lọc tin theo diện tích</div>
					
					    <div class="fox-select input-wrapper">
						<select name="size1" >
						<option value="" >Lọc diện tích</option>
						<option value="max" >Từ nhỏ tới lớn</option>
						<option value="min" >Từ lớn tới nhỏ</option>
						<option value="99" >Dưới 100 m2</option>   
						<option value="100" >Trên 100 m2</option>
						</select>
						<label for="stuff" class="fa-regular fa-up-right-from-square input-land-icon"></label>
                        </div>
						
						<span onclick="share(event, 'land-size')">Áp dụng</span>	 
					</div>
					</div>
					<?php } ?>
					
					<?php if (isset($land_options['loc4'])) { ?>
					<div class="land-div">
					<span class="land-popup" onclick="share(event, 'land-price')"><i class="fa-regular fa-coins"></i> Lọc giá</span>
					<div class="land-sel" id="land-price" style="display:none">
					<div class="land-sel-title"><i class="fa-regular fa-coins"></i> Lọc tin theo giá</div>
					
					    <div class="fox-select input-wrapper">
						<select name="price1" >
						<option value="" >Lọc giá</option>
						<option value="max" >Từ thấp tới cao</option>
						<option value="min" >Từ cao xuống thấp</option>
						<option value="999999999" >Dưới 1 tỷ</option>   
						<option value="1000000000" >Trên 1 tỷ</option>
						</select>
						<label for="stuff" class="fa-regular fa-coins input-land-icon"></label>
                        </div>						

						
						<span onclick="share(event, 'land-price')">Áp dụng</span>	 
					</div>
					</div>
					<?php } ?>
				</div>
				
<?php  
return ob_get_clean(); }
if(isset($land_options['style']) && $land_options['style'] == "Style1") { echo fox_land_search_style(); 
} elseif  (isset($land_options['style']) && $land_options['style'] == "Style2") { ?>


				<div class="land-search-type">
				        
						<?php if (isset($land_options['loc0'])) { ?>
						<div class="fox-select input-wrapper">
						<select name="adress1" id="city" >
						<option data-id="" value="" >Lọc tỉnh thành</option>        
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="adress2" id="district" >
						<option data-id="" value="">Lọc quận huyện</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="adress3" id="ward" >
						<option data-id="" value="" >Lọc phường xã</option>
						</select>
						<label for="stuff" class="fa-regular fa-location-dot input-land-icon"></label>
						</div>
						<?php } ?>
						
						<?php if (isset($land_options['loc1'])) { ?>
						<div class="fox-select input-wrapper">
						<select name="muc1" >
						<option value="" >Lọc phân loại</option>
						<?php
							$terms = get_terms([
								'taxonomy' => 'muc',
								'hide_empty' => false,
							]);
							foreach ($terms as $term){
								if ($term->parent > 0) {
									echo '<option value="'. $term->slug .'" >'. $term->name .'</option>';	
								} else {
									echo '<option style="font-weight:bold"  value="'. $term->slug .'" >'. $term->name .'</option>';	
								}
							}
						?> 					
						</select>
						<label for="stuff" class="fa-regular fa-signs-post input-land-icon"></label>
						</div>
						<?php } ?>
						
						<?php if (isset($land_options['loc2'])) { ?>
						<div class="fox-select input-wrapper">
						<select name="type2" >
						<option value="">Lọc vị trí</option>
						<option value="Mặt tiền">Mặt tiền</option>
						<option value="Hẻm">Hẻm</option>
						</select>
						<label for="stuff" class="fa-regular fa-street-view input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type3" >
						<option value="">Lọc hướng</option>
						<option value="Đông">Đông</option>
						<option value="Tây">Tây</option>
						<option value="Nam">Nam</option>
						<option value="Bắc">Bắc</option>
						<option value="Đông Bắc">Đông Bắc</option>
						<option value="Tây Bắc">Tây Bắc</option>
						<option value="Đông Nam">Đông Nam</option>
						<option value="Tây Nam">Tây Nam</option>
						</select>
						<label for="stuff" class="fa-regular fa-compass input-land-icon"></label>
						</div>
						
						<div class="fox-select input-wrapper">
						<select name="type4" >
						<option value="">Lọc pháp lý</option>
						<option value="Sổ đỏ">Sổ đỏ</option>
						<option value="Sổ hồng">Sổ hồng</option>
						<option value="Sổ chung">Sổ chung</option>
						<option value="Hợp đồng">Hợp đồng</option>
						<option value="Viết tay">Viết tay</option>
						</select>
						<label for="stuff" class="fa-regular fa-notes input-land-icon"></label>
						</div>
						<?php } ?>
						
						<?php if (isset($land_options['loc3'])) { ?>
						<div class="fox-select input-wrapper">
						<select name="size1" >
						<option value="" >Lọc diện tích</option>
						<option value="max" >Từ nhỏ tới lớn</option>
						<option value="min" >Từ lớn tới nhỏ</option>
						<option value="99" >Dưới 100 m2</option>   
						<option value="100" >Trên 100 m2</option>
						</select>
						<label for="stuff" class="fa-regular fa-up-right-from-square input-land-icon"></label>
						</div>
						<?php } ?>
						
						<?php if (isset($land_options['loc4'])) { ?>
						<div class="fox-select input-wrapper">
						<select name="price1" >
						<option value="" >Lọc giá</option>
						<option value="max" >Từ thấp tới cao</option>
						<option value="min" >Từ cao xuống thấp</option>
						<option value="999999999" >Dưới 1 tỷ</option>   
						<option value="1000000000" >Trên 1 tỷ</option>
						</select>
						<label for="stuff" class="fa-regular fa-coins input-land-icon"></label>
						</div>
						<?php } ?>
						
					
				</div>
			
<?php } else { echo fox_land_search_style(); } ?>
	
	</form>
	</div>

