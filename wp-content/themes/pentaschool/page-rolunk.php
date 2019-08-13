<?php get_header(); the_post();?>
<div id="rolunk" class="body">

<?php include 'inc/menu.php'; ?>

    <div class="pnt-container head">
<!--        <h1 class="p-section-title">--><?php //the_title(); ?><!--</h1>-->
        <br>
    </div>

    <div class="pnt-container">
	<div class="intro">
            <div class="wyswyg-content">
               <?php the_content(); ?>
			</div>
            <div class="image-wrapper">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/example-image-1.png" alt="">
                <?php
                echo get_template_part('sections/section','faq');
                ?>
            </div>

        </div>
    </div>

</div>
<?php get_footer(); ?>