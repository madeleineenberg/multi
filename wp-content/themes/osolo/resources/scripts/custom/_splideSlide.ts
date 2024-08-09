import Splide from '@splidejs/splide';

export default function () {
  var elms = document.getElementsByClassName('splide') as any;

  if (elms.length) {
    for (var i = 0, len = elms.length; i < len; i++) {
      new Splide(elms[i] as any, {
        type: 'loop',
        height: '40rem',
        focus: 'center',
        autoWidth: true,
        gap: '25px',

        breakpoints: {
          667: {
            height: '25rem',
          },
        },
      }).mount();
    }
  }
}
