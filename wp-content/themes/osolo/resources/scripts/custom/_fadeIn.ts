import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default function () {
  const boxes: Array<Element> = gsap.utils.toArray('.fade-block');

  boxes.forEach((box, i) => {
    const anim = gsap.fromTo(
      box as any,
      { autoAlpha: 0, y: 50 } as any,
      { duration: 1, autoAlpha: 1, y: 0 } as any,
    );

    ScrollTrigger.create({
      trigger: box,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    } as any);
  });

  const lines: Array<Element> = gsap.utils.toArray('.line');

  lines.forEach((line, i) => {
    const tl = gsap.timeline();

    tl.to(
      line,
      {
        duration: 1,
        width: '100%',
        stagger: {
          amount: 0.5,
        },
      },
      '-=.1',
    );

    ScrollTrigger.create({
      trigger: line,
      animation: tl,
      toggleActions: 'play none none none',
      once: true,
    } as any);
  });
}
