<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package main_theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
        if(is_front_page()) {
            get_template_part('template-parts/page', 'home');
        }
        if(is_page('Restaurants')) {
            get_template_part('template-parts/page', 'restaurants');
        }
        if(is_page('Chefs')) {
            get_template_part('template-parts/page', 'chefs');
        }
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
