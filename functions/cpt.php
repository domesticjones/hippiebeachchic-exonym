<?php
if (!defined('WPINC')) { die; }
/*
===========================
  [[[ Custom Post Types ]]]
===========================
*/

// Clear Rewrite Rules for CPT's
function ex_theme_terlet() {
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'ex_theme_terlet');

// CPT: Masks
function cpt_masks() {

	$labels = array(
		'name'                  => _x( 'Masks', 'Post Type General Name', 'exonym' ),
		'singular_name'         => _x( 'Mask', 'Post Type Singular Name', 'exonym' ),
		'menu_name'             => __( 'Masks', 'exonym' ),
		'name_admin_bar'        => __( 'Masks', 'exonym' ),
		'archives'              => __( 'Mask Archives', 'exonym' ),
		'attributes'            => __( 'Mask Attributes', 'exonym' ),
		'parent_item_colon'     => __( 'Parent Mask:', 'exonym' ),
		'all_items'             => __( 'All Masks', 'exonym' ),
		'add_new_item'          => __( 'Add New Mask', 'exonym' ),
		'add_new'               => __( 'Add New', 'exonym' ),
		'new_item'              => __( 'New Mask', 'exonym' ),
		'edit_item'             => __( 'Edit Mask', 'exonym' ),
		'update_item'           => __( 'Update Mask', 'exonym' ),
		'view_item'             => __( 'View Mask', 'exonym' ),
		'view_items'            => __( 'View Masks', 'exonym' ),
		'search_items'          => __( 'Search Mask', 'exonym' ),
		'not_found'             => __( 'Not found', 'exonym' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'exonym' ),
		'featured_image'        => __( 'Featured Image', 'exonym' ),
		'set_featured_image'    => __( 'Set featured image', 'exonym' ),
		'remove_featured_image' => __( 'Remove featured image', 'exonym' ),
		'use_featured_image'    => __( 'Use as featured image', 'exonym' ),
		'insert_into_item'      => __( 'Insert into Mask', 'exonym' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Mask', 'exonym' ),
		'items_list'            => __( 'Masks list', 'exonym' ),
		'items_list_navigation' => __( 'Masks list navigation', 'exonym' ),
		'filter_items_list'     => __( 'Filter Masks list', 'exonym' ),
	);
	$rewrite = array(
		'slug'                  => 'mask',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Mask', 'exonym' ),
		'labels'                => $labels,
		'supports'              => array(null),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
    'menu_icon'             => 'dashicons-smiley',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'masks', $args );

}
add_action( 'init', 'cpt_masks', 0 );

// Admin Menu Colulmns
add_filter('manage_masks_posts_columns', 'ex_masks_columns');
function ex_masks_columns($columns) {
   $columns = array(
     'cb' => $columns['cb'],
     'id'     => __('Mask ID'),
     'photos' => __('Photos', 'exonym'),
     'avail'  => __('Availability', 'exonym' ),
   );
 return $columns;
}
add_action('manage_masks_posts_custom_column', 'ex_masks_column', 10, 2);
function ex_masks_column($column, $post_id) {
  if('id' === $column) {
    echo '<h2 style="margin: 0.5em 0; font-size: 3em; font-weight: 700;"><a href="/wp-admin/post.php?post=' . $post_id . '&action=edit&classic-editor">' . $post_id . '</a></h2>';
  }
  if('photos' === $column) {
    $photos = get_field('photos');
    if($photos['a']) {
      echo wp_get_attachment_image($photos['a']['id'], 'thumbnail');
    } else {
      echo '<p>Photo A hasn\'t been uploaded!</p>';
    }
    if($photos['b']) {
      echo wp_get_attachment_image($photos['b']['id'], 'thumbnail');
    } else {
      echo '<p>Photo B hasn\'t been uploaded!</p>';
    }
  }
  if('avail' === $column) {
    $avail = get_field('availability');
    if($avail['sold']) {
      echo '<p style="color: red;">Sold Out</p>';
    } else {
      echo '<p>Available for $' . $avail['cost'] . '</p>';
    }
  }
}

function ex_edit_form_after_title() {
  $adminPost = $_GET['post'] ? $_GET['post'] : '<small style="font-size: 0.25em; vertical-align: middle">Save to generate ID</small>';
  echo '<h2 style="margin: 0; padding: 0; font-size: 3em; font-weight: 700;">Mask ID: ' . $adminPost . '</h2>';
}
add_action('edit_form_after_title', 'ex_edit_form_after_title');
