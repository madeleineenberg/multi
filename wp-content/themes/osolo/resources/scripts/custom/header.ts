import gsap from 'gsap';

export default function () {
  const tl1 = gsap.timeline();

  tl1.from('.logo , .menu-open, .footer, .error-text', {
    duration: 0.8, // Adjusted from 0.6 to 0.7
    y: -100,
    opacity: 0,
    stagger: {
      amount: 0.4, // Adjusted from 0.3 to 0.35
    },
  });

  const tl = gsap.timeline({
    paused: true,
  });

  tl.to('.menu-container', {
    duration: 0.7, // Adjusted from 0.6 to 0.7
    x: 0,
  });
  tl.from(
    '.menu-close',
    {
      opacity: 0,
      rotate: '180deg',
      duration: 0.7, // Adjusted from 0.6 to 0.7
    },
    '-=.14', // Adjusted from '-=.12' to '-=.14'
  );
  tl.from(
    '.line',
    {
      duration: 0.5, // Adjusted from 0.4 to 0.5
      stagger: {
        amount: 0.35, // Adjusted from 0.3 to 0.35
      },
      width: '0%',
    },
    '-=.14', // Adjusted from '-=.12' to '-=.14'
  );
  tl.from(
    '.menu-item-number',
    {
      duration: 0.7, // Adjusted from 0.6 to 0.7
      stagger: {
        amount: 0.35, // Adjusted from 0.3 to 0.35
      },
      y: 100,
    },
    '-=.18', // Adjusted from '-=.16' to '-=.18'
  );
  tl.from(
    '.menu-item-name',
    {
      duration: 0.7, // Adjusted from 0.6 to 0.7
      stagger: {
        amount: 0.35, // Adjusted from 0.3 to 0.35
      },
      y: 100,
    },
    '-=.7', // Adjusted from '-=.6' to '-=.7'
  );
  tl.from(
    '.menu-item-sub',
    {
      duration: 0.7, // Adjusted from 0.6 to 0.7
      stagger: {
        amount: 0.35, // Adjusted from 0.3 to 0.35
      },
      y: 100,
    },
    '-=.7', // Adjusted from '-=.6' to '-=.7'
  );
  tl.from(
    '.menu-item-icon',
    {
      duration: 0.7, // Adjusted from 0.6 to 0.7
      stagger: {
        amount: 0.35, // Adjusted from 0.3 to 0.35
      },
      y: 100,
    },
    '-=.7', // Adjusted from '-=.6' to '-=.7'
  );

  $('.menu-open').on('click', function () {
    tl.play();
  });

  $('.menu-close').on('click', function () {
    tl.reverse();
  });
}
