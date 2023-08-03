<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles()
{
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('woodmart-style'), woodmart_get_theme_info('Version'));
}
add_action('wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010);

// Disable the emoji script and style
function disable_emoji_script_style()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

  // Remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emoji_tinymce');
}
add_action('init', 'disable_emoji_script_style');

function disable_emoji_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

// Add custom block
include_once 'custom-block/custom-sub-cat-block/index.php';
include_once 'custom-block/custom-product-cat-brand-block/index.php';

// Remove sort by in filter
add_action('wp', function () {
  add_filter('woodmart_use_custom_order_widget', '__return_false');
  add_filter('woodmart_use_custom_price_widget', '__return_false');
}, 10);

add_filter('woocommerce_get_price_html', 'custom_price_message');

// Custom price message
function custom_price_message($price)
{
  if (empty($price)) {
    return "<strong>Giá: Liên hệ</strong>";
  }

  return $price;
}

add_action('woocommerce_before_add_to_cart_quantity', 'woosuite_echo_qty_front_add_cart');

function woosuite_echo_qty_front_add_cart()
{
  echo '<span style="flex: 0 0 auto;">Số lượng: </span>';
}