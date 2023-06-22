<?php
// Register custom WPBakery block
add_action('init', 'register_custom_count_block');
function register_custom_count_block() {
   vc_map(array(
      'name' => __('Count App', 'text-domain'),
      'base' => 'custom_block',
      'params' => array(),
      'html_template' => dirname(__FILE__) . '/custom-sub-cat-block/template.php',
      // 'render_callback' => 'render_custom_count_block',
   ));
}

// Render custom WPBakery block
// function render_custom_count_block($atts) {
//   ob_start();
//   $output = ob_get_clean();
//   return $output;
// }

// function enqueue_alpine_js() {
//   wp_enqueue_script('alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), 'latest', true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_alpine_js');

