        <div class="search-wrapper">
		 <i class="material-icons">search</i>
            <input id="main-search"  type="text" placeholder="Mit szeretnél tanulni?">		
			<div class="search-result">
                <ul>
					<?php
							$tanf_lista = '';
							$tanfok = get_posts(array(
										'post_type'=>'tanfolyamok',
										 'numberposts'=>-1
							));
							foreach ($tanfok as $t) { 
								$cat_slug = get_the_category($t->ID)[0]->slug;
								$cat_name = get_the_category($t->ID)[0]->name;
								$kiirasok = get_posts(array(
									'post_type' => 'tanfolyam-kiiras',
									'meta_query' => array(
										 array(
											'key' => 'kapcsolodo_tanf', // name of custom field
											'value' => '"' . $t->ID . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
											'compare' => 'LIKE'
										)
									)

								));
								$kezdes = get_field('kezdes',$kiirasok[0]->ID);
					?>
							<li title="<?php echo $t->post_title; ?>">
								
								<a href="<?php echo get_permalink($t->ID); ?>">
									<h2><?php echo $t->post_title; ?></h2>
									<!--<span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span>-->
									<h3><?php if($kezdes){ 
										echo $kezdes;
									}else if(!$kezdes){
										echo 'Részletek...';
									}else if(get_field('ceges_megrendeles',$t->ID) == true){
										echo 'Csak céges megrendelésre!';
									}?>
									</h3>
								</a>
							</li>
							<?php } ?>				
                   
                </ul>
            </div>
			<script>
			</script>
        </div>