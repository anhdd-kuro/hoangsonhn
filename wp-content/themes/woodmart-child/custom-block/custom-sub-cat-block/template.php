<!-- Style based on Woodmart Product categories grid type -->
<?php

// Get the category slug
// $category_slug = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
// Get the queried object
$queried_object = get_queried_object();
$category_slug = '';

// Check if the queried object is a product category
if (is_a($queried_object, 'WP_Term') && $queried_object->taxonomy === 'product_cat') {
    // Get the category slug
    $category_slug = $queried_object->slug;
}

$thuong_hieu_gach_slug = $_GET['filter_thuong-hieu-gach'] ?: '';
$thuong_hieu_gach = $thuong_hieu_gach_slug ? get_term_by('slug', $thuong_hieu_gach_slug, 'pa_thuong-hieu-gach') : '';

$thuong_hieu_slug = $_GET['filter_brand'] ?: '';
$thuong_hieu = $thuong_hieu_slug ? get_term_by('slug', $thuong_hieu_slug, 'pa_brand') : '';

// Get the current category
$category = get_term_by('slug', $category_slug, 'product_cat');
// Initialize the parent category variable
$parent_category = null;

$subcategories = [];

if ($category) {
//   Get the subcategories of the current category
  $sub_categories_data = get_categories([
    'taxonomy' => 'product_cat',
    'parent'   => $category->term_id,
  ]);

  $subcategories = parse_categories_data($sub_categories_data);

  // If no subcategories found and the category has a parent, get the parent category
  if (empty($subcategories) && $category->parent !== 0) {
    $parent_category = get_term($category->parent, 'product_cat');
    // Get the subcategories of the parent category
    $sub_categories_data = get_categories([
      'taxonomy' => 'product_cat',
      'parent'   => $category->parent,
    ]);

    $subcategories = parse_categories_data($sub_categories_data);

  }
}
?>

<?php if ($category && !empty($subcategories)): ?>
<div id="product-archive-title"
  class="title-wrapper wd-wpb set-mb-s reset-last-child wd-title-color-default wd-title-style-bordered text-left wd-underline-colored">
  <div class="liner-continer">
    <h2 class="woodmart-title-container title wd-font-weight- wd-fontsize-l">
      Danh mục sản phẩm
      <?php if ($parent_category): ?>
        <?php echo $parent_category->name; ?>
      <?php else: ?>
        <?php echo $category->name; ?>
      <?php endif; ?>

      <?php if ($thuong_hieu_gach): ?>
      thương hiệu <?php echo $thuong_hieu_gach->name  ?>
      <?php endif; ?>
      <?php if ($thuong_hieu): ?>
      thương hiệu <?php echo $thuong_hieu->name ?>
      <?php endif; ?>
    </h2>
  </div>

  <p class="title-after_title set-cont-mb-s reset-last-child wd-fontsize-xs">
    Xem danh sách sản phẩm
    <strong>
      <?php echo $category->name ?> <?php if($thuong_hieu || $thuong_hieu_gach) echo "thương hiệu " . $thuong_hieu->name . $thuong_hieu_gach->name ?>
    </strong>
    phía dưới hoặc bấm chọn danh mục khác mà quý khách muốn xem
  </p>
</div>

<div class="wd-categories-wrap wd-wpb">
  <?php get_template_part('custom-block/inc/categories_list', null, [
      'categories' => $subcategories,
   ]) ?>
</div>
<?php endif;?>