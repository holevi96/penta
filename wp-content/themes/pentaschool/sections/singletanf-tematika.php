<?php $tematika = get_field('tematika');
if($tematika): ?>    
	<section id="tematika">
        <iframe name="pdfjs-frame" id="print-iframe" frameborder="0"></iframe>
        <div class="pnt-container">
            <h1 class="print-title"><?php the_title(); ?></h1>
            <div class="tematika-header">

                <h2>Tematika</h2>


                <span>
                    <i class="material-icons desktop" id="printTematika">print</i>
                    <span class="unfold">
                        <span>Összeset becsuk</span>
                        <i class="material-icons">unfold_less</i>
                    </span>
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