<?php
/**
 * The template for displaying single posts
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style    = ndt4_get_navigation_style();
$topnav       = ( 'top' === $nav_style );
$show_nav_in_sidebar = ! $topnav && has_nav_menu( 'primary' );

ndt4_register_layout( [
	'page_header' => static function (): void {
		?>
		<div class="page-header">
			<div class="page-title-wrapper">
				<?php ndt4_breadcrumbs(); ?>
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<?php
	},
	'page_sidebar' => static function () use ( $show_nav_in_sidebar ): void {
		?>
		<div class="page-sidebar">
			<?php
			if ( $show_nav_in_sidebar ) {
				get_template_part( 'template-parts/navigation/nav-site' );
			}
			dynamic_sidebar( 'sidebar-nav' );
			?>
		</div>
		<?php
	},
] );

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div class="meta entry-meta">
				<?php ndt4_posted_on(); ?>
				<?php ndt4_posted_by(); ?>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="post-thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</figure>
		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages( [
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
				'after'  => '</div>',
			] );
			?>
		</div>

		<footer class="entry-footer">
			<?php ndt4_entry_footer(); ?>
		</footer>
	</article>

	<?php
	the_post_navigation( [
		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'ndt4' ) . '</span> <span class="nav-title">%title</span>',
		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'ndt4' ) . '</span> <span class="nav-title">%title</span>',
	] );

	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
endwhile;

get_footer();
