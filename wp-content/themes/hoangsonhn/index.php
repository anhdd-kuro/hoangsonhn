<?php

$current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Construct the path to the page template based on the current URL
$page_template_path =  "pages" . $current_url . "index";

// Try to load the page template
if(false === get_template_part($page_template_path)) {

  // If the page template doesn't exist, try a fallback template
  $page_template_path = "pages" . $current_url . "_/index";

  // Try to load the fallback template
  if(false === get_template_part($page_template_path)) {
    // If the fallback template doesn't exist, load the 404 template
    get_template_part("404");
  }
}