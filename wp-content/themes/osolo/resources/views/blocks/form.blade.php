{{-- /
  Title: Form block
  Description: display form
  Category: formatting
  Icon: admin-comments
  Keywords: form contact
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-form-block__wrapper">
    <div class="icon-box-wrapper" data-scroll data-scroll-speed="-3">
        @if (!empty($links))
            <div class="icon-box">
                @foreach ($links as $link)
                    <a href="{{ $link['link']['url'] }}" class="icon-link" data-icon="{{ $link['icon'] }}"
                        target="{{ $link['link']['target'] }}">
                        <ion-icon name="{{ $link['icon'] }}"></ion-icon>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="c-form-block">
        @if ($heading)
            <h2 class="c-form-block__title">{{ $heading }}</h2>
        @endif
        @if ($text)
            <p class="c-form-block__text">{!! $text !!}</p>
        @endif
        @if ($id)
            {!! do_shortcode('[ninja_form id="' . $id . '"]') !!}
        @endif
    </div>
</div>
