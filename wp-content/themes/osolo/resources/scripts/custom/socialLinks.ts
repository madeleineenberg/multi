export default function () {
  $('a.c-social-links__link').on('mouseover', function () {
    $('.c-social-links__box')
      .find('ion-icon')
      .attr('name', $(this).data('icon'));
  });

  $('.c-social-links__link').on('mouseleave', function () {
    $('.c-social-links__box')
      .find('ion-icon')
      .attr('name', $('.c-social-links__box').data('icon'));
  });
}
