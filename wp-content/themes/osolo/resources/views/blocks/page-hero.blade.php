{{-- /
  Title: Page Hero
  Description: Hero image/video with text
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



<div class="c-page-hero">
    <div class="wrapper">
        <div class="c-page-hero_image-wrapper" data-scroll
                data-scroll-speed="2">
            @if($image)
                <img src="{{ $image['sizes']['large'] }}" alt="" class="c-page-hero__image" style="opacity: {{$opacity}}" data-scroll>
            @endif
            @if($video)
                <video autoplay loop muted playsinline style="opacity: {{$opacity}}" data-scroll>
                    <source src="{{ $video['url'] }}" type="video/mp4">
                    <source src="{{ $video['url'] }}" type="video/webm">
                </video>
            @endif
        </div>
        <h1 class="c-page-hero__title" data-scroll data-scroll-speed="-2">{{ $title }}</h1>
    </div>
</div>
