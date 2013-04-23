<?php
// Disable WordPress version reporting as a basic protection against attacks
function remove_generators() {
	return '';
}
add_filter('the_generator','remove_generators');

// Add thumbnail support
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 400, 360, true );
add_image_size( '400w', 400, 360, true );
add_image_size( '800w', 800, 700, true );
add_image_size( '1200w', 1200, 1000, true );

// Includes
include('inc/shortcodes.php');
include('inc/portfolio-post-type.php');

// Add theme support for Automatic Feed Links
add_theme_support( 'automatic-feed-links' );

// Enqueue CSS and scripts
function enqueue_cornerstone() {
	// Enqueue Styles
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.min.css', array(), false, false );
	wp_enqueue_style( 'stylecss', get_template_directory_uri() . '/style.css', array(), false, false );
	wp_enqueue_style( 'iecss', get_template_directory_uri() . '/css/ie.css', array(), false, false );

	wp_dequeue_script('jquery');
	// Enqueue Scripts
	wp_enqueue_script( 'modernizrjs', get_template_directory_uri() . '/js/custom.modernizr.js', array(), false, false );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), false, false );
	wp_enqueue_script( 'foundationjs', get_template_directory_uri() . '/js/foundation.min.js', array(), false, false );
	wp_enqueue_script( 'isotopejs', get_template_directory_uri() . '/js/isotope.min.js', array(), false, true );
	wp_enqueue_script( 'backstretchjs', get_template_directory_uri() . '/js/backstretch.min.js', array(), false, true );
	wp_enqueue_script( 'appjs', get_template_directory_uri() . '/js/app.js', array(), false, true );
}
add_action('wp_enqueue_scripts', 'enqueue_cornerstone');

// Javascript Includes that can't be included with enqueue
function js_head_scripts() {
echo '	<!-- Scripts -->
	<script type="text/javascript" src="//use.typekit.net/wcu1qmu.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
';
}
add_action( 'wp_head', 'js_head_scripts', 1 );
function js_footer_scripts() {
echo '<script>jQuery.backstretch("'.get_template_directory_uri().'/img/bg.jpg");</script>
';
}
add_action( 'wp_footer', 'js_footer_scripts', 999);

function head_ie_scripts() {
echo '
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script src="'.get_template_directory_uri().'/js/ie-polyfills.js"></script>
	<![endif]-->

';
}
add_action( 'wp_head', 'head_ie_scripts' );

// load Foundation specific functions
require_once('inc/foundation.php');

/**
 * Register Navigation Menus
 */
// Register wp_nav_menus
function cornerstone_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'cornerstone' )
		)
	);
}
add_action( 'init', 'cornerstone_menus' );

// Sidebars
if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'right_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}

// Comments ---
// Custom callback to list comments in the Foundation style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'Foundation'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'Foundation'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'Foundation') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','Foundation'),
                    'login_text' => __('Log in to reply.','Foundation'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
        ?>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'Foundation'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'Foundation'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'Foundation') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 35 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// Custom Pagination
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<ul class="pagination">', 'after' => '</ul>',
		'title' => __(''),
		'nextpage' => __('Next'), 'previouspage' => __('Previous'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before";
		$ellipsis = "<li class='unavailable'>...</li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<li class='current'><a href='#'>$i</a></li>" 
			: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";
	}
	return $output;
}

// Excerpt
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return '... <span class="read-more"><a href="'. get_permalink( get_the_ID() ) . '">Read More</a></span>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

?>