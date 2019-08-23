<?php get_header(); the_post();?>
<div id="tanfolyamok-single" class="body">

<?php include 'inc/menu.php'; ?>
<div id="video-view">
	<i class="material-icons close">close</i>
	<iframe width="1120" height="630" src="" allow="autoplay" style="visibility:hidden" frameborder="0" allowfullscreen>
	
	</iframe>
</div>
<div id="">
    <section id="tanfolyam-main" class="p-row">

        <div class="pnt-container">
            <header class="">
                <h1><?php the_title(); ?></h1>
            </header>
			<section id="course-idopontok">
			<?php 
				 get_template_part('sections/singletanf','kiirasok');
			?>
			<?php 
				 get_template_part('sections/singletanf','kiiras_nelkul');
			?>
			</section>
		</div>
    </section>

<?php 
	 get_template_part('sections/singletanf','nekedajanljuk');
?>

<?php 
	 get_template_part('sections/singletanf','tematika');
?>
<?php 
	 get_template_part('sections/singletanf','calltoaction');
?>
<?php 
	 get_template_part('sections/singletanf','ajanlasok');
?>
    <?php  get_template_part('sections/section','faq'); ?>
    <?php  get_template_part('sections/singletanf','form'); ?>

</div>


</div>
<?php get_footer(); ?>