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
                    @php
                        // Ikonlänkarna saknar text, så namnet härleds ur adressen.
                        $url = $link['link']['url'] ?? '';
                        $host = str_replace('www.', '', (string) parse_url($url, PHP_URL_HOST));
                        $tjanster = [
                            'instagram.com' => 'Instagram',
                            'linkedin.com' => 'LinkedIn',
                            'github.com' => 'GitHub',
                            'facebook.com' => 'Facebook',
                        ];
                        $etikett = $link['link']['title']
                            ?: ($tjanster[$host] ?? (str_starts_with($url, 'mailto:') ? 'Email' : $host));
                        $nyFlik = ($link['link']['target'] ?? '') === '_blank';
                    @endphp
                    <a href="{{ $url }}" class="icon-link" data-icon="{{ $link['icon'] }}"
                        target="{{ $link['link']['target'] }}" @if ($nyFlik) rel="noopener" @endif
                        aria-label="{{ $etikett }}{{ $nyFlik ? ' (opens in a new tab)' : '' }}">
                        <ion-icon name="{{ $link['icon'] }}" aria-hidden="true"></ion-icon>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="c-form-block">
        <div class="c-form-block__container">
            @if ($heading)
                <h2 class="c-form-block__title">{{ $heading }}</h2>
            @endif
            @if ($text)
                <p class="c-form-block__text" id="contact">{!! $text !!}</p>
            @endif
            @if ($id)
                {!! do_shortcode('[ninja_form id="' . $id . '"]') !!}
            @endif
        </div>
    </div>

</div>
