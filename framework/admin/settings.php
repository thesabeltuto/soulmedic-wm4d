<?php
add_action('admin_menu', 'create_admin_menu_wm4d');
add_action('init', 'soulmedic_wm4d_css');

function create_admin_menu_wm4d() {
	add_menu_page ('Theme Support', 'Theme Support','manage_theme','soulmedic_wm4d_support','soulmedic_wm4d_support', '', 27); //after soulmedic-wm4d menu
}

function soulmedic_wm4d_css() {
	wp_register_style('soulmedic_wm4d_css.css', THEME_URL.'/framework/admin/admin.css', '', $GLOBALS['THEME_CSS_VERSION'], '');
	wp_enqueue_style('soulmedic_wm4d_css.css');
}
?>