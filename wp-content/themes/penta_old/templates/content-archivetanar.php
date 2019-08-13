<?php
if ( have_posts() ) : ?>
    <section class="text-left tanarok">
    <div class="container">
    <div class="row">
<?php    while ( have_posts() ) : the_post(); ?>
   <div class="col-sm-4">
       <div class="feature feature-8">
           <img alt="Image" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )[0]; ?>">
            <h2><?php the_title(); ?></h2>
           <span><?php the_content(); ?></span>
           <h5>Témák</h5>
           <?php $temak = get_field('temak',get_the_ID()); ?>
           <ul class="bullets">
               <?php foreach ($temak as $tema) { ?>
                 <li><?php echo $tema['tema']; ?></li>
               <?php } ?>
           </ul>
        </div>
   </div>
   <?php endwhile;?>

    </div>
    </div>
    </section>
<?php
else :
    echo wpautop( 'Sorry, no posts were found' );
endif;
?>