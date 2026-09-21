export default function () {
  const linkItems = [...document.querySelectorAll('.link')];

  linkItems.forEach((item) => {
    const source = item.children[0].children[0] as HTMLElement;
    // textContent, inte innerText: innerText speglar text-transform och hade
    // gett etiketten i versaler.
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
      // --index used for css delay animation
      (
        item.children[0] as HTMLElement
      ).innerHTML += `<span style="--index: ${idx};">${displayLetter}</span>`;
    });
    const cloneDiv = item.children[0].cloneNode(true) as HTMLElement;
    cloneDiv.style.position = 'absolute';
    cloneDiv.style.left = '0';
    cloneDiv.style.top = '0';
    item.appendChild(cloneDiv);

    // Texten är nu ett spann per bokstav, vilket en del skärmläsare
    // bokstaverar. Göm den uppdelade texten och låt länken bära ordet som
    // etikett i stället. En etikett som redan satts i markupen vinner.
    if (label && !item.hasAttribute('aria-label')) {
      item.setAttribute('aria-label', label);
    }
    item.children[0].setAttribute('aria-hidden', 'true');
    cloneDiv.setAttribute('aria-hidden', 'true');
  });
}
