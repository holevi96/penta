<?php  
			$ajanlasok = get_posts(array(
                                    "post_type" => 'ajanlasok',
                                    "numberposts" => -1,
									'meta_query' => array(
									  array(
										  'key' => 'tanfolyam', // name of custom field
										  'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
										  'compare' => 'LIKE'
									  )
									)
                                ));
								if($ajanlasok):
								?>
								
    <section id="testimonials">
        <div class="pnt-container">

            <ul class="listing main-carousel">
                                <?php
                        
                                foreach ($ajanlasok as $ajanlas) { ?>
									<li class="carousel-cell">
										<blockquote>
											<?php echo get_post($ajanlas->ID)->post_content; ?>
										</blockquote>
									</li>
								<?php } ?>
	


                
            </ul>

        

        </div>
    </section>
<?php endif; ?>