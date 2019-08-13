<?php get_header(); ?>
<div id="above-the-fold-3" class="body">
 <?php include 'inc/menu.php'; ?>
<div class="pnt-container">

        <!-- VALIUE PROPOSITON -->
        <div class="value-proposition">
            <h1>
                Gyorsíts kicsit hogy később lassíthassál.
            </h1>
            <div class="contact">
                <p>
                    Cím: 1051 Budapest, Sas utca 25, VI. em. <br>
                    Telefon: (1) 472-0679 <br>
                    Fax: (1) 472-0680 <br>
                    pentaschool@pentaschool.hu
                </p>
            </div>
        </div>

<?php 
	echo get_template_part('sections/frontpage','search_wrapper');
?>
<?php 
	echo get_template_part('sections/frontpage','promoted_courses');
?>
<?php 
	echo get_template_part('sections/frontpage','main_categories');
?>
        
    </div>
</div>
<!-- LISTING -->

<div id="home-courses" class="course-listing">


    <div class="pnt-container">
        <?php
        echo get_template_part('sections/frontpage','filter');
        ?>
        <ul class="active-course">

            <h2 class="p-section-title">Meghirdetett tanfolyamok</h2>
			
			<?php 
				echo get_template_part('sections/frontpage','active_courses');
			?>
        </ul>
    </div>
</div>
<?php 
	//echo get_template_part('sections/frontpage','services');
?>

<?php get_footer(); ?>