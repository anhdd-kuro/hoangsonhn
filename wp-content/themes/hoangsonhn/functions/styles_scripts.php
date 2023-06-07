<?php

function register_styles() {
  $main_ccs_relative_path = '/assets/dist/css/main.css';
  $main_css_file_path = get_stylesheet_directory_uri() . $main_ccs_relative_path;
  $main_css_file_version = filemtime(get_stylesheet_directory() . $main_ccs_relative_path);

  wp_register_style('main_css', $main_css_file_path, [], $main_css_file_version);
  wp_enqueue_style(['main_css']);
}
add_action('wp_enqueue_scripts', 'register_styles');

function register_scripts() {
  $main_js_relative_path = '/assets/dist/js/main.js';
  $main_js_file_path = get_stylesheet_directory_uri() . $main_js_relative_path;
  $main_js_file_version = filemtime(get_stylesheet_directory() . $main_js_relative_path);

  wp_register_script('main_js', $main_js_relative_path, [], $main_js_file_version, true);
  wp_register_script('fontawesome', "https://kit.fontawesome.com/d0f1e79f2b.js", []);

  wp_enqueue_script(['main_js', 'fontawesome']);
}
add_action('wp_enqueue_scripts', 'register_scripts');