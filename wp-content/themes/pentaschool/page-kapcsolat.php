<?php get_header(); the_post();?>
<div id="single-page" class="body single-page kapcsolat-page">

<?php include 'inc/menu.php'; ?>

			<?php
        $refs = get_posts(array(
            "post_type"=>'referenciak',
            'numberposts' => -1
        ));
        $cats = array();
        $years = array();
        foreach ($refs as $ref) {
            $cats[] = get_field('kategoria', $ref->ID);
            $years[] = get_field('ev', $ref->ID);
        }
        $cats = array_unique($cats);
        $years = array_unique($years);
            ?>
<iframe src="https://snazzymaps.com/embed/128072" width="100%" height="300px" style="border:none;"></iframe>
    
		
		<div id="kapcsolat">
		
	<div class="pnt-container">
		<div>
			<div class="szoveg">
				<h2>Kapcsolat</h2>
				<p>&copy; Pentaschool Bt.<br>
				Cím: 1051 Budapest, Sas utca 25, VI. em.<br>
				Telefon: (1)-472-0679 Fax: (1)-472-0680<br>
				</p>
			</div>
			<?php  echo do_shortcode('[gravityform id="10" title="false" description="true" ajax="false"]'); ?>
		</div>
     </div>
</div>
   
	

</div>
<?php get_footer(); ?>