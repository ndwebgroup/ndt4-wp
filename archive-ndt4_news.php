<?php
/**
 * The template for displaying News archives
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
		<div class="page-header page-header--inset">
			<div class="page-title-wrapper">
				<h1 class="page-title"><?php esc_html_e( 'News', 'ndt4' ); ?></h1>

				<?php
				if ( is_tax( 'ndt4_news_category' ) ) {
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				?>
			</div>
		</div>
		<?php
	},
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();

$news_categories = get_terms( [
	'taxonomy'   => 'ndt4_news_category',
	'hide_empty' => true,
] );

if ( ! empty( $news_categories ) && ! is_wp_error( $news_categories ) ) :
	?>
	<nav class="news-filter" aria-label="<?php esc_attr_e( 'Filter news by category', 'ndt4' ); ?>">
		<ul>
			<li>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'ndt4_news' ) ); ?>"<?php echo ! is_tax( 'ndt4_news_category' ) ? ' aria-current="page"' : ''; ?>>
					<?php esc_html_e( 'All', 'ndt4' ); ?>
				</a>
			</li>
			<?php foreach ( $news_categories as $category ) : ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $category ) ); ?>"<?php echo is_tax( 'ndt4_news_category', $category->term_id ) ? ' aria-current="page"' : ''; ?>>
						<?php echo esc_html( $category->name ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
<?php endif; ?>

<?php get_template_part( 'template-parts/news/news-archive' ); ?>

<?php
get_footer();
