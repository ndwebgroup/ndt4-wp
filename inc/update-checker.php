<?php
/**
 * Theme Update Checker
 *
 * Enables automatic updates from GitHub repository.
 *
 * @package NDT4
 * @since 4.0.0
 * @see https://github.com/YahnisElsts/plugin-update-checker
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only load on admin pages to avoid unnecessary overhead on frontend.
if ( ! is_admin() ) {
	return;
}

$update_checker_path = get_template_directory() . '/plugin-update-checker/plugin-update-checker.php';

if ( ! file_exists( $update_checker_path ) ) {
	return;
}

require $update_checker_path;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/ndwebgroup/ndt4-wp/',
	get_template_directory() . '/style.css',
	'ndt4'
);

// Set the branch that contains the stable release.
// The library will check GitHub releases/tags first, then fall back to this branch.
$update_checker->setBranch( 'main' );
