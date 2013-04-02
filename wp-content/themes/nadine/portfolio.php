<?php /* Template Name: Portfolio  */ ?>

<?php get_header(); ?>

	<!-- #content BEGIN  -->
	<div id="content" class="clearfix">
	<div class="span12">

				<ul class="filter clearfix nav nav-pills" id="filter-list">
					
					<li class="active"><a href="javascript:void(0)" class="all">All</a></li>
					
					<?php
						// Get the taxonomy
						$terms = get_terms('filter', $args);
						
						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						// set a count value to 0
						$i=0;
						
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								
								// increase the count by 1
								$i++;
								
								// rewrite the output for each category
								$term_list .= '<li><a href="javascript:void(0)" class="'. $term->slug .'">' . $term->name . '</a></li>';
								
								// if count is equal to i then output blank
								if ($count != $i)
								{
									$term_list .= '';
								}
								else 
								{
									$term_list .= '';
								}
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</ul>
				
				
				<ul class="filterable-grid clearfix thumbnails">
			
					<?php 
											
						// Query Out Database
						$wpbp = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' =>'-1') ); 
					?>
					
					<?php
						// Begin The Loop
						if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post(); 
					?>
					
					<?php 
						// Get The Taxonomy 'Filter' Categories
						$terms = get_the_terms( get_the_ID(), 'filter' ); 
					?>
					
					<?php 
					$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
					$large_image = $large_image[0]; 
					?>
					
							<?php
								//Apply a data-id for unique indentity, 
								//and loop through the taxonomy and assign the terms to the portfolio item to a data-type,
								// which will be referenced when writing our Quicksand Script
							?>
							<li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">
								
									<?php 
										// Check if wordpress supports featured images, and if so output the thumbnail
										if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
									?>
										
										<?php // Output the featured image ?>
										<div class ="thumbnail grayscale" ><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>									
																			
									<?php endif; ?>	
									
									<?php // Output the title of each portfolio item ?>
									<div class="thumbnail-tag"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
									
							</li>
	
					
					<?php $count++; // Increase the count by 1 ?>		
					<?php endwhile; endif; // END the Wordpress Loop ?>
					<?php wp_reset_query(); // Reset the Query Loop?>
			
				</ul>
				
				
				
	
	</div><!-- #content END -->

<?php get_footer(); ?>