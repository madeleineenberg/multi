import LocomotiveScroll from 'locomotive-scroll';
import imagesLoaded from 'imagesloaded';

export default function () {
  if (!$('body').hasClass('single-galleri')) {
    let scrollContainer = document.querySelector('[data-scroll-container]');

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

    //scroll to target on ninja form submit
    $(document).on('nfFormSubmitResponse', function () {
      scroll.scrollTo('#note-board');
    });

    //update scroll when images are loaded

    // imagesLoaded(scrollContainer, { background: '.item' }, function () {
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
    const mutationObserver = new MutationObserver(function (mutations) {
      let height = parseFloat(
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
