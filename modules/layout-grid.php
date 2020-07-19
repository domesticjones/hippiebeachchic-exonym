<?php
  $id = get_the_id();
  $photos = get_field('photos');
  $data = get_field('availability');
  $modalContent = ex_modal_images($photos['a'], $photos['b'], '$' . $data['cost'], $id, $data['sold']);
?>
<li id="modal-trigger-<?php echo $id; ?>" class="modal-trigger" style="background-image: url(<?php echo $photos['a']['sizes']['thumbnail-medium']; ?>)">
  <?php
    echo wp_get_attachment_image($photos['a']['id'], 'thumbnail-medium', false, array('class' => 'layout-grid-image'));
    echo ex_modal($id, $modalContent);
  ?>
  <h2 class="layout-grid-id">#<?php echo $id; ?></h2>
</li>
