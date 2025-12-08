<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package unikon
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-lg-12';
$sidebar_sytem = get_theme_mod('unikon_blog_sidebar_system', 'right');

$blog_column_alignment = $sidebar_sytem == 'left' ? 'flex-row-reverse' : '';
$sidebar_off = $sidebar_sytem == 'no_sidebar' ? false : true;
?>

<section class="wpr-blog-area wpr-postbox-area postbox__area wpr-blog-standard-area p-relative pt-120 pb-120">
	<div class="container">
		<div class="row <?php echo esc_attr($blog_column_alignment); ?> justify-content-center">
			<div class="<?php print esc_attr($blog_column); ?>">
				<div class="wpr-postbox-wrapper blog__wrapper postbox__wrapper">
					<?php
					if (have_posts()) :
						if (is_home() && !is_front_page()) :
					?>
							<header>
								<h1 class="page-title screen-reader-text">
									<?php single_post_title(); ?>
								</h1>
							</header>
						<?php
						endif; ?>
						<?php
						/* Start the Loop */
						while (have_posts()) : the_post(); ?>
							<?php
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part('template-parts/content'); ?>
						<?php
						endwhile;
						?>
						<div class="blog-pagination wpr-pagination">
							<?php unikon_pagination('<i class="fa-solid fa-angles-left"></i>', '<i class="fa-solid fa-angles-right"></i>', '', ['class' => '']); ?>
						</div>
					<?php
					else :
						get_template_part('template-parts/content', 'none');
					endif;
					?>

				</div>
			</div>

			<?php if (is_active_sidebar('blog-sidebar') && $sidebar_off) : ?>
				<div class="col-lg-4">
					<div class="wpr-sidebar-wrapper widget sidebar__wrapper pl-55 unikon-sidebar-<?php echo esc_attr($sidebar_sytem); ?>">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
