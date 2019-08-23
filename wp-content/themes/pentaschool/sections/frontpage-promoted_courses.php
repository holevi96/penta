
        <!-- PROMOTED COURSES -->
        <h2 class="p-section-title">Kiemelt Tanfolyamok</h2>
        <ul class="promoted-courses">
			<?php
            $cnt = 1;
            foreach(get_field('kiemelt_tanfolyamok') as $kiemelt):
						$max = get_field('maximum_letszam',$kiemelt);
						$min = get_field('minimum_letszam',$kiemelt);
						$beiratkozva = get_field('beiratkozva',$kiemelt);
						$is_full = ($max <= $beiratkozva);
						$img =  wp_get_attachment_image_src(get_post_thumbnail_id( get_post(get_field('kapcsolodo_tanf',$kiemelt)[0])->ID), 'full')[0];
			?>
                    <li>
                        <style>
                            .promoted-courses li:nth-child(<?php echo $cnt; ?>){

                                background:url(<?php echo  ($img)? $img : get_stylesheet_directory_uri().'/img/example-image-' . $cnt .'.png';?>);
                                background-size:cover;
                            }
                        </style>
						<h2><?php echo get_post(get_field('kapcsolodo_tanf',$kiemelt)[0])->post_title; ?></h2>
                        <h3><?php echo get_field('kezdes',$kiemelt); ?></h3>
                         <div>
							<a class="p-button orange medium" href="<?php echo get_permalink(get_field('kapcsolodo_tanf',$kiemelt)[0]); ?>?ID=<?php echo $kiemelt; ?>">Részletek</a>
							<?php if(!$is_full){ ?>
							<a class="p-button invisible yellow medium"href="<?php echo get_permalink(get_field('kapcsolodo_tanf',$kiemelt)[0]); ?>?jelentkezes&ID=<?php echo $kiemelt; ?>">Jelentkezem</a>
							<?php }else{ ?>
							<a class="p-button invisible yellow medium" href="<?php echo get_permalink(get_field('kapcsolodo_tanf',$kiemelt)[0]); ?>?varolista&ID=<?php echo $kiemelt; ?>">Jelentkezem</a>
							<?php } ?>
						</div>
                        
                    </li>

			<?php
            $cnt++;
            endforeach; ?>
        </ul>
