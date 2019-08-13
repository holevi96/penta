<?php if((isset($_GET['jelentkezes']) && isset($_GET['ID'])) || isset($_GET['ceg']) || isset($_GET['varolista']) || isset($_GET['erdeklodes']) || isset($_GET['kerdes'])): ?>
<?php 
$kiiras = $_GET['ID'];
						$heti_beosztas = get_field('napi_beosztas',$kiiras);
						$idobeosztas = get_field('idobeosztas',$kiiras);
						$alkalmak_megadasa = get_field('alkalmak_megadasa',$kiiras);
						
						if($alkalmak_megadasa == 'kezdet-veg'){
							$kezdet_veg = true;
						}else{
							$kezdet_veg = false;
						}
?>
        <div class="modal">
		<style>
			body{overflow:hidden}
		</style>
            <div id="sign-up-form" class="modal-content">
			
                <div class="header" id="gf_1">
				<i class="material-icons close">close</i>
				<h3 class="type"><?php echo(isset($_GET['varolista']))?'Várólistás jelentkezés':'Tanfolyam jelentkezés'; ?></h3>
                    <div class="general-info">
						
                        <div>
                            <h1><?php the_title(); ?></h1>
                            <!--<a target="_blank" href="<?php echo get_permalink(get_the_ID()); ?>#tematika">részletes tematika és órarend</a>-->
							<!--<ul class="beosztasok">
								<li>
									<i class="material-icons">today</i>
									<span><?php echo get_field('kezdes', $kiiras); ?></span>
								</li>								
							<?php if($kezdet_veg == true){ ?>
								<li>
									<i class="material-icons">date_range</i>
									<span><?php echo $heti_beosztas; ?></span>								
								</li>
								<li>
									<i class="material-icons">access_time</i>
									<span><?php echo $idobeosztas; ?></span>								
								</li>
							<?php }else{ ?>
								
								<li>
									<i class="material-icons">access_time</i>
									<span><?php echo $idobeosztas; ?></span>								
								</li>								
							<?php } ?>
								
							</ul>-->
                        </div>
						<?php if(isset($_GET['ID'])): ?>
                        <ul>
                            <!--<li>
                                <i class="material-icons">local_offer</i>
								<?php
									$listaar = get_field('listaar');
									$akcios = get_field('akcios_ar', $kiiras);
									$van_e_akcio = false;
									$szazalek = 0;
									if($akcios<$listaar){
									   $van_e_akcio = true;
										$szazalek = round((1-($akcios / $listaar))*100);?>
										<span><?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</span>
									<?php }else{ ?>
										<span><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</span>
									<?php }
								?>
                                
                            </li>-->
								<li>
									<i class="material-icons">today</i>
									<span><?php echo get_field('kezdes', $kiiras); ?></span>
								</li>								
							<?php if($kezdet_veg == true){ ?>
								<li>
									<i class="material-icons">date_range</i>
									<span><?php echo $heti_beosztas; ?></span>								
								</li>
								<li>
									<i class="material-icons">access_time</i>
									<span><?php echo $idobeosztas; ?></span>								
								</li>
							<?php }else{ ?>
								
								<li>
									<i class="material-icons">access_time</i>
									<span><?php echo $idobeosztas; ?></span>								
								</li>								
							<?php } ?>						
                        </ul>
						<?php endif; ?>
                    </div>
								<?php if(isset($_GET['jelentkezes'])){ 
								
								 echo do_shortcode('[gravityform id="1" title="false" description="true" ajax="false"]'); 
								}
								if(isset($_GET['varolista'])){
                                    echo do_shortcode('[gravityform id="1" title="true" description="true" ajax="false"]');
                                }
                                if(isset($_GET['erdeklodes'])){
                                    echo do_shortcode('[gravityform id="5" title="true" description="true" ajax="false"]');
                                }
                                if(isset($_GET['ceg'])){
                                    echo do_shortcode('[gravityform id="6" title="true" description="true" ajax="false"]');
                                }
                                if(isset($_GET['kerdes'])){
                                    do_shortcode('[gravityform id="4" title="true" description="true" ajax="false"]');
                                } ?>					
                </div>

            </div>
        </div>
		<?php endif; ?>