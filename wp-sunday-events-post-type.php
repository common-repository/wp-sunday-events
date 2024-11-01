<?php
/**
 * Create WP Sunday Events custom post type.
 *
 * @since 0.9.0
 */
add_action( 'init', 'wp_sunday_events_post_type', 0 );
function wp_sunday_events_post_type() {

	$labels = array(
		'name'                => __( 'Events', 'wp-sunday' ),
		'singular_name'       => __( 'Event', 'wp-sunday' ),
		'menu_name'           => __( 'Events', 'wp-sunday' ),
		'parent_item_colon'   => __( 'Events:', 'wp-sunday' ),
	    'all_items'           => __( 'All Events', 'wp-sunday' ),
    	'view_item'           => __( 'View Event', 'wp-sunday' ),
    	'add_new_item'        => __( 'Add New Event', 'wp-sunday' ),
    	'add_new'             => __( 'Add New', 'wp-sunday' ),
    	'edit_item'           => __( 'Edit Event', 'wp-sunday' ),
    	'update_item'         => __( 'Update Event', 'wp-sunday' ),
    	'search_items'        => __( 'Search Events', 'wp-sunday' ),
    	'not_found'           => __( 'Not found', 'wp-sunday' ),
    	'not_found_in_trash'  => __( 'Not found in Trash', 'wp-sunday' ),
	);

	$args = array(
		'label'               => __( 'events', 'wp-sunday' ),
		'description'         => __( 'Event Description', 'wp-sunday' ),
    	'labels'              => $labels,
    	'hierarchical'        => false,
    	'public'              => true,
    	'show_ui'             => true,
    	'show_in_menu'        => true,
    	'show_in_nav_menus'   => false,
    	'show_in_admin_bar'   => true,
    	'menu_position'       => 22,
    	'menu_icon'           => 'dashicons-calendar-alt',
    	'can_export'          => true,
    	'has_archive'         => true,
    	'exclude_from_search' => false,
    	'publicly_queryable'  => true,
    	'capability_type'     => 'post',
    	'rewrite'             => array( 'slug' => 'event' ),
    	'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'genesis-seo', 'genesis-scripts' ),
	);

	register_post_type( 'wp_sunday_events', $args );
}

/**
 * Add Event Categories taxonomy to the WP Sunday Events post type.
 *
 * @since 0.9.0
 */
add_action( 'init', 'wp_sunday_events_taxonomies', 0 );
function wp_sunday_events_taxonomies() {

	$labels = array(
		'name'                => __( 'Event Categories' ),
		'singular_name'       => __( 'Event Category' ),
    	'search_items'        => __( 'Search Event Categories' ),
    	'all_items'           => __( 'All Event Categories' ),
    	'parent_item'         => __( 'Parent Event Category' ),
    	'parent_item_colon'   => __( 'Parent Event Category:' ),
    	'edit_item'           => __( 'Edit Event Category' ), 
    	'update_item'         => __( 'Update Event Category' ),
    	'add_new_item'        => __( 'Add New Event Category' ),
    	'new_item_name'       => __( 'New Event Category' ),
    	'menu_name'           => __( 'Event Categories' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => true,
    	'show_admin_column'   => true,
    	'rewrite'             => array( 'slug' => 'event-category' ),
	);

	register_taxonomy( 'wp_sunday_events_category', array( 'wp_sunday_events' ), $args );

}

/**
 * Create custom meta box for WP Sunday Events post type.
 *
 * @since 0.9.0
 */
add_action( 'add_meta_boxes', 'wp_sunday_events_meta_boxes' );
function wp_sunday_events_meta_boxes() {

	add_meta_box(
		'wp_sunday_events_box',
		__( 'WP Sunday Events Settings', 'wp-sunday' ),
		'wp_sunday_events_box',
		'wp_sunday_events',
		'normal',
		'high' );

}

/**
 * Callback for WP Sunday Events meta box.
 *
 * @since 0.9.0
 *
 * @uses genesis_get_custom_field() Get custom field value.
 */
function wp_sunday_events_box() {

	wp_nonce_field( plugin_basename( __FILE__ ), 'wp_sunday_events_content_box_nonce' );
	?>

	<table class="form-table">
	<tbody>

		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_event_start"><?php _e( 'Event Start', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_event_start" id="_wp_sunday_event_start" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_event_start' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Enter the start date and time of this event. Example: January 10th at 3:00pm', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_event_end"><?php _e( 'Event End', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_event_end" id="_wp_sunday_event_end" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_event_end' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Enter the end date and time of this event. If you do not want to display an end time, just leave this empty. Example: January 10th at 5:00pm', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_event_location"><?php _e( 'Event Location', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_event_location" id="_wp_sunday_event_location" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_event_location' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Enter the location of this event. Example: Room 206', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="_wp_sunday_event_contact"><?php _e( 'Event Contact', 'wp-sunday' ); ?></label></th>
			<td>
				<p><input class="large-text" type="text" name="_wp_sunday_event_contact" id="_wp_sunday_event_contact" value="<?php echo esc_attr( genesis_get_custom_field( '_wp_sunday_event_contact' ) ); ?>" /></p>
				<p><span class="description"><?php _e( 'Enter the point of contact for this event. Example: email.address@yourchurch.com', 'wp-sunday' ); ?></span></p>
			</td>
		</tr>

	</tbody>
	</table>
	<?php

}

/**
 * Save custom meta box content for WP Sunday Events post type.
 *
 * @since 0.9.0
 */
add_action( 'save_post', 'wp_sunday_events_content_box_save' );
function wp_sunday_events_content_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if (
		!isset( $_POST['wp_sunday_events_content_box_nonce'] )
		|| !wp_verify_nonce( $_POST['wp_sunday_events_content_box_nonce'], plugin_basename( __FILE__ ) ) )
	return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	$event_start = sanitize_text_field( $_POST['_wp_sunday_event_start'] );
	$event_end = sanitize_text_field( $_POST['_wp_sunday_event_end'] );
	$event_location = sanitize_text_field( $_POST['_wp_sunday_event_location'] );
	$event_contact = sanitize_text_field( $_POST['_wp_sunday_event_contact'] );

	update_post_meta( $post_id, '_wp_sunday_event_start', $event_start );
	update_post_meta( $post_id, '_wp_sunday_event_end', $event_end );
	update_post_meta( $post_id, '_wp_sunday_event_location', $event_location );
	update_post_meta( $post_id, '_wp_sunday_event_contact', $event_contact );

}