export default function () {
  $('.nav-primary .nav > .menu-item-has-children > a').on(
    'click',
    function (e) {
      e.preventDefault();
      $(this).closest('.menu-item-has-children').toggleClass('open');
      $(this).siblings('.sub-menu:first').toggleClass('open-layer-one');
    },
  );

  $('.sub-menu .menu-item-has-children > a').on('click', function (e) {
    e.preventDefault();

    $(this)
      .siblings('.sub-menu')
      .closest('.menu-item-has-children')
      .toggleClass('open-layer-two')
      .siblings()
      .removeClass('open-layer-two');
  });

  if ($('.open-layer-one')) {
    $('.open-layer-one .menu-back').on('click', function (e) {
      console.log(e.target);
      $(e.target)
        .closest('.open-layer-one')
        .removeClass('open-layer-one')
        .parent()
        .removeClass('open');
    });
  }

  $('.menu-back').on('click', function (e) {
    $(e.target)
      .closest('.menu-back')
      .parent('.open-layer-one')
      .removeClass('open-layer-one')
      .parent()
      .removeClass('open');

    $(this)
      .closest('.menu-back')
      .closest('.open-layer-two')
      .removeClass('open-layer-two');
  });

  $('#hamburger').on('click', function (e) {
    $('.c-header').toggleClass('open');
    $(e.target).closest('div').toggleClass('open');
    $('.nav-right').slideToggle();
    $('.nav-primary').slideToggle();
    $('.nav-search').slideToggle();
    $('.overlay-menu').toggle();
    $('body').toggleClass('openMenu');
  });

  $('.nav-search').on('click', function () {
    $('.search-box').slideToggle();
  });

  if ($('body').hasClass('home')) {
    let scroll_pos: number = 0;

    $(document).on('scroll', function () {
      scroll_pos = $(this).scrollTop() as number;

      if (scroll_pos > 20) {
        $('.c-header').css('background', 'white');
      } else {
        $('.c-header').css('background', '');
      }
    });
  }
}
