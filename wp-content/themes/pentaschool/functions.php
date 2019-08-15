<?php

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary_navigation', __( 'Primary Menu', 'theme-slug' ) );
}
add_theme_support( 'post-thumbnails' );

function penta_scripts() {
 global $post;
  wp_enqueue_script( 'pentafilter.js', get_stylesheet_directory_uri() . '/js/pentafilter.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'velocity.min.js', get_stylesheet_directory_uri() . '/js/velocity.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'main.js', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery' ), false, true );
  
 if(get_post_type( $post ) === "tanfolyamok" && is_singular()){
	wp_enqueue_style( 'flickity.css', get_stylesheet_directory_uri() . '/css/flickity.css', array( ), false, false );
	wp_enqueue_script( 'flickity.js', '//unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'single-tanfolyamok.js', get_stylesheet_directory_uri() . '/js/single-tanfolyamok.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'tematikajs.js', get_stylesheet_directory_uri() . '/js/tematikajs.js', array( 'jquery' ), false, true );

 }
 if(get_post($post)->post_name === "rolunk"){
     wp_enqueue_script( 'tematikajs.js', get_stylesheet_directory_uri() . '/js/tematikajs.js', array( 'jquery' ), false, true );
 }
}
add_action ('wp_enqueue_scripts', 'penta_scripts');


if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}
// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// remove version from scripts and styles
function remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'remove_version_scripts_styles', 9999);

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

function add_async_attribute($tag, $handle) {
    if ( 'main.js' == $handle  ||  'velocity.min.js' == $handle || 'single-tanfolyamok.js' == $handle){
		return str_replace( ' src', ' defer="defer" src', $tag );
	}else{
		return $tag;
	}
        
    
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Referencia Logo Slider');
    acf_add_options_page('Főoldali kiemelt kategóriák');
    acf_add_options_page('Footer menu');


}
// [inline_video foo="foo-value"]
function inline_video_func( $atts ) {
  $a = shortcode_atts( array(
      'text' => 'Video cím',
      'link' => 'https://www.youtube.com/embed/6p45ooZOOPo?autoplay=1',
  ), $atts );

  ob_start();
  ?>


    <!--<div class="container">
      <div class="row">-->
        <div class="col-md-6">
          <div class="video video-1 boxed boxed--lg imagebg text-center-xs" data-overlay="2">
            <div class="background-image-holder"> <img alt="background" src="<?php echo get_stylesheet_directory_uri(); ?>/img/agency-2.jpg"> </div>
            <div class="modal-instance">
              <div class="video-play-icon video-play-icon--sm modal-trigger"></div>
              <div class="modal-container">
                <div class="modal-content bg-dark" data-width="60%" data-height="60%"> <iframe data-src="<?php echo $a['link']; ?>" allowfullscreen="allowfullscreen"></iframe> </div>
              </div>
            </div>
            <h2><?php echo $a['text']; ?></h2>
          </div>
        </div>
      <!--</div>
    </div>-->

<?php
  $out1 = ob_get_clean();
  return $out1;
}
add_shortcode( 'inline_video', 'inline_video_func' );





add_filter( 'manage_tanfolyam-kiiras_posts_columns', 'set_custom_edit_book_columns_kiiras' );
add_action( 'manage_tanfolyam-kiiras_posts_custom_column' , 'custom_book_column_kiiras', 10, 2 );

add_filter( 'manage_tanfolyamok_posts_columns', 'set_custom_edit_book_columns_tanf' );
add_action( 'manage_tanfolyamok_posts_custom_column' , 'custom_book_column_tanf', 10, 2 );

function set_custom_edit_book_columns_kiiras($columns) {
  //unset( $columns['author'] );
  $columns['kezdes'] = __( 'Kezdés dátum', 'your_text_domain' );
  $columns['akcios_ar'] = __( 'Akciós ár', 'your_text_domain' );
  $columns['minimum_letszam'] = __( 'Minimum létszám', 'your_text_domain' );
  $columns['beiratkozva'] = __( 'Beiratkozva', 'your_text_domain' );
  

  return $columns;
}
function set_custom_edit_book_columns_tanf($columns) {
  //unset( $columns['author'] );
  $columns['listaar'] = 'Listaár';
  return $columns;
}

function custom_book_column_kiiras( $column, $post_id ) {
  if(get_field('ertekeltek_e_mar') == 1){
    $ert =  "Igen";
  }else{
    $ert = "Nem";
  }
  switch ( $column ) {

    case 'akcios_ar' :
      echo get_field('akcios_ar');

      break;
    case 'minimum_letszam' :
      echo get_field('minimum_letszam');

      break;
	case 'kezdes' :
      echo get_field('kezdes');

      break;
    case 'beiratkozva' :
      echo get_field('beiratkozva');
      break;
  }
}
function custom_book_column_tanf( $column, $post_id ) {

  switch ( $column ) {

    case 'listaar' :
      echo get_field('listaar');

      break;
  }
}
add_action( 'quick_edit_custom_box', 'display_custom_quickedit_book', 10, 2 );

function display_custom_quickedit_book( $column_name, $post_type ) {


  ?>
  <fieldset class="inline-edit-col-right inline-edit-book">
    <div class="inline-edit-col column-<?php echo $column_name; ?>">
      <label class="inline-edit-group">
        <?php
        switch ( $column_name ) {
          case 'akcios_ar':
            ?><span class="title">Akcios ár</span><input name="akcios_ar_input" type="number" /><?php
            break;
			case 'listaar':
            ?><span class="title">Listaár</span><input name="listaar_input" type="number" /><?php
            break;
          case 'minimum_letszam':
            ?><span class="title">Minimum létszám</span><input name="minimum_letszam_input" type="number" /><?php
            break;
          case 'beiratkozva':
            ?><span class="title">Beiratkozva</span><input name="beiratkozva_input" type="number" /><?php
            break;
         
        }
        ?>
      </label>
    </div>
  </fieldset>
  <?php
}

add_action( 'save_post', 'save_book_meta' );

function save_book_meta( $post_id ) {
  if ( isset( $_REQUEST['akcios_ar_input'] ) ) {
    update_post_meta( $post_id, 'akcios_ar', $_REQUEST['akcios_ar_input'] );
  }
  if ( isset( $_REQUEST['minimum_letszam_input'] ) ) {
    update_post_meta( $post_id, 'minimum_letszam', $_REQUEST['minimum_letszam_input'] );
  }
  if ( isset( $_REQUEST['beiratkozva_input'] ) ) {
    update_post_meta( $post_id, 'beiratkozva', $_REQUEST['beiratkozva_input'] );
  }

  if ( isset( $_REQUEST['listaar'] ) ) {
    update_post_meta( $post_id, 'listaar', $_REQUEST['listaar'] );
  }

}


add_action('admin_footer-edit.php', 'admin_edit_posttype_foot', 11);

/* load scripts in the footer */
function admin_edit_posttype_foot() {
  $slug = 'tanfolyam-kiiras';
  $slug2 = 'tanfolyamok';
// load only when editing a posttype
  if ( (isset($_GET['page']) && $_GET['page'] == $slug) || (isset($_GET['page']) && $_GET['page'] == $slug2)
      || (isset($_GET['post_type']) && $_GET['post_type'] == $slug) || (isset($_GET['post_type']) && $_GET['post_type'] == $slug2))
  {
    echo '
      <!--<script type="text/javascript" src="', plugins_url('scripts/admin_edit.js', __FILE__), '"></script>-->
      <script type="text/javascript">

      function quickEditPosttype() {
		  
        var $ = jQuery;
        var _edit = inlineEditPost.edit;
        inlineEditPost.edit = function(id) {
          var args = [].slice.call(arguments);
          _edit.apply(this, args);

          if (typeof(id) == \'object\') {
            id = this.getId(id);
          }
          //if (this.type == \'posttype\') {
          var
          // editRow is the quick-edit row, containing the inputs that need to be updated
          editRow = $(\'#edit-\' + id);
          // postRow is the row shown when a post isn\'t being edited, which also holds the existing values.
          postRow = $(\'#post-\'+id);
		  console.log(postRow)
          // get the existing values
          // the class ".column-custom_post_meta_column" is set in display_custom_quickedit_posttype


          akcios_ar_value = $(postRow).find(".column-akcios_ar" ).html();
          beiratkozva_value = $(postRow).find(".column-beiratkozva" ).html();
          minimum_letszam_value = $(postRow).find(".column-minimum_letszam" ).html();
          ertekeltek_e_value = $(postRow).find(".column-ertekeles" ).html();
		  
          listaar_value = $(postRow).find(".listaar" ).html();

          // set the values in the quick-editor
          $(editRow).find(\':input[name="akcios_ar_input"]\').val(akcios_ar_value);
          $(editRow).find(\':input[name="minimum_letszam_input"]\').val(minimum_letszam_value);
          $(editRow).find(\':input[name="beiratkozva_input"]\').val(beiratkozva_value);
		  
          $(editRow).find(\':input[name="listaar_input"]\').val(listaar_value);

		  
          //}
        };
      }

quickEditPosttype()
      </script>
    ';
  }
}
//show_admin_bar(false);
function repo_quick_edit_javascript() {
  global $current_screen;
  if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post')) return;
  ?>
  <?php
}


function populate_tanfolyam( $value ) {
  global $post;
  $kf = get_the_title($post->ID);
  return $kf;

}
add_filter( 'gform_field_value_tanfolyam', 'populate_tanfolyam' );
function populate_tanfolyamid( $value ) {
    global $post;
   
    return $post->ID;

}
add_filter( 'gform_field_value_tanfolyamid', 'populate_tanfolyamid' );

function populate_varolistas( $value ) {
    global $post;
	if(isset($_GET['varolista'])){
		return 'Igen';
	}else{
		return 'Nem';
	}
}
add_filter( 'gform_field_value_varolistas', 'populate_varolistas' );


function populate_napszak( $value ) {
    global $post;

    return get_field('napszak',$_GET['ID']);

}
add_filter( 'gform_field_value_napszak', 'populate_napszak' );

function populate_kezdes( $value ) {
  global $post;
  return get_field('kezdes',$_GET['ID']);

}
add_filter( 'gform_field_value_kezdes', 'populate_kezdes' );

function populate_kiirasid( $value ) {
  global $post;
  return $_GET['ID'];

}
add_filter( 'gform_field_value_kiirasid', 'populate_kiirasid' );


function populate_helyszin( $value ) {
    global $post;
    $h = get_field('helyszin',$_GET['ID']);
    return $h[0]->post_title;

}
add_filter( 'gform_field_value_helyszin', 'populate_helyszin' );

function populate_tavnyomtatott( $value ) {
    global $post;
	if(isset($_POST['input_5'])){
		return $_POST['input_5'];
	}

}
add_filter( 'gform_field_value_tavnyomtatott', 'populate_tavnyomtatott' );

function populate_ar( $value ) {
  global $post;
  
  $normal_ar = get_field('listaar',$post->ID);
  $akcios_ar = get_field('akcios_ar',$_GET['ID']);

  if($akcios_ar <= $normal_ar){
    return $akcios_ar;
  }else{
    return $normal_ar;
  }

}
add_filter( 'gform_field_value_ar', 'populate_ar' );


add_action( 'gform_pre_submission', 'pre_submission_handler' );
function pre_submission_handler( $form ) {

  //PC::tag($filename);
  $url = get_stylesheet_directory_uri() . "/pdf/jelentkezes_" . time() . ".pdf";
  $_POST['input_34'] = $url;
}



add_filter( 'gform_notification_1', 'notification_emails_from_list_field', 10, 3 );
function notification_emails_from_list_field( $notification, $form, $entry ) {
    // only change notification to address for this specific notification
    if ( $notification['name'] == 'Résztvevő értesítése' ) {
 
        $field_id   = 11; // the id of the list field
        $column_num = 2; // the number of column that holds the emails
 
        // get the $field object for the provided id
        $field = RGFormsModel::get_field( $form, $field_id );
 
        // check the field type as we only want the rest of the function to run if the field type is list
        if ( $field->get_input_type() != 'list' ) {
            return $notification;
        }
 
        // count the actual number of columns
        $column_count = count( $field->choices );
 
        if ( $column_count > 1 ) {
            // subtract 1 from column number as the choices array is zero based
            $column_num = $column_num - 1;
 
            // get the column label so we can use that as the key to the multi-column values
            $column = rgars( $field->choices, "{$column_num}/text" );
        }
 
        // get the list fields values from the $entry
        $list_values = unserialize( $entry[ $field_id ] );
        $emails      = array();
		$kapcs_email = $_POST['input_5'];
		
        foreach ( $list_values as $value ) {
            // get the emails for each row
            $email = isset( $column ) ? $value[ $column ] : $value;
            if ( GFCommon::is_valid_email( $email ) ) {
                $emails[] = $email;
            }
        }
		if (!in_array($kapcs_email, $emails))
		{
			$emails[] = $kapcs_email; 
		}
 
        // replace the to address with a comma separated list of emails
        $notification['to'] = GFCommon::implode_non_blank( ',', $emails );
		
		$tanfolyam_neve = $_POST['input_1'];
		$ID = $_POST['input_56'];
		$alkalmak_megadasa = get_field('alkalmak_megadasa',$ID);
		$pdf = $_POST['input_34'];
		$kezdet = get_field("kezdes",$ID);
		$vege = get_field("vege",$ID);
		if($kezdet == $vege){
			$vege = '';
		}else{
			$vege = ' -'.$vege;
		}
		$heti_beosztas = get_field('idobeosztas',$ID);
		$napi_beosztas = get_field('napi_beosztas',$ID);
		$tovabbi_napok = get_field('tovabbi_napok',$ID);
		$napok = '';
		foreach($tovabbi_napok as $tovabbi){
			$napok.=$tovabbi['tovabbi_nap'].', ';
		}
		$nev = $_POST['input_52'];
		$email = $_POST['input_5'];
		$telefon = $_POST['input_7'];
		$sznev = $_POST['input_16'];
		$sziranyito = $_POST['input_53'];
		$sztelepules = $_POST['input_18'];
		$szutca = $_POST['input_45'];
		$szhazszam = $_POST['input_47'];
		$szado = $_POST['input_19'];
		$megegyezik = $_POST['input_31'];
		$pnev = $_POST['input_22'];
		$piranyito = $_POST['input_54'];
		$ptelepules = $_POST['input_24'];
		$putca = $_POST['input_48'];
		$phazszam = $_POST['input_49'];
		$pado = $_POST['input_25'];
		
		$varolistas = ($_POST['input_57'] == 'Igen');
		if(!$varolistas){
			$cim = "Tanfolyami jelentkezés";
			$leiras = "Ezúton szeretnénk visszaigazolni tanfolyami jelentkezését. Weboldalunkon történő jelentkezése alapján biztosítjuk a helyét a következő tanfolyamunkon:";
			$keres = "";
		}else{
			$cim = "Várólistára jelentkezés";
			$leiras = "Az alábbiakban részletezett tanfolyam sajnos betelt.
						Kérésedre jelentkezésedet várólistára tettük.
						Mivel egy tanfolyam szervezése több hónap is lehet, előfordulhat, hogy az indulás előtt a korábban jelentkezők közül néhányan visszamondják a részvételüket.
						Ebben az esetben a várólistán lévőket a jelentkezési sorrend alapján értesítjük, hogy van felszabadult hely.<h2>Tanfolyam részletei:</h2>";
			$keres = "				<h2>Fontos kérés!</h2>
				<p>Amennyiben a tanfolyamon mégsem tudsz részt venni, kérjük, hogy mielőbb értesíts erről minket! </p>
				<ul>
				<li>A tanfolyamról esetleg lemaradó várakozókat tudunk behívni, vagy</li>
				<li>A lemondás miatt esetleg elmaradó tanfolyammal kapcsolatos egyéb teendőink adódhatnak</li>
				</ul>
				<p>Amennyiben a tanfolyamot bármilyen ok miatt nem tudjuk a kiírt időpontban indítani, a kezdés időpontját átütemezzük, melyről haladéktalanul értesíteni fogunk. 
				<br>A tanfolyam indulása előtt jelentkezünk még egy email-lel, amelyben kérjük majd, hogy erősítsd meg részvételi szándékodat, illetve részletes további információval szolgálunk.
				<br><br>Pentaschool csapat
				</p>";
		}
		
		$fizetes = $_POST['input_30'];
		$megj = $_POST['input_39'];
		
		
		$resztvevok = $_POST['input_11'];
				$pieces = array_chunk($resztvevok, 3);
		$r = "<ul>";
		
		foreach($pieces as $l){
			
				$r.='<li> - '. $l[0].', '.$l[1].', '.$l[2] .'</li>';
			
			
			
		}
		$r.='</ul>';
		
		$resztvevok_szama = count($resztvevok)/3;
		$netto_osszesen = ($resztvevok_szama)*$_POST['input_33'];
		$netto = number_format($netto_osszesen, 0, ',', ' ');
		$brutto = $netto_osszesen*1.27;
		$brutto = number_format($brutto, 0, ',', ' ');
		$atvetel = $_POST['input_58'];
		
		if($atvetel == "Távnyomtatott számla"){
			$tavnyomtatott = $_POST['input_59'].': ';
		}else{
			$tavnyomtatott = "";
		}
		$postazasi = '';
			if($megegyezik == 'Nem'){
				$postazasi = "<h3>Postázási adatok:</h3>
					<ul>
					<li>Cégnév: {$pnev}</li>
					<li>Cím: {$piranyito} {$ptelepules}, {$putca} {$phazszam}</li>
					<li>Adószám(cég esetén) {$pado}</li>
					</ul><hr>";
			}
			$megjegyzes = '';
			if($megj != ''){
				$megjegyzes = "<h3>Megjegyzések:</h3><p>{$megj}</p>";
			}
			
		if($alkalmak_megadasa == 'kezdet-veg'){
			$datum = '<ul><li>'.$kezdet . $vege.'</li><li>Időbeosztás: '.$heti_beosztas.'</li><li> Napi beosztás:'.$napi_beosztas.'</li></ul>';
		}else{
			$datum = $kezdet.', '.$napok.', '.$vege.', Napi beosztás: '.$napi_beosztas;
		}
		
		$plusz_info = get_field('plusz_info',$ID);
		$notification['subject'] = "Pentaschool - " . $cim;
        $notification['message'] = "<h1>Tisztelt {$nev}!</h1><p>{$leiras}</p><h3>Tanfolyam neve:</h3><span>{$tanfolyam_neve}</span>
		<h3>Dátum:</h3><span>{$datum}</span>
		<h3>Kapcsolattartó név:</h3><span>{$nev}<span>
		<h3>Kapcsolattartó email:</h3><span>{$email}</span>
		<h3>Kapcsolattartó telefonszáma:</h3> <span>{$telefon}</span>
		<h3>Résztvevők:</h3>
		{$r}
		<h3 class='osszesen_fizetendo'>{$resztvevok_szama} főre összesen fizetendő:</h3><span>Nettó: {$netto} Ft.</span> <div><h4 class='finalprice'>Bruttó: {$brutto} Ft.</h4></div>
		<h3>Fizetési mód:</h3><span>{$fizetes} - {$atvetel} {$tavnyomtatott}</span>
		<h3>Számlázási adatok:</h3>
		<ul>
		<li>Cégnév: {$sznev}</li>
		<li>Cím: {$sziranyito} {$sztelepules}, {$szutca} {$szhazszam}</li>
		<li>Adószám:(cég esetén) {$szado}</li>
		</ul>
		{$postazasi}
		{$megjegyzes}<hr>
		<h2>Egyéb információk:</h2>
		{$plusz_info}
		<p>Ha a jelentkezés vezetői engedélyezéshez kötött, akkor nyomtassa ki a jelentkezési lapot, és pecséttel, az engedélyező által aláírva, csatoltan küldje vissza nekünk</p>
		<a href='{$pdf}'>PDF link</a>
		{$keres}
		<br>Pentaschool csapat.";
        
    }

    return $notification;
}

add_filter( 'gform_validation_message', 'change_message', 10, 2 );
function change_message( $message, $form ) {
    return "<div class='validation_error'>Töltse ki a kötelező mezőket!</div>";
}

//require_once 'gravity-forms-view-entries.php';
require_once 'gw-require-list-columns.php';
//require_once 'gravity-forms-image-in-html.php';
new GWRequireListColumns( 1, 11, array( 1, 2 ) );
require_once 'vendor/autoload.php';
//PhpConsole\Helper::register();

use Dompdf\Dompdf;
add_filter( 'gform_pre_render_1', 'populate_html' );
function populate_html( $form ) {
  $resztvevo_e = isset($_POST['input_9_1']);
  ?>
  <script type="text/javascript">
    var kapcsolattartoNev = "<?php echo ($resztvevo_e)?$_POST['input_52']:""; ?>";
    var kapcsolattartoEmail = "<?php echo ($resztvevo_e)?$_POST['input_5']:""; ?>";
    var kapcsolattartoTelefon = "<?php echo ($resztvevo_e)?$_POST['input_7']:""; ?>";
    jQuery(document).bind('gform_post_render', function(){
<?php if($resztvevo_e): ?>
      jQuery("#field_1_11").find('input').eq(1).val(kapcsolattartoNev);
      jQuery("#field_1_11").find('input').eq(2).val(kapcsolattartoEmail);
      jQuery("#field_1_11").find('input').eq(3).val(kapcsolattartoTelefon);
<?php endif; ?>
    });

  </script>

  <?php
  global $post;
  //loop back through form fields to get html field (id 3 on my form) that we are populating with the data gathered above
  $nev=$email=$telefon=$sznev=$sziranyito=$sztelepules=$szutca=$szhazszam=$szado=$pnev=$piranyito=$ptelepules=$putca=$phazszam=$pado = 'asd';
	if(isset($_POST['input_52'])){
		$tanfolyam_neve = $_POST['input_1'];
		$ID = $_POST['input_56'];
		$alkalmak_megadasa = get_field('alkalmak_megadasa',$ID);
		$kezdet = get_field("kezdes",$ID);
		$vege = get_field("vege",$ID);
		if($kezdet == $vege){
			$vege = '';
		}else{
			$vege = ' -'.$vege;
		}
		$heti_beosztas = get_field('idobeosztas',$ID);
		$napi_beosztas = get_field('napi_beosztas',$ID);
		$tovabbi_napok = get_field('tovabbi_napok',$ID);
		$napok = '';
		foreach($tovabbi_napok as $tovabbi){
			$napok.=$tovabbi['tovabbi_nap'].', ';
		}
		$nev = $_POST['input_52'];
		$email = $_POST['input_5'];
		$telefon = $_POST['input_7'];
		$sznev = $_POST['input_16'];
		$sziranyito = $_POST['input_53'];
		$sztelepules = $_POST['input_18'];
		$szutca = $_POST['input_45'];
		$szhazszam = $_POST['input_47'];
		$szado = $_POST['input_19'];
		$megegyezik = $_POST['input_31'];
		$pnev = $_POST['input_22'];
		$piranyito = $_POST['input_54'];
		$ptelepules = $_POST['input_24'];
		$putca = $_POST['input_48'];
		$phazszam = $_POST['input_49'];
		$pado = $_POST['input_25'];
		
		
		
		$fizetes = $_POST['input_30'];
		$megj = $_POST['input_39'];
		
		$resztvevok = $_POST['input_11'];
		
		$resztvevok_szama = count($resztvevok)/3;
		$netto_osszesen = ($resztvevok_szama)*$_POST['input_33'];
		$netto = number_format($netto_osszesen, 0, ',', ' ');
		$brutto = $netto_osszesen*1.27;
		$brutto = number_format($brutto, 0, ',', ' ');
		$atvetel = $_POST['input_58'];
		
		if($atvetel == "Távnyomtatott számla"){
			$tavnyomtatott = $_POST['input_59'].': ';
		}else{
			$tavnyomtatott = "";
		}
		$postazasi = '';
			if($megegyezik == 'Nem'){
				$postazasi = "<h3>Postázási adatok:</h3>
					<ul>
					<li>Cégnév: {$pnev}</li>
					<li>Cím: {$piranyito} {$ptelepules}, {$putca} {$phazszam}</li>
					<li>Adószám(cég esetén) {$pado}</li>
					</ul><hr>";
			}
			$megjegyzes = '';
			if($megj != ''){
				$megjegyzes = "<h3>Megjegyzések:</h3><p>{$megj}</p>";
			}
			
		if($alkalmak_megadasa == 'kezdet-veg'){
			$datum = '<ul><li>'.$kezdet . $vege.'</li><li>Időbeosztás: '.$heti_beosztas.'</li><li> Napi beosztás:'.$napi_beosztas.'</li></ul>';
		}else{
			$datum = $kezdet.', '.$napok.', '.$vege.', Napi beosztás: '.$napi_beosztas;
		}
	}

  
	foreach( $form['fields'] as &$field ) {
		//get html field
		if ( $field->id == 29 ) {
		  //set the field content to the html
		  
		  $resztvevok = $field->content; // alapból be van állítva a 29es mezőre(HTML mező), hogy listázza ki a résztvevőket.
		  
			
			$field->content = "<h2>Jelentkezés összefoglalása:</h2><br>
			<h3>Tanfolyam neve:</h3><span>{$tanfolyam_neve}</span><hr>
			<h3>Dátum:</h3><span>{$datum}</span><hr>
			<h3>Kapcsolattartó név:</h3><span>{$nev}<span><hr>
				<h3>Kapcsolattartó email:</h3><span>{$email}</span><hr>
				<h3>Kapcsolattartó telefonszáma:</h3> <span>{$telefon}</span><hr>
				<h3>Résztvevők:</h3>
					{$resztvevok}<hr>
				<h3 class='osszesen_fizetendo'>{$resztvevok_szama} főre összesen fizetendő:</h3><span>Nettó: {$netto} Ft.</span> <div><h4 class='finalprice'>Bruttó: {$brutto} Ft.</h4></div><hr>
				<h3>Fizetési mód:</h3><span>{$fizetes} - {$atvetel} {$tavnyomtatott}</span><hr>	
				<h3>Számlázási adatok:</h3>
				<ul>
				<li>Cégnév: {$sznev}</li>
				<li>Cím: {$sziranyito} {$sztelepules}, {$szutca} {$szhazszam}</li>
				<li>Adószám:(cég esetén) {$szado}</li>
				</ul><hr>
				{$postazasi}
				
					{$megjegyzes}";
				
		}
		if ( $field->id == 55 ) {
			
			$field->content = "<h2 class='osszesen_fizetendo'>{$resztvevok_szama} főre összesen fizetendő:</h2><span>Nettó: {$netto} Ft.</span> <div><h4 class='finalprice'>Bruttó: {$brutto} Ft.</h4></div>";
			
		}

	}
  

  	

  //return altered form so changes are displayed
  return $form;
}
use mikehaertl\wkhtmlto\Pdf;

add_action( 'gform_after_submission_1', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {
 
    $ID = rgar( $entry, '56' );
	$beiratkozva = get_field('beiratkozva',$ID);
	$beiratkozva++;
	$varolistas = ($_POST['input_57'] == 'Igen');
	if(!$varolistas){
		update_field( 'beiratkozva', $beiratkozva, $ID );	
	}
	
}
add_filter( 'gform_entries_column_filter', 'change_column_data', 10, 5 );
function change_column_data( $value, $form_id, $field_id, $entry, $query_string ) {
    //only change the data when form id is 1 and field id is 2
    if ( $form_id == 1 && $field_id == 34 ) {
		return "<a href='{$value}'>PDF link</a>";
    }else{
		 return $value;
	}
    
}
add_action( 'gform_after_submission_1', 'generate_pdf', 10, 2 );
function generate_pdf( $entry, $form ) {
  //PC::tag($entry);
// reference the Dompdf namespace


  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  ob_start(); 
 		$tanfolyam_neve = $_POST['input_1'];
		$ID = $_POST['input_56'];
		$alkalmak_megadasa = get_field('alkalmak_megadasa',$ID);
		$kezdet = get_field("kezdes",$ID);
		$vege = get_field("vege",$ID);
		if($kezdet == $vege){
			$vege = '';
		}else{
			$vege = ' -'.$vege;
		}
		$heti_beosztas = get_field('idobeosztas',$ID);
		$napi_beosztas = get_field('napi_beosztas',$ID);
		$tovabbi_napok = get_field('tovabbi_napok',$ID);
		$napok = '';
		foreach($tovabbi_napok as $tovabbi){
			$napok.=$tovabbi['tovabbi_nap'].', ';
		}
		$nev = $_POST['input_52'];
		$email = $_POST['input_5'];
		$telefon = $_POST['input_7'];
		$sznev = $_POST['input_16'];
		$sziranyito = $_POST['input_53'];
		$sztelepules = $_POST['input_18'];
		$szutca = $_POST['input_45'];
		$szhazszam = $_POST['input_47'];
		$szado = $_POST['input_19'];
		$megegyezik = $_POST['input_31'];
		$pnev = $_POST['input_22'];
		$piranyito = $_POST['input_54'];
		$ptelepules = $_POST['input_24'];
		$putca = $_POST['input_48'];
		$phazszam = $_POST['input_49'];
		$pado = $_POST['input_25'];
		$fizetes = $_POST['input_30'];
		$megj = $_POST['input_39'];
		
		$atvetel = $_POST['input_58'];
		$varolistas = ($_POST['input_57'] == 'Igen');
		if($varolistas){
			$cim = "Várólistára jelentkezés";
		}else{
			$cim = "Tanfolyami jelentkezés";
		}
		
		if($atvetel == "Távnyomtatott számla"){
			$tavnyomtatott = $_POST['input_59'].': ';
		}else{
			$tavnyomtatott = "";
		}
		
		$resztvevok = $_POST['input_11'];
		$pieces = array_chunk($resztvevok, 3);
		$r = "<ul>";
		
		foreach($pieces as $l){
			
				$r.='<li> - '. $l[0].', '.$l[1].', '.$l[2] .'</li>';
			
			
			
		}
		$r.='</ul>';
		$resztvevok_szama = count($resztvevok)/3;
		$netto_osszesen = ($resztvevok_szama)*$_POST['input_33'];
		$netto = number_format($netto_osszesen, 0, ',', ' ');
		$brutto = $netto_osszesen*1.27;
		$brutto = number_format($brutto, 0, ',', ' ');
		
		$postazasi = '';
			if($megegyezik == 'Nem'){
				$postazasi = "<h3>Postázási adatok:</h3>
					<ul>
					<li>{$pnev} - {$piranyito} {$ptelepules}, {$putca} {$phazszam}</li>
					<li>Adószám(cég esetén) {$pado}</li>
					</ul><hr>";
			}
			$megjegyzes = '';
			if($megj != ''){
				$megjegyzes = "<h3>Megjegyzések:</h3><p>{$megj}</p>";
			}
			
		if($alkalmak_megadasa == 'kezdet-veg'){
			$datum = '<ul><li>'.$kezdet . $vege.'</li><li>Időbeosztás: '.$heti_beosztas.'</li><li> Napi beosztás:'.$napi_beosztas.'</li></ul>';
		}else{
			$datum = $kezdet.', '.$napok.', '.$vege.', Napi beosztás: '.$napi_beosztas;
		}
		$content = "<h2>{$cim}</h2>
			<h3>Tanfolyam neve:</h3><span>{$tanfolyam_neve}</span><hr>
			<h3>Dátum:</h3><span>{$datum}</span><hr>
			<h3>Kapcsolattartó:</h3><span>{$nev}, {$email}, {$telefon}<span><hr>
				<h3>Résztvevők:</h3>
					{$r}<hr>
				<h3 class='osszesen_fizetendo'>{$resztvevok_szama} főre összesen fizetendő:</h3><span>Nettó: {$netto} Ft.</span> <div><h4 class='finalprice'>Bruttó: {$brutto} Ft.</h4><span>{$fizetes} - {$atvetel} {$tavnyomtatott}</span></div><hr>
				
				<h3>Számlázási adatok:</h3>
				<ul>
				<li>{$sznev} - {$sziranyito} {$sztelepules}, {$szutca} {$szhazszam}</li>
				<li>Adószám:(cég esetén) {$szado}</li>
				</ul><hr>
				{$postazasi}
				
				{$megjegyzes}";		

		
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/proto.min.css"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=KoHo:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
	<style>
	body{
		font-family: DejaVu Sans !important;;
	}
		h3{
			font-family: DejaVu Sans !important;
			font-size:18px;
		}
		span{
			font-size:12px;
		}
		#alairas,#pecset{
			padding-top:20px;
			padding-bottom:50px;
			border-bottom:1px solid #888;
		}
		ul{
			list-style-type: circle;
		}
	</style>
	</head>
	<body>
		<br><br>
		<div class="pnt-container">
			<img style="width:200px;" src="data:image/png;base64,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"/>
			<?php echo $content; ?>	
			<table style="width:100%;text-align:center;" cellspacing="30">
			<tr>
			<td id="alairas">Aláírás helye</td>
			<td id="pecset">Pecsét helye</td>
			</tr>
			</table>
			<div class="jellap_footer">
				<p style="font-size:11px;line-height:20px;">Felhívjuk tisztelt figyelmét, hogy a kitöltött jelentkezési lap elküldését hivatalos részvételi szándéknak tekintjük. A jelentkezését a tanfolyam indulása előtti napon is lemondhatja. 
				Fenntartjuk a jogot a tanfolyam kezdeti időpontjának módosítására, melyről értesítjük. Amennyiben az új időpont nem felel meg Önnek, a tanfolyamtól következmény nélkül visszaléphet, a már befizette tandíjat teljes mértékben visszatérítjük.
				</p>
			</div>
		</div>
								
	</body>
	</html>
  <?php //require_once('penta-table.html');
  ?>
	
  <?php
  $content = ob_get_clean();
  $dompdf->loadHtml($content);

  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');

  // Render the HTML as PDF
  $dompdf->render();
  $output = $dompdf->output();
  $theme_url = rgar( $entry, '34' );

  $dir = dirname(dirname(dirname(__DIR__)));
  $x = explode('/', $theme_url);
  $pdf_name = $x[count($x)-1];
  $filename = $dir . "\\pdf\\".$pdf_name;
  $filename = str_replace('\\',"/",$filename);
 //
    // PC::debug($filename);
  file_put_contents($filename, $output);

}
add_action( 'gform_after_submission_7', 'varolista_save', 10, 2 );
function varolista_save($entry, $form){
  $entries = array();
  $entry[6] = substr($entry[5],0,-12);
  $entries[] = $entry;
  GFAPI::add_entries( $entries, 5 );
}

require_once("gw-gravity-forms-better-pre-submission-confirmation.php");


function populate_tanf( $value ) {
  global $post;
  return get_post(get_field('kapcsolodo_tanfolyam',$post->ID)[0])->post_title;


}
add_filter( 'gform_field_value_tanfolyam_fill', 'populate_tanf' );

function populate_kiiras( $value ) {
  global $post;
  return get_post(get_field('kapcsolodo_tanfolyam',$post->ID)[0])->post_title . ', ' . get_field('kezdes',$post->ID);


}
add_filter( 'gform_field_value_kiiras_fill', 'populate_kiiras' );
function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}
// Register and load the widget
function wpb_load_widget() {
    register_widget( 'excelbazis_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 //include('excelbazis_feed_creator.php');
// Creating the widget 
class excelbazis_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'excelbazis_widget', 
 
// Widget name will appear in UI
__('Excelbázis feed', 'wpb_widget_domain'), 
 
// Widget description
array( 'description' => __( 'A legujabb tutorialok', 'wpb_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
 
// This is where you run the code and display the output ?>

<?php
        $feed_content = file_get_contents('excelbazis_feed_html.txt',true);
        echo $feed_content;
     ?>
 ?>
<?php echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

add_filter('gform_progress_steps','custom_gforms_steps_html',10,3);
function custom_gforms_steps_html($progress_steps, $form, $page){
	$progress_steps = "<div id='gf_page_steps_{$form['id']}' class='sign-in-steps'>";
		$pages  = isset( $form['pagination']['pages'] ) ? $form['pagination']['pages'] : array();
		$step_names = "";
		for ( $i = 0, $count = sizeof( $pages ); $i < $count; $i ++ ) {
			$step_number    = $i + 1;
			$active_class   = $step_number == $page ? '  current' : '';
			$first_class    = $i == 0 ? ' ' : '';
			$last_class     = $i + 1 == $count ? ' ' : '';
			$complete_class = $step_number < $page ? '  done' : '';
			$previous_class = $step_number + 1 == $page ? ' ' : '';
			$next_class     = $step_number - 1 == $page ? ' ' : '';
			$pending_class  = $step_number > $page ? ' gf_step_pending' : '';
			$classes        = '' . $active_class . $first_class . $last_class . $complete_class . $previous_class . $next_class . $pending_class;

			$classes = GFCommon::trim_all( $classes );

			$progress_steps .= "<div id='gf_step_{$form['id']}_{$step_number}' class='{$classes}'>{$step_number}</div><span class='{$complete_class}'></span>";
			$step_names.= "<h2>{$pages[ $i ]}</h2>";
		}

		$progress_steps .= "</div><div class='step-names'>{$step_names}</div>";
		return $progress_steps;
}

