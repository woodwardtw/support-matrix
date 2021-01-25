<?php acf_form_head(); ?>
<?php
/**
 * Template Name: Sub Level Support
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
						$user = wp_get_current_user();
						if( class_exists('ACF') && current_user_can('administrator')){
							get_template_part( 'loop-templates/content', 'page-sub-support' );	
							acf_form(); 					
						} if ( !class_exists('ACF') && current_user_can('administrator')) {
							echo 'Please turn on the Advanced Custom Fields Pro plugin.';
						} if ( class_exists('ACF') && in_array( 'sm_student', wcmo_get_current_user_roles())){ 
							$user = wp_get_current_user();
							$stu_page = home_url() .'/student/' . $user->user_login;
							echo "Please go to <a href='{$stu_page}'>your student page.</a>";
						} else {
							$url = wp_login_url();
							echo "<a href='{$url}'>Please login.</a>";
						}
					}
					?>					

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();

