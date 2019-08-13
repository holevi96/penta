<?php get_header(); the_post();?>
<div id="single-page" class="body single-page">

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

    <div class="pnt-container">
        <div class="page-content wyswyg-content">
            <div class="row">
                <h1>Referenciáink</h1>
                <div class="col-md-3">
                    <div  class="input-select">
                        <select id='filterCat' style='display:inline-block' onchange='filterCat()'>
                            <option value='all'>Összes</option>
                            <option disabled selected>Kategória...</option>
                            <?php foreach ($cats as $cat) { ?>
                                <option value="<?php echo $cat; ?>"><?php echo $cat; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-select">
                        <select id='filterYear'  class="input-select" style='display:inline-block' onchange='filterYear()'>
                            <option value='all'>Összes</option>
                            <option disabled selected>Év...</option>
                            <?php foreach ($years as $year) { ?>
                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
                <br>
            </div>

								<table id="referenciak-table" class="border--round table--alternate-row">

                             <thead>
                             <tr>
                                 <th>Megrendelő</th>
                                 <th>Téma</th>
                                 <th>Év</th>
                                 <th>Létszám</th>
                                 <th>Kategória</th>
                             </tr>
                             </thead>
                             <tbody id="myTable">
                             <?php


                             foreach ($refs as $ref) {
                                 $cats[] = get_field('kategoria',$ref->ID);
                                 ?>
                                 <tr class="content">
                                     <td><?php echo get_field('megrendelo',$ref->ID); ?></td>
                                     <td><?php echo get_field('tema',$ref->ID); ?></td>
                                     <td class="ev"><?php echo get_field('ev',$ref->ID); ?></td>
                                     <td><?php echo get_field('letszam',$ref->ID); ?></td>
                                     <td class="kategoria"><?php echo get_field('kategoria',$ref->ID); ?></td>
                                 </tr>
                             <?php }
                             ?>
                             </tbody>
                         </table>
 
         <script>
             function filterYear()
             {
                 var rex = new RegExp(jQuery('#filterYear').val());
                 if(rex =="/all/"){
                     console.log(jQuery('#filterCat').val())
                     if(jQuery('#filterCat').val() == null || jQuery('#filterCat').val() == 'all'){
                         jQuery('.content').show()
                     }else{

                         rex = new RegExp(jQuery('#filterCat').val());
                         jQuery('.content').hide();
                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.kategoria').text());
                         }).show();
                     }
                 }else{
                     jQuery('.content').hide();
                     if(jQuery('#filterCat').val() == null || jQuery('#filterCat').val() == 'all'){
                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.ev').text());
                         }).show();

                     }else{

                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.ev').text());
                         }).filter(function(){
                             var rex = new RegExp(jQuery('#filterCat').val());
                             return rex.test(jQuery(this).find('td.kategoria').text());
                         }).show();
                     }
                 }
             }
             function filterCat()
             {
                 var rex = new RegExp(jQuery('#filterCat').val());
                 if(rex =="/all/"){
                     console.log(jQuery('#filterYear').val())
                     if(jQuery('#filterYear').val() == null || jQuery('#filterYear').val() == 'all'){
                         console.log('asdasdasd')
                         jQuery('.content').show()
                     }else{


                         console.log('as')
                         rex = new RegExp(jQuery('#filterYear').val());
                         jQuery('.content').hide();
                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.ev').text());
                         }).show();
                     }

                 }else{
                     if(jQuery('#filterYear').val() == null || jQuery('#filterYear').val() == 'all'){
                         jQuery('.content').hide();
                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.kategoria').text());
                         }).show();


                     }else{
                         jQuery('.content').hide();
                         jQuery('.content').filter(function() {
                             return rex.test(jQuery(this).find('td.kategoria').text());
                         }).filter(function(){
                             var rex = new RegExp(jQuery('#filterYear').val());
                             return rex.test(jQuery(this).find('td.ev').text());
                         }).show();
                     }

                 }
             }

         </script>
            <style>

            </style>
        </div>
    </div>
	

</div>
<?php get_footer(); ?>