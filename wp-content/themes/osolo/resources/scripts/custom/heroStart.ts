import gsap from 'gsap';

/**
 * Introt spelas en gång per besök. Nyckeln bumpas när animationen
 * ändras, så att återkommande besökare får se den nya versionen.
 */
const INTRO_SEEN_KEY = 'hero-intro-seen-v1';

function introAlreadySeen(): boolean {
  try {
    return sessionStorage.getItem(INTRO_SEEN_KEY) === '1';
  } catch (e) {
    // Privat läge / blockerad storage: spela hellre introt än att krascha.
    return false;
  }
}

function markIntroSeen(): void {
  try {
    sessionStorage.setItem(INTRO_SEEN_KEY, '1');
  } catch (e) {
    // Ignoreras medvetet, se ovan.
  }
}

/**
 * Delar upp texten i <span class="letter"> utan att slå ut befintlig markup.
 * Titeln kan innehålla länkar, så innerHTML får inte skrivas över – varje
 * textnod styckas för sig och länkarna lämnas orörda.
 */
function splitIntoLetters(root: Element): void {
  const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT);
  const textNodes: Text[] = [];
  let current = walker.nextNode();

  while (current) {
    textNodes.push(current as Text);
    current = walker.nextNode();
  }

  textNodes.forEach((textNode) => {
    const text = textNode.textContent || '';

    if (!text.trim()) {
      return;
    }

    const letters = document.createDocumentFragment();

    for (const character of text) {
      if (!character.trim()) {
        letters.appendChild(document.createTextNode(character));
        continue;
      }

      const letter = document.createElement('span');

      letter.className = 'letter';
      letter.textContent = character;
      letters.appendChild(letter);
    }

    textNode.replaceWith(letters);
  });
}

export default function () {
  const hero = document.querySelector('.c-start-hero');

  if (!hero) {
    return;
  }

  const title = hero.querySelector('.title');

  if (title) {
    splitIntoLetters(title);
  }

  const q = gsap.utils.selector(hero);

  const intro = gsap.timeline({
    paused: true,
    defaults: { ease: 'expo.inOut' },
  });

  intro
    .from(q('.hero-image'), { scale: 2, duration: 2.6 }, 0)
    .to(q('.box'), { yPercent: -100, duration: 1.4 }, 0.2)
    .from(q('.img'), { opacity: 0, duration: 0.5 }, 1.4)
    .to(q('.left-hero-img'), { x: -200, rotation: -10, duration: 1.5 }, 1.5)
    .to(q('.right-hero-img'), { x: 200, rotation: 10, duration: 1.5 }, 1.5)
    .from(
      q('.title .letter'),
      {
        yPercent: 100,
        opacity: 0,
        duration: 1,
        ease: 'expo.out',
        stagger: 0.03,
      },
      1.8,
    )
    .fromTo(
      q('.projects'),
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 0.9 },
      2.5,
    );

  const prefersReducedMotion = window.matchMedia(
    '(prefers-reduced-motion: reduce)',
  ).matches;

  if (introAlreadySeen() || prefersReducedMotion) {
    // Hoppa till slutläget. Elementen ligger inte i sitt slutläge i CSS,
    // så timelinen måste spolas fram – den får inte bara hoppas över.
    intro.progress(1);
    return;
  }

  markIntroSeen();
  intro.play();
}
