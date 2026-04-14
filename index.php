<?php
/**
 * The main template file
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style       = ndt4_get_navigation_style();
$topnav          = ( 'top' === $nav_style );
$has_nav_sidebar = ! $topnav && has_nav_menu( 'primary' );

ndt4_register_layout( [
	'page_header' => ( is_home() && ! is_front_page() )
		? static function (): void {
			?>
			<div class="page-header">
				<div class="page-title-wrapper">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</div>
			</div>
			<?php
		}
		: null,
	'page_sidebar' => $has_nav_sidebar ? 'ndt4_render_nav_sidebar' : null,
] );

get_header();
?>

<?php if ( have_posts() ) : ?>
	<div class="posts-list">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry article' ); ?> typeof="Article">
				<div class="card card--news">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="entry-thumbnail card-image entry-image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'ndt4-list-thumb' ); ?>
							</a>
						</figure>
					<?php endif; ?>

					<div class="card-body">
						<?php the_title( sprintf( '<h2 property="headline" class="entry-title article-title card-title"><a class="card-link" href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

						<div class="article-meta">
							<p class="meta-item publish-info">
								<time property="datePublished" class="published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
									<span class="visually-hidden"><?php esc_html_e( 'Published:', 'ndt4' ); ?></span> <?php echo esc_html( get_the_date() ); ?>
								</time>
							</p>
							<?php if ( get_the_author() ) : ?>
								<p class="meta-item author" property="author" typeof="Person">
									<?php esc_html_e( 'Author:', 'ndt4' ); ?>
									<a href="<?php echo esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
								</p>
							<?php endif; ?>
							<?php if ( has_post_thumbnail() ) : ?>
								<meta property="image" content="<?php echo esc_url( (string) get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>">
							<?php endif; ?>
							<meta property="dateModified" content="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>">
							<link property="publisher" resource="#siteorg">
						</div>

						<div property="description" class="entry-summary article-excerpt">
							<?php the_excerpt(); ?>
						</div>
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

<?php
get_footer();
