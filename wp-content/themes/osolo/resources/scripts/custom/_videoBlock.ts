export default function () {
  $('.play-btn').on('click', function () {
    const videosrc =
      $(this).parent().parent().next().find('iframe').attr('src') +
      '&autoplay=1';
    $(this).parent().parent().next().find('iframe').attr('src', videosrc);
    $(this).parent().parent().fadeOut();
  });
}
