import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);

export default function () {
  const reducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)',
  ).matches;

  gsap.config({
    nullTargetWarn: false,
  });

  const images = gsap.utils.toArray('.img-responsive');

  images.forEach((image) => {
    const anim = gsap.fromTo(
      image as gsap.TweenTarget,
      { autoAlpha: 0, y: 100 },
      { duration: reducedMotion ? 0 : 4, autoAlpha: 1, y: 0 },
    );
    ScrollTrigger.create({
      trigger: image as gsap.DOMTarget,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    });
  });

  // Visas först när GSAP satt startlägena ovan, annars blinkar bilderna till.
  const mobileView = document.querySelector('.gallery-container--mobile');

  if (mobileView) {
    setTimeout(() => mobileView.classList.add('is-ready'), 250);
  }
}
