{{-- /
  Title: Social link
  Description: Contact social links
  Category: formatting
  Icon: admin-comments
  Keywords: Hover, link
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-social-links">

    <div class="c-social-links__box" data-icon="{{ $default_icon }}" data-scroll data-scroll-speed="2">
        <ion-icon name="{{ $default_icon }}"></ion-icon>
    </div>
    <div class="c-social-links__list" data-scroll>
        @if ($label)
            <div class="c-social-links__text">
                <p>{{ $label }}</p>
                <div class="underline" data-scroll></div>
            </div>
        @endif
        @foreach ($links as $link)
            <a href="{{ $link['link']['url'] }}" class="c-social-links__link link" data-icon="{{ $link['icon'] }}"
                target="{{ $link['link']['target'] }}">
                <div><span class="link-text"> {{ $link['link']['title'] }}</div></span>
            </a>
        @endforeach
    </div>
</div>
