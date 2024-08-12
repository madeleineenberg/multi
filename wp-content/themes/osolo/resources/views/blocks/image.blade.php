{{-- /
  Title: Image
  Description: Image area, full width
  Category: formatting
  Icon: format-image
  Keywords: Image, video, 
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
/ --}}

<div class="c-image-video-block {{ $placement[0] ? $placement[0] : '' }}">
    @if ($image)
        <div class="c-image-video-block__image-wrapper" data-scroll data-scroll-speed="-2">
            <img src="{{ $image['sizes']['large'] }}" style="opacity: {{$opacity}}" data-scroll/>
        </div>
    @endif
    @if ($video)
        <div class="c-image-video-block__image-wrapper">
            <video autoplay loop muted playsinline style="opacity: {{$opacity}} " data-scroll>
                <source src="{{ $video['url'] }}" type="video/mp4">
                <source src="{{ $video['url'] }}" type="video/webm">
            </video>
        </div>
    @endif
</div>
