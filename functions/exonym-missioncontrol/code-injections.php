<?php
  if (!defined('WPINC')) { die; }

  // Inject Header
  function ex_injectHeader() {
    the_field('inject_header', 'options');
  }
  add_action('wp_head', 'ex_injectHeader', 99);

  function ex_cssHotfix() {
    $cssHotfix = get_field('css_hotfix', 'options');
    if(!empty($cssHotfix)) {
      echo '<style>' . $cssHotfix . '</style>';
    }
  }
  add_action('wp_head', 'ex_cssHotfix', 100);

  // Inject Footer
  function ex_injectFooter() {
    the_field('inject_footer', 'options');
  }
  add_action('wp_footer', 'ex_injectFooter', 99);
