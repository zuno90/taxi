jQuery(function($) { 
    $('.fox-loadmore').click(function(){
        var button = $(this),
            data = {
            'action': 'loadmore',
            'query': fox_loadmore_params.posts, 
            'page' : fox_loadmore_params.current_page
        };
        $.ajax({ 
            url : fox_loadmore_params.ajaxurl, 
            data : data,
            type : 'POST',
            beforeSend : function (xhr) {
				button.text('');
                button.html(loadbut); 
            },
            success : function( data ){
                if(data) { 
                    button.html(nuttaibut).prev().after(data); 
                    fox_loadmore_params.current_page++;
 
                    if ( fox_loadmore_params.current_page == fox_loadmore_params.max_page ) 
                        button.remove(); 
                } else {
                    button.remove(); 
                }
            }
        });
    });
});