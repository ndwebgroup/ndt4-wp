<?php
/**
 * Template part for displaying global menu dialog
 *
 * @package NDT4
 * @since 4.0.0
 */

?>
<dialog id="global-menu" class="global-menu global-menu--search" aria-label="<?php esc_attr_e( 'Global menu', 'ndt4' ); ?>" aria-modal="true">

	<div class="global-menu-header">
		<form method="dialog" class="global-menu-close">
			<button class="btn btn--action" type="submit" aria-label="<?php esc_attr_e( 'Close global menu', 'ndt4' ); ?>">
				<svg aria-hidden="true" focusable="false"><use xlink:href="#icon-close"></use></svg>
			</button>
		</form>
		<div class="global-menu-search">
			<?php get_search_form(); ?>
		</div>
	</div>

	<div class="global-menu-body">
		<?php get_template_part( 'template-parts/navigation/nav-site', null, [ 'nav_class' => 'nav-site nav-mobile', 'nav_id' => 'nav-mobile', 'menu_id' => 'nav-mobile-menu', 'item_ids' => false ] ); ?>
	</div>

	<div class="global-menu-footer">
		<div class="global-menu-nav-secondary"></div>
		<ul class="global-menu-utils list--inline">
			<li class="light-dark global-menu-utils-lightdark">
				<label>
					<span class="switch">
						<input type="checkbox" name="light-dark" class="light-dark-toggle">
						<span class="slider"><svg class="icon" data-icon="mode" aria-hidden="true" focusable="false"><use xlink:href="#icon-mode"></use></svg></span>
					</span>
					<span><?php esc_html_e( 'Light/Dark', 'ndt4' ); ?></span>
				</label>
			</li>
		</ul>
	</div>

</dialog>
