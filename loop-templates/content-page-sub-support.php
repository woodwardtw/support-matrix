<?php
/**
 * Partial template for content in sub support
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<button class="btn-primary btn btn-lecture" data-toggle="collapse" data-target="#name-it">Name Your Assessments</button>

		<div class="collapse" id="name-it">
		<?php 						
			acf_form(); 
		?>
		</div>

		<?php 
			//get student post type and sort alpha
			$args = array(
				'post_type' => array('student'),
				'order' => 'ASC',
				'orderby' => 'title'
			);
			$user_id = get_current_user_id();//get current user ID
			
			//can current user see specific user group
			if (get_field('student_groups', "user_{$user_id}")){
				$cats = get_field('student_groups', "user_{$user_id}");
				$args['cat'] = $cats;
			}
			//restrict group display by group URL parameter
			if (isset($_GET['group'])){
				$cat_slug = $_GET['group'];
				$cat_id = get_category_by_slug($cat_slug)->term_id;
				$args['cat'] = $cat_id;
			}
			//create hide/show group buttons for admins
			if ( current_user_can('administrator')){
				$all_cats = get_categories();
				$base_url = strtok($_SERVER["REQUEST_URI"], '?');
				echo "<div class=\"group-buttons\"><h2>View by group</h2><a class='btn btn-primary' href=\"{$base_url}\">All groups</a>";
				foreach ($all_cats as $key => $cat) {
					if($cat->slug != 'uncategorized'){
						echo "<a class='btn btn-primary' href=\"{$base_url}?group={$cat->slug}\" id=\"{$cat->slug}\">{$cat->name}</a>";
					}
				}
				echo "</div>";
			}
			$the_query = new WP_Query( $args );

			//get current page ID
			$assignment_page_id = $post->ID;
			
			//get post name 
			$lecture = $post->post_name;

			//get total students enrolled
			$total = $the_query->post_count;

			//array to hold the responses variables for counting
			$need_help = array();
		    $some_concern = array();
			$confident = array();
			$unanswered = array();

			// The Loop
			if ( $the_query->have_posts() ) :
				echo '<canvas id="chart" width="400" height="100"></canvas>';//javascript chart holder
				echo '<table><thead><tr><td>Name</td>';
				if( have_rows('assignments') ): //table headers
				    // Loop through rows.
				    while( have_rows('assignments') ) : the_row();
				        // Load sub field value.
				        $assignment_name = get_sub_field('assignment_name');
				        // Do something...
				        echo "<td>{$assignment_name}</td>";
				    // End loop.
				    endwhile;

				else :
				    // Do nothing . . . 
				endif;

				echo '</tr></thead><tbody>';
/*
**
**STUDENT PORTION
**
*/
				$student_data = '';//save html to kick out after summary fields
				while ( $the_query->have_posts() ) : $the_query->the_post();//*************build student data
					$total_students = $the_query->post_count;//gets total number of student post type from query

					$student_post_id = get_the_ID();//id of the student post type
					
					$student_title = get_the_title(); //student name

					if(get_the_category()){
						$group = get_the_category()[0]->slug;
					} else {
						$group = 'no group';
					}
					
					$student_data .= "<tr class=\"student-row {$group}\"><td>{$student_title}</td>";							
					
					if( have_rows('assignments', $assignment_page_id) ): //BUILD THE TABLE HEADERS
				    	// Loop through rows.
				   		 while( have_rows('assignments', $assignment_page_id) ) : the_row();
				   		 	
					        // Load sub field value.
					        $assignment_name = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
					        // make individual student score cells 
					      	$student_data .= "<td>" . get_student_meta($lecture, $assignment_name) . "</td>";
					      	
					      	//count scores
					      	if (get_student_meta($lecture, $assignment_name) === 1){
					      		$need_help[] = array($assignment_name => get_student_meta($lecture, $assignment_name));//provision array for 1s
					      	}
					      	if (get_student_meta($lecture, $assignment_name) === 2){
					      		$some_concern[] = array($assignment_name => get_student_meta($lecture, $assignment_name));//provision array for 2s
					      	}
					      	if (get_student_meta($lecture, $assignment_name) === 3){
					      		$confident[] = array($assignment_name => get_student_meta($lecture, $assignment_name));//provision array for 3s
					      	}
					      	if (get_student_meta($lecture, $assignment_name) === 'no response' || get_student_meta($lecture, $assignment_name) === 'not done'){
					      		$unanswered[] = array($assignment_name => get_student_meta($lecture, $assignment_name));//provision array for no response
					      	}
					      	
				    	// End loop.
				   		 endwhile;
				   	$student_data .= '</tr>';
					// No value.
					else :
					    // Do something...
					endif;
				
			endwhile;
/*
**
**END STUDENT PORTION
**
*/
		
/*
**
**SUMMARY PORTION
**
*/

		quantity_row_builder('one', $need_help, $assignment_page_id);
		percentage_row_builder('one',$need_help, $assignment_page_id, $total);
		quantity_row_builder('two', $some_concern, $assignment_page_id);
		percentage_row_builder('two',$some_concern, $assignment_page_id, $total);
		quantity_row_builder('three', $confident, $assignment_page_id);		
		percentage_row_builder('three',$confident, $assignment_page_id, $total);
		quantity_row_builder('unanswered', $unanswered, $assignment_page_id);		
		percentage_row_builder('unanswered',$unanswered, $assignment_page_id, $total);
		echo $student_data;	//write out student data after the summaries
	echo '</tbody></table>';
	endif;
/*
**
**END SUMMARY PORTION
**
*/


			// Reset Post Data
			wp_reset_postdata();			
		;?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">


	</footer><!-- .entry-footer -->

</article><!-- #post-## -->


