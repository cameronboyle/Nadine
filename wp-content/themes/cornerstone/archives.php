<?php 
/*
TemplateName: Archives
*/
get_header(); ?>

<div class="the-content large-8 columns" role="main">
	<!-- Skip Nav -->
	<a id="content"></a>

	<?php the_post(); ?>
	<h2 class="page-title"><?php the_title(); ?></h2>
				
	<h4 class="subheader">Archives by Month:</h4>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>
		
	<h4 class="subheader">Archives by Subject:</h4>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>