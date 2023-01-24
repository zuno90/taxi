jQuery(function($){
	var canBeLoaded = true, 
	    bottomOffset = 2000; 
 
	$(window).scroll(function(){
		var data = {
			'action': 'loadmore',
			'query': fox_loadmore_params.posts,
			'page' : fox_loadmore_params.current_page
		};
		if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true ){
			$.ajax({
				url : fox_loadmore_params.ajaxurl,
				data:data,
				type:'POST',
				beforeSend: function( xhr ){
					canBeLoaded = false; 
				},
				success:function(data){
					if( data ) {
						$('#main').find('article:last-of-type').after( data ); 
						canBeLoaded = true; 
						fox_loadmore_params.current_page++;
					}
				}
			});
		}
	});
});