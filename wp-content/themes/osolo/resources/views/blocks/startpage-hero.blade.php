{{-- /
  Title: __('Heroyta startsida', 'osolo')
  Description: __('Bild, text och länk till startsidans huvudyta', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: hero startpage startsida huvudyta
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
/ --}}

<div class="c-blockStartpageHero">
    <div class="container">
        <div class="c-blockStartpageHero__textWrapper">
            <h1 id="hero_title">
                {!! $heading !!}
            </h1>

            <h3 id="hero_text">
                {!! $text !!}
            </h3>

            @if ($link)
                <a class="c-blockStartpageHero__link theme-btn" target="{{ $link['target'] }}" href="{{ $link['url'] }}">
                    {{ $link['title'] }}
                </a>
            @endif
        </div>
    </div>

    @if ($image)
        <div class="c-blockStartpageHero__image">
            {!! wp_get_attachment_image($image['ID'], 'full') !!}
        </div>
    @endif

    @if ($video)
        <div class="c-blockStartpageHero__video">
            <video autoplay loop muted playsinline>
                <source src="{{ $video['url'] }}" type="video/mp4">
                <source src="{{ $video['url'] }}" type="video/webm">
            </video>
        </div>
    @endif
</div>
