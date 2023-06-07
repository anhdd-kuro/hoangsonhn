<?php

//Remove jQuery Migrate
function remove_jquery_migrate( $scripts ) {
  if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
      $script = $scripts->registered['jquery'];
      if ( $script->deps ) { // Check if the script has dependencies
          $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
      }
  }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


// Disable the emoji script and style
function disable_emoji_script_style() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

  // Remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emoji_tinymce' );
}
add_action( 'init', 'disable_emoji_script_style' );

function disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
      return array();
  }
}