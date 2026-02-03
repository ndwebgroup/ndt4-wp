<?php
/**
 * Template part for displaying global navigation menu
 *
 * @package NDT4
 * @since 4.0.0
 */

?>

<div class="global-nav">
	<div class="global-nav-inner">
		<a href="https://www.nd.edu" class="global-nav-logo" aria-label="<?php esc_attr_e( 'University of Notre Dame', 'ndt4' ); ?>">
			<img src="https://conductor.nd.edu/images/themes/ndt/4.0/wordmark-white.svg" alt="" width="180">
		</a>

		<nav class="global-nav-links" aria-label="<?php esc_attr_e( 'University navigation', 'ndt4' ); ?>">
			<ul>
				<li><a href="https://www.nd.edu/about/"><?php esc_html_e( 'About', 'ndt4' ); ?></a></li>
				<li><a href="https://www.nd.edu/academics/"><?php esc_html_e( 'Academics', 'ndt4' ); ?></a></li>
				<li><a href="https://www.nd.edu/admissions/"><?php esc_html_e( 'Admissions', 'ndt4' ); ?></a></li>
				<li><a href="https://www.nd.edu/research/"><?php esc_html_e( 'Research', 'ndt4' ); ?></a></li>
				<li><a href="https://www.nd.edu/community/"><?php esc_html_e( 'Community', 'ndt4' ); ?></a></li>
			</ul>
		</nav>

		<div class="global-nav-actions">
			<a href="https://search.nd.edu" class="global-search-link">
				<span class="screen-reader-text"><?php esc_html_e( 'Search Notre Dame', 'ndt4' ); ?></span>
				<svg class="icon icon-search" aria-hidden="true" focusable="false">
					<use xlink:href="#icon-search"></use>
				</svg>
			</a>

			<button class="global-menu-toggle" aria-expanded="false" aria-controls="global-menu-dialog">
				<span class="screen-reader-text"><?php esc_html_e( 'Open global menu', 'ndt4' ); ?></span>
				<span class="menu-icon">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span>
				</span>
			</button>
		</div>
	</div>
</div>

<dialog id="global-menu-dialog" class="global-menu-dialog" aria-labelledby="global-menu-title">
	<div class="global-menu-content">
		<div class="global-menu-header">
			<h2 id="global-menu-title" class="screen-reader-text"><?php esc_html_e( 'University Menu', 'ndt4' ); ?></h2>
			<button class="global-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'ndt4' ); ?>">
				<svg class="icon icon-close" aria-hidden="true" focusable="false">
					<use xlink:href="#icon-close"></use>
				</svg>
			</button>
		</div>

		<div class="global-menu-body">
			<div class="global-menu-column">
				<h3><?php esc_html_e( 'Resources', 'ndt4' ); ?></h3>
				<ul>
					<li><a href="https://my.nd.edu"><?php esc_html_e( 'myND', 'ndt4' ); ?></a></li>
					<li><a href="https://okta.nd.edu"><?php esc_html_e( 'Okta', 'ndt4' ); ?></a></li>
					<li><a href="https://canvas.nd.edu"><?php esc_html_e( 'Canvas', 'ndt4' ); ?></a></li>
					<li><a href="https://hr.nd.edu"><?php esc_html_e( 'Human Resources', 'ndt4' ); ?></a></li>
					<li><a href="https://financialaid.nd.edu"><?php esc_html_e( 'Financial Aid', 'ndt4' ); ?></a></li>
				</ul>
			</div>

			<div class="global-menu-column">
				<h3><?php esc_html_e( 'Quick Links', 'ndt4' ); ?></h3>
				<ul>
					<li><a href="https://map.nd.edu"><?php esc_html_e( 'Campus Map', 'ndt4' ); ?></a></li>
					<li><a href="https://calendar.nd.edu"><?php esc_html_e( 'Events Calendar', 'ndt4' ); ?></a></li>
					<li><a href="https://directory.nd.edu"><?php esc_html_e( 'Directory', 'ndt4' ); ?></a></li>
					<li><a href="https://giving.nd.edu"><?php esc_html_e( 'Give to Notre Dame', 'ndt4' ); ?></a></li>
					<li><a href="https://news.nd.edu"><?php esc_html_e( 'Notre Dame News', 'ndt4' ); ?></a></li>
				</ul>
			</div>

			<div class="global-menu-column">
				<h3><?php esc_html_e( 'Visit', 'ndt4' ); ?></h3>
				<address>
					University of Notre Dame<br>
					Notre Dame, IN 46556
				</address>
				<p><a href="tel:+15746315000">(574) 631-5000</a></p>
				<p><a href="https://www.nd.edu/contact/"><?php esc_html_e( 'Contact Us', 'ndt4' ); ?></a></p>
			</div>
		</div>
	</div>
</dialog>
