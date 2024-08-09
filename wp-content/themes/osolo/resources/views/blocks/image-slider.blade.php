{{-- /
  Title: __('Bildsnurra', 'osolo')
  Description: __('Fullbrett block med bild och text', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: text image full width text bild fullbred
  Mode: auto
  Align: center
  PostTypes: page
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

@if ($images)
  <div class="c-image-slider-block container">
    <div class="row justify-content-md-center h100">
      @if ($heading)
        <h2>{{ $heading }}</h2>
      @endif

      <div id="image-slider" class="splide image-slider">
        <div class="splide__track">
          <ul class="splide__list">
            @foreach ($images as $image)
              <li class="splide__slide">
                <img src="{{ $image['image'] }}" alt="{{ $image['alt'] }}">
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

@endif
