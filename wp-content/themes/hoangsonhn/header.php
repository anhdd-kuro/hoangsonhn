<?php
$args = [
  'taxonomy'   => 'product_cat',
  'orderby'    => 'name',
  'order'      => 'ASC',
  'number'     => 10,
  'post_type'  => 'product',
  'hide_empty' => false,
];

// Get level 1 categories
$categories_lv1 = get_terms(array_merge($args, [
  'parent' => 0,
]));

$categories = [];

foreach ($categories_lv1 as $category_lv1) {
  $category_lv1_data = [
    'id'       => $category_lv1->term_id,
    'name'     => $category_lv1->name,
    'slug'     => $category_lv1->slug,
    'children' => [],
  ];

  // Get level 2 categories
  $current_categories_lv2 = get_terms(array_merge($args, [
    'parent' => $category_lv1->term_id,
  ]));

  $category_lv2_data = [];

  foreach ($current_categories_lv2 as $category_lv2) {
    // Get level 3 categories
    $current_categories_lv3 = get_terms(array_merge($args, [
      'parent' => $category_lv2->term_id,
    ]));

    $category_lv3_data = [];

    // Convert level 3 categories to array
    foreach ($current_categories_lv3 as $category_lv3) {
      $category_lv3_data[] = [
        'id'   => $category_lv3->term_id,
        'name' => $category_lv3->name,
        'slug' => $category_lv3->slug,
      ];
    }

    // Convert level 2 categories to array
    $category_lv2_data[] = [
      'id'       => $category_lv2->term_id,
      'name'     => $category_lv2->name,
      'slug'     => $category_lv2->slug,
      'children' => $category_lv3_data,
    ];
  }

  // Sort level 2 categories by the number of children
  usort($category_lv2_data, function ($a, $b) {
    return count($b['children']) <=> count($a['children']);
  });

  // Add level 2 categories to level 1 categories
  $category_lv1_data['children'] = $category_lv2_data;
  $categories[]                  = $category_lv1_data;
}
?>

<header class="bg-white py-4">
  <div class="container flex items-center justify-between">
    <!-- Logo -->
    <a href="/" class="w-20">
      <img src="<?php echo IMG_ROOT . "logo.png" ?>" alt="Hoàng Sơn">
    </a>
  </div>
  <div class="flex bg-orange-300 p-4">
    <div class="container flex">
      <!-- Navigation - Mega Menu -->
      <nav class="relative group">
        <button class="px-5 py-2 font-bold bg-white rounded-md space-x-1">
          <i class="fa-solid fa-bars"></i>
          <span>
            Danh mục sản phẩm
          </span>
        </button>

        <!-- Dropdown Menu -->
        <!-- Show on hover -->
        <div class="hidden absolute bottom-0 group-hover:block translate-y-full pt-1 w-full">
          <ul class="relative group-hover:flex hover:flex flex-col bg-white drop-shadow-lg rounded-md w-full divide-y divide-solid">
            <!-- Categories lv 1 -->
            <?php foreach ($categories as $category_lv1): ?>
            <li>
              <a class="flex justify-between items-center w-full p-4 hover:text-orange-500 peer"
                href="<?php echo "/" . $category_lv1['slug'] ?>">
                <span><?php echo $category_lv1['name'] ?></span>
                <i class="fa-solid fa-chevron-right fa-2xs"></i>
              </a>

              <!-- Categories lv 2 -->
              <?php if (!empty($category_lv1['children'])): ?>
              <!-- Show on hover -->
              <div class="hidden absolute top-0 right-0 translate-x-full pl-1 peer-hover:block hover:block">
                <div class="bg-white p-4 w-[60rem] h-[560px] overflow-y-auto rounded-md">
                  <ul class="text-sm w-full grid grid-cols-[repeat(auto-fill,minmax(25%,1fr))] gap-x-6 gap-y-8">
                    <?php foreach ($category_lv1['children'] as $category_lv2): ?>
                    <li class="flex flex-col pl-1 gap-y-3">
                      <a href="<?php echo "/" . $category_lv2['slug'] ?>" class="hover:text-orange-500 font-bold">
                        <?php echo $category_lv2['name'] ?>
                      </a>
                      <!-- Categories lv 3 -->
                      <?php if (!empty($category_lv2['children'])): ?>
                      <ul class="flex flex-col gap-y-4">
                        <?php foreach ($category_lv2['children'] as $category_lv3): ?>
                        <li>
                          <a href="<?php echo "/" . $category_lv3['slug'] ?>"
                            class="flex items-center w-full hover:text-orange-500 space-x-2">
                            <i class="fa-solid fa-chevron-right fa-2xs"></i>
                            <span><?php echo $category_lv3['name'] ?></span>
                          </a>
                        </li>
                        <?php endforeach;?>
                      </ul>
                      <?php endif;?>
                      <!-- End lv 3 -->
                    </li>
                    <?php endforeach;?>
                  </ul>
                </div>
              </div>
              <?php endif;?>
              <!-- End lv 2 -->
            </li>
            <?php endforeach;?>
          </ul>
          <!-- End lv 1 -->
        </div>
      </nav>
    </div>
  </div>
</header>