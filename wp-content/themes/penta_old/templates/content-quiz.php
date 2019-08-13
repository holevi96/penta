<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <div class="main-container">
        <section class="imagebg" data-overlay="4">
            <div class="background-image-holder"> <img alt="background" src="<?php echo get_stylesheet_directory_uri(); ?>/img/keyboard.jpg"> </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Felmérő teszt</h1>
                    </div>
                </div>
            </div>
        </section>
		<section>
            <div class="container">
                <?php if(isset($_GET['quizid'])){

                  echo do_shortcode('[gravityform id="' . $_GET['quizid'] . '" title="true" description="true" ajax="false"]');

                }?>

            </div>
        </section>
    </div>
<?php endwhile; ?>
