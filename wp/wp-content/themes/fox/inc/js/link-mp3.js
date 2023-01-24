jQuery(function($) { 
var max_fields      = 10; // so luong input
var wrapper         = $(".banglink1"); 
var add_button      = $(".themlink1"); 
var x = 1; 
$(add_button).click(function(e){ 
    e.preventDefault();
    if(x < max_fields){ 
        x++; 
        $(wrapper).append('<div style="display:flex;margin-top:10px"><input id="post-input" placeholder="Nhập link file MP3 vào" type="text" name="story_audio2[]"/><input id="post-input" placeholder="Nhập tên truyện" type="text" name="story_audio21[]"/><a href="#" class="remove_field post-download-del">X</a></div>'); //add input box
    }
});
$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); 
    $(this).parent('div').remove(); x--;
})
});