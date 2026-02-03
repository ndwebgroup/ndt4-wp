/**
 * NDT4 Theme JavaScript
 *
 * @package NDT4
 * @since 4.0.0
 */

(function() {
	'use strict';

	/**
	 * Initialize theme functionality
	 */
	function init() {
		initSearchToggle();
		initBackToTop();
		initSmoothScroll();
		initExternalLinks();
	}

	/**
	 * Search toggle functionality
	 */
	function initSearchToggle() {
		const searchToggle = document.querySelector('.search-toggle');
		const siteSearch = document.getElementById('site-search');

		if (!searchToggle || !siteSearch) {
			return;
		}

		searchToggle.addEventListener('click', function() {
			const isExpanded = this.getAttribute('aria-expanded') === 'true';

			this.setAttribute('aria-expanded', !isExpanded);
			siteSearch.hidden = isExpanded;

			if (!isExpanded) {
				const searchInput = siteSearch.querySelector('.search-field');
				if (searchInput) {
					searchInput.focus();
				}
			}
		});

		// Close search on Escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape' && !siteSearch.hidden) {
				searchToggle.setAttribute('aria-expanded', 'false');
				siteSearch.hidden = true;
				searchToggle.focus();
			}
		});
	}

	/**
	 * Back to top button functionality
	 */
	function initBackToTop() {
		const backToTop = document.querySelector('.back-to-top');

		if (!backToTop) {
			return;
		}

		// Show/hide based on scroll position
		function toggleBackToTop() {
			if (window.scrollY > 300) {
				backToTop.classList.add('is-visible');
			} else {
				backToTop.classList.remove('is-visible');
			}
		}

		// Throttle scroll event
		let ticking = false;
		window.addEventListener('scroll', function() {
			if (!ticking) {
				window.requestAnimationFrame(function() {
					toggleBackToTop();
					ticking = false;
				});
				ticking = true;
			}
		});

		// Initial check
		toggleBackToTop();
	}

	/**
	 * Smooth scroll for anchor links
	 */
	function initSmoothScroll() {
		document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
			anchor.addEventListener('click', function(e) {
				const targetId = this.getAttribute('href');

				if (targetId === '#') {
					return;
				}

				const target = document.querySelector(targetId);

				if (target) {
					e.preventDefault();

					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});

					// Update focus for accessibility
					target.setAttribute('tabindex', '-1');
					target.focus();
				}
			});
		});
	}

	/**
	 * Add external link indicators and attributes
	 */
	function initExternalLinks() {
		const currentHost = window.location.hostname;

		document.querySelectorAll('a[href^="http"]').forEach(function(link) {
			const linkHost = new URL(link.href).hostname;

			if (linkHost !== currentHost) {
				// Add external link attributes
				if (!link.hasAttribute('target')) {
					link.setAttribute('target', '_blank');
				}

				if (!link.hasAttribute('rel')) {
					link.setAttribute('rel', 'noopener noreferrer');
				}
			}
		});
	}

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
