<?php get_header(); the_post();?>
<div id="single-page" class="body single-page kapcsolat-page">

<?php include 'inc/menu.php'; ?>

    
<iframe src="https://snazzymaps.com/embed/128072" width="100%" height="300px" style="border:none;"></iframe>
    
		
		<div id="kapcsolat">
		
	<div class="pnt-container">
		<div>
			<div class="szoveg">
				<h2>Kapcsolat</h2>
				<p>&copy; Pentaschool Bt.<br>
				<a href="/helyszin/budapest">Cím: 1051 Budapest, Sas utca 25, VI. em.</a><br>
                    Telefon: (1)-472-0679<br>

                    <a class="social" href="https://www.facebook.com/pentaschool/">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebook-logo.svg" alt="">
                        <span>Pentaschool</span>
                    </a>

                    <a class="social" href="https://www.facebook.com/ExcelBazis/">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebook-logo.svg" alt="">
                        <span>Excel bázis</span>
                    </a>



				</p>
			</div>
			<?php  echo do_shortcode('[gravityform id="10" title="false" description="true" ajax="false"]'); ?>
		</div>
     </div>
</div>
   
	

</div>
<?php get_footer(); ?>