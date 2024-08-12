{{-- /
  Title: Hover link
  Description: Hover link effect with image
  Category: formatting
  Icon: admin-comments
  Keywords: Hover, link, image
  Mode: auto
  Align: center
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
/ --}}


<div class="navigation-wrapper">
    <div class="project-preview-wrapper">
        <div class="project-preview"></div>
    </div>
    <ul class="navigation-list">
        @foreach ($galleries as $key => $gallery)
            <li class="navigation-item" data-scroll data-scroll-speed="0.2">
                <a href="{{ get_permalink($gallery->ID) }}" class="navigation-link navigation-link-{{ $key }}"
                    data-image="{{ get_the_post_thumbnail_url($gallery->ID) }}">
                    <span class="navigation-title" data-text="{{ $gallery->post_title }}"
                        data-id="{{ $gallery->ID }}">{{ $gallery->post_title }}</span>
                </a>
                <img src="{{ get_the_post_thumbnail_url($gallery->ID) }}" alt="">
                {{-- <p>{{ $gallery->post_title }}</p> --}}
            </li>
        @endforeach
    </ul>
</div>
