<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=KoHo:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
    <meta charset="UTF-8">
    <title><?php wp_title( '·',TRUE,'right' ); bloginfo( 'name' );?></title>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <!-- STYLESHEETS -->
    <!--<link rel="stylesheet" type="text/css" media="all" href="dist/proto.min.css"/>-->
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/proto.min.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/icons.css" />
    <!-- TYPOGRAPHY -->
    
  
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<style>
<?php
                    $categories = get_categories(array(
                        'orderby' => 'name',
                        'order' => 'ASC'
                    ));

                    foreach ($categories as $category) { if($category->slug != "egyeb"):?>
					span.<?php echo $category->slug; ?> {
						color: <?php echo get_field("szin",$category); ?>
					}
					<?php endif; } ?>
</style>