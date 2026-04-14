<?php
/**
 * The template for displaying archive pages
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style       = ndt4_get_navigation_style();
$topnav          = ( 'top' === $nav_style );
$has_nav_sidebar = ! $topnav && has_nav_menu( 'primary' );

ndt4_register_layout( [
	'page_header' => static function (): void {
		?>
		<div class="page-header">
			<div class="page-title-wrapper">
				<?php ndt4_breadcrumbs(); ?>
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div>
		</div>
		<?php
	},
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();
?>

<?php if ( have_posts() ) : ?>

	<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

	<div class="posts-list">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
				<header class="entry-header">
					<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<div class="meta entry-meta">
						<?php ndt4_posted_on(); ?>
					</div>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="entry-thumbnail">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'ndt4-list-thumb' ); ?>
						</a>
					</figure>
				<?php endif; ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>

				<footer class="entry-footer">
					<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read more', 'ndt4' ); ?></a>
				</footer>
			</article>
			<?php
		endwhile;
		?>
	</div>

	<?php
	the_posts_pagination( [
		'prev_text' => __( 'Previous', 'ndt4' ),
		'next_text' => __( 'Next', 'ndt4' ),
	] );
	?>

<?php else : ?>

	<div class="no-results">
		<h2><?php esc_html_e( 'Nothing Found', 'ndt4' ); ?></h2>
		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'ndt4' ); ?></p>
		<?php get_search_form(); ?>
	</div>

<?php endif; ?>

<?php
get_footer();
