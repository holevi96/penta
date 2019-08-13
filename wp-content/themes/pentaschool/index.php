<?php get_header(); the_post();?>
<div id="single-page" class="body single-page">

<?php include 'inc/menu.php'; ?>



    <div class="pnt-container">
        <div class="page-content wyswyg-content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
        </div>
    </div>

</div>
<?php get_footer(); ?>