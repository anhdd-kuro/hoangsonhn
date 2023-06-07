<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php wp_head() ?>
</head>
<body>
  <?php get_header(""); ?>

  <h1>Hello world</h1>
  <?php
  $products = wc_get_products([
    'limit' => 10,
    'return' => 'objects',
  ]);
  ?>

  <?php
  foreach ($products as $product) {
    echo $product->get_name();
    echo $product->get_price_html();
    // echo $product->get_image();
  }
  ?>

  <?php wp_footer();?>
</body>
</html>
