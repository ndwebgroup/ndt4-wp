<?php
/**
 * The template for displaying single posts
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style           = ndt4_get_navigation_style();
$topnav              = ( 'top' === $nav_style );
$show_nav_in_sidebar = ! $topnav && has_nav_menu( 'primary' );

/*
 * The outer <article typeof="NewsArticle"> spans the entire post layout
 * to match the schema-friendly structure: open it in the page_header
 * callback before the .page-header markup, close it in the page_sidebar
 * callback after the .page-sidebar markup. The page_sidebar callback
 * also emits the .page-secondary article-footer with social share
 * between .page-primary and .page-sidebar.
 *
 * `article-content entry-content` are added to .page-primary via the
 * classes filter, and `property="mainEntityOfPage"` via primary_attrs,
 * so the body of this template can stay focused on the loop.
 */
ndt4_register_layout( [
	'page_header'     => static function (): void {
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'article article-page-wrapper' ); ?> typeof="NewsArticle">
			<header class="article-header page-header">
				<div class="page-title-wrapper">
					<?php ndt4_breadcrumbs(); ?>
					<h1 property="headline" class="page-title entry-title" data-length="<?php echo esc_attr( (string) strlen( get_the_title() ) ); ?>"><?php the_title(); ?></h1>

					<div class="meta-share-group grid grid-md-2">
						<div class="meta">
							<p class="meta-item publish-info">
								<time property="datePublished" class="published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
									<span class="visually-hidden"><?php esc_html_e( 'Published:', 'ndt4' ); ?></span>
									<?php echo esc_html( get_the_date() ); ?>
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

						<?php ndt4_social_share(); ?>
					</div>
				</div>
			</header>
		<?php
	},
	'page_sidebar'    => static function () use ( $show_nav_in_sidebar ): void {
		?>
			<footer class="page-secondary article-footer">
				<div class="meta-share-group">
					<?php ndt4_social_share(); ?>
				</div>
			</footer>

			<div class="page-sidebar">
				<?php
				if ( $show_nav_in_sidebar ) {
					get_template_part( 'template-parts/navigation/nav-site' );
				}
				dynamic_sidebar( 'sidebar-nav' );
				?>
			</div>
		</article>
		<?php
	},
	'primary_classes' => 'article-content entry-content',
	'primary_attrs'   => [ 'property' => 'mainEntityOfPage' ],
] );

get_header();

while ( have_posts() ) :
	the_post();

	if ( has_post_thumbnail() ) :
		?>
		<figure class="post-thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
		</figure>
		<?php
	endif;

	the_content();

	wp_link_pages( [
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndt4' ),
		'after'  => '</div>',
	] );
	?>

	<footer class="entry-footer">
		<?php ndt4_entry_footer(); ?>
	</footer>

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
