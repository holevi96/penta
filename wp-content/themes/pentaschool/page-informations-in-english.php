<?php get_header(); the_post();?>
    <div id="single-page" class="body single-page">

        <?php include 'inc/menu.php'; ?>



        <div class="pnt-container">
            <div class="page-content wyswyg-content">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

            </div>

        </div>
        <?php $tanfok = get_field("kapcsolodo_tanfolyam"); ?>
        <div class="course-search-result course-listing kapcsolodo-tanfolyamok">
            <div class="pnt-container">
                <ul class="active-course">

                    <h2 class="p-section-title">Kapcsolódó tanfolyamok:</h2>
                    <?php
                    $tanfok = get_posts(array(
                        'post_type'=>"tanfolyamok",
                        'meta_query' => array(
                            array(
                                'key' => 'english', // name of custom field
                                'value' => true,
                                'compare' => '='
                            )
                        ),
                    ));
                    include( locate_template( 'tanf-simple-listing.php', false, false ) ); ?>
                </ul>
            </div>
        </div>
    </div>
<?php get_footer(); ?>