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
    if($position == 'start' || $position == 'start-modules') {
      $stylesBackground = '';
      $stylesOuterPrint = [];
      $stylesInnerPrint = [];
      if($position == 'start-modules') {
        $size = get_sub_field('module_size');
        $p = get_sub_field('module_padding');
        $pad = ['module-pad-t-' . $p['top'], 'module-pad-b-' . $p['bottom'], 'module-pad-l-' . $p['left'], 'module-pad-r-' . $p['right']];
        $height = $size['height']['number'];
        if($height > 0) { $styleInline .= ' style="min-height: ' . $height . $size['height']['measure'] . ';"'; }
        $width = $size['width']['size'];
        $constrain = $size['width']['constrain'];
        $align = $size['width']['align'];
        if($width != 'full' && $constrain) {
          array_push($classesOuter, 'module-constrain', 'module-width-' . $width, 'module-align-' . $align);
        } else {
          array_push($classesInner, 'module-width-' . $width, 'module-align-' . $align);
        }
        $styleText = get_sub_field('module_text');
        array_push($stylesInnerPrint, 'module-text-' . $styleText['size'], 'module-color-' . $styleText['color']);
        $styleBg = get_sub_field('module_background');
        $styleAni = get_sub_field('module_animate');
        if($styleAni['on_enter']) { array_push($stylesOuterPrint, 'animate-on-enter'); }
        if($styleAni['on_leave']) { array_push($stylesOuterPrint, 'animate-on-leave'); }
        if($styleBg['settings']['color']) { array_push($stylesOuterPrint, 'module-bg-' . $styleBg['settings']['color']); }
        if($styleBg['image']) {
          $stylesBgInline = [];
          $stylesBgClasses = ['module-bg'];
          if($styleBg['settings']['parallax']) {
            array_push($stylesBgClasses, 'animate-parallax');
            array_push($stylesBgClasses, 'animate-z-' . $styleBg['settings']['intensity']);
          }
          array_push($stylesBgInline, 'background-image: url(' . $styleBg['image']['sizes']['jumbo'] . ')');
          array_push($stylesBgInline, 'background-position: ' . $styleBg['settings']['position_x'] . ' ' . $styleBg['settings']['position_y']);
          array_push($stylesBgInline, 'opacity: ' . $styleBg['settings']['opacity'] / 100);
          $stylesBackground = '<div class="' . implode(' ', $stylesBgClasses) . '" style="' . implode('; ', $stylesBgInline) . '"></div>';
        }
        $classesInnerPrint = array_merge($classesInner, $pad, $stylesInnerPrint);
      }
      $id = str_replace(' ', '-', strtolower(get_sub_field('module_id')));
      array_push($classesOuter, 'module-' . $name, implode(' ', $stylesOuterPrint));
      $output .= '<section id="' . $id . '" class="' . implode(' ', array_merge($classesOuter, $stylesOuterPrint)) . '"' . $styleInline . '>';
      if($stylesBackground) { $output .= $stylesBackground; }
      $output .= '<div class="' . implode(' ' , $classesInnerPrint) . '">';
    } elseif($position == 'end') {
      $output .= '</div>';
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

  function ex_content($id = false) {
    if(!$id) { $id = $post->ID; }
    if(have_rows('content_builder', $id)) {
      while(have_rows('content_builder', $id)) {
        the_row();
        ex_wrap('start-modules');
          echo '<p>asdf</p><blockquote><q>Quote Goes Here</q><cite>Person Name</cite></blockquote>';
        ex_wrap('end');
      }
    }
  }
