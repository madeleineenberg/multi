import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
gsap.registerPlugin(ScrollTrigger);

export default function () {
  gsap.config({
    nullTargetWarn: false,
  });

  // Mobilens bildlista på single-galleri tonar in allteftersom den scrollas
  // fram. Desktopvyn renderas numera i blade:n och behöver ingen JS alls.
  const images = gsap.utils.toArray('.img-responsive');

  images.forEach((image) => {
    const anim = gsap.fromTo(
      image as gsap.TweenTarget,
      { autoAlpha: 0, y: 100 },
      { duration: 4, autoAlpha: 1, y: 0 },
    );
    ScrollTrigger.create({
      trigger: image as gsap.DOMTarget,
      animation: anim,
      toggleActions: 'play none none none',
      once: true,
    });
  });

  // Avslöja mobilvyn först nu. GSAP har satt bildernas autoAlpha ovan, så
  // ingenting hinner synas och sedan försvinna. Den lilla fördröjningen ger
  // en lugn paus i stället för att sidan hoppar fram i samma andetag som
  // skriptet blir klart.
  const mobileView = document.querySelector('.gallery-container--mobile');

  if (mobileView) {
    setTimeout(() => mobileView.classList.add('is-ready'), 250);
  }
}
