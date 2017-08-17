<?php
// Global define variables
$THEME_CHILD = '-wm4d';
define('THEME_CHILD_FILE', __FILE__ );
define('THEME_CHILD_DIR', get_template_directory().$THEME_CHILD);
define('THEME_CHILD_URL', get_template_directory_uri().$THEME_CHILD);

// Global variables
$THEME_VERSION = '1.1.5';
$THEME_CSS_VERSION = '1.0.9';

require_once(THEME_CHILD_DIR.'/framework/admin.php');

//error_reporting(E_ALL); ini_set('display_errors', 1);
?>