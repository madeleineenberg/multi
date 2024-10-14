{{-- /
  Title: Image/video and text block (not projects)
  Description: Image/video with text and color backgrounds
  Category: formatting
  Icon: admin-comments
  Keywords: image, text, color, video, file
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}

@if ($block_title)
    <div class="projects-title">
        <p>
            {{ $block_title }}
        </p>
    </div>
@endif

<div class="c-sticky-image-text-block c-image-text-block {{ $margins }}">
    <div class="c-sticky-image-text-block__text-wrapper {{ $image_position }}" data-scroll
        style='background-color: {{ $color_background }}'>
        <h5 class="c-sticky-image-text-block__subheading">{{ $subheading }}</h5>
        <div class="c-sticky-image-text-block__text-wrapper-headline-wrapper">
            <h2 class="c-sticky-image-text-block__text-wrapper-headline" data-scroll data-scroll-repeat>
                {{ $heading }}
            </h2>
        </div>
        <div class="c-sticky-image-text-block__text-wrapper-text">
            {!! $text !!}
        </div>
    </div>
    <div class="c-sticky-image-text-block__image-wrapper {{ $image_position }}">
        @if (!empty($image))
            <img src="{{ $image['url'] }}" alt="" data-scroll data-scroll-speed="-2">
        @endif
        @if (!empty($video))
            <div class="c-sticky-image-text-block__video">
                <video autoplay loop muted playsinline data-scroll data-scroll-speed="-2">
                    <source src="{{ $video['url'] }}" type="video/mp4">
                    <source src="{{ $video['url'] }}" type="video/webm">
                </video>
            </div>
        @endif
        @if (!empty($project_link))
            <div class="project-link-btn" style="background-color: {{ $color_background }}">
                    <a href="{{ $project_link['url'] }}" target="{{ $project_link['target'] }}" rel="nofollow"
                        class="link">
                        <div>
                            <span class="link-text">{{ $project_link['title'] }}</span>
                        </div>
                    </a>
                <ion-icon name="arrow-up-outline"></ion-icon>
            </div>
        @endif
        @if (!empty($file))
            <div class="project-link-btn" style="background-color: {{ $color_background }}">
                    <a href="{{ $file['url'] }}" target="_blank" rel="nofollow" class="link">
                        <div>
                            <span class="link-text">{{ $file['title'] }}</span>
                        </div>
                    </a>
                <ion-icon name="arrow-up-outline"></ion-icon>
            </div>
        @endif
    </div>
</div>
