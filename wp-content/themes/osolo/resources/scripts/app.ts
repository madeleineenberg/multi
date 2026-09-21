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
  // Först: den registrerar ScrollTrigger-proxyn mot Locomotive och sätter
  // scroller som default. Triggers som skapas i gallery() och animateText()
  // måste komma efter, annars binds de till window och utlöses aldrig i
  // smooth-läge.
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
