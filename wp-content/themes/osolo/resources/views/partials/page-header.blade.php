<div class="page-header">
  {{--
    Designen vill inte ha någon synlig sidrubrik, men varje sida behöver en
    h1 för att dokumentstrukturen ska gå att navigera. Den här är klippt, inte
    dold – skärmläsare når den, ingen annan ser den.
  --}}
  <h1 class="visually-hidden">{{ get_the_title() }}</h1>
</div>
