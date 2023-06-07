<?php

function register_styles() {
  wp_register_style('main_css', "assets/dist/css/main.css", [], "1.0");

  wp_enqueue_style(['style','main_css']);
}
add_action('wp_enqueue_scripts', 'register_styles');

function register_scripts() {
  wp_register_script('script', ROOT_URL . '/assets/dist/js/main.js', [], filemtime(get_theme_file_path('/assets/dist/js/main.js')), true);

  wp_enqueue_script(['script']);
}
add_action('wp_enqueue_scripts', 'register_scripts');