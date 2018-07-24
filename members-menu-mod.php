<?php
/*
Plugin Name: members menu mod
Description: Hide protected pages and posts from menu https://github.com/justintadlock/members/issues/63#issuecomment-370740885
Version: 1.0
Author: https://github.com/aleaiacta
*/
add_filter( 'wp_nav_menu_objects', 'aid_filter_restricted_pages_from_menu', 10, 2 );
function aid_filter_restricted_pages_from_menu( $items, $args ) {
	$user_id = get_current_user_id();
	foreach ( $items as $item => $obj ) {
		if ( function_exists( 'members_can_user_view_post' ) ) {
			if ( ! members_can_user_view_post( $user_id, $obj->object_id ) ) {
				unset ( $items[ $item ] );
			}
		}
	}
	return $items;
}
