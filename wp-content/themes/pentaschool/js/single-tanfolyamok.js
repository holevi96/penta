jQuery(document).ready(function(){
	jQuery('.main-carousel').flickity({
		  // options
		  cellAlign: 'center',
		  selectedAttraction: 0.2,
		  friction: 0.8,
		  groupCells: 1,
		  initialIndex: 2,
		 
	});
	jQuery(".popup").click(function(){
		var youtube_link = jQuery(this).attr('data-link');
		$url = "https://www.youtube.com/embed/" + youtube_link.slice(-11);
		if(jQuery('body').width()>800){
			jQuery('#video-view').find("iframe").attr('src',$url).css('visibility','visible');
			jQuery('#video-view').css('opacity',1).css('visibility','visible');
		}else{
			window.open(
				  youtube_link,
				  '_blank' // <- This is what makes it open in a new window.
			);
		}

	})
	jQuery('#video-view i').click(function(){
		jQuery('#video-view').css('opacity',0).css('visibility','hidden').find('iframe').css('visibility','hidden');
	})


	jQuery('.bottom ul li').eq(jQuery('.top')).click()

	jQuery('#neked-ajanljuk>ul li').click(function(){
		var idx = jQuery(this).index()
		jQuery('#neked-ajanljuk>ul li').removeClass('selected')
		jQuery(this).addClass('selected')
		jQuery('#neked-ajanljuk>div ul').hide().eq(idx).show()
	})
	    jQuery('.more-details-button').click(function () {
			jQuery('.tanfolyam-full-details').addClass('opened-hidden');
			if(jQuery('body').width()<800){
				var elmnt = document.getElementById("tanfolyam-main");
				elmnt.scrollIntoView();
			}
			setTimeout(function(){
				jQuery(".tanfolyam-full-details").removeClass("opened-hidden");
				jQuery(".tanfolyam-full-details").addClass("opened");
				jQuery('body').addClass('expanded')
			}, 100);
		});
	
	jQuery('.tanfolyam-full-details i.close, .tanfolyam-full-details .close_fullscreen').click(function(){
		jQuery('.tanfolyam-full-details').removeClass('opened')
		jQuery('body').removeClass('expanded')
	})
	jQuery(document).click(function(e){
		if(jQuery('body').hasClass('expanded')){
			
			if( jQuery(e.target).closest(".tanfolyam-full-details").length <= 0 ) {
				jQuery('.tanfolyam-full-details').removeClass('opened')
				jQuery('body').removeClass('expanded')	
			}

			
		}
	})
	$(document).keyup(function(e) {
		if (e.key === "Escape") { // escape key maps to keycode `27`
			if(jQuery('body').hasClass('expanded')){
				jQuery('.tanfolyam-full-details').removeClass('opened')
				jQuery('body').removeClass('expanded')				
			}
		}
	});

	jQuery(document).ready(function(){
		function setTematikaIcons(container){
			jQuery(container).find('li.closed i').text('add')
			jQuery(container).find('li.opened i').text('remove')
		}
		jQuery('.tematika-lista li i').click(function(){
			var container = jQuery(this).parent().parent().parent();
			if(jQuery(this).text() == 'add'){
				jQuery(this).parent().parent().removeClass('closed').addClass('opened')
			}else{
				jQuery(this).parent().parent().removeClass('opened').addClass('closed')
			}
			setTematikaIcons(container)
		});
		jQuery('.unfold i').click(function(){
			var container = jQuery(this).parent().parent().parent().find(".tematika-lista");

			if(jQuery(this).text() == 'unfold_less'){
				jQuery(this).text('unfold_more')
				jQuery(this).parent().find('span').text("Összeset kinyit")
				jQuery(container).find('li').removeClass("opened").addClass('closed')
			}else{
				jQuery(this).text('unfold_less')
				jQuery(this).parent().find('span').text("Összeset becsuk")
				jQuery(container).find('li').removeClass("closed").addClass('opened')
			}
			setTematikaIcons(container)
		})
	})
	
	jQuery('.idopontok-desktop>ul>li, .idopontok-mobile>ul>li').click(function(){
		jQuery(this).parent().find('li').removeClass('selected')
		jQuery(this).addClass('selected')
		var idx = jQuery(this).index()
		jQuery('#course-idopontok .top').removeClass('active').eq(idx).addClass('active');
		jQuery('#course-idopontok .top.active .idopontok-desktop>ul>li').removeClass('selected').eq(idx).addClass('selected')
		jQuery('#course-idopontok .top.active .idopontok-mobile>ul>li').removeClass('selected').eq(idx).addClass('selected')
	})
	jQuery('.idopontok-mobile>ul>li').eq(jQuery('#course-idopontok .top.active').index()).addClass('selected')
	
	jQuery("#sign-up-form .close").click(function(){
		jQuery('.modal').remove()
		jQuery('body').css('overflow','scroll')
	})
	
		var top_height = 0;
	if(jQuery('body').width() > 800 ){
		jQuery('#course-idopontok .top').each(function(index, item){
			if(jQuery(item).height()>top_height){
				top_height = jQuery(item).height()
			}
		})
		jQuery('#course-idopontok').css("height",top_height).find('.image-wrapper').css("height",top_height)
	}else{
			jQuery('#course-idopontok').css('height',jQuery('.top').height())
			jQuery('.unfold i').click();
	}
	
	jQuery("#field_1_43>label").html('Efogadom az <a href="#" name="terms" target="_blank">adatvédelmi nyilatkozatot.</a>');
	jQuery("#field_1_60>label").html('Elfogadom az <a href="#" name="terms" target="_blank">adatkezelési szabályzatot.</a>');
})