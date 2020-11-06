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
					// echo the_field('groups_to_display').'<br>';
					// echo the_field('report_access');
					$args = array(
						'post_type' => array('student'),
						'order' => 'ASC',
						'orderby' => 'title'
					);
					$user_id = get_current_user_id();
					
					if (get_field('student_groups', "user_{$user_id}")){
						$cats = get_field('student_groups', "user_{$user_id}");
						$args['cat'] = $cats;
					}
					if (isset($_GET['group'])){
						$cat_slug = $_GET['group'];
						$cat_id = get_category_by_slug($cat_slug)->term_id;
						$args['cat'] = $cat_id;
					}

					if ( current_user_can('administrator')){//group buttons for admins
						//var_dump(get_categories());
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
					$assignment_page_id = $post->ID;
					$lecture = $post->post_name;

					$total = $the_query->post_count;

					//count the responses variables
					$need_help = array();
				    $some_concern = array();
					$confident = array();
					$unanswered = array();

					//var_dump($the_query);
					// The Loop
					if ( $the_query->have_posts() ) :
						echo '<canvas id="chart" width="400" height="100"></canvas>';
						echo '<table><thead><tr><td>Name</td>';
						if( have_rows('assignments') ): //*************************BUILD THE TABLE HEADERS
						    // Loop through rows.
						    while( have_rows('assignments') ) : the_row();

						        // Load sub field value.
						        $assignment_name = get_sub_field('assignment_name');
						        // Do something...
						        echo "<td>{$assignment_name}</td>";
						    // End loop.
						    endwhile;

						// No value.
						else :
						    // Do something...
						endif;

						echo '</tr></thead><tbody>';

						while ( $the_query->have_posts() ) : $the_query->the_post();//*************build student data
						  // Do Stuff
							$total_students = $the_query->post_count;
							$student_post_id = get_the_ID();
							
							$student_title = get_the_title();
							$group = get_the_category()[0]->slug;

							echo "<tr class=\"student-row {$group}\"><td>{$student_title}</td>";							
							
							if( have_rows('assignments', $assignment_page_id) ): //BUILD THE TABLE HEADERS
						    	// Loop through rows.
						   		 while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		 	
							        // Load sub field value.
							        $assignment_name = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
							        // make individual student score cells 
							      	echo "<td>" . get_student_meta($lecture, $assignment_name) . "</td>";
							      	
							      	//count scores
							      	if (get_student_meta($lecture, $assignment_name) === 1){
							      		$need_help[] = array($assignment_name => get_student_meta($lecture, $assignment_name));
							      	}
							      	if (get_student_meta($lecture, $assignment_name) === 2){
							      		$some_concern[] = array($assignment_name => get_student_meta($lecture, $assignment_name));
							      	}
							      	if (get_student_meta($lecture, $assignment_name) === 3){
							      		$confident[] = array($assignment_name => get_student_meta($lecture, $assignment_name));
							      	}
							      	if (get_student_meta($lecture, $assignment_name) === 'no response'){
							      		$unanswered[] = array($assignment_name => get_student_meta($lecture, $assignment_name));
							      	}
							      	
						    	// End loop.
						   		 endwhile;
						   	echo '</tr>';
							// No value.
							else :
							    // Do something...
							endif;


							//OLD MESSY WAY JUST IN CASE
							// if(get_field('assignment_1', $post_id)){
							// 	$assg_1 = get_field('assignment_1', $post_id);
							// 	array_push($avg_1, $assg_1);
							// }
							//foreach($assignments as $number){
								//support_basic_avg('assignment_' . $number, $post_id, ${"avg_" . $number} );
							//}											
								
							//get_template_part('loop-templates/content', 'table');
						
					endwhile;
					// var_dump($need_help);
					// var_dump($some_concern);
					// var_dump($confident);


					//ONES*********************
					$total_ones = count($need_help);
					echo "<tr id=\"total-one\" data-total={$total_ones} class=\"quantity one\"><td>Quantity \"1\"</td>";
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		echo '<td>' . count_assignment_numbers($need_help, $assignment) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					echo '<tr class="percent one"><td>Percentage "1"</td>';
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		$count = count_assignment_numbers($need_help, $assignment);
						   		echo '<td>' . avg_assignment_numbers($total, $count) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					//TWOS*********************
					$total_twos = count($some_concern);
					echo "<tr id=\"total-two\" data-total={$total_twos} class=\"quantity two\"><td>Quantity \"2\"</td>";
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));					
						   		echo '<td>' . count_assignment_numbers($some_concern, $assignment) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					echo '<tr class="percent two"><td>Percentage "2"</td>';
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		$count = count_assignment_numbers($some_concern, $assignment);
						   		echo '<td>' . avg_assignment_numbers($total, $count) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					//THREES*********************
					$total_threes = count($confident);
					echo "<tr id=\"total-three\" data-total={$total_threes} class=\"quantity three\"><td>Quantity \"3\"</td>";
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		echo '<td>' . count_assignment_numbers($confident, $assignment) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					echo '<tr class="percent three"><td>Percentage "3"</td>';
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		$count = count_assignment_numbers($confident, $assignment);
						   		echo '<td>' . avg_assignment_numbers($total, $count) . '</td>';							   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					//UNANSWERED*********************
				    $total_unanswered = count($unanswered);
					echo "<tr id=\"total-unanswered\" data-total={$total_unanswered} class=\"quantity unanswered\"><td>Quantity \"Unanswered\"</td>";
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		echo '<td>' . count_assignment_numbers($unanswered, $assignment) . '</td>';						   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;
					echo '<tr class="percent unanswered"><td>Percentage Unanswered</td>';
					if( have_rows('assignments', $assignment_page_id) ): //
						    	// Loop through rows.
						   	while( have_rows('assignments', $assignment_page_id) ) : the_row();
						   		$assignment = sanitize_title(get_sub_field('assignment_name',$assignment_page_id));
						   		$count = count_assignment_numbers($unanswered, $assignment);
						   		echo '<td>' . avg_assignment_numbers($total, $count) . '</td>';							   	
				   		 	endwhile;
				   		echo '</tr>';

					// No value.
					else :
					    // Do something...
					endif;

					echo '</tbody></table>';
					endif;
					


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

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->


<?php 
// for($i= 1; $i<=$5; $i++) {     
// 	$EACH_POST_QUERY = mysql_query("SELECT item_id FROM likes WHERE item_id='$i'");     
// 	$EACH_POST_TOTAL_LIKES = mysql_num_rows($EACH_POST_QUERY);     
// 	$EACH_POST_RESULT = array($i => $EACH_POST_TOTAL_LIKES); 
// }
// $EACH_POST_RESULT[] = $EACH_POST_TOTAL_LIKES;
?>
