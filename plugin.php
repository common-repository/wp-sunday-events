<?php
/*
Plugin Name: WP Sunday - Events
Plugin URI:  http://www.wpsunday.com/plugins/wp-sunday-events/
Description: Displays featured events in WP Sunday child themes.
Version:     1.0.2
Author:      WP Sunday
Author URI:  http://www.wpsunday.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-sunday
*/

include 'wp-sunday-events-post-type.php';
include 'class-wp-sunday-events.php';

/**
 * Flush the permalinks to make WP Sunday Events
 * custom post type URLs work.
 *
 * @since 0.9.0
 */
function wp_sunday_events_activate() {
	wp_sunday_events_post_type();
	wp_sunday_events_taxonomies();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wp_sunday_events_activate' );

/**
 * Register widget.
 *
 * @since 0.9.0
 */
add_action( 'widgets_init', 'wp_sunday_events_load_widgets' );
function wp_sunday_events_load_widgets() {
	register_widget( 'WP_Sunday_Featured_Events' );
}