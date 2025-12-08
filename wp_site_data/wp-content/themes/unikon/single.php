<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package unikon
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-xl-12 col-lg-12';


$unikon_blog_single_related = get_theme_mod('unikon_blog_single_related', false);
$blog_single_layout_from_customizer = get_theme_mod('unikon_blog_single_layout', 'blog_single_default');
$blog_single_layout_from_page = function_exists('get_field') ? get_field('unikon_post_single_layout') : '';

$blog_single_layout = !empty($blog_single_layout_from_page) ? ($blog_single_layout_from_page == 'default' ? $blog_single_layout_from_customizer : $blog_single_layout_from_page) : $blog_single_layout_from_customizer;
$unikon_blog_date = get_theme_mod('unikon_blog_date', true);
$unikon_blog_comments = get_theme_mod('unikon_blog_comments', true);
$unikon_blog_author = get_theme_mod('unikon_blog_author', true);
$unikon_blog_cat = get_theme_mod('unikon_blog_cat', false);

$unikon_blog_single_social = get_theme_mod('unikon_blog_single_social', false);
$post_url = get_the_permalink();

$sidebar_sytem = get_theme_mod('unikon_blog_sidebar_system', 'right');

$blog_column_alignment = $sidebar_sytem == 'left' ? 'flex-row-reverse' : '';
$sidebar_off = $sidebar_sytem == 'no_sidebar' ? false : true;

$unikon_blog_full_width_overlay_bg = get_template_directory_uri() . '/assets/img/blog/blog-stories/blog-stories-bg.png';

?>

<?php if ($blog_single_layout == 'blog_single_full_width'): ?>

	<div class="wpr-postbox-details-area wpr-blog-area"> </div>

	<?php if ($unikon_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php elseif ($blog_single_layout == 'blog_single_classic'): ?>


	<?php while (have_posts()):
		the_post(); ?>

		<!-- blog full width banner area start -->
		<section class="wpr-blog-full-width-area wpr-blog-full-width-pl fix p-relative pt-180 unikon-blog-single-height">
			<div class="wpr-blog-stories-bg" data-background="<?php print esc_url($unikon_blog_full_width_overlay_bg); ?>"></div>
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="wpr-breadcrumb__content text-center">
							<div class="row justify-content-center">
								<div class="col-xl-8">
									<h3 class="wpr-blog-full-width-title">
										<?php the_title(); ?>
									</h3>
								</div>
							</div>

							<div class="wpr-blog-full-width-box d-flex justify-content-between">

								<div class="wpr-blog-full-width-back">
									<a href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">
										<span>
											<i class="fa-sharp fa-regular fa-arrow-left"></i>
										</span>
										<?php echo esc_html__('Back to main blog', 'unikon'); ?>
									</a>
								</div>

								<div class="wpr-blog-details-user">
									<?php get_template_part('template-parts/blog/blog-details-meta'); ?>
								</div>

								<div class="wpr-blog-details-user-social order-2 order-lg-3">
									<div class="wpr-postbox-details-social text-end">
										<?php if ($unikon_blog_single_social): ?>
											<a href="http://facebook.com/pin/create/button/?url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-facebook-f"></i>
											</a>

											<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-linkedin-in"></i>
											</a>

											<a href="https://twitter.com/share?url=<?php echo esc_url($post_url); ?>"
												target="_blank">
												<i class="fa-brands fa-twitter"></i>
											</a>
										<?php endif; ?>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="wpr-blog-full-width-img">
			<div class="container-fluid p-0 ">
				<div class="row g-0">
					<div class="col-lg-12">
						<?php if ( has_post_thumbnail() ): ?>
							<div class="wpr-blog-full-width-thumb">
								<?php get_template_part('template-parts/blog/blog-media'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- blog full width banner area end -->


	<?php endwhile;  // End of the loop. 
	?>

	<!-- postbox area start -->
	<section class="postbox__area wpr-blog-sidebar-sticky-area pt-120 pb-120">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="wpr-postbox-details-main-wrapper postbox__wrapper blog-details-left-content">
						<div class="wpr-postbox-details-content postbox__text">
							<div class="row justify-content-center">
								<div class="col-xl-8">
									<?php while (have_posts()):
										the_post(); ?>

										<?php

										get_template_part('template-parts/content', get_post_format());
										get_template_part('template-parts/biography', get_post_format());
										get_template_part('template-parts/blog/blog-single-navigation');


										if (comments_open() || get_comments_number()):
											comments_template();
										endif;

									endwhile; // End of the loop.
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- postbox area end -->

	<?php if ($unikon_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php else: ?>

	<section class="wpr-postbox-details-area wpr-blog-area wpr-blog-details-p p-relative pt-120 pb-120">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<?php while (have_posts()):
						the_post();
						$categories = get_the_terms($post->ID, 'category'); ?>

					<?php endwhile;  // End of the loop. 
					?>
				</div>
			</div>

			<div class="row <?php echo esc_attr($blog_column_alignment); ?> justify-content-center">
				<div class="<?php echo esc_attr($blog_column); ?>">

					<div class="wpr-postbox-details-main-wrapper postbox__wrapper blog-details-left-content pr-30">
						<div class="wpr-postbox-details-content postbox__text">

							<?php if ( has_post_thumbnail() ): ?>
								<div class="postbox__details-thumbnail wpr-blog-details-thumb">
									<?php get_template_part('template-parts/blog/blog-media'); ?>
								</div>
							<?php endif; ?>

							<?php get_template_part('template-parts/blog/blog-meta'); ?>

							<?php while (have_posts()):
								the_post(); ?>

								<?php
								get_template_part('template-parts/content', get_post_format());
								get_template_part('template-parts/biography', get_post_format());
								get_template_part('template-parts/blog/blog-single-navigation');

								if (comments_open() || get_comments_number()):
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
						</div>
					</div>

				</div>

				<?php if (is_active_sidebar('blog-sidebar') && $sidebar_off): ?>
					<div class="col-lg-4">
						<div
							class="wpr-sidebar-wrapper sidebar__wrapper pl-55 unikon-sidebar-<?php echo esc_attr($sidebar_sytem); ?>">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php if ($unikon_blog_single_related) {
		get_template_part('template-parts/blog/blog-single-related');
	} ?>

<?php endif; ?>

<?php
get_footer();
