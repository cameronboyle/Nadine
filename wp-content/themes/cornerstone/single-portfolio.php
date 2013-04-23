<?php get_header(); ?>

<div class="the-content large-12 columns" role="main">
	<a id="content"></a>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="row portfolio-single">
		<div class="large-6 columns portfolio-images">
		<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :
			$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id(), '800w'); ?>
			<img src="<?php echo $imgsrc[0]; ?>" class="big-image">
		<?php endif;
			$image2 = get_post_meta( $post->ID, 'image2', true );
			$image3 = get_post_meta( $post->ID, 'image3', true );
		?>
		<div class="row">
			<div class="large-4 small-4 columns">
				<img src="<?php echo $imgsrc[0]; ?>" class="thumb">
			</div>
			<div class="large-4 small-4 columns">
				<img src="<?php echo $image2; ?>" class="thumb">
			</div>
			<div class="large-4 small-4 columns">
				<img src="<?php echo $image3; ?>" class="thumb">
			</div>
		</div>

		</div>
		<div class="large-6 columns left portfolio-content">

			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="entry"><?php the_content(); ?></div>

			<ul class="inline-list social-links">
				<li class="title">Share</li>
				<li><a href="https://twitter.com/intent/tweet?original_referer=<?php echo home_url( '/' ); ?>&text=<?php the_title(); ?>&tw_p=tweetbutton&url=<?php the_permalink(); ?>&via=nadinetreister"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter.png" title="Twitter"></li>
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png" title="Facebook"></li>
				<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $imgsrc[0]; ?>&description=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/pinterest.png" title="Pinterest"></li>
			</ul>

		</div>
	</div>

	<a href="#" class="back-link">Back to Collection</a>	
	<?php endwhile; else: ?>

		<div class="alert-box error">Sorry, no posts matched your criteria.</div>
	
	<?php endif; ?>
	
</div>
		
<?php get_footer(); ?>