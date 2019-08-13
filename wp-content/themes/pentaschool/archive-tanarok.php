<?php get_header(); ?>
<!-- LISTING -->
<div id="oktatoink">
<?php include 'inc/menu.php'; ?>
    <div class="pnt-container head">
        <h1 class="p-section-title">Oktatóink</h1>
    </div>
	    <div class="oktatoink-lista pnt-container">
        <ul>
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <li>
                <div class="wrapper">
                    <div class="image-wrapper">
                       <?php  if(has_post_thumbnail()){
                           the_post_thumbnail('full');
                       }else{ ?>
                           <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/dummy_tanar.jpg" alt="">
                       <?php } ?>
                    </div>
                    <div>
                        <h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
                        <span>Területei:</span>
                        <ul>
							<?php 
								foreach(get_field('temak') as $tema){?>
									<li><?php echo $tema['tema']; ?></li>
								<?php }
								
							?>
                        </ul>
                    </div>
                </div>
            </li>		
		<?php endwhile; endif;?>
        </ul>
    </div>
<?php get_footer(); ?>