import gsap from 'gsap';

export default function () {
  const tl1 = gsap.timeline();

  tl1.from('.logo , .menu-open, .footer, .error-text', {
    duration: 0.8,
    y: -100,
    opacity: 0,
    stagger: {
      amount: 0.4,
    },
  });

  const tl = gsap.timeline({
    paused: true,
  });

  tl.to('.menu-container', {
    duration: 0.8,
    x: 0,
  });
  tl.from(
    '.menu-close',
    {
      opacity: 0,
      rotate: '180deg',
    },
    '-=.16',
  );
  tl.from(
    '.line',
    {
      duration: 0.6,
      stagger: {
        amount: 0.5,
      },
      width: '0%',
    },
    '-=.16',
  );
  tl.from(
    '.menu-item-number',
    {
      duration: 0.8,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=.2',
  );
  tl.from(
    '.menu-item-name',
    {
      duration: 0.8,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=.8',
  );
  tl.from(
    '.menu-item-sub',
    {
      duration: 0.8,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=.8',
  );
  tl.from(
    '.menu-item-icon',
    {
      duration: 0.8,
      stagger: {
        amount: 0.5,
      },
      y: 100,
    },
    '-=.8',
  );

  $('.menu-open').on('click', function () {
    tl.play();
  });

  $('.menu-close').on('click', function () {
    tl.reverse();
  });
}
