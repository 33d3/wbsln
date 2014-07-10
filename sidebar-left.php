<?php
if ( ! is_active_sidebar( 'left_side_default' ) ) {
	return;
}
?>
<aside id="siderbar">
		<?php dynamic_sidebar( 'left_side_default' ); ?>
</aside>