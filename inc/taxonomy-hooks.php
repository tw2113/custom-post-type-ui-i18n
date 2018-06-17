<?php

namespace tw2113\cptui18n;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function set_cptui_taxonomy_lang_for_user( $args, $taxonomy_slug, $taxonomy_args ) {

	return $args;
}
add_filter( 'cptui_pre_register_taxonomy', __NAMESPACE__ . '\set_cptui_taxonomy_lang_for_user', 10, 3 );
