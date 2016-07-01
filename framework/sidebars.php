<?php
	register_sidebar(array(
		'name' 			=>	'Home Page Area',
		'id'			=>	'home-page-area-sidebar',
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));
		
	register_sidebar(array(
		'name' 			=>	'Home Page Area Full Width',
		'id'			=>	'home-page-area-full-sidebar',
		'before_widget' => 	'<aside id="%1$s" class="widget %2$s">',
		'after_widget' 	=> 	'</aside>',
		'before_title' 	=> 	'<h3 class="widgettitle"><span>',
		'after_title' 	=> 	'</span></h3>'));
?>
