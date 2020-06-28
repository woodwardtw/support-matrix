<?php
/**
 * ACF Functions and CPTs
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



//ACF SAVE and LOAD JSON
add_filter('acf/settings/save_json', 'suport_matrix_json_save_point');
 
function alt_ee_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
    
}


add_filter('acf/settings/load_json', 'suport_matrix_json_load_point');

function alt_ee_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory()  . '/acf-json';
    
    
    // return
    return $paths;
    
}
