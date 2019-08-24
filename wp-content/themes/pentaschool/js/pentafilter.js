 (function( $ ) {
 
    $.fn.pentafilter = function(filterwrapper, options,callback) {
		
		 var settings = $.extend({
            // These are the defaults.
            time: 300,
			other_pentafilter_class : ''
        }, options );



		var container = this;
		var other_pentafilter_class = settings.other_pentafilter_class
		var effect = $('#'+filterwrapper).attr('effect-type');	
		$('#'+filterwrapper + " .pentafilter").eq(0).addClass('active');

		
		
		
		$('#'+filterwrapper + " .pentafilter").click(function(e){
                e.preventDefault();
                if(!$(this).hasClass('active')){
				$(container).attr('visible','none');
				
                var selectedTerm = $(this).attr('termName');
				var other_term = ''
				if(other_pentafilter_class!= ''){
					console.log(other_pentafilter_class);

						other_term = $(other_pentafilter_class).find('li.active').attr('termname');
						// if(other_term !== selectedTerm){
							$(container.selector + '[termname*=' + selectedTerm + ']'+'[termname*=' + other_term + ']').attr('visible','visible');
						// }else{
						// 	$(container.selector + '[termname*=' + selectedTerm + ']').attr('visible','visible');
						// }




				}else{
					$(container.selector + '[termname*=' + selectedTerm + ']').attr('visible','visible');
				}
                

                
                
               

                if(jQuery(container.selector + '[visible="visible"]').length == 0){
					
                    jQuery(container.selector + '.notfound').attr('visible','visible').find('a').attr('href','/tanfolyamok?termname='+selectedTerm);
                }
                if(effect = 'fade'){
                    jQuery(container.selector ).velocity("fadeOut", { duration: 300,complete: function(){
						if (typeof callback == 'function') { // make sure the callback is a function
							callback.call(this); // brings the scope to the callback
						}
					}  })
                    jQuery(container.selector + '[visible*="visible"]').velocity("fadeIn", { delay: 100, duration: 300});
                }
            }
            $('#'+filterwrapper + " .pentafilter").removeClass('active');
            $(this).toggleClass('active');
			
			
		})
		
		
 
       
 
    };
 
}( jQuery ));
 