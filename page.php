<?php
/**
 * The template for displaying pages
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style       = ndt4_get_navigation_style();
$topnav          = ( 'top' === $nav_style );
$is_top_level    = ! wp_get_post_parent_id( get_the_ID() );
$has_children    = ndt4_page_has_children( get_the_ID() );
$has_subnav      = ! $is_top_level || $has_children;
$has_nav_sidebar = ! $topnav || $has_subnav;

ndt4_register_layout( [
	'page_header' => static function () use ( $is_top_level ): void {
		?>
		<div class="page-header<?php echo ( $is_top_level || has_post_thumbnail() ) ? ' page-header--inset' : ''; ?>">
			<div class="page-title-wrapper">
				<?php ndt4_breadcrumbs(); ?>
				<h1 class="page-title" data-length="<?php echo esc_attr( (string) strlen( get_the_title() ) ); ?>"><?php the_title(); ?></h1>
				<?php
				$page_lede = get_post_meta( get_the_ID(), 'ndt4_page_lede', true );
				if ( $page_lede ) :
					?>
					<p class="page-lede"><?php echo esc_html( $page_lede ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="page-image">
					<?php the_post_thumbnail( 'full', [ 'fetchpriority' => 'high', 'sizes' => '(min-width:768px) 75vw, 100vw' ] ); ?>
				</figure>
			<?php endif; ?>
		</div>
		<?php
	},
	'page_sidebar' => $has_nav_sidebar
		? static function () use ( $topnav ): void {
			?>
			<div class="page-sidebar">
				<?php
				if ( $topnav ) {
					get_template_part( 'template-parts/navigation/nav-subnav' );
				} else {
					get_template_part( 'template-parts/navigation/nav-site' );
				}
				dynamic_sidebar( 'sidebar-nav' );
				?>
			</div>
			<?php
		}
		: null,
] );

get_header();

while ( have_posts() ) :
	the_post();
	the_content();

	wp_link_pages( [
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
		'after'  => '</div>',
	] );
endwhile;

get_footer();
