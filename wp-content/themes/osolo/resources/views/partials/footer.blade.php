<footer class="content-info c-footer">
  @if (!$hide_newsletter)
    <div class="has-primary-background-color newsletter container">
      @if ($newsletter_heading)
        <h2>{{ $newsletter_heading }}</h2>
      @endif
      @if ($newsletter_id)
        {!! do_shortcode('[ninja_form id="' . $newsletter_id . '"]') !!}
      @endif
    </div>
  @endif

  <div class="c-footer__bottom container">
    <div class="c-footer__text-area">
      @if ($text_area)
        <p> {{ $text_area }}</p>
      @endif
    </div>

    <div class="c-footer__info-area">
      @if (isset($footerLogo))
        <img src="{{ $footerLogo['url'] }}" alt="{{ $footerLogo['alt'] }}">
      @endif

      <div class="c-footer__info-area--contact">
        {!! $addressInfo !!}
      </div>
    </div>

    <div class="c-footer__logo-area">
      @foreach ($logos as &$logo)
        <a href="{{ $logo['link'] }}" rel="external nofollow" target="_blank">
          <img src="{{ $logo['logo']['url'] }}" alt="{{ $logo['logo']['alt'] }}">
        </a>
      @endforeach
    </div>
  </div>
</footer>
