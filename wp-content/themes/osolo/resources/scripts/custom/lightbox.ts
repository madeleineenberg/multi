/**
 * Bildvisare för galleriflödet på desktop. Mobilvyn har en egen lista och
 * lämnas orörd.
 */
export default function () {
  const lightbox = document.querySelector<HTMLElement>('.lightbox');
  const triggers = Array.from(
    document.querySelectorAll<HTMLButtonElement>('.gallery-flow__trigger'),
  );

  if (!lightbox || !triggers.length) {
    return;
  }

  // position: fixed fungerar inte inuti [data-scroll-container], eftersom
  // locomotive förskjuter den med transform. Flytta ut overlayen till body.
  document.body.appendChild(lightbox);

  const img = lightbox.querySelector<HTMLImageElement>('.lightbox__img');
  const counter = lightbox.querySelector<HTMLElement>('.lightbox__counter');
  const closeButton = lightbox.querySelector<HTMLButtonElement>(
    '.lightbox__close',
  );

  if (!img || !counter || !closeButton) {
    return;
  }

  const slides = triggers.map((trigger) => ({
    src: trigger.dataset.full || '',
    alt: trigger.dataset.alt || '',
  }));

  let index = 0;
  let lastFocused: HTMLElement | null = null;

  const render = () => {
    img.src = slides[index].src;
    img.alt = slides[index].alt;
    counter.textContent = `${index + 1} / ${slides.length}`;
  };

  // Förladda grannarna så att bläddringen inte blinkar till.
  const preloadNeighbours = () => {
    [index - 1, index + 1].forEach((i) => {
      const slide = slides[(i + slides.length) % slides.length];
      if (slide) {
        new Image().src = slide.src;
      }
    });
  };

  const isOpen = () => lightbox.classList.contains('is-open');

  const open = (at: number) => {
    index = at;
    lastFocused = document.activeElement as HTMLElement;
    render();
    lightbox.classList.add('is-open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.classList.add('has-lightbox-open');
    (window as any).locomotiveScroll?.stop();
    closeButton.focus();
    preloadNeighbours();
  };

  const close = () => {
    lightbox.classList.remove('is-open');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('has-lightbox-open');
    (window as any).locomotiveScroll?.start();
    lastFocused?.focus();
  };

  const step = (delta: number) => {
    index = (index + delta + slides.length) % slides.length;
    render();
    preloadNeighbours();
  };

  triggers.forEach((trigger, i) => {
    trigger.addEventListener('click', () => open(i));
  });

  lightbox.querySelectorAll('[data-lightbox-close]').forEach((el) => {
    el.addEventListener('click', close);
  });

  lightbox
    .querySelector('[data-lightbox-prev]')
    ?.addEventListener('click', () => step(-1));

  lightbox
    .querySelector('[data-lightbox-next]')
    ?.addEventListener('click', () => step(1));

  document.addEventListener('keydown', (event) => {
    if (!isOpen()) {
      return;
    }

    if (event.key === 'Escape') {
      close();
    } else if (event.key === 'ArrowLeft') {
      step(-1);
    } else if (event.key === 'ArrowRight') {
      step(1);
    } else if (event.key === 'Tab') {
      // Håll kvar fokus i dialogen så länge den är öppen.
      const focusable = Array.from(
        lightbox.querySelectorAll<HTMLElement>('button'),
      );
      const first = focusable[0];
      const last = focusable[focusable.length - 1];

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    }
  });
}
