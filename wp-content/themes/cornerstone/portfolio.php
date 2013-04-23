<?php
/*
Template Name: Collection
*/
get_header();
error_reporting(0);
// Excerpt Modifiers
function portfolio_excerpt_length( $length ) {
	return 14;
}
add_filter( 'excerpt_length', 'portfolio_excerpt_length', 999 );
function portfolio_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'portfolio_excerpt_more');
?>
<div class="the-content large-12 columns" role="main">

	<form name="portfolio-filters" class="row portfolio-filters custom">
		<div class="large-1 columns hide-for-small filter-label">Filter</div>
		<div class="large-2 columns filter-cont">
			<select data-filter-group="type" class="filters type-filter">
				<option data-filter-value="">Type</opton>
				<?php
					// Get the taxonomy
					$terms = get_terms(array('type'), $args);
					$count = count($terms); 
					$i=0;
					$term_list = '';
					if ($count > 0) {
						foreach ($terms as $term) {
							// rewrite the output for each category
							$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
						}
						echo $term_list;
					}
				?>
			</select>
		</div>
		<div class="large-2 columns">
			<select data-filter-group="range" class="filters range-filter">
				<option data-filter-value="">Range</opton>
				<?php
					// Get the taxonomy
					$terms = get_terms(array('range'), $args);
					$count = count($terms); 
					$i=0;
					$term_list = '';
					if ($count > 0) {
						foreach ($terms as $term) {
							// rewrite the output for each category
							$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
						}
						echo $term_list;
					}
				?>
			</select>
		</div>
		<div class="large-2 columns">
			<select data-filter-group="material" class="filters material-filter">
				<option data-filter-value="">Material</opton>
				<?php
					// Get the taxonomy
					$terms = get_terms(array('material'), $args);
					$count = count($terms); 
					$i=0;
					$term_list = '';
					if ($count > 0) {
						foreach ($terms as $term) {
							// rewrite the output for each category
							$term_list .= '<option data-filter-value=".'. $term->slug .'">' . $term->name . '</li>';
						}
						echo $term_list;
					}
				?>
			</select>
		</div>
		<div class="large-1 left columns">
			<button class="reset-button">Reset</button>
		</div>
	</form>

<?php
	// Query Out Database
	global $wp_query, $wp_rewrite;
	$wp_query = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => '12', 'paged' => $paged));

	if ($wp_query->have_posts()) : ?>
	<div class="row portfolio-row">
		<div class="large-8 large-centered columns">
		<ul class="large-block-grid-4 small-block-grid-2 portfolio-grid">
		<?php
			while ($wp_query->have_posts()) : $wp_query->the_post();

			// Get The Taxonomy 'Filter' Categories
			$termslugs = '';
			$terms = get_the_terms( get_the_ID(), 'type' ); 
			foreach ($terms as $term) { $termslugs .= ' '.$term->slug; }
			$terms = get_the_terms( get_the_ID(), 'range' ); 
			foreach ($terms as $term) { $termslugs .= ' '.$term->slug; }
			$terms = get_the_terms( get_the_ID(), 'material' ); 
			foreach ($terms as $term) { $termslugs .= ' '.$term->slug; }
			$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
			$large_image = $large_image[0];
		?>
			<li class="<?php echo $termslugs; ?>">
			<div class="block-inner">
			<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
			<?php endif; ?>

				<a href="<?php the_permalink(); ?>" class="hover-caption"><div class="caption-inner">
					<h2><?php the_title(); ?></h2>
					<?php echo get_the_excerpt(); ?>
				</div></a>
			</div>
			</li>

		<?php $count++; endwhile; ?>
		</ul>
		</div>
	</div>

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
		'prev_text'	=> __('Previous'),
		'next_text'	=> __('Next'),
		'type'		=>	'list',
		'add_args'	=>	array_map( 'urlencode', $query_args )
	) );

	echo "<nav class=\"portfolio-pagination\">".$links."</nav>";

	endif; wp_reset_query(); ?>

</div>

<?php get_footer(); ?>