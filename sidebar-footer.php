<?php
if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>
<aside id="siderbar">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
</aside>