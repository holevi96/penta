<?php while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?>>
    <!--<header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>


  </article>-->
    <div class="main-container">



        <section class="text-center imagebg" >
		<div class="background-image-holder"> <img alt="background" src="<?php echo get_stylesheet_directory_uri(); ?>/img/dropdown-1.jpg"> </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12  col-md-12 ">
                        <div class="boxed boxed--lg bg--dark subscribe-form-1">
                            <div class="col-sm-10 col-sm-offset-1 text-left">
							<div class="row">
								
                                <?php if(isset($_GET['jelentkezes'])): ?>
								
								<?php
                                    $form = GFFormsModel::get_form_meta(1);
									$napok = array();
										 $napok[0] = 'Hétfő';
										 $napok[1] = 'Kedd';
										 $napok[2] = 'Szerda';
										 $napok[3] = 'Csütörtök';
										 $napok[4] = 'Péntek';
										 $napok[5] = 'Szombat';
										 $napok[6] = 'Vasárnap';
														?>
                                    <?php if(!isset($_GET['online'])): ?>
									<div class='col-md-6'>
									<h3><?php echo get_post(get_field('kapcsolodo_tanf')[0])->post_title; ?></h3>
									 
												<div class="idobeosztas">
												<?php
													$megadas = get_field('alkalmak_megadasa');

													if($megadas == 'napok'){?>
														<h5>A tanfolyam napjai:</h5>
														<ul class="bullets">
															<li><?php echo get_field('kezdes') . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',get_field('kezdes') )->format('w')];?></li>
															<?php $tovabbi_napok = get_field('tovabbi_napok');
															if($tovabbi_napok){
																foreach ($tovabbi_napok as $nap) {?>
																  <li><?php echo $nap['tovabbi_nap'] . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',$nap['tovabbi_nap'] )->format('w')];?></li>
																<?php }

															}?>
															<li><?php echo get_field('vege') . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',get_field('vege') )->format('w')];?></li>
														</ul>
													<?php }else if($megadas == 'kezdet-veg'){ ?>
														<span>Kezdete:</span>
														<big><?php echo get_field('kezdes');?></big>
														<hr>
														<span>Vége:</span>
														<big><?php echo get_field('vege');?></big>
														<hr>
														<span>Napi beosztás:</span>
														<big><?php echo get_field('napi_beosztas');?></big>
														<hr>
													<?php }?>

												<span>Időbeosztás:</span>
												 <big><?php echo get_field('idobeosztas'); ?></big>
												<hr>
											</div>
								</div>
								<div class='col-md-6 jelentkezes_modok'>
											<div class='row'>
												<a class="btn btn--lg btn--primary" href="#">
												<span class="btn__text" style="color:#fff;width:100%">Hagyományos jelentkezési lap</span>
												</a>
												<p>Word formátumú jelentkezési lap letöltése. Számítógéppel kitöltve, nyomtatás és aláírás után email csatolmányként juttathatja el hozzánk a jelentkezést. </p>
											</div>
											<div class='row'>
												<a class="btn btn--lg btn--primary" href="<?php echo get_permalink(); ?>?jelentkezes&online">
												<span class="btn__text" style="color:#fff;width:100%">Online jelentkezés</span>
												</a>
												<p>Az Online jelentkezés esetén űrlapok kitöltésével készítheti el a jelentkezést. A végén igény esetén PDF verzióban letöltheti, nyomtathatja, és az engedélyező aláírása után email-en küldheti el nekünk.</p>
											</div>
								</div>       
                          </div>   
                                <?php endif;
                                endif;
                                if(isset($_GET['jelentkezes']) && isset($_GET['online'])){?>
                                    <div class="row">
									<?php echo do_shortcode('[gravityform id="1" title="true" description="true" ajax="false"]'); ?>
									</div>
                                <?php }
                                if(isset($_GET['varolista'])){
                                    echo do_shortcode('[gravityform id="7" title="true" description="true" ajax="false"]');
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
                </div>
            </div>
        </section>


    </div>
    <?php endwhile; ?>
