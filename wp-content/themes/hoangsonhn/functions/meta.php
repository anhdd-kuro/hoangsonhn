<?php

function makeMetaTags($config) {
  $config = [
    "title" => $config['title'],
    "desc"  => $config['desc'],
    "url"   => "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
    "ogp"   => IMG_ROOT . ($config['ogp'] ?? 'ogp.png'),
  ];

  return <<<HTML
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{$config['title']}</title>
    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="{$config['title']}" />
    <meta name="description" content="{$config['desc']}">
    <meta property="og:url" content="{$config['url']}" />
    <meta property="og:image" content="{$config['ogp']}" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{$config['url']}" />
    <meta name="twitter:image" content="{$config['ogp']}" />
    <meta name="twitter:title" content="{$config['title']}" />
    <meta name="twitter:description" content="{$config['desc']}" />

HTML;
}