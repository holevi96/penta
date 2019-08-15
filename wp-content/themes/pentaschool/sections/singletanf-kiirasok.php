							
   <?php
  
   echo $is_ceges;
  $kiirasok = get_posts(array(
      'post_type' => 'tanfolyam-kiiras',
      'meta_query' => array(
          array(
              'key' => 'kapcsolodo_tanf', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
          )
      ),
      'meta_key'			=> 'kezdes',
      'orderby'			=> 'meta_value',
      'order'				=> 'ASC'

  ));
   if($kiirasok): 
   $i = 0;
   ?>
   <?php foreach ($kiirasok as $kiiras) : ?>
   						<?php 
						$max = get_field('maximum_letszam',$kiiras->ID);
						$min = get_field('minimum_letszam',$kiiras->ID);
						$beiratkozva = get_field('beiratkozva',$kiiras->ID);
						$is_full = ($max <= $beiratkozva);
						$biztosan_indul = ($beiratkozva>=$min);
						$heti_beosztas = get_field('napi_beosztas',$kiiras->ID);
						$idobeosztas = get_field('idobeosztas',$kiiras->ID);
						$alkalmak_megadasa = get_field('alkalmak_megadasa',$kiiras->ID);
						
						if($alkalmak_megadasa == 'kezdet-veg'){
							$kezdet_veg = true;
						}else{
							$kezdet_veg = false;
						}
						?>
            <div class="top <?php if(isset($_GET['ID']) && $_GET['ID'] == $kiiras->ID){echo 'active';}else if(count($kiirasok)==1){echo 'active';} ?>">
            <div class="bottom">
                <div id="idopontok" class="idopontok-mobile">
                    <ul>
					<?php 
					$k = 0;
					foreach ($kiirasok as $kiiras) : 

					?>
                        <li class="<?php echo ($i==$k)?'selected':''; ?>">
							<?php echo get_field('kezdes', $kiiras->ID); ?>
								<?php if(get_field('alkalmak_megadasa',$kiiras->ID) != 'kezdet-veg'){ ?>
									<h4>Időpontok:</h4>
									<ul>
										<?php foreach(get_field('tovabbi_napok',$kiiras->ID) as $nap): ?>
											<li><?php echo $nap['tovabbi_nap']; ?></li>
										<?php endforeach; ?>
										<li><?php echo get_field('vege',$kiiras->ID); ?></li>
									</ul>
								<?php }else if(get_field('kezdes',$kiiras->ID) != get_field('vege',$kiiras->ID)){ ?>
									<h4>Vége:</h4>
									<ul>
										<li><?php echo get_field('vege',$kiiras->ID); ?></li>
									</ul>
								<?php } ?>
						</li>
					<?php $k++; endforeach; ?>
                    </ul>
                   <!-- <button class="jelentkezes"><a href="?<?php echo ($is_full==false)?'jelentkezes':'varolista'; ?>&ID=<?php echo $kiiras->ID; ?>"><?php echo ($is_full==false)?'Jelentkezek':'Várólistára jelentkezek'; ?></a></button>
                    <button class="ceges-ajanlat"><a href="<?php echo get_permalink(); ?>?varolista&ID=<?php echo $kiiras->ID; ?>">Céges ajánlatot kérek</a></button>-->
                </div>
            </div>
                <div class="tanfolyam-full-details wyswyg-content">
                    <div class="header">

                        <div class="alkalmak desktop clearfix">
                            <div>
                                <h3>Óraszám:</h3>
                                <h2><?php echo get_field('oraszam', $kapcs_tanf); ?></h2>
                            </div>
                            <?php if ($kezdet_veg == true) { ?>
                                <div>
                                    <h3>Heti beosztás:</h3>
                                    <h2><?php echo $heti_beosztas; ?></h2>
                                </div>
                                <div>
                                    <h3>Napi beosztás:</h3>
                                    <h2><?php echo $idobeosztas; ?></h2>
                                </div>
                            <?php } else { ?>
                                <div>
                                    <h3>Napi beosztás:</h3>
                                    <h2><?php echo $idobeosztas; ?></h2>
                                </div>
                            <?php } ?>
                            <div>
                                <h3>Oktató:</h3>
                                <h2><?php echo get_post(get_field('tanar', $kiiras->ID)[0])->post_title; ?></h2>
                            </div>
                            <div class="">
                                <h3>Helyszín:</h3>
                                <h2>
                                    <a href="<?php echo get_permalink(get_post(get_field('helyszin', $kiiras->ID)[0])->ID); ?>"><?php echo get_post(get_field('helyszin', $kiiras->ID)[0])->post_title; ?></a>
                                </h2>
                            </div>

                        </div>


                        <div style="display:flex">
                            <div class="icons">
                                <div>
                                    <i class="material-icons">person</i>
                                    <span class="betelt"><?php echo ($is_full) ? 'Betelt!' : 'Még ' . ($max - $beiratkozva) . ' hely'; ?></span>
                                </div>
                                <div>
                                    <?php $napszak = get_field('napszak', $kiiras->ID);
                                    if ($napszak == 'esti') {
                                        ?>
                                        <i class="material-icons">brightness_3</i>
                                        <span>Esti</span>
                                    <?php } else { ?>
                                        <i class="material-icons">brightness_7</i>
                                        <span>Nappali</span>
                                    <?php }
                                    ?>

                                </div>
                            </div>
                            <i class="material-icons close">close</i>
                        </div>


                    </div>
                    <?php setup_postdata(get_post(get_the_ID()));
							the_content();
							wp_reset_postdata();
					?>
					<button class="close_fullscreen">
					Bezárás
					</button>
                </div>

                <div class="image-wrapper">
				<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $kapcs_tanf ), 'full' )[0]; ?>
                    <img src="<?php echo (!$url)?get_stylesheet_directory_uri().'/img/tanfolyam-1.png':$url; ?>" alt="">
					<?php
						if(get_field('demovideo')){ ?>
							<a class="popup" href="#tanfolyamok-single" data-link="<?php echo get_field('demovideo'); ?>" >
								<i class="material-icons close">play_arrow</i>
							</a>

						<?php } ?>
                </div>

                <div id="tanfolyam-details">
					<div class="alkalmak clearfix">
							<div>
								<h3>Óraszám:</h3>
								<h2><?php echo get_field('oraszam',$kapcs_tanf); ?></h2>
							</div>
							<?php if($kezdet_veg == true){ ?>
								<div>
									<h3>Heti beosztás:</h3>
									<h2><?php echo $heti_beosztas; ?></h2>								
								</div>
								<div>
									<h3>Napi beosztás:</h3>
									<h2><?php echo $idobeosztas; ?></h2>								
								</div>
							<?php }else{ ?>
								<div>
									<h3>Napi beosztás:</h3>
									<h2><?php echo $idobeosztas; ?></h2>								
								</div>								
							<?php } ?>
							<div>
								<h3>Oktató:</h3>
								<h2><?php echo get_post(get_field('tanar',$kiiras->ID)[0])->post_title; ?></h2>
							</div>
							<div class="">
								<h3>Helyszín:</h3>
                                <h2><a href="<?php echo get_permalink(get_post(get_field('helyszin',$kiiras->ID)[0])->ID); ?>"><?php echo get_post(get_field('helyszin',$kiiras->ID)[0])->post_title; ?></a></h2>
							</div>
					
					</div>
                    <div class="main-infos">
						<div class="icons">
	
                            <div class="desktop">
							<?php $napszak = get_field('napszak', $kiiras->ID);
                            if($napszak=='esti'){?>
                                <i class="material-icons">brightness_3</i>
                                <span>Esti</span>
                            <?php }else{ ?>
                                <i class="material-icons">brightness_7</i>
                                <span>Nappali</span>
                            <?php }
                            ?>
                                
                            </div>
							<?php if($biztosan_indul):?>
								<div>
										<i class="material-icons">done</i>
										<span>Biztosan indul!</span>	
								</div>
							<?php else: ?>
								<div>
										<i class="material-icons">access_time</i>
										<span class="betelt">Még <b><?php echo $min-$beiratkozva; ?></b> fő kell az induláshoz!</span>	
								</div>							
							<?php endif; ?>
								<div>
									<i class="material-icons">person</i>
									<span class="<?php echo ($is_full)?'betelt':''; ?>"><?php echo ($is_full)?'Betelt!': 'Szabad helyek: <b>'. ($max - $beiratkozva) . '</b> fő';  ?></span>
								</div>
							
							
                        </div>
	
                    </div>

                    <p class="description">
							<?php 
							$rovid_leiras = get_field('rovid_leiras',$kapcs_tanf);
							if(strlen($rovid_leiras)>0){
								echo wp_strip_all_tags($rovid_leiras,$remove_breaks);
							}else{
								echo wp_strip_all_tags( get_post($kapcs_tanf)->post_content, $remove_breaks );
							}
							 ?>				
						<button class="more-details-button">Teljes leírás</button>
                    </p>

                    <div class="jelentkezes-desktop">
					<?php
                        $listaar = get_field('listaar');
                        $akcios = get_field('akcios_ar', $kiiras->ID);
                        $van_e_akcio = false;
                        $szazalek = 0;
                        if($akcios<$listaar){
                           $van_e_akcio = true;
                            $szazalek = round((1-($akcios / $listaar))*100);
                        }
                    ?>

                        <div class="ar">
						<?php if($van_e_akcio && !$is_ceges){ ?>
							<div class="discount-label"><?php echo $szazalek; ?>%</div>
							<h2 class="discounted"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h2>
							<h2 class="final-price"><?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</h2>
						<?php }else if(!$van_e_akcio && !$is_ceges){ ?>
                            <h2 class="final-price"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h2>
						<?php } ?>

                        </div>
						<?php if(!$biztosan_indul):?>
						<h3 class="ne_varj">Ne várj a jelentkezéssel, fizetni csak a tanfolyam biztos indulása esetén kell!</h3>
						<?php endif; ?>
                        <div class="button">
                            <button class="jelentkezes p-button ghost white2 medium"><a href="?<?php echo ($is_full==false)?'jelentkezes':'varolista'; ?>&ID=<?php echo $kiiras->ID; ?>"><?php echo ($is_full==false)?'Jelentkezek':'Várólistára jelentkezek'; ?></a></button>
                            <button class="ceges-ajanlat p-button invisible medium"><a href="<?php echo get_permalink(); ?>?ceg&ID=<?php echo $kiiras->ID; ?>">Céges ajánlatot kérek</a></button>
                            <button class="ceges-ajanlat p-button invisible medium"><a href="<?php echo get_permalink(); ?>?erdeklodes&ID=<?php echo $kiiras->ID; ?>">Érdekel egy másik időpontban</a></button>
                        </div>
                    </div>
                </div>

                <div class="idopontok-desktop">
                    <ul>
					<?php 
					$k = 0;
					foreach ($kiirasok as $kiiras) : ?>
                        <li class="<?php echo ($i==$k)?'selected':''; ?>"><?php echo get_field('kezdes', $kiiras->ID); ?>
								<?php if(get_field('alkalmak_megadasa',$kiiras->ID) != 'kezdet-veg'){ ?>
									<h4>Időpontok:</h4>
									<ul>
										<?php foreach(get_field('tovabbi_napok',$kiiras->ID) as $nap): ?>
											<li><?php echo $nap['tovabbi_nap']; ?></li>
										<?php endforeach; ?>
										<li><?php echo get_field('vege',$kiiras->ID); ?></li>
									</ul>
								<?php }else if(get_field('kezdes',$kiiras->ID) != get_field('vege',$kiiras->ID)){ ?>
									<h4>Vége:</h4>
									<ul>
										<li><?php echo get_field('vege',$kiiras->ID); ?></li>
									</ul>
								<?php } ?>
						</li>
					<?php $k++; endforeach; ?>
                      
                    </ul>
					
                </div>

            </div>
			<?php $i++; endforeach; ?>
			
<?php endif; ?>