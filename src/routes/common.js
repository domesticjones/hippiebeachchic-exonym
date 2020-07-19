import $ from 'jquery';
window.jQuery = $;
require('slick-carousel');

export default {
  init() {
    $('.modal-trigger').click(e => {
      const $this = $(e.currentTarget);
      const id = $this.attr('id').substring(14);
      $(`#modal-${id}`).addClass('is-active');
    });
    $(document).on('click', '.modal-close', (e) => {
      const $this = $(e.currentTarget);
      $this.parent().removeClass('is-active');
    });
  },
  finalize() {
  },
};
