import 'bootstrap';

import navigation from './custom/_navigation';
import videoBlock from './custom/_videoBlock';
import splideSlide from './custom/_splideSlide';
import lazyLoad from './custom/_lazyLoad';
import animateText from './custom/_animateText';
import fadeIn from './custom/_fadeIn';
import toggleBtn from './custom/_toggleBtn';
import addToCart from './custom/_addToCart';

$(() => {
  navigation();
  videoBlock();
  splideSlide();
  lazyLoad();
  animateText();
  fadeIn();
  toggleBtn();
  addToCart();
});
