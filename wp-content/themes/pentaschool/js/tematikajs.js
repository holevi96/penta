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
        var container = jQuery(this).parent().parent().parent().parent().find(".tematika-lista");

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