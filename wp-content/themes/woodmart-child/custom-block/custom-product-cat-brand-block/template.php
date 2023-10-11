<!-- Style based on Woodmart Product categories grid type -->

<?php

// Get the brand slug from the URL
// $brand_slug = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$brand_slug = '';
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Split the URL path into an array of segments
$segments = explode('/', trim($url_path, '/'));

// Find the index of the "danh-muc-san-pham" segment
$brand_index = array_search('brand', $segments);

// Get the category slug
if ($brand_index !== false && isset($segments[$brand_index + 1])) {
    $brand_slug = $segments[$brand_index + 1];
}

// Get the brand term using the slug
$brand = get_term_by('slug', $brand_slug, 'pa_brand');
    // print_r($brand);


// Initialize an empty array to store the category information
$categories = [];

// Check if the brand term exists
if ($brand) {
  // Get all products associated with the brand
  $args = [
    'post_type'      => 'product',
    'tax_query'      => [
      [
        'taxonomy' => 'pa_brand',
        'field'    => 'term_id',
        'terms'    => $brand->term_id,
      ],
    ],
    'posts_per_page' => -1,
  ];

  $products = new WP_Query($args);

  // Loop through the products and collect the associated category information
  while ($products->have_posts()) {
    $products->the_post();
    $product_id      = get_the_ID();
    $categories_info = wp_get_post_terms($product_id, 'product_cat');

    foreach ($categories_info as $category_info) {
      $thumbnail_id       = get_term_meta($category_info->term_id, 'thumbnail_id', true);
      $category_image_url = wp_get_attachment_url($thumbnail_id);
      $image_src          = $category_image_url ?: 'https://hoangsonhn.vn/wp-content/uploads/woocommerce-placeholder-430x430.png';
      $image_alt          = 'Ảnh đại diện danh mục sản phẩm';
      $category_url       = get_category_link($category_info->term_id) . '?filter_brand=' . $brand->slug;

      $category = [
        'slug'         => $category_info->slug,
        'name'         => $category_info->name,
        'image_url'    => $image_src,
        'image_alt'    => $image_alt,
        'category_url' => $category_url,
      ];

      // Check if the category already exists in the array
      $exists = false;
      foreach ($categories as $existing_category) {
        if ($existing_category['slug'] === $category_info->slug) {
          $exists = true;
          break;
        }
      }

      // Add the category to the array if it doesn't exist
      if (!$exists) {
        $categories[] = $category;
      }
    }
  }
  wp_reset_postdata();
}

?>

<?php if (!empty($categories)): ?>
<div id="product-archive-title"
  class="text-left title-wrapper wd-wpb set-mb-s reset-last-child wd-title-color-default wd-title-style-bordered wd-underline-colored">
  <div class="liner-continer">
    <h2 class="woodmart-title-container title wd-font-weight- wd-fontsize-l">
      Danh mục sản phẩm thuộc thương hiệu <?php echo $brand->name; ?>
    </h2>
  </div>

  <p class="title-after_title set-cont-mb-s reset-last-child wd-fontsize-xs">
    Xem danh sách sản phẩm <strong>thương hiệu <?php echo $brand->name ?></strong> phía dưới hoặc bấm chọn danh mục mà quý khách muốn xem
  </p>
</div>

<div class="wd-categories-wrap wd-wpb">
  <?php get_template_part('custom-block/inc/categories_list', null, [
    'categories' => $categories,
  ]) ?>
</div>
<?php endif; ?>