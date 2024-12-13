{{-- /
  Title: Page Footer
  Description: Footer with links and text
  Category: formatting
  Icon: admin-comments
  Keywords: link, text
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
/ --}}



<div class="c-page-footer__panel {{ $mode_settings ? 'light-mode' : '' }}" data-scroll data-scroll-speed="5">
    @if ($first || $second)
        <div class="ticker-wrap-footer two">
            <div class="ticker">
                <span class="item-collection-1">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">{{ $first }} <ion-icon name="{{ $icon }}"></ion-icon>
                            {{ $second }} </span>
                    @endfor
                </span>
                <span class="item-collection-2">
                    @for ($i = 0; $i < 6; $i++)
                        <span class="item">{{ $first }} <ion-icon name="{{ $icon }}"></ion-icon>
                            {{ $second }}</span>
                    @endfor
                </span>
            </div>
        </div>
    @endif
</div>
<div class="c-page-footer__inner  {{ $mode_settings ? 'light-mode' : '' }}">
    <div class="c-page-footer__inner-top-section">
        <p>{!! $work !!}</p>
        <p>{{ $location }}</p>
    </div>
    <div class="c-page-footer__inner-middle-section">
        @if (!empty($anchor))
            <a href="{{ $anchor['url'] }}">
        @endif
        <h2 data-scroll data-scroll-repeat>{{ $bold_text }}</h2>
        <p class="c-page-footer__inner-middle-section__sub-text">{{ $sub_text }}<ion-icon name="arrow-down-outline"
                class="c-page-footer__inner-middle-section__sub-text-icon">
            </ion-icon>
        </p>
        @if (!empty($anchor))
            </a>
        @endif
    </div>
    <div class="c-page-footer__inner-bottom-section">
        <p>{{ $credits }}</p>
        <p class="c-page-footer__inner-bottom-section-copy">All images &copy; {{ date('Y') }} Madeleine Enberg</p>
    </div>
</div>
