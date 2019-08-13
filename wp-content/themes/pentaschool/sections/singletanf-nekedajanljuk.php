	<?php if(get_field('neked_ajanljuk')): ?>
    <section id="neked-ajanljuk">
        <ul class="pnt-container">
            <li class="selected">Neked ajánljuk</li>
            <li>Nem neked ajánljuk</li>
        </ul>
        <div class="pnt-container pro-contra-wrapper">
            <ul class="pro-contra pro">
			<?php $pro = get_field('neked_ajanljuk'); 
				foreach($pro as $p): ?>
				<li>
                    <i class="material-icons">done</i>
                    <span><?php echo $p['szoveg']; ?></span>
                </li>
			<?php endforeach; ?>

            </ul>
            <ul class="pro-contra contra">
			<?php $pro = get_field('nem_neked_ajanljuk'); 
				foreach($pro as $p): ?>
				<li>
                    <i class="material-icons">close</i>
                    <span><?php echo $p['szoveg']; ?></span>
                </li>
			<?php endforeach; ?>
                
            </ul>
        </div>

    </section>
<?php endif; ?>