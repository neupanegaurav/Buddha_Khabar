<?php
/**
 * Template part for displaying testimonial section
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Education Booster 1.0.0
 */

if( ! educationbooster_get_option( 'disable_testimonial' ) ):
	$testi_ids = educationbooster_get_ids( 'testimonial_page' );

	if( count( $testi_ids ) > 0 ):

		$query = new WP_Query( apply_filters( 'educationbooster_testimonial_args', array( 
			'post_type'      => 'page', 
			'post__in'       => $testi_ids, 
			'posts_per_page' => 4,
			'orderby'        => 'post__in'
		)));

		if( $query->have_posts() ):
?>
			<section class="wrapper block-testimonial">
				<?php
					educationbooster_section_heading( array(
						'id' => 'testimonial_main_page'
					));
				?>
				<div class="content-inner">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
								<div class="controls"></div>
								<div class="owl-carousel testimonial-carousel">
									<?php 
										while ( $query->have_posts() ):
											$query->the_post(); 
											$image = educationbooster_get_thumbnail_url( array(
												'size' => 'thumbnail'
											));
									?>
										    <div class="slide-item">
												<article class="post-content">
													<div class="post-content-inner">
														<blockquote>
															<div class="post-thumb-outer">
																<div class="post-thumb">
											    					<img src="<?php echo esc_url( $image ); ?>">
																</div>
															</div>
									    					<?php the_content(); 
									    					if( get_edit_post_link()){
					    										educationbooster_edit_link();
					    										}
					    									?>
										    				<footer class="post-title">
											    				<span class="kfi kfi-quotations"></span>
										    					<cite>
										    						<?php educationbooster_testimonial_title(); ?>
										    					</cite>
										    				</footer>
														</blockquote>
													</div>

												</article>
											</div>
									<?php
										endwhile; 
										wp_reset_postdata();
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="owl-pager" id="testimonial-pager"></div>
					</div>
				</div>
			</section><!-- End Testimonial Section -->
<?php
		endif;
	endif;
endif;