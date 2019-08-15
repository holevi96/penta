<?php get_header(); ?>
    <!-- LISTING -->
    <div id="course-listing-page">
<?php include 'inc/menu.php';
$honapok = array();
$honapok[1] = 'Jan.';
$honapok[2] = 'Feb.';
$honapok[3] = 'Már.';
$honapok[4] = 'Ápr.';
$honapok[5] = 'Máj.';
$honapok[6] = 'Jún.';
$honapok[7] = 'Júl.';
$honapok[8] = 'Aug.';
$honapok[9] = 'Szep.';
$honapok[10] = 'Okt.';
$honapok[11] = 'Nov.';
$honapok[12] = 'Dec.';
$honapok_teljes = array();
$honapok_teljes[1] = 'Január';
$honapok_teljes[2] = 'Február';
$honapok_teljes[3] = 'Március';
$honapok_teljes[4] = 'Április';
$honapok_teljes[5] = 'Május';
$honapok_teljes[6] = 'Június';
$honapok_teljes[7] = 'Július';
$honapok_teljes[8] = 'Augusztus';
$honapok_teljes[9] = 'Szeptember';
$honapok_teljes[10] = 'Október';
$honapok_teljes[11] = 'November';
$honapok_teljes[12] = 'December';
?>
        <style>
            .list-view{
                height:50px !important;
            }
        </style>

    <div class="course-listing" class="body">

    <div class="course-filter">
        <ul id="pentafilter-aktiv">
            <li>Válassz feltételt!</li>
            <li class="pentafilter" termName="tanf">Összes</li>
            <li class="pentafilter" termName="aktiv">Van időpontja</li>
        </ul>

        <ul id="pentafilter-box">
            <li>Válassz kategóriát!</li>
            <li class="pentafilter" termName="tanf">Összes</li>

            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC'
            ));

            foreach ($categories as $category) { ?>
                <li class="pentafilter" termName="<?php echo $category->slug; ?>"><?php echo $category->name; ?></li>
            <?php } ?>

        </ul>

    </div>

    <div class="pnt-container" id="home-courses">
    <ul class="active-course">

    <h2 class="p-section-title">Az összes tanfolyam</h2>
    <li style="visibility:hidden;display:none;" class="tanf notfound" visible="none">
        <div class="list-view">
            <div class="date">

            </div>
            <div>
                <span class="category-tag adatbazis">Nincs találat</span>
                <h2>A keresett kategóriában jelenleg nincs tervezett tanfolyamunk!</h2>
            </div>
            <div>
                <h3></h3>
                <h3></h3>
            </div>
        </div>
    </li>
<?php

$args_cat = [
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => 0,
];

$categories = get_categories($args_cat);
//print_r($categories);
$firstPosts = array();
if (!empty($categories)):
    foreach ($categories as $category):
        $args = [
            'post_type' => 'tanfolyamok',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'title',
            'cat' => $category->term_id,
            'post__not_in' => $firstPosts
        ];

        $query = new WP_Query($args);
        while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $firstPosts[] = get_the_ID();
            $cat_slug = get_the_category(get_the_ID())[0]->slug;
            $cat_name = get_the_category(get_the_ID())[0]->name;
            $kiirasok = get_posts(array(
            'post_type' => 'tanfolyam-kiiras',
            'meta_query' => array(
            array(
            'key' => 'kapcsolodo_tanf', // name of custom field
            'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
            'compare' => 'LIKE'
            )
            )

            ));
            $kapcs_tanf = get_the_ID();
            $kiiras = $kiirasok[0];


            $cat_name = get_the_category($kapcs_tanf)[0]->name;
            $cat_slug = get_the_category($kapcs_tanf)[0]->slug;
            $listaar = get_field('listaar', $kapcs_tanf);
            $date = get_field('kezdes', $kiiras->ID);
            $date = substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
            $akcios = get_field('akcios_ar', $kiiras->ID);
            $van_e_akcio = false;
            $max = get_field('maximum_letszam', $kiiras->ID);
            $min = get_field('minimum_letszam', $kiiras->ID);
            $beiratkozva = get_field('beiratkozva', $kiiras->ID);
            $is_full = ($max == $beiratkozva);
            $is_ceges = get_field('ceges_megrendeles', $kapcs_tanf);
            $biztosan_indul = ($beiratkozva >= $min);
            $szazalek = 0;
            if ($akcios < $listaar) {
            $van_e_akcio = true;
            $szazalek = round((1 - ($akcios / $listaar)) * 100);
            }
            $napszak = get_field('napszak', $kiiras->ID);
            $rovid_leiras = get_field('rovid_leiras', $kapcs_tanf);

            ?>
            <li class="expand" termName="tanf <?php foreach ((get_the_terms($kapcs_tanf, 'category')) as $term) {
                echo $term->slug . ' ';
            } ?> <?php echo get_field('napszak', $kiiras->ID); ?>">

                <div class="list-view">
                    <div class="date">
                        <?php
                        if ($date) {
                            echo $honapok[date('n', strtotime($date))] . ' ' . date('j', strtotime($date));
                        } else if ($is_ceges) {
                            echo '<i class="material-icons">business</i>';
                        } else {
                            //'naptar_athuzva';
                        }
                        ?>
                    </div>
                    <div class="title">
                        <h2><?php echo get_post($kapcs_tanf)->post_title; ?></h2>
                        <span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span>
                    </div>

                    <div>
                        <?php if ($date) { ?>
                            <div>
                                <div class="price">
                                    <?php if ($van_e_akcio): ?>
                                        <div class="discount-label"><?php echo $szazalek; ?>%</div>
                                        <h4 class="discounted"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h4>
                                        <h3 class="final-price"><?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</h3>
                                    <?php else: ?>
                                        <h3><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="spots">
                                <h3><?php echo ($is_full) ? '<i class="material-icons">info</i>Betelt!' : $max - $min . ' hely van még!'; ?></h3>
                            </div>
                        <?php } else if ($is_ceges) { ?>
                            <div>
                                <h3 class="ceges"><i class="material-icons">business</i>Céges megrendelésre!</h3>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="opener">+</div>
                </div>

                <div class="quick-view">
                    <div class="closer">></div>
                    <div class="date desktop">
                        <div>
                            <?php if ($date) { ?>
                                <h4><?php echo date('Y', strtotime($date)); ?></h4>
                                <h3><?php echo $honapok_teljes[date('n', strtotime($date))]; ?></h3>
                                <h2><?php echo date('j', strtotime($date)); ?></h2>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="date mobile">
                        <h3><?php echo $honapok[date('n', strtotime($date))]; ?></h3>
                        <h2><?php echo date('j', strtotime($date)); ?></h2>
                    </div>
                    <div class="content">
                        <div class="fullwidth title">
                            <h2><?php echo get_post($kapcs_tanf)->post_title; ?></h2>
                            <a class="desktop" href="/tanfolyamok?termname=<?php echo $cat_slug; ?>"><span class="category-tag <?php echo $cat_slug; ?>"><?php echo $cat_name; ?></span></a>
                        </div>
                        <?php if($date): ?>
                            <div class="fullwidth details clearfix">
                                <?php
                                if ($napszak == 'esti') {
                                    ?>
                                    <h2>
                                        <i class="material-icons">brightness_3</i>
                                        <span>Esti</span>

                                    </h2>
                                <?php } else { ?>
                                    <h2>
                                        <i class="material-icons">brightness_7</i>
                                        <span>Nappali</span>

                                    </h2>
                                <?php }
                                ?>
                                <h2>Óraszám: <?php echo $oraszam; ?></h2>
                                <h2 class="szabad"><?php echo (!$is_full) ? 'Szabad helyek: ' . ($max - $beiratkozva) . ' fő' : 'Betelt! <i class="material-icons">info</i>'; ?></h2>

                                <?php if ($biztosan_indul): ?>
                                    <h2 class="biztos">
                                        <span>Biztosan indul!</span>
                                        <i class="material-icons">done</i>
                                    </h2>
                                <?php else: ?>
                                    <h2 class="szervezes">
                                        <span><span>Még <b><?php echo $min - $beiratkozva; ?></b> fő kell az induláshoz!</span></span>
                                        <i class="material-icons">access_time</i>
                                    </h2>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="short_description desktop">
                            <?php

                            if (strlen($rovid_leiras) > 0) {
                                echo $rovid_leiras;
                            } else {
                                echo get_post($kapcs_tanf)->post_content;
                            }
                            ?>
                        </div>
                        <div class="short_description mobile">
                            <?php
                            if (strlen($rovid_leiras) > 0) {
                                $text = $rovid_leiras;
                            } else {
                                $text = get_post($kapcs_tanf)->post_content;
                            }
                            $text = strip_shortcodes($text);
                            $text = apply_filters('the_content', $text);
                            $text = str_replace(']]>', ']]&gt;', $text);
                            $excerpt_length = apply_filters('excerpt_length', 18);
                            $excerpt_more = apply_filters('excerpt_more', ' ' . '&hellip;');
                            $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
                            echo $text;
                            ?>
                        </div>
                        <div class="fullwidth">

                            <div class="buttons">
                                <?php if(!$date):?>
                                    <h3>Nincs aktuális időpont!</h3>
                                <?php endif; ?>
                                <div>
                                    <?php if ($date): ?>
                                        <?php if ($van_e_akcio): ?>
                                            <h2 class="final-price">Ár: <?php echo number_format($akcios, 0, ',', ' '); ?> Ft.</h2>
                                            <h4 class="discounted desktop"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h4>
                                        <?php else: ?>
                                            <h2 class="final-price"><?php echo number_format($listaar, 0, ',', ' '); ?> Ft.</h2>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <a href="<?php echo get_permalink($kapcs_tanf); ?>?ID=<?php echo $kiiras->ID; ?>" class="p-button ghost white medium">Részletek</a>
                                    <?php if(!$is_full && $date){ ?>
                                        <a href="<?php echo get_permalink($kapcs_tanf). '?jelentkezes&ID='.$kiiras->ID; ?>?jelentkezes" class="p-button orange medium">Jelentkezés</a>
                                    <?php }else if($is_full && $date){ ?>
                                        <a href="<?php echo get_permalink($kapcs_tanf). '?varolista&ID='.$kiiras->ID; ?>?jelentkezes" class="p-button orange medium">Várólistára jelentkezés</a>
                                    <?php }else if(!$date && !$ceges){ ?>
                                        <a href="<?php echo get_permalink($kapcs_tanf) ?>'?erdeklodes" class="p-button orange medium">Érdeklődés</a>
                                    <?php }else if(!$date && $ceges){ ?>
                                        <a href="<?php echo get_permalink($kapcs_tanf) ?>'?ceg" class="p-button orange medium">Céges megrendelés</a>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <div class="mobilinfo fullwidth">
                            <?php if ($biztosan_indul): ?>
                                <h2 class="biztos">
                                    <span>Biztosan<br>indul!</span>
                                    <i class="material-icons">done</i>
                                </h2>
                            <?php else: ?>
                                <h2 class="szervezes">
                                    <span>Még <b><?php echo $min - $beiratkozva; ?></b> fő<br> kell az<br> induláshoz!</span>

                                </h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endwhile;
        endforeach;endif;
 ?>

    </ul>
    </div>
    </div>
    </div>
    <?php get_footer(); ?>