<?php
/**
 * @package   Gantry 5 Theme
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2015 RocketTheme, LLC
 * @license   GNU/GPLv2 and later
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

/*
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 */

$chooser = new \Gantry\Framework\OutlineChooser;

/** @var \Gantry\Framework\Theme $theme */
$theme = $gantry[ 'theme' ];
$theme->setLayout( $chooser->select() );

if ( !class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

$context = Timber::get_context();
$context[ 'posts' ] = Timber::get_posts();
$context[ 'pagination' ] = Timber::get_pagination();

$templates = array( 'index.html.twig' );

if ( is_home() ) {
	array_unshift( $templates, 'home.html.twig' );
}

Timber::render( $templates, $context );
