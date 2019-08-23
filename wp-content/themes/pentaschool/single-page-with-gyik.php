<?php
/**
 * Template Name: Single Page with GYIK section
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


get_header(); the_post();?>
<div id="single-page" class="body single-page">

<?php include 'inc/menu.php'; ?>



    <div class="pnt-container">
        <div class="page-content wyswyg-content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
        </div>
    </div>

</div>
<div class="single-tanfolyamok">
    <?php  get_template_part('sections/section','faq'); ?>
</div>

<?php get_footer(); ?>