<?php
/**
* The specialty drug post type single post template
*/

//* Removes the breadcrumb navigation
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// //* Removes the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 5 );

// //* Removes the author box on single posts
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

// //* Removes the post meta function
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Display Advanced Custom Fields

if(have_posts()) : while(have_posts()) : the_post();
?>

<div class="med-bg" id="simple-hero">
	<div class="row">
		<div class="column">
			<!-- diri ang name sang medicine -->
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<!-- bay-e lang ni anay for now.  Importante ang name nga ara sa H1 -->
			<h4>(Revlimid)</h4>
		</div>
	</div>
</div>

<div class="panel-grid" id="drug-main-content">
	<div class="row column">
		<div class="panel-grid-cell" id="drug-card">
			<div class="multi-column panel-cell-style">
				<!-- amo ni dayon ang table nga ga contain sg details -->
				<table>
					<tr>
						<td><?php echo get_the_title(get_field('what_is_it_used_for')) ?></td>
						<td>
							<p>
								<?php $term = get_field('taxonomy_field_name');
									if( $terms ): ?>
									<?php foreach( $terms as $term ): ?>
										<a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?> </a>,
									<?php endforeach; ?>
								<?php endif; ?>
							</p>
						</td>
					</tr>
					<?php if (get_field('oral_tablet')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('oral_tablet')) ?></td>
							<td>
								<p>
									<?php get_field('oral_tablet'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('how_to_take_it')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('how_to_take_it')) ?></td>
							<td>
								<p>
									<?php get_field('how_to_take_it'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('availability')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('availability')) ?></td>
							<td>
								<p>
									<?php get_field('availability'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('side_effects')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('side_effects')) ?></td>
							<td>
								<p>
									<?php get_field('side_effects'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('monitoring')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('monitoring')) ?></td>
							<td>
								<p>
									<?php get_field('monitoring'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('over_the_counter_drugs')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('over_the_counter_drugs')) ?></td>
							<td>
								<p>
									<?php get_field('over_the_counter_drugs'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('over_the_counter_drugs')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('over_the_counter_drugs')) ?></td>
							<td>
								<p>
									<?php get_field('over_the_counter_drugs'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (get_field('pregnancy')): ?>
						<tr>
							<td><?php echo get_the_title(get_field('pregnancy')) ?></td>
							<td>
								<p>
									<?php get_field('pregnancy'); ?>
								</p>
							</td>
						</tr>
					<?php endif; ?>
				</table>
			</div>
		</div>
	
		<div class="panel-grid-cell" id="sidebar-right">
			<div class="multi-column panel-cell-style">
			
				<!-- himu-a ni sidebar area -->
				<!-- 
					butangi 2 ka widgets:
					
					1.  Related Medicines (based sa sakit)
					2.  Disease categories.  Siguro 10 lang ka bilog, then may link nga View All 
				-->
			
				Related medicines here...
				<br /><br />
				Diseases here...
			</div>
		</div>
	</div>
</div>


<!-- echo '<div class="indir_price_value"> ' . get_field('indir_price') . ' </div>'; -->
<?php
endwhile; endif;

//* Genesis Loop
genesis();