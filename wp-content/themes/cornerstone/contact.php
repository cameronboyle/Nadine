<?php
/*
Template Name: Contact
*/
get_header(); ?>

<div class="the-content large-12 columns contact-page" role="main">
	<?php while ( have_posts() ) : the_post(); ?>

		<h1 class="page-title"><?php the_title(); ?></h1>
		
		<div class="row">
			<div class="large-4 columns contact-form">
				<?php echo do_shortcode('[contact-form-7 id="129" title="Contact form 1"]'); ?>
			</div>
			<div class="large-8 columns contact-content">
				<?php the_content(); ?>
			</div>
		</div>
		<ul class="side-nav contact-icons">
			<li><a href="http://twitter.com/nadinetreister"><img src="<?php echo get_template_directory_uri(); ?>/img/twitter.png">@nadinetreister</a></li>
			<li><a href="tel:+61401012557"><img src="<?php echo get_template_directory_uri(); ?>/img/phone.png">+614 01 012 557</a></li>
			<li><a href="mailto:hello@nadinetreister.com.au"><img src="<?php echo get_template_directory_uri(); ?>/img/email.png">hello@nadinetreister.com.au</a></li>
		</ul>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>