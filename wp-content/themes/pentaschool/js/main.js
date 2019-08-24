function findGetParameter(parameterName) {
	var result = null,
	tmp = [];
	var items = location.search.substr(1).split("&");
	for (var index = 0; index < items.length; index++) {
		tmp = items[index].split("=");
		if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
	}
	return result;
}
jQuery(document).ready(function(){

    jQuery('li.widget').click(function () {
        jQuery(this).addClass('selected');
        jQuery('.widgets-menu').addClass('opened');
    });

    jQuery('.page-selector').click(function () {
        jQuery('.options').addClass('opened');
    });

    jQuery('#left-side #logo').click(function () {
        jQuery('#pnt-megamenu').toggleClass('opened');
        jQuery('#left-side').toggleClass('bottom');
    });


	
    jQuery('#course-search-panel i').click(function () {
        jQuery('#course-search-panel').removeClass('opened');
		jQuery(".course-search-result").hide().removeClass('opened')
		jQuery('body').css('overflow-y','scroll')
		jQuery('#main-search').val('')
    });


	jQuery(document).mouseup(function(e) 
	{
    var container = jQuery('#main-search');
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			jQuery('.search-result').removeClass('opened');
		}
	});
	jQuery('#main-search').keyup(function(){
			
		var searchtext = jQuery(this).val().toLowerCase();
		if(searchtext.length>1){
			
			var list = jQuery('.search-result').addClass('opened').find('ul li').hide()
			jQuery.each(list, function(index,item){
				var li = item;
				var title = jQuery(item).attr('title').toLowerCase();
				if(title.indexOf(searchtext) > -1){
					jQuery(li).show()
				}
			})
			
		}else{
			jQuery('.search-result').removeClass('opened')
		}
	})
	
	jQuery('#course-search').click(function () {
        jQuery('#course-search-panel').addClass('opened');
    });
	
	
	jQuery('#course-search-input').keyup(function(){
		var searchtext = jQuery(this).val().toLowerCase();
		jQuery('#main-menu .course-search-result').show()
		if(searchtext.length>1){
			jQuery('body').css('overflow-y','hidden')
			jQuery('#main-menu .course-search-result').addClass('opened').find('ul li').hide()
			var list = jQuery('#main-menu .active-course li');
			jQuery.each(list, function(index,item){
				var li = item;
				var title = jQuery(item).attr('title').toLowerCase();
				
				if(title.indexOf(searchtext) > -1){
					jQuery(li).show()
				}
			})
			
		}else{
			jQuery('#main-menu .course-search-result').removeClass('opened')
			jQuery('body').css('overflow-y','scroll')
		}
	})
	jQuery.each(jQuery('.penta-form input'),function(index,item){
		if(jQuery(this).val() != ''){
			jQuery(this).parent().parent().addClass('contains')
		}
	})
	jQuery('.penta-form input').keyup(function(){
		if(jQuery(this).val() != ''){
			jQuery(this).parent().parent().addClass('contains')
		}else{
			jQuery(this).parent().parent().removeClass('contains')
		}
	})

	
	if(jQuery('body').hasClass('home')){
		jQuery('#home-courses .active-course li').pentafilter('pentafilter-box',{other_pentafilter_class:'#pentafilter-napszak'},function(){});
		jQuery('#home-courses .active-course li').pentafilter('pentafilter-napszak',{other_pentafilter_class:'#pentafilter-box'},function(){});
	}	
	if(jQuery('body').hasClass('post-type-archive-tanfolyamok')){

		jQuery('.active-course li').pentafilter('pentafilter-box',{other_pentafilter_class:'#pentafilter-aktiv'},function(){});
		jQuery('.active-course li').pentafilter('pentafilter-aktiv',{other_pentafilter_class:'#pentafilter-box'},function(){});

		jQuery('.active-course li').pentafilter('pentafilter-box-mobile',{other_pentafilter_class:'#pentafilter-aktiv-mobile'},function(){});
		jQuery('.active-course li').pentafilter('pentafilter-aktiv-mobile',{other_pentafilter_class:'#pentafilter-box-mobile'},function(){});
		
		if(findGetParameter('termname') != null){
			$('#pentafilter-box .pentafilter[termname*="'+ findGetParameter('termname') +'"]').click()
		}		
	}
	
	function closeAllCourses(){
		jQuery("#home-courses .active-course li.expand").removeClass('expanded');
		if(jQuery(document).width()>880){
			jQuery("#home-courses .active-course li").removeClass('expanded').find('.quick-view').css('height',0).find('div.date, div.content').css('height',0)
		}

	}
	function openCourse(object){
		jQuery("#home-courses .active-course li.expand").removeClass('expanded');
		jQuery(object).addClass('expanded');
		if (jQuery(document).width() > 880) {
			jQuery(object).find('.quick-view').css('height', jQuery(object).attr('h')).find('div.date, div.content').css('height', jQuery(object).attr('h'))
		}
	}
	
	//beállítom minden tanfolyamnak, hogy mekkorára nyíljon ki majd ha kinyílna.
	if(jQuery(document).width()>880){
		jQuery("#home-courses .active-course li.expand").find('.quick-view').css('height','auto').find('div').css('height','auto')
		jQuery.each(jQuery("#home-courses .active-course li"), function(index,item){
			jQuery(item).attr('h',jQuery(item).find('.quick-view').height())
		})
	}

	
	closeAllCourses();
	
	
		jQuery("#home-courses .active-course li.expand").click(function(){
			if(jQuery(document).width()>880){
				closeAllCourses()
				openCourse(this)
			}	
		})
	
		jQuery("#home-courses .active-course li.expand .quick-view .closer").click(function(){
			closeAllCourses();
		})
		jQuery("#home-courses .active-course li.expand .list-view .opener").click(function(){
			closeAllCourses();
			openCourse(jQuery(this).parent().parent());
		})
		

	// mobile tanfolyam filtering sidebar

	jQuery("#left-side .filter").click(function () {
		var $box = jQuery('.filter-box');
		if(!$box.hasClass('opened')){
			jQuery('.filter-box').addClass("opened")
		}else{
			jQuery('.filter-box').removeClass("opened")
		}
	});
		jQuery(".filter-box .pentafilter").click(function () {
			jQuery('.filter-box').removeClass("opened")
		})
});
