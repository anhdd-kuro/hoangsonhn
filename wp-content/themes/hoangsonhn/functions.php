<?php
$page_uri = $_SERVER['REQUEST_URI'];

define('THEME_URL', get_stylesheet_directory());
define('ROOT_URL', get_template_directory_uri());
define('TOP_URL', get_home_url() . "/");
define('IMG_ROOT', ROOT_URL . '/assets/images/');

function setupTheme()
{
  add_theme_support('post-thumbnails');
}
add_action('init', 'setupTheme');

include_once THEME_URL . '/functions/styles_scripts.php';