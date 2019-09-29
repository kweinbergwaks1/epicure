<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package main_theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'main_theme' ); ?></a>

	<header id="masthead" class="site-header">
        <div class="header-container">
            <div class="header-logo">
                <?php the_custom_logo(); ?>
            </div>
            <div class="header-title container">
                <?php
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="header-title text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
                else :
                    ?>
                    <p class="header-title text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
                endif;
                $main_theme_description = get_bloginfo( 'description', 'display' );
                if ( $main_theme_description || is_customize_preview() ) :
                    ?>
                <?php endif; ?>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'main_theme' ); ?></button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                ) );
                ?>
            </nav><!-- #site-navigation -->
            <div class="header-tools">
                <a href="#"><img src="<?php echo esc_url( home_url( '/' ) ) ?>app/uploads/2019/09/user-icon.png" class="tools-user" /></a>
                <a href="#"><img src="<?php echo esc_url( home_url( '/' ) ) ?>app/uploads/2019/09/bag-icon.png" class="tools-bag" /></a>
            </div>
            <div class="header-search">
                <input type="text" onkeyup="searchFunction()" placeholder="Search for restaurant cuisine, chef" name="input-header" id="input-search-header" />
                <img src="<?php echo esc_url( home_url( '/' ) ) ?>app/uploads/2019/09/search-icon.png" />
                <input type="hidden" id="url-ajax" value="<?php echo admin_url('admin-ajax.php') ?>" />
                <div id="search-results-header" class="search-results">
                    <p id="type-results-header" class="type-results">Restaurants</p>
                    <div id="search-data-header" class="search-data"></div>
                </div>
            </div>
        </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
