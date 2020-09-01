<?php
  /* Default Template */
  get_header();
    if(have_posts()) { while(have_posts()) { the_post();
      ex_wrap('start-body');
        ex_wrap('start', 'pageContent');
          the_content();
        ex_wrap('end');
      ex_wrap('end-body');
    }}
  get_footer();
?>
