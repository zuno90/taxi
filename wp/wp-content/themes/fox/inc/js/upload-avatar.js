jQuery( document ).ready( function() {
    /* caodems.com Media Uploader */
    var _caodems_media = true;
    var _caodems_send_attachment = wp.media.editor.send.attachment;
    jQuery( '.caodems-image' ).click( function() {
        var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;
        wp.media.editor.send.attachment = function( props, attachment ) {
            if ( _shr_media && ( attachment.type === 'image' ) ) {
                if ( image_id.indexOf( "," ) !== -1 ) {
                    image_id = image_id.split( "," );
                    $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids )
                            $image_ids = $image_ids + ',#' + value;
                        else
                            $image_ids = '#' + value;
                    } );
                    var current_element = jQuery( $image_ids );
                } else {
                    var current_element = jQuery( '#' + image_id );
                }
                jQuery( '#' + textbox_id ).val( attachment.id );
                    console.log(textbox_id)
                current_element.attr( 'src', attachment.url ).show();
            } else {
                alert( 'Vui lòng chọn một tập tin hình ảnh hợp lệ' );
                return false;
            }
        }
        wp.media.editor.open( button );
        return false;
    } );
} );


/* xoa avatar */
jQuery(document).ready(function() {				
jQuery('#reset-hinh-anh').click(function() {
    jQuery('#caodems_image_id').attr('value', ''); 
	jQuery('#caodems-img').attr('src','#'); 
	jQuery("#caodems-img").css('display', 'none');
	jQuery("#reset-hinh-anh").css('display', 'none');
});
jQuery('#caodems-image').on('click', function(e) {
	jQuery('#caodems-img').attr('src','');
	jQuery("#caodems-img").css('display', 'inline-block');
	jQuery("#reset-hinh-anh").css('display', 'block');
});												
});