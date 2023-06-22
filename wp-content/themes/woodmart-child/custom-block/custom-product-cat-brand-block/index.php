<?php
// Register custom WPBakery block
add_action('init', 'register_custom_categogies_of_brand');
function register_custom_categogies_of_brand()
{
  vc_map(array(
    'name'          => __('Custom Categogies of brand', 'text-domain'),
    'base'          => 'custom_categogies_of_brand',
    'params'        => array(),
    'html_template' => dirname(__FILE__) . '/template.php',
  ));
}
