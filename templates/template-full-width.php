<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();

$is_top_level = ! wp_get_post_parent_id( get_the_ID() );
?>

<!-- Page Header -->
<div class="page-header<?php echo ( $is_top_level || has_post_thumbnail() ) ? ' page-header--inset' : ''; ?>">
	<div class="page-title-wrapper">
		<?php ndt4_breadcrumbs(); ?>
		<h1 class="page-title" data-length="<?php echo esc_attr( strlen( get_the_title() ) ); ?>"><?php the_title(); ?></h1>
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

<!-- Page Primary -->
<div class="page-primary">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
			'after'  => '</div>',
		] );
	endwhile;
	?>
</div>

<?php
get_footer();
