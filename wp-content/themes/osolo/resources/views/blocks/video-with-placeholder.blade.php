{{-- /
  Title: __('Videoyta med platshållarbild', 'osolo')
  Description: __('Lägg till en platshållarbild och en video', 'osolo')
  Category: formatting
  Icon: admin-comments
  Keywords: video image placeholder bild platshållare
  Mode: auto
  Align: center
  PostTypes: page post events
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

<div class="c-blockVideo {{ $fade_block ? 'fade-block' : '' }}">
  <div class="video-area">
    @if ($placeholderImage)
      <div class="overlay" style="background-image: url({{ $placeholderImage['url'] }})">
        <div class="video-content">
          <h2>{{ $videoTitle }}</h2>
          <button class="play-btn "><img src="@asset('images/icon_play.svg')" alt="{{ __('Play icon', 'osolo') }}"></button>
        </div>
      </div>
    @endif

    <div class="embed-container">
      {!! $videoUrl !!}
    </div>
  </div>
</div>
