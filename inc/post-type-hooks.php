<?php

namespace tw2113\cptui18n;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function set_cptui_post_type_lang_for_user( $args, $post_type_slug, $post_type_args ) {

	return $args;
}
add_filter( 'cptui_pre_register_post_type', __NAMESPACE__ . '\set_cptui_post_type_lang_for_user', 10, 3 );
