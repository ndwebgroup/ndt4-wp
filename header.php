<?php
/**
 * The header template
 *
 * @package NDT4
 * @since 4.0.0
 */

$nav_style = ndt4_get_navigation_style();
$topnav	= ( 'top' === $nav_style );
$use_home_icon = get_theme_mod( 'ndt4_use_home_icon', true );
$site_tagline	= get_bloginfo( 'description' );
$show_tagline	= get_theme_mod( 'ndt4_show_tagline', true );
$mark_right	= ( 'right' === get_theme_mod( 'ndt4_mark_position', 'left' ) );
$animate = get_theme_mod( 'ndt4_animate', false );

// Build body classes
$body_classes = ['global-nav-false'];
if ( $topnav ) {
	$body_classes[] = 'nav-top--true';
} else {
	$body_classes[] = 'nav-top--false';
}
if ( $animate ) {
	$body_classes[] = 'animate--header';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<?php wp_head(); ?>
</head>

<body <?php body_class( $body_classes ); ?> data-theme="light" vocab="https://schema.org/">
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/icons' ); ?>

<!-- Skip links -->
<nav class="skip-links" aria-label="<?php esc_attr_e( 'Skip links', 'ndt4' ); ?>">
	<ul>
		<li><a href="#content" accesskey="C" title="<?php esc_attr_e( 'Skip to content = C', 'ndt4' ); ?>"><?php esc_html_e( 'Skip to content', 'ndt4' ); ?></a></li>
		<li><a href="#nav<?php echo $topnav ? '-primary' : ''; ?>" accesskey="S" title="<?php esc_attr_e( 'Skip to navigation = S', 'ndt4' ); ?>"><?php esc_html_e( 'Skip to navigation', 'ndt4' ); ?></a></li>
	</ul>
</nav>

<div class="wrapper" id="wrapper">
	<!-- Site Header -->
	<header id="header" class="site-header">
		<a class="header-mark-mobile" href="https://www.nd.edu/">
			<svg width="512" height="86" aria-hidden="true"><use xlink:href="#mobile-mark"></use></svg>
			<span class="visually-hidden"><?php esc_html_e( 'University of Notre Dame', 'ndt4' ); ?></span>
		</a>

		<div class="header-group header-group--inline-xl<?php echo $mark_right ? ' header-group--logo' : ''; ?>">
			<!-- Site Title and Mark -->
			<div class="header-title">
				<a class="header-mark" href="https://www.nd.edu/">
					<svg width="200" height="48" aria-hidden="true"><use xlink:href="#academic-mark"></use></svg>
					<span class="visually-hidden"><?php esc_html_e( 'University of Notre Dame', 'ndt4' ); ?></span>
				</a>
				<div class="header-title-name<?php echo ( $show_tagline && $site_tagline ) ? ' has-tagline' : ''; ?>">
					<?php
					$site_name = get_bloginfo( 'name' );
					$site_name_display = str_replace( 'Notre Dame ', '', $site_name );
					$title_tag = ( is_front_page() && is_home() ) ? 'h1' : 'p';
					$title_class = 'site-title';
					if ( strlen( $site_name ) > 40 ) {
						$title_class .= ' site-title--long';
					}
					?>
					<<?php echo $title_tag; ?> id="site-title" class="<?php echo esc_attr( $title_class ); ?>">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" accesskey="1" title="<?php esc_attr_e( 'Homepage shortcut key = 1', 'ndt4' ); ?>">
							<?php echo esc_html( $site_name_display ); ?>
						</a>
					</<?php echo $title_tag; ?>>
					<?php if ( $show_tagline && $site_tagline ) : ?>
						<p class="site-tagline"><?php echo esc_html( $site_tagline ); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<div class="header-nav">
				<?php if ( $topnav && has_nav_menu( 'primary' ) ) : ?>
					<nav id="nav-primary" class="nav-primary" aria-label="<?php esc_attr_e( 'Primary', 'ndt4' ); ?>">
						<?php
						wp_nav_menu( [
							'theme_location' => 'primary',
							'menu_id'		=> 'primary-menu',
							'container'	  => false,
							'depth'		  => 1,
							'items_wrap'	 => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'walker'		 => new NDT4_Top_Nav_Walker( $use_home_icon ),
						] );
						?>
					</nav>
				<?php endif; ?>

				<div class="header-util">
					<!-- Global Menu Toggle -->
					<div class="header-nav-toggle">
						<button class="btn btn--action global-menu-toggle" aria-label="<?php esc_attr_e( 'Open global menu and search', 'ndt4' ); ?>" aria-controls="global-menu" aria-haspopup="dialog">
							<svg class="icon-search-menu" aria-hidden="true"><use xlink:href="#icon-search-menu"></use></svg>
							<svg class="icon-search" aria-hidden="true"><use xlink:href="#icon-search"></use></svg>
						</button>
					</div>
				</div>
			</div>
		</div><!-- .header-group -->

		<div class="header-nav-fixed" id="nav-fixed" hidden>
			<div class="nav-fixed-inner">
				<?php if ( $topnav && has_nav_menu( 'primary' ) ) : ?>
					<nav id="fixed" class="fixed nav-primary" role="navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'ndt4' ); ?>">
						<?php
						wp_nav_menu( [
							'theme_location' => 'primary',
							'menu_id'		=> 'primary-menu-fixed',
							'container'	  => false,
							'depth'		  => 1,
							'walker'		 => new NDT4_Top_Nav_Walker( $use_home_icon ),
						] );
						?>
					</nav>
				<?php endif; ?>

				<div class="header-nav-toggle">
					<button class="btn btn--action global-menu-toggle" aria-label="<?php esc_attr_e( 'Open global menu and search', 'ndt4' ); ?>" aria-controls="global-menu" aria-haspopup="dialog">
						<svg class="icon-search-menu" aria-hidden="true"><use xlink:href="#icon-search-menu"></use></svg>
						<svg class="icon-search" aria-hidden="true"><use xlink:href="#icon-search"></use></svg>
					</button>
				</div>
			</div>
		</div>
	</header>

	<!-- Site Content -->
	<main id="content" class="site-content">
