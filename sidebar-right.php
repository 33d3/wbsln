<?php
if ( ! is_active_sidebar( 'right_side_default' ) ) {
	return;
}
?>
<aside id="siderbar">
		<?php dynamic_sidebar( 'right_side_default' ); ?>
</aside>