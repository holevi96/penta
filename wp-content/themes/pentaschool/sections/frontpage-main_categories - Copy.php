<!-- MAIN CATEGORIES -->
        <h2 class="p-section-title">Fő kategóriák</h2>
        <ul id="main-categories">
		<?php 
				$kiirasok = get_posts(array(
					'post_type' => 'tanfolyam-kiiras',
					'post_status' => 'publish',
					'numberposts' => -1,
					'meta_key' => 'kezdes',
					'orderby' => 'meta_value',
					'order'	=> 'DESC'
				));
				$notfound_szoveg = 'Ebben a kategóriában nincs most aktuális tanfolyam.';
				$kategoriak = array(
					'adatbazis' => array(
						'cat_name' => 'Adatbázis',
						'cat_slug' => 'adatbazis',
						'title' => $notfound_szoveg
					),
					'rendszergazda' => array(
						'cat_name' => 'Rendszergazda',
						'cat_slug' => 'rendszergazda',
						'title' => $notfound_szoveg
					),
					'programozas' => array(
						'cat_name' => 'Programozás',
						'cat_slug' => 'programozas',
						'title' => $notfound_szoveg
					),
					'web' => array(
						'cat_name' => 'Web',
						'cat_slug' => 'web',
						'title' => $notfound_szoveg
					),
					'iroda' => array(
						'cat_name' => 'Iroda',
						'cat_slug' => 'iroda',
						'title' => $notfound_szoveg
					)
				);
				foreach($kiirasok as $kiiras){
					$kapcs_tanf = get_field('kapcsolodo_tanf',$kiiras->ID)[0];
					$cat_slug = get_the_category($kapcs_tanf)[0]->slug;
					$cat_name = get_the_category($kapcs_tanf)[0]->name;
					
					$kategoriak[$cat_slug] = array(
						'cat_name' => $cat_name,
						'cat_slug' => $cat_slug,
						'title' => get_post($kapcs_tanf)->post_title,
						'permalink' => get_permalink($kapcs_tanf),
						'jelentkezes_permalink' => get_permalink($kapcs_tanf). '?jelentkezes&ID='.$kiiras->ID,
						'kezdes' => get_field('kezdes',$kiiras->ID)
					);
				}
			
				foreach($kategoriak as $kategoria){ ?>
					<li>
						<span class="category-tag <?php echo $kategoria['cat_slug']; ?>"><?php echo $kategoria['cat_name']; ?></span>
						<h2><?php echo $kategoria['title']; ?></h2>
						<h3><?php echo $kategoria['kezdes']; ?></h3>
						<?php if($kategoria['title'] != $notfound_szoveg): ?>
						<div>
							<a class="b-button" href="<?php echo $kategoria['permalink']; ?>">Részletek</a>
							<a href="<?php echo $kategoria['jelentkezes_permalink']; ?>">Jelentkezem</a>
						</div>
						<?php endif; ?>
					</li>
				<?php }
			?>
        </ul>