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
	'/batch-user-create.php',                             // Load batch import.	
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}



/*TABLE STUFF FOR REPORTING*/
function average_score($array) {
	if($array){
		return number_format(array_sum($array) / count($array), 2);
	}
   else {
   	return 'N/A';
   }
}

function count_no_score($array, $count) {
	if($array){
		$answers = count($array);
		$no_response = number_format($count - $answers,0);
		return $no_response;
	}
   else {
   	return 0;
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

function support_basic_avg($field,$post_id, &$avg){
	if(get_field($field, $post_id)){
		$assg_1 = get_field($field, $post_id);
		array_push($avg, $assg_1);
	}
}


function no_repsonse_avg($avg, $stu){
	$returned = number_format(count($avg) / $stu, 2)* 100 ;
	$not = 100 - $returned;
	return $not . '%';
}


function average_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
	return '<tr class="average-row totals"><td>Average</td><td>' . 
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

function count_no_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $count){
	//count_no_score($array, $count)
	return '<tr class="count-row none"><td>Quantity No Response</td><td>' . 
			count_no_score($avg_1, $count) . '</td><td>' . 
			count_no_score($avg_2, $count) . '</td><td>' . 
			count_no_score($avg_3, $count). '</td><td>' . 
			count_no_score($avg_4, $count) . '</td><td>' . 
			count_no_score($avg_5, $count) . '</td><td>' . 
			count_no_score($avg_6, $count) . '</td><td>' . 
			count_no_score($avg_7, $count) . '</td><td>' . 
			count_no_score($avg_8, $count) . '</td><td>' . 
			count_no_score($avg_9, $count) . '</td><td>' . 
			count_no_score($avg_10, $count) . '</td><td>' . 
			count_no_score($avg_11, $count) . '</td><td>' . 
			count_no_score($avg_12, $count) . '</td><td>' . 
			count_no_score($avg_13, $count) . '</td><td>' . 
			count_no_score($avg_14, $count) . '</td><td>' . 
			count_no_score($avg_15, $count) . '</td><td>' . 
			count_no_score($avg_16, $count) . '</td><td>' . 
			count_no_score($avg_17, $count) . '</td><td>' . 
			count_no_score($avg_18, $count) . '</td></tr>';
}


function average_no_response($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $total_students){
	return '<tr class="average-row none"><td>Average No Response</td><td>' . 
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


/*USER CREATION*/

//create user type ALN AUTHOR
function support_matrix_update_custom_roles() {
    if ( get_option( 'custom_roles_version' ) < 1 ) {
        add_role( 'sm_student', 'Student', get_role( 'author' )->capabilities  );
        update_option( 'custom_roles_version', 1 );
    }
}
add_action( 'init', 'support_matrix_update_custom_roles' );

function support_matrix_get_current_user_roles() {
 if( is_user_logged_in() ) {
   $user = wp_get_current_user();
   $roles = ( array ) $user->roles;
   return $roles; // This returns an array
   // Use this to return a single value
   // return $roles[0];
 } else {
 return array();
 }
}




//restrict posts to  author level to only the posts they wrote
function support_matrix_posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'manage_options' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'support_matrix_posts_for_current_author');


add_action('after_setup_theme', 'support_matrix_remove_admin_bar');
 
function support_matrix_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}


//redirect support_matrix authors
function support_matrix_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'sm_student', $user->roles ) ) {        	
        	 return home_url().'/' . $user->user_login; //need to set redirect path !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        } else {
        	return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'support_matrix_login_redirect', 10, 3 );

//create page for new users if they're sm_student

function support_matrix_make_page($user_id){
	 $user = get_userdata( $user_id );
	  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'sm_student', $user->roles ) ) { 
        	 $args = array(
			  'post_title'    =>  $user->user_login,
			  'post_author'   => $user_id,
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_type' => 'student'
			   );
			   wp_insert_post( $args );
        }
    }

}

add_action( 'add_user_to_blog', 'support_matrix_make_page' );



//make the area to upload the CSV for student creation
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Student Import',
		'menu_title'	=> 'Student Import',
		'menu_slug' 	=> 'support-matrix-student-import',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
}

//$variable = get_field('field_name', 'option');
add_action('acf/save_post', 'support_matrix_process_file', 'option');
function support_matrix_process_file( $post_id ) {

    // Get previous values.
    $prev_values = get_fields( $post_id );

    // Get submitted values.
    $values = $_POST['acf']['field_5f47bbd0010c8'];
    //write_log(wp_get_attachment_url($values));
   Users_Import_Batch::setup( wp_get_attachment_url($values));
}

//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

  //print("<pre>".print_r($a,true)."</pre>");

