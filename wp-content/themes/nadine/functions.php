<?php
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'grayscale',get_bloginfo( "stylesheet_directory")."/js/grayscale.js",array('jquery'),time());

	add_action('init', 'project_custom_init');  

	// Registering Menus
	function register_menu() { register_nav_menu('navigation', __('Main Navigation')); }
	add_action('init', 'register_menu');
	
	// Register our Scripts
	function register_js() {
		if (!is_admin()) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
			wp_register_script('quicksand', get_stylesheet_directory_uri() . '/js/jquery.quicksand.js', 'jquery');
			wp_register_script('easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery');
			wp_register_script('custom', get_stylesheet_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.0', TRUE);
			wp_register_script('prettyPhoto', get_stylesheet_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery');


			wp_enqueue_script('jquery');
			wp_enqueue_script('quicksand');
			wp_enqueue_script('prettyPhoto');
			wp_enqueue_script('easing');
			wp_enqueue_script('custom');
		}
	}
	
	add_action('init', 'register_js');
	
	// Register our Styles
	function register_styles()
	{
		if (!is_admin()) {
			wp_register_style('prettyPhoto', get_template_directory_uri() .	'/css/prettyPhoto.css');
			wp_enqueue_style( 'prettyPhoto');
		}		
	}
	
	add_action('init', 'register_styles');

	//Setting Up Feature Images
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 56, 56, true );
		add_image_size( 'portfolio', 185, 185, true ); 
	}

	// Include the portfolio functionality
	include("portfolio/portfolio-post-type.php");


if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(185,185,true);
}

?>