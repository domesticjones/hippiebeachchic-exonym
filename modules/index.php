<?php
if (!defined('WPINC')) { die; }

  // Module Content Wrapper
  function ex_wrap($position, $name = 'default', $classes = null, $print = true) {
    $output = '';
    $classesOuter = ['module'];
    if($classes) { array_push($classesOuter, $classes); }
    $classesInner = ['module-inner'];
    $classesInnerPrint = [];
    $styleInline = '';
    if($position == 'start') {
      $output .= '<section id="module-' . $name . '" class="module' . $classes . '">';
    } elseif($position == 'end') {
      $output .= '</section>';
    } elseif($position == 'start-body') {
      $output .= '<article id="' . get_post_type() . '-' . get_the_ID() . '" class="module-wrapper ' . implode(' ', get_post_class()) . '">';
    } elseif($position == 'end-body') {
      $output .= '</article>';
    }
    if($print) {
      echo $output;
    } else {
      return $output;
    }
  }

  function ex_modal($id, $content) {
    $output = '<div id="modal-' . $id . '" class="modal-container">';
      $output .= '<div class="modal-close">close</div>';
      $output .= '<div class="modal-content">';
        $output .= $content;
      $output .= '</div>';
    $output .= '</div>';
    return $output;
  }

  function ex_modal_images($a, $b, $price, $id, $avail) {
    $aPhoto = wp_get_attachment_image($a['id'], 'thumbnail-large');
    $bPhoto = wp_get_attachment_image($b['id'], 'thumbnail-large');
    $availShow = $avail ? 'Unavailable' : 'For Sale';
    $infoBlob = '<div class="modal-image-info"><span class="price">' . $price . '</span><span class="id">&#35;' . $id . '</span><span class="avail">' . $availShow . '</span></div>';
    $output = '<div class="modal-images">' . $aPhoto . $bPhoto . $infoBlob . '</div>';
    return $output;
  }
