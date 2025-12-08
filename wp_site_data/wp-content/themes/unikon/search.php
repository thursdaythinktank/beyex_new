<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package unikon
 */

get_header();

$blog_column = is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-lg-12';

?>

<div class="wpr-blog-area wpr-postbox-area postbox__area wpr-blog-standard-area p-relative pt-120 pb-120">
	<div class="container">
		<div class="row">
			<div class="<?php print esc_attr($blog_column); ?> blog-post-items">
				<div class="wpr-postbox-wrapper blog__wrapper postbox__wrapper">
					<?php
					if (have_posts()) :
					?>
						<div class="result-bar page-header d-none">
							<h1 class="page-title"><?php esc_html_e('Search Results For:', 'unikon'); ?> <?php print get_search_query(); ?></h1>
						</div>
						<?php
						while (have_posts()) : the_post();
							get_template_part('template-parts/content', 'search');
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
			<?php if (is_active_sidebar('blog-sidebar')) : ?>
				<div class="col-lg-4">
					<div class="wpr-sidebar-wrapper widget sidebar__wrapper pl-55">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
