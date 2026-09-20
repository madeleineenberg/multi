export default function () {
  const linkItems = [...document.querySelectorAll('.link')];

  linkItems.forEach((item) => {
    const word = (item.children[0].children[0] as HTMLElement).innerText.split(
      '',
    );

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
  });
}
