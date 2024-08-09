import gsap from 'gsap';
import SplitType from 'split-type';
import TweenMax from 'gsap';

export default function () {
  gsap.config({
    nullTargetWarn: false,
  });

  let titleSplit = new SplitType('#hero_title', {
    types: 'lines',
    lineClass: 'split-child',
  });

  let textSplit = new SplitType('#hero_text', {
    types: 'lines',
    lineClass: 'split-text',
  });

  gsap.from(titleSplit.lines, {
    duration: 1.5,
    yPercent: 100,
    ease: 'power4.out',
    stagger: 0.1,
  });

  gsap.from(textSplit.lines, {
    duration: 1,
    y: -20,
    opacity: 1,
    stagger: 0.2,
    ease: 'power4.out',
  });

  TweenMax.from('.c-header', 1, {
    opacity: 0,
    ease: 'Power1.easeInOut',
  });

  TweenMax.from('.theme-btn', 2, {
    opacity: 0,
    ease: 'Power1.easeInOut',
  });
}
