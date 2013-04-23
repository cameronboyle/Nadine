<?php get_header(); ?>

<div class="the-content large-8 columns" role="main">
	<a id="content"></a>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="single">

			<h1 class="post-title"><?php the_title(); ?></h1>
			<div class="entry-meta"><?php the_time('d - m - Y') ?></div>
			<div class="entry"><?php the_content(); ?></div>

		</article>
		
		<?php /* comments_template( '', true ); */ ?>
	<?php endwhile; else: ?>

		<div class="alert-box error">Sorry, no posts matched your criteria.</div>
	
	<?php endif; ?>
	
</div>
	
<?php get_sidebar(); ?>
		
<?php get_footer(); ?>