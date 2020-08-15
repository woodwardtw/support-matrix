<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/acf.php',                             // Load ACF functions.	
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}


function average_score($array) {
	if($array){
		return number_format(array_sum($array) / count($array), 2);
	}
   else {
   	return 'N/A';
   }
}

function count_of_score($score, $array){
	if($array){
		$count = array_count_values($array);
		if (array_key_exists($score, $count)){
			return $count[$score];	
		} else {
			return 'N/A';
		}
	} else {
		return 'N/A';
	}
}


// function average_support($assignment, $array, $post_id){
// 	if(get_field($assignment, $post_id)){
// 		$score = get_field($assignment, $post_id);
// 		array_push($array, $score);	
// 		var_dump($array);	
// 		//array_push($avg_3, $assg_3);
					
// 	}
// }