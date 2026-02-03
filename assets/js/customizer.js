/**
 * NDT4 Customizer Preview JavaScript
 *
 * Live preview updates in the Customizer.
 *
 * @package NDT4
 * @since 4.0.0
 */

(function($) {
	'use strict';

	// Site title
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('.site-title a').text(to);
		});
	});

	// Site description
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('.site-description').text(to);
		});
	});

	// Show tagline
	wp.customize('ndt4_show_tagline', function(value) {
		value.bind(function(to) {
			if (to) {
				$('.site-description').show();
			} else {
				$('.site-description').hide();
			}
		});
	});

	// Parent organization
	wp.customize('ndt4_parent_org', function(value) {
		value.bind(function(to) {
			var $breadcrumb = $('.site-breadcrumb');
			var $parentItem = $breadcrumb.find('li').eq(-2); // Second to last item

			if ($parentItem.length && $parentItem.find('a').length) {
				$parentItem.find('a').text(to);
			}
		});
	});

	// Phone number
	wp.customize('ndt4_phone', function(value) {
		value.bind(function(to) {
			var $phone = $('.contact-phone a');
			if ($phone.length) {
				$phone.text(to);
				$phone.attr('href', 'tel:' + to.replace(/[^0-9+]/g, ''));
			}
		});
	});

	// Email
	wp.customize('ndt4_email', function(value) {
		value.bind(function(to) {
			var $email = $('.contact-email a');
			if ($email.length) {
				$email.text(to);
				$email.attr('href', 'mailto:' + to);
			}
		});
	});

	// Social media URLs - these trigger a refresh since they affect visibility
	var socialNetworks = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin'];

	socialNetworks.forEach(function(network) {
		wp.customize('ndt4_social_' + network, function(value) {
			value.bind(function(to) {
				var $link = $('.social-' + network);
				if ($link.length) {
					if (to) {
						$link.attr('href', to).closest('li').show();
					} else {
						$link.closest('li').hide();
					}
				}
			});
		});
	});

})(jQuery);
