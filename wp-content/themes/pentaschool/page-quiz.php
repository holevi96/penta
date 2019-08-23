<?php get_header(); the_post();?>
    <div id="single-page" class="body single-page">

        <?php include 'inc/menu.php'; ?>



        <div class="pnt-container">
            <div class="page-content wyswyg-content">
                <?php if(isset($_GET['quiz_id'])){
                    $ID = $_GET['quiz_id'];
                    echo do_shortcode('[gravityform id="' . $ID .'" title="true" description="true" ajax="false"]');
                } ?>

            </div>
        </div>

    </div>
<?php get_footer(); ?>