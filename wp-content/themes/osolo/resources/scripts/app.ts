import 'bootstrap';

import hoverEffekt from './custom/hoverEffekt';
import gallery from './custom/gallery';
import animateText from './custom/animateText';
import header from './custom/header';
import locomotiveScroll from './custom/locomotiveScroll';
import socialLinks from './custom/socialLinks';
import rotatingText from './custom/rotatingText';
import imageReveal from './custom/image-reveal';
import heroStart from './custom/heroStart';
import returnLink from './custom/return';
import lightbox from './custom/lightbox';

$(() => {
  // Först, så att senare ScrollTriggers binds till Locomotive i stället för window.
  locomotiveScroll();
  hoverEffekt();
  gallery();
  animateText();
  header();
  socialLinks();
  rotatingText();
  imageReveal();
  heroStart();
  returnLink();
  lightbox();
});
