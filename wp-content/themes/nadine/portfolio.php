<<<<<<< HEAD
<?php /* Template Name: Portfolio  */ ?>

<?php get_header(); ?>

	<?php
		// Custom Excerpt Length
		function custom_excerpt_length( $length ) {
			return 16;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

		// Replaces the excerpt "more" text by a link
		function new_excerpt_more($more) {
			return '...';
		}
		add_filter('excerpt_more', 'new_excerpt_more');
	?>

	<!-- #content BEGIN  -->
	<div id="content" class="clearfix">
	<div class="span12">

		<div class="row">
			<div class="span1">Fiters: </div>
			<div class="span2">
				<select data-filter-group="type" class="filters type-filter">
					<option data-filter-value="">Type</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('type'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						// set a count value to 0
						$i=0;
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
			<div class="span2">
				<select data-filter-group="range" class="filters range-filter">
					<option data-filter-value="">Range</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('range'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
			<div class="span2">
				<select data-filter-group="material" class="filters material-filter">
					<option data-filter-value="">Material</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('material'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms);
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
		</div>

	<?php
		global $wp_query, $wp_rewrite;
		// Query Out Database
		$wp_query = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => '15', 'paged' => $paged));

		if ($wp_query->have_posts()) :
	?>
		<ul class="filterable-grid clearfix thumbnails" id="portfolio-grid">
		<?php
			// Begin The Loop
			while ($wp_query->have_posts()) : $wp_query->the_post(); 

			// Get The Taxonomy 'Filter' Categories
			$termslugs = '';

			$terms = get_the_terms( get_the_ID(), 'type' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$terms = get_the_terms( get_the_ID(), 'range' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$terms = get_the_terms( get_the_ID(), 'material' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
			$large_image = $large_image[0];
		?>

			<li class="item<?php echo $termslugs; ?>"><div class="item-inner">
			<?php 
				// Check if wordpress supports featured images, and if so output the thumbnail
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<div class="thumbnail grayscale"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php endif; ?>

				<a href="<?php the_permalink(); ?>" class="hover-caption"><div class="caption-inner">
					<h2><?php the_title(); ?></h2>
					<?php echo get_the_excerpt(); ?>
				</div></a>
			</div></li>

		<?php
			$count++; // Increase the count by 1
			endwhile; // END the Wordpress Loop
		?>
		</ul>
	<?php
		$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link	=	html_entity_decode( get_pagenum_link() );
		$query_args		=	array();
		$url_parts		=	explode( '?', $pagenum_link );
		
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
		$pagenum_link	=	remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link	=	trailingslashit( $pagenum_link ) . '%_%';
		
		$format			=	( $wp_rewrite->using_index_permalinks() AND ! strpos( $pagenum_link, 'index.php' ) ) ? 'index.php/' : '';
		$format			.=	$wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		
		$links	=	paginate_links( array(
			'base'		=>	$pagenum_link,
			'format'	=>	$format,
			'total'		=>	$wp_query->max_num_pages,
			'current'	=>	$paged,
			'mid_size'	=>	3,
			'type'		=>	'list',
			'add_args'	=>	array_map( 'urlencode', $query_args )
		) );

		echo "<nav class=\"pagination clearfix\">{$links}</nav>";

		endif; wp_reset_query(); // Reset the Query Loop
	?>
		
	</div><!-- #content END -->
=======
<?php /* Template Name: Portfolio  */ ?>

<?php get_header(); ?>

	<?php
		// Custom Excerpt Length
		function custom_excerpt_length( $length ) {
			return 16;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

		// Replaces the excerpt "more" text by a link
		function new_excerpt_more($more) {
			return '...';
		}
		add_filter('excerpt_more', 'new_excerpt_more');
	?>

	<!-- #content BEGIN  -->
	<div id="content" class="clearfix">
	<div class="span12">

		<div class="row">
			<div class="span1">Fiters: </div>
			<div class="span2">
				<select data-filter-group="type" class="filters type-filter">
					<option data-filter-value="">Type</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('type'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						// set a count value to 0
						$i=0;
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
			<div class="span2">
				<select data-filter-group="range" class="filters range-filter">
					<option data-filter-value="">Range</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('range'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
			<div class="span2">
				<select data-filter-group="material" class="filters material-filter">
					<option data-filter-value="">Material</opton>
					<?php
						// Get the taxonomy
						$terms = get_terms(array('material'), $args);

						// set a count to the amount of categories in our taxonomy
						$count = count($terms);
						
						$term_list = '';
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								// rewrite the output for each category
								$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</select>
			</div>
		</div>

	<?php
		global $wp_query, $wp_rewrite;
		// Query Out Database
		$wp_query = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => '15', 'paged' => $paged));

		if ($wp_query->have_posts()) :
	?>
		<ul class="filterable-grid clearfix thumbnails" id="portfolio-grid">
		<?php
			// Begin The Loop
			while ($wp_query->have_posts()) : $wp_query->the_post(); 

			// Get The Taxonomy 'Filter' Categories
			$termslugs = '';

			$terms = get_the_terms( get_the_ID(), 'type' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$terms = get_the_terms( get_the_ID(), 'range' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$terms = get_the_terms( get_the_ID(), 'material' ); 
			foreach ($terms as $term) {
				$termslugs .= ' '.$term->slug;
			}

			$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
			$large_image = $large_image[0];
		?>

			<li class="item<?php echo $termslugs; ?>"><div class="item-inner">
			<?php 
				// Check if wordpress supports featured images, and if so output the thumbnail
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<div class="thumbnail grayscale"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php endif; ?>

				<a href="<?php the_permalink(); ?>" class="hover-caption"><div class="caption-inner">
					<h2><?php the_title(); ?></h2>
					<?php echo get_the_excerpt(); ?>
				</div></a>
			</div></li>

		<?php
			$count++; // Increase the count by 1
			endwhile; // END the Wordpress Loop
		?>
		</ul>
	<?php
		$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link	=	html_entity_decode( get_pagenum_link() );
		$query_args		=	array();
		$url_parts		=	explode( '?', $pagenum_link );
		
		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}
		$pagenum_link	=	remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link	=	trailingslashit( $pagenum_link ) . '%_%';
		
		$format			=	( $wp_rewrite->using_index_permalinks() AND ! strpos( $pagenum_link, 'index.php' ) ) ? 'index.php/' : '';
		$format			.=	$wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
		
		$links	=	paginate_links( array(
			'base'		=>	$pagenum_link,
			'format'	=>	$format,
			'total'		=>	$wp_query->max_num_pages,
			'current'	=>	$paged,
			'mid_size'	=>	3,
			'type'		=>	'list',
			'add_args'	=>	array_map( 'urlencode', $query_args )
		) );

		echo "<nav class=\"pagination clearfix\">{$links}</nav>";

		endif; wp_reset_query(); // Reset the Query Loop
	?>
		
	</div><!-- #content END -->
>>>>>>> Cameron changes
<?php get_footer(); ?>