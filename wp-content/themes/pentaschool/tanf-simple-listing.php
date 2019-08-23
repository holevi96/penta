<?php
//$tanfok = get_query_var('tanfok');
foreach ($tanfok as $t) {
    $cat_slug = get_the_category($t->ID)[0]->slug;
    $cat_name = get_the_category($t->ID)[0]->name;
    $kiirasok = get_posts(array(
        'post_type' => 'tanfolyam-kiiras',
        'meta_query' => array(
            array(
                'key' => 'kapcsolodo_tanf', // name of custom field
                'value' => '"' . $t->ID . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
            )
        )

    ));
    $kapcs_tanf = $t->ID;
    $kiiras = $kiirasok[0];

    $link = ($kiiras)?  get_permalink($kapcs_tanf) ."?ID".$kiiras->ID:get_permalink($kapcs_tanf);
    $cat_name = get_the_category($kapcs_tanf)[0]->name;
    $cat_slug = get_the_category($kapcs_tanf)[0]->slug;
    $listaar = get_field('listaar',$kapcs_tanf);
    $date = get_field('kezdes',$kiiras->ID);
    $date = substr($date, 0, 4) . substr($date, 5, 2). substr($date, 8, 2);
    $akcios = get_field('akcios_ar', $kiiras->ID);
    $van_e_akcio = false;
    $max = get_field('maximum_letszam',$kiiras->ID);
    $min = get_field('minimum_letszam',$kiiras->ID);
    $beiratkozva = get_field('beiratkozva',$kiiras->ID);
    $is_full = ($max == $beiratkozva);
    $is_ceges = get_field('ceges_megrendeles',$kapcs_tanf);
    $is_english = get_field('english',$kapcs_tanf);
    $english_title = get_field('english_title',$kapcs_tanf);
    $biztosan_indul = ($beiratkozva>=$min);
    $szazalek = 0;
    if($akcios<$listaar){
        $van_e_akcio = true;
        $szazalek = round((1-($akcios / $listaar))*100);
    }
    $napszak = get_field('napszak', $kiiras->ID);
    $rovid_leiras = get_field('rovid_leiras',$kapcs_tanf);

    ?>
    <li class="expand" title="<?php echo get_post($kapcs_tanf)->post_title; ?>" termName="tanf <?php foreach ((get_the_terms($kapcs_tanf, 'category')) as $term) { echo $term->slug . ' '; } ?> <?php echo get_field('napszak',$kiiras->ID); echo ($date)?' aktiv':' passziv'; ?>">
        <a href="<?php echo $link; ?>">
            <div class="list-view">
                <div class="date">
                    <?php
                    if($date){
                        echo $honapok[date('n',strtotime($date))] . ' '. date('j',strtotime($date));
                    }else if($is_ceges){
                        echo '<i class="material-icons">business</i>';
                    }else{
                        'naptar_athuzva';
                    }
                    ?>
                </div>
                <div class="title">
                    <span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span>
                    <?php if(!$is_english){?>
                        <h2><?php echo get_post($kapcs_tanf)->post_title; ?></h2>
                    <?php }else{ ?>
                        <h2><?php echo $english_title; ?></h2>
                    <?php }?>

                </div>
                <?php if($date){ ?>
                    <div>
                        <div class="price">
                            <?php if($van_e_akcio): ?>
                                <div class="discount-label"><?php echo $szazalek; ?>%</div>
                                <h4 class="discounted"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h4>
                                <h3 class="final-price"><?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</h3>
                            <?php else: ?>
                                <h3><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h3>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="spots">
                        <h3><?php echo ($is_full)?'<i class="material-icons">info</i>Betelt!':$max - $beiratkozva . ' hely van még!';  ?></h3>
                    </div>
                <?php }else if($is_ceges){ ?>
                    <div>
                        <h3 class="ceges"><i class="material-icons">business</i>Céges megrendelésre!</h3>
                    </div>
                <?php } ?>
            </div>
        </a>


    </li>


<?php } ?>