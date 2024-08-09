{{-- /
  Title: __('Puffblock', 'osolo')
  Description: __('2-4 kolumner med text och bild', 'osolo')
  Category: formatting
  Icon: columns
  Keywords: puff column image text link bild text länk kolumn
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

@if ($puff_columns)
  <div class="c-puff-columns-block container {{ $fade_block ? 'fade-block' : '' }}">
    <div class="row justify-content-md-center h100">
      @if ($title)
        <h2>{{ $title }}</h2>
      @endif
      <div
        class="c-puff-columns-grid {{ $fade_block ? 'fade-block' : '' }} {{ count($puff_columns) == 2 ? 'two-columns' : '' }}">
        @foreach ($puff_columns as $column)
          <div class="c-puff-columns">
            @if ($column['link'])
              <a href="{{ $column['link'] }}" class="c-puff-columns__image-link">
            @endif
            <div class="{!! $column['color'] ?? '' !!} wrapper">
              @if ($column['image'])
                <div class="c-puff-columns__image-wrapper">
                  <img src="{{ $column['image'] }}" alt="">
                </div>
              @endif
              <div class="c-puff-columns__text-wrapper">
                <h3 class="c-puff-columns__title">{{ $column['title'] }}</h3>
                <p class="c-puff-columns__text">{{ wp_trim_words($column['text'], 30, '...') }}</p>
                @if ($column['link'])
                  <p class="link-text">{{ $column['link_text'] }}</p>
                @endif
                <span class="{{ $column['border_color'] }}-border color-border line"></span>
              </div>
            </div>
            @if ($column['link'])
              </a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
