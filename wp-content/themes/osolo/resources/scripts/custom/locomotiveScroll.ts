import LocomotiveScroll from 'locomotive-scroll';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default function () {
  const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)',
  ).matches;

  const scrollContainer = document.querySelector('[data-scroll-container]');

  if (!scrollContainer) {
    console.error('Scroll container not found');
    return;
  }

  const scroll = new LocomotiveScroll({
    el: scrollContainer,
    smooth: !prefersReducedMotion,
    inertia: 0.8,
    smoothClass: 'has-scroll-smooth',
    getDirection: true,
    mobile: {
      breakpoint: 0,
      smooth: false,
      getDirection: true,
    },
    tablet: {
      breakpoint: 0,
      smooth: false,
      getDirection: true,
    },
  });

  (window as any).locomotiveScroll = scroll;

  // Locomotive scrollar med transform, så ScrollTrigger måste läsa dess position.
  scroll.on('scroll', ScrollTrigger.update);

  ScrollTrigger.scrollerProxy(scrollContainer, {
    scrollTop(value?: number) {
      if (arguments.length && typeof value === 'number') {
        scroll.scrollTo(value, { duration: 0, disableLerp: true });
        return;
      }
      return (scroll as any).scroll?.instance?.scroll?.y ?? 0;
    },
    getBoundingClientRect() {
      return {
        top: 0,
        left: 0,
        width: window.innerWidth,
        height: window.innerHeight,
      };
    },
    pinType: (scrollContainer as HTMLElement).style.transform
      ? 'transform'
      : 'fixed',
  });

  ScrollTrigger.defaults({ scroller: scrollContainer });
  ScrollTrigger.addEventListener('refresh', () => scroll.update());
  ScrollTrigger.refresh();

  $(document).on('nfFormSubmitResponse', function () {
    scroll.scrollTo('#note-board');
  });

  // Locomotive räknar inte om sin höjd när innehållet växer, t.ex. när bilder laddar.
  const containerId = document.querySelector('[data-scroll-container]');
  if (!containerId) {
    console.error('Container ID not found');
    return;
  }

  let recordHeight = 0;
  const mutationObserver = new MutationObserver(function () {
    const height = parseFloat(
      window.getComputedStyle(containerId).getPropertyValue('height'),
    );
    if (height === recordHeight) {
      return;
    }
    recordHeight = height;

    scroll.update();
  });

  mutationObserver.observe(containerId, {
    childList: true,
    attributes: true,
    characterData: true,
    subtree: true,
  });
}
