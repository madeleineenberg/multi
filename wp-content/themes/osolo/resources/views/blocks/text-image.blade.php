{{-- /
  Title: __('Text och bild', 'osolo')
  Description: __('Fullbrett block med text och bild', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: text image full width fullbred text bild
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-blockTextAndImage container-fluid {{ $fade_block ? 'fade-block' : '' }}">
  <div class="row h-100">
    <div class="c-blockTextAndImage__textWrapper col-12 col-md-6 {{ $text_position ? 'left' : 'right' }}"
      style="{{ 'background-color: ' . $background_color ?: '' }}">
      <div class="c-blockTextAndImage__textWrapper--text">
        <h2 style="{{ $text_color ? 'color: ' . $text_color : '' }}">
          {{ $title }}
        </h2>

        <p class="puff-size" style="{{ $text_color ? 'color: ' . $text_color : '' }}">
          {{ $text }}
        </p>

        @if ($link)
          <a target="{{ $link['target'] }}" href="{{ $link['url'] }}"
            style="{{ $text_color ? 'color: ' . $text_color : '' }}">
            {{ $link['title'] }}
          </a>
        @endif
      </div>
    </div>

    <div class="c-blockTextAndImage__image col-12 col-md-6">
      {!! wp_get_attachment_image($image['ID'], 'large') !!}
    </div>
  </div>
</div>
