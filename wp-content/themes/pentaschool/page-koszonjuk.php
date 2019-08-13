<?php get_header(); the_post();?>
<div id="single-page" class="body single-page">

<?php include 'inc/menu.php'; ?>

			<?php
				$absolute =  $_GET['pdf'];
				$x = explode('/', $absolute);
				$pdf_name = $x[count($x)-1];
				$url = get_site_url() . "/pdf/".$pdf_name;
				
				$ID = $_GET['ID'];
				$varolistas = ($_GET['varoslistas']=='Igen');
				
				$max = get_field('maximum_letszam',$ID);
				$min = get_field('minimum_letszam',$ID);
				$beiratkozva = get_field('beiratkozva',$ID);
				$is_full = ($max == $beiratkozva);
				$biztosan_indul = ($beiratkozva>=$min);
				
            ?>

    <div class="pnt-container">
        <div class="page-content wyswyg-content koszonjuk">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thankyou.svg"/>
			<?php if(!$varolistas){ ?>
			 <h2>Nagyon köszönjük a jelentkezésed!</h2>
			 
				<h3>Az új létszám: <?php echo $beiratkozva; ?> fő.</h3>
                <p class="lead">
					A megadott kapcsolattartói címre küldtünk egy visszaigazoló levelet, ami tartalmazza a jelentkezés részleteit, és egy linket a jelentkezési lap PDF verziójához ha szükség lenne rá, letöltheted.
					Ellenőrizd a postafiókodat és a Spam mappát is. Ha nem kaptál levelet, írj nekünk vagy telefonálj, hogy közösen ellenőrizzük az okát! <br><br><b>Telefon: (1) 472-0679, Email: pentaschool@pentaschool.hu</b>
				</p>
				<?php if($biztosan_indul){ ?>
				<h3>
					A tanfolyam az eddigi jelentkezések alapján biztosan indul!
				</h3>
				<?php }else{; ?>
				<h3>
					Az induláshoz még <?php echo $max-$beiratkozva; ?> ember kell!
				</h3>
				<p>Amennyiben az eredeti időpontig a minimum létszám nem teljesül, a kezdés időpontját átütemezzük, melyről haladéktalanul értesíteni fogunk. </p>
				<?php } ?>
				
				<p>A tanfolyam indulása előtt jelentkezünk még egy email-lel, amelyben kérjük majd, hogy erősítsd meg részvételi szándékodat, illetve részletes további információval szolgálunk.</p>
                <a class="p-button orange medium" href="<?php echo $url; ?>">
					Jelentkezési lap letöltése
				</a>
				<p>Pentaschool csapat</p>
			<?php }else{ ?>
				<h2>Nagyon köszönjük a jelentkezésed a várólistára!</h2>
				<p>A tanfolyam jelenleg betelt, ezt  a jelentkezést a kérésedre várólistára tettük.
				Mivel egy tanfolyam szervezése több hónap is lehet, előfordulhat, hogy az indulás előtt a korábban jelentkezők közül néhányan visszamondják a részvételüket.
				Ebben az esetben a várólistán lévőket a jelentkezési sorrend alapján értesítjük, hogy van felszabadult hely.
				</p>
				<p>Pentaschool csapat</p>
			<?php }?>
			



        </div>
    </div>
	

</div>