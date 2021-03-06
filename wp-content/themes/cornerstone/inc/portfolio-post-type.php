<?php

// function: post_type BEGIN
function post_type()
{
	// Create The Labels (Output) For The Post Type
	$labels = 
	array(
		// The plural form of the name of your post type.
		'name' => __( 'Portfolio'), 
		
		// The singular form of the name of your post type.
		'singular_name' => __('Portfolio'),
		
		// The rewrite of the post type
		'rewrite' => 
			array(
				// prepends our post type with this slug
				'slug' => __( 'portfolio' ) 
			),
			
		// The menu item for adding a new post.
		'add_new' => _x('Add Item', 'portfolio'), 
		
		// The header shown when editing a post.
		'edit_item' => __('Edit Portfolio Item'),
		
		// Shown in the favourites menu in the admin header.
		'new_item' => __('New Portfolio Item'), 
		
		// Shown alongside the permalink on the edit post screen.
		'view_item' => __('View Portfolio'),
		
		// Button text for the search box on the edit posts screen.
		'search_items' => __('Search Portfolio'), 
		
		// Text to display when no posts are found through search in the admin.
		'not_found' =>  __('No Portfolio Items Found'),
		
		// Text to display when no posts are in the trash.
		'not_found_in_trash' => __('No Portfolio Items Found In Trash'),
		 
		// Used as a label for a parent post on the edit posts screen. Only useful for hierarchical post types.
		'parent_item_colon' => '' 
	);
	
	// Set Up The Arguements
	$args = 
	array(
		// Pass The Array Of Labels
		'labels' => $labels, 
		
		// Display The Post Type To Admin
		'public' => true, 
		
		// Allow Post Type To Be Queried 
		'publicly_queryable' => true, 
		
		// Build a UI for the Post Type
		'show_ui' => true, 
		
		// Use String for Query Post Type
		'query_var' => true, 
		
		// Rewrite the slug
		'rewrite' => true, 
		
		// Set type to construct arguements
		'capability_type' => 'post', 
		
		// Disable Hierachical - No Parent
		'hierarchical' => false, 
		
		// Set Menu Position for where it displays in the navigation bar
		'menu_position' => null, 
		
		// Allow the portfolio to support a Title, Editor, Thumbnail
		'supports' => 
			array(
				'title',
				'editor',
				'thumbnail'
			) 
	);
	
	// Register The Post Type
	register_post_type(__( 'portfolio' ),$args);
	
	
} // function: post_type END


// function: portfolio_messages BEGIN
function portfolio_messages($messages)
{
	$messages[__( 'portfolio' )] = 
		array(
			// Unused. Messages start at index 1
			0 => '',
			
			// Change the message once updated
			1 => sprintf(__('Portfolio Updated. <a href="%s">View portfolio</a>'), esc_url(get_permalink($post_ID))),
			
			// Change the message if custom field has been updated
			2 => __('Custom Field Updated.'),
			
			// Change the message if custom field has been deleted
			3 => __('Custom Field Deleted.'),
			
			// Change the message once portfolio been updated
			4 => __('Portfolio Updated.'),
			
			// Change the message during revisions
			5 => isset($_GET['revision']) ? sprintf( __('Portfolio Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'],false)) : false,
			
			// Change the message once published
			6 => sprintf(__('Portfolio Published. <a href="%s">View Portfolio</a>'), esc_url(get_permalink($post_ID))),
			
			// Change the message when saved
			7 => __('Portfolio Saved.'),
			
			// Change the message when submitted item
			8 => sprintf(__('Portfolio Submitted. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
			
			// Change the message when a scheduled preview has been made
			9 => sprintf(__('Portfolio Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Portfolio</a>'),date_i18n( __( 'M j, Y @ G:i' ),strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
			
			// Change the message when draft has been made
			10 => sprintf(__('Portfolio Draft Updated. <a target="_blank" href="%s">Preview Portfolio</a>'), esc_url( add_query_arg('preview','true',get_permalink($post_ID)))),
		);
	return $messages;	
	
} // function: portfolio_messages END

// function: portfolio_filters BEGIN
function portfolio_filters()
{
	
	// Register the Taxonomy
	register_taxonomy(__( "type" ), 
	
	// Assign the taxonomy to be part of the portfolio post type
	array(__( "portfolio" )), 
	
	// Apply the settings for the taxonomy
	array(
		"hierarchical" => true, 
		"label" => __( "Types" ), 
		"singular_label" => __( "Type" ), 
		"rewrite" => array(
				'slug' => 'type', 
				'hierarchical' => true
				)
		)
	);

	
	// Register the Taxonomy
	register_taxonomy(__( "range" ), 
	
	// Assign the taxonomy to be part of the portfolio post type
	array(__( "portfolio" )), 
	
	// Apply the settings for the taxonomy
	array(
		"hierarchical" => true, 
		"label" => __( "Ranges" ), 
		"singular_label" => __( "Range" ), 
		"rewrite" => array(
				'slug' => 'range', 
				'hierarchical' => true
				)
		)
	);

	
	// Register the Taxonomy
	register_taxonomy(__( "material" ), 
	
	// Assign the taxonomy to be part of the portfolio post type
	array(__( "portfolio" )), 
	
	// Apply the settings for the taxonomy
	array(
		"hierarchical" => true, 
		"label" => __( "Materials" ), 
		"singular_label" => __( "Material" ), 
		"rewrite" => array(
				'slug' => 'material', 
				'hierarchical' => true
				)
		)
	);

} // function: portfolio_filters END

add_action('init', 'post_type');
add_action( 'init', 'portfolio_filters', 0 );
add_filter('post_updated_messages', 'portfolio_messages');

/* Meta Boxes -------- */
function portfolio_custom_metabox() {
	global $post;
	$image2 = get_post_meta( $post->ID, 'image2', true );
	$image3 = get_post_meta( $post->ID, 'image3', true );
	$image4 = get_post_meta( $post->ID, 'image4', true );
	?>
	<p><label for="image2">Image 2#:<br />
		<input id="image2" name="image2" value="<?php if( $image2 ) { echo $image2; } ?>" style="width:80%; padding:5px; margin-bottom:10px; border:1px solid #ccc; border-radius:2px; font-size:15px;" /></label></p>
	<p><label for="image3">Image 3#::<br />
		<input id="image3" name="image3" value="<?php if( $image3 ) { echo $image3; } ?>" style="width:80%; padding:5px; margin-bottom:10px; border:1px solid #ccc; border-radius:2px; font-size:15px;" /></label></p>
<?php
}
function save_portfolio_metabox( $post_id ) {
	global $post;	
	if( $_POST ) {
		update_post_meta( $post->ID, 'image2', $_POST['image2'] );
		update_post_meta( $post->ID, 'image3', $_POST['image3'] );
	}
}
function add_portfolio_metabox() {
	add_meta_box( 'portfolio-metabox', __( 'Other Images' ), 'portfolio_custom_metabox', 'portfolio', 'normal', 'high' );
}
add_action( 'admin_init', 'add_portfolio_metabox' );
add_action( 'save_post', 'save_portfolio_metabox' );
?>