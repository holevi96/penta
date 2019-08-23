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
    <?php $tanfok = get_field("kapcsolodo_tanfolyam"); ?>
    <div class="course-search-result course-listing kapcsolodo-tanfolyamok">
        <div class="pnt-container">
            <ul class="active-course">

                <h2 class="p-section-title">Kapcsolódó tanfolyamok:</h2>
                <?php include( locate_template( 'tanf-simple-listing.php', false, false ) ); ?>
            </ul>
        </div>
    </div>
<?php 
	 get_template_part('sections/singletanf','ajanlasok');
?>
    <?php  get_template_part('sections/section','faq'); ?>
    <?php  get_template_part('sections/singletanf','form'); ?>

</div>


</div>
<?php get_footer(); ?>