import LocomotiveScroll from 'locomotive-scroll';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default function () {
  if (!$('body').hasClass('single-galleri')) {
    const scrollContainer = document.querySelector('[data-scroll-container]');

    if (!scrollContainer) {
      console.error('Scroll container not found');
      return;
    }

    const scroll = new LocomotiveScroll({
      el: scrollContainer,
      smooth: true,
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

    // Make locomotive scroll instance globally available
    (window as any).locomotiveScroll = scroll;

    // ScrollTrigger läser window.scrollY. I smooth-läge flyttar Locomotive
    // innehållet med transform och lämnar den på 0, så ScrollTrigger ser
    // aldrig att något scrollas in och reveal-animationerna startar aldrig –
    // det är därför galleriobjekten i mobillistan blev osynliga. Proxyn nedan
    // låter ScrollTrigger läsa Locomotives position i stället.
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

    // Gäller alla triggers som skapas efter det här, därför körs
    // locomotiveScroll() först i app.ts.
    ScrollTrigger.defaults({ scroller: scrollContainer });
    ScrollTrigger.addEventListener('refresh', () => scroll.update());
    ScrollTrigger.refresh();

    //scroll to target on ninja form submit
    $(document).on('nfFormSubmitResponse', function () {
      scroll.scrollTo('#note-board');
    });

    //update scroll when images are loaded

    //   scroll.update();
    // });

    // document.addEventListener('DOMContentLoaded', function () {
    //   function ScrollUpdateDelay() {
    //     setTimeout(function () {
    //       scroll.update();
    //     }, 500);
    //   }

    //   ScrollUpdateDelay();
    // });

    //update locomotive scroll if height is changed

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
}
