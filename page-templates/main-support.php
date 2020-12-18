<?php if( class_exists('ACF') ) {
	acf_form_head();
} ?>
<?php
/**
 * Template Name: Main Support
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
						if( class_exists('ACF')){
							get_template_part( 'loop-templates/content', 'page-support' );	
							acf_form(); 					
						} else {
							echo 'Please turn on the Advanced Custom Fields Pro plugin.';
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
