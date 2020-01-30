<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Admiral
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

	<div id="page" class="hfeed site">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'admiral' ); ?></a>

		<header id="masthead" class="site-header clearfix" role="banner">

			<?php do_action( 'admiral_header_menu' ); ?>

			<div class="header-main container clearfix">

				<div id="logo" class="site-branding clearfix">

					<?php admiral_site_logo(); ?>
					<?php admiral_site_title(); ?>

				</div><!-- .site-branding -->

				<?php admiral_site_description(); ?>

				<?php do_action( 'admiral_header_widgets' ); ?>

			</div><!-- .header-main -->

			<div class="main-navigation-wrap">

				<?php get_template_part( 'template-parts/main-navigation' ); ?>

			</div>

		</header><!-- #masthead -->

		<div id="content" class="site-content container clearfix">
