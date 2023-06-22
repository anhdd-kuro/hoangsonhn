<?php

function parse_categories_data($categories)
{
  $parsed_categories = [];

  foreach ($categories as $category) {
    $thumbnail_id       = get_term_meta($category->term_id, 'thumbnail_id', true);
    $category_image_url = wp_get_attachment_url($thumbnail_id);
    $image_src          = $category_image_url ?: 'https://hoangsonhn.vn/wp-content/uploads/woocommerce-placeholder-430x430.png';
    $image_alt          = 'Ảnh đại diện danh mục sản phẩm';
    $category_url       = get_category_link($category->term_id);

    $parsed_categories[] = [
      'slug'         => $category->slug,
      'name'         => $category->name,
      'image_url'    => $image_src,
      'image_alt'    => $image_alt,
      'category_url' => $category_url,
    ];
  }

  return $parsed_categories;
}

// Register custom WPBakery block
add_action('init', 'custom_sub_cat_block');
function custom_sub_cat_block()
{
  vc_map(array(
    'name'          => __('Custom sub categories', 'text-domain'),
    'base'          => 'custom_sub_cat_block',
    'params'        => array(),
    'html_template' => dirname(__FILE__) . '/template.php',
  ));
}
