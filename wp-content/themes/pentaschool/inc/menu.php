 <?php 
				$honapok = array();
				$honapok[1] = 'Jan.';
				$honapok[2] = 'Feb.';
				$honapok[3] = 'Már.';
				$honapok[4] = 'Ápr.';
				$honapok[5] = 'Máj.';
				$honapok[6] = 'Jún.';
				$honapok[7] = 'Júl.';
				$honapok[8] = 'Aug.';
				$honapok[9] = 'Szep.';
				$honapok[10] = 'Okt.';
				$honapok[11] = 'Nov.';
				$honapok[12] = 'Dec.';
				$honapok_teljes = array();
				$honapok_teljes[1] = 'Január';
				$honapok_teljes[2] = 'Február';
				$honapok_teljes[3] = 'Március';
				$honapok_teljes[4] = 'Április';
				$honapok_teljes[5] = 'Május';
				$honapok_teljes[6] = 'Június';
				$honapok_teljes[7] = 'Július';
				$honapok_teljes[8] = 'Augusztus';
				$honapok_teljes[9] = 'Szeptember';
				$honapok_teljes[10] = 'Október';
				$honapok_teljes[11] = 'November';
				$honapok_teljes[12] = 'December';
?>
<div id="main-menu" class="pnt-container clearfix">
    <div id="left-side">
        <div id="logo">
            <i class="material-icons menu">menu</i>
            <i class="material-icons up">arrow_upward</i>
        </div>
        <div class="filter">
            <i class="material-icons menu">filter_list</i>
        </div>

    </div>
    <div class="filter-box mobile">
        <div class="course-filter">
            <ul id="pentafilter-aktiv-mobile">
                <li>Válassz feltételt!</li>
                <li class="pentafilter" termName="tanf">Összes</li>
                <li class="pentafilter" termName="aktiv">Van időpontja</li>
            </ul>

            <ul id="pentafilter-box-mobile">
                <li>Válassz kategóriát!</li>
                <li class="pentafilter" termName="tanf">Összes</li>

                <?php
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order' => 'ASC'
                ));

                foreach ($categories as $category) { ?>
                    <li class="pentafilter" termName="<?php echo $category->slug; ?>"><?php echo $category->name; ?></li>
                <?php } ?>

            </ul>

        </div>
    </div>
	<div class="logo">
		<a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/pentaschool-logo.svg"/></a>
	</div>

    <nav id="menu" class="">
		<?php wp_nav_menu( array('theme_location' => 'primary_navigation', 'container' => 'ul',) ); ?>
        <i id="course-search" class="material-icons">search</i>
    </nav>

    <div id="pnt-megamenu">
		
			<div>
				<div class="priority-menu">
					<?php wp_nav_menu( array('theme_location' => 'primary_navigation', 'container' => 'ul') ); ?>
				</div>
				<div class="megamenu-promoted">
					<h1>Kiemelt tanfolyamaink:</h1>
					<div class="course-listing">
					<ul class="active-course">
					<?php 
					
					
					foreach (get_field('kiemelt_tanfolyamok',1180) as $t) { 
									$kapcs_tanf = get_field('kapcsolodo_tanf',$t)[0];
									$cat_name = get_the_category($kapcs_tanf)[0]->name;
									$cat_slug = get_the_category($kapcs_tanf)[0]->slug;
									$listaar = get_field('listaar',$kapcs_tanf);
									$date = get_field('kezdes',$t);
									$date = substr($date, 0, 4) . substr($date, 5, 2). substr($date, 8, 2);
									$akcios = get_field('akcios_ar', $t);
									$van_e_akcio = false;
									$max = get_field('maximum_letszam',$t);
									$min = get_field('minimum_letszam',$t);
									$beiratkozva = get_field('beiratkozva',$t);
									$is_full = ($max == $beiratkozva);
									$is_ceges = get_field('ceges_megrendeles',$kapcs_tanf);
									$biztosan_indul = ($beiratkozva>=$min);
									$szazalek = 0;
									if($akcios<$listaar){
										$van_e_akcio = true;
											$szazalek = round((1-($akcios / $listaar))*100);
									}
									$napszak = get_field('napszak', $t);
									$rovid_leiras = get_field('rovid_leiras',$kapcs_tanf);
					
						?>
					<li class="" title="<?php echo get_post($kapcs_tanf)->post_title; ?>" termName="tanf <?php foreach ((get_the_terms($kapcs_tanf, 'category')) as $term) { echo $term->slug . ' '; } ?> <?php echo get_field('napszak',$kiiras->ID); echo ($date)?' aktiv':' passziv'; ?>">
						<a href="<?php echo get_permalink($kapcs_tanf); ?>">
						<div class="list-view">
							<div class="date">
								<?php 
									if($date){
										echo $honapok[date('n',strtotime($date))] . ' '. date('j',strtotime($date));
									}else if($is_ceges){
										echo '<i class="material-icons">business</i>';
									}else{
										'naptar_athuzva';
									}
								?>
							</div>
							<div class="title">
								<span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span>
								<h2 ><?php echo get_post($kapcs_tanf)->post_title; ?></h2>
							</div>
							<?php if($date){ ?>
								<div>
									<div class="price">
									<?php if($van_e_akcio): ?>
										<div class="discount-label"><?php echo $szazalek; ?>%</div>
										<h4 class="discounted"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h4>
										<h3 class="final-price"><?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</h3>
									<?php else: ?>
										<h3><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h3>
									<?php endif; ?>
									</div>	
								</div>
								<!--<div class="spots">
									<h3><?php echo ($is_full)?'<i class="material-icons">info</i>Betelt!':$max - $beiratkozva . ' hely van még!';  ?></h3>
								</div>-->
							<?php }else if($is_ceges){ ?>
								<div>
									<h3 class="ceges"><i class="material-icons">business</i>Céges megrendelésre!</h3>
								</div>
							<?php } ?>
						</div>
						</a>
					</li>				

						
					<?php } ?>
					</ul>
					</div>
				</div>		
			</div>
			<div class="megamenu-bottom">
				<ul class="kismenu">
					<li>Vállalati képzések</li>
					<li>Egyéni képzés igénylése</li>
					<li class="english">Information in english</li>
				</ul>
				<p>&copy; Pentaschool Bt.<br>
					Cím: 1051 Budapest, Sas utca 25, VI. em.<br>
					Telefon: (1)-472-0679 Fax: (1)-472-0680<br>
				</p>
			</div>
        
    </div>

    <div id="course-search-panel" >
        <div class="close-search">
            <i id="course-search" class="material-icons">close</i>
        </div>
        <input type="text" id="course-search-input" placeholder="Mit szeretnél tanulni?">

    </div>
		<div class="course-search-result course-listing">
		<div class="pnt-container">
			<ul class="active-course">

				<h2 class="p-section-title">Keresési találatok:</h2>
				<?php
								$tanf_lista = '';
								$tanfok = get_posts(array(
											'post_type'=>'tanfolyamok',
											 'numberposts'=>-1
								));
                include( locate_template( 'tanf-simple-listing.php', false, false ) );
                    //include_once(get_stylesheet_directory_uri()."/sections/tanf-simple-listing.php");
                ?>
			</ul>
		</div>
		</div>
</div>
