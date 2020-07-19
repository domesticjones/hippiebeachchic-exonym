<?php
	get_header();
    $masksQueryArgs = array(
    	'post_type'      => array('masks'),
    	'posts_per_page' => '999999',
      'meta_query'     => array(
        array(
          'key'   => 'availability_sold',
          'value' => '0',
        )
      )
    );
    ex_wrap('start-body');
	    $masksQuery = new WP_Query($masksQueryArgs);
	    if($masksQuery->have_posts()) {
				echo '<ol class="layout-grid">';
	    	while($masksQuery->have_posts()) {
	    		$masksQuery->the_post();
					get_template_part('modules/layout', 'grid');
	    	}
				echo '</ol>';
	    } else {
	      echo '<p>No Masks are currently for sale.</p>';
	    }
	    wp_reset_postdata();
    ex_wrap('end-body');
	get_footer();
?>
