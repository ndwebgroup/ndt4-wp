/**
 * NDT4 Customizer Preview JavaScript
 *
 * Live preview updates in the Customizer. Settings whose markup is omitted
 * when empty (tagline toggle, footer contact and social links) use the
 * default refresh transport instead.
 *
 * @package NDT4
 * @since 4.0.0
 */

(function($) {
	'use strict';

	// Site title (header.php drops the "Notre Dame " prefix)
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('.site-title a').text(to.replace('Notre Dame ', ''));
		});
	});

	// Site description
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('.site-tagline').text(to);
		});
	});

})(jQuery);
