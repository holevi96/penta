<div id="footer">
</div>

<div id='footer_bottom'>
	<div class="pnt-container">
		<ul>
			<?php
				$oszlopok = get_field('oszlopok','option');
				if($oszlopok):
				foreach($oszlopok as $oszlop){ 
					$cim = $oszlop['cim'];
					$leiras = $oszlop['leiras'];
					$menu_elemek = $oszlop['menu_elemek']; ?>
					<li>
						<h3><?php echo $cim; ?></h3>
						<?php echo $leiras; ?>
						<ul class="clearfix">
							<?php foreach($menu_elemek as $elem){
								
								$c = $elem['oldal'][0]->post_title;
								$link = get_permalink($elem['oldal'][0]->ID);
							?>
							<li><a href='<?php echo $link; ?>'><?php echo $c; ?></a></li>
							<?php } ?>
						</ul>
					</li>

				<?php } endif; ?>
								<li>
						<h3>Excel Bázis fórum leutóbbi bejegyzései:</h3>
						<?php echo file_get_contents(get_site_url().'/excel-bazis.txt'); ?>
					</li>
		</ul>
		<div class="social">
			
		</div>
		<div class="links">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pentaschool-logo.svg"/>
			<ul class="clearfix">
				<li><a href="#">Adatvédelmi nyilatkozat</a></li>
				<li class="english"><a href="#">Information in English</a></li>
			</ul>
		</div>
	</div>
</div>
<?php wp_footer(); ?> 
</body>
</html>