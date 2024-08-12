{{-- /
  Title: Image reveal
  Description: Hover link effect with image
  Category: formatting
  Icon: admin-comments
  Keywords: Hover, link, image
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
/ --}}

<div class="c-image-reveal" id="image-reveal">
    <ul>
        @foreach ($galleries as $key => $gallery)
            <li class="c-image-reveal__item" data-scroll>
                <a href="{{ get_permalink($gallery->ID) }}" class="c-image-reveal__link">
                    <span class="c-image-reveal__title"
                        data-text="{{ $gallery->post_title }}">{{ $gallery->post_title }}</span>
                    <div class="c-image-reveal__image-wrapper hover-reveal image{{ $key }}">
                        <img src="{{ get_the_post_thumbnail_url($gallery->ID) }}" alt=""
                            class="c-image-reveal__image hidden-img">
                    </div>
                </a>
                <div class="underline" data-scroll></div>
            </li>
        @endforeach
    </ul>
</div>
<div class="c-image-reveal__mobile">
    <ul class="c-image-reveal__mobile__list">
        @foreach ($galleries as $gallery)
            <li class="c-image-reveal__mobile__list-item">
                <a href="{{ get_permalink($gallery->ID) }}" class="c-image-reveal__mobile-link">
                    <div class="c-image-reveal__mobile-image-wrapper">
                        <span class="c-image-reveal__mobile-title">{{ $gallery->post_title }}</span>
                        <img src="{{ get_the_post_thumbnail_url($gallery->ID) }}" alt="">
                    </div>
                    <p class="c-image-reveal__mobile-subtitle">{{ $gallery->post_title }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</div>
