 <?php  $kiirasok = get_posts(array(
      'post_type' => 'tanfolyam-kiiras',
      'meta_query' => array(
          array(
              'key' => 'kapcsolodo_tanf', // name of custom field
              'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
              'compare' => 'LIKE'
          )
      )

  )); 
   if(!$kiirasok): 
	$is_ceges = get_field('ceges_megrendeles');
	
   ?>
            <div class="top active">
                <div class="tanfolyam-full-details wyswyg-content">
                    <div class="header">

                        <div class="icons">
                            <!--<div>
                                <i class="material-icons">place</i>
                                <span><?php echo get_post(get_field('helyszin',$kiiras->ID)[0])->post_title; ?></span>
                            </div>
                            <div>
							<?php $napszak = get_field('napszak', $kiiras->ID);
                            if($napszak=='esti'){?>
                                <i class="material-icons">brightness_3</i>
                                <span>esti tanfolyam</span>
                            <?php }else{ ?>
                                <i class="material-icons">brightness_7</i>
                                <span>nappali tanfolyam</span>
                            <?php }
                            ?>
                                
                            </div>-->
                        </div>


                        <i class="material-icons close">close</i>

                    </div>
                    <?php echo get_post(get_the_ID())->post_content; ?>
                </div>
                <?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium' )[0]; ?>
                <div class="image-wrapper" style="background:url('<?php echo (!$url)?get_stylesheet_directory_uri().'/img/tanfolyam-1.png':$url; ?>')">

                </div>

                <div id="tanfolyam-details">

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
						
							<?php $listaar = get_field('listaar');?>
						
						<div class="icons">

					</div>
                        <div class="ar">
							<?php if(!$is_ceges){ ?>
								<h2 class="final-price"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h2>
							<?php }else{ ?>
								<h2 class="final-price">Ár: Kérjen ajánlatot!</h2>
							<?php } ?>
                        </div>

                        <div class="button">
                            <button class="jelentkezes p-button brown medium"><a href="?<?php echo ($is_ceges==0)?'erdeklodes':'ceg'; ?>"><?php echo ($is_ceges==0)?'Érdeklődés':'Céges ajánlatot kérek'; ?></a></button>
                            <?php if($is_ceges == 0): ?><button class="ceges-ajanlat p-button invisible medium"><a href="<?php echo get_permalink(); ?>?ceg">Céges ajánlatot kérek</a></button><?php endif; ?>
                            
                        </div>
                    </div>
                </div>

                <div class="idopontok-desktop">
                    <ul>
					<?php 
					$k = 0;
					foreach ($kiirasok as $kiiras) : ?>
                        <li class="<?php echo ($i==$k)?'selected':''; ?>"><?php echo get_field('kezdes', $kiiras->ID); ?></li>
					<?php $k++; endforeach; ?>
                        
                    </ul>
                </div>
            </div>
   <?php endif; ?>
