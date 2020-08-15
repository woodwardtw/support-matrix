<?php
/**
 * Template Name: Summary Report Statistics
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

if ( is_front_page() ) {
	get_template_part( 'global-templates/hero' );
}
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'page' );
					
					}
					?>
					<button id="hide-students">Hide/Show Students</button>
				<?php 
					// echo the_field('groups_to_display').'<br>';
					// echo the_field('report_access');
					$args = array(
						'post_type' => array('student'),
					);
					if (get_field('groups_to_display')){
						$args['cat'] = get_field('groups_to_display');

					}
					$the_query = new WP_Query( $args );

					// The Loop
					if ( $the_query->have_posts() ) :

						$avg_1 = array();
						$avg_2 = array();
						$avg_3 = array();
						$avg_4 = array();
						$avg_5 = array();
						$avg_6 = array();
						$avg_7 = array();
						$avg_8 = array();
						$avg_9 = array();
						$avg_10 = array();

					echo '<table><thead><tr><th scope="col">Name</th><th scope="col">1.1</th><th scope="col">1.2</th><th scope="col">1.3</th><th scope="col">1.4</th><th scope="col">1.5</th><th scope="col">1.6</th><th scope="col">1.7</th><th scope="col">1.8</th><th scope="col">1.9</th><th scope="col">1.10</th></tr></thead><tbody>';	
					while ( $the_query->have_posts() ) : $the_query->the_post();
					  // Do Stuff
						$total_students = $the_query->post_count;
						$post_id = get_the_ID();
						
						if(get_field('assignment_1', $post_id)){
							$assg_1 = get_field('assignment_1', $post_id);
							array_push($avg_1, $assg_1);
						}

						if(get_field('assignment_2', $post_id)){						
							$assg_2 = get_field('assignment_2', $post_id);
							array_push($avg_2, $assg_2);
						}

						if(get_field('assignment_3', $post_id)){
							$assg_3 = get_field('assignment_3', $post_id);
							array_push($avg_3, $assg_3);
						}
						
						if(get_field('assignment_4', $post_id)){
							$assg_4 = get_field('assignment_4', $post_id);
							array_push($avg_4, $assg_4);							
						}

						if(get_field('assignment_5', $post_id)){
							$assg_5 = get_field('assignment_5', $post_id);
							array_push($avg_5, $assg_5);
						}

						if(get_field('assignment_6', $post_id)){
							$assg_6 = get_field('assignment_6', $post_id);
							array_push($avg_6, $assg_6);
						}

						if(get_field('assignment_7', $post_id)){
							$assg_7 = get_field('assignment_7', $post_id);
							array_push($avg_7, $assg_7);
						}

						if(get_field('assignment_8', $post_id)){
							$assg_8 = get_field('assignment_8', $post_id);
							array_push($avg_8, $assg_8);
						}

						if(get_field('assignment_9', $post_id)){
							$assg_9 = get_field('assignment_9', $post_id);
							array_push($avg_9, $assg_9);
						}

						if(get_field('assignment_10', $post_id)){
							$assg_10 = get_field('assignment_10', $post_id);
							array_push($avg_10, $assg_10);
						}
							
						get_template_part('loop-templates/content', 'table');
						
					endwhile;
					echo '<tr class="average-row"><td>Average</td><td>' . average_score($avg_1) . '</td><td>' . average_score($avg_2) . '</td><td>' . average_score($avg_3). '</td><td>' . average_score($avg_4) . '</td><td>' . average_score($avg_5) . '</td><td>' . average_score($avg_6) . '</td><td>' . average_score($avg_7) . '</td><td>' . average_score($avg_8) . '</td><td>' . average_score($avg_9) . '</td><td>' . average_score($avg_10) . '</td></tr>';
					echo '<tr class="count-row none"><td>Average No Response</td><td>' . no_repsonse_avg($avg_1, $total_students) . '</td><td>' . no_repsonse_avg($avg_2, $total_students) . '</td><td>' . no_repsonse_avg($avg_3, $total_students). '</td><td>' . no_repsonse_avg($avg_4, $total_students) . '</td><td>' . no_repsonse_avg($avg_5, $total_students) . '</td><td>' . no_repsonse_avg($avg_6, $total_students). '</td><td>' . no_repsonse_avg($avg_7, $total_students) . '</td><td>' . no_repsonse_avg($avg_8, $total_students) . '</td><td>' . no_repsonse_avg($avg_9, $total_students) . '</td><td>' . no_repsonse_avg($avg_10, $total_students) . '</td></tr>';
					echo '<tr class="count-row ones"><td>Quantity of 1s</td><td>' . count_of_score(1,$avg_1) . '</td><td>' . count_of_score(1,$avg_2) . '</td><td>' . count_of_score(1,$avg_3). '</td><td>' . count_of_score(1,$avg_4) . '</td><td>' . count_of_score(1,$avg_5) . '</td><td>' . count_of_score(1,$avg_6) . '</td><td>' . count_of_score(1,$avg_7) . '</td><td>' . count_of_score(1,$avg_8) . '</td><td>' . count_of_score(1,$avg_9) . '</td><td>' . count_of_score(1,$avg_10) . '</td></tr>';
					echo '<tr class="avg-row ones"><td>Avg of 1s</td><td>' . avg_of_score(1,$avg_1) . '</td><td>' . avg_of_score(1,$avg_2) . '</td><td>' . avg_of_score(1,$avg_3). '</td><td>' . avg_of_score(1,$avg_4) . '</td><td>' . avg_of_score(1,$avg_5) . '</td><td>' . avg_of_score(1,$avg_6) . '</td><td>' . avg_of_score(1,$avg_7) . '</td><td>' . avg_of_score(1,$avg_8) . '</td><td>' . avg_of_score(1,$avg_9) . '</td><td>' . avg_of_score(1,$avg_10) . '</td></tr>';
					echo '<tr class="count-row twos"><td>Quantity of 2s</td><td>' . count_of_score(2,$avg_1) . '</td><td>' . count_of_score(2,$avg_2) . '</td><td>' . count_of_score(2,$avg_3). '</td><td>' . count_of_score(2,$avg_4) . '</td><td>' . count_of_score(2,$avg_5) . '</td><td>' . count_of_score(2,$avg_6) . '</td><td>' . count_of_score(2,$avg_7) . '</td><td>' . count_of_score(2,$avg_8) . '</td><td>' . count_of_score(2,$avg_9) . '</td><td>' . count_of_score(2,$avg_10) . '</td></tr>';
					echo '<tr class="avg-row twos"><td>Avg of 2s</td><td>' . avg_of_score(2,$avg_1) . '</td><td>' . avg_of_score(2,$avg_2) . '</td><td>' . avg_of_score(2,$avg_3). '</td><td>' . avg_of_score(2,$avg_4) . '</td><td>' . avg_of_score(2,$avg_5) . '</td><td>' . avg_of_score(2,$avg_6) . '</td><td>' . avg_of_score(2,$avg_7) . '</td><td>' . avg_of_score(2,$avg_8) . '</td><td>' . avg_of_score(2,$avg_9) . '</td><td>' . avg_of_score(2,$avg_10) . '</td></tr>';
					echo '<tr class="count-row threes"><td>Quantity of 3s</td><td>' . count_of_score(3,$avg_1) . '</td><td>' . count_of_score(3,$avg_2) . '</td><td>' . count_of_score(3,$avg_3). '</td><td>' . count_of_score(3,$avg_4) . '</td><td>' . count_of_score(3,$avg_5) . '</td><td>' . count_of_score(3,$avg_6) . '</td><td>' . count_of_score(3,$avg_7) . '</td><td>' . count_of_score(3,$avg_8) . '</td><td>' . count_of_score(3,$avg_9) . '</td><td>' . count_of_score(3,$avg_10) . '</td></tr>';
					echo '<tr class="avg-row threes"><td>Avg of 3s</td><td>' . avg_of_score(3,$avg_1) . '</td><td>' . avg_of_score(3,$avg_2) . '</td><td>' . avg_of_score(3,$avg_3). '</td><td>' . avg_of_score(3,$avg_4) . '</td><td>' . avg_of_score(3,$avg_5) . '</td><td>' . avg_of_score(3,$avg_6) . '</td><td>' . avg_of_score(3,$avg_7) . '</td><td>' . avg_of_score(3,$avg_8) . '</td><td>' . avg_of_score(3,$avg_9) . '</td><td>' . avg_of_score(3,$avg_10) . '</td></tr>';
					echo '</tbody></table>';
					endif;

					// Reset Post Data
					wp_reset_postdata();

				;?>
				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
