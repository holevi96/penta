<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?>>
	 <div class="main-container bg--primary">
	<?php
                $absolute =  $_GET['pdf'];
            $x = explode('/', $absolute);
            $pdf_name = $x[count($x)-1];
            $url = get_site_url() . "/pdf/".$pdf_name;

            ?>
		<section class="text-center imagebg" data-overlay="4">
                <div class="background-image-holder"> <img alt="background" src="<?php echo get_stylesheet_directory_uri(); ?>/img/landing-20.jpg"> </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-6">
                            <div class="cta">
                                <h2>Köszönjük a jelentkezését!</h2>
                                <p class="lead">Az alábbi linken letöltheti az elkészült jelentkezési lapot, amelyet email-ben szíveskedjen aláírva továbbítani, ezzel véglegesítve a jelentkezését. </p>
                                <a class="btn btn--primary type--uppercase" href="<?php echo $url; ?>">
									<span class="">Jelentkezési lap letöltése</span>
								</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
           
        </div>
    </article>
<?php endwhile; ?>