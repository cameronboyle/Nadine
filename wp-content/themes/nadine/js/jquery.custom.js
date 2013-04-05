/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/
 
jQuery(window).load(function() {

	/* Isotope Filtering */
	var $container = $('ul#portfolio-grid'), filters = {};
	$container.isotope({
		itemSelector : 'li.item',	
	});
	
	// filter buttons
	$('select.filters').change(function(){
		console.log('test');

		filters[ 'select.type-filter' ] = $('select.type-filter').find('option:selected').attr('data-filter-value');
		filters[ 'select.range-filter' ] = $('select.range-filter').find('option:selected').attr('data-filter-value');
		filters[ 'select.material-filter' ] = $('select.material-filter').find('option:selected').attr('data-filter-value');
		// convert object into array
		var isoFilters = [];
		for ( var prop in filters ) {
			isoFilters.push( filters[ prop ] )
		}
		var selector = isoFilters.join('');
		$container.isotope({ filter: selector });

		return false;
	});

	function lightbox() {
		// Apply PrettyPhoto to find the relation with our portfolio item
		$("a[rel^='prettyPhoto']").prettyPhoto({
			// Parameters for PrettyPhoto styling
			animationSpeed:'fast',
			slideshow:5000,
			theme:'pp_default',
			show_title:false,
			overlay_gallery: false,
			social_tools: false
		});
	}
	
	if(jQuery().prettyPhoto) {
		lightbox();
	}

	
}); // END OF DOCUMENT