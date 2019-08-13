<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

function penta_scripts() {
  global $post;
  //wp_deregister_script('jquery');
  //wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', array(  ), null, true );
  if( get_post_type( $post ) === "tanfolyamok" && is_singular()){





  }else if(get_post_type( $post ) === "tanfolyam-kiiras" && is_singular()){
    wp_enqueue_script( 'granim.js', get_stylesheet_directory_uri() . '/js/granim.min.js', array( 'jquery' ), false, true );
  }
  else if(get_post_type( $post ) === "tanfolyamok" && is_archive()){
      wp_enqueue_script( 'isotope.min.js', get_stylesheet_directory_uri() . '/js/isotope.min.js', array( 'jquery' ), false, true );
      
      
      wp_enqueue_script( 'archive-tanfolyamok.js', get_stylesheet_directory_uri() . '/js/archive-tanfolyamok.js', array( 'jquery' ), false, true );
  }
  wp_enqueue_script( 'parallax.js', get_stylesheet_directory_uri() . '/js/parallax.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'smooth-scroll.min.js', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'scripts.js', get_stylesheet_directory_uri() . '/js/scripts.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'flickity.min.js', get_stylesheet_directory_uri() . '/js/flickity.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'custom.js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'velocity.min.js', get_stylesheet_directory_uri() . '/js/velocity.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'pentafilter.js', get_stylesheet_directory_uri() . '/js/pentafilter.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'awesomplete.min.js', get_stylesheet_directory_uri() . '/js/awesomplete.min.js', array( 'jquery' ), false, true );
  wp_enqueue_style( 'awesomplete.css', get_stylesheet_directory_uri() . '/css/awesomplete.css', array( ), false, false );

}
add_action ('wp_enqueue_scripts', 'penta_scripts');

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Referencia Logo Slider');


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





add_filter( 'manage_tanfolyam-kiiras_posts_columns', 'set_custom_edit_book_columns' );
add_action( 'manage_tanfolyam-kiiras_posts_custom_column' , 'custom_book_column', 10, 2 );

function set_custom_edit_book_columns($columns) {
  //unset( $columns['author'] );
  $columns['akcios_ar'] = __( 'Akciós ár', 'your_text_domain' );
  $columns['minimum_letszam'] = __( 'Minimum létszám', 'your_text_domain' );
  $columns['beiratkozva'] = __( 'Beiratkozva', 'your_text_domain' );
  $columns['ertekeles'] = __( 'Értékelték már?', 'your_text_domain' );

  return $columns;
}

function custom_book_column( $column, $post_id ) {
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
    case 'beiratkozva' :
      echo get_field('beiratkozva');
      break;
    case 'ertekeles' :
      echo $ert;
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
          case 'minimum_letszam':
            ?><span class="title">Minimum létszám</span><input name="minimum_letszam_input" type="number" /><?php
            break;
          case 'beiratkozva':
            ?><span class="title">Beiratkozva</span><input name="beiratkozva_input" type="number" /><?php
            break;
          case 'ertekeles':
            ?><span class="title">Értékelték már?</span>
            <select name="ertekeles_input">
              <option value="0">Nem</option>
              <option value="1">Igen</option>

            </select><?php
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
  if ( isset( $_REQUEST['ertekeles_input'] ) ) {
    update_post_meta( $post_id, 'ertekeltek_e_mar', $_REQUEST['ertekeles_input'] );
  }

}


add_action('admin_footer-edit.php', 'admin_edit_posttype_foot', 11);

/* load scripts in the footer */
function admin_edit_posttype_foot() {
  $slug = 'tanfolyam-kiiras';
// load only when editing a posttype
  if ( (isset($_GET['page']) && $_GET['page'] == $slug)
      || (isset($_GET['post_type']) && $_GET['post_type'] == $slug))
  {
    echo '
      <!--<script type="text/javascript" src="', plugins_url('scripts/admin_edit.js', __FILE__), '"></script>-->
      <script type="text/javascript">

      function quickEditPosttype() {
		  console.log("asd");
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

          // set the values in the quick-editor
          $(editRow).find(\':input[name="akcios_ar_input"]\').val(akcios_ar_value);
          $(editRow).find(\':input[name="minimum_letszam_input"]\').val(minimum_letszam_value);
          $(editRow).find(\':input[name="beiratkozva_input"]\').val(beiratkozva_value);
		  if(ertekeltek_e_value == "Igen"){
			   $(editRow).find(\':input[name="ertekeles_input"]\').find("option").eq(1).attr("selected",1)

		  }else{
			    $(editRow).find(\':input[name="ertekeles_input"]\').find("option").eq(0).attr("selected",1)
		  }
          //}
        };
      }

quickEditPosttype()
      </script>
    ';
  }
}
function repo_quick_edit_javascript() {
  global $current_screen;
  if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post')) return;
  ?>
  <?php
}


function populate_tanfolyam( $value ) {
  global $post;
  $kf = get_field('kapcsolodo_tanf',$post->ID);
  return get_post($kf[0])->post_title;

}
add_filter( 'gform_field_value_tanfolyam', 'populate_tanfolyam' );
function populate_tanfolyamid( $value ) {
    global $post;
    $kf = get_field('kapcsolodo_tanf',$post->ID);
    return get_post($kf[0])->ID;

}
add_filter( 'gform_field_value_tanfolyamid', 'populate_tanfolyamid' );
function populate_napszak( $value ) {
    global $post;

    return get_field('napszak',$post->ID);

}
add_filter( 'gform_field_value_napszak', 'populate_napszak' );

function populate_kezdes( $value ) {
  global $post;
  return get_field('kezdes',$post->ID);

}
add_filter( 'gform_field_value_kezdes', 'populate_kezdes' );



function populate_helyszin( $value ) {
    global $post;
    $h = get_field('helyszin',$post->ID);
    return $h[0]->post_title;

}
add_filter( 'gform_field_value_helyszin', 'populate_helyszin' );


function populate_ar( $value ) {
  global $post;
  $kf = get_field('kapcsolodo_tanfolyam',$post->ID);
  $normal_ar = get_field('listaar',$kf[0]);
  $akcios_ar = get_field('akcios_ar',$post->ID);

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

require_once 'gravity-forms-view-entries.php';
require_once 'gw-require-list-columns.php';
//require_once 'gravity-forms-image-in-html.php';
new GWRequireListColumns(1);
require_once 'vendor/autoload.php';
//PhpConsole\Helper::register();

use Dompdf\Dompdf;
add_filter( 'gform_pre_render_1', 'populate_html' );
function populate_html( $form ) {
  $resztvevo_e = isset($_POST['input_9_1']);
  ?>
  <script type="text/javascript">
    var kapcsolattartoNev = "<?php echo ($resztvevo_e)?$_POST['input_6_6']:""; ?>";
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
  foreach( $form['fields'] as &$field ) {
    //get html field
    if ( $field->id == 8 ) {
      //set the field content to the html
      $field->content = get_post(get_field('kapcsolodo_tanfolyam',$post->ID)[0])->post_title;
    }

  }

  //return altered form so changes are displayed
  return $form;
}
use mikehaertl\wkhtmlto\Pdf;


add_action( 'gform_after_submission_1', 'generate_pdf', 10, 2 );
function generate_pdf( $entry, $form ) {
  //PC::tag($entry);
// reference the Dompdf namespace


  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  ob_start();
  require_once('penta-table.html');
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


