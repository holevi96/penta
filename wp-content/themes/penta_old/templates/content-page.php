<section class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
