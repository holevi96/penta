<?php $tematika = get_field('tematika');
if($tematika): ?>    
	<section id="tematika">
        <div class="pnt-container">

            <div class="tematika-header">
                <h2>Tematika</h2>
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
<?php endif; ?>