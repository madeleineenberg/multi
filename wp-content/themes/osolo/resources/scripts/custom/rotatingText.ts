export default function () {
  const linkItems = [...document.querySelectorAll('.link')];

  linkItems.forEach((item) => {
    const source = item.children[0].children[0] as HTMLElement;
    // textContent, eftersom innerText ger texten i versaler via text-transform.
    const label = (source.textContent || '').trim();
    const word = source.innerText.split('');

    (item.children[0] as HTMLElement).innerHTML = '';
    word.forEach((letter, idx) => {
      let displayLetter = letter;
      if (letter === ' ') {
        displayLetter = '&nbsp;';
      } else if (letter === '\n') {
        displayLetter = '<br>';
      }
      (
        item.children[0] as HTMLElement
      ).innerHTML += `<span style="--index: ${idx};">${displayLetter}</span>`;
    });
    const cloneDiv = item.children[0].cloneNode(true) as HTMLElement;
    cloneDiv.style.position = 'absolute';
    cloneDiv.style.left = '0';
    cloneDiv.style.top = '0';
    item.appendChild(cloneDiv);

    // Skärmläsare bokstaverar annars de uppdelade spannen.
    if (label && !item.hasAttribute('aria-label')) {
      item.setAttribute('aria-label', label);
    }
    item.children[0].setAttribute('aria-hidden', 'true');
    cloneDiv.setAttribute('aria-hidden', 'true');
  });
}
