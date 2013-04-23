</div>
</div>
<!-- Main Row End -->

<!-- Footer -->
<footer class="primary-footer">
<div class="row">
	
	<div class="large-7 columns">
		&copy; 2013 <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Nadine Treister</a> All Rights Reserved.
	</div>

	<div class="large-5 columns text-right">
		Site Design By <a href="http://cameronboyle.com.au/">Cameron Boyle</a>
	</div>

</div>
</footer>

</div>

<nav class="mobile-nav">
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
</nav>

<?php wp_footer(); ?>

</body>
</html>