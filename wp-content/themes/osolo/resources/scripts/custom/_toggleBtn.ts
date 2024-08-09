export default function () {
  $('#filter-toggler').on('click', function () {
    $('.c-category-filter__wrapper--mobile').addClass('open');
  });

  $('#close-btn').on('click', function () {
    $('.c-category-filter__wrapper--mobile').removeClass('open');
  });
}
