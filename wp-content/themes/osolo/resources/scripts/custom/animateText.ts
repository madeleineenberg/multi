import gsap from 'gsap';
import SplitType from 'split-type';
import ScrollTrigger from 'gsap/ScrollTrigger';
import anime from 'animejs/lib/anime.es.js';
gsap.registerPlugin(ScrollTrigger);

export default function () {
  let titleSplit = new SplitType('h1', {
    types: 'lines',
    lineClass: 'split-child',
  });

  // gsap.from(titleSplit.lines, {
  //   duration: 1.5,
  //   yPercent: 100,
  //   ease: 'power4.out',
  //   stagger: 0.1,
  // });

  setTimeout(() => {
    // Get the h1 element
    const h1Element = document.querySelector('h1');

    // Check if the h1 element exists
    if (h1Element) {
      // Show the h1 element
      h1Element.style.opacity = '1';

      // Start the animation
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
  }, 100); // Adjust the delay as needed

  const links = gsap.utils.toArray(
    '.navigation-item, .c-image-reveal__mobile__list-item',
  ) as Element[];

  links.forEach((link, i) => {
    const anim = gsap.fromTo(
      link,
      { autoAlpha: 0, y: 100 },
      { duration: 1, autoAlpha: 1, y: 0 },
    );
    ScrollTrigger.create({
      trigger: link,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    });
  });

  let subtitleSplit = new SplitType('h2', {
    types: 'lines,words',
    lineClass: 'subtitle_line',
  });
}
