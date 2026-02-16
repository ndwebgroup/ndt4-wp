<?php
/**
 * The template for displaying single posts
 *
 * @package NDT4
 * @since 4.0.0
 */

get_header();

$nav_style   = ndt4_get_navigation_style();
$topnav    = ( 'top' === $nav_style );
$mark_right  = ( 'right' === get_theme_mod( 'ndt4_mark_position', 'left' ) );
$has_sidebar   = ! $topnav && has_nav_menu( 'primary' );
$alpha_classes = 'page-primary';
$beta_classes  = 'page-sidebar';
?>

<div class="<?php echo esc_attr( $beta_classes ); ?>">
		<?php if ( $has_sidebar ) : ?>
			<?php get_template_part( 'template-parts/navigation/nav-site' ); ?>
		<?php endif; ?>
		<?php dynamic_sidebar( 'sidebar-nav' ); ?>
	</div>

<div class="page-header">
  <div class="page-title-wrapper">
    <?php ndt4_breadcrumbs(); ?>
    <h1 class="page-title"><?php the_title(); ?></h1>
  </div>
</div>

<div class="<?php echo esc_attr( $alpha_classes ); ?>">
  <?php
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
  ?>
</div>

<?php
get_footer();
