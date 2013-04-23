<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />

	<title><?php bloginfo('name'); ?> <?php is_home() ? bloginfo('description') : wp_title(' - '); ?></title>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="the-container">

<!-- Header -->
<header class="primary-header">
<div class="row">
	<div class="large-12">

		<div class="logo">
			<h1 class="sitetitle"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo-default">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-small.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo-small">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo-smallest.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo-smallest">
			</a></h1>
		</div>

		<nav class="primary-nav">
			<?php if ( has_nav_menu( 'header-menu' ) ) {
				wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'container' => false,
				'depth' => 0,
				'items_wrap' => '<ul class="header-menu">%3$s</ul>',
				'fallback_cb' => false,
				'walker' => new cornerstone_walker( array( 'in_top_bar' => false, 'item_type' => 'li' ) ),
				) );
			} ?>
			<div class="mobile-menu-toggle"><a href="#">&#9776;</a></div>
		</nav>

	</div>
</div>
</header>

<!-- Main Row -->
<div class="content-wrapper">
<div class="main row">