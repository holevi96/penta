<?php while (have_posts()) : the_post(); ?><article <?php post_class(); ?>>
<div class="main-container">
      <section class="cover imagebg switchable height-50" data-overlay="8">
        <div class="background-image-holder"> <img alt="background" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[0]; ?>"></div>
        <div class="container pos-vertical-center">
          <div class="row">
            <div class="col-md-5 col-sm-7">
              <div class="switchable__text">
                <h1><?php the_title(); ?></h1>
                <p class="lead"></p>
                <a class="btn btn--primary type--uppercase" href="#idopontok"> <span class="btn__text"><span>Jelentkezés</span></span>
                </a>
              </div>
            </div>
            <div class="col-md-6 col-sm-4 col-xs-12">
              <div class="video-cover border--round box-shadow-wide">
                <div class="background-image-holder"> <img alt="image" src="<?php echo get_stylesheet_directory_uri(); ?>/img/video-bck.png"> </div>
                <div class="video-play-icon"></div> <iframe data-src="<?php echo get_field('demovideo'); ?>" allowfullscreen="allowfullscreen"></iframe> </div>
            </div>
          </div>
        </div>
      </section>
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>


      <section id="idopontok">
  <?php
  $kiirasok = get_posts(array(
      'post_type' => 'tanfolyam-kiiras',
      'meta_query' => array(
          array(
              'key' => 'kapcsolodo_tanf', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
          )
      )

  ));
  ?>

          <?php if($kiirasok): ?>

              <div class="container">
                  <div class="row">
                      <div class="col-sm-10 col-md-8">
                          <h2>Időpontok:<br></h2>
                      </div>
                  </div>
              </div>

        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="tabs-container tabs--folder tanfolyam-kiirasok-box">
                <ul class="tabs ">
                 <?php if(count($kiirasok) > 0){
                     $cnt = 0;
                     $honapok = array();
                     $honapok[1] = 'Január';
                     $honapok[2] = 'Február';
                     $honapok[3] = 'Március';
                     $honapok[4] = 'Április';
                     $honapok[5] = 'Május';
                     $honapok[6] = 'Június';
                     $honapok[7] = 'Július';
                     $honapok[8] = 'Augusztus';
                     $honapok[9] = 'Szeptember';
                     $honapok[10] = 'Október';
                     $honapok[11] = 'November';
                     $honapok[12] = 'December';
					 $napok = array();
					 $napok[0] = 'Hétfő';
					 $napok[1] = 'Kedd';
					 $napok[2] = 'Szerda';
					 $napok[3] = 'Csütörtök';
					 $napok[4] = 'Péntek';
					 $napok[5] = 'Szombat';
					 $napok[6] = 'Vasárnap';
                  foreach ($kiirasok as $kiiras) { ?>
                  <li class="<?php echo ($cnt==0)?"active":"";?> bg--primary">
                      <?php

                      $kezdes_str = get_field('kezdes',$kiiras->ID);
                      $kezdes_honap = $honapok[(int)substr($kezdes_str,5,2)];
                      $kezdes_nap = substr($kezdes_str,8,2);



                      ?>
                    <div class="tab__title" data-id="<?php echo $kiiras->ID; ?>"> <span class="h6 color--primary"><?php echo $kezdes_honap . ' ' . $kezdes_nap ; ?> </span></div>
                    <div class="tab__content flexbox">
                      <div class="col-md-4  col boxed boxed--border bg--primary left-col">
                        <ul>
                            <li>
                            <?php $napszak = get_field('napszak', $kiiras->ID);
                            if($napszak=='esti'){?>
                                <i class="icon icon--sm icon-Half-Moon"></i>
                            <?php }else{ ?>
                                <i class="icon icon--sm icon-Sun"></i>
                            <?php }
                            ?>
                            <span>Napszak:</span>
                            <big><?php echo $napszak; ?></big>
                            </li>
<!--                          <li><i class="icon icon--sm icon-Money"></i> <span>Listaár:</span><big>--><?php //the_field('listaar');?><!-- Ft.</big></li>-->
                          <hr>
                            <?php
                            $szabad_helyek = get_field('maximum_letszam',$kiiras->ID)- get_field('beiratkozva',$kiiras->ID);
                            $betelt = (get_field('maximum_letszam',$kiiras->ID) == get_field('beiratkozva',$kiiras->ID));
                            ?>
                          <li><i class="icon icon--sm icon-Add-User"></i> <span>Szabad helyek:</span><big class="<?php echo ($betelt)?'full':''; ?>" ><?php echo ($betelt)?'Betelt!': $szabad_helyek;  ?></big></li>
                          <hr>
                            <li><i class=" icon--sm icon icon-Information"></i><big><?php echo (get_field('beiratkozva',$kiiras->ID)>=get_field('minimum_letszam',$kiiras->ID))?'Biztosan indul!':"Szervezés alatt!"; ?></big></li>
                            <hr>
                          <li><i class="icon icon--sm icon-Teacher"></i> <span>Oktató:</span><big><?php echo get_post(get_field('tanar',$kiiras->ID)[0])->post_title; ?></big></li>
                         <hr>
                          <li><i class="icon icon--sm icon-Map2"></i> <span>Helyszín:</span><a href="<?php echo get_permalink(get_field('helyszin',$kiiras->ID)[0]); ?>"><big><?php echo get_post(get_field('helyszin',$kiiras->ID)[0])->post_title; ?></big></a></li>




                        </ul>
                      </div>
                        <div class="col-md-4 col boxed boxed--border mid-col" >

                                <div class="front  box-shadow bg--secondary feature" style="">
                                    <h4>Jelentkezz a tanfolyamra!</h4>
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
                                    <div class="tanf-price">
                                        <h4><?php echo number_format($akcios, 0, ',', ' '); ?>Ft</h4>
                                        <?php if($van_e_akcio): ?>
                                        <strike><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</strike>
                                        <span><?php echo $szazalek; ?> % kedvezmény!</span>
                                        <?php endif; ?>
                                    </div>


                                    <p>
                                        <?php if(!$betelt){ ?>
                                    <a class="btn btn--lg btn--primary"
                                       href="<?php echo get_permalink($kiiras->ID); ?>?jelentkezes">
                                        <span class="btn__text" style="color:#fff;width:100%">Jelentkezés</span>
                                    </a>
                                     <?php }else{ ?>
                                            <a class="btn btn--lg btn--primary"
                                               href="<?php echo get_permalink($kiiras->ID); ?>?varolista">
                                                <span class="btn__text" style="color:#fff;width:100%">Várólistára jelentkezés</span>
                                            </a>
                                        <?php }?>
                                    </p>

                                    <div class="more-buttons">
                                        <p>
                                            <a class="btn btn--lg btn more-options-button" href="file:///C:/Users/DELL/Documents/themeforest-19337626-stack-multipurpose-html-with-page-builder/Stack%201.5.1/tanfolyam-oldal2.html#" >
                                                <span class="btn__text">Érdekel egy <br/> későbbi időpontban!</span>
                                            </a>
                                        </p>
                                        <p>
                                            <a class="btn btn--lg more-options-button" href="file:///C:/Users/DELL/Documents/themeforest-19337626-stack-multipurpose-html-with-page-builder/Stack%201.5.1/tanfolyam-oldal2.html#" style="background: #fff;">
                                                <span class="btn__text">Kérdésem van!</span>
                                            </a>
                                        </p>
                                        <p>
                                            <a class=" btn btn--lg more-options-button" href="file:///C:/Users/DELL/Documents/themeforest-19337626-stack-multipurpose-html-with-page-builder/Stack%201.5.1/tanfolyam-oldal2.html#" style="background: #fff;">
                                                <span class="btn__text">Céges ajánlatot kérek!</span>
                                            </a>
                                        </p>
                                    </div>
                                </div>

                        </div>
                      <div class="col-md-4 col boxed boxed--border bg--primary right-col">
                        <div class="third-box box-shadow">
                            <h3>Beosztás:</h3>
                            <div class="idobeosztas">
                                <?php
                                    $megadas = get_field('alkalmak_megadasa',$kiiras->ID);

                                    if($megadas == 'napok'){?>
                                        <h5>A tanfolyam napjai:</h5>
                                        <ul class="bullets">
                                            <li><?php echo get_field('kezdes',$kiiras->ID) . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',get_field('kezdes',$kiiras->ID) )->format('w')];?></li>
                                            <?php $tovabbi_napok = get_field('tovabbi_napok',$kiiras->ID);
                                            if($tovabbi_napok){
                                                foreach ($tovabbi_napok as $nap) {?>
                                                  <li><?php echo $nap['tovabbi_nap'] . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',$nap['tovabbi_nap'] )->format('w')];?></li>
                                                <?php }

                                            }?>
                                            <li><?php echo get_field('vege',$kiiras->ID) . ' - ' .  $napok[DateTime::createFromFormat('Y.m.d',get_field('vege',$kiiras->ID) )->format('w')];?></li>
                                        </ul>
                                    <?php }else if($megadas == 'kezdet-veg'){ ?>
                                        <span>Kezdete:</span>
                                        <big><?php echo get_field('kezdes',$kiiras->ID);?></big>
                                        <hr>
                                        <span>Vége:</span>
                                        <big><?php echo get_field('vege',$kiiras->ID);?></big>
                                        <hr>
                                        <span>Napi beosztás:</span>
                                        <big><?php echo get_field('napi_beosztas',$kiiras->ID);?></big>
                                        <hr>
                                    <?php }?>

                                <span>Időbeosztás:</span>
                                 <big><?php echo get_field('idobeosztas', $kiiras->ID); ?></big>
                                <hr>
                            </div>




                        </div>
                      </div>

                    </div>
                  </li>
                  <?php $cnt++; } }; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
          <?php endif; ?>
      </section>
        <section class="switchable">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7">
                        <h3>Célközönség:</h3>
                        <?php the_field('celkozonseg'); ?>
                        <h3>Belépési feltételek:</h3>
                        <?php if(get_field('belepesi_feltetelek')){ ?>
                            <ul class="bullets">
                                <?php foreach (get_field('belepesi_feltetelek') as $feltetel) { ?>
                                    <li><?php echo $feltetel['feltetel']; ?></li>
                               <?php } ?>
                            </ul>
                        <?php } ?>

                            <h3>Igazolás</h3>
                            <ul class="bullets">
                                <li><?php the_field('igazolas'); ?></li>
                            </ul>


                        <?php if(get_field('quiz_gravtiy_form_id')): ?>
                            <br>

                           <h3>Felmérő teszt:</h3>
                           <a href="<?php echo get_site_url(); ?>/quiz?quizid=<?php echo get_field('quiz_gravtiy_form_id') ?>">Kattints ide a teszthez!</a>

                        <?php endif; ?>




                    </div>
                    <div class="col-sm-4 col-md-3">
                        <div class="text-block">
                            <h5><strong>Kapcsolódó tanfolyamok:</strong></h5>
                            <p>
                                <ul class="bullets">
                                    <?php 
                                        $kapcs = get_field('kapcsolodo_tanfolyam');
                                        if($kapcs){
                                            foreach ($kapcs as $tanf) {?>
                                                <li><a href="<?php echo get_permalink($tanf);?>"><?php echo get_post($tanf)->post_title; ?></a></li>
                                            <?php }
                                        }
                                    ?>
                                </ul>
                            </p>
                        </div>
						<?php  dynamic_sidebar('sidebar-tanfolyam'); ?>
						<?php echo file_get_contents_utf8('http://pentaschool.hu/Include/excelbazis_feed_html.txt'); ?>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Tematika</h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="tematika">

            <div class="container">

                    <div class="process-2">
                        <?php
                        $tematika = get_field('tematika');

                        $cnt = 1;
                        $cnt2 = 0;
                        if($tematika):
                            foreach ($tematika as $tema) {?>
                                <?php if($cnt2 == 0): ?>
                                        <div class="row">
                                <?php endif; ?>
                                <div class="col-sm-3">
                                    <span class="process-number"><?php echo $cnt; ?></span>
                                    <div class="process__item">
                                        <h5><?php echo $tema['cim']; ?></h5>
                                        <p><?php echo $tema['leiras']; ?></p>
                                    </div>
                                </div>
                                 <?php $cnt2++; if($cnt2 == 4): ?>
                                            </div>
                                <?php $cnt2 = 0; endif; ?>
                           <?php $cnt++; }

                        endif;
                        ?>

                    </div>
                </div>

        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Ajánlások</h1>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">

                    <div class="col-sm-12">
                        <div class="slider slider--inline-arrows" data-arrows="true" data-timing="8000">
                            <ul class="slides">
                                <?php
                                $ajanlasok = get_posts(array(
                                    "post_type" => 'ajanlasok',
                                    "numberposts" => -1
                                ));
                                foreach ($ajanlasok as $ajanlas) {
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $ajanlas->ID ), 'full' )[0];
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="testimonial">
                                                <div class="col-md-2 col-md-offset-1 col-sm-4 col-xs-6 text-center"> <img class="testimonial__image" alt="Image" src="<?php echo get_stylesheet_directory_uri(); ?>/img/big-quote-marks-opening.png"> </div>
                                                <div class="col-md-7 col-md-offset-1 col-sm-8 col-xs-12"> <span class="h3"><?php echo $ajanlas->post_content; ?></span>
                                                    <h5><?php echo get_field('keresztnev',$ajanlas->ID); ?></h5> <span><?php echo get_field('cegnev',$ajanlas->ID); ?></span> </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }

                                ?>
                            </ul>
                        </div>
                    </div>

            </div>
        </section>
        <section class="space--sm">
            <a href="">
                <div class="container">
                    <div class="row">
                        <div class="slider slider--inline-arrows slider--arrows-hover text-center" data-arrows="true">
                            <ul class="slides">
                                <?php

                                while ( have_rows('logok','options') ) : the_row();

                                    // display a sub field value
                                    $url = get_sub_field('kep'); ?>
                                    <li class="col-sm-3 col-xs-6"> <img alt="Image" class="image--xxs" src="<?php echo $url; ?>"> </li>
                                <?php endwhile;

                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </a>
        </section>

    </div>
<?php endwhile; ?>
