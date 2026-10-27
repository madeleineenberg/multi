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

  const icons = document.querySelectorAll('.icon-link');
  let currentIndex = 0;

  function showNextIcon() {
    icons.forEach((icon, index) => {
      icon.classList.remove('active');
      if (index === currentIndex) {
        icon.classList.add('active');
      }
    });
    currentIndex = (currentIndex + 1) % icons.length;
  }

  showNextIcon();
  setInterval(showNextIcon, 3000);
}
