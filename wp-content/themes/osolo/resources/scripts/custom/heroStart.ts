import anime from 'animejs/lib/anime.es.js';
import { TweenMax, Expo } from 'gsap/gsap-core';

export default function () {
  const textWrapper = document.querySelector('.title');
  if (textWrapper && textWrapper.textContent) {
    textWrapper.innerHTML = textWrapper.textContent.replace(
      /\S/g,
      "<span class='letter'>$&</span>",
    );
  }

  anime.timeline().add({
    targets: '.title .letter',
    translateY: [100, 0],
    translateZ: 0,
    opacity: [0, 1],
    easing: 'easeOutExpo',
    duration: 2000,
    delay: (el, i) => 4800 + 40 * i,
  });

  TweenMax.to('.box', 2.4, {
    y: '-100%',
    ease: Expo.easeInOut,
    delay: 1,
  });

  TweenMax.from('.hero-image', 4, {
    scale: '2',
    ease: Expo.easeInOut,
    delay: 0,
  });

  TweenMax.to('.wrapper-img', 2.4, {
    width: '400',
    height: '500',
    ease: Expo.easeInOut,
    delay: 3.6,
  });

  TweenMax.from('.img', 0.4, {
    opacity: 0,
    ease: Expo.easeInOut,
    delay: 3.4,
  });

  TweenMax.to('.left-hero-img', 2, {
    x: '-200',
    rotation: -10,
    ease: Expo.easeInOut,
    delay: 3.8,
  });

  TweenMax.to('.right-hero-img', 2, {
    x: '200',
    rotation: 10,
    ease: Expo.easeInOut,
    delay: 3.8,
  });

TweenMax.staggerFromTo(
  '.projects',
  2,
  {
    opacity: 0,
    y: 30,
  },
  {
    opacity: 1,
    y: 0,
    ease: Expo.easeInOut,
    delay: 4.2,
  }
);
}
