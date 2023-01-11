<?php
if ( ! function_exists( 'theme_supports' ) ) {
	/**
	 * Add Support to theme
	 */
	function theme_supports() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'menus' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'thumbnails' );
	}
}
add_action( 'after_setup_theme', 'theme_supports' );
/**
 * Load styles
 */
function theme_enqueue_styles() {
    wp_register_style('theme-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style');
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

if (file_exists( get_template_directory() . '/includes/php/cpt.php' )) {
	require_once( get_template_directory() . '/includes/php/cpt.php' );
}
if (file_exists( get_template_directory() . '/includes/php/movies-custom-field.php' )) {
	require_once( get_template_directory() . '/includes/php/movies-custom-field.php' );
}
if (file_exists( get_template_directory() . '/includes/php/taxonomies.php' )) {
	require_once( get_template_directory() . '/includes/php/taxonomies.php' );
}

if (file_exists( get_template_directory() . '/includes/filters/ajax.php' )) {
	require_once( get_template_directory() . '/includes/filters/ajax.php' );
}