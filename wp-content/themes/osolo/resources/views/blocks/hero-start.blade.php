{{-- /
  Title: Start hero area
  Description: Hero image/video with text and animation
  Category: formatting
  Icon: format-image
  Keywords: Image, video, animation
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
/ --}}

<div class="c-start-hero">
    <div class="images" data-scroll data-scroll-speed="-1">
        <div class="left-hero-img img" style="background: url('{{ $left_image }}')"></div>
        <div class="right-hero-img img" style="background: url('{{ $right_image }}')"></div>
    </div>
    <div class="hero-image-container">
        <div class="wrapper-img" data-scroll data-scroll-speed="2">
            <div class="box"></div>
            <div>
                {{-- Dekorativ: hero-titeln bär betydelsen, så tomt alt i stället för
                     inget alt alls. --}}
                <img class="hero-image" src="{{ $hero_image }}" alt="" />
            </div>
        </div>
    </div>
    <div class="header">
        <p class="title">
            @forelse ($hero_title_links as $item)
                @php($word_link = $item['link'] ?? null)
                @if (!empty($word_link['url']))
                    <a href="{{ $word_link['url'] }}"
                        @if (!empty($word_link['target'])) target="{{ $word_link['target'] }}" rel="noopener" @endif>{{ $item['text'] }}</a>
                @else
                    {{ $item['text'] }}
                @endif
            @empty
                {{ $hero_title }}
            @endforelse
        </p>
    </div>
    <div class="hero-container projects">
        {{-- <a href="#image-reveal" data-scroll-to class="projects">{{ $link }} <ion-icon
                name="play-forward-circle-outline"></ion-icon></a> --}}
          @if (!empty($link))
          <div class="project-link-btn gallery-link">
              <a href="#image-reveal" data-scroll-to class="link anchor-link">
                  <div>
                      <span class="link-text">{{ $link }}</span>
                  </div>
              </a>
              <ion-icon name="arrow-up-outline"></ion-icon>
          </div>
      @endif
    </div>


</div>
