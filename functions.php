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


// function average_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
// 	return '<tr class="average-row totals"><td>Average</td><td>' . 
// 			average_score($avg_1) . '</td><td>' . 
// 			average_score($avg_2) . '</td><td>' . 
// 			average_score($avg_3). '</td><td>' . 
// 			average_score($avg_4) . '</td><td>' . 
// 			average_score($avg_5) . '</td><td>' . 
// 			average_score($avg_6) . '</td><td>' . 
// 			average_score($avg_7) . '</td><td>' . 
// 			average_score($avg_8) . '</td><td>' . 
// 			average_score($avg_9) . '</td><td>' . 
// 			average_score($avg_10) . '</td><td>' . 
// 			average_score($avg_11) . '</td><td>' . 
// 			average_score($avg_12) . '</td><td>' . 
// 			average_score($avg_13) . '</td><td>' . 
// 			average_score($avg_14) . '</td><td>' . 
// 			average_score($avg_15) . '</td><td>' . 
// 			average_score($avg_16) . '</td><td>' . 
// 			average_score($avg_17) . '</td><td>' . 
// 			average_score($avg_18) . '</td></tr>';
// }

// function count_no_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $count){
// 	//count_no_score($array, $count)
// 	return '<tr class="count-row none"><td>Quantity No Response</td><td>' . 
// 			count_no_score($avg_1, $count) . '</td><td>' . 
// 			count_no_score($avg_2, $count) . '</td><td>' . 
// 			count_no_score($avg_3, $count). '</td><td>' . 
// 			count_no_score($avg_4, $count) . '</td><td>' . 
// 			count_no_score($avg_5, $count) . '</td><td>' . 
// 			count_no_score($avg_6, $count) . '</td><td>' . 
// 			count_no_score($avg_7, $count) . '</td><td>' . 
// 			count_no_score($avg_8, $count) . '</td><td>' . 
// 			count_no_score($avg_9, $count) . '</td><td>' . 
// 			count_no_score($avg_10, $count) . '</td><td>' . 
// 			count_no_score($avg_11, $count) . '</td><td>' . 
// 			count_no_score($avg_12, $count) . '</td><td>' . 
// 			count_no_score($avg_13, $count) . '</td><td>' . 
// 			count_no_score($avg_14, $count) . '</td><td>' . 
// 			count_no_score($avg_15, $count) . '</td><td>' . 
// 			count_no_score($avg_16, $count) . '</td><td>' . 
// 			count_no_score($avg_17, $count) . '</td><td>' . 
// 			count_no_score($avg_18, $count) . '</td></tr>';
// }


// function average_no_response($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $total_students){
// 	return '<tr class="average-row none"><td>Average No Response</td><td>' . 
// 			no_repsonse_avg($avg_1, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_2, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_3, $total_students). '</td><td>' . 
// 			no_repsonse_avg($avg_4, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_5, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_6, $total_students). '</td><td>' . 
// 			no_repsonse_avg($avg_7, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_8, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_9, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_10, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_11, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_12, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_13, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_14, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_15, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_16, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_17, $total_students) . '</td><td>' . 
// 			no_repsonse_avg($avg_18, $total_students) . '</td></tr>';
// }


// function count_of_scores($score, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
// 	return '<tr class="count-row count-'.$score.'"><td>Quantity of ' . $score . 's</td><td>' . 
// 		count_of_score($score,$avg_1) . '</td><td>' . 
// 		count_of_score($score,$avg_2) . '</td><td>' . 
// 		count_of_score($score,$avg_3). '</td><td>' . 
// 		count_of_score($score,$avg_4) . '</td><td>' . 
// 		count_of_score($score,$avg_5) . '</td><td>' . 
// 		count_of_score($score,$avg_6) . '</td><td>' . 
// 		count_of_score($score,$avg_7) . '</td><td>' . 
// 		count_of_score($score,$avg_8) . '</td><td>' . 
// 		count_of_score($score,$avg_9) . '</td><td>' .
// 		count_of_score($score,$avg_10) . '</td><td>' . 		
// 		count_of_score($score,$avg_11) . '</td><td>' . 
// 		count_of_score($score,$avg_12) . '</td><td>' . 
// 		count_of_score($score,$avg_13). '</td><td>' . 
// 		count_of_score($score,$avg_14) . '</td><td>' . 
// 		count_of_score($score,$avg_15) . '</td><td>' . 
// 		count_of_score($score,$avg_16) . '</td><td>' . 
// 		count_of_score($score,$avg_17) . '</td><td>' . 
// 		count_of_score($score,$avg_18) . '</td></tr>';
// }

// function average_of_scores($score, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18){
// 	return '<tr class="avg-row count-'.$score.'"><td>Average of ' . $score . 's</td><td>' . 
// 		avg_of_score($score,$avg_1) . '</td><td>' . 
// 		avg_of_score($score,$avg_2) . '</td><td>' . 
// 		avg_of_score($score,$avg_3). '</td><td>' . 
// 		avg_of_score($score,$avg_4) . '</td><td>' . 
// 		avg_of_score($score,$avg_5) . '</td><td>' . 
// 		avg_of_score($score,$avg_6) . '</td><td>' . 
// 		avg_of_score($score,$avg_7) . '</td><td>' . 
// 		avg_of_score($score,$avg_8) . '</td><td>' . 
// 		avg_of_score($score,$avg_9) . '</td><td>' .
// 		avg_of_score($score,$avg_10) . '</td><td>' . 		
// 		avg_of_score($score,$avg_11) . '</td><td>' . 
// 		avg_of_score($score,$avg_12) . '</td><td>' . 
// 		avg_of_score($score,$avg_13). '</td><td>' . 
// 		avg_of_score($score,$avg_14) . '</td><td>' . 
// 		avg_of_score($score,$avg_15) . '</td><td>' . 
// 		avg_of_score($score,$avg_16) . '</td><td>' . 
// 		avg_of_score($score,$avg_17) . '</td><td>' . 
// 		avg_of_score($score,$avg_18) . '</td></tr>';
// }



function get_student_meta($lecture, $assignment_name){
	global $post;
	$post_id = $post->ID;
	$clean_assignment = sanitize_title($assignment_name);
	$meta = $lecture . '-' . $clean_assignment;
	$status = get_post_meta($post_id, $meta , true );
	if ($status === 'need-help') {
		return 1;
	} 
	else if ($status === 'some-concern') {
		return 2;
	}
	else if ($status === 'confident') {
		return 3;
	} else {
		return 'no response';
	}

}

//count assignment scores on individual assignments
function count_assignment_numbers($array, $assignment) {
	$counter = 0;
	$title = sanitize_title($assignment);
	foreach($array as $key=> $value){
	    if(key($value) == $title){
	       $counter = $counter+1;
	     }
	}
	return $counter;
}

function avg_assignment_numbers($total, $count) {
	return 100*(number_format($count / $total, 2)) . '%';
	//return $count . ' -- ' . $total;
}

//create page for new users if they're sm_student

function support_matrix_make_page($user_id){
	 $user = get_userdata( $user_id );
	  if ( isset( $user->roles ) && is_array( $user->roles ) ) {
	  	//add check to see if page exists first 
        if ( in_array( 'sm_student', $user->roles ) ) { 
        	 $args = array(
			  'post_title'    =>  $user->user_login,
			  'post_author'   => $user_id,
			  'post_content'  => '',
			  'post_status'   => 'publish',
			  'post_type' => 'student'
			   );
			   $top_student_page = wp_insert_post( $args );
        }
    }

}

add_action( 'add_user_to_blog', 'support_matrix_make_page' );


//MAKING SURE EVERYONE HAS A PAGE
function student_double_check(){
	//get users in student role
	$args = array(
    	'role'    => 'sm_student',
    	'order'   => 'ASC'
	);
	$all_students = get_users( $args );
	//var_dump($all_students);
	$student_user_array = array();
	foreach ($all_students as $key => $student) {
		# code...
		array_push($student_user_array, $student->user_login);
	}

	//get posts in student post type
	$post_args = array(
		'post_type' => 'student',
		'post_status' => 'publish',
	);
	$student_posts = query_posts( $post_args );
	$student_post_array = array();
	foreach ($student_posts as $key => $post) {
		# code...
		array_push($student_post_array, $post->post_title);
	}
	
	//look for student users in student pages
	foreach ($student_user_array as $key => $student) {
			$present = in_array ( $student, $student_post_array);
			//if in student role and not in post type then make post
			if ($present !== TRUE ){
				support_matrix_make_page($all_students[$key]->ID);
			}
	}
	wp_redirect(get_site_url() . '/wp-admin/edit.php?post_type=student');
}

add_action( 'admin_post_force_student_creation', 'student_double_check' );

//BUILD BUTTON


add_action('wp_dashboard_setup', 'sm_force_students_button');
  
function sm_force_students_button() {
	global $wp_meta_boxes;
	 
	wp_add_dashboard_widget('custom_help_widget', 'Student Page Creation', 'dashboard_make_students_button');
}
 
function dashboard_make_students_button() {
	if(current_user_can( 'edit_posts' )){
		echo '<form action="'. admin_url('admin-post.php') .'" method="post">
		  <input type="hidden" name="action" value="force_student_creation">
		  <input type="submit" value="Force Student Page Creation">
		</form>';
	}

}




//NOT IMPLEMENTED YET -- should keep out duplicate creation of pages on multiple add of user
function support_matrix_check_duplicate($slug){
	$args = array(
	  'name'        => $slug,
	  'post_type'   => 'post',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	if(get_posts($args)){
		return TRUE;
	} else {
		return FALSE;
	}
}


//ADD MAIN choose your moments page on theme activation
add_action('after_switch_theme', 'support_matrix_add_admin_pages');

function support_matrix_add_admin_pages () {
 	$args = array(
			  'post_title'    => 'Name your moments here',
			  //'post_author'   => ,
			  'post_content'  => 'Once you submit the form below, you can name your lectures and assessments.',
			  'post_status'   => 'publish',
			  'post_type' => 'page',
			  'page_template'  => 'page-templates/main-support.php'
			   );
			   $new_page = wp_insert_post( $args );
}

add_action('acf/save_post', 'support_matrix_make_naming_pages', 20);

function support_matrix_make_naming_pages($post_id){
	$parent_id = get_page_by_path('name-your-moments-here')->ID;
	if ($post_id == $parent_id){
		if( have_rows('lectures') ):

    		// Loop through rows.
	    	while( have_rows('lectures') ) : the_row();
	    		$lecture_title = get_sub_field('lecture_title');
	    		$slug = sanitize_title($lecture_title);
	    		$lecture_id = get_sub_field('post_id');
	    		var_dump($lecture_id);
	    		if(!get_sub_field('post_id')){
						$args = array(
						  'post_title'    => $lecture_title,
						  'post_content'  => '',
						  'post_status'   => 'publish',
						  'post_type' => 'page',
						  'post_parent' => $parent_id,
			  			  'page_template'  => 'page-templates/sub-support.php'
						   );
						$new_page_id = wp_insert_post( $args );
						update_sub_field(array('lectures', get_row_index(), 'post_id'), $new_page_id, $post_id);
					}  else {
						  $existing_post = array(
						      'ID'           => $lecture_id,
						      'post_title'   => $lecture_title,
						  );
						 
						// Update the post into the database
						  wp_update_post( $existing_post );
					}

	    	endwhile;

			// No value.
			else :
			    // Do something...
			endif;
	}
}


function support_matrix_make_children($parent_id){
	$admin_id = get_page_by_path('name-your-moments-here')->ID;
	$values = get_fields( $admin_id );
		foreach ($values as $key => $value) {
			if($value != ""){//have a value
					$args = array(
					  'post_title'    => $value,
					  //'post_author'   => ,
					  'post_content'  => '',
					  'post_status'   => 'publish',
					  'post_type' => 'student',
					  'post_parent' => $parent_id,
					   );
					$new_page = wp_insert_post( $args );								
			}			
		}		
}


//unique slug check 

function support_matrix_duplicate_check($slug, $post_type){
	$args = array('name' => $slug, 'post_type' => $post_type); 
	$slug_check = new WP_Query($args);
	//print("<pre>".print_r($slug_check->found_posts,true)."</pre>");
	if($slug_check->found_posts > 0 ){
		return true;
	} else {
		return false;
	}
}



/*USER CREATION AND DISPLAY TWEAKS*/



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
        	 return home_url().'/student/' . $user->user_login; //need to set redirect path !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        } else {
        	return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'support_matrix_login_redirect', 10, 3 );

/**
 * Get the user's roles
 * @since 1.0.0
 */
function wcmo_get_current_user_roles() {
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


//REVISIT
function support_matrix_login_redirect_all() {
	    	 $user = wp_get_current_user(); 
	    	 global $wp;
	    	 $current_url = home_url( $wp->request );
		    	 if ( in_array( 'sm_student', $user->roles ) ) { 
			    	  if ($current_url != home_url() .'/student/' . $user->user_login  ){
			    	  	write_log( home_url() .'/student/' . $user->user_login);
			    	  	write_log(__LINE__);
			    	  	// write_log($current_url);
			    	  	// wp_safe_redirect( home_url() ) .'/student/' . $user->user_login;
			        //     exit;  
			    	  }       
    	}
   
}
//add_action( 'template_redirect', 'support_matrix_login_redirect_all' ); //redirect all the things


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
//add_action('acf/save_post', 'support_matrix_process_file', 'option');
function support_matrix_process_file( $post_id ) {

    // Get previous values.
    $prev_values = get_fields( $post_id );

    // Get submitted values.
    $values = $_POST['acf']['field_5f47bbd0010c8'];
    //write_log(wp_get_attachment_url($values));
   Users_Import_Batch::setup( wp_get_attachment_url($values));
}

//AJAX
//MAIN AJAX ACTION
add_action( 'wp_ajax_update_student_status', 'update_student_status' );
 
function update_student_status(){
	$url     = wp_get_referer();
    $post_id = url_to_postid( $url );
    $assessment = $_POST['assessment'];    
    $status =     $gf_id = $_POST['status'];    
	write_log($post_id . '----post id');
    $complete =  $_POST['complete'];
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
        	update_post_meta( $post_id, $assessment, $status );
            write_log($complete);
          //  $my_post = array(
          //     'ID'           => $gf_id,
          //     //'post_content' => 'This is the updated content.',
          // );
         
        // Update the post into the database
          //wp_update_post( $my_post );
        }
        die();
}

//END ACTION



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


add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );




//ACF SAVE and LOAD JSON
add_filter('acf/settings/save_json', 'support_matrix_save_point');
 
function support_matrix_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
    
}


add_filter('acf/settings/load_json', 'support_matrix_json_load_point');

function support_matrix_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory()  . '/acf-json';
    
    
    // return
    return $paths;
    
}
