jQuery(document).foundation();
 
/* Isotope Filtering */
jQuery(window).load(function() {
	var $container = jQuery('.portfolio-grid'), filters = {};
	$container.isotope({
		itemSelector : 'li',	
	});

	jQuery(window).resize(function() {
		$container.isotope('reLayout');
	});
	
	// filter buttons
	jQuery('select.filters').change(function(){

		filters[ 'select.type-filter' ] = jQuery('select.type-filter').find('option:selected').attr('data-filter-value');
		filters[ 'select.range-filter' ] = jQuery('select.range-filter').find('option:selected').attr('data-filter-value');
		filters[ 'select.material-filter' ] = jQuery('select.material-filter').find('option:selected').attr('data-filter-value');
		// convert object into array
		var isoFilters = [];
		for ( var prop in filters ) {
			isoFilters.push( filters[ prop ] )
		}
		var selector = isoFilters.join('');
		$container.isotope({ filter: selector });

		return false;
	});

	// Filters Reset
	jQuery('.reset-button').click(function(e) {
		e.preventDefault();
		jQuery(this).closest('form').find('.custom.dropdown ul li:first-child').click();
	});
});

jQuery(document).ready(function() {
	/* Sticky Footer */
	var footerHeight = 0,
		footerTop = 0,
		$footer = jQuery('.primary-footer');

	positionFooter();
	function positionFooter() {
			footerHeight = $footer.height();
			footerTop = (jQuery(window).scrollTop()+jQuery(window).height()-footerHeight)+'px';

			if ( (jQuery(document.body).height()+footerHeight) < jQuery(window).height()) {
				$footer.css({ position: 'fixed', bottom: 0 })
			} else {
				$footer.css({ position: 'relative' })
			}
	}
	jQuery(window).scroll(positionFooter).resize(positionFooter);

	/* Mobile Menu */
	jQuery('.mobile-menu-toggle a').click(function(e) {
		jQuery('.mobile-nav').fadeToggle(100);
		jQuery(this).toggleClass('active');
	});

	/* Image Slider */
	jQuery('.portfolio-images .thumb').click(function(e) {
		jQuery('.portfolio-images .big-image').attr('src', jQuery(this).attr('src'));
	});
});