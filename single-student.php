<?php
/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//acf_form_head();
get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-student">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">


				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'loop-templates/content', 'single-student' );	
				}
				?>

			    <?php 
				    	if(is_super_admin() || is_admin() || $post->post_author == get_current_user_id()){
						//build buttons 
						 $main_page = get_page_by_path( 'name-your-moments-here' )->ID;//REVISIT HOW THIS WORKS 
							 if( have_rows('lectures', $main_page) ):
				    		// Loop through rows.
							 	//build index
				    			echo '<h2>Index</h2>';								
							  	echo '<ul>';
						    	while( have_rows('lectures', $main_page) ) : the_row();
						    		$lecture_post_id = get_sub_field('post_id', $main_page);
						    		$lecture_slug = get_post_field( 'post_name', $lecture_post_id );
						    		$lecture_title = get_sub_field('lecture_title',$lecture_post_id);
						    		$clean_lecture_title = sanitize_title($lecture_title);
						    		echo '<button class="btn-primary btn btn-lecture" data-toggle="collapse" data-target="#' . $lecture_slug . '">' . $lecture_title . '</button>';
						    		echo "<div id=\"{$lecture_slug}\" class=\"collapse\">";
						    		include( locate_template( 'loop-templates/student-form.php', false, false ) ); 
						    		echo '</div>';
						    	endwhile;
						    	echo '</ul>';
							// No value.
							else :
						    // Do something...
							endif;
 
					}
					else {
						echo '<p>You do not have access to this content. Please login if this is your content.</p>';
						wp_loginout();
					}

					;?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
