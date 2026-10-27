import gsap from 'gsap';

export default function () {
  function handleScrollBlur() {
    const banner = document.querySelector('.banner') as HTMLElement;
    if (!banner) return;

    const scrollContainer = document.querySelector('[data-scroll-container]');
    const isLocomotiveActive = scrollContainer && !$('body').hasClass('single-galleri');

    if (isLocomotiveActive) {
      setTimeout(() => {
        const locomotiveScroll = (window as any).locomotiveScroll;
        
        if (locomotiveScroll) {
          locomotiveScroll.on('scroll', (args: any) => {
            const scrollY = args.scroll.y;

            if (scrollY > 50) {
              banner.style.backdropFilter = 'blur(7px)';
              (banner.style as any).webkitBackdropFilter = 'blur(7px)';
            } else {
              banner.style.backdropFilter = 'none';
              (banner.style as any).webkitBackdropFilter = 'none';
            }
          });
        } else {
          const scrollEl = document.querySelector('[data-scroll-container]') as HTMLElement;
          if (scrollEl) {
            let ticking = false;
            
            const handleScroll = () => {
              if (!ticking) {
                requestAnimationFrame(() => {
                  const scrollY = scrollEl.scrollTop;

                  if (scrollY > 50) {
                    banner.style.backdropFilter = 'blur(7px)';
                    (banner.style as any).webkitBackdropFilter = 'blur(7px)';
                  } else {
                    banner.style.backdropFilter = 'none';
                    (banner.style as any).webkitBackdropFilter = 'none';
                  }
                  
                  ticking = false;
                });
                ticking = true;
              }
            };
            
            scrollEl.addEventListener('scroll', handleScroll);
          }
        }
      }, 2000);
    } else {
      let scrollY = 0;
      let ticking = false;

      function updateBlur() {
        scrollY = window.scrollY;

        if (scrollY > 50) {
          banner.style.backdropFilter = 'blur(7px)';
          (banner.style as any).webkitBackdropFilter = 'blur(7px)';
        } else {
          banner.style.backdropFilter = 'none';
          (banner.style as any).webkitBackdropFilter = 'none';
        }

        ticking = false;
      }

      function requestTick() {
        if (!ticking) {
          requestAnimationFrame(updateBlur);
          ticking = true;
        }
      }

      window.addEventListener('scroll', requestTick);
    }
  }

  handleScrollBlur();
  const tl1 = gsap.timeline();

  // CSS håller logotyp, menyknapp och sidfot på opacity 0 tills den här
  // klassen sätts, så att de inte hinner målas innan tidslinjen finns.
  document.body.classList.add('is-ready');

  // fromTo, inte from: .logo har en transition som startar när klassen ovan
  // sätts, så .from() skulle läsa 0 som slutvärde och aldrig visa logotypen.
  tl1.fromTo(
    '.logo , .menu-open, .footer, .error-text, .return',
    {
      y: -100,
      opacity: 0,
    },
    {
      duration: 0.8,
      y: 0,
      opacity: 1,
      stagger: {
        amount: 0.4,
      },
    },
  );

  const tl = gsap.timeline({
    paused: true,
  });

  tl.to('.menu-container', {
    duration: 0.7,
    x: 0,
  });
  tl.from(
    '.menu-close',
    {
      opacity: 0,
      rotate: '180deg',
      duration: 0.7,
    },
    '-=.14',
  );
  tl.from(
    '.line',
    {
      duration: 0.5,
      stagger: {
        amount: 0.35,
      },
      width: '0%',
    },
    '-=.14',
  );
  tl.from(
    '.menu-item-number',
    {
      duration: 0.5,
      stagger: {
        amount: 0.35,
      },
      y: 100,
    },
    '-=.18',
  );
  tl.from(
    '.menu-item-name',
    {
      duration: 0.5,
      stagger: {
        amount: 0.35,
      },
      y: 100,
    },
    '-=.7',
  );
  tl.from(
    '.menu-item-sub',
    {
      duration: 0.6,
      stagger: {
        amount: 0.35,
      },
      y: 100,
    },
    '-=.7',
  );
  tl.from(
    '.menu-item-icon',
    {
      duration: 0.6,
      stagger: {
        amount: 0.35,
      },
      y: 100,
    },
    '-=.7',
  );

  // Snabbar upp hela sekvensen, även .reverse(), utan att röra varje duration.
  const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)',
  ).matches;

  tl.timeScale(prefersReducedMotion ? 12 : 1.7);

  const openButton = document.querySelector<HTMLButtonElement>('.menu-open');
  const closeButton = document.querySelector<HTMLButtonElement>('.menu-close');
  const menu = document.querySelector<HTMLElement>('.menu-container');

  if (openButton && closeButton && menu) {
    let menuIsOpen = false;
    let focusBeforeMenu: HTMLElement | null = null;

    const openMenu = () => {
      menuIsOpen = true;
      focusBeforeMenu = document.activeElement as HTMLElement;
      menu.removeAttribute('inert');
      menu.setAttribute('aria-hidden', 'false');
      openButton.setAttribute('aria-expanded', 'true');
      document.body.classList.add('has-menu-open');
      (window as any).locomotiveScroll?.stop();
      tl.play();
      closeButton.focus();
    };

    const closeMenu = () => {
      if (!menuIsOpen) {
        return;
      }
      menuIsOpen = false;
      menu.setAttribute('inert', '');
      menu.setAttribute('aria-hidden', 'true');
      openButton.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('has-menu-open');
      (window as any).locomotiveScroll?.start();
      tl.reverse();
      focusBeforeMenu?.focus();
    };

    openButton.addEventListener('click', openMenu);
    closeButton.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (event) => {
      if (!menuIsOpen) {
        return;
      }

      if (event.key === 'Escape') {
        closeMenu();
        return;
      }

      if (event.key !== 'Tab') {
        return;
      }

      const focusable = [
        closeButton,
        ...Array.from(menu.querySelectorAll<HTMLElement>('a[href]')),
      ];
      const first = focusable[0];
      const last = focusable[focusable.length - 1];

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    });
  }
}
