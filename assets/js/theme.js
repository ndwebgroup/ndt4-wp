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
		initSmoothScroll();
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
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

		document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
			anchor.addEventListener('click', function(e) {
				const targetId = this.getAttribute('href');

				if (targetId === '#') {
					return;
				}

				const target = document.getElementById(decodeURIComponent(targetId.slice(1)));

				if (target) {
					e.preventDefault();

					target.scrollIntoView({
						behavior: reduceMotion.matches ? 'auto' : 'smooth',
						block: 'start'
					});

					// Update focus for accessibility
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
