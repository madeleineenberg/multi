@extends('layouts.app')


@section('content')
    <div class="gallery-container">
        {{-- Sticky via Locomotive, eftersom position: sticky inte fungerar i dess container. --}}
        <nav class="gallery-nav" aria-label="Galleries" data-scroll data-scroll-sticky
            data-scroll-target=".gallery-container">
            <ul class="gallery-nav__list">
                @foreach ($galleries as $gallery)
                    <li class="gallery-nav__item{{ $gallery->ID === get_the_ID() ? ' is-current' : '' }}">
                        <a href="{{ get_permalink($gallery->ID) }}"
                            @if ($gallery->ID === get_the_ID()) aria-current="page" @endif>
                            {{ $gallery->post_title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Samma uppbyggnad som arkivlänken i image-reveal-blocket. --}}
            <div class="project-link-btn gallery-link">
                <a href="{{ $archive_url }}" class="link">
                    <div>
                        <span class="link-text">Archive</span>
                    </div>
                </a>
                <ion-icon name="arrow-up-outline"></ion-icon>
            </div>
        </nav>

        <h1 id="gallery-title" class="gallery-title" data-id="{{ get_the_ID() }}">{!! get_the_title() !!}</h1>

        <div class="gallery-flow">
            {{-- Cykler på 5 och 7 ger ett oregelbundet men stabilt mönster. --}}
            @foreach ($images as $i => $image)
                @php
                    $id = $image['image']['ID'];
                    // Reserv när bilden saknar alt-text i mediabiblioteket.
                    $alt = get_post_meta($id, '_wp_attachment_image_alt', true)
                        ?: sprintf('%s, photograph %d of %d', get_the_title(), $i + 1, count($images));
                @endphp
                <figure class="gallery-flow__item pos-{{ $i % 7 }} size-{{ $i % 5 }}"
                    @if ($i % 2 === 0) data-scroll data-scroll-speed="1.4" @endif>
                    <button type="button" class="gallery-flow__trigger"
                        data-full="{{ wp_get_attachment_image_url($id, 'full') }}"
                        data-alt="{{ $alt }}"
                        aria-label="{{ sprintf('View photograph %d of %d', $i + 1, count($images)) }}">
                        {!! wp_get_attachment_image($id, 'large', false, [
                            'class' => 'gallery-flow__img',
                            'alt' => $alt,
                            'loading' => $i < 2 ? 'eager' : 'lazy',
                        ]) !!}
                    </button>
                </figure>
            @endforeach
        </div>
    </div>

    <div class="gallery-container--mobile">
        <h1 id="gallery-title-mobile" class="gallery-title" data-id="{{ get_the_ID() }}">
            {!! get_the_title() !!}</h1>

        <ul class="gallery-list">
            @foreach ($images as $image)
                <li class="gallery-list__item">
                    @php
                        echo wp_get_attachment_image($image['image']['ID'], 'large', ' ', [
                            'class' => 'img-responsive',
                        ]);
                    @endphp
                </li>
            @endforeach
        </ul>
    </div>

    <div class="lightbox" role="dialog" aria-modal="true" aria-hidden="true"
        aria-label="{{ get_the_title() }}">
        <div class="lightbox__backdrop" data-lightbox-close></div>

        <button type="button" class="lightbox__close" data-lightbox-close aria-label="Close image viewer">
            <ion-icon name="close-outline"></ion-icon>
        </button>

        <button type="button" class="lightbox__nav lightbox__nav--prev" data-lightbox-prev
            aria-label="Previous photograph">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </button>

        <figure class="lightbox__stage">
            <img class="lightbox__img" src="" alt="">
        </figure>

        <button type="button" class="lightbox__nav lightbox__nav--next" data-lightbox-next aria-label="Next photograph">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </button>

        <p class="lightbox__counter" aria-live="polite"></p>
    </div>
@endsection
