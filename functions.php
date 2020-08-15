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

function avg_of_score($score, $array){
	if($array){
		$count = array_count_values($array);
		$array_size = count($array);
		if (array_key_exists($score, $count)){
			return number_format($count[$score] / $array_size, 2)* 100 . '%';	
		} else {
			return 'N/A';
		}
	} else {
		return 'N/A';
	}
}


function no_repsonse_avg($avg, $stu){
	$returned = number_format(count($avg) / $stu, 2)* 100 ;
	$not = 100 - $returned;
	return $not . '%';
}


function average_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
	return '<tr class="average-row"><td>Average</td><td>' . 
			average_score($avg_1) . '</td><td>' . 
			average_score($avg_2) . '</td><td>' . 
			average_score($avg_3). '</td><td>' . 
			average_score($avg_4) . '</td><td>' . 
			average_score($avg_5) . '</td><td>' . 
			average_score($avg_6) . '</td><td>' . 
			average_score($avg_7) . '</td><td>' . 
			average_score($avg_8) . '</td><td>' . 
			average_score($avg_9) . '</td><td>' . 
			average_score($avg_10) . '</td><td>' . 
			average_score($avg_11) . '</td><td>' . 
			average_score($avg_12) . '</td><td>' . 
			average_score($avg_13) . '</td><td>' . 
			average_score($avg_14) . '</td><td>' . 
			average_score($avg_15) . '</td><td>' . 
			average_score($avg_16) . '</td><td>' . 
			average_score($avg_17) . '</td><td>' . 
			average_score($avg_18) . '</td></tr>';
}


function average_no_response($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $total_students){
	return '<tr class="count-row none"><td>Average No Response</td><td>' . 
			no_repsonse_avg($avg_1, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_2, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_3, $total_students). '</td><td>' . 
			no_repsonse_avg($avg_4, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_5, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_6, $total_students). '</td><td>' . 
			no_repsonse_avg($avg_7, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_8, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_9, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_10, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_11, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_12, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_13, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_14, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_15, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_16, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_17, $total_students) . '</td><td>' . 
			no_repsonse_avg($avg_18, $total_students) . '</td></tr>';
}


function count_of_scores($score, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
	return '<tr class="count-row count-'.$score.'"><td>Quantity of ' . $score . 's</td><td>' . 
		count_of_score($score,$avg_1) . '</td><td>' . 
		count_of_score($score,$avg_2) . '</td><td>' . 
		count_of_score($score,$avg_3). '</td><td>' . 
		count_of_score($score,$avg_4) . '</td><td>' . 
		count_of_score($score,$avg_5) . '</td><td>' . 
		count_of_score($score,$avg_6) . '</td><td>' . 
		count_of_score($score,$avg_7) . '</td><td>' . 
		count_of_score($score,$avg_8) . '</td><td>' . 
		count_of_score($score,$avg_9) . '</td><td>' .
		count_of_score($score,$avg_10) . '</td><td>' . 		
		count_of_score($score,$avg_11) . '</td><td>' . 
		count_of_score($score,$avg_12) . '</td><td>' . 
		count_of_score($score,$avg_13). '</td><td>' . 
		count_of_score($score,$avg_14) . '</td><td>' . 
		count_of_score($score,$avg_15) . '</td><td>' . 
		count_of_score($score,$avg_16) . '</td><td>' . 
		count_of_score($score,$avg_17) . '</td><td>' . 
		count_of_score($score,$avg_18) . '</td></tr>';
}

function average_of_scores($score, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
	return '<tr class="avg-row count-'.$score.'"><td>Average of ' . $score . 's</td><td>' . 
		avg_of_score($score,$avg_1) . '</td><td>' . 
		avg_of_score($score,$avg_2) . '</td><td>' . 
		avg_of_score($score,$avg_3). '</td><td>' . 
		avg_of_score($score,$avg_4) . '</td><td>' . 
		avg_of_score($score,$avg_5) . '</td><td>' . 
		avg_of_score($score,$avg_6) . '</td><td>' . 
		avg_of_score($score,$avg_7) . '</td><td>' . 
		avg_of_score($score,$avg_8) . '</td><td>' . 
		avg_of_score($score,$avg_9) . '</td><td>' .
		avg_of_score($score,$avg_10) . '</td><td>' . 		
		avg_of_score($score,$avg_11) . '</td><td>' . 
		avg_of_score($score,$avg_12) . '</td><td>' . 
		avg_of_score($score,$avg_13). '</td><td>' . 
		avg_of_score($score,$avg_14) . '</td><td>' . 
		avg_of_score($score,$avg_15) . '</td><td>' . 
		avg_of_score($score,$avg_16) . '</td><td>' . 
		avg_of_score($score,$avg_17) . '</td><td>' . 
		avg_of_score($score,$avg_18) . '</td></tr>';
}

