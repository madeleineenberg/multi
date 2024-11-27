export default function () {
  const link: any = document.getElementById('go-back');

  if (link) {
    link.addEventListener('click', () => {
      history.back();
    });
  }
}
