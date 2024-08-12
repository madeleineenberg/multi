{{-- /
  Title: Text block
  Description: Text with animations
  Category: formatting
  Icon: admin-comments
  Keywords: text
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-text-block">
    <h2 class="c-text-block__heading" id="headline" data-scroll data-scroll-repeat>{{ $heading }}</h2>
    <div class="underline" data-scroll></div>
    <div class="c-text-block__text" data-scroll data-scroll-speed="-2">
        <p>{{ $text }}
            @if ($icon)
                <ion-icon name="{{ $icon }}"></ion-icon>
            @endif
        </p>
    </div>
    @if ($image)
        <div class="c-text-block__image-wrapper">
            <img data-scroll data-scroll-speed="-2" class="c-text-block__image" style="opacity: {{$opacity}}" src="{{ $image['sizes']['large'] }}"
                alt="">
        </div>
    @endif

</div>
