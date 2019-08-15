<!-- MAIN CATEGORIES -->
        <h2 class="p-section-title main-categories-title">Fő kategóriák</h2>

        <ul id="main-categories">

		<?php 
				$kategoriak = get_field("kategoriak_hozzaadasa","option");
				
				$notfound_szoveg = "Ebben a kategóriában nincs most aktuális tanfolyam.";
				foreach($kategoriak as $kategoria){
					
					$ID = $kategoria['tanfolyam_kiiras'][0]->ID;
					$kezdes = get_field('kezdes',$kategoria['tanfolyam_kiiras'][0]->ID);		
					$kapcs_tanf = get_post(get_field('kapcsolodo_tanf',$kategoria['tanfolyam_kiiras'][0]->ID)[0]);
					$title = (is_array($kategoria['tanfolyam_kiiras']))?$kapcs_tanf->post_title:$notfound_szoveg;
					$cat_slug = $kategoria['kategoria'][0]->slug;
					$cat_name = $kategoria['kategoria'][0]->name;
				?>
					<li>
						<a href="/tanfolyamok?termname=<?php echo $cat_slug; ?>"><span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span></a>
						<h2><?php echo $title; ?></h2>
						<h3><?php echo $kezdes; ?></h3>
						<?php if($title != $notfound_szoveg): ?>
						<div>
							<a class="p-button white ghost medium" href="<?php echo get_permalink($kapcs_tanf); ?>">Részletek</a>
							<a class="p-button invisible medium"  href="<?php echo get_permalink($kapcs_tanf) ?>?jelentkezes&ID=<?php echo $kategoria['tanfolyam_kiiras'][0]->ID ?>">Jelentkezem</a>
						</div>
						<?php endif; ?>
					</li>
				<?php }
			?>
        </ul>