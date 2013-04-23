<?php get_header(); ?>

<div class="the-content large-8 columns" role="main">
	<a id="content"></a>
	
	<h1 class="page-title">Blog</h1>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="post<?php if( has_post_thumbnail() ) { ?> row<?php } ?>">

			<?php if( has_post_thumbnail() ) { ?><div class="featured-image large-4 small-4 columns"><?php the_post_thumbnail(); ?></div><?php } ?>

			<div class="post-content<?php if( has_post_thumbnail() ) { ?> small-8 large-8 columns<?php } ?>">
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry-meta"><?php the_time('d - m - Y') ?></div>
				<div class="entry entry-excerpt"><?php the_excerpt(); ?></div>
			</div>

		</article>
		<hr class="entry-separator">
	<?php endwhile; else: ?>
	
		<p>Sorry, no posts matched your criteria.</p>
	
	<?php endif; ?>
	
	<?php if (function_exists("emm_paginate")) { emm_paginate(); } ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>