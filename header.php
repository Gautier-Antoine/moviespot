<?php
    $brand = '<a class="nav-brand" href="' . get_home_url() . '" title="Go to the home">' . get_bloginfo('name') . '</a>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
      <link rel="profile" href="http://gmpg.org/xfn/11">
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
      <?php wp_head() ?>
  </head>

  <body <?php body_class() ?> >
      <?php wp_body_open(); ?>
        <header class="site-header" role="banner">
          <?= $brand ?>
          <nav>
            <a href="/movies">Check the movies</a>
          </nav>
        </header>
      	<div id="content" class="site-content" tabindex="-1">