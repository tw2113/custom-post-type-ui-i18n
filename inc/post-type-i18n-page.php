<?php

namespace tw2113\cptui18n;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function post_type_settings_page() {
	?>
	<div class="wrap cptui-i18n">
		<h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>

		dropdown to select language to use

		fields to set each label, rewrite, etc
	</div>
	<?php
}
