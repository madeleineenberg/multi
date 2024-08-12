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
                <img class="hero-image" src="{{ $hero_image }} " />
            </div>
        </div>
    </div>
    <div class="header">
        <p class="title">{{ $hero_title }}</p>
    </div>
    <div class="hero-container">
        <a href="#image-reveal" data-scroll-to class="projects">{{ $link }} <ion-icon
                name="play-forward-circle-outline"></ion-icon></a>
    </div>
</div>
