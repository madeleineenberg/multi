export default function () {

  const documentWidth = $(document)?.width();
  if (documentWidth && documentWidth > 768) {
    const link = document.querySelectorAll('.c-image-reveal__link');
    const linkHoverReveal = document.querySelectorAll('.hover-reveal');
    const linkImages = document.querySelectorAll('.hidden-img');

    for (let i = 0; i < link.length; i++) {
      const linkElement = link[i] as HTMLElement;
      const hoverRevealElement = linkHoverReveal[i] as HTMLElement;
      const imageElement = linkImages[i] as HTMLElement;

      if (linkElement && hoverRevealElement && imageElement) {
        linkElement.addEventListener('mousemove', (e: MouseEvent) => {
          hoverRevealElement.style.opacity = '1';
          hoverRevealElement.style.transform = `translate(-20%, -50% ) rotate(5deg)`;
          imageElement.style.transform = 'scale(1, 1)';
          hoverRevealElement.style.left = e.clientX + 'px';
        });

        linkElement.addEventListener('mouseleave', () => {
          hoverRevealElement.style.opacity = '0';
          hoverRevealElement.style.transform = `translate(-50%, -50%) rotate(-5deg)`;
          imageElement.style.transform = 'scale(0.8, 0.8)';
        });
      }
    }
  }
}
