<?php $tematika = get_field('tematika','option');
if($tematika): ?>    
	<section id="tematika" class="faq">
        <div>
            <div class="tematika-header">
                <h2>Gyakran ismételt kérdések</h2>
                <span class="unfold">
                    <span>Összeset becsuk</span>
                    <i class="material-icons">unfold_less</i>
                </span>
            </div>

            <ul class="tematika-lista">
                <?php
                foreach($tematika as $t): ?>
                    <li class="opened">
                    <span>
                        <i class="material-icons">remove</i>
                        <h2><?php echo $t['cim']; ?></h2>
                    </span>
                        <div>
                            <?php echo $t['leiras']; ?>
                        </div>
                    </li>
                <?php  endforeach;?>

            </ul>
        </div>
    </section>
    <script>
        jQuery(document).ready(function(){
            function setTematikaIcons(){
                jQuery('#tematika.faq .tematika-lista li.closed i').text('add')
                jQuery('#tematika.faq .tematika-lista li.opened i').text('remove')
            }
            jQuery('#tematika.faq .tematika-lista li i').click(function(){
                if(jQuery(this).text() == 'add'){
                    jQuery(this).parent().parent().removeClass('closed').addClass('opened')
                }else{
                    jQuery(this).parent().parent().removeClass('opened').addClass('closed')
                }
                setTematikaIcons()
            })
            jQuery('.unfold i').click(function(){
                if(jQuery(this).text() == 'unfold_less'){
                    jQuery(this).text('unfold_more')
                    jQuery(this).parent().find('span').text("Összeset kinyit")
                    jQuery('#tematika.faq .tematika-lista li').removeClass("opened").addClass('closed')
                }else{
                    jQuery(this).text('unfold_less')
                    jQuery(this).parent().find('span').text("Összeset becsuk")
                    jQuery('#tematika.faq .tematika-lista li').removeClass("closed").addClass('opened')
                }
                setTematikaIcons()
            })
            jQuery('.unfold i').click();
        })

    </script>
<?php endif; ?>