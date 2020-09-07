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
						'order' => 'ASC',
						'orderby' => 'title'
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
						$avg_11 = array();
						$avg_12 = array();
						$avg_13 = array();
						$avg_14 = array();
						$avg_15 = array();
						$avg_16 = array();
						$avg_17 = array();
						$avg_18 = array();

					echo '<table><thead><tr><th scope="col">Name</th><th scope="col">1.1</th><th scope="col">1.2</th><th scope="col">1.3</th><th scope="col">1.4</th><th scope="col">1.5</th><th scope="col">1.6</th><th scope="col">1.7</th><th scope="col">1.8</th><th scope="col">1.9</th><th scope="col">1.10</th><th scope="col">1.11</th><th scope="col">1.12</th><th scope="col">1.13</th><th scope="col">1.14</th><th scope="col">1.15</th><th scope="col">1.16</th><th scope="col">1.17</th><th scope="col">1.18</th></tr></thead><tbody>';	
					while ( $the_query->have_posts() ) : $the_query->the_post();
					  // Do Stuff
						$total_students = $the_query->post_count;
						$post_id = get_the_ID();
						//OLD MESSY WAY JUST IN CASE
						// if(get_field('assignment_1', $post_id)){
						// 	$assg_1 = get_field('assignment_1', $post_id);
						// 	array_push($avg_1, $assg_1);
						// }
						$assignments = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18);
						foreach($assignments as $number){
							support_basic_avg('assignment_' . $number, $post_id, ${"avg_" . $number} );
						}											
							
						get_template_part('loop-templates/content', 'table');
						
					endwhile;

					//average score
					echo average_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);
					
					//no score
					echo count_no_score_total($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $total_students);

					echo average_no_response($avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18, $total_students);
					
					//ones
					echo count_of_scores(1, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);
					
					echo average_of_scores(1, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);
					
					//twos
					echo count_of_scores(2, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);

					echo average_of_scores(2, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);
					
					//threes	
					echo count_of_scores(3, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);

					echo average_of_scores(3, $avg_1, $avg_2, $avg_3, $avg_4, $avg_5, $avg_6, $avg_7, $avg_8, $avg_9, $avg_10, $avg_11, $avg_12, $avg_13, $avg_14, $avg_15, $avg_16, $avg_17, $avg_18);

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
