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
		initBackToTop();
		initInPageLinks();
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
	 * Move focus to the target of in-page links
	 *
	 * The browser follows the link: it updates the URL hash and history, and
	 * scrolls (smoothly via Conductor's CSS, or instantly under reduced motion
	 * via theme.css).
	 */
	function initInPageLinks() {
		document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
			anchor.addEventListener('click', function() {
				const targetId = this.getAttribute('href');

				if (targetId === '#') {
					return;
				}

				const target = document.getElementById(decodeURIComponent(targetId.slice(1)));

				if (target) {
					if (!target.hasAttribute('tabindex')) {
						target.setAttribute('tabindex', '-1');
					}
					target.focus({ preventScroll: true });
				}
			});
		});
	}

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
