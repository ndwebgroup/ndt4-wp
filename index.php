<?php
/**
 * The main template file
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();

$nav_style	 = ndt4_get_navigation_style();
$topnav		= ( 'top' === $nav_style );
$has_sidebar   = ! $topnav && has_nav_menu( 'primary' );
$alpha_classes = 'page-primary';
$beta_classes  = 'page-sidebar';
?>

<?php if ( is_home() && ! is_front_page() ) : ?>
	<!-- Page Header -->
	<div class="page-header">
		<div class="page-title-wrapper">
			<h1 class="page-title"><?php single_post_title(); ?></h1>
		</div>
	</div>
<?php endif; ?>

<!-- Page Primary -->
<div class="<?php echo esc_attr( $alpha_classes ); ?>">
	<?php if ( have_posts() ) : ?>
		<div class="posts-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
					<div class="card card--news">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="entry-thumbnail card-image entry-image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'ndt4-news-thumb' ); ?>
								</a>
							</figure>
						<?php endif; ?>

						<div class="card-body">
							<?php the_title( sprintf( '<h2 class="entry-title article-title card-title"><a class="card-link" href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<div class="entry-summary article-excerpt">
								<?php the_excerpt(); ?>
							</div>

							<!-- <div class="article-meta">
								<a href="<?php the_permalink(); ?>" class="btn btn--more"><?php esc_html_e( 'Read more', 'ndt4' ); ?></a>
							</div> -->
						</div>
					</div>
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
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'ndt4' ); ?></p>
		</div>
	<?php endif; ?>
</div>

<?php if ( $has_sidebar ) : ?>
	<div class="<?php echo esc_attr( $beta_classes ); ?>">
		<?php get_template_part( 'template-parts/navigation/nav-site' ); ?>
		<?php dynamic_sidebar( 'sidebar-nav' ); ?>
	</div>
<?php endif; ?>

<?php
get_footer();
