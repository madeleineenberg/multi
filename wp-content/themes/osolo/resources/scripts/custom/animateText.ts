import gsap from 'gsap';
import SplitType from 'split-type';
import ScrollTrigger from 'gsap/ScrollTrigger';
import anime from 'animejs/lib/anime.es.js';
gsap.registerPlugin(ScrollTrigger);

export default function () {
  const reducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)',
  ).matches;

  new SplitType('h1', {
    types: 'lines',
    lineClass: 'split-child',
  });

  setTimeout(() => {
    // Alla h1, eftersom single-galleri har en rubrik för desktop och en för mobil.
    const headings = Array.from(
      document.querySelectorAll<HTMLElement>('h1'),
    );

    if (headings.length) {
      headings.forEach((heading) => {
        heading.style.opacity = '1';
      });

      anime.timeline().add({
        targets: 'h1 .split-child',
        translateY: [100, 0],
        translateZ: 0,
        opacity: [0, 1],
        easing: 'easeOutExpo',
        duration: 2000,
        delay: (el, i) => 1000 + 40 * i,
      });
    }
  }, 100);

  const links = gsap.utils.toArray(
    '.navigation-item, .c-image-reveal__mobile__list-item',
  ) as Element[];

  links.forEach((link) => {
    const anim = gsap.fromTo(
      link,
      { autoAlpha: 0, y: 100 },
      { duration: reducedMotion ? 0 : 1, autoAlpha: 1, y: 0 },
    );
    ScrollTrigger.create({
      trigger: link,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    });
  });

  new SplitType('h2', {
    types: 'lines,words',
    lineClass: 'subtitle_line',
  });
}
