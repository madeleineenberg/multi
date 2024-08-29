import gsap from 'gsap';

export default function () {
  const tl1 = gsap.timeline();

  tl1.from('.logo , .menu-open, .footer, .error-text', {
    duration: 1,
    y: -100,
    opacity: 0,
    stagger: {
      amount: 0.5,
    },
  });

  const tl = gsap.timeline({
    paused: true,
  });

  tl.to('.menu-container', {
    duration: 1,
    x: 0,
  });
  tl.from(
    '.menu-close',
    {
      opacity: 0,
      rotate: '180deg',
    },
    '-=.2',
  );
  tl.from(
    '.line',
    {
      duration: 1,
      stagger: {
        amount: 0.5,
      },
      width: '0%',
    },
    '-=.2',
  );
  tl.from(
    '.menu-item-number',
    {
      duration: 1,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=1.3',
  );
  tl.from(
    '.menu-item-name',
    {
      duration: 1,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=1.2',
  );
  tl.from(
    '.menu-item-sub',
    {
      duration: 1,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=1.1',
  );
  tl.from(
    '.menu-item-icon',
    {
      duration: 1,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=1',
  );

  $('.menu-open').on('click', function () {
    tl.play();
  });

  $('.menu-close').on('click', function () {
    tl.reverse();
  });
}
