<?php
/**
* The specialty drug post type single post template
*/

get_header();

if(have_posts()) : while(have_posts()) : the_post();
?>
<div class="content-sidebar-wrap">
<main class="content" role="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="med-bg" id="simple-hero">
			<div class="row">
				<div class="column">
					<h1><?php the_title(); ?></h1>
					<h4>(Revlimid)</h4>
				</div>
			</div>
		</div>

		<div class="panel-grid" id="drug-main-content">
			<div class="row column">
				<div class="panel-grid-cell" id="drug-card">
					<div class="multi-column panel-cell-style">
						<table>
							
							<?php $field = get_field_object('what_is_it_used_for'); 
							$terms = get_field('what_is_it_used_for');
							?>
								<tr>
								<td><?php echo $field['label']; ?></td>
								<td>
									<p>
										<?php if( $terms ): ?>
											<?php foreach( $terms as $term ): ?>
												<a href="<?php echo get_term_link( $term); ?>"><?php echo $term->name; ?> </a>,
											<?php endforeach; ?>
										<?php endif; ?>
									</p>
								</td>
							</tr>
						
							<?php $oral_field = get_field_object('oral_tablet');
								if($oral_field): ?>
								<tr>
									<td><?php echo $oral_field['label']; ?></td>
									<td>
										<p>
											<?php echo get_field('oral_tablet'); ?>
										</p>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('how_to_take_it');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
											<?php echo get_field('how_to_take_it'); ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('availability');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
										<p>
											<?php echo get_field('availability'); ?>
										</p>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('side_effects');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
										<?php echo get_field('side_effects'); ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('monitoring');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
											<?php echo get_field('monitoring'); ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('over_the_counter_drugs');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
										<p>
											<?php echo get_field('over_the_counter_drugs'); ?>
										</p>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('over_the_counter_drugs');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
										<p>
											<?php echo get_field('over_the_counter_drugs'); ?>
										</p>
									</td>
								</tr>
							<?php endif; ?>
							<?php $field = get_field_object('pregnancy');
								if($field): ?>
								<tr>
									<td><?php echo $field['label']; ?></td>
									<td>
										<p>
											<?php echo get_field('pregnancy'); ?>
										</p>
									</td>
								</tr>
							<?php endif; ?>
						</table>
					</div>
				</div>
			
				<div class="panel-grid-cell" id="sidebar-right">
					<div class="multi-column panel-cell-style">
					
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="the-cta">
	<div class="row">
		<div class="column">
			<h1>A headline here for the CTA</h1>
			<h3>Lorem ipsum dolor sit amet kaon ta-e.  Lorem ipsum dolor sit amet kaon ta-e.</h3>
			<p>
				<button class="btn btn-cta">
					Click here to do something
				</button>
			</p>
		</div>
	</div>
</div>
	</article><!-- #post-## -->
</main>	
</div>
<!-- echo '<div class="indir_price_value"> ' . get_field('indir_price') . ' </div>'; -->
<?php
endwhile; endif;

get_footer();
//* Genesis Loop
// genesis();