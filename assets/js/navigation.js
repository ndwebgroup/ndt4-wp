/**
 * NDT4 Navigation JavaScript
 *
 * @package NDT4
 * @since 4.0.0
 */

(function() {
	'use strict';

	/**
	 * Initialize navigation functionality
	 */
	function init() {
		initMobileNav();
		initSideNav();
		initGlobalMenu();
	}

	/**
	 * Mobile navigation functionality
	 */
	function initMobileNav() {
		const navToggle = document.querySelector('.nav-toggle');
		const mobileNav = document.getElementById('mobile-navigation');
		const mobileNavClose = document.querySelector('.mobile-nav-close');
		const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');

		if (!navToggle || !mobileNav) {
			return;
		}

		function openMobileNav() {
			navToggle.setAttribute('aria-expanded', 'true');
			mobileNav.classList.add('is-open');

			if (mobileNavOverlay) {
				mobileNavOverlay.classList.add('is-visible');
			}

			// Prevent body scroll
			document.body.style.overflow = 'hidden';

			// Focus first focusable element
			const firstFocusable = mobileNav.querySelector('button, a, input');
			if (firstFocusable) {
				firstFocusable.focus();
			}
		}

		function closeMobileNav() {
			navToggle.setAttribute('aria-expanded', 'false');
			mobileNav.classList.remove('is-open');

			if (mobileNavOverlay) {
				mobileNavOverlay.classList.remove('is-visible');
			}

			// Restore body scroll
			document.body.style.overflow = '';

			navToggle.focus();
		}

		navToggle.addEventListener('click', function() {
			const isExpanded = this.getAttribute('aria-expanded') === 'true';

			if (isExpanded) {
				closeMobileNav();
			} else {
				openMobileNav();
			}
		});

		if (mobileNavClose) {
			mobileNavClose.addEventListener('click', closeMobileNav);
		}

		if (mobileNavOverlay) {
			mobileNavOverlay.addEventListener('click', closeMobileNav);
		}

		// Close on Escape
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && mobileNav.classList.contains('is-open')) {
				closeMobileNav();
			}
		});

		// Trap focus within mobile nav when open
		mobileNav.addEventListener('keydown', function(e) {
			if (e.key !== 'Tab') {
				return;
			}

			const focusableElements = mobileNav.querySelectorAll(
				'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
			);

			const firstFocusable = focusableElements[0];
			const lastFocusable = focusableElements[focusableElements.length - 1];

			if (e.shiftKey) {
				if (document.activeElement === firstFocusable) {
					e.preventDefault();
					lastFocusable.focus();
				}
			} else {
				if (document.activeElement === lastFocusable) {
					e.preventDefault();
					firstFocusable.focus();
				}
			}
		});
	}

	/**
	 * Side navigation submenu toggles
	 */
	function initSideNav() {
		const submenuToggles = document.querySelectorAll('.submenu-toggle');

		submenuToggles.forEach(function(toggle) {
			toggle.addEventListener('click', function() {
				const isExpanded = this.getAttribute('aria-expanded') === 'true';
				const menuItem = this.closest('.menu-item');
				const submenu = menuItem.querySelector('.sub-menu');

				this.setAttribute('aria-expanded', !isExpanded);

				if (submenu) {
					if (isExpanded) {
						submenu.style.display = 'none';
					} else {
						submenu.style.display = 'block';
					}
				}
			});
		});

		// Open submenus for current page ancestors
		document.querySelectorAll('.side-menu .current-menu-ancestor > .submenu-toggle').forEach(function(toggle) {
			toggle.setAttribute('aria-expanded', 'true');
			const submenu = toggle.closest('.menu-item').querySelector('.sub-menu');
			if (submenu) {
				submenu.style.display = 'block';
			}
		});
	}

	/**
	 * Global menu dialog functionality
	 */
	function initGlobalMenu() {
		const globalMenuToggle = document.querySelector('.global-menu-toggle');
		const globalMenuDialog = document.getElementById('global-menu-dialog');
		const globalMenuClose = document.querySelector('.global-menu-close');

		if (!globalMenuToggle || !globalMenuDialog) {
			return;
		}

		function openGlobalMenu() {
			globalMenuToggle.setAttribute('aria-expanded', 'true');
			globalMenuDialog.showModal();
		}

		function closeGlobalMenu() {
			globalMenuToggle.setAttribute('aria-expanded', 'false');
			globalMenuDialog.close();
			globalMenuToggle.focus();
		}

		globalMenuToggle.addEventListener('click', function() {
			const isExpanded = this.getAttribute('aria-expanded') === 'true';

			if (isExpanded) {
				closeGlobalMenu();
			} else {
				openGlobalMenu();
			}
		});

		if (globalMenuClose) {
			globalMenuClose.addEventListener('click', closeGlobalMenu);
		}

		// Close on backdrop click
		globalMenuDialog.addEventListener('click', function(e) {
			if (e.target === globalMenuDialog) {
				closeGlobalMenu();
			}
		});

		// Handle dialog close event
		globalMenuDialog.addEventListener('close', function() {
			globalMenuToggle.setAttribute('aria-expanded', 'false');
		});
	}

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
