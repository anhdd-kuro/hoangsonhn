<?php
  $ajax_filter_trigger_class = "category-grid-item";
  $categories = $args['categories'];
?>

<?php if (!empty($categories)): ?>
<ul class="products woocommerce row categories-style-default wd-spacing-20 columns-8"
  style="list-style: none; padding-left: 0;">
  <?php foreach ($categories as $index => $category): ?>
  <li
    class="col-lg-12_5 col-md-3 col-4 first <?php echo $ajax_filter_trigger_class ?> cat-design-alt categories-with-shadow without-product-count product-category product"
    data-loop="<?php echo $index ?>">
    <div class="wrapp-category">
      <div class="category-image-wrapp">
        <a href="<?php echo esc_url($category['category_url']); ?>" class="category-image">
          <img width="430" height="430" src="<?php echo esc_url($category['image_url']); ?>"
            class="woocommerce-placeholder wp-post-image wd-lazy-load wd-lazy-fade wd-loaded"
            alt="<?php echo esc_attr($category['image_alt']); ?>" loading="lazy"
            data-wood-src="<?php echo esc_url($category['image_url']); ?>"
            data-srcset="<?php echo esc_url($category['image_url']); ?> 430w, <?php echo esc_url($category['image_url']); ?> 150w, <?php echo esc_url($category['image_url']); ?> 700w, <?php echo esc_url($category['image_url']); ?> 300w, <?php echo esc_url($category['image_url']); ?> 1024w, <?php echo esc_url($category['image_url']); ?> 768w, <?php echo esc_url($category['image_url']); ?> 1200w"
            srcset="<?php echo esc_url($category['image_url']); ?> 430w, <?php echo esc_url($category['image_url']); ?> 150w, <?php echo esc_url($category['image_url']); ?> 700w, <?php echo esc_url($category['image_url']); ?> 300w, <?php echo esc_url($category['image_url']); ?> 1024w, <?php echo esc_url($category['image_url']); ?> 768w, <?php echo esc_url($category['image_url']); ?> 1200w">
        </a>
      </div>
      <div class="hover-mask">
        <h3 class="wd-entities-title" style="text-align: center; margin-top: 5px;">
          <?php echo $category['name']; ?>
        </h3>
      </div>
      <a href="<?php echo esc_url($category['category_url']); ?>" class="category-link wd-fill"
        aria-label="Product category <?php echo esc_attr($category['slug']); ?>"></a>
    </div>
  </li>

  <?php endforeach; ?>
</ul>
<?php endif; ?>