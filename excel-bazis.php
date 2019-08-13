<?php 
	// Get the JSON
	define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
	require( './wp-load.php' );
		$json = wp_remote_get('http://excel-bazis.hu/wp-json/wp/v2/topic?per_page=5');
							
		// Convert the JSON to an array of posts
		ob_start();
		$posts = json_decode($json['body']);?>
		<?php if($posts): ?>
		<ul>
			<?php foreach ($posts as $p) { ?>
				<li><a href="<?php echo $p->link; ?>"><?php echo $p->title->rendered ?></a></li>
			<?php } ?>
		</ul>
		<?php endif; 
		$output = ob_get_contents();
		ob_end_clean();
							
		file_put_contents('excel-bazis.txt', $output);
?>